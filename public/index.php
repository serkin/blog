<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require __DIR__.'/../autoload.php';

$config = include __DIR__.'/../app/config.php';
$app = new Application($config);

$request = Request::createFromGlobals();

$response = $app->handle($request);

$app->terminate($response);
