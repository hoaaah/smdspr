<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "t_renja_kegiatan".
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
 * @property User $user
 * @property RSubUnit $kdUrusan
 * @property RPhased $inputPhased
 * @property RPhased $statusPhased
 * @property TRenjaProgram $tahun0
 * @property TSubkegiatan[] $tSubkegiatans
 */
class RenjaKegiatan extends \yii\db\ActiveRecord
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
            [['tahun'], 'safe'],
            [['kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog', 'id_renkeg', 'kd_asb', 'kd_bahas', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased'], 'integer'],
            [['pagu_kegiatan', 'pagu_musrenbang'], 'number'],
            [['uraian', 'lokasi', 'lokasi_maps', 'kelompok_sasaran', 'status_kegiatan', 'info_asb'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub'], 'exist', 'skipOnError' => true, 'targetClass' => Sub::className(), 'targetAttribute' => ['kd_urusan' => 'Kd_Urusan', 'kd_bidang' => 'Kd_Bidang', 'kd_unit' => 'Kd_Unit', 'kd_sub' => 'Kd_Sub']],
            [['input_phased'], 'exist', 'skipOnError' => true, 'targetClass' => Phased::className(), 'targetAttribute' => ['input_phased' => 'id']],
            [['status_phased'], 'exist', 'skipOnError' => true, 'targetClass' => Phased::className(), 'targetAttribute' => ['status_phased' => 'id']],
            [['tahun', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog'], 'exist', 'skipOnError' => true, 'targetClass' => RenjaProgram::className(), 'targetAttribute' => ['tahun' => 'tahun', 'kd_urusan' => 'kd_urusan', 'kd_bidang' => 'kd_bidang', 'kd_unit' => 'kd_unit', 'kd_sub' => 'kd_sub', 'no_skpdMisi' => 'no_skpdMisi', 'no_skpdTujuan' => 'no_skpdTujuan', 'no_skpdSasaran' => 'no_skpdSasaran', 'no_renjaSas' => 'no_renjaSas', 'no_renjaProg' => 'no_renjaProg', 'id_renprog' => 'id_renprog']],
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
            'uraian' => 'Uraian',
            'lokasi' => 'Lokasi',
            'lokasi_maps' => 'Lokasi Maps',
            'kelompok_sasaran' => 'Kelompok Sasaran',
            'status_kegiatan' => 'Status Kegiatan',
            'pagu_kegiatan' => 'Pagu Kegiatan',
            'pagu_musrenbang' => 'Pagu Musrenbang',
            'kd_asb' => 'Kd Asb',
            'info_asb' => 'Info Untuk Musrenbang',
            'kd_bahas' => 'Dibahas di Musrenbang',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'input_phased' => 'Input Phased',
            'status' => 'Status',
            'status_phased' => 'Status Phased',
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['aktmusren'] = ['info_asb','kd_bahas', 'pagu_musrenbang'];//Scenario Values Only Accepted
        return $scenarios;
    }    

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }       

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhased()
    {
        return $this->hasOne(Phased::className(), ['id' => 'input_phased']);
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
    public function getSub()
    {
        return $this->hasOne(Sub::className(), ['Kd_Urusan' => 'kd_urusan', 'Kd_Bidang' => 'kd_bidang', 'Kd_Unit' => 'kd_unit', 'Kd_Sub' => 'kd_sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubunit()
    {
        return $this->hasOne(Sub::className(), ['Kd_Urusan' => 'kd_urusan', 'Kd_Bidang' => 'kd_bidang', 'Kd_Unit' => 'kd_unit', 'Kd_Sub' => 'kd_sub']);
    }    

    public function getProgram()
    {
        return $this->hasOne(RenjaProgram::className(), ['tahun' => 'tahun', 'kd_urusan' => 'kd_urusan', 'kd_bidang' => 'kd_bidang', 'kd_unit' => 'kd_unit', 'kd_sub' => 'kd_sub', 'no_skpdMisi' => 'no_skpdMisi', 'no_skpdTujuan' => 'no_skpdTujuan', 'no_skpdSasaran' => 'no_skpdSasaran', 'no_renjaSas' => 'no_renjaSas', 'no_renjaProg' => 'no_renjaProg', 'id_renprog' => 'id_renprog']);
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusPhased()
    {
        return $this->hasOne(Phased::className(), ['id' => 'status_phased']);
    }
    public function getInputStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status']);
    }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubkegiatans()
    {
        return $this->hasMany(Subkegiatan::className(), ['renja_kegiatan_id' => 'id']);
    }
}
