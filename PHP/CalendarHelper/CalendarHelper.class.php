<?php
/**
 * Class CalendarHelper | core/CalendarHelper.class.php
 *
 * @package     Core\Helper
 * @author      Sandro Miguel Marques <sandromiguel@produlogia.com>
 * @version     v.1.0.1 (14/02/2017)
 * @copyright   Copyright (c) 2017, Sandro
 */

declare(strict_types=1);

namespace Franework\Core;

/**
 * Class CalendarHelper - Helper
 *
 * Classe utilitária para datas
 */

class CalendarHelper {

    /**
     * Data formatada num determinado idioma.
     *
     * @version 1.0.1 (14/02/2017)
     *
     * @param string    $date       Data.
     * @param int       $id_lang    ID do idioma.
     *
     * @return string Data formatada.
     */
    public static function getDateFormated(string $date, int $id_lang) : string {
        $date_formated 	= strtotime($date);
        $date_formated 	= getdate($date_formated);
        $date_day 		= $date_formated['mday'];
        $date_month 	= self::getMonthNameAbbreviated($date_formated['mon'], $id_lang);
        $date_year 		= $date_formated['year'];
        return $date_month . ' ' . $date_day .  ', ' . $date_year;
    }

    /**
     * Data/hora formatada num determinado idioma.
     *
     * @version 1.0.1 (14/02/2017)
     *
     * @param string 	$date_time	Data e hora.
     * @param int 		$id_lang 	ID do idioma.
     *
     * @return string Data/hora formatada.
     */
    public static function getDateTimeFormated(string $date_time, int $id_lang) : string {
        $date_formated 	= strtotime($date_time);
        $date_formated 	= getdate($date_formated);
        $date_day 		= $date_formated['mday'];
        $date_month 	= self::getMonthNameAbbreviated($date_formated['mon'], $id_lang);
        $date_year 		= $date_formated['year'];
        $time_hours		= $date_formated['hours'];
        $time_minutes	= $date_formated['minutes'];
        return $date_month . ' ' . $date_day .  ', ' . $date_year . '&nbsp;&nbsp;' . $time_hours . ':'. $time_minutes;
    }

    /**
     * Nome do mês num determinado idioma.
     *
     * @version 2.0.1 (14/02/2017)
     *
     * @param int $month_numeric 	Número do mês.
     * @param int $id_lang 			ID do idioma.
     *
     * @return string Nome do mês.
     */
    public static function getMonthName(int $month_numeric, int $id_lang) : string {
        $index_lang = $id_lang-1;
        $index_month = $month_numeric-1;
        $month = array(
            array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'),
            array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'),
            array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',)
        );
        return $month[$index_lang][$index_month];
    }

    /**
     * Nome do mês abreviado num determinado idioma.
     *
     * @version 2.0.1 (14/02/2017)
     *
     * @param int $month_numeric 	Número do mês.
     * @param int $id_lang 			ID do idioma.
     *
     * @return string Nome do mês.
     */
    private static function getMonthNameAbbreviated(int $month_numeric, int $id_lang) : string {
        $index_lang = $id_lang-1;
        $index_month = $month_numeric-1;
        $month = array(
            array('Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'),
            array('Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'),
            array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec',)
        );
        return $month[$index_lang][$index_month];
    }

    /**
     * Feriados portuguêses (Web Service)
     *
     * @link https://store.services.sapo.pt/pt/cat/catalog/utility/free-api-holiday SAPO services - Holiday API
     *
     * @version 1.0.1 (14/02/2017)
     * 
     * @param int $year Ano para obter os feriados
     *
     * @return array Devolve todos os feriados nacionais para um determinado ano.
     */
    public static function getNationalHolidays(int $year) : array {
        $context = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
        $url = 'http://services.sapo.pt/Holiday/GetNationalHolidays?year=' . $year;
        $xml = file_get_contents($url, false, $context);
        $xml = simplexml_load_string($xml);
        $nacional_holidays = array();
        foreach ($xml as $x) {
            foreach ($x as $x1) {
                $nacional_holidays[] = array(
                    'nome' => (string) $x1->Name,
                    'data' => substr($x1->Date, 0, -9)
                );
            }
        }
        // Adicionar os 4 feriados que foram repostos
        $nacional_holidays[] = array(
            'nome' => 'Corpo de Deus',
            'data' => $year.'-06-15'
        );
        $nacional_holidays[] = array(
            'nome' => 'Implantação da República',
            'data' => $year.'-10-05'
        );
        $nacional_holidays[] = array(
            'nome' => 'Dia de Todos os Santos',
            'data' => $year.'-11-01'
        );
        $nacional_holidays[] = array(
            'nome' => 'Dia da Restauração da Independência',
            'data' => $year.'-12-01'
        );
        return $nacional_holidays;
    }

}