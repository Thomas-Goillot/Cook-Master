<?php
function dump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

/** 
 * Calcul si faut mettre un s ou pas
 * @param int $number
 * @return string
 */
function plural(int $number): string
{
    if ($number > 1) {
        return "s";
    }
    return "";
}
?>