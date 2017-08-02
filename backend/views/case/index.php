<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\widgets\LinkPager;
AppAsset::register($this);

$this->title = '应用案例';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['case']];
$this->params['breadcrumbs'][] = $this->title;
AppAsset::addCss($this, '/statics/themes/admin/case/index.css');
// AppAsset::addJs($this, '/statics/themes/admin/vendor/treetable/treetable.js');

?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <div class="row">
        <div class="col-md-12">

            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>封面</th>
                        <th>标题</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($caseList as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><img src="<?= $row['cover'] ?>" width="150"></td>
                        <td><?= Html::encode($row['title']) ?></td>
                        <td><?= date('Y-m-d H:i:s', $row['ctime']) ?></td>
                        <td data-csrf="<?= Yii::$app->request->csrfToken ?>">
                            <a class="btn btn-info btn-xs" href="http://xkkb.com/zh_cn/case/<?= $row['id'] ?>?ca_f=<?= $row['category'] ?>" title="预览" aria-label="预览" data-pjax="0" target="__blank" style="margin-bottom: 5px;">
                                <span class="fa fa-play-circle-o"></span> 预览
                            </a>
                            <a class="btn btn-primary btn-xs" href="/case/edit?id=<?= $row['id'] ?>&ca_f=<?= $row['category'] ?>" title="更新" aria-label="更新" data-pjax="0" style="margin-bottom: 5px;">
                                <span class="fa fa-edit"></span> 更新
                            </a>
                            <a data-id="<?= $row['id'] ?>" class="btn btn-danger btn-xs" href="javascript:void(0)" title="删除" aria-label="删除" onclick="del(this)" style="margin-bottom: 5px;">
                                <span class="fa fa-times"></span> 删除
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>

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


</div>