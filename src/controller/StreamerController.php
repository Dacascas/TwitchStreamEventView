<?php

namespace Stream\controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\PhpRenderer;
use Stream\service\TwitchService;

class StreamerController
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
    public function listFavoriteAction(Request $request, Response $response)
    {
        return $this->renderer->render(
            $response,
            'home/list.php',
            [
                'list' => $this->twitchService->getListFollowUser($request->getCookieParams()['user_id'])
            ]
        );
    }
    
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getFavoriteAction(Request $request, Response $response)
    {
        var_dump($request->getBody()->getContents());
        return $this->renderer->render(
            $response,
            'streamer/item.php',
            [
                'channelName' => $request->getQueryParams('name')
            ]
        );
    }
}
