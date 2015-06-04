<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ResearchType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Research Type',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Research Types'), 'url' => ['index','seminar_id'=>$model->seminar_id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="box box-primary">
	<div class="box-header with-border">
	<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
	</div>
	<div class="research-type-update">
	 <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
	</div>
</div>
