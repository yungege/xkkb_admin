<?php
use yii\helpers\Html;

$this->title = '导航栏管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['meau']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <div class="admin-form">
        <form name="addmeau">
            <input type="hidden" name="_csrf-backend" value="<?= Yii::$app->request->csrfToken ?>">
            
            <div class="form-group field-admin-username required has-error">
                <label class="control-label" for="admin-username">用户名</label>
                <input type="text" id="admin-username" class="form-control" name="Admin[username]" maxlength="15" aria-required="true" aria-invalid="true">

                <div class="help-block">用户名应该包含至少6个字符。</div>
            </div>

            <div class="form-group field-admin-password required has-success">
                <label class="control-label" for="admin-password">密码</label>
                <input type="password" id="admin-password" class="form-control" name="Admin[password]" aria-required="true" aria-invalid="false">

                <div class="help-block"></div>
            </div>

            <div class="form-group field-admin-email required">
                <label class="control-label" for="admin-email">Email</label>
                <input type="text" id="admin-email" class="form-control" name="Admin[email]" aria-required="true">

                <div class="help-block"></div>
            </div>
            
            <div class="form-group field-admin-status">
                <label class="control-label">状态</label>
                <input type="hidden" name="Admin[status]" value=""><div id="admin-status"><label><input type="radio" name="Admin[status]" value="0"> 禁用</label>
                <label><input type="radio" name="Admin[status]" value="1" checked=""> 启用</label></div>

                <div class="help-block"></div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">创建</button>
            </div>

        </form>
    </div>
</div>