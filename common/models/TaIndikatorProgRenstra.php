<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ta_indikator_prog_renstra".
 *
 * @property integer $ID_Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab_Kota
 * @property integer $Kd_Perubahan
 * @property integer $Kd_Dokumen
 * @property integer $Kd_Usulan
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $No_Misi
 * @property integer $No_Tujuan
 * @property integer $No_Sasaran
 * @property integer $Kd_Prog
 * @property integer $ID_Prog
 * @property integer $No_Ind_Prog
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
 * @property string $Satuan
 * @property string $Keterangan
 *
 * @property TaRenstra $iDTahun
 */
class TaIndikatorProgRenstra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_indikator_prog_renstra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog', 'No_Ind_Prog'], 'required'],
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog', 'No_Ind_Prog', 'Jn_Indikator', 'Jn_Indikator2'], 'integer'],
            [['NilaiTahun1', 'NilaiTahun2', 'NilaiTahun3', 'NilaiTahun4', 'NilaiTahun5'], 'number'],
            [['Tolak_Ukur', 'Target_Uraian', 'Keterangan'], 'string', 'max' => 200],
            [['Kondisi_Kinerja_Awal'], 'string', 'max' => 50],
            [['Satuan'], 'string', 'max' => 20],
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog'], 'exist', 'skipOnError' => true, 'targetClass' => TaRenstra::className(), 'targetAttribute' => ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Perubahan' => 'Kd_Perubahan', 'Kd_Dokumen' => 'Kd_Dokumen', 'Kd_Usulan' => 'Kd_Usulan', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran', 'Kd_Prog' => 'Kd_Prog', 'ID_Prog' => 'ID_Prog']],
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
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'No_Misi' => 'No  Misi',
            'No_Tujuan' => 'No  Tujuan',
            'No_Sasaran' => 'No  Sasaran',
            'Kd_Prog' => 'Kd  Prog',
            'ID_Prog' => 'Id  Prog',
            'No_Ind_Prog' => 'No  Ind  Prog',
            'Jn_Indikator' => 'Jn  Indikator',
            'Jn_Indikator2' => 'Jn  Indikator2',
            'Tolak_Ukur' => 'Tolak  Ukur',
            'Target_Uraian' => 'Target  Uraian',
            'Kondisi_Kinerja_Awal' => 'Kondisi  Kinerja  Awal',
            'NilaiTahun1' => 'Nilai Tahun1',
            'NilaiTahun2' => 'Nilai Tahun2',
            'NilaiTahun3' => 'Nilai Tahun3',
            'NilaiTahun4' => 'Nilai Tahun4',
            'NilaiTahun5' => 'Nilai Tahun5',
            'Satuan' => 'Satuan',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIDTahun()
    {
        return $this->hasOne(TaRenstra::className(), ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Perubahan' => 'Kd_Perubahan', 'Kd_Dokumen' => 'Kd_Dokumen', 'Kd_Usulan' => 'Kd_Usulan', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran', 'Kd_Prog' => 'Kd_Prog', 'ID_Prog' => 'ID_Prog']);
    }
}
