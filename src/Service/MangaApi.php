<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class MangaApi {

    private string $apiBaseURL;
    private $client;

    public function __construct( string $api_base_url, HttpClientInterface $client) {
        $this->apiBaseURL = $api_base_url;
        $this->client = $client; 
    }

    public function fetch(string $query) {

        $url = $this->apiBaseURL . '/search';
        
        $res = $this->client->request(
            'GET',
            $url,
            [ 'query' => [ 
                'query' => $query,
                'length' => 1,
                'type' => 'manga'
                ] 
            ]
        );

        $results = json_decode($res->getContent());

        if (!is_array($results) || count($results) < 1) return null;
        
        return $results[0];
    }
}