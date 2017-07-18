<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

$this->title = '导航栏管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['meau']];
$this->params['breadcrumbs'][] = $this->title;

AppAsset::addCss($this, '/statics/themes/admin/meau/add.css');
AppAsset::addJs($this, '/statics/themes/admin/meau/add.js');
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <div class="admin-form">
        <form name="add-meau">
            <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->csrfToken ?>">
            
            <div class="form-group">
                <label class="control-label" for="meau">菜单名称</label>
                <input type="text" id="meau" class="form-control" name="meau" aria-required="true" aria-invalid="true" value="<?= Html::encode($meau['meau']) ?>">
            </div>

            <div class="form-group">
                <label class="control-label" for="">链接URL</label>
                <input type="text" id="url" class="form-control" name="url" aria-required="true" aria-invalid="false" value="<?= $meau['url'] ?>">
            </div>

            <div class="form-group">
                <label class="control-label" for="">排序SORT<small style="color:#65CEA7;font-weight: normal!important;">（数值越小排序越靠前）</small></label>
                <input type="text" id="sort" class="form-control" name="sort" aria-required="true" value="<?= $meau['sort'] ?>">
            </div>

            <div class="form-group">
                <label class="control-label">下拉菜单配置<small style="color:#65CEA7;font-weight: normal!important;">（最多只能配置8个）</small></label>
                <table class="table table-bordered my-table">
                <?php for ($i=1;$i<=8;$i++): ?>
                    <tr class="<?= $i>1 ? 'else-tr '.$i.'th-tr' : '' ?>" style="<?= $meau['show'][$i-1] ? 'display: table-row;' : ''; if($meau['show'][$i-2] && empty($meau['show'][$i-1])){echo 'display: table-row;';}?>" >
                        <td class="my-td"><?= $i ?> th</td>
                        <td>
                            <div class="picker-wrap">
                                <div class="img-cover" style="<?= $meau['show'][$i-1]['url'] ? 'background-image: url('.$meau['show'][$i-1]['url'].');' : ''; ?>">
                                    <input type="file" name="pic<?= $i ?>" class="img-pick-input" data-next="<?= $i+1 ?>th-tr">
                                </div>
                                <input type="hidden" name="pic-<?= $i ?>[url]" value="<?= $meau['show'][$i-1]['url'] ?>">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-<?= $i ?>-title">标题</label>
                                <input type="text" id="pic-<?= $i ?>-title" class="form-control" name="pic-<?= $i ?>[title]" aria-required="true" aria-invalid="false" value="<?= htmlspecialchars($meau['show'][$i-1]['title']) ?>">
                            </div>
                        </td>
                        <td style="position: relative;">
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-<?= $i ?>-link">链接URL</label>
                                <input type="text" id="pic-<?= $i ?>-link" class="form-control" name="pic-<?= $i ?>[link]" aria-required="true" aria-invalid="false" value="<?= $meau['show'][$i-1]['link'] ?>">
                            </div>
                        </td>
                    </tr>
                <?php endfor ?>
                </table>
            </div>
            
            <div class="form-group">
                <button id="sub" type="button" class="btn btn-success" style="margin-right: 20px;" data-option="update" data-id="<?= $meau['id'] ?>">提交修改</button>
                <a href="" class="btn btn-warning">撤销修改</a>
            </div>

        </form>
    </div>
</div>