from sqlalchemy import Column, Integer, String, Float, ForeignKey
from pydantic import BaseModel
from typing import List
from database import Base

# --- MODELOS ORM (Base de Datos) ---
class ClienteDB(Base):
    __tablename__ = "clientes"
    correo = Column(String, primary_key=True, index=True)
    nombre = Column(String)
    password_hash = Column(String) # Solo se guarda el hash adaptativo

class ProductoDB(Base):
    __tablename__ = "productos"
    id = Column(Integer, primary_key=True, index=True)
    nombre = Column(String, index=True)
    precio = Column(Integer)
    categoria = Column(String)

class PedidoDB(Base):
    __tablename__ = "pedidos"
    id = Column(String, primary_key=True, index=True)
    cliente_correo = Column(String, ForeignKey("clientes.correo"))
    total = Column(Integer)
    estado = Column(String)

# --- ESQUEMAS PYDANTIC (Entrada/Salida) ---
class ClienteRegistro(BaseModel):
    nombre: str
    correo: str
    password: str
    # (Agrega los demás campos: direccion, comuna, telefono, etc.)

class ClienteLogin(BaseModel):
    correo: str
    password: str

class ItemCarrito(BaseModel):
    nombre: str
    precio: int
    cantidad: int

class PedidoWeb(BaseModel):
    cliente_correo: str
    items: List[ItemCarrito]
    total: int