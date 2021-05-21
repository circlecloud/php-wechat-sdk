<?php

namespace CircleCloud\WeChatSDK;

class ComponentClient extends Client
{
    public function getToken()
    {
        return $this->config['authorizer_access_token'];
    }
}
