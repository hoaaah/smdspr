<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "t_schedule".
 *
 * @property integer $id
 * @property integer $input_phased
 * @property string $tahun
 * @property string $tgl_mulai
 * @property string $tgl_selesai
 * @property string $keterangan
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 */
class Jadwal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['input_phased', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['tahun', 'tgl_mulai', 'tgl_selesai'], 'safe'],
            [['keterangan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'input_phased' => 'Tahap',
            'tahun' => 'Tahun',
            'tgl_mulai' => 'Tanggal Mulai',
            'tgl_selesai' => 'Tanggal Selesai',
            'keterangan' => 'Keterangan',
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

    public function getPhased()
    {
        return $this->hasOne(Phased::className(), ['id' => 'input_phased']);
    }    
}
