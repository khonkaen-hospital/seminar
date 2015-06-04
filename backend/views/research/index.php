<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\grid\GroupGridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ResearchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Researches');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header">
        <i class="fa fa-edit"></i>
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
<div class="research-index">
<?php Pjax::begin(['enablePushState' => false]); ?>  
    <?php  echo $this->render('_search', ['model' => $searchModel,'seminar_id' => $seminar_id]); ?>
    <?= GroupGridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'mergeColumns' => array('time'),  
        'extraRowColumns' => array('startDate','roomName'),
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'options'=>['style'=>'width:110px;'],
                'attribute'=>'time',
                'format'=>'html',
                'value'=>function($model){
                    return '<span style="color:#FF0027;">'.$model->time.'</span>';
                }
            ],
            //'topic',
            [
                'attribute'=>'topic',
                'format'=>'html',
                'value'=>function($model){
                    return "<p>[{$model->number}] ".$model->topic."<br><small style=\"color:gray\"><i>-นักวิจัย {$model->researcher}, ผู้นำเสนอ {$model->present_by} ( {$model->researchTypeName} )</i></small></p>";
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
                'options'=>['style'=>'width:170px;'],
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {copy} {view} {update} {delete} </div>',
                'buttons'=>[
                    'copy'=>function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-copy"></i>',Url::to(['research/copy','seminar_id'=>$model->seminar_id,'id'=>$key]),['title' => Yii::t('yii', 'Copy'),
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
