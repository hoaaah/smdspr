<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_renja_kegiatan".
 *
 * @property integer $id
 * @property integer $renja_program_id
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
 * @property string $uraian
 * @property string $lokasi
 * @property string $lokasi_maps
 * @property string $kelompok_sasaran
 * @property string $status_kegiatan
 * @property string $pagu_kegiatan
 * @property string $pagu_musrenbang
 * @property integer $kd_asb
 * @property string $info_asb
 * @property integer $kd_bahas
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 * @property integer $input_phased
 * @property integer $status
 * @property integer $status_phased
 *
 * @property TRenjaProgram $renjaProgram
 * @property TSubkegiatan[] $tSubkegiatans
 */
class TRenjaKegiatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_renja_kegiatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['renja_program_id', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog', 'id_renkeg', 'kd_asb', 'kd_bahas', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased'], 'integer'],
            [['tahun'], 'safe'],
            [['pagu_kegiatan', 'pagu_musrenbang'], 'number'],
            [['uraian', 'lokasi', 'lokasi_maps', 'kelompok_sasaran', 'status_kegiatan', 'info_asb'], 'string', 'max' => 255],
            [['renja_program_id'], 'exist', 'skipOnError' => true, 'targetClass' => TRenjaProgram::className(), 'targetAttribute' => ['renja_program_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'renja_program_id' => 'Renja Program ID',
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
            'uraian' => 'Uraian',
            'lokasi' => 'Lokasi',
            'lokasi_maps' => 'Lokasi Maps',
            'kelompok_sasaran' => 'Kelompok Sasaran',
            'status_kegiatan' => 'Status Kegiatan',
            'pagu_kegiatan' => 'Pagu Kegiatan',
            'pagu_musrenbang' => 'Pagu Musrenbang',
            'kd_asb' => 'Kd Asb',
            'info_asb' => 'Info Asb',
            'kd_bahas' => 'Kd Bahas',
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
    public function getRenjaProgram()
    {
        return $this->hasOne(TRenjaProgram::className(), ['id' => 'renja_program_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTSubkegiatans()
    {
        return $this->hasMany(TSubkegiatan::className(), ['renja_kegiatan_id' => 'id']);
    }
}
