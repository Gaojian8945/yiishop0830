<a href="<?=\yii\helpers\Url::to('add')?>" class="btn btn-info">添加</a>
<table class="table tab-content">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>简介</th>
        <th>状态</th>
        <th>排序</th>
        <th>是否与分类相关</th>
        <th>操作</th>
    </tr>

    <?php foreach($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->intro?></td>
            <td><?=$model->status?></td>
            <td><?=$model->sort?></td>
            <td><?=$model->is_help?></td>
            <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?>" class="btn btn-info">修改</a><a href="<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>" class="btn btn-info">删除</a> </td>
        </tr>
    <?php endforeach;?>
</table>