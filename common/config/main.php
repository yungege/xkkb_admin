<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN',  //目标语言
    'runtimePath'  => dirname(dirname(__DIR__)) . '/storage/runtime',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=120.27.8.113;dbname=xkkb',
            // 'dsn' => 'mysql:host=192.168.1.44;dbname=xkkb',
            'username' => 'xkkb',
            'password' => 'xkkb123456',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
            'basePath' => '@webroot/storage/assets',
            'baseUrl'=>'@web/storage/assets',
            'bundles' => [
                'yii\web\YiiAsset',
                'yii\web\JqueryAsset',
                'yii\bootstrap\BootstrapAsset',
                // you can override AssetBundle configs here
            ],
            //'linkAssets' => true,
            // ...
        ],
        /**
         * 语言包配置
         * 将"源语言"翻译成"目标语言". 注意"源语言"默认配置为 'sourceLanguage' => 'en-US'
         * 使用: \Yii::t('common', 'title'); 将common/messages下的common.php中的title转为对应的中文
         */
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'common' => 'common.php',
                        'frontend' => 'frontend.php',
                        'backend' => 'backend.php',
                    ],
                ],
            ],
        ],
    ],
];
