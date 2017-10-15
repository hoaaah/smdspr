<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r_sub_unit".
 *
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property string $Nm_Sub_Unit
 *
 * @property TRenjaKegiatan[] $tRenjaKegiatans
 * @property TRenjaKegiatanCapaian[] $tRenjaKegiatanCapaians
 * @property TRenjaProgram[] $tRenjaPrograms
 * @property TRenjaProgramCapaian[] $tRenjaProgramCapaians
 */
class RSubUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_sub_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
            [['Nm_Sub_Unit'], 'string', 'max' => 255],
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
            'Kd_Sub' => 'Kd  Sub',
            'Nm_Sub_Unit' => 'Nm  Sub  Unit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTRenjaKegiatans()
    {
        return $this->hasMany(TRenjaKegiatan::className(), ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang', 'kd_unit' => 'Kd_Unit', 'kd_sub' => 'Kd_Sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTRenjaKegiatanCapaians()
    {
        return $this->hasMany(TRenjaKegiatanCapaian::className(), ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang', 'kd_unit' => 'Kd_Unit', 'kd_sub' => 'Kd_Sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTRenjaPrograms()
    {
        return $this->hasMany(TRenjaProgram::className(), ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang', 'kd_unit' => 'Kd_Unit', 'kd_sub' => 'Kd_Sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTRenjaProgramCapaians()
    {
        return $this->hasMany(TRenjaProgramCapaian::className(), ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang', 'kd_unit' => 'Kd_Unit', 'kd_sub' => 'Kd_Sub']);
    }
}
