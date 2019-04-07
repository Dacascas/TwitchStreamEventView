<?php

namespace Stream\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class PingController
{
    public function indexAction(Request $request, Response $response)
    {
        $response->getBody()->write('Pong');

        return $response;
    }
}
