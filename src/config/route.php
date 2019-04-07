<?php

$app->get('/ping', 'ping.controller:indexAction');
$app->get('/auth', 'auth.controller:indexAction');
$app->get('/auth/redirect', 'auth.controller:redirectAction');
$app->get('/home', 'home.controller:indexAction')->add('refresh.service:checkToken');
$app->post('/home', 'home.controller:indexAction')->add('refresh.service:checkToken');
$app->get('/streamer', 'home.controller:getFavoriteAction')->add('refresh.service:checkToken');