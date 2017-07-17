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
                <input type="text" id="meau" class="form-control" name="meau" aria-required="true" aria-invalid="true">
            </div>

            <div class="form-group">
                <label class="control-label" for="">链接URL</label>
                <input type="text" id="url" class="form-control" name="url" aria-required="true" aria-invalid="false">
            </div>

            <div class="form-group">
                <label class="control-label" for="">排序SORT<small style="color:#65CEA7;font-weight: normal!important;">（数值越小排序越靠前）</small></label>
                <input type="text" id="sort" class="form-control" name="sort" aria-required="true">
            </div>

            <div class="form-group">
                <label class="control-label">下拉菜单配置<small style="color:#65CEA7;font-weight: normal!important;">（最多只能配置8个）</small></label>
                <table class="table table-bordered my-table">
                    <tr>
                        <td class="my-td">1 th</td>
                        <td>
                            <div class="picker-wrap">
                                <div class="img-cover">
                                    <input type="file" name="pic1" class="img-pick-input" data-next="2th-tr">
                                </div>
                                <input type="hidden" name="pic-1['url']">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-1-title">标题</label>
                                <input type="text" id="pic-1-title" class="form-control" name="pic-1['title']" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-1-link">链接URL</label>
                                <input type="text" id="pic-1-link" class="form-control" name="pic-1['link']" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                    </tr>
                    <tr class="2th-tr else-tr">
                        <td class="my-td">2 th</td>
                        <td>
                            <div class="picker-wrap">
                                <div class="img-cover">
                                    <input type="file" name="pic2" class="img-pick-input" data-next="3th-tr">
                                </div>
                                <input type="hidden" name="pic-2-url">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-2-title">标题</label>
                                <input type="text" id="pic-2-title" class="form-control" name="pic-2-title" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-2-link">链接URL</label>
                                <input type="text" id="pic-2-link" class="form-control" name="pic-2-link" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                    </tr>
                    <tr class="3th-tr else-tr">
                        <td class="my-td">3 th</td>
                        <td>
                            <div class="picker-wrap">
                                <div class="img-cover">
                                    <input type="file" name="pic3" class="img-pick-input" data-next="4th-tr">
                                </div>
                                <input type="hidden" name="pic-3-url">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-3-title">标题</label>
                                <input type="text" id="pic-3-title" class="form-control" name="pic-3-title" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-3-link">链接URL</label>
                                <input type="text" id="pic-3-link" class="form-control" name="pic-3-link" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                    </tr>
                    <tr class="4th-tr else-tr">
                        <td class="my-td">4 th</td>
                        <td>
                            <div class="picker-wrap">
                                <div class="img-cover">
                                    <input type="file" name="pic4" class="img-pick-input" data-next="5th-tr">
                                </div>
                                <input type="hidden" name="pic-4-url">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-4-title">标题</label>
                                <input type="text" id="pic-4-title" class="form-control" name="pic-4-title" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-4-link">链接URL</label>
                                <input type="text" id="pic-4-link" class="form-control" name="pic-4-link" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                    </tr>
                    <tr class="5th-tr else-tr">
                        <td class="my-td">5 th</td>
                        <td>
                            <div class="picker-wrap">
                                <div class="img-cover">
                                    <input type="file" name="pic5" class="img-pick-input" data-next="6th-tr">
                                </div>
                                <input type="hidden" name="pic-5-url">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-5-title">标题</label>
                                <input type="text" id="pic-5-title" class="form-control" name="pic-5-title" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-5-link">链接URL</label>
                                <input type="text" id="pic-5-link" class="form-control" name="pic-5-link" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                    </tr>
                    <tr class="6th-tr else-tr">
                        <td class="my-td">6 th</td>
                        <td>
                            <div class="picker-wrap">
                                <div class="img-cover">
                                    <input type="file" name="pic6" class="img-pick-input" data-next="7th-tr">
                                </div>
                                <input type="hidden" name="pic-6-url">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-6-title">标题</label>
                                <input type="text" id="pic-6-title" class="form-control" name="pic-6-title" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-6-link">链接URL</label>
                                <input type="text" id="pic-6-link" class="form-control" name="pic-6-link" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                    </tr>
                    <tr class="7th-tr else-tr">
                        <td class="my-td">7 th</td>
                        <td>
                            <div class="picker-wrap">
                                <div class="img-cover">
                                    <input type="file" name="pic1" class="img-pick-input" data-next="8th-tr">
                                </div>
                                <input type="hidden" name="pic-7-url">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-7-title">标题</label>
                                <input type="text" id="pic-7-title" class="form-control" name="pic-7-title" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-7-link">链接URL</label>
                                <input type="text" id="pic-7-link" class="form-control" name="pic-7-link" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                    </tr>
                    <tr class="8th-tr else-tr">
                        <td class="my-td">8 th</td>
                        <td>
                            <div class="picker-wrap">
                                <div class="img-cover">
                                    <input type="file" name="pic8" class="img-pick-input">
                                </div>
                                <input type="hidden" name="pic-8-url">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-8-title">标题</label>
                                <input type="text" id="pic-8-title" class="form-control" name="pic-8-title" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                        <td>
                            <div class="form-group margin-top-30">
                                <label class="control-label" for="pic-8-link">链接URL</label>
                                <input type="text" id="pic-8-link" class="form-control" name="pic-8-link" aria-required="true" aria-invalid="false">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- <div class="form-group field-admin-status">
                <label class="control-label">状态</label>
                <input type="hidden" name="Admin[status]" value=""><div id="admin-status"><label><input type="radio" name="Admin[status]" value="0"> 禁用</label>
                <label><input type="radio" name="Admin[status]" value="1" checked=""> 启用</label></div>

                <div class="help-block"></div>
            </div> -->
            <div class="form-group">
                <button id="sub" type="button" class="btn btn-success" style="margin-right: 20px;">创&nbsp;建</button>
                <input  type="reset" name="reset" value="重 置" class="btn btn-warning">
            </div>

        </form>
    </div>
</div>