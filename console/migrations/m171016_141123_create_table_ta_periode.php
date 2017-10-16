<?php

use yii\db\Migration;

class m171016_141123_create_table_ta_periode extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_periode}}', [
            'ID_Tahun' => $this->smallInteger(6)->notNull(),
            'Kd_Prov' => $this->smallInteger(4)->notNull(),
            'Kd_Kab_Kota' => $this->smallInteger(4)->notNull(),
            'Tahun1' => $this->smallInteger(6),
            'Tahun2' => $this->smallInteger(6),
            'Tahun3' => $this->smallInteger(6),
            'Tahun4' => $this->smallInteger(6),
            'Tahun5' => $this->smallInteger(6),
            'Aktive' => $this->smallInteger(4),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%ta_periode}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ta_periode}}');
    }
}
