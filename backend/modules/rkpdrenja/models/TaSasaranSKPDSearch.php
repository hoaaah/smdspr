<?php

namespace backend\modules\rkpdrenja\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaSasaranSKPD;

/**
 * TaSasaranSKPDSearch represents the model behind the search form about `common\models\TaSasaranSKPD`.
 */
class TaSasaranSKPDSearch extends TaSasaranSKPD
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'No_Misi1', 'No_Tujuan1', 'No_Sasaran1'], 'integer'],
            [['Ur_Sasaran'], 'safe'],
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
        $query = TaSasaranSKPD::find();

        // add conditions that should always apply here

        IF(isset(Yii::$app->user->identity->tperan->kd_urusan)) {
            $query->andWhere(['Kd_Urusan' => Yii::$app->user->identity->tperan->kd_urusan]);
            $query->andWhere(['Kd_Bidang' => Yii::$app->user->identity->tperan->kd_bidang]);
            $query->andWhere(['Kd_Unit' => Yii::$app->user->identity->tperan->kd_unit]);
            //$query->andWhere(['Kd_Sub' => Yii::$app->user->identity->tperan->kd_sub]);
        }         

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
            'No_Tujuan' => $this->No_Tujuan,
            'No_Sasaran' => $this->No_Sasaran,
            'No_Misi1' => $this->No_Misi1,
            'No_Tujuan1' => $this->No_Tujuan1,
            'No_Sasaran1' => $this->No_Sasaran1,
        ]);

        $query->andFilterWhere(['like', 'Ur_Sasaran', $this->Ur_Sasaran]);

        return $dataProvider;
    }
}
