<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Seminar]].
 *
 * @see Seminar
 */
class SeminarQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Seminar[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Seminar|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}