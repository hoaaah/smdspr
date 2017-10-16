<?php

use yii\db\Migration;

class m171016_141123_create_table_t_subkegiatan_photo extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%t_subkegiatan_photo}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'musrenbang_id' => $this->integer(11),
            'file' => $this->string(255),
            'caption' => $this->string(255),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'user_id' => $this->integer(11),
        ], $tableOptions);

        $this->addForeignKey('t_subkegiatan_photo_ibfk_1', '{{%t_subkegiatan_photo}}', 'musrenbang_id', '{{%t_subkegiatan}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%t_subkegiatan_photo}}');
    }
}
