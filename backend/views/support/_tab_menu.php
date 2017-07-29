<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '解决方案',
            'url' => ['support/index'],
        ],
        [
            'label' => '发布解决方案',
            'url' => ['support/publish'],
        ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);