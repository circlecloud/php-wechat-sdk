<?php

namespace CircleCloud\WeChatSDK\General;

use CircleCloud\WeChatSDK\Client;

class Tags
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get()
    {
        return $this->client->get('tags/get?access_token='.$this->client->getToken());
    }
}
