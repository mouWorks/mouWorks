# Seems not using...
## Use official Image
#FROM nginx
#
#COPY ./default_nginx.conf /etc/nginx/conf.d/default.conf
#
#
#RUN mkdir -p ./
#
##COPY ./LindyHopperTaipei ./LindyHopperTaipei
## Copy index.php Over
#ADD index.php /var/www/
#
## Expose 8080 to external
#EXPOSE 8080
#
## Work Dir
#WORKDIR /var/www/
#
## Default Command After Container Start Running
#ENTRYPOINT ["php", "-S", "0.0.0.0:8080"]