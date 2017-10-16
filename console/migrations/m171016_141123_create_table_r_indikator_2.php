<?php

use yii\db\Migration;

class m171016_141123_create_table_r_indikator_2 extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%r_indikator_2}}', [
            'id' => $this->integer(1)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'jn_indikator' => $this->string(100),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%r_indikator_2}}');
    }
}
