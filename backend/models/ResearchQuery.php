<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Research]].
 *
 * @see Research
 */
class ResearchQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Research[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Research|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function bySeminar($id){
        $this->andWhere('seminar_id = :seminar_id',[':seminar_id'=>$id]);
        return $this;
    }
    
    public function byDate($date=null){
        if($date===null){
            $date = date('Y-m-d');
        }

        $this->andWhere('DATE_FORMAT(start_date,"%Y-%m-%d")= :start_date',[':start_date'=>$date]);
        return $this;
    }
}