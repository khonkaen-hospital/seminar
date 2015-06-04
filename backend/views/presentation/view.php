<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Schedule */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Schedules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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


<div class="schedule-view">

    <?= DetailView::widget([
        'model' => $model,
        'template'=>'<tr><th style="width:180px;">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            'id',
            'start_date',
            'end_date',
            'topic:ntext',
            'detail:ntext',
            'status',
            'room_id',
            'type',
            'create_time:datetime',
            'update_time:datetime',
            'seminar_id',
            'narrator',
        ],
    ]) ?>

        </div>
    </div>
</div>
