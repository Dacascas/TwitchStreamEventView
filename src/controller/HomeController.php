<?php

namespace Stream\controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use Stream\service\TwitchService;

class HomeController
{
    /**
     * @var PhpRenderer
     */
    private $renderer;
    
    /**
     * @var TwitchService
     */
    private $twitchService;
    
    /**
     * HomeController constructor.
     * @param PhpRenderer $render
     * @param TwitchService $twitchService
     */
    public function __construct(PhpRenderer $render, TwitchService $twitchService)
    {
        $this->twitchService = $twitchService;
        $this->renderer = $render;
    }
    
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function indexAction(Request $request, Response $response)
    {
        if (empty(($request->getCookieParams()['access_token']))) {
            return $response->withStatus(301)->withHeader('Location', '/auth');
        }
        
        $message = '';
        
        if (!empty($request->getParsedBody()['streamer-name'])) {
            $user = $this->twitchService->getUserByName($request->getParsedBody()['streamer-name']);
            
            $message = 'Added to favorite';
            
            if (empty($user)) {
                $message = 'User doesn\'t exist';
            }
            
            if (!$this->twitchService->addFollowUser(
                $request->getCookieParams()['user_id'],
                $user['_id'],
                $request->getCookieParams()['access_token'])
            ) {
                $message = 'User doesn\'t added to favorite';
            }
        }
        
        return $this->renderer->render($response, 'home/favorite.php', ['message' => $message]);
    }
    
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getFavoriteAction(Request $request, Response $response)
    {
        return $this->renderer->render(
            $response,
            'home/list.php',
            [
                'list' => $this->twitchService->getListFollowUser($request->getCookieParams()['user_id'])
            ]
        );
    }
}
