<?php

use yii\db\Migration;

class m171016_141123_create_table_t_ba_subkegiatan extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%t_ba_subkegiatan}}', [
            'ba_id' => $this->integer(11)->notNull(),
            'id' => $this->integer(11)->notNull()->defaultValue('0'),
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
            'skpd' => $this->smallInteger(1)->defaultValue('0'),
        ], $tableOptions);

        $this->addForeignKey('t_ba_subkegiatan_ibfk_1', '{{%t_ba_subkegiatan}}', 'ba_id', '{{%t_ba}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%t_ba_subkegiatan}}');
    }
}
