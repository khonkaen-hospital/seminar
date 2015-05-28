<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?= "<?php " ?>$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax'=>true]
    ]); ?>


    <?= "<?= " ?> $form->field($model, 'q', [
    'inputTemplate' => '<div class="input-group">{input}
            <span class="input-group-btn">
            <button type="submit" class="btn btn-default" type="button"><i class="fa fa-search"></i> Search </button>
            '.Html::a('<i class="glyphicon glyphicon-plus"> </i> Create', ['create'], ['data-pjax'=>'0','class' => 'btn btn-default']).'
            </span>
            </div>',
    ])->textInput(['placeholder'=>'ค้นหา...'])
    ->label(false);?>


    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
