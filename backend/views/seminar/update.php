<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Seminar */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Seminar',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seminars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="box box-primary">
	<div class="box-header with-border">
	<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
	</div>
	<div class="seminar-update">
	 <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
	</div>
</div>
