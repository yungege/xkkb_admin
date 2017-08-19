<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use backend\assets\AppAsset;

$this->title = '产品编辑';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['product']];
$this->params['breadcrumbs'][] = $this->title;

AppAsset::addJs($this, '/statics/widget/ueditor/ueditor.config.js');
AppAsset::addJs($this, '/statics/widget/ueditor/ueditor.all.min.js');
AppAsset::addJs($this, '/statics/widget/ueditor/lang/zh-cn/zh-cn.js');
AppAsset::addJs($this, '/statics/themes/admin/product/publish.js');

AppAsset::addCss($this, '/statics/themes/admin/product/publish.css');
?>

<div class="content-index">
    <?=$this->render('_tab_menu');?>

    <h4 style="border-left: 5px solid #65CEA7;padding-left: 15px;margin-top: 12px;margin-bottom: 20px;">修改产品</h4>
    <div style="border:1px solid #ccc;padding: 15px;">
        <form name="add">
            <input type="hidden" name="pro_first_type" value="<?= $ca_f ?>">
            <div class="form-group">
                <label for="">二级分类</label>
                <select class="form-control" name="pro_second_type">
                    <?php foreach ($ctype as $cval): ?>
                        <option <?= $ca_s == $cval['id'] ? 'selected' : '' ?> value="<?= $cval['id'] ?>" <?= Yii::$app->request->get('stype') == $cval['id'] ? 'selected' : '' ?> ><?= Html::encode($cval['cate_name']) ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label for="pro_name">产品名称</label>
                <input type="text" class="form-control" id="pro_name" name="pro_name" value="<?= $info['pro_name'] ?>">
            </div>

            <div class="form-group">
                <label for="en_pro_name">英文名称</label>
                <input type="text" class="form-control" id="en_pro_name" name="en_pro_name" value="<?= $info['en_pro_name'] ?>">
            </div>

            <div class="form-group">
                <label for="pro_model">产品型号</label>
                <input type="text" class="form-control" id="pro_model" name="pro_model" value="<?= $info['pro_model'] ?>">
            </div>

            <div class="form-group">
                <label for="pro_fs_type">敷设方式</label>
                <input type="text" class="form-control" id="pro_fs_type" name="pro_fs_type" value="<?= $info['pro_fs_type'] ?>">
            </div>

            <div class="form-group">
                <label for="en_pro_fs_type">英文敷设</label>
                <input type="text" class="form-control" id="en_pro_fs_type" name="en_pro_fs_type" value="<?= $info['en_pro_fs_type'] ?>">
            </div>

            <div class="form-group">
                <label for="pro_cover_pic_val">封面图片(一)</label>
                <div class="">
                    <input style="padding-left: 0;" type="file" id="pro_cover_pic_val" name="pro_cover_pic_val" class="col-sm-4" value="<?= $info['pro_cover_pic'] ?>">
                    <span class="col-sm-6" style="color: green;">尺寸：w600*h190</span>
                    <p class="help-block" id="pro_cover_pic_tip" style="color:green;padding-top:30px;text-align: left;"><?= $info['pro_cover_pic'] ?></p>
                    <input type="hidden" name="pro_cover_pic" id="pro_cover_pic" value="<?= $info['pro_cover_pic'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="en_pro_cover_pic_val">英文封面(一)</label>
                <div class="">
                    <input style="padding-left: 0;" type="file" id="en_pro_cover_pic_val" name="en_pro_cover_pic_val" class="col-sm-4" value="<?= $info['en_pro_cover_pic'] ?>">
                    <span class="col-sm-6" style="color: green;">尺寸：w600*h190</span>
                    <p class="help-block" id="en_pro_cover_pic_tip" style="color:green;padding-top:30px;text-align: left;"><?= $info['en_pro_cover_pic'] ?></p>
                    <input type="hidden" name="en_pro_cover_pic" id="en_pro_cover_pic" value="<?= $info['en_pro_cover_pic'] ?>">
                </div>
            </div>

            <div class="form-group" style="">
                <label for="pro_cover_pic_2_val">封面图片(二)</label>
                <div class="">
                    <input style="padding-left: 0;" type="file" id="pro_cover_pic_2_val" name="pro_cover_pic_2_val" class="col-sm-4" value="<?= $info['pro_cover_pic_2'] ?>">
                    <span class="col-sm-6" style="color: green;">尺寸：w600*h190</span>
                    <p class="help-block" id="pro_cover_pic_2_tip" style="color:green;padding-top:30px;text-align: left;"><?= $info['pro_cover_pic_2'] ?></p>
                    <input type="hidden" name="pro_cover_pic_2" id="pro_cover_pic_2" value="<?= $info['pro_cover_pic_2'] ?>">
                </div>
            </div>

            <div class="form-group" style="">
                <label for="en_pro_cover_pic_2_val">英文封面(二)</label>
                <div class="">
                    <input style="padding-left: 0;" type="file" id="en_pro_cover_pic_2_val" name="en_pro_cover_pic_2_val" class="col-sm-4" value="<?= $info['en_pro_cover_pic_2'] ?>">
                    <span class="col-sm-6" style="color: green;">尺寸：w600*h190</span>
                    <p class="help-block" id="en_pro_cover_pic_2_tip" style="color:green;padding-top:30px;text-align: left;"><?= $info['en_pro_cover_pic_2'] ?></p>
                    <input type="hidden" name="en_pro_cover_pic_2" id="en_pro_cover_pic_2" value="<?= $info['en_pro_cover_pic_2'] ?>">
                </div>
            </div>

            <div class="form-group" style="">
                <label for="pro_tec_params_val" class="">参数图片</label>
                <div class="">
                    <input style="padding-left: 0;" type="file" id="pro_tec_params_val" name="pro_tec_params_val" class="col-sm-4" value="<?= $info['pro_tec_params'] ?>">
                    <span class="col-sm-6" style="color: green;">尺寸：最佳宽度1200px</span>
                    <p class="help-block" id="pro_tec_params_tip" style="color:green;padding-top:30px;text-align: left;"><?= $info['pro_tec_params'] ?></p>
                    <input type="hidden" name="pro_tec_params" id="pro_tec_params" value="<?= $info['pro_tec_params'] ?>">
                </div>
            </div>

            <div class="form-group" style="">
                <label for="en_pro_tec_params_val" class="">英文参数图片</label>
                <div class="">
                    <input style="padding-left: 0;" type="file" id="en_pro_tec_params_val" name="en_pro_tec_params_val" class="col-sm-4" value="<?= $info['en_pro_tec_params'] ?>">
                    <span class="col-sm-6" style="color: green;">尺寸：最佳宽度1200px</span>
                    <p class="help-block" id="en_pro_tec_params_tip" style="color:green;padding-top:30px;text-align: left;"><?= $info['en_pro_tec_params'] ?></p>
                    <input type="hidden" name="en_pro_tec_params" id="en_pro_tec_params" value="<?= $info['en_pro_tec_params'] ?>">
                </div>
            </div>

            <div class="form-group" style="">
                <label for="content">产品描述</label>
                <div class="">
                    <script id="editor" name="pro_desc" type="text/plain"><?= Html::decode($info['pro_desc']) ?></script>
                </div>
            </div>

            <div class="form-group" style="">
                <label for="content">英文描述</label>
                <div class="">
                    <script id="en_editor" name="en_pro_desc" type="text/plain"><?= Html::decode($info['en_pro_desc']) ?></script>
                </div>
            </div>

            <button type="button" id="sub" class="btn btn-primary" data-action="update" data-id="<?= $id ?>">修改提交</button>

        </form>
    </div>
</div>