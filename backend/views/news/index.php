<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = '新闻管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['news']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>封面</th>
                <th>标题</th>
                <th>摘要</th>
                <th>类型</th>
                <th>标签</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($newsList as $row) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['cover'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['desc'] ?></td>
                <td><?= $row['category'] ?></td>
                <td><?= $row['tags'] ?></td>
                <td><?= $row['status'] == 1 ? '<span class="label label-success">已发布</span>' : ($row['status'] == 2 ? '<span class="label label-success">待发布</span>' : '<span class="label label-danger">unknow</span>') ?></td>
                <td>
                    <a class="btn btn-primary btn-xs" href="/news/update?id=<?= $row['id'] ?>" title="更新" aria-label="更新" data-pjax="0">
                        <span class="fa fa-edit"></span> 更新
                    </a>
                    <a class="btn btn-primary btn-xs" href="/news/online?id=<?= $row['id'] ?>" title="发布" aria-label="发布" data-pjax="0">
                        <span class="fa fa-edit"></span> 发布
                    </a>
                    <a data-id="<?= $row['id'] ?>" class="btn btn-danger btn-xs" href="javascript:void(0)" title="删除" aria-label="删除" onclick="del(this)">
                        <span class="fa fa-times"></span> 删除
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <div class="new-page-more text-center">
        <?=
            LinkPager::widget([
                'pagination' => $pages,
                'nextPageLabel' => 'N',
                'prevPageLabel' => 'L',
            ]);
        ?>
    </div>
</div>