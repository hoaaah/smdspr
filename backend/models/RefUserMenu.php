<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_user_menu".
 *
 * @property integer $menu
 * @property integer $kd_user
 */
class RefUserMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_user_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu', 'kd_user'], 'integer'],
            [['kd_user', 'menu'], 'unique', 'targetAttribute' => ['kd_user', 'menu'], 'message' => 'The combination of Menu and Kd User has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'menu' => 'Menu',
            'kd_user' => 'Kd User',
        ];
    }
}
