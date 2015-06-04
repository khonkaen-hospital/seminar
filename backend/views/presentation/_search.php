<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ScheduleSearch */
/* @var $form yii\widgets\ActiveForm */
//Html::a('<i class="glyphicon glyphicon-plus"> </i> Create', ['create'], ['data-pjax'=>'0','class' => 'btn btn-default'])
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
            '.Html::button('<i class="glyphicon glyphicon-plus"> </i> Create', ['data-url'=>Url::to(['/presentation/create','seminar_id'=>$model->seminar_id]),'id'=>'btn-modal-schedule','class' => 'btn btn-default']).'
            </span>
            </div>',
    ])->textInput(['placeholder'=>'ค้นหา...'])
    ->label(false);?>


    <?php ActiveForm::end(); ?>

</div>
