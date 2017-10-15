<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ta_pagu_program_rpjmd".
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
 * @property integer $Kd_Prog_rpjmd
 * @property integer $Id_Prog_rpjmd
 * @property string $PaguTahun1
 * @property string $PaguTahun2
 * @property string $PaguTahun3
 * @property string $PaguTahun4
 * @property string $PaguTahun5
 * @property string $Satuan
 * @property string $Keterangan
 */
class TaPaguProgramRPJMD extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_pagu_program_rpjmd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog_rpjmd', 'Id_Prog_rpjmd'], 'required'],
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog_rpjmd', 'Id_Prog_rpjmd'], 'integer'],
            [['PaguTahun1', 'PaguTahun2', 'PaguTahun3', 'PaguTahun4', 'PaguTahun5'], 'number'],
            [['Satuan'], 'string', 'max' => 50],
            [['Keterangan'], 'string', 'max' => 255],
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
            'Kd_Prog_rpjmd' => 'Kd  Prog Rpjmd',
            'Id_Prog_rpjmd' => 'Id  Prog Rpjmd',
            'PaguTahun1' => 'Pagu Th1',
            'PaguTahun2' => 'Pagu Th2',
            'PaguTahun3' => 'Pagu Th3',
            'PaguTahun4' => 'Pagu Th4',
            'PaguTahun5' => 'Pagu Th5',
            'Satuan' => 'Satuan',
            'Keterangan' => 'Keterangan',
        ];
    }
}
