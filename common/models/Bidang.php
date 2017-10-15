<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r_bidang".
 *
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property string $Nm_Bidang
 * @property integer $Kd_Fungsi
 *
 * @property TRenjaProgram[] $tRenjaPrograms
 * @property TRenjaProgram[] $tRenjaPrograms0
 */
class Bidang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_bidang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Fungsi'], 'integer'],
            [['Nm_Bidang'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Nm_Bidang' => 'Nm  Bidang',
            'Kd_Fungsi' => 'Kd  Fungsi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenjaProgram()
    {
        return $this->hasMany(RenjaProgram::className(), ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenjaProgram1()
    {
        return $this->hasMany(RenjaProgram::className(), ['urusan_id' => 'Kd_Urusan', 'bidang_id' => 'Kd_Bidang']);
    }
}
