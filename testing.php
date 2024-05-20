<?php
date_default_timezone_set('America/Guayaquil');
$date = date('Ymd-');
$time = date('hisA');
$formattedTime = strtolower(substr($time, 0, -2)) . substr($time, -2);

echo $date . $formattedTime;
