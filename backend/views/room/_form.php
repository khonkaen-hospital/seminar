<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Room;
/* @var $this yii\web\View */
/* @var $model backend\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>
 <?php $form = ActiveForm::begin(); ?>
<div class="box-body">
<div class="room-form">

   

    <?= $form->field($model, 'room_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->radioList(Room::getItemAlies('status'), ['prompt' => '']) ?>


</div>
</div>
<div class="box-footer">
<?= Html::submitButton('<i class="glyphicon glyphicon-send"></i> '.($model->isNewRecord ? 'บันทึก' : 'บันทึกแก้ไข'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-default']) ?> 
<?=  Html::resetButton('<i class="glyphicon glyphicon-refresh"></i> Reset', ['class'=>'btn btn-default']) ?>
</div>
<?php ActiveForm::end(); ?>


