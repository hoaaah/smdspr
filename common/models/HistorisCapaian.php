<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_historis_capaian".
 *
 * @property integer $id
 * @property integer $kd_historis
 * @property integer $id_ref
 * @property string $tahun
 * @property integer $urusan_id
 * @property integer $bidang_id
 * @property integer $no_misi
 * @property integer $no_tujuan
 * @property integer $no_sasaran
 * @property integer $kd_progrkpd
 * @property integer $id_progrkpd
 * @property integer $id_prog
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
 * @property string $alasan_perubahan
 */
class HistorisCapaian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_historis_capaian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kd_historis', 'id_ref', 'urusan_id', 'bidang_id', 'no_misi', 'no_tujuan', 'no_sasaran', 'kd_progrkpd', 'id_progrkpd', 'id_prog', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog', 'id_renkeg', 'no_indikator', 'kd_indikator_1', 'kd_indikator_2', 'kd_indikator_3', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased'], 'integer'],
            [['tahun'], 'safe'],
            [['target_angka'], 'number'],
            [['tolok_ukur', 'target_uraian', 'keterangan', 'uraian', 'alasan_perubahan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kd_historis' => 'Kd Historis',
            'id_ref' => 'Id Ref',
            'tahun' => 'Tahun',
            'urusan_id' => 'Urusan ID',
            'bidang_id' => 'Bidang ID',
            'no_misi' => 'No Misi',
            'no_tujuan' => 'No Tujuan',
            'no_sasaran' => 'No Sasaran',
            'kd_progrkpd' => 'Kd Progrkpd',
            'id_progrkpd' => 'Id Progrkpd',
            'id_prog' => 'Id Prog',
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
            'alasan_perubahan' => 'Alasan Perubahan',
        ];
    }
}
