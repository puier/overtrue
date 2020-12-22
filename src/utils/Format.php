<?php

namespace Overtrue\Utils;

class Format
{
    /**
     * unknow response code
     */
    const ERR_CODE_UN_KNOW = -1;

    /**
     * unknow response message
     */
    const ERR_MSG_UN_KNOW = 'unknow response!';

    /**
     * file is not upload to weixin code
     */
    const ERR_CODE_UPLOAD_ERROR = -2;

    /**
     * file is not upload to weixin message
     */
    const ERR_MSG_UPLOAD_ERROR = 'file is not upload to weixin!';

    /**
     * this access_token is invalid code
     */
    const ERR_CODE_TOKEN_ERROR = -3;

    /**
     * this access_token is invalid message
     */
    const ERR_MSG_TOKEN_ERROR = 'this access_token is invalid!';

    /**
     * @param $content
     * @return array|mixed
     */
    public function getJsonResponseData($content)
    {
        if ($content['code']) {
            return [
                'errcode' => $content['code'],
                'errmsg' => $content['msg'],
            ];
        }
        $data = json_decode($content['response'], true);
        if (isset($data['errcode']) && isset($data['errmsg'])) {
            return $data;
        }
        return [
            'errcode' => self::ERR_CODE_UN_KNOW,
            'errmsg' => self::ERR_MSG_UN_KNOW,
            'response' => $content['response'],
        ];
    }

    /**
     * @return array
     */
    public function getUploadErrorData()
    {
        return [
            'errcode' => self::ERR_CODE_UPLOAD_ERROR,
            'errmsg' => self::ERR_MSG_UPLOAD_ERROR,
        ];
    }

    /**
     * @return array
     */
    public function getTokenErrorData()
    {
        return [
            'errcode' => self::ERR_CODE_TOKEN_ERROR,
            'errmsg' => self::ERR_MSG_TOKEN_ERROR,
        ];
    }
}