<?php

namespace backend\modules\rpjmdrenstra\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaMisiSKPD;

/**
 * MisiSearch represents the model behind the search form about `common\models\TaMisiSKPD`.
 */
class MisiSearch extends TaMisiSKPD
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Misi1'], 'integer'],
            [['Ur_Misi'], 'safe'],
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
        $query = TaMisiSKPD::find();

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
            'ID_Tahun' => $this->ID_Tahun,
            'Kd_Prov' => $this->Kd_Prov,
            'Kd_Kab_Kota' => $this->Kd_Kab_Kota,
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'No_Misi' => $this->No_Misi,
            'No_Misi1' => $this->No_Misi1,
        ]);

        $query->andFilterWhere(['like', 'Ur_Misi', $this->Ur_Misi]);

        return $dataProvider;
    }
}
