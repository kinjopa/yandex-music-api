<?php
include 'client.php';
include 'command.php';
include 'set_account.php';

/** @var  $client */
$search = $_GET['search'];
$result = $client->search($search, false,'all',0);
$tracks_search = $result->tracks->results;