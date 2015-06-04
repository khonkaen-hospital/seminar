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

    public $query = null;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'room_id', 'create_time', 'update_time'], 'integer'],
            [['start_date', 'end_date', 'topic', 'detail', 'status', 'type','q','seminar_id','startDate'], 'safe'],
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

    public function presentation()
    {
        $this->query = Schedule::find()->presentation();
        return $this;
    }

    public function schedule()
    {
        $this->query = Schedule::find()->schedule();
        return $this;
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
        $query = $this->query===null?Schedule::find()->schedule():$this->query;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>50
            ],
            'sort'=>[
                'defaultOrder'=>['startDate'=>SORT_ASC]
            ]
        ]);

         $dataProvider->sort->attributes['startDate'] = [
            'asc' => ['start_date' => SORT_ASC],
            'desc' => ['start_date' => SORT_DESC],
        ];

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
            'seminar_id' =>$this->seminar_id
        ]);

        $query->orFilterWhere(['like', 'topic', $this->q])
            ->orFilterWhere(['like', 'detail', $this->q])
            ->orFilterWhere(['like', 'status', $this->q])
            ->orFilterWhere(['like', 'type', $this->type]);

        //$query->orFilterWhere(['like', 'patient.name', $this->q])

        return $dataProvider;
    }
}
