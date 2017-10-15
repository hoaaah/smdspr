<?php

namespace backend\modules\musrenbangdesa\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "t_ba".
 *
 * @property integer $id
 * @property string $tahun
 * @property integer $kd_urusan
 * @property integer $kd_bidang
 * @property integer $kd_unit
 * @property integer $kd_sub
 * @property integer $kd_kecamatan
 * @property integer $kd_kelurahan
 * @property integer $rw
 * @property integer $rt
 * @property string $no_ba
 * @property string $tanggal_ba
 * @property integer $input_phased
 * @property string $penandatangan
 * @property string $nip_penandatangan
 * @property string $jabatan_penandatangan
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 *
 * @property TBaRenjaKegiatan[] $tBaRenjaKegiatans
 * @property TBaRenjaProgram[] $tBaRenjaPrograms
 * @property TBaRkpdProgram[] $tBaRkpdPrograms
 * @property TBaSubkegiatan[] $tBaSubkegiatans
 */
class Proses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_ba';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun', 'tanggal_ba'], 'safe'],
            [['tahun', 'no_ba', 'tanggal_ba', 'penandatangan', 'jabatan_penandatangan'], 'required', 'message' => 'Wajib diisi.'],
            [['kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'kd_kecamatan', 'kd_kelurahan', 'rw', 'rt', 'input_phased', 'status', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['kd_kelurahan', 'tahun'], 'unique', 'targetAttribute' => ['kd_kelurahan', 'tahun'], 'message' => 'Berita Acara untuk tahun tersebut sudah ada.'],
            [['no_ba', 'penandatangan', 'jabatan_penandatangan'], 'string', 'max' => 255],
            [['nip_penandatangan'], 'string', 'max' => 18],
            [['kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Sub::className(), 'targetAttribute' => ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang', 'kd_unit' => 'Kd_Unit', 'kd_sub' => 'Kd_Sub']],            
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
            'kd_kecamatan' => 'Kd Kecamatan',
            'kd_kelurahan' => 'Kd Kelurahan',
            'rw' => 'Rw',
            'rt' => 'Rt',
            'no_ba' => 'No Ba',
            'tanggal_ba' => 'Tanggal Ba',
            'input_phased' => 'Input Phased',
            'penandatangan' => 'Penandatangan',
            'nip_penandatangan' => 'Nip Penandatangan',
            'jabatan_penandatangan' => 'Jabatan Penandatangan',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }  
    
    public function getSub()
    {
        return $this->hasOne(\common\models\Sub::className(), ['Kd_Urusan' => 'kd_urusan', 'Kd_Bidang' => 'kd_bidang', 'Kd_Unit' => 'kd_unit', 'Kd_Sub' => 'kd_sub']);
    }


    public function getKelurahan()
    {
        return $this->hasOne(\common\models\Desa::className(), ['id' => 'kd_kelurahan']);
    }

    public function getKecamatan()
    {
        return $this->hasOne(\common\models\Kecamatan::className(), ['id' => 'kd_kecamatan']);
    }    
/*
    public function getTBaRenjaKegiatans()
    {
        return $this->hasMany(TBaRenjaKegiatan::className(), ['ba_id' => 'id']);
    }


    public function getTBaRenjaPrograms()
    {
        return $this->hasMany(TBaRenjaProgram::className(), ['ba_id' => 'id']);
    }


    public function getTBaRkpdPrograms()
    {
        return $this->hasMany(TBaRkpdProgram::className(), ['ba_id' => 'id']);
    }


    public function getTBaSubkegiatans()
    {
        return $this->hasMany(TBaSubkegiatan::className(), ['ba_id' => 'id']);
    }
*/
}
