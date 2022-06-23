<?php
include 'client.php';
include 'command.php';
include 'set_account.php';

/** @var  $client */

$playlist = $client->usersPlaylistsList();

$data = $client->getLikes('track');
$tracks = $data->tracks;


