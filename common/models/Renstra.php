<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Renstra".
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
 * @property string $Tgl_Perubahan
 * @property string $Nm_Prov
 * @property string $Nm_Kab
 * @property string $Nm_Urusan
 * @property string $Nm_Bidang
 * @property string $Nm_Unit
 * @property string $Ur_Misi
 * @property string $Ur_Tujuan
 * @property string $Ur_Sasaran
 * @property string $Ket_Program
 * @property integer $Kd_Urusan1
 * @property integer $Kd_Bidang1
 * @property integer $No_Misi1
 * @property integer $No_Tujuan1
 * @property integer $No_Sasaran1
 * @property integer $Kd_Prog1
 * @property integer $ID_Prog1
 * @property string $Ur_Misi1
 * @property string $Ur_Tujuan1
 * @property string $Ur_Sasaran1
 * @property string $Ket_Program1
 *
 * @property TaSasaranSKPD $iDTahun
 */
class Renstra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_renstra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog'], 'required'],
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog', 'Kd_Urusan1', 'Kd_Bidang1', 'No_Misi1', 'No_Tujuan1', 'No_Sasaran1', 'Kd_Prog1', 'ID_Prog1'], 'integer'],
            [['Tgl_Perubahan'], 'safe'],
            [['Nm_Prov', 'Nm_Kab', 'Nm_Urusan', 'Nm_Bidang', 'Nm_Unit', 'Ur_Misi', 'Ur_Tujuan', 'Ur_Sasaran', 'Ket_Program', 'Ur_Misi1', 'Ur_Tujuan1', 'Ur_Sasaran1', 'Ket_Program1'], 'string', 'max' => 255],
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran'], 'exist', 'skipOnError' => true, 'targetClass' => TaSasaranSKPD::className(), 'targetAttribute' => ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran']],
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
            'Tgl_Perubahan' => 'Tgl  Perubahan',
            'Nm_Prov' => 'Nm  Prov',
            'Nm_Kab' => 'Nm  Kab',
            'Nm_Urusan' => 'Nm  Urusan',
            'Nm_Bidang' => 'Nm  Bidang',
            'Nm_Unit' => 'Nm  Unit',
            'Ur_Misi' => 'Ur  Misi',
            'Ur_Tujuan' => 'Ur  Tujuan',
            'Ur_Sasaran' => 'Ur  Sasaran',
            'Ket_Program' => 'Ket  Program',
            'Kd_Urusan1' => 'Kd  Urusan1',
            'Kd_Bidang1' => 'Kd  Bidang1',
            'No_Misi1' => 'No  Misi1',
            'No_Tujuan1' => 'No  Tujuan1',
            'No_Sasaran1' => 'No  Sasaran1',
            'Kd_Prog1' => 'Kd  Prog1',
            'ID_Prog1' => 'Id  Prog1',
            'Ur_Misi1' => 'Ur  Misi1',
            'Ur_Tujuan1' => 'Ur  Tujuan1',
            'Ur_Sasaran1' => 'Ur  Sasaran1',
            'Ket_Program1' => 'Ket  Program1',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSasaran()
    {
        return $this->hasOne(TaSasaranSKPD::className(), ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran']);
    }

    public function getPagu()
    {
        return $this->hasOne(TaPaguProgRenstra::className(), ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran', 'Kd_Prog' => 'Kd_Prog', 'ID_Prog' => 'ID_Prog']);
    }    

    public function getRpjmdProgram()
    {
        return $this->hasOne(RpjmdProgram::className(), ['ID_Tahun' => 'ID_Tahun', 'Kd_Urusan1' => 'Kd_Urusan1', 'Kd_Bidang1' => 'Kd_Bidang1', 'No_Misi' => 'No_Misi1', 'No_Tujuan' => 'No_Tujuan1', 'No_Sasaran' => 'No_Sasaran1', 'Kd_Prog' => 'Kd_Prog1', 'ID_Prog' => 'ID_Prog1']);
    }      
}
