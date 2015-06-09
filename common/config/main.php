<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language'=>'th',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\ApcCache',
            'keyPrefix' => 'seminar',      
        ],
    ],
    'modules' => [
	    'user' => [
	        'class' => 'dektrium\user\Module',
	    ],
	],
];
