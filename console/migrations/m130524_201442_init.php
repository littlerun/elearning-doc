<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        //创建文档表
        $this->dropTable('{{%doc}}');
        $this->createTable('{{%doc}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
            'content' => $this->text()->notNull(),
            'tags' => $this->string()->notNull(),
            'author_id' => $this->string(10)->notNull(),
            'category' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        //创建用户表
        $this->dropTable('{{%user}}');
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $timeInteger = time();
        $sqlStr = <<<INITSQL
INSERT INTO `user` VALUES ('1', 'admin', '123', '1234', '1234','zhangsong@360.cn',10,{$timeInteger},{$timeInteger});
INITSQL;
        $this->db->createCommand($sqlStr)->execute();       
    }

    public function down()
    {
        $this->dropTable('{{%doc}}');
        $this->dropTable('{{%user}}');
    }
}
