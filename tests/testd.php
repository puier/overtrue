<?php

require_once "../src/dingtalk/Robot.php";
require_once "../src/dingtalk/Text.php";
require_once "../src/dingtalk/Markdown.php";
require_once "../src/dingtalk/ActionCard.php";
require_once "../src/dingtalk/FeedCard.php";
require_once "../src/dingtalk/Link.php";
require_once "../src/application/Format.php";
require_once "../src/application/Post.php";

require_once "../vendor/autoload.php";

//dingtalk
$robot = new \Overtrue\Dingtalk\Robot();

$key = 'xxx';

$robot->setKey($key);

$responseContent = $robot->sendText('hello!', [], true);
$responseContent = $robot->sendText('hello! 1987', ['133xxxx1987']);

$responseContent = $robot->sendMarkdown('hello!', 'hello world!', [], true);
$responseContent = $robot->sendLink('hello!', 'hello world!', 'https://www.baidu.com');
$responseContent = $robot->sendFeedCard(
    [['messageURL'=> '', 'title' => '测试测试']]
);

$responseContent = $robot->sendActionCard(
    '卡片测试', '卡片测试卡片测试'
);

$responseContent = $robot->sendActionCard(
    '卡片测试2', '卡片测试卡片测试2', '', '', [
        [
            'title' => '真',
            'actionURL' => '',
        ],
        [
            'title' => '假',
            'actionURL' => '',
        ]
], 1
);

print_r($responseContent);


