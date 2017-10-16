<?php

use yii\db\Migration;

class m171016_141123_create_table_ref_user extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ref_user}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'name' => $this->string(50),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ref_user}}');
    }
}
