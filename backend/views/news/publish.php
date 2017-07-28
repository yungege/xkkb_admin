<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\LinkPager;

AppAsset::register($this);
AppAsset::addJs($this, '/statics/widget/ueditor/ueditor.config.js');
AppAsset::addJs($this, '/statics/widget/ueditor/ueditor.all.min.js');
AppAsset::addJs($this, '/statics/widget/ueditor/lang/zh-cn/zh-cn.js');
AppAsset::addJs($this, '/statics/themes/admin/news/publish.js');
AppAsset::addCss($this, '/statics/themes/admin/news/publish.css');

$this->title = '新闻管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['news']];
$this->params['breadcrumbs'][] = $this->title;

$cat = Yii::$app->request->get('ca_f');
$action = (isset($type) && $type == 'update') ? 'update' : 'add';
$cat = (isset($cat) && $cat == 10) ? 'xkkb' : 'index';
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <div class="col-md-10">
        <form class="form-horizontal" name="news">
            <div class="form-group">
                <label for="category" class="col-sm-2 control-label">分类</label>
                <div class="col-sm-10">
                    <select class="form-control" id="category" name="category">
                        <option value="-1">请选择分类</option>
                        <option value="9" <?= ($action == 'update' && $info['category'] == 9) ? 'selected' : '' ?> >行业新闻</option>
                        <option value="10" <?= ($action == 'update' && $info['category'] == 10) ? 'selected' : '' ?>>新科凯邦</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">标题</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" placeholder="title" value="<?= ($action == 'update') ? $info['title'] : '' ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="desc" class="col-sm-2 control-label">摘要</label>
                <div class="col-sm-10">
                    <textarea id="desc" name="desc" class="form-control" rows="3" placeholder="摘要"><?= ($action == 'update') ? $info['desc'] : '' ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="cover" class="col-sm-2 control-label">封面图片</label>
                <div class="col-sm-10">
                    <input style="padding-left: 0;" type="file" id="cover" name="cover" class="col-sm-6" value="<?= ($action == 'update') ? $info['cover'] : '' ?>">
                    <span class="col-sm-6" style="color: green;">尺寸：w260*h240</span>
                    <p class="help-block" id="pic-cover" style="color:green;"><?= ($action == 'update') ? $info['cover'] : '' ?></p>
                    <input type="hidden" name="cover-val" id="cover-val" value="<?= ($action == 'update') ? $info['cover'] : '' ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="content" class="col-sm-2 control-label">新闻内容</label>
                <div class="col-sm-10">
                    <script id="editor" type="text/plain"><?= ($action == 'update') ? $info['content'] : '' ?></script>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button id="sub" type="button" class="btn btn-primary" data-cat="<?= $cat ?>" data-type="<?= $action ?>" data-id="<?= ($action == 'update') ? $info['id'] : '' ?>">保存新闻稿</button>
                </div>
            </div>
        </form>
    </div>
    
</div>