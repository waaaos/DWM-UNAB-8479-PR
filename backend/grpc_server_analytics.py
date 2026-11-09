import grpc
from concurrent import futures
import time
import tracking_pb2, tracking_pb2_grpc

class DeliveryTrackerServicer(tracking_pb2_grpc.DeliveryTrackerServicer):
    def TrackOrder(self, request, context):
        estados = [("En cocina", "Local"), ("En camino", "Avenida"), ("Entregado", "Domicilio")]
        for estado, ubicacion in estados:
            if not context.is_active(): break
            yield tracking_pb2.DeliveryStatus(estado=estado, ubicacion=ubicacion, timestamp=str(time.time()))
            time.sleep(2)

def serve():
    server = grpc.server(futures.ThreadPoolExecutor(max_workers=10))
    tracking_pb2_grpc.add_DeliveryTrackerServicer_to_server(DeliveryTrackerServicer(), server)
    server.add_insecure_port('[::]:50051')
    server.start()
    server.wait_for_termination()

if __name__ == '__main__': serve()