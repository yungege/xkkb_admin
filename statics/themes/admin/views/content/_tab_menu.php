<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '导航菜单列表',
            'url' => ['content/meau'],
        ],
        [
            'label' => '新增导航',
            'url' => ['content/add'],
        ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);