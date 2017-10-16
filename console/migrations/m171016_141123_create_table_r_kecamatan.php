<?php

use yii\db\Migration;

class m171016_141123_create_table_r_kecamatan extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%r_kecamatan}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'pemda_id' => $this->string(11),
            'kd_kecamatan' => $this->string(10),
            'kecamatan' => $this->string(50),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%r_kecamatan}}');
    }
}
