<?php

namespace frontend\models;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'nama', 'alamat', 'contact', 'jabatan'], 'string'],
            [['status', 'created_at', 'updated_at', 'kd_user', 'kd_peran', 'kd_pemda'], 'integer'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['username'], 'unique'],
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
}
