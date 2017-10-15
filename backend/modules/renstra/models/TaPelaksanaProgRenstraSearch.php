<?php

namespace backend\modules\renstra\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaPelaksanaProgRenstra;

/**
 * TaPelaksanaProgRenstraSearch represents the model behind the search form about `common\models\TaPelaksanaProgRenstra`.
 */
class TaPelaksanaProgRenstraSearch extends TaPelaksanaProgRenstra
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog', 'Kd_Urusan1', 'Kd_Bidang1'], 'integer'],
            [['Nm_Sub'], 'safe'],
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
        $query = TaPelaksanaProgRenstra::find();

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
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'No_Misi' => $this->No_Misi,
            'No_Tujuan' => $this->No_Tujuan,
            'No_Sasaran' => $this->No_Sasaran,
            'Kd_Prog' => $this->Kd_Prog,
            'ID_Prog' => $this->ID_Prog,
            'Kd_Urusan1' => $this->Kd_Urusan1,
            'Kd_Bidang1' => $this->Kd_Bidang1,
        ]);

        $query->andFilterWhere(['like', 'Nm_Sub', $this->Nm_Sub]);

        return $dataProvider;
    }
}
