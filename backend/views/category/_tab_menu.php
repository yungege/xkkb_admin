<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '【产品】分类',
            'url' => ['category/index'],
        ],
        [
            'label' => '【关于我们】分类',
            'url' => ['category/aboult'],
        ],
        [
            'label' => '【技术支持】分类',
            'url' => ['category/support'],
        ],
        [
            'label' => '【新闻中心】分类',
            'url' => ['category/news'],
        ],
        // [
        //     'label' => '新增导航',
        //     'url' => ['meau/add'],
        // ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);