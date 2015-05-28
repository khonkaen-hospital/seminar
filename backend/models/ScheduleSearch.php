<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Schedule;

/**
 * ScheduleSearch represents the model behind the search form about `backend\models\Schedule`.
 */
class ScheduleSearch extends Schedule
{
    public $q;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'room_id', 'create_time', 'update_time'], 'integer'],
            [['start_date', 'end_date', 'topic', 'detail', 'status', 'type','q'], 'safe'],
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
        $query = Schedule::find();

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
            'room_id' => $this->room_id,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->orFilterWhere(['like', 'topic', $this->q])
            ->orFilterWhere(['like', 'detail', $this->q])
            ->orFilterWhere(['like', 'status', $this->q])
            ->orFilterWhere(['like', 'type', $this->type]);

        //$query->orFilterWhere(['like', 'patient.name', $this->q])

        return $dataProvider;
    }
}
