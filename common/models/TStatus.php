<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "t_status".
 *
 * @property integer $id
 * @property integer $id_historis
 * @property integer $id_ref
 * @property integer $kd_status
 * @property string $alasan_tolak
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 */
class TStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_historis', 'id_ref', 'kd_status', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['alasan_tolak'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_historis' => 'Id Historis',
            'id_ref' => 'Id Ref',
            'kd_status' => 'Kd Status',
            'alasan_tolak' => 'Alasan',
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
        
}