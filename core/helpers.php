<?php
function base_url($path = '') {
    return BASE_URL . $path;
}

function calculate_time_span($date){
        
    date_default_timezone_set('Europe/Paris'); 

    $seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($date);
    $years = floor($seconds / (3600*24*30*12));
    $months = floor($seconds / (3600*24*30));
    $day = floor($seconds / (3600*24));
    $hours = floor($seconds/ 3600);
    $mins = floor($seconds / 60);
    $secs = floor($seconds % 60);
    if($months > 12) $time = $years." année(s)";
    else if ($day > 31) $time = $months." mois";
    else if ($hours > 24) $time = $day." jour(s)";
    else if ($mins > 60) $time = $hours." heure(s)";
    else if ($seconds > 60) $time = $mins." minute(s)";
    else $time = $secs." seconde(s)";

    return $time;
}
?>
