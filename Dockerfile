FROM ubuntu:14.04
RUN cd /opt
RUN apt-get install wget -y
RUN wget http://dl.cnezsoft.com/zentao/pro5.0/ZenTaoPMS.Pro5.0.stable.zbox_64.tar.gz
RUN tar zxvf ZenTaoPMS.Pro5.0.stable.zbox_64.tar.gz  -C /opt/
#RUN cd /opt/zbox/auth
#RUN ./adduser.sh
#RUN echo 'admin'
#RUN echo '123456'
RUN /opt/zbox/zbox start
#RUN /bin/sh -c "while true; do echo hello world; sleep 1; done"
#cd
EXPOSE 80