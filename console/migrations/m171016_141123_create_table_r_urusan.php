<?php

use yii\db\Migration;

class m171016_141123_create_table_r_urusan extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%r_urusan}}', [
            'Kd_Urusan' => $this->integer(11)->notNull()->append('PRIMARY KEY'),
            'Nm_Urusan' => $this->string(255),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%r_urusan}}');
    }
}
