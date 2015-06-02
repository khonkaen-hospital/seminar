<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SeminarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Seminars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
    <div class="box-header">
        <i class="fa fa-edit"></i>
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
<div class="seminar-index">
<?php Pjax::begin(); ?>  
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
           
            'venue',
            'date',
            // 'end_date',
            // 'poster',
            // 'logo',
            // 'open_registration',
            // 'close_registration',
            // 'create_date',
            // 'update_date',
            // 'payment_detail:ntext',
            // 'contact:ntext',
            // 'open',
            // 'open_auto',
            // 'status',
            // 'register_limit',
            // 'user_id',
            // 'ref',
            // 'active',
            [
                'header'=>'ตั้งค่า',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::a('ตั้งค่า',['/seminar/settings','id'=>$model->id],['data-pjax'=>'0','class'=>'btn btn-sm btn-default btn-block']);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Actions',
                'options'=>['style'=>'width:120px;'],
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view} {update} {delete} </div>'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>  

</div>
</div>
</div>
