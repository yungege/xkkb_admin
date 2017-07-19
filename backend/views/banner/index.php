<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

AppAsset::addCss($this, '/statics/themes/admin/banner/index.css');

$this->title = 'Banner管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['banner']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>图片</th>
                <th>浏览</th>
                <th>排序</th>
                <th>菜单颜色</th>
                <th>当前状态</th>
                <th>上传时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bannerList as $row) : ?>
            <tr>
                <td style="width: 300px;"><img src="<?= $row['img'] ?>" width="300"></td>
                <td><a href="<?= $row['url'] ?>">浏览</a></td>
                <td><?= $row['sort'] ?></td>
                <td><div style="background-color: <?= $row['meau_color'] ?>;border:1px dashed black;"><?= $row['meau_color'] ?></div></td>
                <td>
                    <?php
                        if($row['status'] == 1)
                            echo '<span class="label label-success">正常</span>';
                        else
                            echo '<span class="label label-danger">unkonw</span>';
                    ?>
                </td>
                <td><?= date('Y-m-d H:i:s', $row['ctime']) ?></td>
                <td data-csrf="<?php echo Yii::$app->request->csrfToken ?>">
                    <a class="btn btn-primary btn-xs" href="/banner/update?id=<?= $row['id'] ?>" title="更新" aria-label="更新" data-pjax="0">
                        <span class="fa fa-edit"></span> 更新
                    </a>
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
        $.post('/banner/delete', data, function(json){
            if(json.code == 200){
                window.location.reload();
            }
            else{
                alert('删除失败！');
            }
        });
    }
</script>