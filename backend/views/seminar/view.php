<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Seminar */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seminars'), 'url' => ['index']];
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


<div class="seminar-view">

    <?= DetailView::widget([
        'model' => $model,
        'template'=>'<tr><th style="width:180px;">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'venue',
            'start_date',
            'end_date',
            'poster',
            'logo',
            'open_registration',
            'close_registration',
            'create_date',
            'update_date',
            'payment_detail:ntext',
            'contact:ntext',
            'open',
            'open_auto',
            'status',
            'register_limit',
            'user_id',
            'ref',
            'active',
        ],
    ]) ?>

        </div>
    </div>
</div>
