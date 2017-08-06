<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

AppAsset::addCss($this, '/statics/themes/admin/aboult/index.css');

$this->title = '资质管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['aboult']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>资质</th>
                <th>简介</th>
                <th>上传时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($aboultList as $row) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><img src="<?= $row['thumb'] ?>" height="150"></td>
                <td><?= Html::encode($row['desc']) ?></td>
                <td><?= date('Y-m-d H:i:s', $row['ctime']) ?></td>
                <td>
                    <a data-id="<?= $row['id'] ?>" class="btn btn-danger btn-xs" href="javascript:void(0)" title="删除" aria-label="删除" onclick="del(this)">
                        <span class="fa fa-times"></span> 删除
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<script>
    function del(obj){
        if(!confirm('您确定要删除此项吗？')) return false;
        var id = $(obj).data('id');
        var _csrf = $(obj).parent().data('csrf');
        var data = {'id':id,'_csrf-backend':_csrf};
        $.post('/aboult/delete', data, function(json){
            if(json.code == 200){
                window.location.reload();
            }
            else{
                alert('删除失败！');
            }
        });
    }
</script>