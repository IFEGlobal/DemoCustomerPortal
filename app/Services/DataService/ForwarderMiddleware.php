<?php

namespace App\Services\DataService;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class ForwarderMiddleware
{
    public $url;

    public $packet;

    private $key = "9b7110af-b03e-4fc0-a648-acae6ba70e13";

    public function __construct($url, $packet)
    {
        $this->url = $url;

        $this->packet = $packet;
    }

    public function SendData()
    {
        $headers = [
            'Accept-Encoding' => 'gzip, deflate, br',
            'Connection' => 'keep-alive',
            'Accept' => 'application/json',
            'APIKey' => $this->key,
        ];

        $response = Http::withoutVerifying()->withHeaders($headers)->withBody(json_encode($this->packet), 'application/json')->post($this->url);

        return json_decode($response->getBody()->getContents(), true);
    }

}
