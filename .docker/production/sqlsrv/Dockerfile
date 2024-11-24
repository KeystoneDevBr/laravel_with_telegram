# Exemplo adaptado de: https://raw.githubusercontent.com/microsoft/mssql-docker/master/linux/preview/examples/mssql-server-linux-non-root/Dockerfile
FROM mcr.microsoft.com/mssql/server:2022-latest

USER root
RUN apt-get update
RUN apt-get install -yq curl apt-transport-https gnupg
# Adiciona o Repositório da MS
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && curl https://packages.microsoft.com/config/ubuntu/22.04/mssql-server-2022.list | tee /etc/apt/sources.list.d/mssql-server-2022.list
# Instala o SQL Server
RUN apt-get update
RUN apt-get install -y mssql-server-fts
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

USER $USER

EXPOSE ${MSSQL_TCP_PORT}

# Definir o comando de entrada
CMD ["/opt/mssql/bin/sqlservr"]