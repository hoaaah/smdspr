<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $kd_user
 * @property integer $kd_peran
 * @property integer $kd_pemda
 * @property string $nama
 * @property string $alamat
 * @property string $contact
 * @property string $jabatan
 *
 * @property TRenjaKegiatan[] $tRenjaKegiatans
 * @property TRenjaProgram[] $tRenjaPrograms
 * @property TSubkegiatan[] $tSubkegiatans
 * @property RGroup $kdUser
 * @property RPeran $kdPeran
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    public $oldpassword;

    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'kd_user', 'kd_peran', 'kd_pemda', 'nama', 'contact'], 'required'],
            [['status', 'created_at', 'updated_at', 'kd_user', 'kd_peran', 'kd_pemda'], 'integer'],
            [['username', 'password_hash', 'password', 'oldpassword', 'password_reset_token', 'email', 'alamat'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['nama'], 'string', 'max' => 50],
            [['contact'], 'string', 'max' => 20],
            [['jabatan'], 'string', 'max' => 45],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['kd_user'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Group::className(), 'targetAttribute' => ['kd_user' => 'id']],
            [['kd_peran'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Peran::className(), 'targetAttribute' => ['kd_peran' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'kd_user' => 'Kd User',
            'kd_peran' => 'Kd Peran',
            'kd_pemda' => 'Kd Pemda',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'contact' => 'Contact',
            'jabatan' => 'Jabatan',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenjaKegiatan()
    {
        return $this->hasMany(\common\models\RenjaKegiatan::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRenjaProgram()
    {
        return $this->hasMany(\common\models\RenjaProgram::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubkegiatan()
    {
        return $this->hasMany(\common\models\Subkegiatan::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(\common\models\Group::className(), ['id' => 'kd_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeran()
    {
        return $this->hasOne(\common\models\Peran::className(), ['id' => 'kd_peran']);
    }

    //function dari model common\user 
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    //endof common\model\user    
}
