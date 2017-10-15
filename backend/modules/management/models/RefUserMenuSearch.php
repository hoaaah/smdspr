<?php

namespace backend\modules\management\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefUserMenu;

/**
 * RefUserMenuSearch represents the model behind the search form about `app\models\RefUserMenu`.
 */
class RefUserMenuSearch extends RefUserMenu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu', 'kd_user'], 'integer'],
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
        $query = RefUserMenu::find();

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
            'menu' => $this->menu,
            'kd_user' => $this->kd_user,
        ]);

        return $dataProvider;
    }
}
