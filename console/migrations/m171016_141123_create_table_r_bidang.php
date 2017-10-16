<?php

use yii\db\Migration;

class m171016_141123_create_table_r_bidang extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%r_bidang}}', [
            'Kd_Urusan' => $this->integer(11)->notNull(),
            'Kd_Bidang' => $this->integer(11)->notNull(),
            'Nm_Bidang' => $this->string(255),
            'Kd_Fungsi' => $this->integer(11),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%r_bidang}}', ['Kd_Urusan','Kd_Bidang']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%r_bidang}}');
    }
}
