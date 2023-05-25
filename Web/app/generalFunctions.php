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
        case COURSES_IS_IN_PROGRESS:
            return "<span class='text-primary'>En cours</span>";
        case COURSES_IS_DONE:
            return "<span class='text-success'>Terminé</span>";
        case COURSES_ARCHIVED:
            return "<span class='text-secondary'>Archivé</span>";
        default:
            return "<span class='text-warning'>En attente</span>";
    }
}

/**
 * Calculate number of days between two dates
 * @param string $date1
 * @param string $date2
 * @return int
 */
function dateDiff(string $date1, string $date2): int
{
    //calcul le nombre de jours entre deux dates (la valeur peux etre négative si la date1 est supérieur à la date2)
    $date1 = strtotime($date1);
    $date2 = strtotime($date2);
    $nbJoursTimestamp = $date1 - $date2;
    return round($nbJoursTimestamp / (60 * 60 * 24));
}

/**
 * Disaply fancy number of days between two dates
 */
function fancyDateDiff(int $days): string
{
    if ($days === 0) {
        return "Aujourd'hui";
    } else if ($days === 1) {
        return "Demain";
    } else if ($days === 2) {
        return "Après demain";
    } else if ($days === -1) {
        return "Hier";
    } else if ($days === -2) {
        return "Avant hier";
    } else if ($days > 0) {
        return "Dans " . $days . " jour" . plural($days);
    } else if ($days < 0) {
        return "Il y a " . abs($days) . " jour" . plural($days);
    }

    return "";
}


?>