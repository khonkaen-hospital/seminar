<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SeminarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ตั้งค่า');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$model->title; ?></h3>
                  <div class="box-tools pull-right">
                     <button class="btn btn-default btn-sm" data-toggle="tooltip" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="" data-original-title="Reply"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Forward"><i class="fa fa-share"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body ">
                  <div class="mailbox-read-info">
                 	  <h3><?=$model->date; ?> </h3>
                    <h4><?=$model->venue; ?></h4>
                    <h5>
                    <span class="mailbox-read-time pull-right">แก้ไขล่าสุด : <?=$model->update_date; ?></span></h5>
                  </div>
             <br>
             
              <div class="row">
             	<div class="col-md-3">
             		<?= Html::a('<i class="fa fa-edit"></i> กำหนดการ',['/schedule/index','seminar_id'=>$model->id],['class'=>'btn btn-default btn-lg btn-block']);
             		?>
                </div>
             	<div class="col-md-3">
             		<?= Html::a('<i class="fa fa-edit"></i> ตารางการนำเสนอ',['/research/index','seminar_id'=>$model->id],['class'=>'btn btn-default btn-lg btn-block']);
             		?>
                </div>
             	<div class="col-md-3">
             		<?= Html::a('<i class="fa fa-edit"></i> ประเภทงานวิจัย',['/research-type/index','seminar_id'=>$model->id],['class'=>'btn btn-default btn-lg btn-block']);
             		?>
                </div> 
                <div class="col-md-3">
             		<?= Html::a('<i class="fa fa-edit"></i>ห้องประชุม',['/room/index','seminar_id'=>$model->id],['class'=>'btn btn-default btn-lg btn-block']);
             		?>
                </div>                
             </div>  
   
                </div>
</div>