<?php
include 'client.php';
include 'command.php';
include 'set_account.php';

/** @var  $client */

$charts = $client->landing('chart');
$tracks = $charts->blocks[0]->entities;