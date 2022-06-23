<?php
global $privateConfig;
$token = "";

$login = $_SESSION['logged_user']['email'];
//НЕ БЕЗОПАСНОЕ ХРАНЕНИЯ ПАРОЛЯ! ИСПОЛЬЗУЕТСЯ ДЛЯ ТЕСТА
$password = $_SESSION['pass'];

$client = new Client($token);
$command = new command($token);
$account = $client->getAccount();
if ($account == null) {
    $client->fromCredentials($login, $password, true);
}