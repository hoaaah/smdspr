<?php

use yii\db\Migration;

class m171016_141123_create_table_r_setting extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%r_setting}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'tahun' => $this->date()->notNull(),
            'q_rw' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'q_kelurahan' => $this->smallInteger(1)->notNull()->defaultValue('0'),
            'q_kecamatan' => $this->smallInteger(1)->notNull()->defaultValue('0'),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%r_setting}}');
    }
}
