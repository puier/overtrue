<?php

namespace Overtrue\Dingtalk;

class Link
{
    /**
     * link
     */
    const MSG_TYPE = 'link';

    /**
     * Message type
     *
     * @var string
     */
    private $msgType = self::MSG_TYPE;

    /**
     * Link
     *
     * @var array
     */
    private $link;

    /**
     * Title
     *
     * @var string
     */
    private $title;

    /**
     * Text
     *
     * @var string
     */
    private $text;

    /**
     * PicUrl
     *
     * @var string
     */
    private $picUrl;

    /**
     * MessageUrl
     *
     * @var string
     */
    private $messageUrl;

    /**
     * @return string
     */
    public function getMsgType()
    {
        return $this->msgType;
    }

    /**
     * @param $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param $messageUrl
     * @return $this
     */
    public function setMessageUrl($messageUrl)
    {
        $this->messageUrl = $messageUrl;
        return $this;
    }

    /**
     * @param $picUrl
     * @return $this
     */
    public function setPicUrl($picUrl)
    {
        $this->picUrl = $picUrl;
        return $this;
    }

    /**
     * @return array
     */
    public function getLink()
    {
        $this->link = ['title' => $this->title, 'text' => $this->text, 'messageUrl' => $this->messageUrl, 'picUrl' => $this->picUrl];
        return $this->link;
    }

}