<?php

namespace CircleCloud\WeChatSDK\General;

use CircleCloud\WeChatSDK\Client;

class QrCode
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function strScene($scene_str, $expire_seconds = 300)
    {
        return $this->client->post(
            'qrcode/create?access_token='.$this->client->getToken(),
            [
                'expire_seconds' => $expire_seconds,
                'action_name' => 'QR_STR_SCENE',
                'action_info' => [
                    'scene' => [
                        'scene_str' => $scene_str,
                    ],
                ],
            ]
        );
    }

    public function limitStrScene($scene_str)
    {
        return $this->client->post(
            'qrcode/create?access_token='.$this->client->getToken(),
            [
                'action_name' => 'QR_LIMIT_STR_SCENE',
                'action_info' => [
                    'scene' => [
                        'scene_str' => $scene_str,
                    ],
                ],
            ]
        );
    }
}
