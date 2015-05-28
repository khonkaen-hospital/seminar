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
}