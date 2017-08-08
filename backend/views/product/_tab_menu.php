<?php
use yii\bootstrap\Nav;

echo Nav::widget([
    'items' => [
        [
            'label' => '室内光缆系列',
            'url' => ['product/index'],
        ],
        [
            'label' => '室外光缆系列',
            'url' => ['product/sw'],
        ],
        [
            'label' => '数据中心系列',
            'url' => ['product/sj'],
        ],
        [
            'label' => '光纤入户系列',
            'url' => ['product/rh'],
        ],
        [
            'label' => '光纤跳线系列',
            'url' => ['product/tx'],
        ],
        [
            'label' => '光传输设备',
            'url' => ['product/cs'],
        ],
        [
            'label' => '综合布线',
            'url' => ['product/bx'],
        ],
        [
            'label' => '安防监控',
            'url' => ['product/jk'],
        ],
    ],
    'options' => ['class' => 'nav-tabs'],
]);