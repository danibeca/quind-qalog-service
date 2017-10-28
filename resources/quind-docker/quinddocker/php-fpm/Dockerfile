FROM phpdockerio/php71-fpm:latest
WORKDIR "/quind"


# Install git
RUN apt-get update \
    && apt-get -y install php7.1-mbstring \
    && apt-get -y install git \
    && apt-get -y install composer \
    && apt-get install -y rsyslog \
    && apt-get install -y cron \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*


COPY quind.conf /quind.conf
COPY client.sh /client.sh
RUN chmod 755 /client.sh
RUN /client.sh
COPY config.sh /config.sh
RUN chmod 755 /config.sh
RUN /config.sh
ADD crontab /etc/cron.d/quind-cron
RUN chmod 0644 /etc/cron.d/quind-cron
RUN touch /var/log/cron.log
CMD ["cron", "-f"]

