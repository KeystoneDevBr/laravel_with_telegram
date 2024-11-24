
# Passo a Passo para Instalar o SQL Server Localmente no Projeto
## Descomentar a parte referente ao SQL erver no arquivo docker-compose-dev.yml
## Configura o arquivo .env
```
#CONFIGURAÇÃO INICAL DO ARQUIVO .env
DB_CONNECTION=sqlsrv
DB4_HOST=sqlsrv
DB4_PORT=2150
DB4_DATABASE=DB_APP
DB4_USERNAME=SA #novo_usuario
DB4_PASSWORD=Senha@Forte
DB4_PREFIX=painel_compras_
DB4_ENCRYPT=no
DB4_TRUST_SERVER_CERTIFICATE=true
```

## Acessar o Container APP ou o Container SQLSRV realizar a primeira conexão
## A primeira conexão deve ser usando o usuário SA, que é criado padrão (A partir do container app ou sqlsrv)
```
/opt/mssql-tools18/bin/sqlcmd -S sqlsrv,2150 -U SA  -P "Senha@Forte" -C 

```
### Alterar o Usuário Padrão
```
ALTER LOGIN SA  WITH NAME = novo_usuario;
go;
quit;
```

### Validar conexão
```
/opt/mssql-tools18/bin/sqlcmd -S sqlsrv,2150 -U novo_usuario  -P "Senha@Forte" -C 
```

### Criar a Base de Dados
```
CREATE DATABASE DB_APP
go
```

## Alterara o novo usuário no arquivo .env

```
DB4_USERNAME=novo_usuario
```

## Checar a conexão do laravel com o Banco de dados
````
php artisan config:cache
php artisan db:show --database=sqlsrv
```