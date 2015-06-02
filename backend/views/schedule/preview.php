<?php
use yii\helpers\Html;
use backend\models\Schedule;


$this->title = Yii::t('app', 'ตารางการประชุม');
$this->params['breadcrumbs'][] = $this->title;

$template = '<tr><th><span style="color:rgb(255, 215, 10);">{time}</span></th><td>{topic}</td><td><span style="color:rgb(10, 236, 255);">{room}</span></td></tr>';
?>
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
                