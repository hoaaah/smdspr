<?php

namespace backend\modules\musrenbangdesa\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Proses;

/**
 * ProsesSearch represents the model behind the search form about `common\models\Proses`.
 */
class ProsesSearch extends Proses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'kd_kecamatan', 'kd_kelurahan', 'rw', 'rt', 'input_phased', 'status', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['tahun', 'no_ba', 'tanggal_ba', 'penandatangan', 'nip_penandatangan', 'jabatan_penandatangan'], 'safe'],
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
        $query = Proses::find()->from($this->tableName().' a');
        $query->joinWith('kelurahan b');        

        // add conditions that should always apply here
        IF(isset(Yii::$app->user->identity->tperan->kd_kelurahan)) {
            $query->andWhere('a.kd_kelurahan=:kd_kelurahan', [':kd_kelurahan' => Yii::$app->user->identity->tperan->kd_kelurahan]);
        }
        $query->andWhere('a.input_phased = 3');

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
            //'kd_urusan' => $this->kd_urusan,
            //'kd_bidang' => $this->kd_bidang,
            //'kd_unit' => $this->kd_unit,
            //'kd_sub' => $this->kd_sub,
            //'kd_kecamatan' => $this->kd_kecamatan,
            //'a.kd_kelurahan' => $this->kd_kelurahan,
            'rw' => $this->rw,
            'rt' => $this->rt,
            'tanggal_ba' => $this->tanggal_ba,
            'input_phased' => $this->input_phased,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'no_ba', $this->no_ba])
            ->andFilterWhere(['like', 'penandatangan', $this->penandatangan])
            ->andFilterWhere(['like', 'nip_penandatangan', $this->nip_penandatangan])
            ->andFilterWhere(['like', 'jabatan_penandatangan', $this->jabatan_penandatangan]);

        return $dataProvider;
    }
}
