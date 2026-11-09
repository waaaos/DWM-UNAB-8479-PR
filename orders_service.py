from fastapi import FastAPI, Depends
from sqlalchemy.orm import Session
import uuid
from database import engine, Base, get_db
import models

Base.metadata.create_all(bind=engine)
app = FastAPI(title="Orders Service - Big Bite")

@app.post("/api/orders/pedidos")
def confirmar_compra(pedido: models.PedidoWeb, db: Session = Depends(get_db)):
    pedido_id = str(uuid.uuid4())
    nuevo_pedido = models.PedidoDB(
        id=pedido_id,
        cliente_correo=pedido.cliente_correo,
        total=pedido.total,
        estado="pendiente_pago"
    )
    db.add(nuevo_pedido)
    db.commit()
    return {"mensaje": "Pedido creado", "pedido_id": pedido_id}