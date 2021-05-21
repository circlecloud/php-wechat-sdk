<?php

namespace CircleCloud\WeChatSDK\General;

use CircleCloud\WeChatSDK\Client;

class User
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function info($openid)
    {
        return $this->client->get('user/info?access_token='.$this->client->getToken()."&openid={$openid}&lang=zh_CN");
    }

    public function get($next_openid)
    {
        return $this->client->get('user/get?access_token='.$this->client->getToken()."&next_openid={$next_openid}");
    }
}
