<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

$this->title = '产品分类管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['category']];
$this->params['breadcrumbs'][] = $this->title;
AppAsset::addCss($this, '/statics/themes/admin/vendor/treetable/css/treetable.css');
AppAsset::addCss($this, '/statics/themes/admin/vendor/treetable/css/theme.default.css');
AppAsset::addJs($this, '/statics/themes/admin/vendor/treetable/treetable.js');

function output_tr($l, $isRoot = true)
{
    echo "<tr data-tt-id='" . $l['id'] . "'" . ($isRoot ? '' : "data-tt-parent-id='" . $l['pid'] . "'") . ">";
    echo "<td style='width: 30px'></td>";
    echo "<td style='width: 50px'>" . $l['id'] . "</td>";
    echo "<td style='width: 135px'>" . $l['pid'] . "</td>";
    echo "<td style='width: 135px'>" . $l['cate_name'] . "</td>";
    echo "<td style='width: 85px'>" . $l['cate_level'] . "</td>";

    echo "<td>
        <a class=\"btn btn-xs btn-info\" href=\"/category/edit?id=" . $l['id'] . "\"><span class='fa fa-edit'></span> 编辑</a>
        <a class=\"btn btn-xs btn-success\" target='_blank' href=\"/category/add?pid=" . $l['id'] . "\"><span class='fa fa-plus'></span> 新增子类</a>
        <a class=\"btn btn-xs btn-danger\" target='_blank' href=\"/category/del?id=" . $l['id'] . "\"><span class='fa fa-times'></span> 删除</a>
    </td>";
    echo "</tr>";
}

function recursive_output($l)
{
    if ($l['sub']) {
        foreach ($l['sub'] as $v) {
            output_tr($v, false);
            recursive_output($v);
        }
    }
}

?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <div class="row">
        <div class="col-md-12">

            <table class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>ID</th>
                    <th>PID</th>
                    <th>分类名称</th>
                    <th>level</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($meauList)): ?>
                    <?php foreach ($meauList as $l): ?>
                        <?php
                        output_tr($l);
                        recursive_output($l);
                        ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>