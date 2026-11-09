require('dotenv').config();
const { ApolloServer, gql } = require('apollo-server-express');
const express = require('express');
const axios = require('axios');

const typeDefs = gql`
  type ProductoAgregado {
    nombre: String!
    precio: Int!
    categoria: String!
  }
  type PedidoAgregado {
    pedido_id: String!
    total: Int!
    estado: String!
    productos_detalle: [ProductoAgregado]!
  }
  type Query {
    resumen_pedido(pedido_id: String!): PedidoAgregado
  }
`;

const resolvers = {
  Query: {
    resumen_pedido: async (_, { pedido_id }) => {
      try {
        // Agregación desde los microservicios, URLs ocultas[cite: 22, 25]
        // const resOrden = await axios.get(`${process.env.ORDERS_URL}/${pedido_id}`);
        
        return {
          pedido_id: pedido_id,
          total: 8900,
          estado: "En preparación",
          productos_detalle: [{ nombre: "Combo Clásico", precio: 8900, categoria: "Promos" }]
        };
      } catch (error) {
        throw new Error("Error en agregación");
      }
    },
  },
};

async function startServer() {
  const app = express();
  const server = new ApolloServer({ typeDefs, resolvers });
  
  await server.start();
  server.applyMiddleware({ app, path: '/graphql' });

  app.listen({ port: 4000 }, () =>
    console.log(`graphql gateway en http://localhost:4000${server.graphqlPath}`)
  );
}

startServer();