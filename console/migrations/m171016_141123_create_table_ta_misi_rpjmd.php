<?php

use yii\db\Migration;

class m171016_141123_create_table_ta_misi_rpjmd extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_misi_rpjmd}}', [
            'ID_Tahun' => $this->smallInteger(6)->notNull(),
            'Kd_Prov' => $this->smallInteger(4)->notNull(),
            'Kd_Kab_Kota' => $this->smallInteger(4)->notNull(),
            'Kd_Perubahan' => $this->smallInteger(6)->notNull(),
            'Kd_Dokumen' => $this->smallInteger(6)->notNull(),
            'Kd_Usulan' => $this->smallInteger(6)->notNull(),
            'No_Misi' => $this->smallInteger(4)->notNull(),
            'Ur_Misi' => $this->string(255),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%ta_misi_rpjmd}}', ['ID_Tahun','Kd_Prov','Kd_Kab_Kota','Kd_Perubahan','Kd_Dokumen','Kd_Usulan','No_Misi']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ta_misi_rpjmd}}');
    }
}
