<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Research */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Researches'), 'url' => ['index','seminar_id'=>$model->seminar_id]];
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title);?></h3>
        <div class="box-tools">
           <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>

    <div class="box-body">
        <div class="patient-view">


<div class="research-view">

    <?= DetailView::widget([
        'model' => $model,
        'template'=>'<tr><th style="width:180px;">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            'id',
            'number',
            'topic',
            'researcher',
            'present_by',
            'position',
            'office',
            'provinceName',
            'researchTypeName',
        ],
    ]) ?>

        </div>
    </div>
</div>
