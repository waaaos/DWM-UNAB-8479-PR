import os
import jwt
from datetime import datetime, timedelta, timezone
from fastapi import FastAPI, HTTPException, Depends, Header
from sqlalchemy.orm import Session
from passlib.context import CryptContext
from dotenv import load_dotenv
from database import engine, Base, get_db
import models

load_dotenv()
Base.metadata.create_all(bind=engine)

app = FastAPI(title="Auth & Clients Service - Big Bite")
pwd_context = CryptContext(schemes=["bcrypt"], deprecated="auto")
SECRET_KEY = os.getenv("SECRET_KEY", "clave_secreta_jwt_bigbite_2026")
INTERNAL_SECRET = os.getenv("INTERNAL_API_SECRET", "secreto_interno_gateway_2026")

def validar_origen_gateway(x_internal_secret: str = Header(None)):
    print("[AUTH-SERVICE][SEGURIDAD] Verificando secreto interno del API Gateway...")
    if x_internal_secret != INTERNAL_SECRET:
        print("[AUTH-SERVICE][BLOQUEADO] Secreto interno inválido o ausente. Acceso directo denegado.")
        raise HTTPException(status_code=403, detail="Acceso directo prohibido: Secreto interno inválido")
    print("[AUTH-SERVICE][SEGURIDAD] Secreto interno verificado correctamente.")

@app.post("/api/clients/register", dependencies=[Depends(validar_origen_gateway)])
def registrar_cliente(cliente: models.ClienteRegistro, db: Session = Depends(get_db)):
    print(f"[AUTH-SERVICE][PERSISTENCIA] Consultando disponibilidad de correo en BD: {cliente.correo}")
    if db.query(models.ClienteDB).filter(models.ClienteDB.correo == cliente.correo).first():
        raise HTTPException(status_code=400, detail="El correo ya está registrado")
    
    hashed_password = pwd_context.hash(cliente.password)
    nuevo_cliente = models.ClienteDB(
        correo=cliente.correo,
        nombre=cliente.nombre,
        password_hash=hashed_password
    )
    db.add(nuevo_cliente)
    db.commit()
    print(f"[AUTH-SERVICE][PERSISTENCIA] Nuevo usuario INSERTADO en tabla 'clientes': {cliente.correo}")
    return {"mensaje": "Registro exitoso", "status": "ok"}

@app.post("/api/clients/login", dependencies=[Depends(validar_origen_gateway)])
def login_cliente(credenciales: models.ClienteLogin, db: Session = Depends(get_db)):
    print(f"[AUTH-SERVICE] Solicitud de autenticación recibida para: {credenciales.correo}")
    print(f"[AUTH-SERVICE][PERSISTENCIA] Consultando credenciales en tabla 'clientes'...")
    cliente = db.query(models.ClienteDB).filter(models.ClienteDB.correo == credenciales.correo).first()
    
    if not cliente or not pwd_context.verify(credenciales.password, cliente.password_hash):
        print(f"[AUTH-SERVICE][DENEGADO] Credenciales inválidas para: {credenciales.correo}")
        raise HTTPException(status_code=401, detail="Credenciales inválidas")
    
    payload = {
        "sub": cliente.correo,
        "nombre": cliente.nombre,
        "rol": "cliente",
        "exp": datetime.now(timezone.utc) + timedelta(hours=2)
    }
    token = jwt.encode(payload, SECRET_KEY, algorithm="HS256")
    print(f"[AUTH-SERVICE][AUTORIZADO] Token JWT emitido exitosamente para: {cliente.correo}")
    return {"mensaje": "Login exitoso", "usuario": cliente.nombre, "token": token}

@app.get("/api/clients/verify")
def verificar_token(authorization: str = Header(None)):
    print("[AUTH-SERVICE] Petición de validación de token recibida desde API Gateway...")
    if not authorization or not authorization.startswith("Bearer "):
        print("[AUTH-SERVICE][DENEGADO] Token ausente o formato inválido.")
        raise HTTPException(status_code=401, detail="Token no proporcionado")
    
    token = authorization.split(" ")[1]
    try:
        datos = jwt.decode(token, SECRET_KEY, algorithms=["HS256"])
        print(f"[AUTH-SERVICE][OK] Token válido. Usuario autenticado: {datos['sub']} (Rol: {datos['rol']})")
        return {"valid": True, "correo": datos["sub"], "rol": datos["rol"]}
    except jwt.ExpiredSignatureError:
        print("[AUTH-SERVICE][DENEGADO] Token expirado.")
        raise HTTPException(status_code=401, detail="Token expirado")
    except jwt.InvalidTokenError:
        print("[AUTH-SERVICE][DENEGADO] Firma de token inválida.")
        raise HTTPException(status_code=401, detail="Token inválido")