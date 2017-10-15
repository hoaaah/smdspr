<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ta_pemda_umum".
 *
 * @property integer $ID
 * @property integer $Kd_Prov
 * @property string $Kd_Kab_Kota
 * @property string $Ur_Visi
 * @property string $Nm_Provinsi
 * @property string $Nm_Pemda
 * @property string $Nm_PimpDaerah
 * @property string $Jab_PimpDaerah
 * @property string $Nm_Sekda
 * @property string $Nip_Sekda
 * @property string $Jbt_Sekda
 * @property string $Ibukota
 * @property string $Alamat
 * @property string $created_at
 */
class TaPemdaUmum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_pemda_umum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Prov', 'Kd_Kab_Kota', 'Ur_Visi', 'Nm_Provinsi', 'Nm_Pemda'], 'required'],
            [['Kd_Prov'], 'integer'],
            [['created_at'], 'safe'],
            [['Kd_Kab_Kota'], 'string', 'max' => 5],
            [['Ur_Visi', 'Alamat'], 'string', 'max' => 255],
            [['Nm_Provinsi', 'Nm_Pemda', 'Nm_PimpDaerah'], 'string', 'max' => 100],
            [['Jab_PimpDaerah', 'Nm_Sekda', 'Ibukota'], 'string', 'max' => 50],
            [['Nip_Sekda'], 'string', 'max' => 21],
            [['Jbt_Sekda'], 'string', 'max' => 75],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Kd_Prov' => 'Kd  Prov',
            'Kd_Kab_Kota' => 'Kd  Kab  Kota',
            'Ur_Visi' => 'Ur  Visi',
            'Nm_Provinsi' => 'Nm  Provinsi',
            'Nm_Pemda' => 'Nm  Pemda',
            'Nm_PimpDaerah' => 'Nm  Pimp Daerah',
            'Jab_PimpDaerah' => 'Jab  Pimp Daerah',
            'Nm_Sekda' => 'Nm  Sekda',
            'Nip_Sekda' => 'Nip  Sekda',
            'Jbt_Sekda' => 'Jbt  Sekda',
            'Ibukota' => 'Ibukota',
            'Alamat' => 'Alamat',
            'created_at' => 'Created At',
        ];
    }
}
