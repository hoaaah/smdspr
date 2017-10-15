<?php

namespace backend\modules\renja\models;

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
        $query = RenjaProgram::find();

        // add conditions that should always apply here

        IF(isset(Yii::$app->user->identity->tperan->kd_urusan)) {
            $query->andWhere(['kd_urusan' => Yii::$app->user->identity->tperan->kd_urusan]);
            $query->andWhere(['kd_bidang' => Yii::$app->user->identity->tperan->kd_bidang]);
            $query->andWhere(['kd_unit' => Yii::$app->user->identity->tperan->kd_unit]);
            $query->andWhere(['kd_sub' => Yii::$app->user->identity->tperan->kd_sub]);
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
            'id' => $this->id,
            'tahun' => $this->tahun,
            'urusan_id' => $this->urusan_id,
            'bidang_id' => $this->bidang_id,
            'kd_urusan' => $this->kd_urusan,
            'kd_bidang' => $this->kd_bidang,
            'kd_unit' => $this->kd_unit,
            'kd_sub' => $this->kd_sub,
            'no_skpdMisi' => $this->no_skpdMisi,
            'no_skpdTujuan' => $this->no_skpdTujuan,
            'no_skpdSasaran' => $this->no_skpdSasaran,
            'no_renjaSas' => $this->no_renjaSas,
            'no_renjaProg' => $this->no_renjaProg,
            'id_renprog' => $this->id_renprog,
            'pagu_program' => $this->pagu_program,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'input_phased' => $this->input_phased,
            'status' => $this->status,
            'status_phased' => $this->status_phased,
            'rkpd_program_id' => $this->rkpd_program_id,
            'id_tahun' => $this->id_tahun,
            'Kd_Perubahan_Renstra' => $this->Kd_Perubahan_Renstra,
            'Kd_Dokumen_Renstra' => $this->Kd_Dokumen_Renstra,
            'Kd_Usulan_Renstra' => $this->Kd_Usulan_Renstra,
            'Kd_Urusan_Renstra' => $this->Kd_Urusan_Renstra,
            'Kd_Bidang_Renstra' => $this->Kd_Bidang_Renstra,
            'Kd_Unit_Renstra' => $this->Kd_Unit_Renstra,
            'No_Misi_Renstra' => $this->No_Misi_Renstra,
            'No_Tujuan_Renstra' => $this->No_Tujuan_Renstra,
            'No_Sasaran_Renstra' => $this->No_Sasaran_Renstra,
            'Kd_Prog_Renstra' => $this->Kd_Prog_Renstra,
            'ID_Prog_Renstra' => $this->ID_Prog_Renstra,
        ]);

        $query->andFilterWhere(['like', 'uraian', $this->uraian]);

        return $dataProvider;
    }
}
