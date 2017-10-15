<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r_phased".
 *
 * @property integer $id
 * @property string $keterangan
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 */
class Phased extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_phased';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'user_id'], 'integer'],
            [['keterangan'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keterangan' => 'Keterangan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
        ];
    }
}
