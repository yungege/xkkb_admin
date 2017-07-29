<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = '解决方案';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['support']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>封面</th>
                <th>发布时间</th>
                <th style="width: 150px;">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($supportList as $row) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><img src="<?= $row['pic'] ?>" width="300"></td>
                <td><?= date('Y-m-d H:i', $row['ctime']) ?></td>
                <td data-csrf="<?php echo Yii::$app->request->csrfToken ?>">
                    <a class="btn btn-info btn-xs" href="http://xkkb.com/zh_cn/support/<?= $row['id'] ?>?ca_f=<?= $row['category'] ?>" title="预览" aria-label="预览" data-pjax="0" target="__blank" style="margin-bottom: 5px;">
                        <span class="fa fa-play-circle-o"></span> 预览
                    </a>
                    <a class="btn btn-primary btn-xs" href="/support/edit?id=<?= $row['id'] ?>&ca_f=<?= $row['category'] ?>" title="更新" aria-label="更新" data-pjax="0" style="margin-bottom: 5px;">
                        <span class="fa fa-edit"></span> 更新
                    </a><br/>
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

        if(!confirm('确定删除？不可逆操作！！！')) return false;
        
        var data = {'id':id,'_csrf-backend':_csrf};

        $.post('/support/delete', data, function(json){
            if(json.code == 200){
                window.location.reload();
            }
            else{
                alert('操作失败！');
            }
        });
    }
</script>