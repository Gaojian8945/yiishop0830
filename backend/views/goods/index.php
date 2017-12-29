<a href="<?=\yii\helpers\Url::to('/goods/add')?>" class="btn btn-info">添加</a><a href="<?=\yii\helpers\Url::to('/goods/recycle')?>" class="btn btn-danger">回收站</a><a href="<?=\yii\helpers\Url::to('/goods/')?>" class="btn btn-danger">首页</a>
<table class="table tab-content">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>编号</th>
        <th>logo</th>
        <th>父类</th>
        <th>市价</th>
        <th>店价</th>
        <th>是否有优惠</th>
        <th>排序</th>
        <th>入库时间</th>
        <th>操作</th>
    </tr>

    <?php foreach($rows as $row):?>
        <tr>
            <td><?=$row->id?></td>
            <td><?=$row->name?></td>
            <td><?=$row->sn?></td>
            <td><?=\yii\bootstrap\Html::img($row->logo,["width"=>'50px'])?></td>
            <td><?=$row->category_id?></td>
            <td><?=$row->market_price?></td>
            <td><?=$row->shop_price?></td>
            <td><?=$row->is_on_sale?></td>
            <td><?=$row->sort?></td>
            <td><?=date('Y-m-d H:i:s',$row->inputtime)?></td>
            <td><td><?php if($row->status == 1){echo "<a href=\"<?=\yii\helpers\Url::to(['edit','id'=>$row->id])?>\" class=\"btn btn-info\">修改</a><a href='".\yii\helpers\Url::to('index?status=0&id='.$row->id)."' class='btn btn-danger'>移入回收站</a>";}else{echo "<a href='".\yii\helpers\Url::to('recycle?status=1&id='.$row->id)."' class='btn btn-danger'>返回显示页面</a>";}?><a href="<?=\yii\helpers\Url::to(['del','id'=>$row->id])?>" class="btn btn-info">删除</a> </td></td>
        </tr>
    <?php endforeach;?>
</table>
