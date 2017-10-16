<?php

use yii\db\Migration;

class m171016_141123_create_table_ref_program extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ref_program}}', [
            'Kd_Urusan' => $this->smallInteger(4)->notNull(),
            'Kd_Bidang' => $this->smallInteger(4)->notNull(),
            'Kd_Prog' => $this->smallInteger(4)->notNull(),
            'Ket_Program' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%ref_program}}', ['Kd_Urusan','Kd_Bidang','Kd_Prog']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ref_program}}');
    }
}
