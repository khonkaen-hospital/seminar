<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ResearchSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="research-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax'=>true]
    ]); ?>


    <?=  $form->field($model, 'q', [
    'inputTemplate' => '<div class="input-group">{input}
            <span class="input-group-btn">
            <input type="hidden" name="seminar_id" value="'.$seminar_id.'" >
            <button type="submit" class="btn btn-default" type="button"><i class="fa fa-search"></i> Search </button>
            '.Html::a('<i class="glyphicon glyphicon-plus"> </i> Create', ['create','seminar_id'=>$seminar_id], ['data-pjax'=>'0','class' => 'btn btn-default']).'
            </span>
            </div>',
    ])->textInput(['placeholder'=>'ค้นหา...'])
    ->label(false);?>


    <?php ActiveForm::end(); ?>

</div>
