<?php

namespace Overtrue\Weixin;

use Overtrue\Utils\Post;

class AccessToken
{
    /*
     * string
     */
    private $webHookUrl = 'https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=%s&corpsecret=%s';

    /**
     * @var string
     */
    private $corpId;

    /**
     * @var string
     */
    private $corpSecret;

    /**
     * @param $corpId
     * @param $corpSecret
     * @return $this
     */
    public function setKey($corpId, $corpSecret)
    {
        $this->corpId = $corpId;
        $this->corpSecret = $corpSecret;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebHookUrl()
    {
        return sprintf($this->webHookUrl, $this->corpId, $this->corpSecret);
    }

    /**
     * @return array|mixed
     */
    public function post()
    {
        return (new Post())->setUrl($this->getWebHookUrl())->sendJsonData([]);
    }

    /**
     * @param $response
     * @return string
     */
    public function extract($response)
    {
        if (isset($response['access_token'])) {
            return $response['access_token'];
        }
        return '';
    }

}