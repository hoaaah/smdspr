<?php

use yii\db\Migration;

class m171016_141123_create_table_t_rpjmd_prioritas extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%t_rpjmd_prioritas}}', [
            'id' => $this->integer(11)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'ID_Tahun' => $this->smallInteger(6),
            'Kd_Prioritas' => $this->smallInteger(4),
            'Uraian' => $this->string(255),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%t_rpjmd_prioritas}}');
    }
}
