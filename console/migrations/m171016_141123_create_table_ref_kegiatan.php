<?php

use yii\db\Migration;

class m171016_141123_create_table_ref_kegiatan extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ref_kegiatan}}', [
            'Kd_Urusan' => $this->smallInteger(4)->notNull(),
            'Kd_Bidang' => $this->smallInteger(4)->notNull(),
            'Kd_Prog' => $this->smallInteger(4)->notNull(),
            'Kd_Keg' => $this->smallInteger(6)->notNull(),
            'Ket_Kegiatan' => $this->string(255)->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%ref_kegiatan}}', ['Kd_Urusan','Kd_Bidang','Kd_Prog','Kd_Keg']);

        $this->addForeignKey('ref_kegiatan_ibfk_1', '{{%ref_kegiatan}}', ['Kd_Urusan','Kd_Bidang','Kd_Prog'], '{{%ref_program}}', ['Kd_Urusan','Kd_Bidang','Kd_Prog']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ref_kegiatan}}');
    }
}
