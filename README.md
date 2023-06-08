<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Uaem_Morelos_logo.png/1200px-Uaem_Morelos_logo.png" width="400" alt="UAEM Logo"></a></p>

<p align="left">
  <img src="https://img.shields.io/badge/STATUS-EN%20DESAROLLO-green">
</p>

## Sobre esta aplicacion

Este sitio web fue creada para el departamento de gestión y evaluación de la Universidad Autónoma del Estado de Morelos con el objetivo de poder gestionar y generar archivos históricos de los módulos de Acuerdos del Consejo Universitario y Formato 911.

## ¿Cómo lo ejecuto en local?

Necesitarás tener instalado `Node.js` a partir de la versión 14, tener un servidor web local, como por ejemplo: `XAMP`, `WAMP`, `Laragon`, etc. y tener acceso a una terminal para seguir los siguientes pasos:

Instalar las dependencias de JavaScript

```
npm install
```

Instalar las dependencias de PHP

```
composer install
```

Crear el archivo .env y agregar la configuración de la `Base de Datos`

```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uaem_database
DB_USERNAME=root
DB_PASSWORD=
```

Generar una clave

> La clave de aplicación es una cadena aleatoria almacenada en la clave APP KEY dentro del archivo .env. Notarás que también falta.
> Para crear la nueva clave e insertarla automáticamente en el .env, ejecutaremos:

```
php artisan key:generate
```

Levantar el entorno de desarrollo

```
npm run dev
```

Ejecutar el proyecto de manera local

```
npm run dev
```

## :hammer: Funcionalidades del proyecto

- `Crear`: Permite al usuario crear registros.
- `Eliminar`: Permite al usuario eliminar registros.
- `Editar`: Permite al usuario editar registros.
- `Mostrar`: Permite al usuario mostrar registros.
- `Importar`: Permite al usuario importar registros de forma masiva desde un documento Excel.
- `Exportar`: Permite al usuario exportar registros en formato Excel o PDF.
- `Generar reportes`: Permite al usuario generar reportes de registros de un periodo determinado.

## :computer: Tecnologías utilizadas

- `PHP 8`
- `Laravel 10`
- `JavaScript`
- `Tailwind`
- `Alpine JS`
