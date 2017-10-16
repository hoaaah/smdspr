<?php

use yii\db\Migration;

class m171016_141123_create_table_ta_pelaksana_prog_rpjmd extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_pelaksana_prog_rpjmd}}', [
            'ID_Tahun' => $this->smallInteger(6)->notNull(),
            'Kd_Prov' => $this->smallInteger(4)->notNull(),
            'Kd_Kab_Kota' => $this->smallInteger(4)->notNull(),
            'Kd_Perubahan' => $this->smallInteger(6)->notNull(),
            'Kd_Dokumen' => $this->smallInteger(6)->notNull(),
            'Kd_Usulan' => $this->smallInteger(6)->notNull(),
            'No_Misi' => $this->smallInteger(4)->notNull(),
            'No_Tujuan' => $this->smallInteger(4)->notNull(),
            'No_Sasaran' => $this->smallInteger(4)->notNull(),
            'Kd_Prog' => $this->smallInteger(6)->notNull(),
            'Id_Prog' => $this->smallInteger(6)->notNull(),
            'Kd_Urusan' => $this->smallInteger(4)->notNull(),
            'Kd_Bidang' => $this->smallInteger(4)->notNull(),
            'Kd_Unit' => $this->smallInteger(4)->notNull(),
            'Kd_Urusan1' => $this->smallInteger(4),
            'Kd_Bidang1' => $this->smallInteger(4),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%ta_pelaksana_prog_rpjmd}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Perubahan','Kd_Dokumen','Kd_Usulan','No_Misi','No_Tujuan','No_Sasaran','Kd_Prog','Id_Prog','Kd_Urusan','Kd_Bidang','Kd_Unit']);

        $this->addForeignKey('ta_pelaksana_prog_rpjmd_ibfk_1', '{{%ta_pelaksana_prog_rpjmd}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Perubahan','Kd_Dokumen','Kd_Usulan','No_Misi','No_Tujuan','No_Sasaran','Kd_Prog','Id_Prog'], '{{%ta_program_rpjmd}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Perubahan','Kd_Dokumen','Kd_Usulan','No_Misi','No_Tujuan','No_Sasaran','Kd_Prog','Id_Prog']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ta_pelaksana_prog_rpjmd}}');
    }
}
