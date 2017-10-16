<?php

use yii\db\Migration;

class m171016_141123_create_table_ta_unit extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_unit}}', [
            'Kd_Prov' => $this->smallInteger(4)->notNull(),
            'Kd_Kab_Kota' => $this->smallInteger(4)->notNull(),
            'Kd_Urusan' => $this->smallInteger(4)->notNull(),
            'Kd_Bidang' => $this->smallInteger(4)->notNull(),
            'Kd_Unit' => $this->smallInteger(4)->notNull(),
            'Tahun' => $this->smallInteger(6),
            'Nm_Pimpinan' => $this->string(50),
            'Nip_Pimpinan' => $this->string(21),
            'Jbt_Pimpinan' => $this->string(75),
            'Alamat' => $this->string(255),
            'Ur_Visi' => $this->string(255),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%ta_unit}}', ['Kd_Prov','Kd_Kab_Kota','Kd_Urusan','Kd_Bidang','Kd_Unit']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ta_unit}}');
    }
}
