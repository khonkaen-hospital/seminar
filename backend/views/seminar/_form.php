<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Seminar */
/* @var $form yii\widgets\ActiveForm */
?>
 <?php $form = ActiveForm::begin(); ?>
<div class="box-body">
<div class="seminar-form">

   

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'venue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <?= $form->field($model, 'poster')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'open_registration')->textInput() ?>

    <?= $form->field($model, 'close_registration')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'update_date')->textInput() ?>

    <?= $form->field($model, 'payment_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'contact')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'open')->textInput() ?>

    <?= $form->field($model, 'open_auto')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'register_limit')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'ref')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->dropDownList([ 'active' => 'Active', 'passive' => 'Passive', ], ['prompt' => '']) ?>


</div>
</div>
<div class="box-footer">
<?= Html::submitButton('<i class="glyphicon glyphicon-send"></i> '.($model->isNewRecord ? 'บันทึก' : 'บันทึกแก้ไข'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-default']) ?> 
<?=  Html::resetButton('<i class="glyphicon glyphicon-refresh"></i> Reset', ['class'=>'btn btn-default']) ?>
</div>
<?php ActiveForm::end(); ?>


