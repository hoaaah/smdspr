<?php

use yii\db\Migration;

class m171016_141123_create_table_r_unit extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%r_unit}}', [
            'Kd_Urusan' => $this->integer(11)->notNull(),
            'Kd_Bidang' => $this->integer(11)->notNull(),
            'Kd_Unit' => $this->integer(11)->notNull(),
            'Nm_Unit' => $this->string(255),
        ], $tableOptions);

        $this->addPrimaryKey('primary_key', '{{%r_unit}}', ['Kd_Urusan','Kd_Bidang','Kd_Unit']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%r_unit}}');
    }
}
