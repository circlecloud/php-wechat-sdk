<?php

namespace CircleCloud\WeChatSDK\Component;

use CircleCloud\WeChatSDK\Cache;
use CircleCloud\WeChatSDK\Client;

class Component
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getComponentToken()
    {
        $cache = Cache::getComponentToken();
        if (!$cache) {
            $config = $this->client->getConfig();
            $result = $this->client->post('component/api_component_token', [
                'component_appid' => $config['component_appid'],
                'component_appsecret' => $config['component_appsecret'],
                'component_verify_ticket' => Cache::getTicket(),
            ]);
            Cache::setComponentToken($cache = $result->component_access_token, $result->expires_in - 300);
        }

        return $cache;
    }

    public function getPreAuthCode()
    {
        $config = $this->client->getConfig();
        $result = $this->client->post(
            'component/api_create_preauthcode?'.
                'component_access_token='.$this->getComponentToken(),
            [
                'component_appid' => $config['clientid'],
            ]
        );

        return $result->pre_auth_code;
    }

    public function queryAuth($authorization_code)
    {
        $config = $this->client->getConfig();

        return $this->client->post(
            'component/api_query_auth?'.
                'component_access_token='.$this->getComponentToken(),
            [
                'component_appid' => $config['clientid'],
                'authorization_code' => $authorization_code,
            ]
        );
    }

    public function getAuthorizerToken($appid)
    {
        $cache = Cache::getAuthorizerToken($appid);
        if (!$cache) {
            $info = Cache::getAuthorizationInfo($appid);
            if (!$info) {
                throw new \Exception("应用 {$appid} 未授权!");
            }
            $config = $this->client->getConfig();
            $result = $this->client->post(
                'component/api_authorizer_token?'.
                'component_access_token='.$this->getComponentToken(),
                [
                    'component_appid' => $config['clientid'],
                    'authorizer_appid' => $appid,
                    'authorizer_refresh_token' => $info->authorizer_refresh_token,
                ]
            );
            Cache::setAuthorizerToken($appid, $cache = $result->authorizer_access_token, $result->expires_in - 300);
            $info->authorizer_refresh_token = $result->authorizer_refresh_token;
            $info = Cache::setAuthorizationInfo($appid, $info);
        }

        return $cache;
    }

    public function fastRegisterWeappCreate($name, $code, $code_type, $legal_persona_wechat, $legal_persona_name, $component_phone)
    {
        return $this->client->post(
            'component/fastregisterweapp?action=create&'.
            'component_access_token='.$this->getComponentToken(),
            [
                'name' => $name, // 企业名
                'code' => $code, // 企业代码
                'code_type' => $code_type, // 企业代码类型（1：统一社会信用代码， 2：组织机构代码，3：营业执照注册号）
                'legal_persona_wechat' => $legal_persona_wechat, // 法人微信
                'legal_persona_name' => $legal_persona_name, // 法人姓名
                'component_phone' => $component_phone, //第三方联系电话
            ]
        );
    }
}
