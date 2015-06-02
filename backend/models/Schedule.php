<?php

namespace backend\models;

use Yii;
use DateTime;
use backend\models\Room;
/**
 * This is the model class for table "{{%schedule}}".
 *
 * @property integer $id
 * @property string $start_date
 * @property string $end_date
 * @property string $topic
 * @property string $detail
 * @property string $status
 * @property integer $room_id
 * @property string $type
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $seminar_id
 */
class Schedule extends \yii\db\ActiveRecord
{

    const TYPE_SCHEDULE     = 'schedule';
    const TYPE_PRESENTATION = 'presentation';
    const STATUS_ACTIVE     = 1;
    const STATUS_PASSIVE    = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%schedule}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date','end_date'],'required'],
            [['start_date', 'end_date','seminar_id'], 'safe'],
            [['topic', 'detail', 'status', 'type'], 'string'],
            [['room_id', 'create_time', 'update_time'], 'integer'],
            [['narrator'],'string','max'=>255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'รหัส schedule'),
            'start_date' => Yii::t('app', 'เวลาเริ่ม'),
            'end_date' => Yii::t('app', 'เวลาสิ้นสุด'),
            'topic' => Yii::t('app', 'ชื่อเรื่อง'),
            'detail' => Yii::t('app', 'รายละเอียด'),
            'status' => Yii::t('app', 'สถานะ'),
            'room_id' => Yii::t('app', 'ห้องประชุม'),
            'type' => Yii::t('app', 'Type'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'roomName' => Yii::t('app', 'ห้องประชุม'),
            'narrator' => Yii::t('app', 'ผู้บรรยาย')
        ];
    }

    /**
     * @inheritdoc
     * @return ScheduleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ScheduleQuery(get_called_class());
    }



    public static function getIitemAlies($type,$key=null){
        $items = [];
        if($type == 'type'){
            $items = [
                self::TYPE_SCHEDULE => 'Schdule',
                self::TYPE_PRESENTATION =>'Presentation'
            ];
        }
        return ($key !== null && array_key_exists($type, $items))?$items[$key]:$items;
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

    public function isCurrentDate(){
        $date1 = time();
        $date2 =  strtotime($this->start_date);
        $date3 =  strtotime($this->end_date);

        if($date1 > $date3){
            return '<span style="color: rgb(255, 66, 10)">'.$this->time.'</span>';
        } elseif ($date1 > $date2 && $date1 < $date3){
            return '<span style="color:rgb(63, 255, 10)">'.$this->time.'</span>';
        } else {
            return '<span style="color:rgb(255, 215, 10)">'.$this->time.'</span>';
        }
    }

}
