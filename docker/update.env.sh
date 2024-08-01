#!/bin/bash

PROJECT_ENV_FILE="../.env"
DOCKER_ENV_FILE=".env"

if [ ! -f "$DOCKER_ENV_FILE" ]; then
    echo "docker/.env is missing, copying from docker/.env.example..."
    cp .env.example .env
fi

if [ ! -f "$PROJECT_ENV_FILE" ]; then
    echo "application .env is missing, copying from .env.example..."
    cp ../.env.example ../.env
fi
