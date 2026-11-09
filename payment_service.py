from fastapi import FastAPI
from pydantic import BaseModel

app = FastAPI(title="Payments Service - Big Bite")

class NotificacionPago(BaseModel):
    pedido_id: str
    monto_total: int

@app.post("/api/payments/pagar")
def procesar_pago(pago: NotificacionPago):
    # Lógica que interactúa con la pasarela (Transbank/MercadoPago)
    return {"mensaje": "Pago confirmado exitosamente", "transaccion": "TXN-98765"}