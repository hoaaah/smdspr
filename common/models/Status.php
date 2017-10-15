<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r_status".
 *
 * @property integer $id
 * @property string $keterangan
 *
 * @property TSubkegiatan[] $tSubkegiatans
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keterangan'], 'string', 'max' => 50],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubkegiatans()
    {
        return $this->hasMany(Subkegiatan::className(), ['input_status' => 'id']);
    }
}
