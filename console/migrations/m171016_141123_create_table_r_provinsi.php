<?php

use yii\db\Migration;

class m171016_141123_create_table_r_provinsi extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%r_provinsi}}', [
            'id' => $this->integer(2)->unsigned()->notNull()->append('PRIMARY KEY'),
            'perwakilan_id' => $this->string(2)->notNull(),
            'name' => $this->string(100)->notNull(),
            'pendek' => $this->string(45)->notNull(),
        ], $tableOptions);

        $this->createIndex('province_id', '{{%r_provinsi}}', 'id', true);
    }

    public function safeDown()
    {
        $this->dropTable('{{%r_provinsi}}');
    }
}
