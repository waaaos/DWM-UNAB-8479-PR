from fastapi import FastAPI, Request, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from fastapi.responses import JSONResponse
import httpx
import os
from dotenv import load_dotenv

load_dotenv()

app = FastAPI(title="API Gateway - Big Bite")

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

SERVICIOS_PRIVADOS = {
    "clients": os.getenv("CLIENTS_URL"),
    "inventory": os.getenv("INVENTORY_URL"),
    "orders": os.getenv("ORDERS_URL"),
    "payments": os.getenv("PAYMENTS_URL"),
}

RUTAS_PUBLICAS = ["clients/login", "clients/register", "inventory/productos"]

@app.api_route("/api/{service}/{path:path}", methods=["GET", "POST", "PUT", "DELETE"])
async def gateway_enrutador(service: str, path: str, request: Request):
    ruta_completa = f"{service}/{path}"
    print(f"\n[API-GATEWAY] Petición entrante: {request.method} /api/{ruta_completa}")

    if service not in SERVICIOS_PRIVADOS:
        print(f"[API-GATEWAY][ERROR] Servicio desconocido: {service}")
        raise HTTPException(status_code=404, detail="Ruta no autorizada en el Gateway")

    # 1. Obtener secreto interno desde Secret Manager (.env)
    secreto_interno = os.getenv("INTERNAL_API_SECRET")
    print("[API-GATEWAY][SECRET-MANAGER] Secreto interno de comunicación recuperado correctamente.")

    headers_reenvio = {
        "content-type": "application/json",
        "x-internal-secret": secreto_interno
    }

    # 2. Si no es ruta pública, validar identidad con Auth Service
    if ruta_completa not in RUTAS_PUBLICAS:
        auth_header = request.headers.get("authorization")
        print("[API-GATEWAY] Ruta protegida. Solicitando validación a Auth Service...")
        
        async with httpx.AsyncClient() as client:
            resp_auth = await client.get(
                f"{SERVICIOS_PRIVADOS['clients']}/verify",
                headers={"Authorization": auth_header or ""}
            )
            if resp_auth.status_code != 200:
                print("[API-GATEWAY][BLOQUEADO] Auth Service rechazó la solicitud.")
                return JSONResponse(
                    content={"detail": "No autorizado por Auth Service"},
                    status_code=401
                )
            
            datos_usuario = resp_auth.json()
            headers_reenvio["x-user-verified"] = datos_usuario["correo"]
            print(f"[API-GATEWAY] Identidad verificada ({datos_usuario['correo']}).")

    # 3. Enrutar al microservicio destino
    url_destino = f"{SERVICIOS_PRIVADOS[service]}/{path}"
    body = await request.body()
    print(f"[API-GATEWAY][ENRUTAMIENTO] Redirigiendo petición hacia -> {url_destino}")

    async with httpx.AsyncClient() as client:
        try:
            response = await client.request(
                method=request.method,
                url=url_destino,
                headers=headers_reenvio,
                content=body
            )
            return JSONResponse(
                content=response.json(),
                status_code=response.status_code
            )
        except httpx.RequestError:
            print(f"[API-GATEWAY][ERROR] Fallo de conexión con {url_destino}")
            raise HTTPException(status_code=503, detail="Subsistema interno no disponible")