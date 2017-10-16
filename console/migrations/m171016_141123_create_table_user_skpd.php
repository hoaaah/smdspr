<?php

use yii\db\Migration;

class m171016_141123_create_table_user_skpd extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_skpd}}', [
            'user_id' => $this->integer(11)->notNull(),
            'Kd_Urusan' => $this->smallInteger(4)->notNull(),
            'Kd_Bidang' => $this->smallInteger(4)->notNull(),
            'Kd_Unit' => $this->smallInteger(4)->notNull(),
            'Kd_Sub' => $this->smallInteger(6)->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user_skpd}}');
    }
}
