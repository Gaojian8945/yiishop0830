<?php
/* @var $this yii\web\View */

?>
<a href="<?=\yii\helpers\Url::to('/goods-category/add')?>" class="btn btn-info">添加</a>
<table class="table tab-content">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>简介</th>
        <th>父类id</th>
        <th>操作</th>
    </tr>
    <?php foreach($rows as $row):?>
        <tr class="code_cn" data-lft="<?=$row->lft?>" data-rgt="<?=$row->rgt?>" data-tree="<?=$row->tree?>" >
            <td><span class="glyphicon glyphicon-plus"></span><?=$row->id?></td>
            <td><?=str_repeat('--',$row->depth).$row->name?></td>
            <td><?=$row->intro?></td>
            <td><?=$row->parent_id?></td>
            <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$row->id])?>" class="btn btn-info">修改</a><a href="<?=\yii\helpers\Url::to(['del','id'=>$row->id])?>" class="btn btn-info">删除</a> </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
$js = <<<JS
$(function() {
  $('.code_cn').click(function() {
    //console.debug(111);
    var tr=$(this);
    //隐藏图标
    tr.find('span').toggleClass('glyphicon glyphicon-plus');
    tr.find('span').toggleClass('glyphicon glyphicon-minus');
    
    var lft_parent=tr.attr('data-lft');//选中的lft
    var rgt_parent=tr.attr('data-rgt');//选中的右值
    var tree_parent=tr.attr('data-tree');//选中的右值
    //console.log(lft_parent,rgt_parent,tree_parent);
    
    $('.code_cn').each(function(k,v) {
        var lft=$(v).attr('data-lft');//当前的lft
        var rgt=$(v).attr('data-rgt');//当前的右值
        var tree=$(v).attr('data-tree');//当前的右值
        //通过判断条件找到选择那个类的子类
        if(tree==tree_parent && lft-lft_parent>0 && rgt-rgt_parent<0)
        {
            if (tr.find('span').hasClass('glyphicon glyphicon-minus')){
                $(v).find('span').removeClass('glyphicon glyphicon-plus')
                $(v).find('span').addClass('glyphicon glyphicon-minus')
                $(v).hide();
            }else {
                //是闭合状态
                $(v).find('span').removeClass('glyphicon glyphicon-minus')
                $(v).find('span').addClass('glyphicon glyphicon-plus')
                $(v).show();
            }
        }
    })
  })
})
JS;
$this->registerJs($js);
