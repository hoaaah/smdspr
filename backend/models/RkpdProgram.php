<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_rkpd_program".
 *
 * @property integer $id
 * @property string $tahun
 * @property integer $urusan_id
 * @property integer $bidang_id
 * @property integer $no_misi
 * @property integer $no_tujuan
 * @property integer $no_sasaran
 * @property integer $id_sasrkpd
 * @property integer $id_progrkpd
 * @property string $uraian
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 * @property integer $input_phased
 * @property integer $status
 * @property integer $status_phased
 * @property integer $id_tahun
 * @property integer $no_misi_rpjmd
 * @property integer $no_tujuan_rpjmd
 * @property integer $no_sasaran_rpjmd
 * @property integer $kd_prog_rpjmd
 * @property integer $id_prog_rpjmd
 */
class RkpdProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_rkpd_program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun'], 'safe'],
            [['urusan_id', 'bidang_id', 'no_misi', 'no_tujuan', 'no_sasaran', 'id_sasrkpd', 'id_progrkpd', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased', 'id_tahun', 'no_misi_rpjmd', 'no_tujuan_rpjmd', 'no_sasaran_rpjmd', 'kd_prog_rpjmd', 'id_prog_rpjmd'], 'integer'],
            [['uraian'], 'string', 'max' => 255],
            [['tahun', 'urusan_id', 'bidang_id', 'no_misi', 'no_tujuan', 'no_sasaran', 'id_sasrkpd', 'id_progrkpd'], 'unique', 'targetAttribute' => ['tahun', 'urusan_id', 'bidang_id', 'no_misi', 'no_tujuan', 'no_sasaran', 'id_sasrkpd', 'id_progrkpd'], 'message' => 'The combination of Tahun, Urusan ID, Bidang ID, No Misi, No Tujuan, No Sasaran, Id Sasrkpd and Id Progrkpd has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun' => 'Tahun',
            'urusan_id' => 'Urusan ID',
            'bidang_id' => 'Bidang ID',
            'no_misi' => 'No Misi',
            'no_tujuan' => 'No Tujuan',
            'no_sasaran' => 'No Sasaran',
            'id_sasrkpd' => 'Id Sasrkpd',
            'id_progrkpd' => 'Id Progrkpd',
            'uraian' => 'Uraian',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'input_phased' => 'Input Phased',
            'status' => 'Status',
            'status_phased' => 'Status Phased',
            'id_tahun' => 'Id Tahun',
            'no_misi_rpjmd' => 'No Misi Rpjmd',
            'no_tujuan_rpjmd' => 'No Tujuan Rpjmd',
            'no_sasaran_rpjmd' => 'No Sasaran Rpjmd',
            'kd_prog_rpjmd' => 'Kd Prog Rpjmd',
            'id_prog_rpjmd' => 'Id Prog Rpjmd',
        ];
    }
}
