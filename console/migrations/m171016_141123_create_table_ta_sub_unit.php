<?php

use yii\db\Migration;

class m171016_141123_create_table_ta_sub_unit extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_sub_unit}}', [
            'Tahun' => $this->smallInteger(6)->notNull(),
            'Kd_Urusan' => $this->smallInteger(4)->notNull(),
            'Kd_Bidang' => $this->smallInteger(4)->notNull(),
            'Kd_Unit' => $this->smallInteger(4)->notNull(),
            'Kd_Sub' => $this->smallInteger(6)->notNull(),
            'Nm_Pimpinan' => $this->string(50),
            'Nip_Pimpinan' => $this->string(21),
            'Jbt_Pimpinan' => $this->string(75),
            'Alamat' => $this->string(255),
            'Ur_Visi' => $this->string(255),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%ta_sub_unit}}', ['Tahun','Kd_Urusan','Kd_Bidang','Kd_Unit','Kd_Sub']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ta_sub_unit}}');
    }
}
