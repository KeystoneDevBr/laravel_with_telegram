FROM nginx:1.27.0

# Copia os arquivos de configuração
ADD default.conf /etc/nginx/conf.d/default.conf
ADD nginx.conf /etc/nginx/nginx.conf

# Arquivo crontab para renovar o certificado HTTP automaticamente
ADD crontab.sh /opt/crontab.sh
RUN chmod +x /opt/crontab.sh

# Instala o openssl para gerar o certificado RSA
RUN apt-get update && apt-get install -y openssl cron;

# Criação de certificados auto-assinados RSA
# Aprenda mais em:  https://github.com/KeystoneDevBr/learn_cryptography/tree/main/Cap_9/Cap_14
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
-subj '/C=BB/ST=Distrito Federal/L=Brasilia/O=KeystoneDevBr/OU=Divisao de Criptografia/CN=keystonedevbr.com.br/emailAddress=fagne.developer@gmail.com' \
-addext "subjectAltName=DNS:keystonedevbr.com.br" \
-keyout /etc/ssl/private/nginx-selfsigned.key \
-out /etc/ssl/certs/nginx-selfsigned.crt

# Timezone Config
ENV TZ=${TZ}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

#Teste de execução a cada 2 minutos
# RUN echo "*/2 * * * * /bin/bash /opt/crontab.sh" | crontab -     
# Executa às 05 horas todos os dias
RUN echo "0 5 * * * /bin/bash /opt/crontab.sh" | crontab -   

# Prepara o arquivo entrypoint do nginx para executar o crontab
RUN echo '#!/bin/bash\n\ncron && /docker-entrypoint.sh "$@"' >> entrypoint-wrapper.sh && \
    chmod +x /entrypoint-wrapper.sh

ENTRYPOINT ["/entrypoint-wrapper.sh"]

# Executa o Nginx quando o container iniciar
CMD ["nginx", "-g", "daemon off;"]