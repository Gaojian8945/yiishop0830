<a href="<?=\yii\helpers\Url::to('add')?>" class="btn btn-info">添加</a>
<table class="table tab-content">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>简介</th>
        <th>logo</th>
        <th>排序</th>
        <th>是否激活</th>
        <th>操作</th>
    </tr>

    <?php foreach($branks as $brank):?>
        <tr>
            <td><?=$brank->id?></td>
            <td><?=$brank->name?></td>
            <td><?=$brank->intro?></td>
            <td><?=\yii\bootstrap\Html::img("/".$brank->logo,["width"=>'50px'])?></td>
            <td><?=$brank->sort?></td>
            <td><?=$brank->status?></td>
            <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$brank->id])?>" class="btn btn-info">修改</a><a href="<?=\yii\helpers\Url::to(['del','id'=>$brank->id])?>" class="btn btn-info">删除</a> </td>
        </tr>
    <?php endforeach;?>
</table>
