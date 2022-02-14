<?php

$yii=dirname(__FILE__).'/framework/yii.php';
$config = dirname(__FILE__).'/protected/config/backend.php';

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
$_SERVER['REQUEST_URI'] = preg_replace('|^(/?admin/?)|', '', $_SERVER['REQUEST_URI']); // some magic
Yii::createWebApplication($config)->runEnd('backend');