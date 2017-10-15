<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Unit".
 *
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab_Kota
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Tahun
 * @property string $Nm_Pimpinan
 * @property string $Nip_Pimpinan
 * @property string $Jbt_Pimpinan
 * @property string $Alamat
 * @property string $Ur_Visi
 *
 * @property TaMisiSKPD[] $taMisiSKPDs
 */
class TaUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit'], 'required'],
            [['Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Tahun'], 'integer'],
            [['Nm_Pimpinan'], 'string', 'max' => 50],
            [['Nip_Pimpinan'], 'string', 'max' => 21],
            [['Jbt_Pimpinan'], 'string', 'max' => 75],
            [['Alamat', 'Ur_Visi'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Prov' => 'Kd  Prov',
            'Kd_Kab_Kota' => 'Kd  Kab  Kota',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Tahun' => 'Tahun',
            'Nm_Pimpinan' => 'Nm  Pimpinan',
            'Nip_Pimpinan' => 'Nip  Pimpinan',
            'Jbt_Pimpinan' => 'Jbt  Pimpinan',
            'Alamat' => 'Alamat',
            'Ur_Visi' => 'Ur  Visi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMisiSKPDs()
    {
        return $this->hasMany(TaMisiSKPD::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }
}
