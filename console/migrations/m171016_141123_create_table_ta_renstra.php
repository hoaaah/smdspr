<?php

use yii\db\Migration;

class m171016_141123_create_table_ta_renstra extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_renstra}}', [
            'ID_Tahun' => $this->smallInteger(6)->notNull(),
            'Kd_Prov' => $this->smallInteger(4)->notNull(),
            'Kd_Kab_Kota' => $this->smallInteger(4)->notNull(),
            'Kd_Perubahan' => $this->smallInteger(6)->notNull(),
            'Kd_Dokumen' => $this->smallInteger(6)->notNull(),
            'Kd_Usulan' => $this->smallInteger(6)->notNull(),
            'Kd_Urusan' => $this->smallInteger(4)->notNull(),
            'Kd_Bidang' => $this->smallInteger(4)->notNull(),
            'Kd_Unit' => $this->smallInteger(4)->notNull(),
            'No_Misi' => $this->smallInteger(4)->notNull(),
            'No_Tujuan' => $this->smallInteger(4)->notNull(),
            'No_Sasaran' => $this->smallInteger(4)->notNull(),
            'Kd_Prog' => $this->smallInteger(6)->notNull(),
            'ID_Prog' => $this->smallInteger(6)->notNull(),
            'Tgl_Perubahan' => $this->dateTime(),
            'Nm_Prov' => $this->string(255),
            'Nm_Kab' => $this->string(255),
            'Nm_Urusan' => $this->string(255),
            'Nm_Bidang' => $this->string(255),
            'Nm_Unit' => $this->string(255),
            'Ur_Misi' => $this->string(255),
            'Ur_Tujuan' => $this->string(255),
            'Ur_Sasaran' => $this->string(255),
            'Ket_Program' => $this->string(255),
            'Kd_Urusan1' => $this->smallInteger(4),
            'Kd_Bidang1' => $this->smallInteger(4),
            'No_Misi1' => $this->smallInteger(4),
            'No_Tujuan1' => $this->smallInteger(4),
            'No_Sasaran1' => $this->smallInteger(4),
            'Kd_Prog1' => $this->smallInteger(6),
            'ID_Prog1' => $this->smallInteger(6),
            'Ur_Misi1' => $this->string(255),
            'Ur_Tujuan1' => $this->string(255),
            'Ur_Sasaran1' => $this->string(255),
            'Ket_Program1' => $this->string(255),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%ta_renstra}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Perubahan','Kd_Dokumen','Kd_Usulan','Kd_Urusan','Kd_Bidang','Kd_Unit','No_Misi','No_Tujuan','No_Sasaran','Kd_Prog','ID_Prog']);

        $this->addForeignKey('Ta_Renstra_ibfk_1', '{{%ta_renstra}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Urusan','Kd_Bidang','Kd_Unit','No_Misi','No_Tujuan','No_Sasaran'], '{{%ta_sasaran_skpd}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Urusan','Kd_Bidang','Kd_Unit','No_Misi','No_Tujuan','No_Sasaran']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ta_renstra}}');
    }
}
