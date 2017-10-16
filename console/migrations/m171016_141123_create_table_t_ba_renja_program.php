<?php

use yii\db\Migration;

class m171016_141123_create_table_t_ba_renja_program extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%t_ba_renja_program}}', [
            'ba_id' => $this->integer(11)->notNull(),
            'id' => $this->integer(11)->notNull(),
            'tahun' => $this->date(),
            'urusan_id' => $this->integer(11)->comment('kd_urusan1'),
            'bidang_id' => $this->integer(11)->comment('kd_bidang1'),
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
            'uraian' => $this->string(255),
            'pagu_program' => $this->decimal(20,),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'user_id' => $this->integer(11),
            'input_phased' => $this->smallInteger(1)->comment('Fase penginputan 1 untuk RKPD awal dan renja awal, 2 Untuk RW, 3 untuk musren kelurahan, 4 untuk musren kecamatan, 5 untuk forum SKPD'),
            'status' => $this->smallInteger(4)->comment('Status di musrenbang 1 untuk usulan (default), 2 diterima (untuk renja awal dan usulan hanya pada saat musrenbang akhir), 3 ditolak (langsung begitu dia ditolak), 4 ditangguhkan(langsung begitu dia ditangguhkan).'),
            'status_phased' => $this->smallInteger(4)->comment('Current Status Progress (mengikuti input phased)'),
            'rkpd_program_id' => $this->integer(11),
            'id_tahun' => $this->smallInteger(6),
            'Kd_Perubahan_Renstra' => $this->smallInteger(4),
            'Kd_Dokumen_Renstra' => $this->smallInteger(4),
            'Kd_Usulan_Renstra' => $this->smallInteger(4),
            'Kd_Urusan_Renstra' => $this->smallInteger(4),
            'Kd_Bidang_Renstra' => $this->smallInteger(4),
            'Kd_Unit_Renstra' => $this->smallInteger(4),
            'No_Misi_Renstra' => $this->smallInteger(4),
            'No_Tujuan_Renstra' => $this->smallInteger(4),
            'No_Sasaran_Renstra' => $this->smallInteger(4),
            'Kd_Prog_Renstra' => $this->smallInteger(6),
            'ID_Prog_Renstra' => $this->smallInteger(6),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%t_ba_renja_program}}', ['ba_id','id']);

        $this->createIndex('tahun', '{{%t_ba_renja_program}}', ['tahun','kd_urusan','kd_bidang','kd_unit','kd_sub','no_skpdMisi','no_skpdTujuan','no_skpdSasaran','no_renjaSas','no_renjaProg','id_renprog'], true);
        $this->createIndex('t_renja_program_ibfk_8', '{{%t_ba_renja_program}}', ['rkpd_program_id','id_tahun'], true);
    }

    public function safeDown()
    {
        $this->dropTable('{{%t_ba_renja_program}}');
    }
}
