<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%seminar}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $venue
 * @property string $start_date
 * @property string $end_date
 * @property string $poster
 * @property string $logo
 * @property string $open_registration
 * @property string $close_registration
 * @property string $create_date
 * @property string $update_date
 * @property string $payment_detail
 * @property string $contact
 * @property integer $open
 * @property integer $open_auto
 * @property integer $status
 * @property integer $register_limit
 * @property integer $user_id
 * @property string $ref
 * @property string $active
 */
class Seminar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%seminar}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'payment_detail', 'contact', 'active'], 'string'],
            [['start_date', 'end_date', 'open_registration', 'close_registration', 'create_date', 'update_date'], 'safe'],
            [['open', 'open_auto', 'status', 'register_limit', 'user_id'], 'integer'],
            [['title', 'venue', 'poster', 'logo'], 'string', 'max' => 255],
            [['ref'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'ชื่องาน'),
            'description' => Yii::t('app', 'รายละเอียด'),
            'venue' => Yii::t('app', 'สถานที่'),
            'start_date' => Yii::t('app', 'วันที่เริ่มงาน'),
            'end_date' => Yii::t('app', 'วันที่สิ้นสุด'),
            'poster' => Yii::t('app', 'ไฟล์โปสเตอร์'),
            'logo' => Yii::t('app', 'ไฟล์โลโก้งาน'),
            'open_registration' => Yii::t('app', 'วันที่เปิดลงทะเบียน'),
            'close_registration' => Yii::t('app', 'วันที่ปิดลงทะเบียน'),
            'create_date' => Yii::t('app', 'สร้างวันที่'),
            'update_date' => Yii::t('app', 'แก้ไขวันที่'),
            'payment_detail' => Yii::t('app', 'รายละเอียดการชำระเงิน'),
            'contact' => Yii::t('app', 'รายละเอียดการติดต่อ'),
            'open' => Yii::t('app', 'เปิดให้ลงทะเบียน'),
            'open_auto' => Yii::t('app', 'เปิดให้ลงทะเบียนอัตโนมัติ'),
            'status' => Yii::t('app', 'สถานะ'),
            'register_limit' => Yii::t('app', 'จำนวนที่เปิดให้ลงทะเบียน'),
            'user_id' => Yii::t('app', 'ผู้บันทึก'),
            'ref' => Yii::t('app', 'referent สำหรับ อัพโหลด'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @inheritdoc
     * @return SeminarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SeminarQuery(get_called_class());
    }
}
