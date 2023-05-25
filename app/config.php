<?php

define('APP_ROOT', __DIR__ . '/..');

use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$doctrine = [
    'env' => 'dev',
    'cache_dir' => APP_ROOT . '/var/www/doctrine',
    'metadata_dirs' => [APP_ROOT . '/src/Entity'],
    'connection' => [
        'driver' => 'pdo_mysql',
        'host' => $_ENV['DB_HOST'],
        'port' => $_ENV['DB_PORT'],
        'dbname' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

return [
    EntityManager::class => function () use ($doctrine): EntityManager {
        $devMode = $doctrine['env'] !== 'prod';

        // Use the ArrayAdapter or the FilesystemAdapter depending on the value of the 'dev_mode' setting
        // You can substitute the FilesystemAdapter for any other cache you prefer from the symfony/cache library
        $cache = $devMode ?
            DoctrineProvider::wrap(new ArrayAdapter()) :
            DoctrineProvider::wrap(new FilesystemAdapter(directory: $doctrine['cache_dir']));

        $config = Setup::createAttributeMetadataConfiguration(
            $doctrine['metadata_dirs'],
            $devMode,
            null,
            $cache
        );

        $conn = DriverManager::getConnection($doctrine['connection'], $config);

        return EntityManager::create($conn, $config);
    }
];
