<?php

require '../vendor/autoload.php';

$config = require_once '../src/config/config.php';
$app = new \Slim\App(['settings' => $config]);

require_once '../src/config/route.php';
require_once '../src/config/di.php';

$app->run();