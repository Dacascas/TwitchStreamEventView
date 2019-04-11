<?php

namespace Stream\service;

use GuzzleHttp\Client;

class TwitchService
{
    /**
     * @var string
     */
    private $krakenUri = 'https://api.twitch.tv/kraken/';
    
    /**
     * @var Client
     */
    private $client;
    
    /**
     * @var string
     */
    private $client_id;
    
    /**
     * TwitchService constructor.
     * @param Client $client
     * @param string $client_id
     */
    public function __construct(Client $client, string $client_id)
    {
        $this->client = $client;
        $this->client_id = $client_id;
    }
    
    /**
     * @param string $token
     * @return array|mixed
     */
    public function getUserByToken(string $token): array
    {
        $response = $this->client->get($this->krakenUri . '/user', [
            'headers' => [
                'Client-ID'     => $this->client_id,
                'Accept'        => 'application/vnd.twitchtv.v5+json',
                'Authorization' => 'OAuth ' . $token
            ]]);
        
        if ($response->getStatusCode() == 200) {
            $result = \json_decode($response->getBody()->getContents(), true);
            
            if (!empty($result['_id'])) {
                return $result;
            }
        }
        
        return [];
    }
    
    /**
     * @param string $name
     * @return array
     */
    public function getUserByName(string $name): array
    {
        try {
            $response = $this->client->get($this->krakenUri .'users?login=' . $name, [
                    'headers' => [
                        'Client-ID' => $this->client_id,
                        'Accept'    => 'application/vnd.twitchtv.v5+json'
                    ]]
            );
            
            if ($response->getStatusCode() == 200) {
                $result = \json_decode($response->getBody()->getContents(), true);
                
                if ($result['_total'] > 0) {
                    return $result['users'][0];
                }
            }
        } catch (\Throwable $e) {
        }
        
        return [];
    }
    
    /**
     * @param string $followerId
     * @param string $followedId
     * @param string $token
     * @return bool
     */
    public function addFollowUser(?string $followerId, ?string $followedId, string $token): bool
    {
        try {
            $this->client->put(
                \sprintf('%susers/%d/follows/channels/%d', $this->krakenUri, $followerId, $followedId),
                [
                    'headers' => [
                        'Client-ID'     => $this->client_id,
                        'Accept'        => 'application/vnd.twitchtv.v5+json',
                        'Authorization' => 'OAuth ' . $token
                    ],
                    'form_params' => ['notifications' => true]
                ]
            );
        } catch (\Throwable $exception) {
            return false;
        }
        
        return true;
    }
    
    /**
     * @param string $followerId
     * @return array
     */
    public function getListFollowUser(string $followerId): array
    {
        try {
            $response = $this->client->get(
                \sprintf('%susers/%d/follows/channels', $this->krakenUri, $followerId),
                [
                    'headers' => [
                        'Client-ID' => $this->client_id,
                        'Accept'    => 'application/vnd.twitchtv.v5+json',
                    ]
                ]
            );
            
            if ($response->getStatusCode() == 200) {
                $result = \json_decode($response->getBody()->getContents(), true);
                
                if ($result['_total'] > 0) {
                    return $result['follows'];
                }
            }
        } catch (\Throwable $exception) {
            return [];
        }
        
        return [];
    }
}
