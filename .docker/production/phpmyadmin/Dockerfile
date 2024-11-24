FROM phpmyadmin/phpmyadmin


# Instala o openssl para gerar o certificado RSA
RUN apt-get update && apt-get install -y openssl cron;


# Criação de certificados auto-assinados RSA
# Aprenda mais em:  https://github.com/KeystoneDevBr/learn_cryptography/tree/main/Cap_9/Cap_14
RUN openssl req -x509 -nodes -days 3650 -newkey rsa:2048 \
-subj '/C=BB/ST=Distrito Federal/L=Brasilia/O=KeystoneDevBr/OU=Divisao de Criptografia/CN=keystonedevbr.com.br/emailAddress=fagne.developer@gmail.com' \
-addext "subjectAltName=DNS:keystonedevbr.com.br" \
-keyout /etc/ssl/private/apache2-selfsigned.key \
-out /etc/ssl/certs/apache2-selfsigned.crt

# Timezone Config
ENV TZ=${TZ}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Define o valor do host, para o arquivo 000-default.conf
ENV APP_HOST=${APP_HOST}

# Copia os arquivos de configuração
ADD 000-default.conf /etc/apache2/sites-available/000-default.conf
ADD default-ssl.conf /etc/apache2/sites-available/default-ssl.conf


RUN a2enmod ssl && a2ensite default-ssl.conf

EXPOSE 8080