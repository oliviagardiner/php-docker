<?php

use DI\Container;
use DI\Slim\App;

/** @var Container */
$container = require_once __DIR__ . '/../app/bootstrap.php';

/** @var App */
$app = require_once __DIR__ . '/routes.php';

$app->run();
