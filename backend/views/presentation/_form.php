<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;
use backend\models\Room;
/* @var $this yii\web\View */
/* @var $model common\models\Schedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schedule-form">

     <?php $form = ActiveForm::begin(['id'=>'form-'.$model->formName()]); ?>
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">เพิ่มกำหนดการ</h4>
          </div>
          <div class="modal-body">
                <div class="row">
                    <div class="col-md-6"> 
                        <?= $form->field($model, 'start_date')->widget(DateTimePicker::classname(), [
                                              'options' => ['placeholder' => 'Enter event time ...'],
                                              'pluginOptions' => [
                                                'autoclose' => true
                                              ]
                        ]); ?>
                    </div>
                    <div class="col-md-6"> 
                        <?= $form->field($model, 'end_date')->widget(DateTimePicker::classname(), [
                                              'options' => ['placeholder' => 'Enter event time ...'],
                                              'pluginOptions' => [
                                                'autoclose' => true
                                              ]
                        ]); ?>
                    </div>
                </div>
                <?= $form->field($model, 'seminar_id')->hiddenInput()->label(false); ?>
                <?= $form->field($model, 'topic')->textArea() ?>
                <?= $form->field($model, 'detail')->textArea() ?>
                 <?= $form->field($model, 'narrator')->textArea() ?>
                <?= $form->field($model, 'room_id')->dropDownList(ArrayHelper::map(Room::find()->all(),'id','room_name'),['prompt'=>'เลือกห้องประชุม']); ?>
                <?= $form->field($model, 'status')->checkbox() ?>

          </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
          </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs("

$('.schedule-form').on('beforeSubmit', 'form#form-Schedule', function(e) {
    var form = $(this);
    if (form.find('.has-error').length) {
      return false;
    }

    $.ajax({
      url: form.attr('action'),
      type: 'post',
      data: form.serialize(),
      success: function(result) {

        if(result.success){
            form.trigger('reset');
            $.pjax.reload({container:'#Schedule-grid-pjax'});
            $.notify({
              'message':'success .',
              'type':'success'
            });
        }else{
          $.notify({
            'message':'error.',
            'type':'danger'
          });
        }
        
      }
    },this);

    return false;
  });
");
?>
