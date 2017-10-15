<?php

namespace backend\modules\renstra\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaMisiSKPD;

/**
 * TaMisiSKPDSearch represents the model behind the search form about `common\models\TaMisiSKPD`.
 */
class TaMisiSKPDSearch extends TaMisiSKPD
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
        IF(Yii::$app->session->get('tahun') && $tahun = Yii::$app->session->get('tahun')){
            $ID_Tahun = \common\models\TaPeriode::find()->where([
                    'or',
                    ['Tahun1' => $tahun],
                    ['Tahun2' => $tahun],
                    ['Tahun3' => $tahun],
                    ['Tahun4' => $tahun],
                    ['Tahun5' => $tahun],
                ])->select('ID_Tahun')->one();
            $query->where(['ID_Tahun' => $ID_Tahun['ID_Tahun']]);
        }ELSE{
            $tahun = (DATE('Y')+1);
            $ID_Tahun = \common\models\TaPeriode::find()->where([
                    'or',
                    ['Tahun1' => $tahun],
                    ['Tahun2' => $tahun],
                    ['Tahun3' => $tahun],
                    ['Tahun4' => $tahun],
                    ['Tahun5' => $tahun],
                ])->select('ID_Tahun')->one();
            $query->where(['ID_Tahun' => $ID_Tahun['ID_Tahun']]);
        }

        /*
        $tahun = DATE('Y');
        IF(Yii::$app->session->get('tahun')){
            $query->andWhere(['Tahun' => Yii::$app->session->get('tahun')]);
            $tahun = Yii::$app->session->get('tahun');
        } 
        */
        IF(Yii::$app->user->identity->tperan->kd_urusan){
            $query->andWhere('Kd_Urusan=:kd_urusan AND Kd_Bidang =:kd_bidang AND Kd_Unit =:kd_unit', [':kd_urusan' => Yii::$app->user->identity->tperan->kd_urusan, ':kd_bidang' => Yii::$app->user->identity->tperan->kd_bidang, ':kd_unit' => Yii::$app->user->identity->tperan->kd_unit]);
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
            'No_Misi1' => $this->No_Misi1,
        ]);

        $query->andFilterWhere(['like', 'Ur_Misi', $this->Ur_Misi]);

        return $dataProvider;
    }
}
