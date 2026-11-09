from fastapi import FastAPI, Depends
from sqlalchemy.orm import Session
from database import engine, Base, get_db
import models

Base.metadata.create_all(bind=engine)
app = FastAPI(title="Inventory Service - Big Bite")

@app.get("/api/inventory/productos")
def consultar_catalogo(db: Session = Depends(get_db)):
    productos = db.query(models.ProductoDB).all()
    return {"productos": [{"id": p.id, "nombre": p.nombre, "precio": p.precio} for p in productos]}