<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "t_subkegiatan".
 *
 * @property integer $id
 * @property integer $renja_kegiatan_id
 * @property string $uraian
 * @property integer $kd_kecamatan
 * @property integer $kd_kelurahan
 * @property integer $rw
 * @property integer $rt
 * @property string $lokasi
 * @property double $volume
 * @property double $biaya
 * @property string $keterangan
 * @property integer $kd_asb
 * @property integer $input_phased
 * @property integer $status_phased
 * @property integer $input_status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 *
 * @property RPhased $statusPhased
 * @property TRenjaKegiatan $renjaKegiatan
 * @property RKecamatan $kdKecamatan
 * @property RDesa $kdKelurahan
 * @property User $user
 * @property RPhased $inputPhased
 * @property RStatus $inputStatus
 */
class Subkegiatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_subkegiatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun', 'renja_kegiatan_id',  'kd_kecamatan', 'kd_kelurahan', 'rw', 'rt', 'kd_asb', 'input_phased', 'status_phased', 'input_status', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['volume', 'harga_satuan', 'biaya', 'skpd'], 'number'],
            [['keterangan'], 'string'],
            [['uraian', 'lokasi'], 'string', 'max' => 255],
            [['satuan'], 'string', 'max' => 20],
            [['status_phased'], 'exist', 'skipOnError' => true, 'targetClass' => Phased::className(), 'targetAttribute' => ['status_phased' => 'id']],
            [['renja_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => RenjaKegiatan::className(), 'targetAttribute' => ['renja_kegiatan_id' => 'id']],
            [['kd_kecamatan'], 'exist', 'skipOnError' => true, 'targetClass' => Kecamatan::className(), 'targetAttribute' => ['kd_kecamatan' => 'id']],
            [['kd_kelurahan'], 'exist', 'skipOnError' => true, 'targetClass' => Desa::className(), 'targetAttribute' => ['kd_kelurahan' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['input_phased'], 'exist', 'skipOnError' => true, 'targetClass' => Phased::className(), 'targetAttribute' => ['input_phased' => 'id']],
            [['input_status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['input_status' => 'id']],
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
            'renja_kegiatan_id' => 'Renja Kegiatan ID',
            'uraian' => 'Usulan',
            'kd_kecamatan' => 'Kd Kecamatan',
            'kd_kelurahan' => 'Kd Kelurahan',
            'rw' => 'RW',
            'rt' => 'RT',
            'lokasi' => 'Maps',
            'volume' => 'Volume',
            'satuan' => 'Satuan',
            'harga_satuan' => 'Harga Satuan',
            'biaya' => 'Biaya',
            'keterangan' => 'Keterangan (info ukuran)',
            'kd_asb' => 'Kd Asb',
            'input_phased' => 'Input Phased',
            'status_phased' => 'Status Phased',
            'input_status' => 'Input Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'skpd' => 'SKPD?'
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
    public function getStatusPhased()
    {
        return $this->hasOne(Phased::className(), ['id' => 'status_phased']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenjaKegiatan()
    {
        return $this->hasOne(RenjaKegiatan::className(), ['id' => 'renja_kegiatan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id' => 'kd_kecamatan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesa()
    {
        return $this->hasOne(Desa::className(), ['id' => 'kd_kelurahan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getTolak()
    {
        return $this->hasOne(TStatus::className(), ['id_ref' => 'id']);
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInputPhased()
    {
        return $this->hasOne(Phased::className(), ['id' => 'input_phased']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInputStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'input_status']);
    }
}
