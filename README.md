
# instrucciones de despliegue

## requisitos previos
> tener instalado la version de php php 7.3.23
> verificar que las extensiones pdo_sqlite y sqlite3 esten activadas


##### comandos
una vez clonado el repositorio y situado en la carpeta del proyecto ejecutamos el siguiente comando para instalar todas las dependencias del proyecto y se llenan las bd

``````
	composer install
    php artisan migrate --seed
``````

## Lanzar en modo de Desarrollo

Ejecute `php artisan serve --port=8080` para un servidor de desarrollo. Vaya a `http://localhost:8080/`.


## lanzar a produccion

la carpeta del proyecto debe ser colocada en el servidor en la carpeta public.
