#!/bin/bash

# Create the RSA Certificates
/bin/openssl req -x509 -nodes -days 365 -newkey rsa:2048 -subj '/C=BB/ST=Distrito Federal/L=Brasilia/O=KeystoneDevBr/OU=Divisao de Criptografia/CN=keystonedevbr.com.br/emailAddress=fagne.developer@gmail.com' -addext "subjectAltName=DNS:keystonedevbr.com.br" -keyout /etc/ssl/private/nginx-selfsigned.key -out /etc/ssl/certs/nginx-selfsigned.crt ;

# Relad web server
/sbin/nginx -s reload
