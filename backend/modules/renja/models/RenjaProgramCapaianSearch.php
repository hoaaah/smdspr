<?php

namespace backend\modules\renja\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RenjaProgramCapaian;

/**
 * RenjaProgramCapaianSearch represents the model behind the search form about `\common\models\RenjaProgramCapaian`.
 */
class RenjaProgramCapaianSearch extends RenjaProgramCapaian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'urusan_id', 'bidang_id', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog', 'no_indikator', 'kd_indikator_2', 'kd_indikator_3', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased'], 'integer'],
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
        $query = RenjaProgramCapaian::find();

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
            'kd_urusan' => $this->kd_urusan,
            'kd_bidang' => $this->kd_bidang,
            'kd_unit' => $this->kd_unit,
            'kd_sub' => $this->kd_sub,
            'no_skpdMisi' => $this->no_skpdMisi,
            'no_skpdTujuan' => $this->no_skpdTujuan,
            'no_skpdSasaran' => $this->no_skpdSasaran,
            'no_renjaSas' => $this->no_renjaSas,
            'no_renjaProg' => $this->no_renjaProg,
            'id_renprog' => $this->id_renprog,
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
