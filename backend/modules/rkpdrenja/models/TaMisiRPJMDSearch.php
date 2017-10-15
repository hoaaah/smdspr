<?php

namespace backend\modules\rkpdrenja\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaMisiRPJMD;

/**
 * TaMisiRPJMDSearch represents the model behind the search form about `common\models\TaMisiRPJMD`.
 */
class TaMisiRPJMDSearch extends TaMisiRPJMD
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'No_Misi'], 'integer'],
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
        $query = TaMisiRPJMD::find();

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
            'Kd_Perubahan' => $this->Kd_Perubahan,
            'Kd_Dokumen' => $this->Kd_Dokumen,
            'Kd_Usulan' => $this->Kd_Usulan,
            'No_Misi' => $this->No_Misi,
        ]);

        $query->andFilterWhere(['like', 'Ur_Misi', $this->Ur_Misi]);

        return $dataProvider;
    }
}
