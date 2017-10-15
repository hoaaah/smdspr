<?php

namespace backend\modules\forumskpd\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Subkegiatan;

/**
 * SubkegiatanSearch represents the model behind the search form about `common\models\Subkegiatan`.
 */
class SubkegiatanSearchprosesforum extends Subkegiatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tahun', 'kd_kecamatan', 'kd_kelurahan', 'rw', 'rt', 'kd_asb', 'input_phased', 'status_phased', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['renja_kegiatan_id', 'input_status'], 'string'],
            [['uraian', 'renja_kegiatan_id', 'lokasi', 'satuan', 'keterangan'], 'safe'],
            [['volume', 'harga_satuan', 'biaya'], 'number'],
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
        $query = Subkegiatan::find()->from($this->tableName().' a');
        $query->joinWith('renjaKegiatan b');
        $query->joinWith('inputStatus c');
        //$query->joinWith('sub d');

        // add conditions that should always apply here
        $query->where('a.tahun='.(DATE('Y')+1));
        $query->andWhere('b.kd_urusan=:kd_urusan AND b.kd_bidang=:kd_bidang AND b.kd_unit=:kd_unit AND b.kd_sub=:kd_sub', [
                ':kd_urusan' => Yii::$app->user->identity->tperan->kd_urusan,
                ':kd_bidang' => Yii::$app->user->identity->tperan->kd_bidang,
                ':kd_unit' => Yii::$app->user->identity->tperan->kd_unit,
                ':kd_sub' => Yii::$app->user->identity->tperan->kd_sub,
            ]);
        $query->andWhere('a.status_phased = 5');
        $query->andWhere('a.input_status = 2');
        $query->andWhere('a.skpd = 1');


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
            'kd_kecamatan' => $this->kd_kecamatan,
            'kd_kelurahan' => $this->kd_kelurahan,
            'rw' => $this->rw,
            'rt' => $this->rt,
            'volume' => $this->volume,
            'harga_satuan' => $this->harga_satuan,
            'biaya' => $this->biaya,
            'kd_asb' => $this->kd_asb,
            'input_phased' => $this->input_phased,
            'status_phased' => $this->status_phased,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'a.uraian', $this->uraian])
            ->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'satuan', $this->satuan])
            ->andFilterWhere(['like', 'b.uraian', $this->renja_kegiatan_id])
            ->andFilterWhere(['like', 'c.keterangan', $this->input_status])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);
        return $dataProvider;
    }
}
