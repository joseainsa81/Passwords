<?php

/**
 * Passwords - Clase para el manejo de contraseñas
 *
 * @author    José Julián Aínsa Gutiérrez <joseainsa81@gmail.com>
 * @license   //creativecommons.org/licenses/by/4.0/legalcode.es CC BY 4.0
 * @note      Este programa se distribuye con la esperanza de que sea de 
 * utilidad, pero SIN NINGUNA GARANTÍA; ni siquiera la garantía implícita
 * de COMERCIABILIDAD o APTITUD PARA UN PROPÓSITO EN PARTICULAR.
 * @version   v.1.0.0 (2020-01-01)
 */

namespace joseainsa81\Passwords;

/**
 * Clase para el manejo de contraseñas
 *
 */
class Passwords
{

    /**
     * Constante del algoritmo de contraseñas indicando qué algoritmo utilizar para crear el hash de la contraseña
     * 
     * @var int
     */
    private static $algo = PASSWORD_DEFAULT;
    /**
     * Un array asociativo de opciones. Actualmente solo se pasa el coste.
     * 
     * @var array
     */
    private static $options = ['cost' => 10];

    /**
     * Crea un hash de contraseña
     *
     * @see https://www.php.net/manual/es/function.password-hash.php
     * @param string $password La contraseña del usuario
     * @return string Hash de la contraseña
     */
    public static function hash($password)
    {
        return password_hash($password, self::$algo, self::$options);
    }

    /**
     * Devuelve información sobre el hash proporcionado
     *
     * @see https://www.php.net/manual/es/function.password-get-info.php
     * @param string $hash Un hash creado por password_hash()
     * @return array Información sobre la contraseña
     */
    public static function getInfo($hash)
    {
        return password_get_info($hash);
    }

    /**
     * Comprueba si el hash facilitado coincide con las opciones proporcionadas
     *
     * @see https://www.php.net/manual/es/function.password-needs-rehash.php
     * @param string $hash Un hash creado por password_hash()
     * @return bool  Devuelve TRUE si el hash debe ser generado de nuevo
     */
    public static function needsRehash($hash)
    {
        return password_needs_rehash($hash, self::$algo, self::$options);
    }

    /**
     * Comprueba que la contraseña coincida con un hash
     *
     * @param string $password La contraseña del usuario.
     * @param string $hash Un hash creado por password_hash()
     * @return bool Devuelve TRUE si la contraseña y el hash coinciden, o FALSE de lo contrario
     */
    public static function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }

    /**
     * Evaluará el servidor para determinar el coste permitido
     *
     * @return int El coste de generación de contraseña para un tiempo de 50 milisegundos
     */
    public static function calculateCost()
    {
        $timeTarget = 0.05; // 50 milisegundos

        $coste = 8;
        do {
            $coste++;
            $inicio = microtime(true);
            password_hash("test", self::$algo, ["cost" => $coste]);
            $fin = microtime(true);
        } while (($fin - $inicio) < $timeTarget);

        return $coste;
    }
}
