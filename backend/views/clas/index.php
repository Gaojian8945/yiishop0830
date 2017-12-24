<a href="<?=\yii\helpers\Url::to('add')?>" class="btn btn-info">添加</a>
<table class="table tab-content">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>简介</th>
        <th>最后编辑时间</th>
        <th>操作</th>
    </tr>

    <?php foreach($rows as $row):?>
        <tr>
            <td><?=$row->id?></td>
            <td><?=$row->name?></td>
            <td><?=$row->info?></td>
            <td><?=date("Y-m-d H:s:m",$row->time)?></td>
            <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$row->id])?>" class="btn btn-info">修改</a><a href="<?=\yii\helpers\Url::to(['del','id'=>$row->id])?>" class="btn btn-info">删除</a> </td>
        </tr>
    <?php endforeach;?>
</table>