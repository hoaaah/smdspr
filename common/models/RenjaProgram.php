<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "t_renja_program".
 *
 * @property integer $id
 * @property string $tahun
 * @property integer $urusan_id
 * @property integer $bidang_id
 * @property integer $kd_urusan
 * @property integer $kd_bidang
 * @property integer $kd_unit
 * @property integer $kd_sub
 * @property integer $no_skpdMisi
 * @property integer $no_skpdTujuan
 * @property integer $no_skpdSasaran
 * @property integer $no_renjaSas
 * @property integer $no_renjaProg
 * @property integer $id_renprog
 * @property string $uraian
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 * @property integer $input_phased
 * @property integer $status
 * @property integer $status_phased
 */
class RenjaProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_renja_program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun'], 'safe'],
            [['urusan_id', 'bidang_id', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased', 'rkpd_program_id', 'id_tahun', 'Kd_Perubahan_Renstra', 'Kd_Dokumen_Renstra', 'Kd_Usulan_Renstra', 'Kd_Urusan_Renstra', 'Kd_Bidang_Renstra', 'Kd_Unit_Renstra', 'No_Misi_Renstra', 'No_Tujuan_Renstra', 'No_Sasaran_Renstra', 'Kd_Prog_Renstra', 'ID_Prog_Renstra'], 'integer'],
            [['uraian'], 'string', 'max' => 255],
            [['pagu_program'], 'number'],
            [['kd_urusan', 'kd_bidang', 'kd_unit'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang', 'kd_unit' => 'Kd_Unit']],
            [['kd_urusan', 'kd_bidang'], 'exist', 'skipOnError' => true, 'targetClass' => Bidang::className(), 'targetAttribute' => ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang']],
            [['kd_urusan'], 'exist', 'skipOnError' => true, 'targetClass' => Urusan::className(), 'targetAttribute' => ['kd_urusan' => 'Kd_Urusan']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub'], 'exist', 'skipOnError' => true, 'targetClass' => Sub::className(), 'targetAttribute' => ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang', 'kd_unit' => 'Kd_Unit', 'kd_sub' => 'Kd_Sub']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun' => 'Tahun',
            'urusan_id' => 'Urusan ID',
            'bidang_id' => 'Bidang ID',
            'kd_urusan' => 'Kd Urusan',
            'kd_bidang' => 'Kd Bidang',
            'kd_unit' => 'Kd Unit',
            'kd_sub' => 'Kd Sub',
            'no_skpdMisi' => 'No Skpd Misi',
            'no_skpdTujuan' => 'No Skpd Tujuan',
            'no_skpdSasaran' => 'No Skpd Sasaran',
            'no_renjaSas' => 'No Renja Sas',
            'no_renjaProg' => 'No Renja Prog',
            'id_renprog' => 'Id Renprog',
            'uraian' => 'Program',
            'pagu_program' => 'Pagu Program',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'input_phased' => 'Input Phased',
            'status' => 'Status',
            'status_phased' => 'Status Phased',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusan1()
    {
        return $this->hasOne(Urusan::className(), ['Kd_Urusan' => 'urusan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidang1()
    {
        return $this->hasOne(Bidang::className(), ['Kd_Urusan' => 'urusan_id', 'Kd_Bidang' => 'bidang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusan()
    {
        return $this->hasOne(Urusan::className(), ['Kd_Urusan' => 'kd_urusan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBidang()
    {
        return $this->hasOne(Bidang::className(), ['Kd_Urusan' => 'kd_urusan', 'Kd_Bidang' => 'kd_bidang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['Kd_Urusan' => 'kd_urusan', 'Kd_Bidang' => 'kd_bidang', 'Kd_Unit' => 'kd_unit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubunit()
    {
        return $this->hasOne(Sub::className(), ['Kd_Urusan' => 'kd_urusan', 'Kd_Bidang' => 'kd_bidang', 'Kd_Unit' => 'kd_unit', 'Kd_Sub' => 'kd_sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getPhased()
    {
        return $this->hasOne(Phased::className(), ['id' => 'input_phased']);
    }
    public function getStatusPhased()
    {
        return $this->hasOne(Phased::className(), ['id' => 'status_phased']);
    }
    public function getInputStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status']);
    }    

    public function getRkpdprogram()
    {
        return $this->hasOne(RkpdProgram::className(), ['id' => 'rkpd_program_id']);
    }  

    public function getRenstra()
    {
        return $this->hasOne(Renstra::className(), ['ID_Tahun' => 'id_tahun', 'Kd_Perubahan' => 'Kd_Perubahan_Renstra', 'Kd_Dokumen' => 'Kd_Dokumen_Renstra', 'Kd_Usulan' => 'Kd_Usulan_Renstra', 'Kd_Urusan' => 'Kd_Urusan_Renstra', 'Kd_Bidang' => 'Kd_Bidang_Renstra', 'Kd_Unit' => 'Kd_Unit_Renstra', 'No_Misi' => 'No_Misi_Renstra', 'No_Tujuan' => 'No_Tujuan_Renstra', 'No_Sasaran' => 'No_Sasaran_Renstra', 'Kd_Prog' => 'Kd_Prog_Renstra', 'ID_Prog' => 'ID_Prog_Renstra']);
    }      

    public function getCapaian()
    {
        return $this->hasMany(RenjaProgramCapaian::className(), ['tahun' => 'tahun', 'no_skpdMisi' => 'no_skpdMisi' , 'no_skpdTujuan' => 'no_skpdTujuan', 'no_skpdSasaran' => 'no_skpdSasaran', 'no_renjaProg' => 'no_renjaProg', 'id_renprog' => 'id_renprog']);
    }
}
