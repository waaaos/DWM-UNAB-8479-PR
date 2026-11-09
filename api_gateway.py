from fastapi import FastAPI, Request, HTTPException
from fastapi.middleware.cors import CORSMiddleware
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

@app.api_route("/api/{service}/{path:path}", methods=["GET", "POST", "PUT", "DELETE"])
async def gateway_enrutador(service: str, path: str, request: Request):
    if service not in SERVICIOS_PRIVADOS:
        raise HTTPException(status_code=404, detail="Ruta no autorizada en el Gateway")
    
    url_destino = f"{SERVICIOS_PRIVADOS[service]}/{path}"
    body = await request.body()
    
    # FILTRO DE CABECERAS: El gateway limpia la identidad aportada por el navegador[cite: 18]
    headers_permitidos = {"content-type", "accept"}
    headers_limpios = {k: v for k, v in request.headers.items() if k.lower() in headers_permitidos}
    
    # Aquí el gateway añadiría un 'x-user-verified' tras validar el token (si aplica)
    
    async with httpx.AsyncClient() as client:
        try:
            response = await client.request(
                method=request.method,
                url=url_destino,
                headers=headers_limpios,
                content=body
            )
            return response.json()
        except httpx.RequestError:
            raise HTTPException(status_code=503, detail="Subsistema interno no disponible")