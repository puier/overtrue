<?php

$classesToAlias = [
    '\Overtrue\Weixin\AccessToken' => '\Overtrue\Weixin\AccessToken',
    '\Overtrue\Weixin\File' => '\Overtrue\Weixin\File',
    '\Overtrue\Weixin\Image' => '\Overtrue\Weixin\Image',
    '\Overtrue\Weixin\Markdown' => '\Overtrue\Weixin\Markdown',
    '\Overtrue\Weixin\News' => '\Overtrue\Weixin\News',
    '\Overtrue\Weixin\Robot' => '\Overtrue\Weixin\Robot',
    '\Overtrue\Weixin\Text' => '\Overtrue\Weixin\Text',
    '\Overtrue\Weixin\Upload' => '\Overtrue\Weixin\upload',
    '\Overtrue\Dingtalk\Text' => '\Overtrue\Dingtalk\Text',
    '\Overtrue\Dingtalk\Robot' => '\Overtrue\Dingtalk\Robot',
    '\Overtrue\Dingtalk\Markdown' => '\Overtrue\Dingtalk\Markdown',
    '\Overtrue\Dingtalk\Link' => '\Overtrue\Dingtalk\Link',
    '\Overtrue\Dingtalk\FeedCard' => '\Overtrue\Dingtalk\FeedCard',
    '\Overtrue\Dingtalk\ActionCard' => '\Overtrue\Dingtalk\ActionCard',
    '\Overtrue\Utils\Format' => '\Overtrue\Utils\Format',
    '\Overtrue\Utils\Post' => '\Overtrue\Utils\Post',
];

foreach ($classesToAlias as $original => $alias) {
    if (!class_exists($alias, false)) {
        class_alias($original, $alias);
    }
}
