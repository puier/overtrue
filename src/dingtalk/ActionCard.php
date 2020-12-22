<?php

namespace Overtrue\Dingtalk;

class ActionCard
{
    /**
     * horizontal
     */
    const HORIZONTAL = 1;

    /**
     * vertical
     */
    const VERTICAL = 0;

    /**
     * actionCard
     */
    const MSG_TYPE = 'actionCard';

    /**
     * Message type
     *
     * @var string
     */
    private $msgType = self::MSG_TYPE;

    /**
     * Action card
     *
     * @var array
     */
    private $actionCard;

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
     * Btn orientation
     * 0: vertical arrangement of buttons
     * 1: horizontal arrangement of buttons
     *
     * @var int
     */
    private $btnOrientation;

    /**
     * Single title
     * Example : read the whole passage
     * btns is invalid when this and singleUrl are set.
     *
     * @var string
     */
    private $singleTitle;

    /**
     * Single URL
     *
     * @var string
     */
    private $singleURL;

    /**
     * Hide avatar
     * 0: un hide avatar
     * 1: hide avatar
     *
     * @var int
     */
    private $hideAvatar;

    /**
     * btns
     *
     * @var array
     */
    private $btns;

    /**
     * btns title
     *
     * @var string
     */
    private $btnsTitle;

    /**
     * btns action URL
     *
     * @var string
     */
    private $btnsActionURL;

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
     * @param $btnOrientation
     * @return $this
     */
    public function setBtnOrientation($btnOrientation)
    {
        $this->btnOrientation = $btnOrientation;
        return $this;
    }

    /**
     * @param $singleTitle
     * @return $this
     */
    public function setSingleTitle($singleTitle)
    {
        $this->singleTitle = $singleTitle;
        return $this;
    }

    /**
     * @param $singleURL
     * @return $this
     */
    public function setSingleURL($singleURL)
    {
        $this->singleURL = $singleURL;
        return $this;
    }

    /**
     * @param $hideAvatar
     * @return $this
     */
    public function setHideAvatar($hideAvatar)
    {
        $this->hideAvatar = $hideAvatar;
        return $this;
    }

    /**
     * @param string $title
     * @param string $actionURL
     * @return $this
     */
    public function setBtns($title, $actionURL)
    {
        $this->btns[] = [
            'title' => $title,
            'actionURL' => $actionURL
        ];
        return $this;
    }

    /**
     * @return array
     */
    public function getBtns()
    {
        return $this->btns;
    }

    /**
     * @return array
     */
    public function getActionCard()
    {
        $this->actionCard = ['title' => $this->title, 'text' => $this->text, 'btnOrientation' => $this->btnOrientation];
        if ($this->btns) {
            $this->actionCard['btns'] = $this->btns;
        } else {
            $this->actionCard['singleTitle'] = $this->singleTitle;
            $this->actionCard['singleURL'] = $this->singleURL;
        }
        return $this->actionCard;
    }

}