<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '【产品】分类',
            'url' => ['category/index'],
        ],
        [
            'label' => '【应用案例】分类',
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
    ],
    'options' => ['class' => 'nav-tabs'],
]);