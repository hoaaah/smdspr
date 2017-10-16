<?php

use yii\db\Migration;

class m171016_141123_create_table_t_rkpd_program_capaian extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%t_rkpd_program_capaian}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'rkpd_program_id' => $this->integer(11),
            'tahun' => $this->date(),
            'urusan_id' => $this->integer(11),
            'bidang_id' => $this->integer(11),
            'no_misi' => $this->integer(11),
            'no_tujuan' => $this->integer(11),
            'no_sasaran' => $this->integer(11),
            'kd_progrkpd' => $this->integer(11),
            'id_progrkpd' => $this->integer(11),
            'no_indikator' => $this->integer(11),
            'tolok_ukur' => $this->string(255),
            'target_angka' => $this->decimal(15,),
            'target_uraian' => $this->string(255),
            'kd_indikator_2' => $this->integer(1),
            'kd_indikator_3' => $this->integer(1),
            'keterangan' => $this->string(255),
            'uraian' => $this->string(255),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'user_id' => $this->integer(11),
            'input_phased' => $this->smallInteger(1)->comment('Fase penginputan 1 untuk RKPD awal dan renja awal, 2 Untuk RW, 3 untuk musren kelurahan, 4 untuk musren kecamatan, 5 untuk forum SKPD'),
            'status' => $this->smallInteger(4)->comment('Status di musrenbang 1 untuk usulan (default), 2 diterima (untuk renja awal dan usulan hanya pada saat musrenbang akhir), 3 ditolak (langsung begitu dia ditolak), 4 ditangguhkan(langsung begitu dia ditangguhkan).'),
            'status_phased' => $this->smallInteger(4)->comment('Current Status Progress (mengikuti input phased)'),
        ], $tableOptions);

        $this->addForeignKey('t_rkpd_program_capaian_ibfk_2', '{{%t_rkpd_program_capaian}}', 'kd_indikator_2', '{{%r_indikator_2}}', 'id');
        $this->addForeignKey('t_rkpd_program_capaian_ibfk_3', '{{%t_rkpd_program_capaian}}', 'kd_indikator_3', '{{%r_indikator_3}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%t_rkpd_program_capaian}}');
    }
}
