<?php

use yii\db\Migration;

class m171016_141123_create_table_ta_indikator_rpjmd extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_indikator_rpjmd}}', [
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
            'No_ind_Prog' => $this->smallInteger(4)->notNull(),
            'Jn_Indikator' => $this->smallInteger(4),
            'Jn_Indikator2' => $this->smallInteger(4),
            'Tolak_Ukur' => $this->string(255),
            'Target_Uraian' => $this->string(255),
            'Kondisi_Kinerja_Awal' => $this->string(255),
            'NilaiTahun1' => $this->decimal(20,2),
            'NilaiTahun2' => $this->decimal(20,2),
            'NilaiTahun3' => $this->decimal(20,2),
            'NilaiTahun4' => $this->decimal(20,2),
            'NilaiTahun5' => $this->decimal(20,2),
            'Kondisi_Kinerja_akhir' => $this->string(255),
            'Satuan' => $this->string(20),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%ta_indikator_rpjmd}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Perubahan','Kd_Dokumen','Kd_Usulan','No_Misi','No_Tujuan','No_Sasaran','Kd_Prog','Id_Prog','No_ind_Prog']);

        $this->addForeignKey('ta_indikator_rpjmd_ibfk_1', '{{%ta_indikator_rpjmd}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Perubahan','Kd_Dokumen','Kd_Usulan','No_Misi','No_Tujuan','No_Sasaran','Kd_Prog','Id_Prog'], '{{%ta_program_rpjmd}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Perubahan','Kd_Dokumen','Kd_Usulan','No_Misi','No_Tujuan','No_Sasaran','Kd_Prog','Id_Prog']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ta_indikator_rpjmd}}');
    }
}
