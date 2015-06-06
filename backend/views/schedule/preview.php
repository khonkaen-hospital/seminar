<?php
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Schedule;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'ตารางการประชุม');
$this->params['breadcrumbs'][] = $this->title;

$template = '<tr><th><span style="color:rgb(255, 215, 10);">{time}</span></th><td>{topic}</td><td><span style="color:rgb(10, 236, 255);">{room}</span></td></tr>';
?>
<?php Pjax::begin(['options'=>['class'=>'pjax']]); ?>
<?= Html::a("Refresh", Url::current(), ['class' => 'btn btn-lg btn-primary','style'=>'display:none;', 'id' => 'refreshButton']) ?>
<table class="table time-schedule">
<tbody>
				<?php
				foreach ($model as  $value) {

          echo strtr($template, [
           '{time}' => $value->isCurrentDate(),
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
    setInterval(function(){ $("#refreshButton").click(); }, 3000);
});
JS;
$this->registerJs($script);
?>
                