<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ta_kegiatan_skpd".
 *
 * @property integer $ID_Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab_Kota
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $No_Misi
 * @property integer $No_Tujuan
 * @property integer $No_Sasaran
 * @property integer $Kd_Prog
 * @property integer $ID_Prog
 * @property integer $Kd_Keg
 * @property string $Ket_Kegiatan
 * @property string $Lokasi
 *
 * @property TaIndikatorKegiatanSkpd[] $taIndikatorKegiatanSkpds
 * @property TaPaguKegiatanSkpd $taPaguKegiatanSkpd
 * @property TaPelaksanaKegSkpd[] $taPelaksanaKegSkpds
 */
class TaKegiatanSkpd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_kegiatan_skpd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Ket_Kegiatan'], 'required'],
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog', 'Kd_Keg'], 'integer'],
            [['Ket_Kegiatan'], 'string', 'max' => 255],
            [['Lokasi'], 'string', 'max' => 50],
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
            'No_Misi' => 'No  Misi',
            'No_Tujuan' => 'No  Tujuan',
            'No_Sasaran' => 'No  Sasaran',
            'Kd_Prog' => 'Kd  Prog',
            'ID_Prog' => 'Id  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Ket_Kegiatan' => 'Ket  Kegiatan',
            'Lokasi' => 'Lokasi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaIndikatorKegiatanSkpds()
    {
        return $this->hasMany(TaIndikatorKegiatanSkpd::className(), ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran', 'Kd_Prog' => 'Kd_Prog', 'ID_Prog' => 'ID_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaPaguKegiatanSkpd()
    {
        return $this->hasOne(TaPaguKegiatanSkpd::className(), ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran', 'Kd_Prog' => 'Kd_Prog', 'ID_Prog' => 'ID_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaPelaksanaKegSkpds()
    {
        return $this->hasMany(TaPelaksanaKegSkpd::className(), ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran', 'Kd_Prog' => 'Kd_Prog', 'ID_Prog' => 'ID_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }
}
