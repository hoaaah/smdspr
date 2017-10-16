<?php

use yii\db\Migration;

class m171016_141123_create_table_t_sasaranpemda extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%t_sasaranpemda}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'tahun' => $this->date(),
            'no_misi' => $this->integer(11),
            'no_tujuan' => $this->integer(11),
            'no_sasaran' => $this->integer(11),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'user_id' => $this->integer(11),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%t_sasaranpemda}}');
    }
}
