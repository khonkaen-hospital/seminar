<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\ResearchType;
use backend\models\Province;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use kartik\widgets\DateTimePicker;
use backend\models\Room;

/* @var $this yii\web\View */
/* @var $model backend\models\Research */
/* @var $form yii\widgets\ActiveForm */
?>
 <?php $form = ActiveForm::begin(); ?>
<div class="box-body">
<div class="research-form">
<div class="row">
                    <div class="col-md-4"> 
                        <?= $form->field($model, 'start_date')->widget(DateTimePicker::classname(), [
                                              'options' => ['placeholder' => 'Enter event time ...'],
                                              'pluginOptions' => [
                                                'autoclose' => true
                                              ]
                        ]); ?>
                    </div>
                    <div class="col-md-4"> 
                        <?= $form->field($model, 'end_date')->widget(DateTimePicker::classname(), [
                                              'options' => ['placeholder' => 'Enter event time ...'],
                                              'pluginOptions' => [
                                                'autoclose' => true
                                              ]
                        ]); ?>
                    </div>
                    <div class="col-md-4"> 
                      <?= $form->field($model, 'room_id')->widget(Select2::classname(), [
                          'data' => ArrayHelper::map(Room::find()->all(),'id','room_name'),
                          'options' => ['placeholder' => 'เลือกห้องประชุม ...'],
                          'pluginOptions' => [
                              'allowClear' => true
                          ],
                    ]);?>
                    </div>
                </div>
   <div class="row">
   	<div class="col-md-3">
   		 <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
   	</div>
   	<div class="col-md-9">
   		<?= $form->field($model, 'topic')->textInput(['maxlength' => true]) ?>
   	</div>
   </div>

   
   <div class="row">
      <div class="col-md-6">
         <?= $form->field($model, 'researcher')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-md-6">
         <?= $form->field($model, 'present_by')->textInput(['maxlength' => true]) ?>
      </div>
   </div>

   <div class="row">
   	<div class="col-md-6">
   		 <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
   	</div>
   	<div class="col-md-6">
   		 <?= $form->field($model, 'office')->textInput(['maxlength' => true]) ?>
   	</div>
   </div>
    

   <div class="row">
   	<div class="col-md-6">
   		<?= $form->field($model, 'province_code')->widget(Select2::classname(), [
			    'data' => ArrayHelper::map(Province::find()->all(),'PROVINCE_CODE','PROVINCE_NAME'),
			    'options' => ['placeholder' => 'เลือกจังหวัด ...'],
			    'pluginOptions' => [
			        'allowClear' => true
			    ],
			]);
   		 ?>
   	</div>
   	<div class="col-md-6">
   	<?= $form->field($model, 'research_type')->widget(Select2::classname(), [
			    'data' => ArrayHelper::map(ResearchType::find()->all(),'id','name'),
			    'options' => ['placeholder' => 'เลือกประเภท ...'],
			    'pluginOptions' => [
			        'allowClear' => true
			    ],
			]);
   		 ?>
   	</div>
   </div>

   

   

    

   


</div>
</div>
<div class="box-footer">
<?= Html::submitButton('<i class="glyphicon glyphicon-send"></i> '.($model->isNewRecord ? 'บันทึก' : 'บันทึกแก้ไข'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-default']) ?> 
<?=  Html::resetButton('<i class="glyphicon glyphicon-refresh"></i> Reset', ['class'=>'btn btn-default']) ?>
</div>
<?php ActiveForm::end(); ?>


