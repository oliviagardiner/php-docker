<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Slim\Container;

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();

/** @var Container $container */
$container = require_once __DIR__ . '/app/bootstrap.php';

return ConsoleRunner::createHelperSet($container->get(EntityManager::class));
