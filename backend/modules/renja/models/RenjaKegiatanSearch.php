<?php

namespace backend\modules\renja\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RenjaKegiatan;

/**
 * RenjaKegiatanSearch represents the model behind the search form about `common\models\RenjaKegiatan`.
 */
class RenjaKegiatanSearch extends RenjaKegiatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog', 'id_renkeg', 'kd_asb', 'kd_bahas', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased'], 'integer'],
            [['tahun', 'uraian', 'lokasi', 'lokasi_maps', 'kelompok_sasaran', 'status_kegiatan', 'info_asb'], 'safe'],
            [['pagu_kegiatan', 'pagu_musrenbang'], 'number'],
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
        $query = RenjaKegiatan::find();

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
            'id_renkeg' => $this->id_renkeg,
            'pagu_kegiatan' => $this->pagu_kegiatan,
            'pagu_musrenbang' => $this->pagu_musrenbang,
            'kd_asb' => $this->kd_asb,
            'kd_bahas' => $this->kd_bahas,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'input_phased' => $this->input_phased,
            'status' => $this->status,
            'status_phased' => $this->status_phased,
        ]);

        $query->andFilterWhere(['like', 'uraian', $this->uraian])
            ->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'lokasi_maps', $this->lokasi_maps])
            ->andFilterWhere(['like', 'kelompok_sasaran', $this->kelompok_sasaran])
            ->andFilterWhere(['like', 'status_kegiatan', $this->status_kegiatan])
            ->andFilterWhere(['like', 'info_asb', $this->info_asb]);

        return $dataProvider;
    }
}
