<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%research_type}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $status
 */
class ResearchType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lib_research_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'string'],
            [['name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'ชื่อประเภท'),
            'status' => Yii::t('app', 'เปิดใช้งาน'),
        ];
    }

    /**
     * @inheritdoc
     * @return ResearchTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResearchTypeQuery(get_called_class());
    }
}
