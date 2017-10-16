<?php

use yii\db\Migration;

class m171016_141123_create_table_t_subkegiatan extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%t_subkegiatan}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'tahun' => $this->date(),
            'renja_kegiatan_id' => $this->integer(11),
            'uraian' => $this->string(255),
            'kd_kecamatan' => $this->integer(11),
            'kd_kelurahan' => $this->integer(11),
            'rw' => $this->integer(11),
            'rt' => $this->integer(11),
            'lokasi' => $this->string(255),
            'volume' => $this->decimal(15,),
            'satuan' => $this->string(20),
            'harga_satuan' => $this->decimal(15,),
            'biaya' => $this->decimal(15,),
            'keterangan' => $this->text(),
            'kd_asb' => $this->integer(11),
            'input_phased' => $this->integer(11),
            'input_status' => $this->integer(11),
            'status_phased' => $this->integer(11),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'user_id' => $this->integer(11),
            'skpd' => $this->smallInteger(1)->comment('Flag untuk inputan dari SKPD atau musrenbang'),
        ], $tableOptions);

        $this->addForeignKey('t_subkegiatan_ibfk_1', '{{%t_subkegiatan}}', 'renja_kegiatan_id', '{{%t_renja_kegiatan}}', 'id');
        $this->addForeignKey('t_subkegiatan_ibfk_2', '{{%t_subkegiatan}}', 'kd_kecamatan', '{{%r_kecamatan}}', 'id');
        $this->addForeignKey('t_subkegiatan_ibfk_3', '{{%t_subkegiatan}}', 'kd_kelurahan', '{{%r_desa}}', 'id');
        $this->addForeignKey('t_subkegiatan_ibfk_4', '{{%t_subkegiatan}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('t_subkegiatan_ibfk_5', '{{%t_subkegiatan}}', 'input_phased', '{{%r_phased}}', 'id');
        $this->addForeignKey('t_subkegiatan_ibfk_6', '{{%t_subkegiatan}}', 'status_phased', '{{%r_phased}}', 'id');
        $this->addForeignKey('t_subkegiatan_ibfk_7', '{{%t_subkegiatan}}', 'input_status', '{{%r_status}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%t_subkegiatan}}');
    }
}
