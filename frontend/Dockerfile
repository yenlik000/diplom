## Stage 1 — build
FROM node:20-alpine AS builder

WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

## Stage 2 — serve
FROM nginx:alpine

# Copy built assets into /diplom/ so URL path == filesystem path
COPY --from=builder /app/dist /usr/share/nginx/html/diplom

# Nginx config: serve SPA under /diplom/ and proxy /api → backend
COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80
