<?php

use yii\db\Migration;

class m171016_141123_create_table_r_pemda extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%r_pemda}}', [
            'id' => $this->string(5)->notNull()->append('PRIMARY KEY'),
            'province_id' => $this->string(2)->notNull(),
            'name' => $this->string(50)->notNull(),
            'perwakilan_id' => $this->string(2)->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%r_pemda}}');
    }
}
