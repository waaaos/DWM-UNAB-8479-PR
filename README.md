#  Big Bite 

Backend del sistema de pedidos online **Big Bite**, una hamburguesería. Está construido con una **arquitectura de microservicios**: un API Gateway REST, un gateway GraphQL para la agregación de datos y un servicio gRPC con *streaming* para la monitorización de entregas.

---

##  Arquitectura

```text
                    ┌──────────────────────────┐
   Frontend  ─────► │   API Gateway (FastAPI)  │  /api/{servicio}/{ruta}
  (navegador)       │  CORS + filtro de headers│
                    └────────────┬─────────────┘
                                 │ httpx (red interna)
        ┌──────────────┬─────────┴──────┬────────────────┐
        ▼              ▼                ▼                ▼
 ┌────────────┐ ┌─────────────┐ ┌──────────────┐ ┌──────────────┐
 │  Clients   │ │  Inventory  │ │    Orders    │ │   Payments   │
 │  Service   │ │   Service   │ │   Service    │ │   Service    │
 └─────┬──────┘ └──────┬──────┘ └──────┬───────┘ └──────────────┘
       └───────────────┼───────────────┘
                       ▼
               ┌───────────────┐
               │  SQLite (ORM  │   bigbite.db
               │  SQLAlchemy)  │
               └───────────────┘

 ┌────────────────────────────┐      ┌──────────────────────────────┐
 │ GraphQL Gateway (Node.js)  │      │ Analytics / Tracking (gRPC)  │
 │ Apollo Server · :4000      │      │ Streaming de estados · :50051│
 └────────────────────────────┘      └──────────────────────────────┘
```

| Componente | Archivo | Tecnología | Responsabilidad |
|---|---|---|---|
| API Gateway | `api_gateway.py` | FastAPI + httpx | Punto de entrada único: enruta peticiones a la red privada y sanitiza cabeceras. |
| Clients Service | `clients_service.py` | FastAPI + passlib (bcrypt) | Gestión de identidades, registro y autenticación segura. |
| Inventory Service | `inventory_service.py` | FastAPI + SQLAlchemy | Administración del catálogo comercial y precios. |
| Orders Service | `orders_service.py` | FastAPI + SQLAlchemy | Gestión del ciclo de vida de los pedidos transaccionales. |
| Payments Service | `payment_service.py` | FastAPI | Procesamiento y simulación de notificaciones de pago. |
| GraphQL Gateway | `graphql_gateway.js` | Node.js + Apollo Server | Orquesta la agregación de datos entre subsistemas privados. |
| Tracking gRPC | `grpc_server_analytics.py` | gRPC (Python) | Emite en streaming el estado logístico del pedido. |
| Base de datos | `database.py`, `models.py` | SQLAlchemy + SQLite | Capa de persistencia, modelos ORM y esquemas de validación Pydantic. |
| Datos de ejemplo | `seed.py` | SQLAlchemy | Población inicial del catálogo (Seed). |

---

##  Estructura del proyecto

```text
.
├── api_gateway.py            # Gateway REST (punto de entrada)
├── clients_service.py        # Microservicio de clientes
├── inventory_service.py      # Microservicio de inventario
├── orders_service.py         # Microservicio de pedidos
├── payment_service.py        # Microservicio de pagos
├── graphql_gateway.js        # Gateway GraphQL (Node.js)
├── grpc_server_analytics.py  # Servidor gRPC de seguimiento
├── tracking.proto            # Contrato gRPC
├── tracking_pb2.py           # Código generado desde tracking.proto
├── tracking_pb2_grpc.py      # Código generado desde tracking.proto
├── database.py               # Engine, sesión y dependencia get_db
├── models.py                 # Modelos ORM + esquemas Pydantic
├── seed.py                   # Carga de productos iniciales
└── bigbite.db                # Base de datos SQLite (Generada en ejecución)
```

---

##  Modelo de datos (ORM)

**`clientes`**
| Campo | Tipo | Notas |
|---|---|---|
| `correo` | String | Clave primaria |
| `nombre` | String | |
| `password_hash` | String | Hash adaptativo (bcrypt), nunca en texto plano. |

**`productos`**
| Campo | Tipo |
|---|---|
| `id` | Integer (PK) |
| `nombre` | String |
| `precio` | Integer (CLP) |
| `categoria` | String |

**`pedidos`**
| Campo | Tipo | Notas |
|---|---|---|
| `id` | String (UUID) | Clave primaria |
| `cliente_correo` | String | FK → `clientes.correo` |
| `total` | Integer | |
| `estado` | String | Estado inicial: `pendiente_pago` |

---

##  Endpoints

### REST (Accesibles vía API Gateway)

| Método | Ruta | Servicio Interno | Body | Respuesta |
|---|---|---|---|---|
| `POST` | `/api/clients/register` | Clients | `{ nombre, correo, password }` | `{ mensaje, status }` |
| `POST` | `/api/clients/login` | Clients | `{ correo, password }` | `{ mensaje, usuario }` |
| `GET` | `/api/inventory/productos` | Inventory | — | `{ productos: [{ id, nombre, precio }] }` |
| `POST` | `/api/orders/pedidos` | Orders | `{ cliente_correo, items, total }` | `{ mensaje, pedido_id }` |
| `POST` | `/api/payments/pagar` | Payments | `{ pedido_id, monto_total }` | `{ mensaje, transaccion }` |

### Rutas de Integración y Gateways

El **API Gateway** expone una ruta comodín para orquestar el tráfico:
`GET | POST | PUT | DELETE   /api/{service}/{path}`
* El Gateway descarta cabeceras no autorizadas antes de delegar a la red interna.
* Retorna `404` si el servicio no está en la lista de permitidos.
* Retorna `503` si el subsistema interno está caído.

**GraphQL Gateway** — `http://localhost:4000/graphql`
```graphql
query {
  resumen_pedido(pedido_id: "123") {
    pedido_id
    total
    estado
    productos_detalle { nombre precio categoria }
  }
}
```

**gRPC Tracking** — `localhost:50051`
```protobuf
service DeliveryTracker {
  rpc TrackOrder(TrackRequest) returns (stream DeliveryStatus);
}
```

---

##  Instalación y Despliegue

### Requisitos
- Python 3.10 o superior
- Node.js 18 o superior

### 1. Entorno Python

```bash
python -m venv venv
# Windows: .\venv\Scripts\activate
# Linux/Mac: source venv/bin/activate

pip install fastapi uvicorn sqlalchemy "passlib[bcrypt]" httpx python-dotenv grpcio grpcio-tools pydantic
```

### 2. Entorno Node.js (GraphQL)

```bash
npm install apollo-server-express express graphql axios dotenv
```

### 3. Configuración de Entorno (.env)

Crea un archivo `.env` en la raíz del proyecto para custodiar los secretos y rutas de integración:

```env
DATABASE_URL=sqlite:///./bigbite.db

# URLs de la red privada
CLIENTS_URL=http://localhost:8001/api/clients
INVENTORY_URL=http://localhost:8002/api/inventory
ORDERS_URL=http://localhost:8003/api/orders
PAYMENTS_URL=http://localhost:8004/api/payments
```

### 4. Migraciones y Seed

```bash
python seed.py
```

---

##  Ejecución

Levanta cada componente en su respectiva terminal (asegurando tener el entorno virtual activo):

```bash
# Microservicios Privados
uvicorn clients_service:app --port 8001
uvicorn inventory_service:app --port 8002
uvicorn orders_service:app --port 8003
uvicorn payment_service:app --port 8004

# API Gateway (Frontera Pública)
uvicorn api_gateway:app --port 8000

# GraphQL Gateway
node graphql_gateway.js

# Servicio gRPC
python grpc_server_analytics.py
```

---

##  Políticas de Seguridad Implementadas

- **Protección de Credenciales:** Hashing adaptativo con sal (`bcrypt` mediante `passlib`). Las contraseñas nunca se almacenan ni viajan en texto plano en la red privada.
- **Frontera de Confianza:** Los microservicios no exponen puertos al exterior; el API Gateway sanitiza el tráfico entrante.
- **Gestión de Secretos:** Ausencia de URLs internas o claves *hardcodeadas* en el código; todo se inyecta vía variables de entorno (`.env`).

---

## 🛠️ Stack Tecnológico

![Python](https://img.shields.io/badge/Python-3776AB?logo=python&logoColor=white)
![FastAPI](https://img.shields.io/badge/FastAPI-009688?logo=fastapi&logoColor=white)
![SQLAlchemy](https://img.shields.io/badge/SQLAlchemy-D71F00?logo=sqlalchemy&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-003B57?logo=sqlite&logoColor=white)
![Node.js](https://img.shields.io/badge/Node.js-339933?logo=node.js&logoColor=white)
![GraphQL](https://img.shields.io/badge/GraphQL-E10098?logo=graphql&logoColor=white)
![gRPC](https://img.shields.io/badge/gRPC-244c5a?logo=google&logoColor=white)