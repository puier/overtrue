<?php

namespace Overtrue\Weixin;

class Image
{
    /**
     * image
     */
    const MSG_TYPE = 'image';

    /**
     * Message type
     *
     * @var string
     */
    private $msgType = self::MSG_TYPE;

    /**
     * Image
     *
     * @var array
     */
    private $image;

    /**
     * Base64
     * Base64 encoding of image content.
     * Does not contain a data URI scheme.
     *
     * @var string
     */
    private $base64;

    /**
     * Md5
     * MD5 value of image content (before Base64 encoding).
     *
     * @var string
     */
    private $md5;

    /**
     * @return string
     */
    public function getMsgType()
    {
        return $this->msgType;
    }

    /**
     * @param string $base64
     * @return $this
     */
    public function setBase64($base64)
    {
        $this->base64 = $base64;
        return $this;
    }

    /**
     * @param string $md5
     * @return $this
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;
        return $this;
    }

    /**
     * @return array
     */
    public function getImage()
    {
        $this->image = ['md5' => $this->md5, 'base64' => $this->base64];
        return $this->image;
    }

    /**
     * @param $fileName
     * @return $this
     */
    public function setMd5ByImage($fileName)
    {
        $this->md5 = md5_file($fileName);
        return $this;
    }

    /**
     * @param $fileName
     * @return $this
     */
    public function setBase64ByImage($fileName)
    {
        $base64Info = $this->base64EncodeImage($fileName);
        if (isset($base64Info['base64'])) {
            $this->base64 = $base64Info['base64'];
        }
        return $this;
    }

    /**
     * 获取图片的Base64编码(不支持url)
     * @param string $imgFile 传入本地图片地址
     * @return array
     */
    function base64EncodeImage($imgFile) {
        $img_base64 = '';
        $scheme = '';
        $base64 = '';
        if (file_exists($imgFile)) {
            $appImgFile = $imgFile; // 图片路径
            $imgInfo = getimagesize($appImgFile); // 取得图片的大小，类型等

            //echo '<pre>' . print_r($img_info, true) . '</pre><br>';
            $fp = fopen($appImgFile, "r"); // 图片是否可读权限

            if ($fp) {
                $filesize = filesize($appImgFile);
                $content = fread($fp, $filesize);
                $file_content = chunk_split(base64_encode($content)); // base64编码
                switch ($imgInfo[2]) {           //判读图片类型
                    case 1: $img_type = "gif";
                        break;
                    case 2: $img_type = "jpg";
                        break;
                    case 3: $img_type = "png";
                        break;
                    default:
                        return [];
                }

                $scheme = 'data:image/' . $img_type . ';base64,';
                $base64 = str_replace(["\r\n", "\r", "\n"], '', $file_content);

                $img_base64 = $scheme . $base64;//合成图片的base64编码

            }
            fclose($fp);
        }

        return ['base64' => $base64, 'scheme' => $scheme, 'img_base64' => $img_base64];
    }
}