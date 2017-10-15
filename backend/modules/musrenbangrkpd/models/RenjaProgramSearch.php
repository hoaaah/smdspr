<?php

namespace backend\modules\musrenbangrkpd\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RenjaProgram;

/**
 * RenjaProgramSearch represents the model behind the search form about `common\models\RenjaProgram`.
 */
class RenjaProgramSearch extends RenjaProgram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'urusan_id', 'bidang_id', 'kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'no_skpdMisi', 'no_skpdTujuan', 'no_skpdSasaran', 'no_renjaSas', 'no_renjaProg', 'id_renprog', 'created_at', 'updated_at', 'user_id', 'input_phased', 'status', 'status_phased', 'rkpd_program_id', 'id_tahun', 'Kd_Perubahan_Renstra', 'Kd_Dokumen_Renstra', 'Kd_Usulan_Renstra', 'Kd_Urusan_Renstra', 'Kd_Bidang_Renstra', 'Kd_Unit_Renstra', 'No_Misi_Renstra', 'No_Tujuan_Renstra', 'No_Sasaran_Renstra', 'Kd_Prog_Renstra', 'ID_Prog_Renstra'], 'integer'],
            [['tahun', 'uraian'], 'safe'],
            [['pagu_program'], 'number'],
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
        $query = RenjaProgram::find()->from($this->tableName().' a');
        $query->joinWith('renstra b');
        $query->joinWith('renstra.rpjmdProgram c');        

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
            'a.id' => $this->id,
            'a.tahun' => $this->tahun,
            'a.urusan_id' => $this->urusan_id,
            'a.bidang_id' => $this->bidang_id,
            'a.kd_urusan' => $this->kd_urusan,
            'a.kd_bidang' => $this->kd_bidang,
            'a.kd_unit' => $this->kd_unit,
            'a.kd_sub' => $this->kd_sub,
            'a.no_skpdMisi' => $this->no_skpdMisi,
            'a.no_skpdTujuan' => $this->no_skpdTujuan,
            'a.no_skpdSasaran' => $this->no_skpdSasaran,
            'a.no_renjaSas' => $this->no_renjaSas,
            'a.no_renjaProg' => $this->no_renjaProg,
            'a.id_renprog' => $this->id_renprog,
            'a.pagu_program' => $this->pagu_program,
            'a.created_at' => $this->created_at,
            'a.updated_at' => $this->updated_at,
            'a.user_id' => $this->user_id,
            'a.input_phased' => $this->input_phased,
            'a.status' => $this->status,
            'a.status_phased' => $this->status_phased,
            'a.rkpd_program_id' => $this->rkpd_program_id,
            'a.id_tahun' => $this->id_tahun,
            'a.Kd_Perubahan_Renstra' => $this->Kd_Perubahan_Renstra,
            'a.Kd_Dokumen_Renstra' => $this->Kd_Dokumen_Renstra,
            'a.Kd_Usulan_Renstra' => $this->Kd_Usulan_Renstra,
            'a.Kd_Urusan_Renstra' => $this->Kd_Urusan_Renstra,
            'a.Kd_Bidang_Renstra' => $this->Kd_Bidang_Renstra,
            'a.Kd_Unit_Renstra' => $this->Kd_Unit_Renstra,
            'a.No_Misi_Renstra' => $this->No_Misi_Renstra,
            'a.No_Tujuan_Renstra' => $this->No_Tujuan_Renstra,
            'a.No_Sasaran_Renstra' => $this->No_Sasaran_Renstra,
            'a.Kd_Prog_Renstra' => $this->Kd_Prog_Renstra,
            'a.ID_Prog_Renstra' => $this->ID_Prog_Renstra,
        ]);

        $query->andFilterWhere(['like', 'a.uraian', $this->uraian]);

        return $dataProvider;
    }
}
