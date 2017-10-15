<?php

namespace backend\modules\forumskpd\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Subkegiatan;

/**
 * SubkegiatanSearch represents the model behind the search form about `common\models\Subkegiatan`.
 */
class SubkegiatanSearch extends Subkegiatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'renja_kegiatan_id', 'kd_kecamatan', 'kd_kelurahan', 'rw', 'rt', 'kd_asb', 'input_phased', 'status_phased', 'input_status', 'created_at', 'updated_at', 'user_id', 'skpd'], 'integer'],
            [['uraian', 'lokasi', 'keterangan', 'skpd'], 'safe'],
            [['volume', 'biaya'], 'number'],
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
        $query = Subkegiatan::find()->from($this->tableName().' a');
        $query->joinWith('renjaKegiatan b');
        $query->joinWith('inputStatus c');
        //$query->joinWith('sub d');

        // add conditions that should always apply here
        $query->where('a.tahun='.(DATE('Y')+1));
        
        $query->andWhere('b.kd_urusan=:kd_urusan AND b.kd_bidang =:kd_bidang AND b.kd_unit =:kd_unit AND b.kd_sub =:kd_sub', [':kd_urusan' => Yii::$app->user->identity->tperan->kd_urusan, ':kd_bidang' => Yii::$app->user->identity->tperan->kd_bidang, ':kd_unit' => Yii::$app->user->identity->tperan->kd_unit, ':kd_sub' => Yii::$app->user->identity->tperan->kd_sub]);
        $query->andWhere('a.status_phased=5');

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
            'a.id' => $this->id,
            'a.renja_kegiatan_id' => $this->renja_kegiatan_id,
            'a.kd_kecamatan' => $this->kd_kecamatan,
            'a.kd_kelurahan' => $this->kd_kelurahan,
            'a.rw' => $this->rw,
            'a.rt' => $this->rt,
            'a.volume' => $this->volume,
            'a.biaya' => $this->biaya,
            'a.kd_asb' => $this->kd_asb,
            'a.input_phased' => $this->input_phased,
            'a.status_phased' => $this->status_phased,
            'a.input_status' => $this->input_status,
            'a.created_at' => $this->created_at,
            'a.updated_at' => $this->updated_at,
            'a.user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'a.uraian', $this->uraian])
            ->andFilterWhere(['like', 'a.lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'a.keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
