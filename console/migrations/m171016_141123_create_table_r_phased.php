<?php

use yii\db\Migration;

class m171016_141123_create_table_r_phased extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%r_phased}}', [
            'id' => $this->integer(2)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'keterangan' => $this->string(100),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'user_id' => $this->integer(11),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%r_phased}}');
    }
}
