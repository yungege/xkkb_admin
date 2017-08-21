<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use backend\assets\AppAsset;

AppAsset::register($this);
AppAsset::addJs($this, '/statics/themes/admin/img/add.js');

$this->title = '图片管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['news']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <div class="col-md-10">
        <form name="img">
            <div class="form-group">
                <label for="type" class="col-sm-2 control-label">分类</label>
                <div class="col-sm-10">
                    <select class="form-control" id="type" name="type">
                        <option value="-1">请选择分类</option>
                        <option value="1">工程车间</option>
                        <option value="2">仓库</option>
                    </select>
                </div>
            </div>
            <br/>
            <br/>
            <br/>
            <div class="form-group">
                <label for="img" class="col-sm-2 control-label">展示图片</label>
                <div class="col-sm-10">
                    <input style="padding-left: 0;" type="file" id="img" name="img" class="col-sm-6">
                    <span class="col-sm-6" style="color: green;">尺寸：w264*h315</span>
                    <input type="hidden" name="img-val" id="img-val">
                    <img src="" width="200" id="img-show">
                </div>
            </div>

            <button type="button" id="sub" class="btn btn-sm btn-primary">确认上传</button>
        </form>
    </div>

</div>

<script>
    
</script>