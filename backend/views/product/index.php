<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use backend\assets\AppAsset;

$this->title = '产品管理';
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
    <h4 style="border-left: 5px solid #65CEA7;padding-left: 15px;margin-top: 50px;">产品列表</h4>

    <div style="border:1px solid #ccc;padding: 15px;margin-bottom: 15px;">
        <form name="pro" class="" style="border:1px solid #ccc;padding-top: 15px;padding-bottom: 15px;margin-bottom: 15px;">
            <div class="form-group">
                <label class="col-sm-1 control-label" style="padding-top: 8px;">二级分类 :</label>
                <div class="col-sm-3">
                    <select class="form-control" name="stype">
                        <option value="0">全部</option>
                        <?php foreach ($ctype as $cval): ?>
                            <option value="<?= $cval['id'] ?>" <?= Yii::$app->request->get('stype') == $cval['id'] ? 'selected' : '' ?> ><?= Html::encode($cval['cate_name']) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <br/><br/>
            <button type="submit" class="btn btn-primary" style="margin-left: 15px;">确认</button>
        </form>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>封面</th>
                    <th>产品名称</th>
                    <th>英文名称</th>
                    <th>产品型号</th>
                    <th>敷设方式</th>
                    <th>二级分类</th>
                    <th>上线时间</th>
                    <th style="width: 130px;">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proList as $pval): ?>
                <tr>
                    <td><?= $pval['id'] ?></td>
                    <td><img src="<?= $pval['pro_cover_pic'] ?>" width="200"></td>
                    <td><?= $pval['pro_name'] ?></td>
                    <td><?= $pval['en_pro_name'] ?></td>
                    <td><?= $pval['pro_model'] ?></td>
                    <td><?= $pval['pro_fs_type'] ?></td>
                    <td><?= $ctype[$pval['pro_second_type']]['cate_name'] ?></td>
                    <td>
                        <?= date('Y-m-d', $pval['ctime']) ?><br/>
                        <?= date('H:i:s', $pval['ctime']) ?>
                    </td>
                    <td data-csrf="<?= Yii::$app->request->csrfToken ?>">
                        <a class="btn btn-info btn-xs" href="http://www.xkkb.com.cn/zh_cn/product/<?= $pval['id'] ?>?ca_f=<?= $pval['pro_first_type'] ?>&ca_s=<?= $pval['pro_second_type'] ?>" title="预览" aria-label="预览" data-pjax="0" target="__blank" style="margin-bottom: 5px;">
                        <span class="fa fa-play-circle-o"></span> 预览
                    </a>
                    <a class="btn btn-primary btn-xs" href="/product/update?id=<?= $pval['id'] ?>&ca_f=<?= $pval['pro_first_type'] ?>&ca_s=<?= $pval['pro_second_type'] ?>" title="更新" aria-label="更新" data-pjax="0" style="margin-bottom: 5px;">
                        <span class="fa fa-edit"></span> 更新
                    </a><br/>
                    <a data-id="<?= $pval['id'] ?>" class="btn btn-danger btn-xs" href="javascript:void(0)" title="删除" aria-label="删除" onclick="del(this)" style="margin-bottom: 5px;">
                        <span class="fa fa-times"></span> 删除
                    </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

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

    <h4 style="border-left: 5px solid #65CEA7;padding-left: 15px;margin-top: 50px;">添加产品</h4>
    <div style="border:1px solid #ccc;padding: 15px;">
        <form name="add">
            <input type="hidden" name="pro_first_type" value="<?= $ftype ?>">
            <div class="form-group">
                <label for="">二级分类</label>
                <select class="form-control" name="pro_second_type">
                    <option value="-1">请选择分类</option>
                    <?php foreach ($ctype as $cval): ?>
                        <option value="<?= $cval['id'] ?>" <?= Yii::$app->request->get('stype') == $cval['id'] ? 'selected' : '' ?> ><?= Html::encode($cval['cate_name']) ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label for="pro_name">产品名称</label>
                <input type="text" class="form-control" id="pro_name" name="pro_name">
            </div>

            <div class="form-group">
                <label for="en_pro_name">英文名称</label>
                <input type="text" class="form-control" id="en_pro_name" name="en_pro_name">
            </div>

            <div class="form-group">
                <label for="pro_model">产品型号</label>
                <input type="text" class="form-control" id="pro_model" name="pro_model">
            </div>

            <div class="form-group">
                <label for="pro_fs_type">敷设方式</label>
                <input type="text" class="form-control" id="pro_fs_type" name="pro_fs_type">
            </div>

            <div class="form-group">
                <label for="en_pro_fs_type">英文敷设</label>
                <input type="text" class="form-control" id="en_pro_fs_type" name="en_pro_fs_type">
            </div>

            <div class="form-group">
                <label for="pro_cover_pic_val">封面图片(一)</label>
                <div class="">
                    <input style="padding-left: 0;" type="file" id="pro_cover_pic_val" name="pro_cover_pic_val" class="col-sm-4" value="">
                    <span class="col-sm-6" style="color: green;">尺寸：w600*h190</span>
                    <p class="help-block" id="pro_cover_pic_tip" style="color:green;padding-top:30px;text-align: left;"></p>
                    <input type="hidden" name="pro_cover_pic" id="pro_cover_pic" value="">
                </div>
            </div>

            <div class="form-group">
                <label for="en_pro_cover_pic_val">英文封面(一)</label>
                <div class="">
                    <input style="padding-left: 0;" type="file" id="en_pro_cover_pic_val" name="en_pro_cover_pic_val" class="col-sm-4" value="">
                    <span class="col-sm-6" style="color: green;">尺寸：w600*h190</span>
                    <p class="help-block" id="en_pro_cover_pic_tip" style="color:green;padding-top:30px;text-align: left;"></p>
                    <input type="hidden" name="en_pro_cover_pic" id="en_pro_cover_pic" value="">
                </div>
            </div>

            <div class="form-group" style="">
                <label for="pro_cover_pic_2_val">封面图片(二)</label>
                <div class="">
                    <input style="padding-left: 0;" type="file" id="pro_cover_pic_2_val" name="pro_cover_pic_2_val" class="col-sm-4" value="">
                    <span class="col-sm-6" style="color: green;">尺寸：w600*h190</span>
                    <p class="help-block" id="pro_cover_pic_2_tip" style="color:green;padding-top:30px;text-align: left;"></p>
                    <input type="hidden" name="pro_cover_pic_2" id="pro_cover_pic_2" value="">
                </div>
            </div>

            <div class="form-group" style="">
                <label for="en_pro_cover_pic_2_val">英文封面(二)</label>
                <div class="">
                    <input style="padding-left: 0;" type="file" id="en_pro_cover_pic_2_val" name="en_pro_cover_pic_2_val" class="col-sm-4" value="">
                    <span class="col-sm-6" style="color: green;">尺寸：w600*h190</span>
                    <p class="help-block" id="en_pro_cover_pic_2_tip" style="color:green;padding-top:30px;text-align: left;"></p>
                    <input type="hidden" name="en_pro_cover_pic_2" id="en_pro_cover_pic_2" value="">
                </div>
            </div>

            <div class="form-group" style="">
                <label for="pro_tec_params_val" class="">参数图片</label>
                <div class="">
                    <input style="padding-left: 0;" type="file" id="pro_tec_params_val" name="pro_tec_params_val" class="col-sm-4" value="">
                    <span class="col-sm-6" style="color: green;">尺寸：最佳宽度1200px</span>
                    <p class="help-block" id="pro_tec_params_tip" style="color:green;padding-top:30px;text-align: left;"></p>
                    <input type="hidden" name="pro_tec_params" id="pro_tec_params" value="">
                </div>
            </div>

            <div class="form-group" style="">
                <label for="en_pro_tec_params_val" class="">英文参数图片</label>
                <div class="">
                    <input style="padding-left: 0;" type="file" id="en_pro_tec_params_val" name="en_pro_tec_params_val" class="col-sm-4" value="">
                    <span class="col-sm-6" style="color: green;">尺寸：最佳宽度1200px</span>
                    <p class="help-block" id="en_pro_tec_params_tip" style="color:green;padding-top:30px;text-align: left;"></p>
                    <input type="hidden" name="en_pro_tec_params" id="en_pro_tec_params" value="">
                </div>
            </div>

            <div class="form-group" style="">
                <label for="content">产品描述</label>
                <div class="">
                    <script id="editor" name="pro_desc" type="text/plain"></script>
                </div>
            </div>

            <div class="form-group" style="">
                <label for="content">英文描述</label>
                <div class="">
                    <script id="en_editor" name="en_pro_desc" type="text/plain"></script>
                </div>
            </div>

            <button type="button" id="sub" class="btn btn-primary">新增产品</button>

        </form>
    </div>
    
</div>

<script>
    function del(obj){
        var id = $(obj).data('id');
        var _csrf = $(obj).parent().data('csrf');

        if(!confirm('确定删除？不可逆操作！！！')) return false;
        
        var data = {'id':id,'_csrf-backend':_csrf};

        $.post('/product/delete', data, function(json){
            if(json.code == 200){
                window.location.reload();
            }
            else{
                alert('操作失败！');
            }
        });
    }
</script>