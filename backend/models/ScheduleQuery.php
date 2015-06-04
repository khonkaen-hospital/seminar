<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Schedule]].
 *
 * @see Schedule
 */
class ScheduleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    public function bySeminar($id){
        $this->andWhere('seminar_id = :seminar_id',[':seminar_id'=>$id]);
        return $this;
    }

    public function schedule()
    {
        $this->andWhere('[[type]]="schedule"');
        return $this;
    }
    
    public function presentation()
    {
        $this->andWhere('[[type]]="presentation"');
        return $this;
    }

    /**
     * @inheritdoc
     * @return Schedule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Schedule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}