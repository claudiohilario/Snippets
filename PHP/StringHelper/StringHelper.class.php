<?php
/**
 * Class StringHelper | core/StringHelper.class.php
 *
 * @package     Core\Helper
 * @author      Sandro Miguel Marques <sandromiguel@produlogia.com>
 * @version     v.1.6 (09/01/2017)
 * @copyright   Copyright (c) 2017, Sandro
 */

namespace Framework\Core;

/**
 * Class StringHelper - Helper
 *
 * Classe utilitária para trabalhar com strings
 */

class StringHelper {

    /**
     * Gera um conjunto de letras aleatórias.
     * Gera um conjunto de letras aleatórias através de outro conjunto de letras predefinidas.
     * O conjunto de letras foi escolhido de forma a terem uma fácil leitura e evitar confusões com outros carateres.
     * Opcionalmente, é possível definir o número de letras a ser gerado
     *
     * @version 1.1 (04/08/2016)
     *
     * @param int     $length   Número de letras a gerar.
     * @param string  $charset  Conjunto de caracteres permitidos.
     *
     * @todo Alterar o nome para getRandomReadableChars ou adicionar mais um parâmetro que define se é para usar, ou não, caracteres legíveis (readable_chars=FALSE).
     *
     * @return string Conjunto de letras aleatórias.
     */
    public static function getRandomChars($length, $charset=NULL) {
        if ( is_null($charset) ) {
            $charset = "ABCEFHJKMNPQRSTUVWXYZ";
        }
        $string = substr(str_shuffle(str_repeat($charset, $length)), 0, $length);
        return $string;
    }

    /**
     * Gera um conjunto de carateres aleatórios.
     *
     * @version 1.0 (06/07/2016)
     *
     * @param int $length Número de carateres a gerar.
     *
     * @return string Conjunto de carateres aleatórios.
     */
    public static function getRandomKey($length) {
      //
        $max = ceil($length / 40);
        $random = '';
        for ($i=0; $i<$max; $i++) {
            $random .= sha1(microtime(true).mt_rand(10000,90000));
        }
        return substr($random, 0, $length);
    }

    /**
     * Wrapper for "strtoupper" function to support UTF8 strings.
     * Método strToUpper() do XCart.
     *
     * @version 1.0 (28/07/2016)
     *
     * @param string $string   String
     * @param string $encoding Encoding (OPTIONAL)
     *
     * @return string Devolve a string em maiúsculas.
     */
    public static function strToUpper($string, $encoding = 'UTF-8') {
        return (function_exists('mb_strtoupper'))
            ? mb_strtoupper($string, $encoding)
            : strtoupper($string);
    }

    /**
     * Wrapper for "strtolower" function to support UTF8 strings.
     *
     * @version 1.0 (03/09/2016)
     *
     * @param string $string   String
     * @param string $encoding Encoding (OPTIONAL)
     *
     * @return string Devolve a string em minúsculas.
     */
    public static function strToLower($string, $encoding = 'UTF-8') {
        return (function_exists('mb_strtolower'))
            ? mb_strtolower($string, $encoding)
            : strtolower($string);
    }

    /**
     * Converte a string para um slug.
     *
     * @version 1.0 (09/10/2016)
     *
     * @param string $string String
     *
     * @return string Devolve o slug.
     */
    public static function toSlug($string) {
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
        return $clean;
    }

}
