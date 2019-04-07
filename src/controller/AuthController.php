<?php

namespace Stream\Controller;

use GuzzleHttp\Client;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Response;
use Slim\Views\PhpRenderer;
use Stream\Service\RefreshService;
use Stream\service\TwitchService;

class AuthController
{
    /**
     * @var Client
     */
    private $refreshService;
    
    /**
     * @var TwitchService
     */
    private $twitchService;
    
    /**
     * @var PhpRenderer
     */
    private $renderer;
    
    /**
     * AuthController constructor.
     * @param RefreshService $refreshService
     * @param TwitchService $twitchService
     * @param PhpRenderer $render
     */
    public function __construct(RefreshService $refreshService, TwitchService $twitchService, PhpRenderer $render) {
        $this->refreshService = $refreshService;
        $this->twitchService = $twitchService;
        $this->renderer = $render;
    }
    
    /**
     * @param Request $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return mixed
     */
    public function indexAction(Request $request, Response $response)
    {
        return $this->renderer->render(
            $response,
            'home/hello.php',
            [
                'url' => $this->refreshService->getAuthUri()
            ]
        );
    }
    
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function redirectAction(Request $request, Response $response)
    {
        if (!empty($request->getQueryParams()['code'])) {
            try {
                $token = $this->refreshService->getToken($request->getQueryParams()['code']);
                
                if ($token) {
                    $user = $this->twitchService->getUserByToken($token);
                    setcookie('user_id', $user['_id'], 0, '/');
                    
                    return $response->withStatus(301)
                        ->withHeader('Location', '/home');
                }
            } catch (\Throwable $exception) {
            }
        }
        
        return $response->withStatus(301)->withHeader('Location', '/home');
    }
}