<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '工程车间',
            'url' => ['img/index'],
        ],
        [
            'label' => '仓库 ',
            'url' => ['img/ck'],
        ],
        [
            'label' => '上传图片',
            'url' => ['img/add'],
        ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);