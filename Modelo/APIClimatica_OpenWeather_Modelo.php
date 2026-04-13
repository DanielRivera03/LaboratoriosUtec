<?php
     /*************************************************
    +------------------------------------------------+
    |   CONTROL DE LABORATORIOS FICA - UTEC 2023     |
    +------------------------------------------------+
    |          VERSION 1.0 [FEB - MAY 2023]          |
    |     ❤ HECHO CON MUCHAS TAZAS DE CAFE ❤        |
    +------------------------------------------------+
    **************************************************/

/*******************************************************************************
*        -> DATOS METEREOLOGICOS OBTENIDOS DESDE: https://openweathermap.org/
*            MAYOR INFORMACION, VISITAR DOCUMENTACION OFICIAL.
*******************************************************************************/
setlocale(LC_TIME, "spanish");
date_default_timezone_set('America/El_Salvador');
$ApiKey = "65df6868e6a724921cd07e8a77105c8a"; // API KEY PERSONAL
$IDCiudad = "3583361"; // SAN SALVADOR
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $IDCiudad . "&lang=en&units=metric&APPID=" . $ApiKey;
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response);
$currentTime = time();
