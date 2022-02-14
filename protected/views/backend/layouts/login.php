<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>
    <title>Site | Вход</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="/css/img/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.less"/>

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/lesscss/less.min.js"></script>
</head>
<body>

<div class="login-container">
    <div class="login-box animated fadeInDown text-center">
        <img class="push-down-10" src="/img/iguana_logo.jpg" alt='<?=Yii::app()->name?>'>
        <div class="login-body">
            <?php echo $content; ?>
        </div>
    </div>
</div>

</body>
</html>






