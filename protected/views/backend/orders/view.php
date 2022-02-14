<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-select.js" xmlns="http://www.w3.org/1999/html"></script>
<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-file-input.js"></script>

<? $this->rightFrameTitle = 'Заказ ID '.$order->id;
$this->breadcrumbs = array(
    'Заказы' => array('/admin/orders'),
    'ID '.$order->id
);
?>

<form method="post" class="form-horizontal" enctype="multipart/form-data" id="main">
    <div class="row">
        <div class="page-content-wrap page-tabs-item active" id="element">
            <? // Блок ТЕКСТОВЫЙ ?>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Заголовок</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label" for="element-name">Имя</label>
                            <div class="col-md-9 col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input id="element-name" type="text" class="form-control" name="order[name]" value='<?=$order->name?>' />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label" for="element-name">E-mail</label>
                            <div class="col-md-9 col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input id="element-name" type="text" class="form-control" name="order[email]" value='<?=$order->email?>' />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label" for="element-name">Телефон</label>
                            <div class="col-md-9 col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input id="element-name" type="text" class="form-control" name="order[phone]" value='<?=$order->phone?>' />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label" for="element-name">Продукт</label>
                            <div class="col-md-9 col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input id="element-name" type="text" class="form-control" name="order[product]" value='<?=$order->product?>' />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label" for="element-name">Тираж</label>
                            <div class="col-md-9 col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input id="element-name" type="text" class="form-control" name="order[tirazh]" value='<?=$order->tirazh?>' />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label" for="element-name">Способ оплаты</label>
                            <div class="col-md-9 col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input id="element-name" type="text" class="form-control" name="order[payment_method]" value='<?=$payment_method?>' />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label" for="preview-text">Техническое задание</label>
                            <div class="col-md-9 col-xs-7">
                                <textarea id="preview-text" class="form-control" name="element[preview_text]" rows="10"><?=$order->technical_task?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label" for="preview-text">Дополнительная информация</label>
                            <div class="col-md-9 col-xs-7">
                                <textarea id="preview-text" class="form-control" name="element[preview_text]" rows="5"><?=$order->additional_info?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="page-content-wrap">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Файлы</strong></h3>
                        </div>
                        <div class="panel-body form-group-separated">
                            <?if($order->maket):?>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <a target="_blank" href="<?=Files::getPath($order->maket)?>">Макет</a>
                                    </div>
                                </div>
                            <?endif;?>
                            <?if($order->billing_details):?>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <a target="_blank" href="<?=Files::getPath($order->billing_details)?>">Реквизиты для выставления счета</a>
                                    </div>
                                </div>
                            <?endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>