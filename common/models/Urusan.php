<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r_urusan".
 *
 * @property integer $Kd_Urusan
 * @property string $Nm_Urusan
 *
 * @property TRenjaProgram[] $tRenjaPrograms
 * @property TRenjaProgram[] $tRenjaPrograms0
 */
class Urusan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_urusan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan'], 'required'],
            [['Kd_Urusan'], 'integer'],
            [['Nm_Urusan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Urusan' => 'Kd  Urusan',
            'Nm_Urusan' => 'Nm  Urusan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenjaProgram()
    {
        return $this->hasMany(RenjaProgram::className(), ['urusan_id' => 'Kd_Urusan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenjaProgram1()
    {
        return $this->hasMany(RenjaProgram::className(), ['kd_urusan' => 'Kd_Urusan']);
    }
}
