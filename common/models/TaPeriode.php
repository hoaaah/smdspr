<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ta_periode".
 *
 * @property integer $ID_Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab_Kota
 * @property integer $Tahun1
 * @property integer $Tahun2
 * @property integer $Tahun3
 * @property integer $Tahun4
 * @property integer $Tahun5
 * @property integer $Aktive
 */
class TaPeriode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_periode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota'], 'required'],
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Tahun1', 'Tahun2', 'Tahun3', 'Tahun4', 'Tahun5', 'Aktive'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_Tahun' => 'Id  Tahun',
            'Kd_Prov' => 'Kd  Prov',
            'Kd_Kab_Kota' => 'Kd  Kab  Kota',
            'Tahun1' => 'Tahun1',
            'Tahun2' => 'Tahun2',
            'Tahun3' => 'Tahun3',
            'Tahun4' => 'Tahun4',
            'Tahun5' => 'Tahun5',
            'Aktive' => 'Aktive',
        ];
    }
}
