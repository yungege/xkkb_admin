<?php
use yii\helpers\Html;

$this->title = '导航栏管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['meau']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>
</div>