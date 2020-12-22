<?php

namespace Overtrue\Weixin;

class Text
{
    /**
     * text
     */
    const MSG_TYPE = 'text';

    /**
     * atAll
     */
    const AT_ALL = '@all';

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
     * The maximum length is not more than 2048 bytes,
     * must be utf8 encoding
     *
     * @var string
     */
    private $content;

    /**
     * A list of userIds to remind the specified members of the group
     * (@ a member), @ all means to remind everyone.
     * If developers can't get the userId,
     * they can use mentionedMobileList.
     *
     * @var array
     */
    private $mentionedList;

    /**
     * Mobile phone number list, to remind group members
     * (@ a member) corresponding to mobile phone number,
     * @ all means to remind everyone.
     *
     * @var array
     */
    private $mentionedMobileList;

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
     * @param $mentionedList
     * @return $this
     */
    public function setMentionedList($mentionedList)
    {
        $this->mentionedList = $mentionedList;
        return $this;
    }

    /**
     * @param $mentionedMobileList
     * @return $this
     */
    public function setMentionedMobileList($mentionedMobileList)
    {
        $this->mentionedMobileList = $mentionedMobileList;
        return $this;
    }

    /**
     * @return array
     */
    public function getText()
    {
        $this->text = ['content' => $this->content];
        if ($this->mentionedList) {
            $this->text['mentionedList'] = $this->mentionedList;
        }
        if ($this->mentionedMobileList) {
            $this->text['mentionedMobileList'] = $this->mentionedMobileList;
        }
        return $this->text;
    }
}