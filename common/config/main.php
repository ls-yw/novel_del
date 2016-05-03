<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
        ],
        'configs' => [
            'class' => 'common\helper\getConfigs',
        ],
    ],
    'timeZone'=>'Asia/Shanghai',
    'language'=>'zh-CN',
];
