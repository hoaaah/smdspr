<?php

use yii\db\Migration;

class m171016_141123_create_table_ta_pagu_program_rpjmd extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_pagu_program_rpjmd}}', [
            'ID_Tahun' => $this->smallInteger(6)->notNull(),
            'Kd_Prov' => $this->smallInteger(4)->notNull(),
            'Kd_Kab_Kota' => $this->smallInteger(4)->notNull(),
            'Kd_Perubahan' => $this->smallInteger(6)->notNull(),
            'Kd_Dokumen' => $this->smallInteger(6)->notNull(),
            'Kd_Usulan' => $this->smallInteger(6)->notNull(),
            'No_Misi' => $this->smallInteger(4)->notNull(),
            'No_Tujuan' => $this->smallInteger(4)->notNull(),
            'No_Sasaran' => $this->smallInteger(4)->notNull(),
            'Kd_Prog_rpjmd' => $this->smallInteger(6)->notNull(),
            'Id_Prog_rpjmd' => $this->smallInteger(6)->notNull(),
            'PaguTahun1' => $this->decimal(20,2),
            'PaguTahun2' => $this->decimal(20,2),
            'PaguTahun3' => $this->decimal(20,2),
            'PaguTahun4' => $this->decimal(20,2),
            'PaguTahun5' => $this->decimal(20,2),
            'Satuan' => $this->string(50),
            'Keterangan' => $this->string(255),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%ta_pagu_program_rpjmd}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Perubahan','Kd_Dokumen','Kd_Usulan','No_Misi','No_Tujuan','No_Sasaran','Kd_Prog_rpjmd','Id_Prog_rpjmd']);

        $this->addForeignKey('ta_pagu_program_rpjmd_ibfk_1', '{{%ta_pagu_program_rpjmd}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Perubahan','Kd_Dokumen','Kd_Usulan','No_Misi','No_Tujuan','No_Sasaran','Kd_Prog_rpjmd','Id_Prog_rpjmd'], '{{%ta_program_rpjmd}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Perubahan','Kd_Dokumen','Kd_Usulan','No_Misi','No_Tujuan','No_Sasaran','Kd_Prog','Id_Prog']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ta_pagu_program_rpjmd}}');
    }
}
