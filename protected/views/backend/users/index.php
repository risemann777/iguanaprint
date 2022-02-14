<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-select.js"></script>

<? $this->rightFrameTitle = 'Пользователи';
$this->breadcrumbs=array(
    'Пользователи'
);
?>

<div class="page-tabs" style="height: auto">
    <a href="#info" class="active">Все пользователи</a>
</div>

<div class="page-content-wrap page-tabs-item active" id="info">

    <div class="row-content">
        <?if($current_user->role == 1):?>
            <div class="panel-body">
                <div class="form-group">
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal_no_head" style="margin-left: 15px;">
                        <span class="fa fa-plus-square"></span>ДОБАВИТЬ
                    </a>
                </div>
            </div>
        <?endif;?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h3 class="panel-title">Все пользователи</h3>
                    </div>

                    <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                <tr>
                                    <th>ФИО</th>
                                    <th>Роль</th>
                                    <th>Почта</th>
                                    <th>Статус</th>
                                    <?if($current_user->id == 1):?>
                                        <th>Расширенный пользователь</th>
                                    <?endif;?>
                                    <?if($current_user->role == 1):?>
                                        <th width="120">Действия</th>
                                    <?endif;?>
                                </tr>
                                </thead>
                                <tbody>
                                <? foreach($data->getData() as $user):?>
                                    <tr>
                                        <td><strong><?= $user->name; ?></strong></td>
                                        <td><?= Users::getUserRole($user->id); ?></td>
                                        <td><?= $user->email; ?></td>
                                        <td><?= $user->active?'активен':'заблокирован'; ?></td>
                                        <?if($current_user->id == 1):?>
                                            <td><?= $user->detail?'да':'нет'; ?></td>
                                        <?endif;?>
                                        <?if($current_user->role == 1):?>
                                            <td>
                                                <a href="#" class="btn btn-default btn-condensed" data-toggle="modal" data-target="#edit_user<?= $user->id; ?>">
                                                    <span class="fa fa-pencil"></span>
                                                </a>
                                                <button type="button" class="mb-control btn btn-danger btn-condensed" data-box="#message-box-danger<?= $user->id; ?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </td>
                                        <?endif;?>
                                    </tr>
                                    <?if($current_user->role == 1):?>
                                        <div class="modal" id="edit_user<?= $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <h3>РЕДАКТИРОВАНИЕ ПОЛЬЗОВАТЕЛЯ</h3>
                                                        <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                                                            <div class="row">
                                                                <input type="hidden" value="<?= $user->id; ?>" name="user_id">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 control-label">ФИО</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" name="name" class="form-control" value="<?= $user->name; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="form-group push-up-15">
                                                                        <label class="col-md-3 control-label">Роль</label>
                                                                        <div class="col-md-9">
                                                                            <select class="form-control select" name="role">
                                                                                <option value="1" <? if($user->role == 1): ?> selected="selected" <? endif; ?>>Администрация</option>
                                                                                <option value="2" <? if($user->role == 2): ?> selected="selected" <? endif; ?>>Пользователь</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="form-group push-up-15">
                                                                        <label class="col-md-3 control-label">Статус</label>
                                                                        <div class="col-md-9">
                                                                            <select class="form-control select" name="active">
                                                                                <option value="1" <? if($user->active == 1): ?> selected="selected" <? endif; ?>>Активен</option>
                                                                                <option value="0" <? if($user->active == 0): ?> selected="selected" <? endif; ?>>Заблокирован</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <?if($current_user->id == 1):?>
                                                                        <div class="clearfix"></div>
                                                                        <div class="form-group push-up-15">
                                                                            <label class="col-md-3 control-label">Расширенный пользователь</label>
                                                                            <div class="col-md-9">
                                                                                <select class="form-control select" name="detail">
                                                                                    <option value="1" <? if($user->detail == 1): ?> selected="selected" <? endif; ?>>Да</option>
                                                                                    <option value="0" <? if($user->detail == 0): ?> selected="selected" <? endif; ?>>Нет</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    <?endif;?>
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

                                        <div class="message-box message-box-danger animated fadeIn" id="message-box-danger<?= $user->id; ?>">
                                            <div class="mb-container">
                                                <div class="mb-middle">
                                                    <div class="mb-title"><span class="fa fa-times"></span> Внимание!</div>
                                                    <div class="mb-content">
                                                        <p>Вы действительно хотите удалить <?= $user->name; ?> ?</p>
                                                    </div>
                                                    <div class="mb-footer">
                                                        <button class="btn btn-default btn-lg pull-right mb-control-close" style="margin-left: 10px;">Нет</button>
                                                        <a href="<?= $this->createUrl('/admin/users/delete', array('id' => $user->id));?>" class="btn btn-default btn-lg pull-right">Да</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?endif;?>
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

<?if($current_user->role == 1):?>
    <div class="modal" id="modal_no_head" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3>НОВЫЙ ПОЛЬЗОВАТЕЛЬ</h3>
                    <form role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ФИО</label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Роль</label>
                                    <div class="col-md-9">
                                        <select class="form-control select" name="role">
                                            <option value="1">Администрация</option>
                                            <option value="2">Пользователь</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Почта</label>
                                    <div class="col-md-9">
                                        <input type="text" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Пароль</label>
                                    <div class="col-md-9">
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Статус</label>
                                    <div class="col-md-9">
                                        <select class="form-control select" name="active">
                                            <option value="1">Активен</option>
                                            <option value="0">Заблокирован</option>
                                        </select>
                                    </div>
                                </div>
                                <? if(Yii::app()->user->id == Users::LIKE_BOSS): ?>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Расширенный пользователь</label>
                                        <div class="col-md-9">
                                            <select class="form-control select" name="detail">
                                                <option value="1">Да</option>
                                                <option value="0">Нет</option>
                                            </select>
                                        </div>
                                    </div>
                                <?else:?>
                                    <input type="hidden" name="detail" value="0">
                                <?endif;?>
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
<?endif;?>

<script>
    $(document).ready(function() {
        $('[name="date"]').datepicker({
            language: "ru"
        });
    });
</script>