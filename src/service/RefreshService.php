<?php

namespace Stream\Service;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Route;
use function GuzzleHttp\Psr7\build_query;

class RefreshService
{
    /**
     * @var string
     */
    private $authUri = 'https://id.twitch.tv/oauth2/';
    
    /**
     * @var string
     */
    private $config;
    
    /**
     * @var Client
     */
    private $client;
    
    /**
     * RefreshService constructor.
     * @param Client $client
     * @param array $config
     */
    public function __construct(Client $client, array $config)
    {
        $this->client = $client;
        $this->config = $config;
    }
    
    /**
     * @return string
     */
    public function getAuthUri()
    {
        $query = build_query([
            'client_id'     => $this->config['client_id'],
            'redirect_uri'  => $this->config['redirect_uri'],
            'force_verify'  => true,
            'response_type' => 'code',
            'state'         => md5(microtime())
        ], PHP_QUERY_RFC1738);
        
        return \sprintf('%sauthorize?%s&scope=%s', $this->authUri, $query, 'user_read+user_follows_edit');
    }
    
    /**
     * @param string $code
     * @return string
     */
    public function getToken(string $code)
    {
        $query = build_query([
            'client_id'     => $this->config['client_id'],
            'client_secret' => $this->config['secret'],
            'code'          => $code,
            'grant_type'    => 'authorization_code',
            'redirect_uri'  => $this->config['redirect_uri']
        ]);
        $response = $this->client->post(\sprintf('%stoken?%s', $this->authUri, $query));
        
        if ($response->getStatusCode() == 200) {
            $result = \json_decode($response->getBody()->getContents(), true);
            \setcookie('access_token', $result['access_token'] ?? '', time() + (int)$result['expires_in'] ?? 0, '/');
            \setcookie('refresh_token', $result['refresh_token'] ?? '', 0, '/');
            
            return $result['access_token'] ?? '';
        }
        
        return '';
    }
    
    /**
     * @param Request $request
     * @param Response $response
     * @param Route $next
     * @return Response
     * @throws \Exception
     */
    public function checkToken(Request $request, Response $response, Route $next)
    {
        if (empty($request->getCookieParams()['access_token']) && empty($request->getCookieParams()['refresh_token'])) {
            return $response->withStatus(301)->withHeader('Location', '/home');
        } else if (empty($request->getCookieParams()['access_token'])) {
            $this->refreshToken($request->getCookieParams()['refresh_token']);
        }
        
        return $next($request, $response);
    }
    
    /**
     * @param string $refreshToken
     * @return string
     */
    private function refreshToken(string $refreshToken)
    {
        $query = build_query([
            'client_id'     => $this->config['client_id'],
            'client_secret' => $this->config['secret'],
            'refresh_token' => $refreshToken,
            'grant_type'    => 'refresh_token',
        ]);
        $response = $this->client->post(\sprintf('%stoken?%s', $this->authUri, $query));
        
        if ($response->getStatusCode() == 200) {
            $result = \json_decode($response->getBody()->getContents(), true);
            setcookie('access_token', $result['access_token'] ?? '', time() + (int)$result['expires_in'] ?? 0, '/');
            
            return $result['access_token'] ?? '';
        }
        
        return '';
    }
}
