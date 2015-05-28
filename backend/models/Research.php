<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%research}}".
 *
 * @property integer $id
 * @property string $number
 * @property string $topic
 * @property string $present_by
 * @property string $position
 * @property string $office
 * @property string $province_code
 * @property integer $research_type
 *
 * @property ResearchType $researchType
 */
class Research extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%research}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number','topic','position','office','present_by','position','province_code','research_type'],'required'],
            [['research_type'], 'integer'],
            [['number'], 'string', 'max' => 10],
            [['topic', 'present_by'], 'string', 'max' => 255],
            [['position', 'office'], 'string', 'max' => 150],
            [['province_code'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'รหัสผลงาน'),
            'topic' => Yii::t('app', 'ชื่อเรื่อง'),
            'present_by' => Yii::t('app', 'ชื่อนักวิจัย'),
            'position' => Yii::t('app', 'ตำแหน่ง'),
            'office' => Yii::t('app', 'หน่วยงาน'),
            'province_code' => Yii::t('app', 'จังหวัด'),
            'research_type' => Yii::t('app', 'ประเภทงานวิจัย'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResearchType()
    {
        return $this->hasOne(ResearchType::className(), ['id' => 'research_type']);
    }

    /**
     * @inheritdoc
     * @return ResearchQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResearchQuery(get_called_class());
    }
}
