<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m180101_063544_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique()->comment('用户名'),
            'auth_key' => $this->string(32)->notNull()->comment('登陆令牌'),
            'password_hash' => $this->string()->notNull()->comment('密码'),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('状态'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'update_at' => $this->integer()->notNull()->comment('修改时间'),
            'last_login_at' => $this->integer()->notNull()->comment('最后登陆时间'),
            'last_login_ip' => $this->integer()->notNull()->comment('最后登陆ip'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
