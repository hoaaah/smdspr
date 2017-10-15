<?php

namespace backend\modules\renstra\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaIndikatorProgRenstra;

/**
 * TaIndikatorProgRenstraSearch represents the model behind the search form about `common\models\TaIndikatorProgRenstra`.
 */
class TaIndikatorProgRenstraSearch extends TaIndikatorProgRenstra
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_Tahun', 'Kd_Prov', 'Kd_Kab_Kota', 'Kd_Perubahan', 'Kd_Dokumen', 'Kd_Usulan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Kd_Prog', 'ID_Prog', 'No_Ind_Prog', 'Jn_Indikator', 'Jn_Indikator2'], 'integer'],
            [['Tolak_Ukur', 'Target_Uraian', 'Kondisi_Kinerja_Awal', 'Satuan', 'Keterangan'], 'safe'],
            [['NilaiTahun1', 'NilaiTahun2', 'NilaiTahun3', 'NilaiTahun4', 'NilaiTahun5'], 'number'],
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
        $query = TaIndikatorProgRenstra::find();

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
            'No_Ind_Prog' => $this->No_Ind_Prog,
            'Jn_Indikator' => $this->Jn_Indikator,
            'Jn_Indikator2' => $this->Jn_Indikator2,
            'NilaiTahun1' => $this->NilaiTahun1,
            'NilaiTahun2' => $this->NilaiTahun2,
            'NilaiTahun3' => $this->NilaiTahun3,
            'NilaiTahun4' => $this->NilaiTahun4,
            'NilaiTahun5' => $this->NilaiTahun5,
        ]);

        $query->andFilterWhere(['like', 'Tolak_Ukur', $this->Tolak_Ukur])
            ->andFilterWhere(['like', 'Target_Uraian', $this->Target_Uraian])
            ->andFilterWhere(['like', 'Kondisi_Kinerja_Awal', $this->Kondisi_Kinerja_Awal])
            ->andFilterWhere(['like', 'Satuan', $this->Satuan])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
