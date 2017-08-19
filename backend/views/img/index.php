<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = '图片管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['news']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>图片</th>
                <th>上传时间</th>
                <th style="width: 150px;">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($imgs as $row) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><img src="<?= $row['img'] ?>" height="100"></td>
                <td><?= date('Y-m-d H:i', $row['ctime']) ?></td>
                <td data-csrf="<?php echo Yii::$app->request->csrfToken ?>">
                    <a data-id="<?= $row['id'] ?>" class="btn btn-danger btn-xs" href="javascript:void(0)" title="删除" aria-label="删除" onclick="del(this)" style="margin-bottom: 5px;">
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

<script>
    function del(obj){
        var id = $(obj).data('id');
        var _csrf = $(obj).parent().data('csrf');
        var msg = '确定删除？不可逆的哦！！！';

        if(!confirm(msg)) return false;
        
        var data = {'id':id,'_csrf-backend':_csrf};

        $.post('/img/delete', data, function(json){
            if(json.code == 200){
                window.location.reload();
            }
            else{
                alert('操作失败！');
            }
        });
    }
</script>