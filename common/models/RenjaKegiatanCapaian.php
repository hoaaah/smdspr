<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_renja_kegiatan_capaian".
 *
 * @property integer $id
 * @property string $tahun
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
 * @property integer $id_renkeg
 * @property integer $no_indikator
 * @property string $tolok_ukur
 * @property string $target_angka
 * @property string $target_uraian
 * @property integer $kd_indikator_1
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
 * @property RSubUnit $kdUrusan
 * @property RIndikator1 $kdIndikator1
 * @property RIndikator2 $kdIndikator2
 * @property RIndikator3 $kdIndikator3
 */
class RenjaKegiatanCapaian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_renja_kegiatan_capaian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun'], 'safe'],
            [['kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog', 'id_renkeg', 'no_indikator', 'kd_indikator_1', 'kd_indikator_2', 'kd_indikator_3', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased'], 'integer'],
            [['target_angka'], 'number'],
            [['tolok_ukur', 'target_uraian', 'keterangan', 'uraian'], 'string', 'max' => 255],
            [['kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub'], 'exist', 'skipOnError' => true, 'targetClass' => Sub::className(), 'targetAttribute' => ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang', 'kd_unit' => 'Kd_Unit', 'kd_sub' => 'Kd_Sub']],
            [['kd_indikator_1'], 'exist', 'skipOnError' => true, 'targetClass' => RIndikator1::className(), 'targetAttribute' => ['kd_indikator_1' => 'id']],
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
            'id_renkeg' => 'Id Renkeg',
            'no_indikator' => 'No Indikator',
            'tolok_ukur' => 'Tolok Ukur',
            'target_angka' => 'Target Angka',
            'target_uraian' => 'Target Uraian',
            'kd_indikator_1' => 'Kd Indikator 1',
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
    public function getSubunit()
    {
        return $this->hasOne(Sub::className(), ['Kd_Urusan' => 'kd_urusan', 'Kd_Bidang' => 'kd_bidang', 'Kd_Unit' => 'kd_unit', 'Kd_Sub' => 'kd_sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdIndikator1()
    {
        return $this->hasOne(RIndikator1::className(), ['id' => 'kd_indikator_1']);
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
}
