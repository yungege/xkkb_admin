<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => 'Banner列表',
            'url' => ['banner/index'],
        ],
        [
            'label' => '新增Banner',
            'url' => ['banner/add'],
        ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);