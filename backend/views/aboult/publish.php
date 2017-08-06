<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
AppAsset::addJs($this, '/statics/themes/admin/aboult/publish.js');
// AppAsset::addCss($this, '/statics/themes/admin/aboult/publish.css');

$this->title = '发布解决方案';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['aboult']];
$this->params['breadcrumbs'][] = $this->title;

// $cat = Yii::$app->request->get('ca_f');
$action = (isset($type) && $type == 'update') ? 'update' : 'add';
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <div class="col-md-10">
        <form class="form-horizontal" name="aboult">
            <div class="form-group">
                <label for="cover" class="col-sm-2 control-label">资质图片</label>
                <div class="col-sm-10">
                    <input style="padding-left: 0;" type="file" id="img" name="img" class="col-sm-6" value="<?= ($action == 'update') ? $info['img'] : '' ?>">
                    <span class="col-sm-6" style="color: green;">尺寸：w360*h514</span>
                    <p class="help-block" id="img-cover" style="color:green;"><?= ($action == 'update') ? $info['img'] : '' ?></p>
                    <input type="hidden" name="img-val" id="img-val" value="<?= ($action == 'update') ? $info['img'] : '' ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="cover" class="col-sm-2 control-label">资质缩略图</label>
                <div class="col-sm-10">
                    <input style="padding-left: 0;" type="file" id="thumb" name="thumb" class="col-sm-6" value="<?= ($action == 'update') ? $info['thumb'] : '' ?>">
                    <span class="col-sm-6" style="color: green;">尺寸：w127*h137</span>
                    <p class="help-block" id="thumb-cover" style="color:green;"><?= ($action == 'update') ? $info['thumb'] : '' ?></p>
                    <input type="hidden" name="thumb-val" id="thumb-val" value="<?= ($action == 'update') ? $info['thumb'] : '' ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="desc" class="col-sm-2 control-label">资质说明</label>
                <div class="col-sm-10">
                    <textarea id="desc" name="desc" class="form-control" rows="3"><?= ($action == 'update') ? $info['desc'] : '' ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button id="sub" type="button" class="btn btn-primary" data-type="<?= $action ?>" data-id="<?= ($action == 'update') ? $info['id'] : '' ?>">发 布</button>
                </div>
            </div>
        </form>
    </div>
    
</div>