<?php

namespace backend\modules\rkpdrenja\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RkpdProgram;

/**
 * RkpdProgramSearch represents the model behind the search form about `common\models\RkpdProgram`.
 */
class RkpdProgramSearch extends RkpdProgram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'urusan_id', 'bidang_id', 'no_misi', 'no_tujuan', 'no_sasaran', 'kd_progrkpd', 'id_progrkpd', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased', 'id_tahun', 'Kd_Perubahan_Rpjmd', 'Kd_Dokumen_Rpjmd', 'Kd_Usulan_Rpjmd', 'No_Misi_Rpjmd', 'No_Tujuan_Rpjmd', 'No_Sasaran_Rpjmd', 'Kd_Prog_Rpjmd', 'ID_Prog_Rpjmd'], 'integer'],
            [['tahun', 'uraian'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RkpdProgram::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tahun' => $this->tahun,
            'urusan_id' => $this->urusan_id,
            'bidang_id' => $this->bidang_id,
            'no_misi' => $this->no_misi,
            'no_tujuan' => $this->no_tujuan,
            'no_sasaran' => $this->no_sasaran,
            'kd_progrkpd' => $this->kd_progrkpd,
            'id_progrkpd' => $this->id_progrkpd,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'input_phased' => $this->input_phased,
            'status' => $this->status,
            'status_phased' => $this->status_phased,
            'id_tahun' => $this->id_tahun,
            'Kd_Perubahan_Rpjmd' => $this->Kd_Perubahan_Rpjmd,
            'Kd_Dokumen_Rpjmd' => $this->Kd_Dokumen_Rpjmd,
            'Kd_Usulan_Rpjmd' => $this->Kd_Usulan_Rpjmd,
            'No_Misi_Rpjmd' => $this->No_Misi_Rpjmd,
            'No_Tujuan_Rpjmd' => $this->No_Tujuan_Rpjmd,
            'No_Sasaran_Rpjmd' => $this->No_Sasaran_Rpjmd,
            'Kd_Prog_Rpjmd' => $this->Kd_Prog_Rpjmd,
            'ID_Prog_Rpjmd' => $this->ID_Prog_Rpjmd,
        ]);

        $query->andFilterWhere(['like', 'uraian', $this->uraian]);

        return $dataProvider;
    }
}
