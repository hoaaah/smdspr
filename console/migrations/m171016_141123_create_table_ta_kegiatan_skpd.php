<?php

use yii\db\Migration;

class m171016_141123_create_table_ta_kegiatan_skpd extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_kegiatan_skpd}}', [
            'ID_Tahun' => $this->smallInteger(6)->notNull(),
            'Kd_Prov' => $this->smallInteger(4)->notNull(),
            'Kd_Kab_Kota' => $this->smallInteger(4)->notNull(),
            'Kd_Urusan' => $this->smallInteger(4)->notNull(),
            'Kd_Bidang' => $this->smallInteger(4)->notNull(),
            'Kd_Unit' => $this->smallInteger(4)->notNull(),
            'No_Misi' => $this->smallInteger(4)->notNull(),
            'No_Tujuan' => $this->smallInteger(4)->notNull(),
            'No_Sasaran' => $this->smallInteger(4)->notNull(),
            'Kd_Prog' => $this->smallInteger(6)->notNull(),
            'ID_Prog' => $this->smallInteger(6)->notNull(),
            'Kd_Keg' => $this->smallInteger(6)->notNull(),
            'Ket_Kegiatan' => $this->string(255)->notNull(),
            'Lokasi' => $this->string(50),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%ta_kegiatan_skpd}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Urusan','Kd_Bidang','Kd_Unit','No_Misi','No_Tujuan','No_Sasaran','Kd_Prog','ID_Prog','Kd_Keg']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ta_kegiatan_skpd}}');
    }
}
