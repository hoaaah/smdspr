<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "r_indikator_3".
 *
 * @property integer $id
 * @property string $jn_indikator
 *
 * @property TRkpdProgramCapaian[] $tRkpdProgramCapaians
 */
class RIndikator3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'r_indikator_3';
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTRkpdProgramCapaians()
    {
        return $this->hasMany(TRkpdProgramCapaian::className(), ['kd_indikator_3' => 'id']);
    }
}
