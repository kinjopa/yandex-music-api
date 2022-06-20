<?php

$curl = curl_init();
$search = $_GET['search'];

curl_setopt_array($curl, [
    CURLOPT_URL => "https://shazam.p.rapidapi.com/search?term='.$search.'&locale=ru-RU&offset=0&limit=5",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: shazam.p.rapidapi.com",
        "X-RapidAPI-Key: 1c9ff5b2e7msh35567b204fa4418p1e6dafjsn83df7dd9a7a4"
    ],
]);

$response = curl_exec($curl);
$data_search = json_decode($response, true);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
}