<a href="<?=\yii\helpers\Url::to('/admin/add')?>" class="btn btn-info">添加</a><a href="#" class="btn btn-danger">黑名单</a>
<table class="table tab-content">
    <tr>
        <th>ID</th>
        <th>管理员名称</th>
        <th>令牌</th>
        <th>邮箱</th>
        <th>最后登陆ip</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>

    <?php foreach($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->username?></td>
            <td><?=$model->auth_key?></td>
            <td><?=$model->email?></td>
            <td><?=$model->last_login_ip?></td>
            <td><?=date('Y-m-d H:i:s',$model->created_at)?></td>
            <td><a href="<?=\yii\helpers\Url::to(['edit','id'=>$model->id])?>" class="btn btn-info">编辑</a><a href="<?=\yii\helpers\Url::to(['del','id'=>$model->id])?>" class="btn btn-danger">删除</a></td>
        </tr>
    <?php endforeach;?>
</table>