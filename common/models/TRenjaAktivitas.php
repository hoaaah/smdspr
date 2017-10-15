<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "t_renja_aktivitas".
 *
 * @property integer $id
 * @property integer $renja_kegiatan_id
 * @property integer $aktivitas_id
 * @property string $satuan
 * @property string $harga_satuan
 * @property integer $user_id
 *
 * @property TRenjaKegiatan $renjaKegiatan
 * @property User $user
 */
class TRenjaAktivitas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_renja_aktivitas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['renja_kegiatan_id', 'aktivitas_id', 'user_id'], 'integer'],
            [['harga_satuan'], 'number'],
            [['satuan'], 'string', 'max' => 100],
            [['renja_kegiatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => TRenjaKegiatan::className(), 'targetAttribute' => ['renja_kegiatan_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'renja_kegiatan_id' => 'Renja Kegiatan ID',
            'aktivitas_id' => 'Aktivitas ID',
            'satuan' => 'Satuan',
            'harga_satuan' => 'Harga Satuan',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenjaKegiatan()
    {
        return $this->hasOne(TRenjaKegiatan::className(), ['id' => 'renja_kegiatan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
