<?php
/**
 * Class ArrayHelper | core/ArrayHelper.class.php
 *
 * @package     Core\Helper
 * @author      Sandro Miguel Marques <sandromiguel@produlogia.com>
 * @version     v.1.2 (09/01/2017)
 * @copyright   Copyright (c) 2017, Sandro
 */

namespace Framework\Core;

/**
 * Class ArrayHelper - Helper
 *
 * Classe utilitária para trabalhar com arrays
 */

class ArrayHelper {

    /**
     * Converte uma string de itens numa frase separada por vírgulas.
     * Ex.: a,b,c -> a, b and c
     *
     * @version 1.0 (06/07/2016)
     *
     * @param string $string    String de itens.
     * @param string $delimiter Caracter de separação (delimitador).
     * @param int    $id_lang   ID do idioma.
     *
     * @return string Devolve a lista.
     */
    public static function collectionToSentence($string, $delimiter, $id_lang) {
        $array = explode($delimiter, $string);
        $total_elements = count($array);
        $i = 0;
        $sentence = '';
        foreach ($array as $element) {
            $i++;
            if ( $i === 1 ) {
                // 1º elemento
                $sentence = $element;
            } else if ($i === $total_elements) {
                // último elemento
                switch ($id_lang) {
                    case 1:
                    case 2:
                        $and = 'e';
                        break;
                    case 3:
                        $and = 'and';
                        break;
                    default:
                        $and = 'and';
                        break;
                }
                $sentence .= ' '.$and.' '.$element;
            } else {
                // elemento intermédio
                $sentence .= ', '.$element;
            }
        }
        return $sentence;
    }

}