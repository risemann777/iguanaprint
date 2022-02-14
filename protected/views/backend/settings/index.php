<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-file-input.js"></script>

<? $this->rightFrameTitle = 'Настройки';
$this->breadcrumbs=array(
    'Настройки'
);
?>


<div class="page-tabs" style="height: auto">
    <a href="#info" class="active">Общие настройки сайта</a>
    <? if(Yii::app()->user->id == Users::LIKE_BOSS): ?>
        <a href="#system">Настройки системы</a>
    <? endif; ?>
    <?/*?><a href="#notify_emails">Адреса E-mail для уведомлений</a><?*/?>
</div>

<div class="page-content-wrap page-tabs-item active" id="info">

    <div class="row-content">

        <? if(Yii::app()->user->id == Users::LIKE_BOSS): ?>
        <div class="panel-body">
            <div class="form-group">
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal_no_head" style="margin-left: 15px;">
                    <span class="fa fa-plus-square"></span>ДОБАВИТЬ
                </a>
            </div>
        </div>
        <? endif; ?>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Общие настройки</h3>
                    </div>

                    <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                <tr>
                                    <? if(Yii::app()->user->id == Users::LIKE_BOSS): ?>
                                        <th>Set Name</th>
                                    <? endif; ?>
                                    <th>Название настройки</th>
                                    <th>Значение</th>
                                    <th width="120">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <? foreach($data->getData() as $user):?>
                                    <tr>
                                        <? if(Yii::app()->user->id == Users::LIKE_BOSS): ?>
                                            <td><strong><?= $user->set_name; ?></strong></td>
                                        <? endif; ?>
                                        <td><strong><?= $user->name; ?></strong></td>
                                        <td><?= $user->value; ?></td>
                                        <td>
                                            <a href="#" class="btn btn-default btn-condensed" data-toggle="modal" data-target="#edit_user<?= $user->id; ?>">
                                                <span class="fa fa-pencil"></span>
                                            </a>
                                            <? if(Yii::app()->user->id == Users::LIKE_BOSS): ?>
                                            <button type="button" class="mb-control btn btn-danger btn-condensed" data-box="#message-box-danger<?= $user->id; ?>">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                            <? endif; ?>
                                        </td>
                                    </tr>

                                    <div class="modal" id="edit_user<?= $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Редактирование настройки</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <input type="hidden" value="<?= $user->id; ?>" name="id">
                                                        <div class="col-lg-12">
                                                            <div class="form-group" style="margin-top: 15px;">
                                                                <label class="col-md-4 control-label">Название настройки</label>
                                                                <div class="col-md-8">
                                                                    <label class="col-md-12 control-label"><?= $user->name; ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="form-group" style="margin-top: 15px;">
                                                                <label class="col-md-4 control-label">Значение</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" name="value" class="form-control" value="<?= $user->value; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <? if(Yii::app()->user->id == Users::LIKE_BOSS): ?>
                                        <div class="message-box message-box-danger animated fadeIn" id="message-box-danger<?= $user->id; ?>">
                                            <div class="mb-container">
                                                <div class="mb-middle">
                                                    <div class="mb-title"><span class="fa fa-times"></span> Внимание!</div>
                                                    <div class="mb-content">
                                                        <p>Вы действительно хотите удалить <?= $user->name; ?> ?</p>
                                                    </div>
                                                    <div class="mb-footer">
                                                        <button class="btn btn-default btn-lg pull-right mb-control-close" style="margin-left: 10px;">Нет</button>
                                                        <a href="<?= $this->createUrl('/admin/settings/delete', array('id' => $user->id));?>" class="btn btn-default btn-lg pull-right">Да</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <? endif; ?>

                                <? endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<? if(Yii::app()->user->id == Users::LIKE_BOSS): ?>
<div class="page-content-wrap page-tabs-item" id="system">

    <div class="row-content">
        <div class="panel-body">
            <div class="form-group">
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal_no_head" style="margin-left: 15px;">
                    <span class="fa fa-plus-square"></span>ДОБАВИТЬ
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Настройки системы</h3>
                    </div>

                    <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                <tr>
                                    <th>Set Name</th>
                                    <th>Название настройки</th>
                                    <th>Значение</th>
                                    <th width="120">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <? foreach($data_system->getData() as $user):?>
                                    <tr>
                                        <td><strong><?= $user->set_name; ?></strong></td>
                                        <td><strong><?= $user->name; ?></strong></td>
                                        <td><?= $user->value; ?></td>
                                        <td>
                                            <a href="#" class="btn btn-default btn-condensed" data-toggle="modal" data-target="#edit_user<?= $user->id; ?>">
                                                <span class="fa fa-pencil"></span>
                                            </a>
                                            <? if(Yii::app()->user->id == Users::LIKE_BOSS): ?>
                                                <button type="button" class="mb-control btn btn-danger btn-condensed" data-box="#message-box-danger<?= $user->id; ?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            <? endif; ?>
                                        </td>
                                    </tr>

                                    <div class="modal" id="edit_user<?= $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Редактирование настройки</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <input type="hidden" value="<?= $user->id; ?>" name="id">
                                                        <div class="col-lg-12">
                                                            <div class="form-group" style="margin-top: 15px;">
                                                                <label class="col-md-4 control-label">Название настройки</label>
                                                                <div class="col-md-8">
                                                                    <label class="col-md-12 control-label"><?= $user->name; ?></label>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="form-group" style="margin-top: 15px;">
                                                                <label class="col-md-4 control-label">Лого</label>
                                                                <div class="col-md-8">
                                                                    <input type="file" name="logo" title="Выберите файл"/>
                                                                </div>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="form-group" style="margin-top: 15px;">
                                                                <label class="col-md-4 control-label">Значение</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" name="value" class="form-control" value="<?= $user->value; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <? if(Yii::app()->user->id == Users::LIKE_BOSS): ?>
                                        <div class="message-box message-box-danger animated fadeIn" id="message-box-danger<?= $user->id; ?>">
                                            <div class="mb-container">
                                                <div class="mb-middle">
                                                    <div class="mb-title"><span class="fa fa-times"></span> Внимание!</div>
                                                    <div class="mb-content">
                                                        <p>Вы действительно хотите удалить <?= $user->name; ?> ?</p>
                                                    </div>
                                                    <div class="mb-footer">
                                                        <button class="btn btn-default btn-lg pull-right mb-control-close" style="margin-left: 10px;">Нет</button>
                                                        <a href="<?= $this->createUrl('/admin/settings/delete', array('id' => $user->id));?>" class="btn btn-default btn-lg pull-right">Да</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <? endif; ?>

                                <? endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<? endif; ?>

<?/*?>
<div class="page-content-wrap page-tabs-item" id="notify_emails">
    <div class="row-content">
        <?if(Yii::app()->user->id == Users::LIKE_BOSS):?>
        <div class="panel-body">
            <div class="form-group">
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#add_notify" style="margin-left: 15px;">
                    <span class="fa fa-plus-square"></span>ДОБАВИТЬ АДРЕС
                </a>
            </div>
        </div>
        <?endif;?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Список адресов e-mail для доставки уведомлений по событиям</h3>
                    </div>
                    <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                <tr>
                                    <th>E-mail</th>
                                    <th width="200">Обратная связь</th>
                                    <th width="200">Заказ</th>
                                    <th width="120">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?foreach($notify_mail->getData() as $item):?>
                                    <tr>
                                        <td><strong><?=$item->email;?></strong></td>
                                        <td><? echo $item->is_feedback == 'Y'? '<span style="color:#57A9A8; font-size: 16px;" class="fa fa-circle"></span>' : '<span style="color:#A8403F; font-size: 16px;" class="fa fa-circle"></span>' ?></td>
                                        <td><? echo $item->is_order == 'Y'? '<span style="color:#57A9A8; font-size: 16px;" class="fa fa-circle"></span>' : '<span style="color:#A8403F; font-size: 16px;" class="fa fa-circle"></span>' ?></td>
                                        <td>
                                            <a href="#" class="btn btn-default btn-condensed" data-toggle="modal" data-target="#edit_email_<?= $item->id;?>">
                                                <span class="fa fa-pencil"></span>
                                            </a>
                                            <?if(Yii::app()->user->id == Users::LIKE_BOSS): ?>
                                                <button type="button" class="mb-control btn btn-danger btn-condensed" data-box="#email-box-danger-<?= $item->id; ?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            <?endif;?>
                                        </td>
                                    </tr>
                                <?endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?*/?>

<? // Новая настройка ?>
<div class="modal" id="modal_no_head" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Новая настройка</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Set Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="set_name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Название</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Значение</label>
                                <div class="col-md-9">
                                    <input type="text" name="value" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Системная</label>
                                <div class="col-md-9">
                                    <select class="form-control select" name="hide">
                                        <option value="1">Да</option>
                                        <option value="0">Нет</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div>
</div>

<? // добавление адреса для Уведомлений ?>
<?/*?>
<div class="modal" id="add_notify" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Добавление нового адреса</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="col-md-2 control-label">E-mail</label>
                                <div class="col-md-10">
                                    <input type="text" name="notify_email[email]" class="form-control" required >
                                </div>
                            </div>
                            <div class="form-group">
                                <br><h4><strong>Уведомлять о событиях</strong></h4>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Обратная связь</label>
                                <div class="col-md-6">
                                    <label class="check"><input type="checkbox" class="icheckbox1" name="notify_email[is_feedback]" value="1" /></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Заказ</label>
                                <div class="col-md-6">
                                    <label class="check"><input type="checkbox" class="icheckbox1" name="notify_email[is_order]" value="1" /></label>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?*/?>

<? // редактирование адреса для Уведомлений ?>
<?/*foreach($notify_mail->getData() as $item):?>
    <div class="modal" id="edit_email_<?= $item->id; ?>" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Редактирование адреса</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="notify_email[id]" value="<?=$item->id?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">E-mail</label>
                                    <div class="col-md-10">
                                        <input type="text" name="notify_email[email]" class="form-control" required value="<?=$item->email;?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <br><h4><strong>Уведомлять о событиях</strong></h4>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6 control-label">Обратная связь</label>
                                    <div class="col-md-6">
                                        <label class="check"><input type="checkbox" class="icheckbox1" name="notify_email[is_feedback]" value="1" <? echo $item->is_feedback == 'Y'? 'checked' : '' ?> /></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-6 control-label">Заказ</label>
                                    <div class="col-md-6">
                                        <label class="check"><input type="checkbox" class="icheckbox1" name="notify_email[is_order]" value="1" <? echo $item->is_order == 'Y'? 'checked' : '' ?> /></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <? if(Yii::app()->user->id == Users::LIKE_BOSS): ?>
        <div class="message-box message-box-danger animated fadeIn" id="email-box-danger-<?=$item->id; ?>">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Внимание!</div>
                    <div class="mb-content">
                        <p>Вы действительно хотите удалить <?= $item->email; ?> ?</p>
                    </div>
                    <div class="mb-footer">
                        <button class="btn btn-default btn-lg pull-right mb-control-close" style="margin-left: 10px;">Нет</button>
                        <a href="<?= $this->createUrl('/admin/settings/remove_email', array('id' => $item->id));?>" class="btn btn-default btn-lg pull-right">Да</a>
                    </div>
                </div>
            </div>
        </div>
    <? endif; ?>
<?endforeach;*/?>

<script>
    $(function(){
        if($(".icheckbox1").length > 0){
            $(".icheckbox1").iCheck({checkboxClass: 'icheckbox_minimal-grey'});
        }
    });
</script>