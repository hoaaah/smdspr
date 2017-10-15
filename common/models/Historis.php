<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_historis".
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
 * @property string $uraian
 * @property integer $kd_kecamatan
 * @property integer $kd_kelurahan
 * @property integer $rw
 * @property integer $rt
 * @property string $lokasi
 * @property string $lokasi_maps
 * @property string $kelompok_sasaran
 * @property string $status_kegiatan
 * @property string $pagu_program
 * @property string $pagu_kegiatan
 * @property string $pagu_musrenbang
 * @property string $volume
 * @property string $satuan
 * @property string $harga_satuan
 * @property string $biaya
 * @property integer $kd_asb
 * @property string $info_asb
 * @property integer $kd_bahas
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 * @property integer $input_phased
 * @property integer $status
 * @property integer $status_phased
 * @property string $alasan_perubahan
 */
class Historis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_historis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kd_historis', 'id_ref', 'urusan_id', 'bidang_id', 'no_misi', 'no_tujuan', 'no_sasaran', 'kd_progrkpd', 'id_progrkpd', 'id_prog', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog', 'id_renkeg', 'kd_kecamatan', 'kd_kelurahan', 'rw', 'rt', 'kd_asb', 'kd_bahas', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased'], 'integer'],
            [['tahun'], 'safe'],
            [['pagu_program', 'pagu_kegiatan', 'pagu_musrenbang', 'volume', 'harga_satuan', 'biaya'], 'number'],
            [['uraian', 'lokasi', 'lokasi_maps', 'kelompok_sasaran', 'status_kegiatan', 'info_asb', 'alasan_perubahan'], 'string', 'max' => 255],
            [['satuan'], 'string', 'max' => 50],
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
            'uraian' => 'Uraian',
            'kd_kecamatan' => 'Kd Kecamatan',
            'kd_kelurahan' => 'Kd Kelurahan',
            'rw' => 'Rw',
            'rt' => 'Rt',
            'lokasi' => 'Lokasi',
            'lokasi_maps' => 'Lokasi Maps',
            'kelompok_sasaran' => 'Kelompok Sasaran',
            'status_kegiatan' => 'Status Kegiatan',
            'pagu_program' => 'Pagu Program',
            'pagu_kegiatan' => 'Pagu Kegiatan',
            'pagu_musrenbang' => 'Pagu Musrenbang',
            'volume' => 'Volume',
            'satuan' => 'Satuan',
            'harga_satuan' => 'Harga Satuan',
            'biaya' => 'Biaya',
            'kd_asb' => 'Kd Asb',
            'info_asb' => 'Info Asb',
            'kd_bahas' => 'Kd Bahas',
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
