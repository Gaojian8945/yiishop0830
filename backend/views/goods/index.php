<div class="row">
    <div class="pull-left">
        <?=\yii\bootstrap\Html::a("添加",['add'],['class'=>"btn btn-info"])?>
    </div>
    <div class="pull-right">
        <form class="form-inline">
            <div class="form-group">
                <select class="form-control" name="status">
                    <option>选择状态</option>
                    <option value="1" <?=Yii::$app->request->get('status')==="1"?"selected":""?>>上架</option>
                    <option value="0" <?=Yii::$app->request->get('status')==="0"?"selected":""?>>下架</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" size="3" class="form-control" name='minPrice' placeholder="最低价" value="<?=Yii::$app->request->get('minPrice')?>">
            </div>
            -
            <div class="form-group">
                <input type="text" size="3" class="form-control" name="maxPrice" placeholder="最高价" value="<?=Yii::$app->request->get('maxPrice')?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="keyword" placeholder="请输入名称或货号" value="<?=Yii::$app->request->get('keyword')?>">
            </div>
            <button type="submit" class="btn btn-default">搜索</button>
        </form>
    </div>
</div>
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
            <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$row->id])?>" class="btn btn-info">修改</a><a href="<?=\yii\helpers\Url::to(['del','id'=>$row->id])?>" class="btn btn-info">删除</a> </td></td>
        </tr>
    <?php endforeach;?>
</table>

<?php echo \yii\widgets\LinkPager::widget([
'pagination' => $pages,
]);
