# Instrucciones

Antes de empezar, debéis tener Docker instalado. Podéis descargar Docker Desktop en [`https://www.docker.com/products/docker-desktop/`](https://www.docker.com/products/docker-desktop/)

No modifiquéis el fichero `docker-compose.yml`

### Cómo poner en marcha el proyecto

Con la terminal, nos situamos en el directorio de este proyecto, y ejecutamos:

```console
$ docker compose up
```

### Probar la aplicación

Una vez el proyecto ha iniciado, podemos abrirlo en el navegador: [`localhost:8080/`](http://localhost:8080/)

A medida que desarrolléis las funcionalidades de esta actividad, id probando los cambios que hacéis.

### Consultar la base de datos

Si queremos ver el estado de la base de datos, podemos abrir phpmyadmin, navegando a: [`localhost:8081/`](http://localhost:8081/)

He modificado el `docker-compose.yml` para que al ejecujar $ docker compose up este ejecuta un script sql init.sql como se puede ver en el archivo yml "./init.sql:/docker-entrypoint-initdb.d/init.sql:ro". Creat una bbdd app_act3 y la tabla usuarios necesaria para la aplicación.
