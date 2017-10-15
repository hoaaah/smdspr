<?php

namespace backend\modules\rpjmd\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TRpjmdPrioritas;

/**
 * TRpjmdPrioritasSearch represents the model behind the search form about `common\models\TRpjmdPrioritas`.
 */
class TRpjmdPrioritasSearch extends TRpjmdPrioritas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ID_Tahun', 'Kd_Prioritas'], 'integer'],
            [['Uraian'], 'safe'],
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
        $query = TRpjmdPrioritas::find();

        // add conditions that should always apply here
        IF(Yii::$app->session->get('tahun') && $tahun = Yii::$app->session->get('tahun')){
            $ID_Tahun = \common\models\TaPeriode::find()->where([
                    'or',
                    ['Tahun1' => $tahun],
                    ['Tahun2' => $tahun],
                    ['Tahun3' => $tahun],
                    ['Tahun4' => $tahun],
                    ['Tahun5' => $tahun],
                ])->one();
        }ELSE{
            $tahun = (DATE('Y')+1);
            $ID_Tahun = \common\models\TaPeriode::find()->where([
                    'or',
                    ['Tahun1' => $tahun],
                    ['Tahun2' => $tahun],
                    ['Tahun3' => $tahun],
                    ['Tahun4' => $tahun],
                    ['Tahun5' => $tahun],
                ])->one();
        }

        $query->andWhere(['ID_Tahun' => $ID_Tahun['ID_Tahun']]);

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
            'ID_Tahun' => $this->ID_Tahun,
            'Kd_Prioritas' => $this->Kd_Prioritas,
        ]);

        $query->andFilterWhere(['like', 'Uraian', $this->Uraian]);

        return $dataProvider;
    }
}
