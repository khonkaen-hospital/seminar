<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>
 <?= "<?php " ?>$form = ActiveForm::begin(); ?>
<div class="box-body">
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

   

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
    }
} ?>

</div>
</div>
<div class="box-footer">
<?= "<?= " ?>Html::submitButton('<i class="glyphicon glyphicon-send"></i> '.($model->isNewRecord ? 'บันทึก' : 'บันทึกแก้ไข'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-default']) ?> 
<?= "<?= " ?> Html::resetButton('<i class="glyphicon glyphicon-refresh"></i> Reset', ['class'=>'btn btn-default']) ?>
</div>
<?= "<?php " ?>ActiveForm::end(); ?>


