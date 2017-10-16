<?php

use yii\db\Migration;

class m171016_141123_create_table_user extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'username' => $this->string(255)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string(255),
            'email' => $this->string(255)->notNull(),
            'status' => $this->smallInteger(6)->notNull()->defaultValue('10'),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
            'kd_user' => $this->integer(2)->notNull(),
            'kd_peran' => $this->integer(2)->notNull(),
            'kd_pemda' => $this->integer(11)->notNull(),
            'nama' => $this->string(50)->notNull(),
            'alamat' => $this->string(255),
            'contact' => $this->string(20)->notNull(),
            'jabatan' => $this->string(45),
        ], $tableOptions);

        $this->createIndex('username', '{{%user}}', 'username', true);
        $this->createIndex('email', '{{%user}}', 'email', true);
        $this->createIndex('password_reset_token', '{{%user}}', 'password_reset_token', true);

        $this->addForeignKey('fk_user_1', '{{%user}}', 'kd_user', '{{%r_group}}', 'id');
        $this->addForeignKey('fk_user_2', '{{%user}}', 'kd_peran', '{{%r_peran}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
