<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_peran".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $kd_urusan
 * @property integer $kd_bidang
 * @property integer $kd_unit
 * @property integer $kd_sub
 * @property integer $kd_kecamatan
 * @property integer $kd_kelurahan
 * @property integer $rw
 * @property integer $rt
 */
class TPeran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_peran';
    }

    public $skpd;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'kd_kecamatan', 'kd_kelurahan', 'rw', 'rt'], 'integer'],
            [['skpd'], 'string']
        ];
    }
    
    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id' => 'kd_kecamatan']);
    }   

    public function getKelurahan()
    {
        return $this->hasOne(Desa::className(), ['id' => 'kd_kelurahan']);
    }   


   public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }	
	
    public function getSub()
    {
        return $this->hasOne(Sub::className(), ['kd_urusan' => 'kd_urusan', 'kd_bidang' => 'kd_bidang', 'kd_unit' => 'kd_unit', 'kd_sub' => 'kd_sub']);
    }     

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'kd_urusan' => 'Urusan',
            'kd_bidang' => 'Bidang',
            'kd_unit' => 'Unit',
            'kd_sub' => 'Sub Unit',
            'kd_kecamatan' => 'Kecamatan',
            'kd_kelurahan' => 'Kelurahan',
            'rw' => 'RW',
            'rt' => 'RT',
        ];
    }
}
