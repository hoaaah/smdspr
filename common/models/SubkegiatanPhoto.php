<?php

namespace common\models;

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
    public $image1;
    public $image2;
    public $image3;
    public $image4;
    public $catatan;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['musrenbang_id', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['file'], 'safe'],
            [['caption', 'catatan', 'file'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'jpg, gif, png', 'maxSize' => 5012, 'skipOnEmpty' => true/*, 'on' => 'imageUploaded'*/],
            [['image1'], 'file', 'extensions' => 'jpg, gif, png', 'maxSize' => 5012, 'skipOnEmpty' => true/*, 'on' => 'imageUploaded'*/],
            [['image2'], 'file', 'extensions' => 'jpg, gif, png', 'maxSize' => 5012, 'skipOnEmpty' => true/*, 'on' => 'imageUploaded'*/],
            [['image3'], 'file', 'extensions' => 'jpg, gif, png', 'maxSize' => 5012, 'skipOnEmpty' => true/*, 'on' => 'imageUploaded'*/],
            [['image4'], 'file', 'extensions' => 'jpg, gif, png', 'maxSize' => 5012, 'skipOnEmpty' => true/*, 'on' => 'imageUploaded'*/]
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->photo->saveAs(Yii::getAlias('@common').'/web/unggah/usulan/' . $this->file->baseName .'_'.$this->created_at. '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
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
            'image1' => 'File Gambar',
            'image2' => 'File Gambar',
            'image3' => 'File Gambar',
            'image4' => 'File Gambar',            
            'caption' => 'Catatan Gambar',
            'catatan' => 'Catatan Gambar',
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
