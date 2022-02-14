
    <div class="login-title">
        <strong>Авторизация</strong>
    </div>
    <form class="form-horizontal" method="post">
        <div class="form-group">
            <div class="col-md-12">
                <input type="text" class="form-control" placeholder="Электронная почта" name="email" style="color: #000000"/>
                <? if(Yii::app()->user->hasFlash('error_active')): ?>
                    <span class="text-danger push-up-5">
                        <?= Yii::app()->user->getFlash('error_active'); ?>
                        <a href="<?= $this->createUrl('/space/users/verify');?>">выслать повторное письмо</a>
                    </span>
                <? endif; ?>
                <? if(Yii::app()->user->hasFlash('error_user')): ?>
                    <span class="text-danger push-up-5">
                        <?= Yii::app()->user->getFlash('error_user'); ?>
                    </span>
                <? endif; ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <input type="password" class="form-control" placeholder="Пароль" name="password" style="color: #000000"/>
                <? if(Yii::app()->user->hasFlash('error_password')): ?>
                    <span class="text-danger push-up-5">
                        <?= Yii::app()->user->getFlash('error_password'); ?>
                    </span>
                <? endif; ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <a href="<?php echo Yii::app()->params->base_url; ?>" class="btn btn-link btn-block">
                    <span class="fa fa-angle-left"></span>На главную
                </a>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <button class="btn btn-info btn-block" type="submit">Войти</button>
            </div>
        </div>
        <div class="clearfix"></div>
    </form>
