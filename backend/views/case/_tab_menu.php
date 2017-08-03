<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '案例列表',
            'url' => ['case/index'],
        ],
        [
            'label' => '新增案例',
            'url' => ['case/publish'],
        ]
    ],
    'options' => ['class' => 'nav-tabs'],
]);