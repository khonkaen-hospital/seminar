<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%lib_room}}".
 *
 * @property integer $id
 * @property string $room_name
 * @property string $status
 *
 * @property Schedule[] $schedules
 */
class Room extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE  = 1;

    const STATUS_PASSIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lib_room}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status','room_name'], 'string'],
            [['seminar_id'],'integer'],
            [['room_name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'room_name' => Yii::t('app', 'ชื่อห้องประชุม'),
            'status' => Yii::t('app', 'สถานะ'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['room_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return RoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoomQuery(get_called_class());
    }

    public static function getItemAlies($type){
        $items = [];
        if($type==='status'){
            $items = [self::STATUS_ACTIVE => Yii::t('app', 'เปิดใช้งาน'),self::STATUS_PASSIVE => Yii::t('app', 'ปิดใช้งาน')];
        }
        return $items;
    }
}
