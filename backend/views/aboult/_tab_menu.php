<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '资质管理',
            'url' => ['aboult/index'],
        ],
        [
            'label' => '上传资质',
            'url' => ['aboult/publish'],
        ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);