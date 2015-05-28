<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ScheduleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schedule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax'=>true]
    ]); ?>


    <?=  $form->field($model, 'q', [
    'inputTemplate' => '<div class="input-group">{input}
            <span class="input-group-btn">
            <button type="submit" class="btn btn-default" type="button"><i class="fa fa-search"></i> Search </button>
            '.Html::a('<i class="glyphicon glyphicon-plus"> </i> Create', ['create'], ['data-pjax'=>'0','class' => 'btn btn-default']).'
            </span>
            </div>',
    ])->textInput(['placeholder'=>'ค้นหา...'])
    ->label(false);?>


    <?php ActiveForm::end(); ?>

</div>
