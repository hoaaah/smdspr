<?php

use yii\db\Migration;

class m171016_141123_create_table_t_ba extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%t_ba}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'tahun' => $this->date(),
            'kd_urusan' => $this->integer(11),
            'kd_bidang' => $this->integer(11),
            'kd_unit' => $this->integer(11),
            'kd_sub' => $this->integer(11),
            'kd_kecamatan' => $this->integer(11),
            'kd_kelurahan' => $this->integer(11),
            'rw' => $this->integer(11),
            'rt' => $this->integer(11),
            'no_ba' => $this->string(255),
            'tanggal_ba' => $this->dateTime(),
            'input_phased' => $this->integer(11)->comment('Jenis Berita Acara'),
            'penandatangan' => $this->string(255),
            'nip_penandatangan' => $this->string(18)->comment('NIP'),
            'jabatan_penandatangan' => $this->string(255)->comment('Jabatan'),
            'status' => $this->smallInteger(1)->defaultValue('1')->comment('1 => draft 2=> final 3=> batal'),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'user_id' => $this->integer(11),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%t_ba}}');
    }
}
