<?php
use yii\helpers\Html;

$this->title = '导航栏管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['meau']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>菜单名称</th>
                <th>浏览</th>
                <th>下拉菜单</th>
                <th>当前状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($meauList as $row) : ?>
            <tr>
                <td><?= $row['meau'] ?></td>
                <td><a href="<?= $row['url'] ?>" class="btn btn-sm btn-info" target="__blank">浏&nbsp;览</a></td>
                <td><span class="label label-success"><?= empty($row['show']) ? '无' : '有' ?></span></td>
                <td><?= $row['status'] ?></td>
                <td></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>