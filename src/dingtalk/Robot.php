<?php

namespace Overtrue\Dingtalk;

use Overtrue\Utils\Post;

class Robot
{

    /**
     * @var string
     */
    private $webHookUrl= 'https://oapi.dingtalk.com/robot/send?access_token=%s';

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
     * @param array $atMobiles
     * @param bool $isAtAll
     * @return array|mixed
     */
    public function sendText($content, $atMobiles = [], $isAtAll = false)
    {
        $text = new Text();
        $text->setContent($content)
            ->setAtMobiles($atMobiles)
            ->setIsAtAll($isAtAll);
        $postData = [
            'msgtype' => $text->getMsgType(),
            'text' => $text->getText(),
            'at' => $text->getAt()
        ];
        return (new Post())->setUrl($this->getWebHookUrl())->sendJsonData($postData);
    }

    /**
     * @param $title
     * @param $text
     * @param array $atMobiles
     * @param bool $isAtAll
     * @return array|mixed
     */
    public function sendMarkdown($title, $text, $atMobiles = [], $isAtAll = false)
    {
        $markdown = new Markdown();
        $markdown->setTitle($title)
            ->setText($text)
            ->setAtMobiles($atMobiles)
            ->setIsAtAll($isAtAll);
        $postData = [
            'msgtype' => $markdown->getMsgType(),
            'markdown' => $markdown->getMarkdown(),
            'at' => $markdown->getAt()
        ];
        return (new Post())->setUrl($this->getWebHookUrl())->sendJsonData($postData);
    }

    /**
     * @param $title
     * @param $text
     * @param $messageUrl
     * @param string $picUrl
     * @return array|mixed
     */
    public function sendLink($title, $text, $messageUrl, $picUrl = '')
    {
        $link = new Link();
        $link->setTitle($title)
            ->setText($text)
            ->setMessageUrl($messageUrl)
            ->setPicUrl($picUrl);
        $postData = [
            'msgtype' => $link->getMsgType(),
            'link' => $link->getLink(),
        ];
        return (new Post())->setUrl($this->getWebHookUrl())->sendJsonData($postData);
    }

    /**
     * @param $links
     * @return array|mixed
     */
    public function sendFeedCard($links)
    {
        $feedCard = new FeedCard();
        foreach ($links as $link){
            $feedCard->setLinks(
                $link['title'],
                $link['messageURL'],
                isset($link['picURL']) ? $link['picURL'] : ''
            );
        }
        $postData = [
            'msgtype' => $feedCard->getMsgType(),
            'feedCard' => $feedCard->getLinks(),
        ];
        return (new Post())->setUrl($this->getWebHookUrl())->sendJsonData($postData);
    }

    /**
     * @param $title
     * @param $text
     * @param string $singleTitle
     * @param string $singleURL
     * @param array $btns
     * @param int $btnOrientation
     * @return array|mixed
     */
    public function sendActionCard($title, $text, $singleTitle = 'read', $singleURL = '', $btns = [], $btnOrientation = 0)
    {
        $actionCard = new ActionCard();
        $actionCard->setTitle($title)
            ->setText($text)
            ->setBtnOrientation($btnOrientation);
        if ($btns) {
            foreach ($btns as $btn){
                $actionCard->setBtns(
                    $btn['title'],
                    $btn['actionURL']
                );
            }
        } else {
            $actionCard->setSingleTitle($singleTitle)
                ->setSingleURL($singleURL);
        }
        $postData = [
            'msgtype' => $actionCard->getMsgType(),
            'actionCard' => $actionCard->getActionCard(),
        ];
        return (new Post())->setUrl($this->getWebHookUrl())->sendJsonData($postData);
    }

}