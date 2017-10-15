<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ta_pelaksana_prog_rpjmd".
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
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Urusan1
 * @property integer $Kd_Bidang1
 */
class TaPelaksanaProgRPJMD extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_pelaksana_prog_rpjmd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'Id_Prog', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit'], 'required'],
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'Id_Prog', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Urusan1', 'Kd_Bidang1'], 'integer'],
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
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Urusan1' => 'Kd  Urusan1',
            'Kd_Bidang1' => 'Kd  Bidang1',
        ];
    }

    public function getProgram()
    {
        return $this->hasOne(RpjmdProgram::className(), ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Perubahan' => 'Kd_Perubahan', 'Kd_Dokumen' => 'Kd_Dokumen', 'Kd_Usulan' => 'Kd_Usulan', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran', 'Kd_Prog'=> 'Kd_Prog', 'Id_Prog' => 'Id_Prog']);
    }

    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }     
}
