<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Schedule;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'ตารางการประชุม');
$this->params['breadcrumbs'][] = $this->title;

$template = '<tr><th><span style="color:rgb(110, 149, 166);">{time}</span></th><td>{topic}</td><td><span style="color:rgb(79, 107, 53);">{room}</span></td></tr>';
?>
<?php Pjax::begin(['options'=>['class'=>'pjax']]); ?>
<div class="page-header">
  <h1>กำหนดการ <small>วันที่ 8-9 มิถุนายน 2558</small></h1>
</div>
<?= Html::a("Refresh", Url::current(), ['class' => 'btn btn-lg btn-primary','style'=>'display:none;', 'id' => 'refreshButton']) ?>
<table class="table time-schedule">
<tbody>
				<?php
				foreach ($model as  $value) {

          echo strtr($template, [
           '{time}' => $value->time,
           '{topic}'=>$value->topic,
           '{room}'=>$value->roomName
          ]);
        }

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
                