<?php

namespace Overtrue\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Post
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var bool
     */
    private $debug;

    /**
     * @param $fileData
     * @return array|mixed
     */
    public function sendFile($fileData)
    {
        try {
            $client = new Client();
            $response = $client->post($this->geturl(), [
                'header' => ['Content-Type' => 'multipart/form-data'],
                'multipart' => $fileData
            ]);
            $result = $response->getBody()->getContents();
            $responseData = [
                'code' => 0,
                'response' => $result
            ];
        } catch (RequestException $e) {
            $responseData = [
                "code" => $e->getCode(),
                "msg" => $e->getMessage()
            ];
        }
        return (new Format())->getJsonResponseData($responseData);
    }

    /**
     * @param $postData
     * @return array|mixed
     */
    public function sendJsonData($postData)
    {
        $postData = json_encode($postData, JSON_UNESCAPED_UNICODE);
        try {
            $client = new Client();
            $response = $client->post($this->geturl(), [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => $postData
            ]);
            $result = $response->getBody()->getContents();
            $responseData = [
                'code' => 0,
                'response' => $result
            ];
        } catch (RequestException $e) {
            $responseData = [
                "code" => $e->getCode(),
                "msg" => $e->getMessage()
            ];
        }
        return (new Format())->getJsonResponseData($responseData);
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        if ($this->debug) {
            if (!strpos($this->url, 'debug=')) {
                if (!strpos($this->url, '?')) {
                    $param_string = '?debug=1';
                } else {
                    $param_string = '&debug=1';
                }
                $this->url .= $param_string;
            }
        }
        return $this->url;
    }

    /**
     * @return $this
     */
    public function setDebug()
    {
        $this->debug = true;
        return $this;
    }

}