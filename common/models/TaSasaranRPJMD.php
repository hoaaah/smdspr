<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ta_sasaran_rpjmd".
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
 * @property string $Ur_Sasaran
 * @property integer $Kd_Prioritas
 *
 * @property TaProgramRpjmd[] $taProgramRpjmds
 * @property TaTujuanRpjmd $iDTahun
 */
class TaSasaranRPJMD extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_sasaran_rpjmd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'No_Tujuan', 'No_Sasaran'], 'required'],
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prioritas'], 'integer'],
            [['Ur_Sasaran'], 'string', 'max' => 8000],
            /*
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi', 'No_Tujuan'], 'exist', 'skipOnError' => true, 'targetClass' => TaTujuanRPJMD::className(), 'targetAttribute' => ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Perubahan' => 'Kd_Perubahan', 'Kd_Dokumen' => 'Kd_Dokumen', 'Kd_Usulan' => 'Kd_Usulan', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan']],*/
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
            'Ur_Sasaran' => 'Ur  Sasaran',
            'Kd_Prioritas' => 'Kd  Prioritas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaProgramRpjmds()
    {
        return $this->hasMany(TaProgramRPJMD::className(), ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Perubahan' => 'Kd_Perubahan', 'Kd_Dokumen' => 'Kd_Dokumen', 'Kd_Usulan' => 'Kd_Usulan', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIDTahun()
    {
        return $this->hasOne(TaTujuanRPJMD::className(), ['ID_Tahun' => 'ID_Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab_Kota' => 'Kd_Kab_Kota', 'Kd_Perubahan' => 'Kd_Perubahan', 'Kd_Dokumen' => 'Kd_Dokumen', 'Kd_Usulan' => 'Kd_Usulan', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan']);
    }

    public function getPrioritas()
    {
        return $this->hasOne(\common\models\TRpjmdPrioritas::className(), ['id' => 'Kd_Prioritas']);
    }
}
