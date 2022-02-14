
<div class="login-box animated fadeInDown">
    <div class="login-logo"></div>
    <div class="login-body">
        <?php if(Yii::app()->user->hasFlash('reg')): ?>
            <div class="login-title">
                <strong>СПАСИБО! </strong><strong class="text-success">Вы зарегистрированы</strong> в <?= Yii::app()->name; ?>
            </div>
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <div class="col-md-12">
                        <p><?= Yii::app()->user->getFlash('reg'); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4">
                        <a href="<?php echo Yii::app()->params->base_url; ?>" class="btn btn-link btn-block">
                            <span class="fa fa-angle-left"></span>На главную
                        </a>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <div class="login-title">
                <strong>РЕГИСТРАЦИЯ</strong> в <?= Yii::app()->name; ?>
            </div>
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" class="form-control" placeholder="Имя" name="name" required="true"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="email" class="form-control" placeholder="Электронная почта" name="email" required="true"/>
                        <?php if(Yii::app()->user->hasFlash('error')): ?>
                            <span class="text-danger"><?= Yii::app()->user->getFlash('error'); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" class="form-control" placeholder="Пароль" name="password" required="true"/>
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
                        <button class="btn btn-info btn-block" type="submit">Регистрация</button>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
    <div class="login-footer">
        <div class="pull-left">
            &copy; 2014 <?= Yii::app()->name; ?>
        </div>
        <div class="pull-right">
            <a href="#">Пользовательское соглашение</a> <br>
            <a href="#">Политика конфиденциальности</a>
        </div>
    </div>
</div>