<?php

use yii\db\Migration;

class m171016_141123_create_table_ref_user_menu extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ref_user_menu}}', [
            'menu' => $this->integer(4),
            'kd_user' => $this->integer(11),
        ], $tableOptions);

        $this->createIndex('kd_user', '{{%ref_user_menu}}', ['kd_user','menu'], true);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ref_user_menu}}');
    }
}
