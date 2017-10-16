<?php

use yii\db\Migration;

class m171016_141123_create_table_t_schedule extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%t_schedule}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'input_phased' => $this->integer(11),
            'tahun' => $this->date(),
            'tgl_mulai' => $this->date(),
            'tgl_selesai' => $this->date(),
            'keterangan' => $this->string(255),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'user_id' => $this->integer(11),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%t_schedule}}');
    }
}
