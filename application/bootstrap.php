<?php

require_once '../autoload.php';


$loader = new \PSR\Loader\Psr4AutoloaderClass;
$loader->register();
$loader->addNamespace('Team\Core', '../application/core');
$loader->addNamespace('Team\Controllers', '../application/controllers');
$loader->addNamespace('Team\Models\Blogic', '../application/models/blogic');
$loader->addNamespace('Team\Models\DB', '../application/models/data_base');

$loader->addNamespace('Team\Controllers\Pub', '../application/controllers/public');
$loader->addNamespace('Team\Controllers\Admin', '../application/controllers/admin');

$loader->addNamespace('Team\Controllers\Shared', '../application/controllers/shared');
$loader->addNamespace('Team\lib', '../application/lib');
$loader->addNamespace('Team\lib\PHPMailer', '../application/lib/PHPMailer');
$router = new Team\Core\Router();
//// запускаем маршрутизатор
$router->start();

