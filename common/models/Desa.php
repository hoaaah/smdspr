<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r_desa".
 *
 * @property integer $id
 * @property integer $kecamatan_id
 * @property string $desa
 */
class Desa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_desa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kecamatan_id'], 'integer'],
            [['desa'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kecamatan_id' => 'Kecamatan ID',
            'desa' => 'Desa/Kelurahan',
        ];
    }

    public function getKecamatan()
    {
        return $this->hasOne(Kecamatan::className(), ['id' => 'kecamatan_id']);
    }    
}
