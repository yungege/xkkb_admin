<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

$this->title = '新增Banner';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['banner']];
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <div class="admin-form">
        <form name="add-banner">
            <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->csrfToken ?>">

            <div class="form-group">
                <label class="control-label" for="img">Banner图</label>
                <input type="file" id="img" class="form-control" name="img" aria-required="true" aria-invalid="false" value="">
            </div>
            
            <div class="form-group">
                <label class="control-label" for="meau_color">菜单颜色</label>
                <input type="text" id="meau_color" class="form-control" name="meau_color" aria-required="true" aria-invalid="true" value="">
            </div>

            <div class="form-group">
                <label class="control-label" for="">链接URL</label>
                <input type="text" id="url" class="form-control" name="url" aria-required="true" aria-invalid="false" value="">
            </div>

            <div class="form-group">
                <label class="control-label" for="">排序SORT<small style="color:#65CEA7;font-weight: normal!important;">（数值越小排序越靠前）</small></label>
                <input type="text" id="sort" class="form-control" name="sort" aria-required="true" value="">
            </div>
            
            <div class="form-group">
                <button id="sub" type="button" class="btn btn-success" style="margin-right: 20px;" data-option="update" data-id="<?= $banner['id'] ?>">提交修改</button>
                <a href="" class="btn btn-warning">撤销修改</a>
            </div>

        </form>
    </div>
</div>