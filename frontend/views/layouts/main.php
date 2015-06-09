<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <div class="wrap">

        <div class="container">

         <div class="masthead">
            <!-- <h3 class="text-muted">งานประชุมวิชาการวิจัยเขตสุขภาพที่ 7 (ร้อยแก่นสารสินธุ์)</h3> -->
            <nav>
            <?= Menu::widget([
                    'options'=>['class'=>'nav nav-justified'],
                    'items' => [
                        ['label' => 'หน้าหลัก', 'url' => ['site/index']],
                         ['label' => 'กำหนดการ', 'url' => '#'],
                          ['label' => 'ตารางนำเสนอ', 'url' => '#'],
                           ['label' => 'ติดต่อเรา', 'url' => '#'],
                    ],
                ]);
            ?>
            </nav>
          </div>
          <br>

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; โรงพยาบาลขอนแก่น <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
