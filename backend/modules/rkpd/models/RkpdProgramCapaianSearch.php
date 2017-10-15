<?php

namespace backend\modules\rkpd\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RkpdProgramCapaian;

/**
 * RkpdProgramCapaianSearch represents the model behind the search form about `common\models\RkpdProgramCapaian`.
 */
class RkpdProgramCapaianSearch extends RkpdProgramCapaian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rkpd_program_id', 'urusan_id', 'bidang_id', 'no_misi', 'no_tujuan', 'no_sasaran', 'kd_progrkpd', 'id_progrkpd', 'no_indikator', 'kd_indikator_2', 'kd_indikator_3', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased'], 'integer'],
            [['tahun', 'tolok_ukur', 'target_uraian', 'keterangan', 'uraian'], 'safe'],
            [['target_angka'], 'number'],
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
        $query = RkpdProgramCapaian::find();

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
            'rkpd_program_id' => $this->rkpd_program_id,
            'tahun' => $this->tahun,
            'urusan_id' => $this->urusan_id,
            'bidang_id' => $this->bidang_id,
            'no_misi' => $this->no_misi,
            'no_tujuan' => $this->no_tujuan,
            'no_sasaran' => $this->no_sasaran,
            'kd_progrkpd' => $this->kd_progrkpd,
            'id_progrkpd' => $this->id_progrkpd,
            'no_indikator' => $this->no_indikator,
            'target_angka' => $this->target_angka,
            'kd_indikator_2' => $this->kd_indikator_2,
            'kd_indikator_3' => $this->kd_indikator_3,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'input_phased' => $this->input_phased,
            'status' => $this->status,
            'status_phased' => $this->status_phased,
        ]);

        $query->andFilterWhere(['like', 'tolok_ukur', $this->tolok_ukur])
            ->andFilterWhere(['like', 'target_uraian', $this->target_uraian])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'uraian', $this->uraian]);

        return $dataProvider;
    }
}
