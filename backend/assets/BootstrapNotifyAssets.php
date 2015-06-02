<?php

namespace backend\assets;

use yii\web\AssetBundle;

class BootstrapNotifyAssets extends AssetBundle
{
    public $sourcePath = '@bower';

    public $css = [
    	'animate.css/animate.min.css'
    ];

    public $js = [
        'remarkable-bootstrap-notify/bootstrap-notify.min.js'
    ];

}