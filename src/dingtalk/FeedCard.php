<?php

namespace Overtrue\Dingtalk;

class FeedCard
{
    /**
     * feedCard
     */
    const MSG_TYPE = 'feedCard';

    /**
     * Message type
     *
     * @var string
     */
    private $msgType = self::MSG_TYPE;

    /**
     * Feed card
     *
     * @var array
     */
    private $feedCard;

    /**
     * Links
     *
     * @var array
     */
    private $links;

    /**
     * Title
     *
     * @var string
     */
    private $title;

    /**
     * Message URL
     *
     * @var string
     */
    private $messageURL;

    /**
     * Pic URL
     *
     * @var string
     */
    private $picURL;

    public function getMsgType()
    {
        return $this->msgType;
    }

    /**
     * @param string $title
     * @param string $messageURL
     * @param string $picURL
     * @return $this
     */
    public function setLinks($title, $messageURL, $picURL)
    {
        $this->links[] = [
            'title' => $title,
            'messageURL' => $messageURL,
            'picURL' => $picURL
        ];
        return $this;
    }

    /**
     * @return array
     */
    public function getLinks()
    {
        $this->links = ['links' => $this->links];
        return $this->links;
    }
}