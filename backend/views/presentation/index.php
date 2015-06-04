<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Schedule;
use yii\bootstrap\Modal;
use dosamigos\grid\GroupGridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\ScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ตารางนำเสนอ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header">
        <i class="fa fa-edit"></i>
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
<div class="schedule-index">
<?php Pjax::begin(['id'=>'Schedule-grid-pjax','enablePushState' => false]); ?>  
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

  
    <?= GroupGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'mergeColumns' => array('time'),  
        'extraRowColumns' => array('startDate'),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // [
            //     'attribute'=>'type',
            //     'filter'=>Schedule::getIitemAlies('type')
            // ],
            //'id',
            //'startDate',
           // 'time',
            [
                'attribute'=>'time',
                'format'=>'html',
                'value'=>function($model){
                    return '<span style="color:green;">'.$model->time.'</span>';
                }
            ],
            //'end_date',
            'topic:ntext',
            //'detail:ntext',
           
            'roomName',
            // 'status',
            // 'room_id',
            // 'type',
            // 'create_time:datetime',
            // 'update_time:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Actions',
                'options'=>['style'=>'width:170px;'],
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {copy} {view} {update} {delete} </div>',
                'buttons'=>[
                    'delete'=>function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>',Url::to(['schedule/delete','id'=>$key]),['data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),'data-method' => 'post', 'class'=>'btn btn-default']);
                    },
                    'copy'=>function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-copy"></i>',Url::to(['schedule/copy','seminar_id'=>$model->seminar_id,'id'=>$key]),['title' => Yii::t('yii', 'Copy'),
                    'aria-label' => Yii::t('yii', 'Copy'),'class'=>'btn btn-default']);
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>  

</div>
</div>
</div>

<?php 
    Modal::begin(['id'=>'modal-Schedule','size'=>'modal-lg']);
    Modal::end();
?>

<?php $this->registerJs("

    // event on click  button
    $('body').on('click', '#btn-modal-schedule', function(e){
        $('#modal-Schedule').modal('show')
        .find('.modal-content')
        .load($(this).attr('data-url'));
    });


");
?>
