<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Seminar;

/**
 * SeminarSearch represents the model behind the search form about `backend\models\Seminar`.
 */
class SeminarSearch extends Seminar
{
    public $q;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'open', 'open_auto', 'status', 'register_limit', 'user_id'], 'integer'],
            [['title', 'description', 'venue', 'start_date', 'end_date', 'poster', 'logo', 'open_registration', 'close_registration', 'create_date', 'update_date', 'payment_detail', 'contact', 'ref', 'active'], 'safe'],
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
        $query = Seminar::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'open_registration' => $this->open_registration,
            'close_registration' => $this->close_registration,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
            'open' => $this->open,
            'open_auto' => $this->open_auto,
            'status' => $this->status,
            'register_limit' => $this->register_limit,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'venue', $this->venue])
            ->andFilterWhere(['like', 'poster', $this->poster])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'payment_detail', $this->payment_detail])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'active', $this->active]);

        //$query->orFilterWhere(['like', 'patient.name', $this->q])

        return $dataProvider;
    }
}
