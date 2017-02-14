<?php
/**
 * Class SecurityHelper | core/SecurityHelper.class.php
 *
 * @package     Core\Helper
 * @author      Sandro Miguel Marques <sandromiguel@produlogia.com>
 * @version     v.1.2 (09/01/2017)
 * @copyright   Copyright (c) 2017, Sandro
 */

namespace Framework\Core;

/**
 * Class SecurityHelper - Helper
 *
 * Classe utilitária de segurança
 */

class SecurityHelper {

    /**
     * Gera a hash da palavra-passe.
     *
     * @version 1.0 (23/07/2016)
     *
     * @param string $plain_password Password em plain-text.
     *
     * @return string Devolve a hash da password.
     */
    public static function generatePasswordHash( $plain_password ){
        return password_hash($plain_password, PASSWORD_DEFAULT);
    }

    /**
     * Generate a secury token.
     *
     * This method is used to generate CSRF tokens, but can be used anywhere in your application where you need a secure random token.
     *
     * @version 1.0 (26/07/2016)
     *
     * @return string Devolve o token.
     */
    public static function generateToken() {
        return sha1(uniqid(mt_rand(), true));
    }

    /**
     * Verificar se a palavra-passe está correta.
     *
     * @version 1.0 (23/07/2016)
     *
     * @param string $password_plain Password em plain-text
     * @param $password_hash
     *
     * @return bool Devolve TRUE se a palavra-passe estiver correta, senão devolve FALSE.
     */
    public static function verifyPassword( $password_plain, $password_hash )     {
        return password_verify($password_plain, $password_hash);
    }

}