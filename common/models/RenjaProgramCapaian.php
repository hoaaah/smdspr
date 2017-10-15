<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;


/**
 * This is the model class for table "t_renja_program_capaian".
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
 * @property integer $no_indikator
 * @property string $tolok_ukur
 * @property string $target_angka
 * @property string $target_uraian
 * @property integer $kd_indikator_2
 * @property integer $kd_indikator_3
 * @property string $keterangan
 * @property string $uraian
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 * @property integer $input_phased
 * @property integer $status
 * @property integer $status_phased
 *
 * @property RBidang $urusan
 * @property RSubUnit $kdUrusan
 * @property RIndikator2 $kdIndikator2
 * @property RIndikator3 $kdIndikator3
 */
class RenjaProgramCapaian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_renja_program_capaian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun'], 'safe'],
            [['urusan_id', 'bidang_id', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog', 'no_indikator', 'kd_indikator_2', 'kd_indikator_3', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased'], 'integer'],
            [['target_angka'], 'number'],
            [['tolok_ukur', 'target_uraian', 'keterangan', 'uraian'], 'string', 'max' => 255],
            [['urusan_id', 'bidang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bidang::className(), 'targetAttribute' => ['urusan_id' => 'Kd_Urusan', 'bidang_id' => 'Kd_Bidang']],
            [['kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub'], 'exist', 'skipOnError' => true, 'targetClass' => Sub::className(), 'targetAttribute' => ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang', 'kd_unit' => 'Kd_Unit', 'kd_sub' => 'Kd_Sub']],
            [['kd_indikator_2'], 'exist', 'skipOnError' => true, 'targetClass' => RIndikator2::className(), 'targetAttribute' => ['kd_indikator_2' => 'id']],
            [['kd_indikator_3'], 'exist', 'skipOnError' => true, 'targetClass' => RIndikator3::className(), 'targetAttribute' => ['kd_indikator_3' => 'id']],
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
            'no_indikator' => 'No Indikator',
            'tolok_ukur' => 'Tolok Ukur',
            'target_angka' => 'Target Angka',
            'target_uraian' => 'Target Uraian',
            'kd_indikator_2' => 'Kd Indikator 2',
            'kd_indikator_3' => 'Kd Indikator 3',
            'keterangan' => 'Keterangan',
            'uraian' => 'Uraian',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'input_phased' => 'Input Phased',
            'status' => 'Status',
            'status_phased' => 'Status Phased',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusan()
    {
        return $this->hasOne(Bidang::className(), ['Kd_Urusan' => 'urusan_id', 'Kd_Bidang' => 'bidang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(Sub::className(), ['Kd_Urusan' => 'kd_urusan', 'Kd_Bidang' => 'kd_bidang', 'Kd_Unit' => 'kd_unit', 'Kd_Sub' => 'kd_sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdIndikator2()
    {
        return $this->hasOne(RIndikator2::className(), ['id' => 'kd_indikator_2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdIndikator3()
    {
        return $this->hasOne(RIndikator3::className(), ['id' => 'kd_indikator_3']);
    }

    public function getProgram()
    {
        return $this->hasOne(RenjaProgram::className(), ['tahun' => 'tahun', 'kd_urusan' => 'kd_urusan', 'kd_bidang' => 'kd_bidang', 'kd_unit' => 'kd_unit', 'kd_sub' => 'kd_sub', 'no_skpdMisi' => 'no_skpdMisi', 'no_skpdTujuan' => 'no_skpdTujuan', 'no_skpdSasaran' => 'no_skpdSasaran', 'no_renjaSas' => 'no_renjaSas', 'no_renjaProg' => 'no_renjaProg', 'id_renprog' => 'id_renprog']);
    }     
}
