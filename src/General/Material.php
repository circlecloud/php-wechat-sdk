<?php

namespace CircleCloud\WeChatSDK\General;

use CircleCloud\WeChatSDK\Client;

class Material
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function batchgetMaterial($type = 'image', $offset = 0, $count = 20)
    {
        return $this->client->post('material/batchget_material?access_token='.$this->client->getToken(), [
            'type' => $type,
            'offset' => $offset,
            'count' => $count,
        ]);
    }
}
