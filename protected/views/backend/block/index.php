<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-select.js"></script>

<? // die();?>

<? $this->rightFrameTitle = 'Блоки';
$this->breadcrumbs=array(
    'Блоки'
);
?>

<div class="page-content-wrap">
    <div class="row-content">
        <div class="panel-body">
            <div class="form-group">
                <a class="btn btn-primary" href="<?=$this->createUrl("admin/block_edit", array('id' => 0));?>" style="margin-left: 15px;">
                    <span class="fa fa-plus-square"></span>ДОБАВИТЬ БЛОК
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Блоки</h3>
                    </div>
                    <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Акт.</th>
                                    <th>ID</th>
                                    <th width="120">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <? foreach($data->getData() as $block):?>
                                    <tr>
                                        <td><?=$block->name;?></td>
                                        <td style="width:50px"><?if($block->active == 'Y'):?>Да<?else:?>Нет<?endif;?></td>
                                        <td style="width:70px"><?=$block->id;?></td>

                                        <td>
                                            <a href="<?=$this->createUrl("admin/block_edit", array('id' => $block->id));?>" class="btn btn-default btn-condensed">
                                                <span class="fa fa-pencil"></span>
                                            </a>
                                            <?if(Block::isEmpty($block->id)):?>
                                                <button type="button" class="mb-control btn btn-danger btn-condensed" data-box="#message-box-danger_<?=$block->id;?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            <?endif;?>
                                        </td>
                                    </tr>
                                    <?if(Block::isEmpty($block->id)):?>
                                        <div class="message-box message-box-danger animated fadeIn" id="message-box-danger_<?=$block->id;?>">
                                            <div class="mb-container">
                                                <div class="mb-middle">
                                                    <div class="mb-title"><span class="fa fa-times"></span> Внимание!</div>
                                                    <div class="mb-content">
                                                        <p>Вы действительно хотите удалить <?=$block->name;?> ?</p>
                                                    </div>
                                                    <div class="mb-footer">
                                                        <button class="btn btn-default btn-lg pull-right mb-control-close" style="margin-left: 10px;">Нет</button>
                                                        <a href="<?= $this->createUrl('/admin/block/delete', array('id' => $block->id));?>" class="btn btn-default btn-lg pull-right">Да</a>
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