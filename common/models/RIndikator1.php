<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r_indikator_1".
 *
 * @property integer $id
 * @property string $jn_indikator
 */
class RIndikator1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_indikator_1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jn_indikator'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jn_indikator' => 'Jn Indikator',
        ];
    }
}
