<?php

namespace Overtrue\Weixin;

use Overtrue\Utils\Format;
use Overtrue\Utils\Post;

class Upload
{
    /**
     * file
     */
    const FILE = 'file';

    /**
     * video
     */
    const VIDEO = 'video';

    /**
     * voice
     */
    const VOICE = 'voice';

    /**
     * image
     */
    const IMAGE = 'image';

    /**
     * @var string
     */
    private $webHookUrl = 'https://qyapi.weixin.qq.com/cgi-bin/webhook/upload_media?key=%s&type=%s';

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $filePath;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @param $key
     * @param string $type
     * @return $this
     */
    public function setKey($key, $type = self::FILE)
    {
        $this->key = $key;
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebHookUrl()
    {
        return sprintf($this->webHookUrl, $this->key, $this->type);
    }

    /**
     * @param $file
     * @return bool
     */
    public function isExistsFile($file)
    {
        return file_exists($file);
    }

    /**
     * @param $file
     * @return bool
     */
    public function isReadFile($file)
    {
        return is_readable($file);
    }

    /**
     * @param $file
     * @return bool|string
     */
    public function readFile($file)
    {
        $handle = fopen($file, 'r');
        $content = fread($handle, filesize($file));
        fclose($handle);
        return $content;
    }

    /**
     *
     * PHP resources will be released at the end of the script,
     * so fclose can be omitted in most cases.
     *
     * @param $file
     * @return bool|resource
     */
    public function readFileByHandle($file)
    {
        $handle = fopen($file, 'r');
        //fclose($handle);
        return $handle;
    }

    /**
     * @param $file
     * @return array|mixed
     */
    public function post($file)
    {
        if ($this->isExistsFile($file) && $this->isReadFile($file)) {
            $fileData = [
                [
                    'name'     => basename($file),
                    'contents' => $this->readFileByHandle($file),
                    'filename' => basename($file)
                ],
            ];
            return (new Post())->setUrl($this->getWebHookUrl())->sendFile($fileData);
        }
        return (new Format())->getUploadErrorData();
    }

    /**
     * @param $response
     * @return string
     */
    public function extract($response)
    {
        if (isset($response['media_id'])) {
            return $response['media_id'];
        }
        return '';
    }

}