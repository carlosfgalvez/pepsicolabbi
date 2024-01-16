# README #

Sitio web - Innovación Encuestas

URL's
DEV: https://dev-mx-labbi.pepmx.com
STG: https://stg-mx-labbi.pepmx.com
PROD: https://labbi.com.mx

## Requerimientos

 - MySQL 5.7
 - PHP >= 7.4.*
 - CodeIgniter 4.*
 - OpenSSL 1.1.1   (scan de seguridad recomendación)

## Instalación

## Clonar repositorio

> https://bitbucket.org/pepsicomx/labbi_com_mx_innovacion_mx_01112023/branch/development

## BD
1.Entrar a la consola de Mysql o algun administrador de Base de Datos con un usuario root
2.Crear Base de Datos <BD_INNOVACION>
3.Crear usuario <USER_INNOVACIOM>
4.Asignar usuario <USER_INNOVACIOM> a la base de datos <BD_INNOVACION> y asignar todos los privilegios sobre la base de datos
5.Conectarse a la base de datos  <BD_INNOVACION>

#### Creación tablas de la BD
6.Ejecutar script: mysql -h [host] -u [user] -p[pass] -D [base de datps] < bd/script_structure_create.sql

6.2 Ejecutar script: mysql -h [host] -u [user] -p[pass] -D [base de datps] < bd/script_structure_create_v3.sql

#### Creación funcion de la BD
7.1.Ejecutar script: mysql -h [host] -u [user] -p[pass] -D [base de datps] < bd/script_function_drop.sql

7.2.Ejecutar script: mysql -h [host] -u [user] -p[pass] -D [base de datps] < bd/script_function_create_v2.sql

#### Creación vista de la BD
8.1 Ejecutar script: mysql -h [host] -u [user] -p[pass] -D [base de datps] < bd/script_view_drop.sql

8.2 Ejecutar script: mysql -h [host] -u [user] -p[pass] -D [base de datps] < bd/script_view_create_v2.sql

#### Insert de los datos, se agregó un COMMIT al final del script
9.1 Ejecutar script: mysql -h [host] -u [user] -p[pass] -D [base de datps] < bd/script_data_delete.sql

9.2 Ejecutar script: mysql -h [host] -u [user] -p[pass] -D [base de datps] < bd/script_data_insert_v4.sql

9.3 Ejecutar script: mysql -h [host] -u [user] -p[pass] -D [base de datps] < bd/script_data_pregunta12.sql

9.4 Ejecutar script: mysql -h [host] -u [user] -p[pass] -D [base de datps] < bd/script_data_pregunta_7y12.sql

9.5 Ejecutar script: mysql -h [host] -u [user] -p[pass] -D [base de datps] < bd/script_data_nuevapregunta5.sql


#### ARCHIVIVOS DE CONFIG

## BD ACCESOS: PEPSICO-Innovacion
#### Editar el archivo html/.env
database.default.hostname = "<servidor de bd>"
database.default.database = "<BD_PROMODORITOS>"
database.default.username = "<USER_PROMODORITOS>"
database.default.password = "<PASS_PROMODORITOS>"
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = <Puerto>

## URL Sitio
#### Editar el archivo html/.env
app.baseURL == '<url del sitio>';

## Email accesos cambiar las siguientes lineas con los accesos del correo saliente
#### Editar el archivo html/app/Config/Config.php
public string $email_contacto    = "<CORREO DE PRODUCCION>";

## ELB y autoscalling
#### Editar el archivo html/app/Config/App.php
public array $proxyIPs = [<IPs de los proxys separadas por comas>];
public array $trustedProxies = [<Agregar sub red de los proxys>];

#### Editar el archivo html/app/Config/Email.php
public string $SMTPHost = '<host>';
public string $SMTPUser = 'carlos.galvez@oetcapital.com';
public string $SMTPPass = '<password>';
public int $SMTPPort = <puerto>;

#### Editar el archivo html/app/Config/Boot/development.php y cambiar de true a false
defined('CI_DEBUG') || define('CI_DEBUG', false);

#### PERMISOS
#### Permisos de archivos
find . -type f -exec chmod 640 {} html\;

#### Permisos de carpetas
find . -type d -exec chmod 750 {} html\;

#### Permisos carpeta especial para la carpeta \public
find . -type d -exec chmod 770 {} html\public;

#### Permisos de archivos especial para los archivos \public
find . -type f -exec chmod 660 {} html\public;

#### Permisos carpeta especial para la carpeta \public\ui (css, imagenes, js, etc)
find . -type d -exec chmod 770 {} html\public\ui;

#### Permisos carpeta especial para los archivos \public\ui (css, imagenes, js, etc)
find . -type f -exec chmod 660 {} html\public\ui;

#### Permisos carpeta especial para la carpeta de \public\uploads
find . -type d -exec chmod 770 {} html\public\uploads;

#### Permisos carpeta especial para los archivos de \public\uploads
find . -type f -exec chmod 660 {} html\public\uploads;

#### Permisos carpeta writable:
#### \writable
find . -type d -exec chmod 770 {} html\writable;

#### Permisos de archivos
find . -type f -exec chmod 660 {} html\writable;

#### Archivo PHP de inicio
html\index.php


#### ----------------------------------------------------------
#### PUNTOS PARA CORREGIR SCAN DE SEGURIDAD#1 08.11.2023
#### ----------------------------------------------------------

## .htaccess
#### se agregaron estas dos líneas 40 y 41 en el archivo:
#### Header always set X-Frame-Options DENY
#### Header always set Content-Security-Policy "frame-ancestors 'none'"
Reemplazar el archivo: html\.htaccess

## Session Expiration Time
#### Editar el archivo html/app/Config/Session.php para asignar 0 al tiempo de expiración
public int $expiration = 0;

#### ----------------------------------------------------------
#### PUNTOS PARA CORREGIR SCAN DE SEGURIDAD#2 16.11.2023
#### ----------------------------------------------------------
## Keys para al algorimo de encriptación
#### Editar el archivo html/app/Config/Encryption.php, línea 74, 82 y 91
public string $encryptKeyInfo = 'M0nte#';
public string $authKeyInfo = 'R0ra1ma$';
public string $cipher = 'AES-256-CBC';
