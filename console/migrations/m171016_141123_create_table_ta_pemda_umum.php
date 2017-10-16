<?php

use yii\db\Migration;

class m171016_141123_create_table_ta_pemda_umum extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_pemda_umum}}', [
            'ID' => $this->smallInteger(6)->notNull()->append('AUTO_INCREMENT PRIMARY KEY'),
            'Kd_Prov' => $this->smallInteger(4)->notNull(),
            'Kd_Kab_Kota' => $this->string(5)->notNull(),
            'Ur_Visi' => $this->string(255)->notNull(),
            'Nm_Provinsi' => $this->string(100)->notNull(),
            'Nm_Pemda' => $this->string(100)->notNull(),
            'Nm_PimpDaerah' => $this->string(100),
            'Jab_PimpDaerah' => $this->string(50),
            'Nm_Sekda' => $this->string(50),
            'Nip_Sekda' => $this->string(21),
            'Jbt_Sekda' => $this->string(75),
            'Ibukota' => $this->string(50),
            'Alamat' => $this->string(255),
            'created_at' => $this->dateTime(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%ta_pemda_umum}}');
    }
}
