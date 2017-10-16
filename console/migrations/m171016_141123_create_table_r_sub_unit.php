<?php

use yii\db\Migration;

class m171016_141123_create_table_r_sub_unit extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%r_sub_unit}}', [
            'Kd_Urusan' => $this->integer(11)->notNull(),
            'Kd_Bidang' => $this->integer(11)->notNull(),
            'Kd_Unit' => $this->integer(11)->notNull(),
            'Kd_Sub' => $this->integer(11)->notNull(),
            'Nm_Sub_Unit' => $this->string(255),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%r_sub_unit}}', ['Kd_Urusan','Kd_Bidang','Kd_Unit','Kd_Sub']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%r_sub_unit}}');
    }
}
