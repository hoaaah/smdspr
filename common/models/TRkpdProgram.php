<?php

namespace common\models;

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
 * @property integer $kd_progrkpd
 * @property integer $id_progrkpd
 * @property string $uraian
 * @property string $pagu_program
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $user_id
 * @property integer $input_phased
 * @property integer $status
 * @property integer $status_phased
 * @property integer $id_tahun
 * @property integer $Kd_Perubahan_Rpjmd
 * @property integer $Kd_Dokumen_Rpjmd
 * @property integer $Kd_Usulan_Rpjmd
 * @property integer $No_Misi_Rpjmd
 * @property integer $No_Tujuan_Rpjmd
 * @property integer $No_Sasaran_Rpjmd
 * @property integer $Kd_Prog_Rpjmd
 * @property integer $ID_Prog_Rpjmd
 */
class TRkpdProgram extends \yii\db\ActiveRecord
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
            [['urusan_id', 'bidang_id', 'no_misi', 'no_tujuan', 'no_sasaran', 'kd_progrkpd', 'id_progrkpd', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased', 'id_tahun', 'Kd_Perubahan_Rpjmd', 'Kd_Dokumen_Rpjmd', 'Kd_Usulan_Rpjmd', 'No_Misi_Rpjmd', 'No_Tujuan_Rpjmd', 'No_Sasaran_Rpjmd', 'Kd_Prog_Rpjmd', 'ID_Prog_Rpjmd'], 'integer'],
            [['pagu_program'], 'number'],
            [['uraian'], 'string', 'max' => 255],
            [['tahun', 'urusan_id', 'bidang_id', 'no_misi', 'no_tujuan', 'no_sasaran', 'kd_progrkpd', 'id_progrkpd'], 'unique', 'targetAttribute' => ['tahun', 'urusan_id', 'bidang_id', 'no_misi', 'no_tujuan', 'no_sasaran', 'kd_progrkpd', 'id_progrkpd'], 'message' => 'The combination of Tahun, Urusan ID, Bidang ID, No Misi, No Tujuan, No Sasaran, Kd Progrkpd and Id Progrkpd has already been taken.'],
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
            'kd_progrkpd' => 'Kd Progrkpd',
            'id_progrkpd' => 'Id Progrkpd',
            'uraian' => 'Uraian',
            'pagu_program' => 'Pagu Program',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'input_phased' => 'Input Phased',
            'status' => 'Status',
            'status_phased' => 'Status Phased',
            'id_tahun' => 'Id Tahun',
            'Kd_Perubahan_Rpjmd' => 'Kd  Perubahan  Rpjmd',
            'Kd_Dokumen_Rpjmd' => 'Kd  Dokumen  Rpjmd',
            'Kd_Usulan_Rpjmd' => 'Kd  Usulan  Rpjmd',
            'No_Misi_Rpjmd' => 'No  Misi  Rpjmd',
            'No_Tujuan_Rpjmd' => 'No  Tujuan  Rpjmd',
            'No_Sasaran_Rpjmd' => 'No  Sasaran  Rpjmd',
            'Kd_Prog_Rpjmd' => 'Kd  Prog  Rpjmd',
            'ID_Prog_Rpjmd' => 'Id  Prog  Rpjmd',
        ];
    }
}
