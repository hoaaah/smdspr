<?php

namespace backend\modules\parameter\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Desa;

/**
 * DesaSearch represents the model behind the search form about `common\models\Desa`.
 */
class DesaSearch extends Desa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kecamatan_id'], 'integer'],
            [['desa'], 'safe'],
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
        $query = Desa::find();

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
            'kecamatan_id' => $this->kecamatan_id,
        ]);

        $query->andFilterWhere(['like', 'desa', $this->desa]);

        return $dataProvider;
    }
}
