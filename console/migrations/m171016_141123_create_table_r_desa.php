<?php

use yii\db\Migration;

class m171016_141123_create_table_r_desa extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%r_desa}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'kecamatan_id' => $this->integer(11),
            'desa' => $this->string(50),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%r_desa}}');
    }
}
