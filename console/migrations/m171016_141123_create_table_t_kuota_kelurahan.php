<?php

use yii\db\Migration;

class m171016_141123_create_table_t_kuota_kelurahan extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%t_kuota_kelurahan}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'kelurahan_id' => $this->integer(11),
            'kuota' => $this->integer(11),
            'pagu' => $this->decimal(20,2),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%t_kuota_kelurahan}}');
    }
}
