#!/usr/bin/env php
<?php

date_default_timezone_set('UTC');

set_time_limit(0);

(@include_once __DIR__ . '/../vendor/autoload.php') || @include_once __DIR__ . '/../../../autoload.php';

use Symfony\Component\Console\Application;
use Odt\Command\CafCommand;

$app = new Application('Application CLI CAF', '0.1.0');

use Silex\Provider\MonologServiceProvider;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$app->register(new MonologServiceProvider(), [
    'monolog.logfile' => 'log/file.log',
]);

//extend monolog
$app->extend('monolog', function ($monolog, $app) {
    $monolog->pushHandler(new StreamHandler('/log/other.log', Logger::DEBUG));
    return $monolog;
});

$app->addCommands(array(
	new CafCommand()

));



$app->run();
