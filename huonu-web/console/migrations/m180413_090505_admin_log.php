<?php

use yii\db\Migration;

/**
 * Class m180413_090505_admin_log 后台操作日志
 */
class m180413_090505_admin_log extends Migration
{
    private $table = '{{%admin_log}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB comment "后台操作记录"';
        }

        // 创建表
        $this->createTable($this->table, [
            'id' => $this->primaryKey()->notNull()->comment('日志ID'),
            'type' => $this->boolean()->notNull()->defaultValue(1)->comment('日志类型'),
            'controller' => $this->string(64)->notNull()->defaultValue('')->comment('控制器'),
            'action' => $this->string(64)->notNull()->defaultValue('')->comment('方法'),
            'url' => $this->string(100)->notNull()->defaultValue('')->comment('请求地址'),
            'index' => $this->string(100)->notNull()->defaultValue('')->comment('数据标识'),
            'params' => $this->text()->notNull()->comment('请求参数'),
            'ip' => $this->char(15)->defaultValue('')->notNull()->comment('操作用户IP'),
            'admin_agent' => $this->boolean()->notNull()->defaultValue(10)->comment('操作用户浏览器代理商'),
            'created_at' => $this->integer(11)->notNull()->defaultValue(0)->comment('创建时间'),
            'created_id' => $this->integer(11)->notNull()->defaultValue(0)->comment('创建用户'),
            'KEY `admin_id` (`created_id`) USING BTREE COMMENT "管理员"'
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180413_090505_admin_log cannot be reverted.\n";
        $this->dropTable($this->table);
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180413_090505_admin_log cannot be reverted.\n";

        return false;
    }
    */
}
