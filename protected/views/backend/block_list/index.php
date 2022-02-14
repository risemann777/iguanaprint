<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-file-input.js"></script>

<?
$this->pageTitle = $block->name.': '.$block->sign_sections_name;
$this->rightFrameTitle = $block->name.': '.$block->sign_sections_name;
$this->breadcrumbs = BlockSection::getBreadcrumbArray($block->id, $arResult['section_id']);
?>

<div class="page-content-wrap">
    <div class="row-content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a class="btn btn-primary" href="<?= $this->createUrl('/admin/block_element_edit', array('block_id' => $block->id, 'id' => 0, 'block_section_id' => $arResult['section_id'], 'find_section' => $arResult['section_id']));?>"  style="margin-left: 15px;">
                            <span class="fa fa-plus-square"></span><?echo $block->sign_element_add;?>
                        </a>
                        <?if($block->is_sections == 'Y'):?>
                            <a class="btn btn-default" href="<?= $this->createUrl('/admin/block_section_edit', array('block_id' => $block->id, 'id' => 0, 'block_section_id' => $arResult['section_id'], 'find_section' => $arResult['section_id']));?>"  style="margin-left: 15px;">
                                <?echo $block->sign_section_add;?>
                            </a>
                            <?if(intval($_REQUEST['find_section']) > 0):?>
                                <a class="btn btn-default" href="<?= $this->createUrl('/admin/block_list', array('block_id' => $block->id, 'find_section' => 0));?>"  style="margin-left: 15px;">
                                    Верхний уровень
                                </a>
                            <?endif;?>
                        <?endif;?>
                    </div>
                    <div class="panel-body panel-body-table">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions">
                                <thead>
                                    <tr>
                                        <?if($block->is_element_preview_picture == "Y"):?>
                                            <th width="120">Изображение</th>
                                        <?endif;?>
                                        <th>Название</th>
                                        <?if($block->is_active_from == 'Y'):?>
                                            <th width="120">Дата начала активности</th>
                                        <?endif;?>
                                        <?if($block->is_active_to == 'Y'):?>
                                            <th width="120">Дата окончания активности</th>
                                        <?endif;?>
                                        <?if($block->is_element_popular == 'Y'):?>
                                            <th width="120"><?=$block->popular_option_name?></th>
                                        <?endif;?>
                                        <th width="120">Сортировка</th>
                                        <th width="120">Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?if(!isset($_REQUEST['page'])):?>
                                    <?foreach($arResult['sections']->getData() as $item):?>
                                        <tr>
                                            <?if($block->is_element_preview_picture == "Y"):?>
                                                <td class="picture">
                                                    <?if($item->picture):?>
                                                        <img style="width: 100%" src="<?=Files::getPath($item->picture)?>">
                                                    <?endif;?>
                                                </td>
                                            <?endif;?>
                                            <td><a href="<?=$this->createUrl('admin/block_list', array('block_id' => $block->id, 'find_section' => $item->id))?>"><span class="fa fa-folder"></span>&nbsp;&nbsp;<?=$item->name?></a></td>
                                            <?if($block->is_active_from == 'Y'):?>
                                                <th class="active-from" width="120"></th>
                                            <?endif;?>
                                            <?if($block->is_active_to == 'Y'):?>
                                                <th class="active-to" width="120"></th>
                                            <?endif;?>
                                            <?if($block->is_element_popular == 'Y'):?>
                                                <td></td>
                                            <?endif;?>
                                            <td><?=$item->sort?></td>
                                            <td>
                                                <?if($current_user->role == 1):?>
                                                    <a href="<?= $this->createUrl('/admin/block_section_edit', array('block_id' => $block->id, 'id' => $item->id, 'find_section' => $arResult['section_id']));?>" class="btn btn-default btn-condensed">
                                                        <span class="fa fa-pencil"></span>
                                                    </a>
                                                    <?if(BlockSection::isEmpty($item->id)):?>
                                                        <button type="button" class="mb-control btn btn-danger btn-condensed" data-box="#message-box-danger-section-<?= $item->id; ?>">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
                                                    <?endif;?>
                                                <?endif;?>
                                            </td>
                                        </tr>
                                    <?endforeach;?>
                                <?endif;?>
                                <?foreach($arResult['elements']->getData() as $item):?>
                                    <tr>
                                        <?if($block->is_element_preview_picture == "Y"):?>
                                            <td>
                                                <?if($item->preview_picture):?>
                                                    <img style="width: 100%" src="<?=Files::getPath($item->preview_picture)?>">
                                                <?endif;?>
                                            </td>
                                        <?endif;?>

                                        <td><a href="<?= $this->createUrl('/admin/block_element_edit', array('block_id' => $block->id, 'id' => $item->id, 'find_section' => $arResult['section_id']));?>"><?=$item->name?></a></td>

                                        <?if($block->is_active_from == 'Y'):?>
                                            <td><?=Yii::app()->dateFormatter->format("dd-MM-yyyy", $item->active_from)?></td>
                                        <?endif;?>

                                        <?if($block->is_active_to == 'Y'):?>
                                            <td><?=Yii::app()->dateFormatter->format("dd-MM-yyyy", $item->active_to)?></td>
                                        <?endif;?>

                                        <?if($block->is_element_popular == 'Y'):?>
                                            <td>
                                                <?if($item->is_popular == 'Y'):?><span class="fa fa-circle" style="color:#57A9A8; font-size: 16px;"></span><?endif;?>
                                            </td>
                                        <?endif;?>

                                        <td><?=$item->sort?></td>
                                        <td>
                                            <a href="<?= $this->createUrl('/admin/block_element_edit', array('block_id' => $block->id, 'id' => $item->id, 'find_section' => $arResult['section_id']));?>" class="btn btn-default btn-condensed">
                                                <span class="fa fa-pencil"></span>
                                            </a>
                                            <button type="button" class="mb-control btn btn-danger btn-condensed" data-box="#message-box-danger-element-<?=$item->id;?>">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer"><? $this->renderPartial('../common/_pagination', array('data' => $arResult['elements']));?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?foreach($arResult['sections']->getData() as $item):?>
    <div class="message-box message-box-danger animated fadeIn" id="message-box-danger-section-<?=$item->id;?>">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-times"></span> Внимание!</div>
                <div class="mb-content">
                    <p>Вы действительно хотите удалить <?= $item->name; ?> ?</p>
                </div>
                <div class="mb-footer">
                    <button class="btn btn-default btn-lg pull-right mb-control-close" style="margin-left: 10px;">Нет</button>
                    <a href="<?= $this->createUrl('/admin/block_list', array('block_id' => $block->id, 'find_section' => $arResult['section_id'], 'id' => $item->id, 'action' => 'remove', 'type' => 'section'));?>" class="btn btn-default btn-lg pull-right">Да</a>
                </div>
            </div>
        </div>
    </div>
<?endforeach;?>

<?foreach($arResult['elements']->getData() as $item):?>
    <div class="message-box message-box-danger animated fadeIn" id="message-box-danger-element-<?=$item->id;?>">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="fa fa-times"></span> Внимание!</div>
                <div class="mb-content">
                    <p>Вы действительно хотите удалить <?= $item->name; ?> ?</p>
                </div>
                <div class="mb-footer">
                    <button class="btn btn-default btn-lg pull-right mb-control-close" style="margin-left: 10px;">Нет</button>
                    <a href="<?= $this->createUrl('/admin/block_list', array('block_id' => $block->id, 'find_section' => $arResult['section_id'], 'id' => $item->id, 'action' => 'remove', 'type' => 'element'));?>" class="btn btn-default btn-lg pull-right">Да</a>
                </div>
            </div>
        </div>
    </div>
<?endforeach;?>
