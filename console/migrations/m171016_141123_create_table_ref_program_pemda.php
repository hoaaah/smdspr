<?php

use yii\db\Migration;

class m171016_141123_create_table_ref_program_pemda extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ref_program_pemda}}', [
            'Kd_Prog' => $this->smallInteger(4)->notNull()->append('PRIMARY KEY'),
            'Ket_Program' => $this->string(255)->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ref_program_pemda}}');
    }
}
