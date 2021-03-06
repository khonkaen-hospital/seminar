<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ResearchType */

$this->title = Yii::t('app', 'Create Research Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Research Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
	<div class="box-header with-border">
		<i class="fa fa-edit"></i><h3 class="box-title"><?=Html::encode($this->title);?></h3>
	</div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
