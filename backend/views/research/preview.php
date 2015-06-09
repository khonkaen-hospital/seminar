<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Schedule;
use yii\widgets\Pjax;
use dosamigos\grid\GroupGridView;

$this->title = Yii::t('app', 'ตารางการประชุม');
$this->params['breadcrumbs'][] = $this->title;

$template = '<tr><td><span style="width:300px;color:rgb(10, 236, 255);">{room}</span></td><th><span style="color:rgb(255, 215, 10);">{time}</span></th><td>{topic}{real}</td></tr>';
?>
<?php Pjax::begin(['options'=>['class'=>'pjax']]); ?>
<?= Html::a("Refresh", Url::current(), ['class' => 'btn btn-lg btn-primary','style'=>'display:none;', 'id' => 'refreshButton']) ?>


<table class="table time-schedule">
    <tbody>
    	<?php

        // foreach ($rooms as $room) {
        //        echo strtr($template, [
        //        '{time}'  => 'x',
        //        '{topic}' => 's',
        //        '{room}'  =>$room->room_name
        //       ]);
        // } 

        $researchs = $dataProvider->getModels();
        foreach ($researchs as $research) {
          echo strtr($template, [
               '{time}'  => date('H:i',strtotime($research['start_date']))." - ".date('H:i',strtotime($research['end_date'])),
               '{real}'  => "<br><small> เวลานำเสนอจริง : ".($research['real_start']==null?'':date('H:i',strtotime($research['real_start'])))." - ".($research['real_end']==null?'':date('H:i',strtotime($research['real_end']))).'</small>',
               '{topic}' => '['.$research['number'].'] '.$research['topic'],
               '{room}'  =>$research['room_name']
              ]);
        }

    		// foreach ($model as  $value) {
        //       echo strtr($template, [
        //        '{time}' => $value->time,
        //        '{topic}'=>$value->topic,
        //        '{room}'=>$value->roomName
        //       ]);
        // }

      ?>
    </tbody>
</table>
<?php Pjax::end(); ?>
<?php
$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 60000);
});
JS;
$this->registerJs($script);
?>
                