#!/bin/bash
#############################################################################################################
#   Ciaado por: Fagne Tolentino Reges
#   Data: 30/09/2024
#   Versão: 1.0
#   Última modificação: 14/10/2024
#   Descrição: Script para criar os container docker de acordo com o ambiente de desenvolvimento ou produção.
#     
#############################################################################################################


# Define o comando adicional (com ou sem --build)
BUILD_OPTION=""
if [[ "$1" == "--build" ]]; then
  BUILD_OPTION="--build"
fi

# Carrega as variáveis do arquivo .env
export $(grep -v '^#' .env | xargs)

# Verifica qual comando Docker Compose está disponível (docker-compose ou docker compose)
if command -v docker compose &> /dev/null; then
  COMPOSE_COMMAND="docker compose"
elif command -v docker &> /dev/null && docker compose version &> /dev/null; then
  COMPOSE_COMMAND="docker-compose"
else
  echo "Nenhum comando válido do Docker Compose encontrado."
  exit 1
fi


if [[ "$APP_ENV" == "production" ]]; then
  if [[ ! -f ".docker/docker-compose-prod.yml" ]]; then
    echo "Arquivo .docker/docker-compose-prod.yml não encontrado."
    exit 1
  fi
  $COMPOSE_COMMAND  -f .docker/docker-compose-prod.yml up -d $BUILD_OPTION
else
  if [[ ! -f ".docker/docker-compose-dev.yml" ]]; then
    echo "Arquivo .docker/docker-compose-dev.yml não encontrado."
    exit 1
  fi
  $COMPOSE_COMMAND  -f .docker/docker-compose-dev.yml up -d $BUILD_OPTION
fi
