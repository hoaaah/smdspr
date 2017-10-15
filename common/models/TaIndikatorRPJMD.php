<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ta_indikator_rpjmd".
 *
 * @property integer $ID_Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab_Kota
 * @property integer $Kd_Perubahan
 * @property integer $Kd_Dokumen
 * @property integer $Kd_Usulan
 * @property integer $No_Misi
 * @property integer $No_Tujuan
 * @property integer $No_Sasaran
 * @property integer $Kd_Prog
 * @property integer $Id_Prog
 * @property integer $No_ind_Prog
 * @property integer $Jn_Indikator
 * @property integer $Jn_Indikator2
 * @property string $Tolak_Ukur
 * @property string $Target_Uraian
 * @property string $Kondisi_Kinerja_Awal
 * @property string $NilaiTahun1
 * @property string $NilaiTahun2
 * @property string $NilaiTahun3
 * @property string $NilaiTahun4
 * @property string $NilaiTahun5
 * @property string $Kondisi_Kinerja_akhir
 * @property string $Satuan
 */
class TaIndikatorRPJMD extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_indikator_rpjmd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'Id_Prog', 'No_ind_Prog'], 'required'],
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'Id_Prog', 'No_ind_Prog', 'Jn_Indikator', 'Jn_Indikator2'], 'integer'],
            [['NilaiTahun1', 'NilaiTahun2', 'NilaiTahun3', 'NilaiTahun4', 'NilaiTahun5'], 'number'],
            [['Tolak_Ukur', 'Target_Uraian', 'Kondisi_Kinerja_Awal', 'Kondisi_Kinerja_akhir'], 'string', 'max' => 255],
            [['Satuan'], 'string', 'max' => 20],
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
            'Kd_Perubahan' => 'Kd  Perubahan',
            'Kd_Dokumen' => 'Kd  Dokumen',
            'Kd_Usulan' => 'Kd  Usulan',
            'No_Misi' => 'No  Misi',
            'No_Tujuan' => 'No  Tujuan',
            'No_Sasaran' => 'No  Sasaran',
            'Kd_Prog' => 'Kd  Prog',
            'Id_Prog' => 'Id  Prog',
            'No_ind_Prog' => 'No Ind  Prog',
            'Jn_Indikator' => 'Jn  Indikator',
            'Jn_Indikator2' => 'Jn  Indikator2',
            'Tolak_Ukur' => 'Tolak  Ukur',
            'Target_Uraian' => 'Target  Uraian',
            'Kondisi_Kinerja_Awal' => 'Kondisi  Kinerja  Awal',
            'NilaiTahun1' => 'Nilai Th1',
            'NilaiTahun2' => 'Nilai Th2',
            'NilaiTahun3' => 'Nilai Th3',
            'NilaiTahun4' => 'Nilai Th4',
            'NilaiTahun5' => 'Nilai Th5',
            'Kondisi_Kinerja_akhir' => 'Kondisi  Kinerja Akhir',
            'Satuan' => 'Satuan',
        ];
    }

    public function getIndikator1()
    {
        return $this->hasOne(RIndikator2::className(), ['id' => 'Jn_Indikator']);
    } 
    public function getIndikator2()
    {
        return $this->hasOne(RIndikator3::className(), ['id' => 'Jn_Indikator2']);
    }        
}
