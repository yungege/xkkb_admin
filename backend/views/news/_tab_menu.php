<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '行业新闻',
            'url' => ['news/index'],
        ],
        [
            'label' => '新科凯邦',
            'url' => ['news/xkkb'],
        ],
        [
            'label' => '新闻发布',
            'url' => ['news/publish'],
        ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);