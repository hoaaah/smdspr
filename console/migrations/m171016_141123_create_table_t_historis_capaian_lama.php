<?php

use yii\db\Migration;

class m171016_141123_create_table_t_historis_capaian_lama extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%t_historis_capaian_lama}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'kd_historis' => $this->integer(2),
            'id_ref' => $this->integer(11),
            'tahun' => $this->date(),
            'urusan_id' => $this->integer(11),
            'bidang_id' => $this->integer(11),
            'no_misi' => $this->integer(11),
            'no_tujuan' => $this->integer(11),
            'no_sasaran' => $this->integer(11),
            'id_sasaran' => $this->integer(11),
            'no_sasrkpd' => $this->integer(11),
            'id_sasrkpd' => $this->integer(11),
            'id_progrkpd' => $this->integer(11),
            'id_prog' => $this->integer(11),
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
            'no_indikator' => $this->integer(11),
            'id_capaian' => $this->integer(11),
            'tolok_ukur' => $this->string(255),
            'target_angkat' => $this->decimal(10,),
            'kd_indikator_1' => $this->integer(1),
            'kd_indikator_2' => $this->integer(1),
            'kd_indikator_3' => $this->integer(1),
            'keterangan' => $this->string(255),
            'uraian' => $this->string(255),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'user_id' => $this->integer(11),
            'input_phased' => $this->integer(2)->comment('Fase penginputan 1 untuk RKPD awal dan renja awal, 2 Untuk RW, 3 untuk musren kelurahan, 4 untuk musren kecamatan, 5 untuk forum SKPD'),
            'status' => $this->integer(4)->comment('Status di musrenbang 1 untuk usulan (default), 2 diterima (untuk renja awal dan usulan hanya pada saat musrenbang akhir), 3 ditolak (langsung begitu dia ditolak), 4 ditangguhkan(langsung begitu dia ditangguhkan).'),
            'status_phased' => $this->integer(2)->comment('Current Status Progress (mengikuti input phased)'),
            'alasan_perubahan' => $this->string(255),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%t_historis_capaian_lama}}');
    }
}
