<?php

namespace backend\models;

use Yii;
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
 */
class Schedule extends \yii\db\ActiveRecord
{

    const TYPE_SCHEDULE     = 'schedule';
    const TYPE_PRESENTATION = 'presentation';

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
            [['start_date', 'end_date'], 'safe'],
            [['topic', 'detail', 'status', 'type'], 'string'],
            [['room_id', 'create_time', 'update_time'], 'integer']
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
            'detail' => Yii::t('app', 'Detail'),
            'status' => Yii::t('app', 'สถานะ'),
            'room_id' => Yii::t('app', 'ห้องประชุม'),
            'type' => Yii::t('app', 'Type'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'roomName' => Yii::t('app', 'ห้องประชุม'),
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
}
