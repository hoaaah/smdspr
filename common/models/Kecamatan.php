<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r_kecamatan".
 *
 * @property integer $id
 * @property string $pemda_id
 * @property string $kd_kecamatan
 * @property string $kecamatan
 */
class Kecamatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_kecamatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pemda_id'], 'string', 'max' => 11],
            [['kd_kecamatan'], 'string', 'max' => 10],
            [['kecamatan'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pemda_id' => 'Pemda ID',
            'kd_kecamatan' => 'Kd Kecamatan',
            'kecamatan' => 'Kecamatan',
        ];
    }
}
