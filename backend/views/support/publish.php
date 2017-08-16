<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\LinkPager;

AppAsset::register($this);
AppAsset::addJs($this, '/statics/widget/ueditor/ueditor.config.js');
AppAsset::addJs($this, '/statics/widget/ueditor/ueditor.all.min.js');
AppAsset::addJs($this, '/statics/widget/ueditor/lang/zh-cn/zh-cn.js');
AppAsset::addJs($this, '/statics/themes/admin/support/publish.js');
AppAsset::addCss($this, '/statics/themes/admin/support/publish.css');

$this->title = '发布解决方案';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['support']];
$this->params['breadcrumbs'][] = $this->title;

// $cat = Yii::$app->request->get('ca_f');
$action = (isset($type) && $type == 'update') ? 'update' : 'add';
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <div class="col-md-10">
        <form class="form-horizontal" name="support">
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
                    <input style="padding-left: 0;" type="file" id="pic" name="pic" class="col-sm-6" value="<?= ($action == 'update') ? $info['pic'] : '' ?>">
                    <span class="col-sm-6" style="color: green;">尺寸：w1200*h300</span>
                    <p class="help-block" id="pic-cover" style="color:green;"><?= ($action == 'update') ? $info['pic'] : '' ?></p>
                    <input type="hidden" name="pic-val" id="pic-val" value="<?= ($action == 'update') ? $info['pic'] : '' ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="desc" class="col-sm-2 control-label">安装环境</label>
                <div class="col-sm-10">
                    <textarea id="desc" name="desc" class="form-control" rows="3" placeholder="安装环境"><?= ($action == 'update') ? $info['desc'] : '' ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="en_desc" class="col-sm-2 control-label">英文环境</label>
                <div class="col-sm-10">
                    <textarea id="en_desc" name="en_desc" class="form-control" rows="3" placeholder="安装环境"><?= ($action == 'update') ? $info['en_desc'] : '' ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="content" class="col-sm-2 control-label">解决方案</label>
                <div class="col-sm-10">
                    <script id="editor" name="content" type="text/plain"><?= ($action == 'update') ? $info['content'] : '' ?></script>
                </div>
            </div>

            <div class="form-group">
                <label for="en_content" class="col-sm-2 control-label">解决方案</label>
                <div class="col-sm-10">
                    <script id="en_editor" name="en_content" type="text/plain"><?= ($action == 'update') ? $info['en_content'] : '' ?></script>
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