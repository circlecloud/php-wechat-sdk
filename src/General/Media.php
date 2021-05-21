<?php

namespace CircleCloud\WeChatSDK\General;

use CircleCloud\WeChatSDK\Client;
use GuzzleHttp\Psr7;

class Media
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get($media_id)
    {
        return $this->client->get("media/get?access_token={$this->client->getToken()}&media_id={$media_id}");
    }

    public function upload($file, $type = 'image')
    {
        return $this->client->form(
            "media/upload?access_token={$this->client->getToken()}&type={$type}",
            [
                'name' => 'media',
                'contents' => Psr7\Utils::tryFopen($file, 'r'),
            ]
        );
    }
}
