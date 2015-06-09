<?php

namespace backend\models;

use Yii;
use backend\models\ResearchType;
use backend\models\Province;

/**
 * This is the model class for table "{{%research}}".
 *
 * @property integer $id
 * @property integer $seminar_id
 * @property string $number
 * @property string $topic
 * @property string $present_by
 * @property string $position
 * @property string $office
 * @property string $province_code
 * @property integer $research_type
 * @property string $researcher 
 * @property string $start_date
 * @property string $end_date
 * @property integer $room_id
 * 
 * @property LibResearchType $researchType
 * @property Seminar $seminar
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
            [['start_date', 'end_date','topic','number'],'required'],
            [['seminar_id', 'research_type','room_id'], 'integer'],
            [['start_date', 'end_date','real_start','real_end','seminar_id','room_id'], 'safe'],
            [['number'], 'string', 'max' => 10],
            [['topic', 'present_by','researcher'], 'string', 'max' => 255],
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
            'start_date' => Yii::t('app', 'เวลาเริ่ม'),
            'end_date' => Yii::t('app', 'เวลาสิ้นสุด'),
            'real_start' => Yii::t('app', 'เวลาเริ่มจริง'),
            'real_end' => Yii::t('app', 'เวลาสิ้นสุดจริง'),
            'seminar_id' => Yii::t('app', 'Seminar ID'),
            'number' => Yii::t('app', 'รหัสผลงาน'),
            'topic' => Yii::t('app', 'ชื่อเรื่อง'),
            'present_by' => Yii::t('app', 'ผู้นำเสนอ'),
            'position' => Yii::t('app', 'ตำแหน่ง'),
            'office' => Yii::t('app', 'หน่วยงาน'),
            'researcher' => Yii::t('app', 'นักวิจัย'),
            'province_code' => Yii::t('app', 'จังหวัด'),
            'research_type' => Yii::t('app', 'ประเภทงานวิจัย'),
            'room_id' => Yii::t('app', 'ห้องประชุม'),
            'provinceName' => Yii::t('app', 'จังหวัด'),
            'researchTypeName' => Yii::t('app', 'ประเภทงานวิจัย'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return @$this->hasOne(Province::className(), ['PROVINCE_CODE' => 'province_code']);
    }

    public function getProvinceName()
    {
        return @$this->province->PROVINCE_NAME;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResearchType()
    {
        return @$this->hasOne(ResearchType::className(), ['id' => 'research_type']);
    }

    public function getResearchTypeName()
    {
        return @$this->researchType->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeminar()
    {
        return $this->hasOne(Seminar::className(), ['id' => 'seminar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }

    public function getRoomName(){
        return @$this->room->room_name;
    }

    /**
     * @inheritdoc
     * @return ResearchQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ResearchQuery(get_called_class());
    }

        public function getTime(){
        $startMonth = date('Y-m',strtotime($this->start_date));
        $endMonth   = date('Y-m',strtotime($this->end_date));
        return Yii::$app->formatter->asDateTime($this->start_date.' '.Yii::$app->timeZone,'php:H:i').' - '.Yii::$app->formatter->asDateTime($this->end_date.' '.Yii::$app->timeZone,'php:H:i');
    }

    public function getDate(){
        $startMonth = date('Y-m',strtotime($this->start_date));
        $endMonth   = date('Y-m',strtotime($this->end_date));
        $startDay = date('Y-m-d',strtotime($this->start_date));
        $endDay   = date('Y-m-d',strtotime($this->end_date));

        if($startMonth === $endMonth){
            if( $startDay == $endDay){
                return Yii::$app->formatter->asDateTime($this->start_date.' '.Yii::$app->timeZone,'php:d F Y');
            }else{
               return Yii::$app->formatter->asDate($this->start_date.' '.Yii::$app->timeZone,'php:d'). ' - ' . Yii::$app->formatter->asDateTime($this->end_date.' '.Yii::$app->timeZone,'php:d F Y'); 
            }
        }else{
            return Yii::$app->formatter->asDate($this->start_date.' '.Yii::$app->timeZone). ' - ' . Yii::$app->formatter->asDate($this->end_date.' '.Yii::$app->timeZone);
        }  
    }
    public function getDateTime(){ 
            return $this->getDate().' '.$this->getTime();
    }

    public function getStartDate(){
        return Yii::$app->formatter->asDate($this->start_date);
    }

    public function getEndDate(){
        return Yii::$app->formatter->asDate($this->end_date,' '.Yii::$app->timeZone);
    }
}
