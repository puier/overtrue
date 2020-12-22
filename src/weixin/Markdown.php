<?php

namespace Overtrue\Weixin;

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
     * Markdown content,
     * The maximum length of markdown is 4096 bytes,
     * must be utf8 encoding
     *
     * @var string
     */
    private $content;

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
     * @return array
     */
    public function getMarkdown()
    {
        $this->markdown = ['content' => $this->content];
        return $this->markdown;
    }
}