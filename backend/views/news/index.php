<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = '新闻管理';
$this->params['breadcrumbs'][] = ['label' => '内容设置', 'url' => ['news']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="content-index">

    <?=$this->render('_tab_menu');?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>封面</th>
                <th>标题</th>
                <th style="width: 500px;">摘要</th>
                <th>类型</th>
                <th>标签</th>
                <th>状态</th>
                <th>发布时间</th>
                <th style="width: 150px;">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($newsList as $row) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><img src="<?= $row['cover'] ?>" height="100"></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['desc'] ?></td>
                <td>行业新闻</td>
                <td><?= $row['tags'] ?></td>
                <td><?= $row['status'] == 1 ? '<span class="label label-success">已发布</span>' : ($row['status'] == 2 ? '<span class="label label-warning">待发布</span>' : '<span class="label label-danger">unknow</span>') ?></td>
                <td><?= date('Y-m-d H:i', $row['ctime']) ?></td>
                <td data-csrf="<?php echo Yii::$app->request->csrfToken ?>">
                    <a class="btn btn-info btn-xs" href="http://xkkb.com/zh_cn/news/<?= $row['id'] ?>?ca_f=<?= $row['category'] ?>" title="预览" aria-label="预览" data-pjax="0" target="__blank" style="margin-bottom: 5px;">
                        <span class="fa fa-play-circle-o"></span> 预览
                    </a>
                    <a class="btn btn-primary btn-xs" href="/news/edit?id=<?= $row['id'] ?>&ca_f=<?= $row['category'] ?>" title="更新" aria-label="更新" data-pjax="0" style="margin-bottom: 5px;">
                        <span class="fa fa-edit"></span> 更新
                    </a><br/>
                    <?= ($row['status'] == 1) ?
                    '<a data-id="'.$row['id'].'" data-type="1" class="btn btn-warning btn-xs" href="javascript:void(0)" title="下线" aria-label="下线" onclick="update(this)" style="margin-bottom: 5px;">
                        <span class="fa fa-refresh"></span> 下线
                    </a>'
                    :
                    '<a data-id='.$row['id'].' data-type="2" class="btn btn-success btn-xs" href="javascript:void(0)" title="发布" aria-label="发布" onclick="update(this)" style="margin-bottom: 5px;">
                        <span class="fa fa-refresh"></span> 发布
                    </a>' 
                    ?>
                    <a data-id="<?= $row['id'] ?>" data-type="3" class="btn btn-danger btn-xs" href="javascript:void(0)" title="删除" aria-label="删除" onclick="update(this)" style="margin-bottom: 5px;">
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
    function update(obj){
        var id = $(obj).data('id');
        var type = $(obj).data('type');
        var _csrf = $(obj).parent().data('csrf');

        var msg = '';

        msg = type == 1 ? '确定下线？' : (type == 2 ? '确定发布？' : '确定删除？不可逆的哦！！！');
        if(!confirm(msg)) return false;
        
        var data = {'id':id,'type':type,'_csrf-backend':_csrf};

        $.post('/news/update', data, function(json){
            if(json.code == 200){
                window.location.reload();
            }
            else{
                alert('操作失败！');
            }
        });
    }
</script>