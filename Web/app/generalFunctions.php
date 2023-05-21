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

/**
 * Display fancy statut for courses
 * @param int $statut
 * @return string
 */
function fancyStatut(int $statut): string
{
    switch ($statut) {
        case COURSES_REQUEST:
            return "<span class='text-warning'>En attente</span>";
        case COURSES_PAYED:
            return "<span class='text-info'>Payé</span>";
        case COURSES_ACCEPTED:
            return "<span class='text-success'>Accepté</span>";
        case COURSES_REFUSED:
            return "<span class='text-danger'>Refusé</span>";
        case COURSES_ARCHIVED:
            return "<span class='text-secondary'>Archivé</span>";
        case COURSES_IS_IN_PROGRESS:
            return "<span class='text-primary'>En cours</span>";
        default:
            return "<span class='text-warning'>En attente</span>";
    }
}


?>