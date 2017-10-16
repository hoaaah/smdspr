<?php

use yii\db\Migration;

class m171016_141123_create_table_t_ba_rkpd_program extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%t_ba_rkpd_program}}', [
            'ba_id' => $this->integer(11)->notNull(),
            'id' => $this->integer(11)->notNull(),
            'tahun' => $this->date(),
            'urusan_id' => $this->integer(11)->comment('kd_urusan1'),
            'bidang_id' => $this->integer(11)->comment('kd_bidang1'),
            'no_misi' => $this->integer(11),
            'no_tujuan' => $this->integer(11),
            'no_sasaran' => $this->integer(11),
            'kd_progrkpd' => $this->integer(11),
            'id_progrkpd' => $this->integer(11),
            'uraian' => $this->string(255),
            'pagu_program' => $this->decimal(20,),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'user_id' => $this->integer(11),
            'input_phased' => $this->smallInteger(1)->comment('Fase penginputan 1 untuk RKPD awal dan renja awal, 2 Untuk RW, 3 untuk musren kelurahan, 4 untuk musren kecamatan, 5 untuk forum SKPD'),
            'status' => $this->smallInteger(4)->comment('Status di musrenbang 1 untuk usulan (default), 2 diterima (untuk renja awal dan usulan hanya pada saat musrenbang akhir), 3 ditolak (langsung begitu dia ditolak), 4 ditangguhkan(langsung begitu dia ditangguhkan).'),
            'status_phased' => $this->smallInteger(4)->comment('Current Status Progress (mengikuti input phased)'),
            'id_tahun' => $this->smallInteger(6),
            'Kd_Perubahan_Rpjmd' => $this->smallInteger(4),
            'Kd_Dokumen_Rpjmd' => $this->smallInteger(4),
            'Kd_Usulan_Rpjmd' => $this->smallInteger(4),
            'No_Misi_Rpjmd' => $this->smallInteger(4),
            'No_Tujuan_Rpjmd' => $this->smallInteger(4),
            'No_Sasaran_Rpjmd' => $this->smallInteger(4),
            'Kd_Prog_Rpjmd' => $this->integer(11),
            'ID_Prog_Rpjmd' => $this->integer(11),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%t_ba_rkpd_program}}', ['ba_id','id']);

        $this->createIndex('tahun', '{{%t_ba_rkpd_program}}', ['tahun','urusan_id','bidang_id','no_misi','no_tujuan','no_sasaran','kd_progrkpd','id_progrkpd'], true);
    }

    public function safeDown()
    {
        $this->dropTable('{{%t_ba_rkpd_program}}');
    }
}
