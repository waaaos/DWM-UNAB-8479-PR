from fastapi import FastAPI, HTTPException, Depends
from sqlalchemy.orm import Session
from passlib.context import CryptContext
from database import engine, Base, get_db
import models

# Crear tablas
Base.metadata.create_all(bind=engine)

app = FastAPI(title="Clients Service - Big Bite")
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")

@app.post("/api/clients/register")
def registrar_cliente(cliente: models.ClienteRegistro, db: Session = Depends(get_db)):
    db_cliente = db.query(models.ClienteDB).filter(models.ClienteDB.correo == cliente.correo).first()
    if db_cliente:
        raise HTTPException(status_code=400, detail="El correo ya está registrado")
    
    # Hash adaptativo de la contraseña[cite: 20]
    hashed_password = pwd_context.hash(cliente.password)
    nuevo_cliente = models.ClienteDB(
        correo=cliente.correo, 
        nombre=cliente.nombre, 
        password_hash=hashed_password
    )
    db.add(nuevo_cliente)
    db.commit()
    return {"mensaje": "Registro exitoso", "status": "ok"}

@app.post("/api/clients/login")
def login_cliente(credenciales: models.ClienteLogin, db: Session = Depends(get_db)):
    cliente = db.query(models.ClienteDB).filter(models.ClienteDB.correo == credenciales.correo).first()
    
    # Validación segura del hash[cite: 20]
    if not cliente or not pwd_context.verify(credenciales.password, cliente.password_hash):
        raise HTTPException(status_code=401, detail="Credenciales inválidas")
    
    return {"mensaje": "Login exitoso", "usuario": cliente.nombre}