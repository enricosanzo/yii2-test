<?php

namespace app\models\search;

use app\models\Customer;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Practice;

/**
 * PracticeSearch represents the model behind the search form of `app\models\Practice`.
 */
class PracticeSearch extends Practice
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_id'], 'integer'],
            [['fiscal_code', 'practice_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Practice::find();

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
        $query->where([
            'practice_id' => $this->practice_id])
            ->innerJoinWith(['customer'])
            ->orWhere(['fiscal_code' => $this->fiscal_code]);

        return $dataProvider;
    }
}
