<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = '新闻管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['news']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>
</div>