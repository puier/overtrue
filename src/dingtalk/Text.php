<?php

namespace Overtrue\Dingtalk;

class Text
{
    /**
     * text
     */
    const MSG_TYPE = 'text';

    /**
     * Message type
     *
     * @var string
     */
    private $msgType = self::MSG_TYPE;

    /**
     * Text
     *
     * @var array
     */
    private $text;

    /**
     * Text content
     *
     * @var string
     */
    private $content;

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
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
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
    public function getText()
    {
        $this->text = ['content' => $this->content];
        return $this->text;
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