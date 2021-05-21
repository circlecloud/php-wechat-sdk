<?php

namespace CircleCloud\WeChatSDK\General;

use CircleCloud\WeChatSDK\Client;

class Menu
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
        return $this->client->get('menu/get?access_token='.$this->client->getToken());
    }

    public function getCurrentSelfmenuInfo()
    {
        return $this->client->get('get_current_selfmenu_info?access_token='.$this->client->getToken());
    }

    /**
     * @param mixed $button
     */
    public function create($button)
    {
        return $this->client->post('menu/create?access_token='.$this->client->getToken(), ['button' => $button]);
    }

    /**
     * "matchrule": {
     *     "tag_id": "2",
     *     "sex": "1",
     *     "country": "中国",
     *     "province": "广东",
     *     "city": "广州",
     *     "client_platform_type": "2",
     *     "language": "zh_CN"
     * }.
     *
     * @param mixed $button
     * @param mixed $matchRule 匹配规则
     */
    public function addConditional($button, $matchRule)
    {
        return $this->client->post('menu/addconditional?access_token='.$this->client->getToken(), ['button' => $button, 'matchrule' => $matchRule]);
    }

    public function delConditional($menuid)
    {
        return $this->client->post('menu/delconditional?access_token='.$this->client->getToken(), ['menuid' => $menuid]);
    }
}
