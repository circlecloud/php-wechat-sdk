<?php

namespace CircleCloud\WeChatSDK\General;

use CircleCloud\WeChatSDK\Client;

class Message
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getCurrentAutoreplyInfo()
    {
        return $this->client->get('get_current_autoreply_info?access_token='.$this->client->getToken());
    }

    public function customTyping($touser, $command)
    {
        return $this->client->post('message/custom/typing?access_token='.$this->client->getToken(), [
            'touser' => $touser,
            'command' => $command,
        ]);
    }

    public function customSend($touser, $msgType, $body)
    {
        return $this->client->post('message/custom/send?access_token='.$this->client->getToken(), [
            'touser' => $touser,
            'msgtype' => $msgType,
            $msgType => $body,
        ]);
    }

    /**
     * 发送模板消息.
     *
     * @param mixed $touser      接受用户
     * @param mixed $templateId  模板ID
     * @param mixed $data        模板数据
     * @param mixed $url         跳转地址
     * @param mixed $miniprogram 跳转小程序
     */
    public function templateSend($touser, $templateId, $data, $url = '', $miniprogram = [])
    {
        return $this->client->post('message/template/send?access_token='.$this->client->getToken(), [
            'touser' => $touser,
            'template_id' => $templateId,
            'url' => $url,
            'miniprogram' => $miniprogram,
            'data' => $data,
        ]);
    }
}
