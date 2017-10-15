<?php

namespace common\models;

use Yii;

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
 * @property string $pagu_program
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 * @property integer $input_phased
 * @property integer $status
 * @property integer $status_phased
 * @property integer $rkpd_program_id
 * @property integer $id_tahun
 * @property integer $Kd_Perubahan_Renstra
 * @property integer $Kd_Dokumen_Renstra
 * @property integer $Kd_Usulan_Renstra
 * @property integer $Kd_Urusan_Renstra
 * @property integer $Kd_Bidang_Renstra
 * @property integer $Kd_Unit_Renstra
 * @property integer $No_Misi_Renstra
 * @property integer $No_Tujuan_Renstra
 * @property integer $No_Sasaran_Renstra
 * @property integer $Kd_Prog_Renstra
 * @property integer $ID_Prog_Renstra
 *
 * @property TRenjaKegiatan[] $tRenjaKegiatans
 * @property User $user
 * @property RSubUnit $kdUrusan
 * @property RUnit $kdUrusan0
 */
class TRenjaProgram extends \yii\db\ActiveRecord
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
            [['pagu_program'], 'number'],
            [['uraian'], 'string', 'max' => 255],
            [['tahun', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog'], 'unique', 'targetAttribute' => ['tahun', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog'], 'message' => 'The combination of Tahun, Kd Urusan, Kd Bidang, Kd Unit, Kd Sub, No Skpd Misi, No Skpd Tujuan, No Skpd Sasaran, No Renja Sas, No Renja Prog and Id Renprog has already been taken.'],
            [['rkpd_program_id', 'id_tahun'], 'unique', 'targetAttribute' => ['rkpd_program_id', 'id_tahun'], 'message' => 'The combination of Rkpd Program ID and Id Tahun has already been taken.'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub'], 'exist', 'skipOnError' => true, 'targetClass' => RSubUnit::className(), 'targetAttribute' => ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang', 'kd_unit' => 'Kd_Unit', 'kd_sub' => 'Kd_Sub']],
            [['kd_urusan', 'kd_bidang', 'kd_unit'], 'exist', 'skipOnError' => true, 'targetClass' => RUnit::className(), 'targetAttribute' => ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang', 'kd_unit' => 'Kd_Unit']],
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
            'uraian' => 'Uraian',
            'pagu_program' => 'Pagu Program',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'input_phased' => 'Input Phased',
            'status' => 'Status',
            'status_phased' => 'Status Phased',
            'rkpd_program_id' => 'Rkpd Program ID',
            'id_tahun' => 'Id Tahun',
            'Kd_Perubahan_Renstra' => 'Kd  Perubahan  Renstra',
            'Kd_Dokumen_Renstra' => 'Kd  Dokumen  Renstra',
            'Kd_Usulan_Renstra' => 'Kd  Usulan  Renstra',
            'Kd_Urusan_Renstra' => 'Kd  Urusan  Renstra',
            'Kd_Bidang_Renstra' => 'Kd  Bidang  Renstra',
            'Kd_Unit_Renstra' => 'Kd  Unit  Renstra',
            'No_Misi_Renstra' => 'No  Misi  Renstra',
            'No_Tujuan_Renstra' => 'No  Tujuan  Renstra',
            'No_Sasaran_Renstra' => 'No  Sasaran  Renstra',
            'Kd_Prog_Renstra' => 'Kd  Prog  Renstra',
            'ID_Prog_Renstra' => 'Id  Prog  Renstra',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTRenjaKegiatans()
    {
        return $this->hasMany(TRenjaKegiatan::className(), ['tahun' => 'tahun', 'kd_urusan' => 'kd_urusan', 'kd_bidang' => 'kd_bidang', 'kd_unit' => 'kd_unit', 'kd_sub' => 'kd_sub', 'no_skpdMisi' => 'no_skpdMisi', 'no_skpdTujuan' => 'no_skpdTujuan', 'no_skpdSasaran' => 'no_skpdSasaran', 'no_renjaSas' => 'no_renjaSas', 'no_renjaProg' => 'no_renjaProg', 'id_renprog' => 'id_renprog']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(RSubUnit::className(), ['Kd_Urusan' => 'kd_urusan', 'Kd_Bidang' => 'kd_bidang', 'Kd_Unit' => 'kd_unit', 'Kd_Sub' => 'kd_sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan0()
    {
        return $this->hasOne(RUnit::className(), ['Kd_Urusan' => 'kd_urusan', 'Kd_Bidang' => 'kd_bidang', 'Kd_Unit' => 'kd_unit']);
    }
}
