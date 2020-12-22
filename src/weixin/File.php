<?php

namespace Overtrue\Weixin;

class File
{
    /**
     * file
     */
    const MSG_TYPE = 'file';

    /**
     * Message type
     *
     * @var string
     */
    private $msgType = self::MSG_TYPE;

    /**
     * File
     *
     * @var array
     */
    private $file;

    /**
     * Media id
     * Upload material to media_id, the media_id is only valid for three days
     * media_id can be shared among applications in the same enterprise
     *
     * @var string
     */
    private $mediaId;

    /**
     * @return string
     */
    public function getMsgType()
    {
        return $this->msgType;
    }

    /**
     * @param string $mediaId
     * @return $this
     */
    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
        return $this;
    }

    /**
     * @return array
     */
    public function getFile()
    {
        $this->file = ['media_id' => $this->mediaId];
        return $this->file;
    }
}