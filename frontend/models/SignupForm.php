<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $kd_user;
    public $kd_peran;
    public $kd_pemda;
    public $nama;
    public $alamat;
    public $contact;
    public $jabatan;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Username ini sudah digunakan.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email', 'message' => 'Masukkan email yang valid dengan format abcd@simper.com .'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Email ini sudah digunakan.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'message' => 'Password anda minimal harus terdiri dari 6 karakter.'],
            
			['kd_user', 'required'],
			['kd_peran', 'required'],
            //['kd_user', 'integer', 'max' => 2],
            //['kd_peran', 'integer', 'max' => 2],
            ['kd_pemda', 'string', 'max' => 255],
            ['nama', 'string', 'max' => 255, 'message' => 'Nama maksimal 255 karakter.'],
            ['alamat', 'string', 'max' => 255, 'message' => 'Alamat maksimal 255 karakter.'],
            ['contact', 'string', 'max' => 255, 'message' => 'Contact maksimal 255 karakter.'],
            ['jabatan', 'string', 'max' => 255, 'message' => 'Jabatan maksimal 255 karakter.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->kd_user = $this->kd_user;
        $user->kd_peran = $this->kd_peran;
        $user->kd_pemda = 1;
        $user->nama = $this->nama;
        $user->alamat = $this->alamat;
        $user->contact = $this->contact;
        $user->jabatan = $this->jabatan;
        
        return $user->save() ? $user : null;
    }
}
