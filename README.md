# Nachhilfeportal

a project of students from HTL Rennweg

## Setup

To start the NP container, the external container "jwilder/nginx-proxy" is required. In case you don't want to run it or just want to run a single web page on your server, you can change the docker-compose.yml to expose the ports (Note: You will still have to use a proxy in order to use SSL encryption).

### Setup jwilder/nginx-proxy docker-compose.yml

```yml
version: '2'
services:
  nginx-proxy:
   restart: always
   container_name: nginx
   image: jwilder/nginx-proxy
   ports:
    - "80:80"
    - "443:443"
   volumes:
    - "/etc/nginx/vhost.d"
    - "/usr/share/nginx/html"
    - "/var/run/docker.sock:/tmp/docker.sock:ro"
    - "./certs:/etc/nginx/certs"
    - ./custom.conf:/etc/nginx/conf.d/custom.conf:ro
   environment:
      DEFAULT_HOST: invalid-domain.strukteon.net
  letsencrypt-nginx-proxy-companion:
   restart: always
   container_name: nginx_sidecar_letsencrypt
   image: jrcs/letsencrypt-nginx-proxy-companion
   volumes:
    - "/var/run/docker.sock:/var/run/docker.sock:ro"
    - "/etc/acme.sh"
   volumes_from:
    - "nginx-proxy"

networks:
 default:
  external:
    name: letsencrypt
```

### Start the nginx sidecar
```bash
docker-compose up -d
```


### Clone and start NP docker container
```bash
git clone https://github.com/strukteon/Nachhilfeportal
cd Nachhilfeportal
docker-compose up -d
```
