<?php

/**
 *
 * Each robot cannot send more than 20 messages per minute.
 *
 */

namespace Overtrue\Weixin;

use Overtrue\Utils\Format;
use Overtrue\Utils\Post;

class Robot
{

    /**
     * @var string
     */
    private $webHookUrl = 'https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key=%s';

    /**
     * @var string
     */
    private $key;

    /**
     * @param $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebHookUrl()
    {
        return sprintf($this->webHookUrl, $this->key);
    }

    /**
     * @param $content
     * @param array $mentionedList
     * @param array $mentionedMobileList
     * @return array|mixed
     */
    public function sendText($content, $mentionedList = [], $mentionedMobileList = [])
    {
        $text = new Text();
        $text->setContent($content)
            ->setMentionedList($mentionedList)
            ->setMentionedMobileList($mentionedMobileList);
        $postData = [
            'msgtype' => $text->getMsgType(),
            'text' => $text->getText(),
        ];
        return (new Post())->setUrl($this->getWebHookUrl())->sendJsonData($postData);
    }

    /**
     * @param $content
     * @return array|mixed
     */
    public function sendMarkdown($content)
    {
        $markdown = new Markdown();
        $markdown->setContent($content);
        $postData = [
            'msgtype' => $markdown->getMsgType(),
            'markdown' => $markdown->getMarkdown(),
        ];
        return (new Post())->setUrl($this->getWebHookUrl())->sendJsonData($postData);
    }

    /**
     * @param $articles
     * @return array|mixed
     */
    public function sendNews($articles)
    {
        $news = new News();
        foreach ($articles as $article){
            $news->setArticles(
                $article['title'],
                $article['url'],
                isset($article['description']) ? $article['description'] : '',
                isset($article['picurl']) ? $article['picurl'] : ''
            );
        }
        $postData = [
            'msgtype' => $news->getMsgType(),
            'news' => $news->getNews(),
        ];
        return (new Post())->setUrl($this->getWebHookUrl())->sendJsonData($postData);
    }

    /**
     * @param $base64
     * @param $md5
     * @return array|mixed
     */
    public function sendImage($base64, $md5)
    {
        $image = new Image();
        $image->setBase64($base64)
            ->setMd5($md5);
        $postData = [
            'msgtype' => $image->getMsgType(),
            'image' => $image->getImage(),
        ];
        return (new Post())->setUrl($this->getWebHookUrl())->sendJsonData($postData);
    }

    /**
     * @param $fileName
     * @return array|mixed
     */
    public function sendImageByLocal($fileName)
    {
        $image = new Image();
        $image->setMd5ByImage($fileName)
            ->setBase64ByImage($fileName);
        $postData = [
            'msgtype' => $image->getMsgType(),
            'image' => $image->getImage(),
        ];
        file_put_contents('json.json', json_encode($postData));
        return (new Post())->setUrl($this->getWebHookUrl())->sendJsonData($postData);
    }

    /**
     * @param $mediaId
     * @return array|mixed
     */
    public function sendFile($mediaId)
    {
        $file = new File();
        $file->setMediaId($mediaId);
        $postData = [
            'msgtype' => $file->getMsgType(),
            'file' => $file->getFile(),
        ];
        return (new Post())->setUrl($this->getWebHookUrl())->sendJsonData($postData);
    }

    /**
     * @param $fileName
     * @return array|mixed
     */
    public function sendFileByLocal($fileName)
    {
        $upload = new Upload();
        $upload->setKey($this->key);
        $info = $upload->post($fileName);
        $mediaId = $upload->extract($info);
        if (!$mediaId) {
            return (new Format())->getUploadErrorData();
        }
        return $this->sendFile($mediaId);
    }
}