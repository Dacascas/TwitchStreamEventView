<?php

$c = $app->getContainer();
$c['ping.controller'] = function($c) {
    return new \Stream\controller\PingController();
};
$c['home.controller'] = function($c) {
    return new \Stream\controller\HomeController($c['renderer'], $c['twitch.service']);
};
$c['auth.controller'] = function($c) use ($config) {
    return new \Stream\controller\AuthController($c['refresh.service'], $c['twitch.service'], $c['renderer']);
};
$c['stream.controller'] = function($c) {
    return new \Stream\controller\StreamController($c['renderer'], $c['twitch.service']);
};
$c['lib.http_client'] = function () {
    return new \GuzzleHttp\Client();
};
$c['refresh.service'] = function () use ($c, $config) {
    return new \Stream\Service\RefreshService($c['lib.http_client'], $config['twitch.options']);
};
$c['twitch.service'] = function () use ($c, $config) {
    return new \Stream\Service\TwitchService($c['lib.http_client'], $config['twitch.options']['client_id']);
};

$c['renderer'] = new \Slim\Views\PhpRenderer(__DIR__ . '/../../src/template');
