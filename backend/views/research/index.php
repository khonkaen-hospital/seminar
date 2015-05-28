<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

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
<?php Pjax::begin(); ?>  
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'number',
            'topic',
            'present_by',
            'position',
            // 'office',
            // 'province_code',
            // 'research_type',

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
