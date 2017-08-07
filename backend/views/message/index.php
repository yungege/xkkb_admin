<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = '留言管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['message']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>手机</th>
                <th>邮箱</th>
                <th>地址</th>
                <th>留言</th>
                <th>时间</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= Html::encode($row['name']) ?></td>
                <td><?= Html::encode($row['mobile']) ?></td>
                <td><?= Html::encode($row['email']) ?></td>
                <td><?= Html::encode($row['addr']) ?></td>
                <td><?= Html::encode($row['desc']) ?></td>
                <td><?= date('Y-m-d H:i:s', $row['ctime']) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class="new-page-more text-center">
        <?=
            LinkPager::widget([
                'pagination' => $pages,
                'nextPageLabel' => '>>',
                'prevPageLabel' => '<<',
                'firstPageLabel' => '首页', 
                'lastPageLabel' => '尾页',
            ]);
        ?>
    </div>
</div>