<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_rpjmd_prioritas".
 *
 * @property integer $id
 * @property integer $ID_Tahun
 * @property integer $Kd_Prioritas
 * @property string $Uraian
 */
class TRpjmdPrioritas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_rpjmd_prioritas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prioritas'], 'integer'],
            [['Uraian'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ID_Tahun' => 'Id  Tahun',
            'Kd_Prioritas' => 'Kd  Prioritas',
            'Uraian' => 'Uraian',
        ];
    }
}
