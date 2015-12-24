FROM ubuntu:14.04
RUN cd /opt
#RUN apt-get install wget -y
RUN wget http://dl.cnezsoft.com/zentao/pro5.0/ZenTaoPMS.Pro5.0.stable.zbox_64.tar.gz
#ADD README.md /opt/READEME.md
#ADD ZenTaoPMS.Pro5.0.stable.zbox_64.tar.gz /opt/

RUN tar zxvf ZenTaoPMS.Pro5.0.stable.zbox_64.tar.gz  -C /opt/
RUN /opt/zbox/zbox start
CMD ["tail", "-f", "/opt/zbox/logs/apache_access_log"]
#CMD ["/opt/zbox/zbox", "start"]
EXPOSE 80
