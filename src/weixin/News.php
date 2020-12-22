<?php

namespace Overtrue\Weixin;

class News
{
    /**
     * news
     */
    const MSG_TYPE = 'news';

    /**
     * Message type
     *
     * @var string
     */
    private $msgType = self::MSG_TYPE;

    /**
     * News
     *
     * @var array
     */
    private $news;

    /**
     * Articles
     *
     * @var array
     */
    private $articles;

    /**
     * Title
     * No more than 128 bytes, will be automatically truncated
     *
     * @var string
     */
    private $title;

    /**
     * Url
     * Click on the link to jump.
     *
     * @var string
     */
    private $url;

    /**
     * Description
     * No more than 512 bytes, will be automatically truncated.
     *
     * @var string
     */
    private $description;

    /**
     * PicUrl
     * The image link of text message supports JPG and PNG format,
     * and the better effect is large picture 1068 * 455,
     * small picture 150 * 150.
     *
     * @var string
     */
    private $picUrl;

    public function getMsgType()
    {
        return $this->msgType;
    }

    /**
     * @param string $title
     * @param string $url
     * @param string $description
     * @param string $picUrl
     * @return $this
     */
    public function setArticles($title, $url, $description = '', $picUrl = '')
    {
        $this->articles[] = [
            'title' => $title,
            'url' => $url,
            'description' => $description,
            'picurl' => $picUrl
        ];
        return $this;
    }

    /**
     * @return array
     */
    public function getNews()
    {
        $this->news = ['articles' => $this->articles];
        return $this->news;
    }
}