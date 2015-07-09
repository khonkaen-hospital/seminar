<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Research;

/**
 * ResearchSearch represents the model behind the search form about `backend\models\Research`.
 */
class ResearchSearch extends Research
{
    public $q;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'research_type'], 'integer'],
            [['number', 'topic', 'present_by', 'position', 'office', 'province_code','q','room_id','seminar_id'], 'safe'],
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
        //$query = Research::find();

        $query = Research::getDb()->cache(function ($db) {
            return Research::find();
        });

        $query->joinWith(['room']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>200
            ],
            'sort'=>[
                'defaultOrder'=>['roomName'=>SORT_ASC,'startDate'=>SORT_ASC]
            ]
        ]);

        $dataProvider->sort->attributes['roomName'] = [
            'asc' => ['lib_room.room_name' => SORT_ASC],
            'desc' => ['lib_room.room_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['startDate'] = [
            'asc' => ['start_date' => SORT_ASC],
            'desc' => ['start_date' => SORT_DESC],
        ];

         $dataProvider->sort->attributes['time'] = [
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
            'room_id'=>$this->room_id,
            'research.seminar_id'=>$this->seminar_id,
            //'seminar_id' => $this->seminar_id,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'topic', $this->q])
            ->andFilterWhere(['like', 'present_by', $this->present_by])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'office', $this->office])
            ->andFilterWhere(['like', 'province_code', $this->province_code]);

        //$query->orFilterWhere(['like', 'patient.name', $this->q])

        return $dataProvider;
    }
}
