<?php

namespace Overtrue\Dingtalk;

class Markdown
{
    /**
     * markdown
     */
    const MSG_TYPE = 'markdown';

    /**
     * Message type
     *
     * @var string
     */
    private $msgType = self::MSG_TYPE;

    /**
     * Markdown
     *
     * @var array
     */
    private $markdown;

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
     * At
     *
     * @var array
     */
    private $at;

    /**
     * AtMobiles
     * The mobile phone number of the person being @ ed.
     *
     * @var array
     */
    private $atMobiles;

    /**
     * IsAtAll
     * Whether @ everyone.
     *
     * @var bool
     */
    private $isAtAll;

    /**
     * @return string
     */
    public function getMsgType()
    {
        return $this->msgType;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return array
     */
    public function getMarkdown()
    {
        $this->markdown = ['title' => $this->title, 'text' => $this->text];
        return $this->markdown;
    }

    /**
     * @param $isAtAll
     * @return $this
     */
    public function setIsAtAll($isAtAll)
    {
        $this->isAtAll = $isAtAll;
        return $this;
    }

    /**
     * @param $atMobiles
     * @return $this
     */
    public function setAtMobiles($atMobiles)
    {
        $this->atMobiles = $atMobiles;
        return $this;
    }

    /**
     * @return array
     */
    public function getAt()
    {
        if ($this->isAtAll) {
            $this->at = ['isAtAll' => $this->isAtAll];
        } else if ($this->atMobiles) {
            $this->at = ['atMobiles' => $this->isAtAll];
        }
        return $this->at;
    }
}