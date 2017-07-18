<?php
use yii\helpers\Html;

$this->title = '导航栏管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['meau']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>菜单名称</th>
                <th>浏览</th>
                <th>排序</th>
                <th>下拉菜单</th>
                <th>当前状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($meauList as $row) : ?>
            <tr>
                <td><?= $row['meau'] ?></td>
                <td>
                    <a href="<?= $row['url'] ?>" class="" target="__blank">浏&nbsp;览</a>
                </td>
                <td><?= $row['sort'] ?></td>
                <td>
                    <span class="label <?= empty($row['show']) ? 'label-danger' : 'label-success' ?>"><?= empty($row['show']) ? '无' : '有' ?></span>
                </td>
                <td>
                    <?php
                        if($row['status'] == 1)
                            echo '<span class="label label-success">正常</span>';
                        else
                            echo '<span class="label label-danger">unkonw</span>';
                    ?>   
                </td>
                <td data-csrf="<?php echo Yii::$app->request->csrfToken ?>">
                    <a class="btn btn-primary btn-xs" href="/meau/update?id=<?= $row['id'] ?>" title="更新" aria-label="更新" data-pjax="0">
                        <span class="fa fa-edit"></span> 更新
                    </a>
                    <a data-id="<?= $row['id'] ?>" class="btn btn-danger btn-xs" href="javascript:void(0)" title="删除" aria-label="删除" data-confirm="您确定要删除此项吗？" onclick="del(this)">
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
        $.post('/meau/delete', data, function(json){
            if(json.code == 200){
                window.location.reload();
            }
            else{
                alert('删除失败！');
            }
        });
    }
</script>