<?php

namespace backend\modules\musrenbangrkpd\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
//use common\models\RenjaProgram;
//use common\models\RenjaKegiatan;

/**
 * RenjaProgramSearch represents the model behind the search form about `common\models\RenjaProgram`.
 */
class MusrenbangrkpdSearch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $kd_skpd;
    public $kd_urusan;
    public $kd_bidang;
    public $kd_sub;
    public $kd_unit;
    public $input_phased;
    public $status;
    public $status_phased;
    public $kd_bahas;



    public function rules()
    {
        return [
            [['kd_skpd', 'kd_urusan', 'kd_bidang', 'kd_unit','kd_sub', 'input_phased', 'status', 'status_phased', 'kd_bahas'], 'string'],
            [['kd_urusan', 'kd_bidang', 'kd_unit', 'kd_sub', 'input_phased', 'status', 'status_phased', 'kd_bahas'], 'safe'],
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

    /*
    public function search($params)
    {



        $query = RenjaProgram::find();
        // add conditions that should always apply here
        $query->andWhere([
                'tahun' => date('Y')+1,
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        //dari form search explode dropdown value ----@hoaaah
        IF(isset($this->kd_sub) && !empty($this->kd_sub)){
            list($this->kd_urusan, $this->kd_bidang, $this->kd_unit, $this->kd_sub) = explode('.', $this->kd_sub);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'tahun' => date('Y')+1, //Ini masih dipertimbangkan untuk diganti dengan soft coding atau menggunakan modelSearch khusus di module
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'input_phased' => $this->input_phased,
            'status' => $this->status,
            'status_phased' => $this->status_phased,
        ]);

        $query->andFilterWhere(['like', 'uraian', $this->uraian]);

        return $dataProvider;
    }
    */
}
