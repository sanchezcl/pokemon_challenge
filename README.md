# Agree Pokemon Challenge

Este Challenge fue desarrollado en PHP con el Framwork Lumen.



### Pre-requisitos 📋

Para instalar correctamente el proyecto es necesario tener instalado docker y docker-compose correctamente

### Instalación 🔧

Clonar el repositorio 

```
git clone --recursive git@github.com:sanchezcl/pokemon_challenge.git
## --recursive permite que se descarguen los submodulos del proyecto
```

El submodulo little-laradock es una version simplificada de Laradock un docker prearmado para proyectos con Laravel/Lumen
Entrar en la carpeta del little-laradock
```
cd little-laradock
```

Copiar el archivo de configuracion del little-laradock .env-example como .env
```
 cp .env-example .env
```

Verificar que las siguientes variables tenga los valores listados:
```
APP_CODE_PATH_HOST=../code
.
.
.
MYSQL_DATABASE=agree
MYSQL_USER=default
MYSQL_PASSWORD=secret
MYSQL_PORT=3306
```

Modificar la configuracion en el nginx editando nginx/sites/default.conf editando 'server_name' 
:
```
    server_name agm.test;
```

Agregar al final del archivo /etc/hosts la url agm.test
```
    127.0.0.1 agm.test
```

Haber un build con el docker-compose, puedes ir a tomar una :coffee:	
```
docker-compose build mysql nginx workspace
```

Una vez finalice levantar los containers
```
docker-compose up -d mysql nginx workspace
```

Luego entrar al container workspace:
```
# el nombre del container (laradock_workspace_1) puede cambiar,
# asegurarse que es el correcto

docker exec -itu 1000  laradock_workspace_1 bash
```

Copiar el archivo .env.example del proyecto de lumen
```
cp .env.example .env
```

Editar en el proyecto de lumen el .env con las siguientes variables y valores
```
APP_NAME=agree-challenge
.
.
.
APP_URL=http://agm.test
.
.
.
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=default
DB_USERNAME=default
DB_PASSWORD=secret
```

Hacer la instalacion de los paquetes con composer:
```
composer install
```

Ejecutar las migraciones y seeders con los datos de ejemplo
```
artisan migrate --seed
```

(Opcional) Importar las colleccoines que se usaron para el desarrollo en postman


## Ejecutando las pruebas

Los test se pueden ejecutar entrando al container workspace y ejecutando:
```
phpunit tests/
```

## Documentacion

Las colleciones de postman se encuentran en la carpeta "documents"

La documentacion con swagger se encuentra en la ruta:
```
agm.test/api/documentation
```

Endpoint principal 
```
https://lit-lake-49375.herokuapp.com/
```
