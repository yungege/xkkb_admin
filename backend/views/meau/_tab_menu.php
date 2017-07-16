<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '导航菜单列表',
            'url' => ['meau/index'],
        ],
        [
            'label' => '新增导航',
            'url' => ['meau/add'],
        ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);