<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r_unit".
 *
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property string $Nm_Unit
 *
 * @property TRenjaProgram[] $tRenjaPrograms
 */
class RUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit'], 'integer'],
            [['Nm_Unit'], 'string', 'max' => 255],
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
            'Kd_Unit' => 'Kd  Unit',
            'Nm_Unit' => 'Nm  Unit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTRenjaPrograms()
    {
        return $this->hasMany(TRenjaProgram::className(), ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang', 'kd_unit' => 'Kd_Unit']);
    }
}
