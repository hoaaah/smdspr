<?php

namespace backend\modules\renstra\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Renstra;

/**
 * RenstraSearch represents the model behind the search form about `common\models\Renstra`.
 */
class RenstraSearch extends Renstra
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog', 'Kd_Urusan1', 'Kd_Bidang1', 'No_Misi1', 'No_Tujuan1', 'No_Sasaran1', 'Kd_Prog1', 'ID_Prog1'], 'integer'],
            [['Tgl_Perubahan', 'Nm_Prov', 'Nm_Kab', 'Nm_Urusan', 'Nm_Bidang', 'Nm_Unit', 'Ur_Misi', 'Ur_Tujuan', 'Ur_Sasaran', 'Ket_Program', 'Ur_Misi1', 'Ur_Tujuan1', 'Ur_Sasaran1', 'Ket_Program1'], 'safe'],
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
        $query = Renstra::find();

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
            'No_Misi' => $this->No_Misi,
            'No_Tujuan' => $this->No_Tujuan,
            'No_Sasaran' => $this->No_Sasaran,
            'Kd_Prog' => $this->Kd_Prog,
            'ID_Prog' => $this->ID_Prog,
            'Tgl_Perubahan' => $this->Tgl_Perubahan,
            'Kd_Urusan1' => $this->Kd_Urusan1,
            'Kd_Bidang1' => $this->Kd_Bidang1,
            'No_Misi1' => $this->No_Misi1,
            'No_Tujuan1' => $this->No_Tujuan1,
            'No_Sasaran1' => $this->No_Sasaran1,
            'Kd_Prog1' => $this->Kd_Prog1,
            'ID_Prog1' => $this->ID_Prog1,
        ]);

        $query->andFilterWhere(['like', 'Nm_Prov', $this->Nm_Prov])
            ->andFilterWhere(['like', 'Nm_Kab', $this->Nm_Kab])
            ->andFilterWhere(['like', 'Nm_Urusan', $this->Nm_Urusan])
            ->andFilterWhere(['like', 'Nm_Bidang', $this->Nm_Bidang])
            ->andFilterWhere(['like', 'Nm_Unit', $this->Nm_Unit])
            ->andFilterWhere(['like', 'Ur_Misi', $this->Ur_Misi])
            ->andFilterWhere(['like', 'Ur_Tujuan', $this->Ur_Tujuan])
            ->andFilterWhere(['like', 'Ur_Sasaran', $this->Ur_Sasaran])
            ->andFilterWhere(['like', 'Ket_Program', $this->Ket_Program])
            ->andFilterWhere(['like', 'Ur_Misi1', $this->Ur_Misi1])
            ->andFilterWhere(['like', 'Ur_Tujuan1', $this->Ur_Tujuan1])
            ->andFilterWhere(['like', 'Ur_Sasaran1', $this->Ur_Sasaran1])
            ->andFilterWhere(['like', 'Ket_Program1', $this->Ket_Program1]);

        return $dataProvider;
    }
}
