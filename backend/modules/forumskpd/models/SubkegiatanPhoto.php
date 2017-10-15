<?php

namespace backend\modules\forumskpd\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "t_subkegiatan_photo".
 *
 * @property integer $id
 * @property integer $musrenbang_id
 * @property resource $photo
 * @property string $files
 * @property string $caption
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 */
class SubkegiatanPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_subkegiatan_photo';
    }

    public $image;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['musrenbang_id', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['file', 'image'], 'safe'],
            [['caption', 'file'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'jpg, gif, png', 'maxFiles' => 4 ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'musrenbang_id' => 'Musrenbang ID',
            'file' => 'Nama File',
            'image' => 'File Gambar',
            'caption' => 'Catatan Gambar',
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
