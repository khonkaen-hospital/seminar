<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\grid\GroupGridView;
use backend\models\Room;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ResearchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ตารางการนำเสนอ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header">
        <i class="fa fa-edit"></i>
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
<div class="research-index">
<?php Pjax::begin(['enablePushState' => false,'id'=>'room-monitor-pjax']); ?>  
    <?php  echo $this->render('_search', ['model' => $searchModel,'seminar_id' => $seminar_id]); ?>
    <?= GroupGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'mergeColumns' => array('time'),  
        'extraRowColumns' => array('startDate','roomName'),
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            // [
            //     'options'=>['style'=>'width:120px;'],
            //     'attribute'=>'room_id',
            //      'format'=>'html',
            //     'filter'=>ArrayHelper::map(Room::find()->all(),'id','room_name'),
            //     'value'=>function($model){
            //         return '<span style="color:#FF0027;">'.$model->time.'</span>';
            //     }
            // ],
            // [
            //     'options'=>['style'=>'width:110px;'],
            //     'attribute'=>'time',
            //     'format'=>'html',
            //     'value'=>function($model){
            //         return '<span style="color:#FF0027;">'.$model->time.'</span>';
            //     }
            // ],
            //'topic',
            [ 
                'attribute'=>'room_id',
                 'format'=>'html',
                'filter'=>ArrayHelper::map(Room::find()->all(),'id','room_name'),
                'format'=>'html',
                'value'=>function($model){
                    return "<p>[<span style=\"color:#FF0027;\">{$model->time}</span> ] [{$model->number}] ".$model->topic."<br><small style=\"color:gray\"><i>-นักวิจัย {$model->researcher}, ผู้นำเสนอ {$model->present_by} ( {$model->researchTypeName} )</i><br>".($model->real_start==null?'':date('H:i',strtotime($model->real_start)))."-".($model->real_end==null?'':date('H:i',strtotime($model->real_end)))."</small></p>";
                }
            ],
            //'present_by',
            //'position',
            // 'office',
            // 'province_code',
            // 'research_type',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Actions',
                'options'=>['style'=>'width:190px;'],
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {start} {stop} {update}</div>',
                'buttons'=>[
                    'start'=>function ($url, $model, $key) {
                        return Html::button('<i class="glyphicon glyphicon-expand"></i> Start',['data-url'=>Url::to(['research/start','id'=>$key]),'data-status'=>$model->real_start==null?1:0,'class'=>($model->real_start==null?'btn-default':'btn-success').' btn btn-start']);
                    },
                    'stop'=>function ($url, $model, $key) {
                       return Html::button('<i class="glyphicon glyphicon-unchecked"></i> Stop',['data-url'=>Url::to(['research/stop','id'=>$key]),'data-status'=>$model->real_end==null?1:0,'class'=>($model->real_end==null?'btn-default':'btn-success').' btn btn-start']);
                    },
                    'update'=>function ($url, $model, $key) {
                       return Html::a('<i class="glyphicon glyphicon-pencil"></i>',['research/monitor-update','id'=>$key],['class'=>' btn btn-default btn-start']);
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
 $this->registerJs('

    $( document ).on( "click", "button.btn-start", function(event) {
 
       $.post($(this).attr("data-url"),{"dataCheck":$(this).attr("data-status")},function(data){
        console.log(data);
         $.pjax.reload({container:"#room-monitor-pjax"});
       });
       event.preventDefault();
    });

    $(document).on("pjax:timeout", function(event) {
        // Prevent default timeout redirection behavior
        console.log(event);
      event.preventDefault()
    });

 ');
?>
