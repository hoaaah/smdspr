<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "t_rkpd_program_capaian".
 *
 * @property integer $id
 * @property integer $rkpd_program_id
 * @property string $tahun
 * @property integer $urusan_id
 * @property integer $bidang_id
 * @property integer $no_misi
 * @property integer $no_tujuan
 * @property integer $no_sasaran
 * @property integer $kd_progrkpd
 * @property integer $id_progrkpd
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
 * @property RIndikator3 $kdIndikator3
 * @property RIndikator2 $kdIndikator2
 */
class RkpdProgramCapaian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_rkpd_program_capaian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rkpd_program_id', 'urusan_id', 'bidang_id', 'no_misi', 'no_tujuan', 'no_sasaran', 'kd_progrkpd', 'id_progrkpd', 'no_indikator', 'kd_indikator_2', 'kd_indikator_3', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased'], 'integer'],
            [['tahun'], 'safe'],
            [['target_angka'], 'number'],
            [['tolok_ukur', 'target_uraian', 'keterangan', 'uraian'], 'string', 'max' => 255],
            [['kd_indikator_3'], 'exist', 'skipOnError' => true, 'targetClass' => RIndikator3::className(), 'targetAttribute' => ['kd_indikator_3' => 'id']],
            [['kd_indikator_2'], 'exist', 'skipOnError' => true, 'targetClass' => RIndikator2::className(), 'targetAttribute' => ['kd_indikator_2' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rkpd_program_id' => 'Rkpd Program ID',
            'tahun' => 'Tahun',
            'urusan_id' => 'Urusan ID',
            'bidang_id' => 'Bidang ID',
            'no_misi' => 'No Misi',
            'no_tujuan' => 'No Tujuan',
            'no_sasaran' => 'No Sasaran',
            'kd_progrkpd' => 'Kd Progrkpd',
            'id_progrkpd' => 'Id Progrkpd',
            'no_indikator' => 'No Indikator',
            'tolok_ukur' => 'Tolok Ukur',
            'target_angka' => 'Target Angka',
            'target_uraian' => 'Satuan Target',
            'kd_indikator_2' => 'Jenis Indikator 2',
            'kd_indikator_3' => 'Jenis Indikator 3',
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

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdIndikator3()
    {
        return $this->hasOne(RIndikator3::className(), ['id' => 'kd_indikator_3']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdIndikator2()
    {
        return $this->hasOne(RIndikator2::className(), ['id' => 'kd_indikator_2']);
    }
}
