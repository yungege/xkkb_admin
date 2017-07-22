<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '商品分类',
            'url' => ['category/index'],
        ],
        // [
        //     'label' => '新增导航',
        //     'url' => ['meau/add'],
        // ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);