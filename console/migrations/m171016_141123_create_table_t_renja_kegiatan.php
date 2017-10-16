<?php

use yii\db\Migration;

class m171016_141123_create_table_t_renja_kegiatan extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%t_renja_kegiatan}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'renja_program_id' => $this->integer(11),
            'tahun' => $this->date(),
            'kd_urusan' => $this->integer(11),
            'kd_bidang' => $this->integer(11),
            'kd_unit' => $this->integer(11),
            'kd_sub' => $this->integer(11),
            'no_skpdMisi' => $this->integer(11),
            'no_skpdTujuan' => $this->integer(11),
            'no_skpdSasaran' => $this->integer(11),
            'no_renjaSas' => $this->integer(11),
            'no_renjaProg' => $this->integer(11),
            'id_renprog' => $this->integer(11),
            'id_renkeg' => $this->integer(11),
            'uraian' => $this->string(255),
            'lokasi' => $this->string(255),
            'lokasi_maps' => $this->string(255),
            'kelompok_sasaran' => $this->string(255),
            'status_kegiatan' => $this->string(255)->comment('WOT'),
            'pagu_kegiatan' => $this->decimal(15,),
            'pagu_musrenbang' => $this->decimal(15,),
            'kd_asb' => $this->integer(11),
            'info_asb' => $this->string(255),
            'kd_bahas' => $this->smallInteger(1),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'user_id' => $this->integer(11),
            'input_phased' => $this->integer(2)->comment('Fase penginputan 1 untuk RKPD awal dan renja awal, 2 Untuk RW, 3 untuk musren kelurahan, 4 untuk musren kecamatan, 5 untuk forum SKPD'),
            'status' => $this->integer(4)->comment('Status di musrenbang 1 untuk usulan (default), 2 diterima (untuk renja awal dan usulan hanya pada saat musrenbang akhir), 3 ditolak (langsung begitu dia ditolak), 4 ditangguhkan(langsung begitu dia ditangguhkan).'),
            'status_phased' => $this->integer(2)->comment('Current Status Progress (mengikuti input phased)'),
        ], $tableOptions);

        $this->addForeignKey('t_renja_kegiatan_ibfk_1', '{{%t_renja_kegiatan}}', 'renja_program_id', '{{%t_renja_program}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%t_renja_kegiatan}}');
    }
}
