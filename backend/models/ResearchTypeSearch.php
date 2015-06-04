<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ResearchType;

/**
 * ResearchTypeSearch represents the model behind the search form about `backend\models\ResearchType`.
 */
class ResearchTypeSearch extends ResearchType
{
    public $q;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'status','seminar_id'], 'safe'],
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
        $query = ResearchType::find();

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
             'seminar_id' => $this->seminar_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->q])
            ->andFilterWhere(['like', 'status', $this->status]);

        //$query->orFilterWhere(['like', 'patient.name', $this->q])

        return $dataProvider;
    }
}
