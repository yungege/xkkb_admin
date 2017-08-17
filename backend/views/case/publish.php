<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\widgets\LinkPager;
AppAsset::register($this);

$this->title = '应用案例';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['case']];
$this->params['breadcrumbs'][] = $this->title;
AppAsset::addCss($this, '/statics/themes/admin/case/index.css');

AppAsset::addJs($this, '/statics/widget/ueditor/ueditor.config.js');
AppAsset::addJs($this, '/statics/widget/ueditor/ueditor.all.min.js');
AppAsset::addJs($this, '/statics/widget/ueditor/lang/zh-cn/zh-cn.js');
AppAsset::addJs($this, '/statics/themes/admin/case/index.js');

?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <div class="col-md-10">
        <form class="form-horizontal" name="case">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">标题</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" placeholder="title" value="<?= ($action == 'update') ? $info['title'] : '' ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="en_title" class="col-sm-2 control-label">英文标题</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="en_title" name="en_title" placeholder="en title" value="<?= ($action == 'update') ? $info['en_title'] : '' ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="cover" class="col-sm-2 control-label">封面图片</label>
                <div class="col-sm-10">
                    <input style="padding-left: 0;" type="file" id="cover" name="cover" class="col-sm-6" value="<?= ($action == 'update') ? $info['cover'] : '' ?>">
                    <span class="col-sm-6" style="color: green;">尺寸：w380*h350</span>
                    <p class="help-block" id="cover-tip" style="color:green;"><?= ($action == 'update') ? $info['cover'] : '' ?></p>
                    <input type="hidden" name="cover-val" id="cover-val" value="<?= ($action == 'update') ? $info['cover'] : '' ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="editor" class="col-sm-2 control-label">案例内容</label>
                <div class="col-sm-10">
                    <script id="editor" name="content" type="text/plain"><?= ($action == 'update') ? $info['content'] : '' ?></script>
                </div>
            </div>

            <div class="form-group">
                <label for="en_editor" class="col-sm-2 control-label">案例内容</label>
                <div class="col-sm-10">
                    <script id="en_editor" name="en_content" type="text/plain"><?= ($action == 'update') ? $info['en_content'] : '' ?></script>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button id="sub" type="button" class="btn btn-primary" data-cat="<?= $cat ?>" data-type="<?= $action ?>" data-id="<?= ($action == 'update') ? $info['id'] : '' ?>">保存案例</button>
                </div>
            </div>
        </form>
    </div>
</div>