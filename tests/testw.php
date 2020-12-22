<?php

require_once "../src/weixin/Robot.php";
require_once "../src/weixin/Text.php";
require_once "../src/weixin/Markdown.php";
require_once "../src/weixin/Image.php";
require_once "../src/weixin/File.php";
require_once "../src/weixin/News.php";
require_once "../src/weixin/Upload.php";
require_once "../src/application/Format.php";
require_once "../src/application/Post.php";
require_once "../src/weixin/AccessToken.php";

require_once "../vendor/autoload.php";

//weixin
$robot = new \Overtrue\Weixin\Robot();

$key = 'xxx-xxx-xxx-xxx-xxx';

$img = '1.png';

$robot->setKey($key);

$responseContent = $robot->sendText('hello');

$responseContent = $robot->sendMarkdown('###hello');

$responseContent = $robot->sendNews([[
    'title' => '测试测试title',
    'url' => 'http://www.baidu.com',
]]);

$responseContent = $robot->sendImageByLocal($img);

$responseContent = $robot->sendFileByLocal($img);

print_r($responseContent);

