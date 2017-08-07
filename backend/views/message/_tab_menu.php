<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '留言列表',
            'url' => ['message/index'],
        ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);