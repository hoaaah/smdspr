<?php

namespace backend\modules\parameter\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaPemdaUmum;

/* (C) Copyright 2017 Heru Arief Wijaya (http://belajararief.com/) untuk Indonesia.*/
/**
 * TaPemdaUmumSearch represents the model behind the search form about `common\models\TaPemdaUmum`.
 */
class TaPemdaUmumSearch extends TaPemdaUmum
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'Kd_Prov'], 'integer'],
            [['Kd_Kab_Kota', 'Ur_Visi', 'Nm_Provinsi', 'Nm_Pemda', 'Nm_PimpDaerah', 'Jab_PimpDaerah', 'Nm_Sekda', 'Nip_Sekda', 'Jbt_Sekda', 'Ibukota', 'Alamat', 'created_at'], 'safe'],
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
        $query = TaPemdaUmum::find();

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
            'ID' => $this->ID,
            'Kd_Prov' => $this->Kd_Prov,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'Kd_Kab_Kota', $this->Kd_Kab_Kota])
            ->andFilterWhere(['like', 'Ur_Visi', $this->Ur_Visi])
            ->andFilterWhere(['like', 'Nm_Provinsi', $this->Nm_Provinsi])
            ->andFilterWhere(['like', 'Nm_Pemda', $this->Nm_Pemda])
            ->andFilterWhere(['like', 'Nm_PimpDaerah', $this->Nm_PimpDaerah])
            ->andFilterWhere(['like', 'Jab_PimpDaerah', $this->Jab_PimpDaerah])
            ->andFilterWhere(['like', 'Nm_Sekda', $this->Nm_Sekda])
            ->andFilterWhere(['like', 'Nip_Sekda', $this->Nip_Sekda])
            ->andFilterWhere(['like', 'Jbt_Sekda', $this->Jbt_Sekda])
            ->andFilterWhere(['like', 'Ibukota', $this->Ibukota])
            ->andFilterWhere(['like', 'Alamat', $this->Alamat]);

        return $dataProvider;
    }
}
