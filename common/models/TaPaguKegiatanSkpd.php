<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ta_pagu_kegiatan_skpd".
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
 * @property string $PaguTahun1
 * @property string $PaguTahun2
 * @property string $PaguTahun3
 * @property string $PaguTahun4
 * @property string $PaguTahun5
 * @property string $Satuan
 * @property string $Keterangan
 *
 * @property TaKegiatanSkpd $iDTahun
 */
class TaPaguKegiatanSkpd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_pagu_kegiatan_skpd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog', 'Kd_Keg'], 'required'],
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog', 'Kd_Keg'], 'integer'],
            [['PaguTahun1', 'PaguTahun2', 'PaguTahun3', 'PaguTahun4', 'PaguTahun5'], 'number'],
            [['Satuan'], 'string', 'max' => 20],
            [['Keterangan'], 'string', 'max' => 255],
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
            'No_Misi' => 'No  Misi',
            'No_Tujuan' => 'No  Tujuan',
            'No_Sasaran' => 'No  Sasaran',
            'Kd_Prog' => 'Kd  Prog',
            'ID_Prog' => 'Id  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'PaguTahun1' => 'Pagu Tahun1',
            'PaguTahun2' => 'Pagu Tahun2',
            'PaguTahun3' => 'Pagu Tahun3',
            'PaguTahun4' => 'Pagu Tahun4',
            'PaguTahun5' => 'Pagu Tahun5',
            'Satuan' => 'Satuan',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIDTahun()
    {
        return $this->hasOne(TaKegiatanSkpd::className(), ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran', 'Kd_Prog' => 'Kd_Prog', 'ID_Prog' => 'ID_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }
}
