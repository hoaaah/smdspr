<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ta_pelaksana_keg_skpd".
 *
 * @property integer $ID_Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab_Kota
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $No_Misi
 * @property integer $No_Tujuan
 * @property integer $No_Sasaran
 * @property integer $Kd_Prog
 * @property integer $ID_Prog
 * @property integer $Kd_Keg
 * @property string $Nm_Sub
 *
 * @property TaKegiatanSkpd $iDTahun
 */
class TaPelaksanaKegSkpd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_pelaksana_keg_skpd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog', 'Kd_Keg'], 'required'],
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog', 'Kd_Keg'], 'integer'],
            [['Nm_Sub'], 'string', 'max' => 255],
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog', 'Kd_Keg'], 'exist', 'skipOnError' => true, 'targetClass' => TaKegiatanSkpd::className(), 'targetAttribute' => ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran', 'Kd_Prog' => 'Kd_Prog', 'ID_Prog' => 'ID_Prog', 'Kd_Keg' => 'Kd_Keg']],
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
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'No_Misi' => 'No  Misi',
            'No_Tujuan' => 'No  Tujuan',
            'No_Sasaran' => 'No  Sasaran',
            'Kd_Prog' => 'Kd  Prog',
            'ID_Prog' => 'Id  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Nm_Sub' => 'Nm  Sub',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIDTahun()
    {
        return $this->hasOne(TaKegiatanSkpd::className(), ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran', 'Kd_Prog' => 'Kd_Prog', 'ID_Prog' => 'ID_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    public function getSub()
    {
        return $this->hasOne(Sub::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    } 
}
