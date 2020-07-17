# # [joseainsa81](https://github.com/joseainsa81) / **[Passwords](https://github.com/joseainsa81/Passwords)**

Buenos días.  
Esta es una clase para el manejo de las contraseñas en php.

En esta clase se usan las funciones de hashing de contraseñas de php. [Más info](https://www.php.net/manual/es/ref.password.php).  
Para generar el hash se usa PASSWORD_BCRYPT que tiene una limitación de 72 caracteres.

Conforme vayan actualizando las versiones de php iré actualizando la clase.  
Si tienes cualquier duda, comentario, si encuentras algún error o si consideras que se puede mejorar esta clase no dudes en ponerte en contacto conmigo.

# Instalación
Esta clase está disponible en [Packagist](https://packagist.org/packages/joseainsa81/passwords) y su instalación vía [Composer](https://getcomposer.org) es la recomendada. Solo añade esta línea a tu archivo `composer.json`:

```json
"joseainsa81/passwords": "*"
```

o vía terminal ejecutando:

```sh
composer require joseainsa81/passwords
```

Alternativamente, si no estás utilizando Composer, copia el contenido de la carpeta [src](https://github.com/joseainsa81/Passwords/tree/master/src "src") en tu proyecto y carga la clase [Passwords.php](https://github.com/joseainsa81/Passwords/blob/master/src/Passwords.php "Passwords.php") manualmente:

```php
<?php
use joseainsa81\Passwords\Passwords;
require 'path/to/src/Passwords.php';
```
# Documentación de uso y ejemplos

## Generar un hash

Para generar un hash se llama a la función `Passwords::hash($password);`.  
Este hash será lo que guardemos en base de datos para comprobar la contraseña de usuario.

```php
<?php
$password = 'Contraseña';
$hash = Passwords::hash($password);
```

## Comprobar un hash con una contraseña

Para comprobar una contraseña usaremos la función `Passwords::verify($password, $hash);`.

```php
<?php
$password = 'Contraseña';
$hash = '$2y$10$0R.qqk1RhV6Pi0FXccC/ReMFhns30eeJwVc8f/qPz2DlpwQC6ptIa';
$check = Passwords::verify($password, $hash);
if($check){
    // Contraseña correcta
} else {
    // Contraseña incorrecta
}
```

## Comprobar si el hash necesita volver a crearse

Para comprobar si el hash facilitado coincide con las opciones de la clase se usa `Passwords::needsRehash($hash);`.

```php
<?php
$hash = '$2y$10$0R.qqk1RhV6Pi0FXccC/ReMFhns30eeJwVc8f/qPz2DlpwQC6ptIa';
$check = Passwords::needsRehash($hash);
if($check){
    // Necesita volver a crearse
} else {
    // No hay nada que hacer
}
```

## Obtener información sobre un hash

Para obtener información sobre un hash podemos usar la función `Passwords::getInfo($hash);`.

```php
<?php
$hash = '$2y$10$0R.qqk1RhV6Pi0FXccC/ReMFhns30eeJwVc8f/qPz2DlpwQC6ptIa ';
$info_array = Passwords::getInfo($hash);
```

## Evaluar el servidor y determinar el coste de creación

Podemos evaluar el servidor y determinar el coste de creación `Passwords::calculateCost();`.

```php
<?php
$coste_int = Passwords::calculateCost();
```

## Modificar el coste de creación

Podemos modificar el valor por defecto de la clase del coste de creación `Passwords::setCost($coste_int);`.

```php
<?php
Passwords::setCost($coste_int);

```
