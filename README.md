<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Proyecto evaluacion GDA.

1- creamos el proyecto
composer create-project laravel/laravel:^9.0 api-customers

2 - instalamos el paquete composer require 
laravel/sanctum para trabajar los tokens.

3 - php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider" se publica la migracion del paquete sanctum

4 - creamos la base de datos api-customer con phpmyadmin

5- colocamos el nombre de la base de datos en el .env de nuestro archivo de registro.

6 - ejecutamos las migraciones de bd
php artisan migrate

7 - creamos los modelos de las tablas relacionales.
php artisan make:model Customer, region, comuna

8 - Creamos la ruta api: para listar a travez del cliente postman

9 - Definimos todas las rutas en el archivo api.php de la carpeta route

10 - creamos el controlador con el comando php artisan make:controller CustomerController

11 - creamos el controlador AuthController

12 - en phpmyadmin creamos todas las tablas con sus relaciones foreing-key con el diseñador del programa

13 - Todos los servicios estan protegidos por el middleware del paquete sanctum donde para cada accion se debe estar autenticado
y el token esta confugurado en sanctum para un tiempo de vida de una hora.

14 - cambiamos el valor de APP_DEBUG a false en el .env.

15 - para obtener los logs estos se guardan en el archivo storage/logs.

16 - para obtener la direccion ip lo hacemos en el controlador con el codigo siguiente ($clientIP = request()->ip();)


 












