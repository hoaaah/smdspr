<?php

namespace backend\modules\rpjmd\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaPeriode;

/**
 * TaPeriodeSearch represents the model behind the search form about `common\models\TaPeriode`.
 */
class TaPeriodeSearch extends TaPeriode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Tahun1', 'Tahun2', 'Tahun3', 'Tahun4', 'Tahun5', 'Aktive'], 'integer'],
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
        $query = TaPeriode::find();

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

        IF($this->Tahun1){
            $this->Tahun2 = $this->Tahun3 = $this->Tahun4 = $this->Tahun5 = $this->Tahun1;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID_Tahun' => $this->ID_Tahun,
            'Kd_Prov' => $this->Kd_Prov,
            'Kd_Kab_Kota' => $this->Kd_Kab_Kota,
            'Aktive' => $this->Aktive,
        ]);

        $query->andFilterWhere(['or',
            ['Tahun1' =>$this->Tahun1],
            ['Tahun2' =>$this->Tahun2],
            ['Tahun3' =>$this->Tahun3],
            ['Tahun4' =>$this->Tahun4],
            ['Tahun5' =>$this->Tahun5],
            ]);


        return $dataProvider;
    }
}
