# ¿Qué hace esta aplicación?

Es un gestor de trámites administrativos que se usa para gestionar:
- Ayudas y de subvenciones para el servicio de política industrial del IDI
- Proceso de adhesión al programa ILS (Industria Local Sostenible) del IDI 
- Ayudas IDI-ISBA (en construcción)

# El entorno de producción se encuentra en 

[tramits.idi.es/public] (https://tramits.idi.es/public)

# El entorno de pre-preducción se encuentra en 

[pre-tramits.idi.es/public] [https://pre-tramits.idi.es/public]

# CodeIgniter 4 Framework

es el framework utilizado para desarrollar la aplicación

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible, and secure. 
More information can be found at the [official site](http://codeigniter.com).

This repository holds the distributable version of the framework,
including the user guide. It has been built from the 
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/). 


## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!
The user guide updating and deployment is a bit awkward at the moment, but we are working on it!

## Repository Management

We use Github issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script. 
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/contributing.md) section in the development repository.

## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed: 

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)

# MySql

es el gestor de base de datos utilizado para esta aplicación

el usuario y contraseña se obtienen del correo electrónico corporativo. Antes deben haber sido previamente dados de alta como usuarios habilitados. No todos los correos electrónicos corporativos tienen acceso

# La firma electrónica

Para realizar la firma de los distintos actos administrativos, se ha contratado una plataforma de firma VIAFIRMA [www.viafirma.com](https://www.viafirma.com) y se ha realizado una integración con ella vía REST API.

# Los entornos de trabajo (PRE y PRO)

 - ENTORNO PRUEBAS  
        define("REST_API_URL", "https://testservices.viafirma.com/inbox/api/v3/");
        define("REST_API_KEY", "dev_idi");
        define("REST_API_PASS", "V3CBFZVZS6THXSWZG9HL3AFF06KD4NGAQHGXGF6Y");


 - ENTORNO PRODUCCIÓN
        define("REST_API_URL", "https://inbox.viafirma.com/inbox/api/v3/");
        define("REST_API_KEY", "viafirma");
        define("REST_API_PASS", "HXN91O5HBYNUNGVRVTQKBFXWDLPIOMBPKIBSJNCC");


