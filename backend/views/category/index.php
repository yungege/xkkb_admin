<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

$this->title = '分类管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['category']];
$this->params['breadcrumbs'][] = $this->title;
AppAsset::addCss($this, '/statics/themes/admin/vendor/treetable/css/treetable.css');
AppAsset::addCss($this, '/statics/themes/admin/vendor/treetable/css/theme.default.css');
AppAsset::addJs($this, '/statics/themes/admin/vendor/treetable/treetable.js');
AppAsset::addJs($this, '/statics/themes/admin/category/index.js');

function output_tr($l, $isRoot = true)
{
    echo "<tr data-tt-id='" . $l['id'] . "'" . ($isRoot ? '' : "data-tt-parent-id='" . $l['pid'] . "'") . ">";
    echo "<td style='width: 30px'></td>";
    echo "<td style='width: 50px'>" . $l['id'] . "</td>";
    echo "<td style='width: 135px'>" . $l['pid'] . "</td>";
    echo "<td style=''>" . $l['cate_name'] . "</td>";
    echo "<td style=''>" . $l['en_cate_name'] . "</td>";
    echo "<td style='width: 85px'>" . $l['cate_level'] . "</td>";
    echo "<td style='width: 85px'>" . ($l['cate_level'] == 1 ? $l['cate_sort'] : '') . "</td>";

    $addBtn = "<a data-pid=\"{$l['id']}\" data-type=\"{$l['type']}\" data-level=\"{$l['cate_level']}\" class=\"cate-add btn btn-xs btn-success\" href=\"javascript:void(0)\"><span class='fa fa-plus'></span> 新增子类</a>&nbsp;";
    $delBtn = "<a data-id=\"{$l['id']}\" class=\"cate-del btn btn-xs btn-danger\" href=\"javascript:void(0)\"><span class='fa fa-times'></span> 删除</a>";
    $editBtn = "<a data-id=\"{$l['id']}\" data-type=\"{$l['type']}\" data-name=\"{$l['cate_name']}\" data-en-name=\"{$l['en_cate_name']}\" data-level=\"{$l['cate_level']}\" data-sort=\"{$l['cate_sort']}\" class=\"cate-edit btn btn-xs btn-primary\" href=\"javascript:void(0)\"><span class='fa fa-times'></span> 编辑</a>&nbsp;";

    $lastTd = $editBtn.$delBtn;

    if($l['cate_level'] == 1){
        $lastTd = $addBtn . $lastTd;
    }

    if($l['type'] == 1){
        echo "<td>{$lastTd}</td>";
    }
    else{
        echo "<td></td>";
    }
    
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
                    <th style="min-width: 200px;">分类名称</th>
                    <th style="min-width: 200px;">英文名称</th>
                    <th>level</th>
                    <th>排序</th>
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

<style type="text/css">
    .fix-div,.edit-fix-div{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4);
        z-index: 9999;
        display: none;
    }
    .fix-div-inner,.edit-fix-div-inner{
        width: 400px;
        height: 210px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: -100px;
        margin-left: -200px;
        background-color: white;
        padding: 10px;
        border: 1px solid #333;
        border-radius: 4px;
    }
    .edit-fix-div-inner{
        height: 280px;
        margin-top: -140px;
    }
    .glyphicon-remove{
        position: absolute;
        top: 5px;
        right: 10px;
        cursor: pointer;
        color: red;
        padding: 5px;
    }
</style>

<div class="fix-div">
    <div class="fix-div-inner">
        <form name="cate">
            <div class="form-group">
                <label for="cate_name">分类名称</label>
                <input type="text" class="form-control" id="cate_name" name="cate_name">
            </div>

            <div class="form-group">
                <label for="en_cate_name">英文名称</label>
                <input type="text" class="form-control" id="en_cate_name" name="en_cate_name">
            </div>

            <input type="hidden" class="form-control" id="pid" name="pid">
            <input type="hidden" class="form-control" id="level" name="cate_level">
            <input type="hidden" class="form-control" id="cate_type" name="type">
            
            <button id="sub" type="button" class="btn btn-primary">确认提交</button>
            <div class="glyphicon glyphicon-remove"></div>
        </form>
    </div>
</div>

<div class="edit-fix-div">
    <div class="edit-fix-div-inner">
        <form name="edit-cate">
            <div class="form-group">
                <label for="edit_cate_name">分类名称</label>
                <input type="text" class="form-control" id="edit_cate_name" name="cate_name">
            </div>

            <div class="form-group">
                <label for="edit_en_cate_name">英文名称</label>
                <input type="text" class="form-control" id="edit_en_cate_name" name="en_cate_name">
            </div>

            <div class="form-group">
                <label for="edit_cate_sort">排序SORT</label>
                <input type="text" class="form-control" id="edit_cate_sort" name="cate_sort">
            </div>

            <input type="hidden" class="form-control" id="edit_id" name="id">
            <input type="hidden" class="form-control" id="edit_level" name="cate_level">
            <input type="hidden" class="form-control" id="edit_cate_type" name="type">
            
            <button id="edit_sub" type="button" class="btn btn-primary">确认提交</button>
            <div class="glyphicon glyphicon-remove"></div>
        </form>
    </div>
</div>