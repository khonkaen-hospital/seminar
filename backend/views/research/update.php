<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Research */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Research',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Researches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="box box-primary">
	<div class="box-header with-border">
	<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
	</div>
	<div class="research-update">
	 <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
	</div>
</div>
