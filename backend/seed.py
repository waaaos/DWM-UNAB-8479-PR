from database import SessionLocal
from models import ProductoDB

def poblar_inventario():
    db = SessionLocal()
    
    # Verificamos si ya hay productos para no duplicarlos
    if db.query(ProductoDB).count() == 0:
        productos_iniciales = [
            {"nombre": "Hamburguesa Clásica", "precio": 7500, "categoria": "Hamburguesas"},
            {"nombre": "Hamburguesa Doble Big", "precio": 9900, "categoria": "Hamburguesas"},
            {"nombre": "Hamburguesa Vegana", "precio": 8500, "categoria": "Hamburguesas"},
            {"nombre": "Porción de Papas", "precio": 6000, "categoria": "Acompañamientos"},
            {"nombre": "Lata Coca-Cola 350cc", "precio": 2000, "categoria": "Bebidas"}
        ]
        
        for p in productos_iniciales:
            nuevo_producto = ProductoDB(
                nombre=p["nombre"],
                precio=p["precio"],
                categoria=p["categoria"]
            )
            db.add(nuevo_producto)
            
        db.commit()
        print("¡Catálogo insertado con éxito en la base de datos!")
    else:
        print("La base de datos ya tiene productos.")
        
    db.close()

if __name__ == "__main__":
    poblar_inventario()