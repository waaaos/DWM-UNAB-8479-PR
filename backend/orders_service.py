import os
import uuid
from fastapi import FastAPI, Depends, Header, HTTPException
from sqlalchemy.orm import Session
from dotenv import load_dotenv
from database import engine, Base, get_db
import models

load_dotenv()
Base.metadata.create_all(bind=engine)

app = FastAPI(title="Orders Service - Big Bite")
INTERNAL_SECRET = os.getenv("INTERNAL_API_SECRET", "secreto_interno_gateway_2026")

def validar_origen_gateway(x_internal_secret: str = Header(None)):
    print("[ORDERS-BACKEND][SEGURIDAD] Verificando secreto interno del API Gateway...")
    if x_internal_secret != INTERNAL_SECRET:
        print("[ORDERS-BACKEND][BLOQUEADO] Secreto interno inválido o ausente. Acceso directo denegado.")
        raise HTTPException(status_code=403, detail="Acceso directo prohibido: Secreto interno inválido")
    print("[ORDERS-BACKEND][SEGURIDAD] Secreto interno verificado correctamente.")

@app.post("/api/orders/pedidos", dependencies=[Depends(validar_origen_gateway)])
def confirmar_compra(
    pedido: models.PedidoWeb,
    db: Session = Depends(get_db),
    x_user_verified: str = Header(None)
):
    cliente_final = x_user_verified or pedido.cliente_correo
    pedido_id = str(uuid.uuid4())
    
    print(f"[ORDERS-BACKEND] Procesando orden para cliente verificado: {cliente_final}")
    nuevo_pedido = models.PedidoDB(
        id=pedido_id,
        cliente_correo=cliente_final,
        total=pedido.total,
        estado="pendiente_pago"
    )
    
    db.add(nuevo_pedido)
    db.commit()
    db.refresh(nuevo_pedido)
    
    print(f"[ORDERS-BACKEND][PERSISTENCIA] Registro INSERTADO en tabla 'pedidos' (ID: {pedido_id} | Total: ${pedido.total})")
    return {"mensaje": "Pedido creado exitosamente", "pedido_id": pedido_id}

@app.get("/api/orders/mis-pedidos", dependencies=[Depends(validar_origen_gateway)])
def obtener_mis_pedidos(
    db: Session = Depends(get_db),
    x_user_verified: str = Header(None)
):
    if not x_user_verified:
        raise HTTPException(status_code=401, detail="Usuario no identificado")
    
    print(f"[ORDERS-BACKEND][PERSISTENCIA] Consultando pedidos en BD para: {x_user_verified}")
    pedidos = db.query(models.PedidoDB).filter(models.PedidoDB.cliente_correo == x_user_verified).all()
    return {
        "pedidos": [
            {
                "id": p.id,
                "total": p.total,
                "estado": p.estado
            }
            for p in pedidos
        ]
    }