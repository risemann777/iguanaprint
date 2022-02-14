<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-select.js" xmlns="http://www.w3.org/1999/html"></script>
<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-file-input.js"></script>

<? $this->rightFrameTitle = 'Заказы';
$this->breadcrumbs = array(
    'Заказы'
);
?>

<div class="row-content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body panel-body-table">
                    <?if($orders->totalItemCount > 0):?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                <tr>
                                    <th width="90">ID</th>
                                    <th>Имя</th>
                                    <th>E-mail</th>
                                    <th>Телефон</th>
                                    <th width="150">Дата</th>
                                    <th width="150">Тип</th>
                                    <th width="100">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?foreach ($orders->getData() as $item):?>
                                        <tr>
                                            <td><?=$item->id?></td>
                                            <td><?=$item->name?></td>
                                            <td><?=$item->email?></td>
                                            <td><?=$item->phone?></td>
                                            <td><? echo Yii::app()->dateFormatter->format('dd MMMM yyyy kk:mm', $item->timestamp_x) ?></td>
                                            <td>
                                                <?if($item->type == 'order'){
                                                    echo 'Заказ продукта';
                                                }elseif ($item->type == 'calc'){
                                                    echo 'Расчет стоимости';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a title="Подробная информация" href="<?=$this->createUrl('/admin/orders/view', array('id' => $item->id))?>" class="btn btn-default btn-condensed">
                                                    <span class="fa fa-info-circle"></span>
                                                </a>
                                                <button title="Удалить" type="button" class="mb-control btn btn-danger btn-condensed" data-box="#message-box-danger-<?=$item->id;?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?endforeach;?>
                                </tbody>
                            </table>
                         </div>
                    <?endif;?>
                </div>
                <div class="panel-footer"><? $this->renderPartial('../common/_pagination', array('data' => $orders));?></div>
            </div>
        </div>
    </div>
</div>

<?if($orders->totalItemCount > 0):?>
    <?foreach ($orders->getData() as $item):?>
        <div class="message-box message-box-danger animated fadeIn" id="message-box-danger-<?=$item->id;?>">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Внимание!</div>
                    <div class="mb-content">
                        <p>Вы действительно хотите удалить заказ № <?=$item->id;?> ?</p>
                    </div>
                    <div class="mb-footer">
                        <button class="btn btn-default btn-lg pull-right mb-control-close" style="margin-left: 10px;">Нет</button>
                        <a href="<?= $this->createUrl('/admin/orders/delete', array('id' => $item->id));?>" class="btn btn-default btn-lg pull-right">Да</a>
                    </div>
                </div>
            </div>
        </div>
    <?endforeach;?>
<?endif;?>
