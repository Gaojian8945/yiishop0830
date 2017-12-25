<a href="<?=\yii\helpers\Url::to('index')?>" class="btn btn-info">文章首页</a><a href="<?=\yii\helpers\Url::to('add')?>" class="btn btn-info">添加</a><a href="<?=\yii\helpers\Url::to('recycle')?>" class="btn btn-danger">回收站</a>
<table class="table tab-content">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>分类</th>
        <th>简介</th>
        <th>排序</th>
        <th>是否与分类相关</th>
        <th>操作</th>
    </tr>

    <?php foreach($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->cateName->name?></td>
            <td><?=$model->intro?></td>
            <td><?=$model->sort?></td>
            <td><?=$model->create_time?></td>
            <td><?php if($model->status == 1){echo "<a href=\"<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?>\" class=\"btn btn-info\">修改</a><a href='".\yii\helpers\Url::to('index?status=0&id='.$model->id)."' class='btn btn-danger'>移入回收站</a>";}else{echo "<a href='".\yii\helpers\Url::to('recycle?status=1&id='.$model->id)."' class='btn btn-danger'>返回显示页面</a>";}?><a href="<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>" class="btn btn-info">删除</a> </td>
        </tr>
    <?php endforeach;?>
</table>