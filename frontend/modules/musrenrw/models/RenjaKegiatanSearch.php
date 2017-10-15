<?php

namespace frontend\modules\musrenrw\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RenjaKegiatan;

/**
 * RenjaKegiatanSearchf represents the model behind the search form about `common\models\RenjaKegiatan`.
 */
class RenjaKegiatanSearch extends RenjaKegiatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kd_urusan', 'kd_bidang', 'kd_unit', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog', 'id_renkeg', 'kd_bahas', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased'], 'integer'],
            [['kd_sub'], 'string'],
            [['tahun', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'uraian', 'lokasi', 'lokasi_maps', 'kelompok_sasaran', 'status_kegiatan'], 'safe'],
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
        $query = RenjaKegiatan::find()->from($this->tableName().' a');
        $query->joinWith('program b');
        $query->joinWith('sub c');

        // add conditions that should always apply here
        $query->andWhere([
                // 'a.tahun' => date('Y')+1,
                'kd_bahas'=> 1,
            ]);        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

 //       $query->joinWith('sub');
        //dari form search explode dropdown value ----@hoaaah
        IF(isset($this->id_renprog)){
            list($this->kd_urusan, $this->kd_bidang, $this->kd_unit, $this->kd_sub, $this->id_renprog) = explode('.', $this->id_renprog);
        }
        IF(isset($this->kd_sub) && !empty($this->kd_sub)){
            list($this->kd_urusan, $this->kd_bidang, $this->kd_unit, $this->kd_sub) = explode('.', $this->kd_sub);
        }        
        // grid filtering conditions
        $query->andFilterWhere([
            'a.id' => $this->id,
            'a.tahun' => $this->tahun,
            'a.kd_urusan' => $this->kd_urusan,
            'a.kd_bidang' => $this->kd_bidang,
            'a.kd_unit' => $this->kd_unit,
            'a.kd_sub' => $this->kd_sub,
            'a.no_skpdMisi' => $this->no_skpdMisi,
            'a.no_skpdTujuan' => $this->no_skpdTujuan,
            'a.no_skpdSasaran' => $this->no_skpdSasaran,
            'a.no_renjaSas' => $this->no_renjaSas,
            'a.no_renjaProg' => $this->no_renjaProg,
            'a.id_renprog' => $this->id_renprog,
            'a.a.id_renkeg' => $this->id_renkeg,
            'a.pagu_kegiatan' => $this->pagu_kegiatan,
            'a.pagu_musrenbang' => $this->pagu_musrenbang,
            'a.kd_bahas' => $this->kd_bahas,
            'a.created_at' => $this->created_at,
            'a.updated_at' => $this->updated_at,
            'a.user_id' => $this->user_id,
            'a.input_phased' => $this->input_phased,
            'a.status' => $this->status,
            'a.status_phased' => $this->status_phased,
        ]);

        $query->andFilterWhere(['like', 'a.uraian', $this->uraian])
            //->andFilterWhere(['like', 'sub.Nm_Sub_Unit', $this->kd_sub])
            ->andFilterWhere(['like', 'a.lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'a.lokasi_maps', $this->lokasi_maps])
            ->andFilterWhere(['like', 'a.kelompok_sasaran', $this->kelompok_sasaran])
            ->andFilterWhere(['like', 'a.status_kegiatan', $this->status_kegiatan]);

        return $dataProvider;
    }
}
