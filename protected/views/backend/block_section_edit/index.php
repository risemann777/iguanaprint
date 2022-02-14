<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type='text/javascript' src='/js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-select.js"></script>

<?
$action = $arResult['section']->isNewRecord ? $block->sign_section_add : $block->sign_section_edit;
$this->pageTitle = $block->name.': '.$block->sign_section_name.': '.$action;
$this->rightFrameTitle = $block->name.': '.$block->sign_section_name.': '.$action;
$this->breadcrumbs = BlockSection::getBreadcrumbArray($block->id, $_REQUEST['find_section']);
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-primary" href="<?= $this->createUrl('/admin/block_list', array('block_id' => $_REQUEST['block_id'], 'find_section' => $_REQUEST['find_section']));?>">
                    <span class="fa fa-arrow-circle-left"></span><?echo $block->sign_sections_name;?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="page-tabs">
            <a href="#info" class="active">Раздел</a>
            <? if(Users::isDetail(Yii::app()->user->id)): ?>
                <a href="#seo" class="">SEO</a>
            <? endif; ?>
        </div>
    </div>
</div>

<form method="post" class="form-horizontal" enctype="multipart/form-data" id="main">
    <input type="hidden" name="section[block_id]" value="<?=$block->id?>">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="page-content-wrap page-tabs-item active" id="info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><?= !$arResult['section']->isNewRecord ? $block->sign_section_edit : $block->sign_section_add; ?></strong></h3>
                    </div>
                    <div class="panel-body">
                        <?if($current_user->role == 1):?>
                            <?if(!$arResult['section']->isNewRecord):?>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Создана:</label>
                                    <div class="col-md-6 col-xs-12">
                                        <label class="check"><?=$arResult['section']->date_create?> (<?=Users::model()->findByPk($arResult['section']->created_by)->name;?>) [<?=$arResult['section']->created_by?>]</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Изменена:</label>
                                    <div class="col-md-6 col-xs-12">
                                        <label class="check"><?=$arResult['section']->timestamp_x?> (<?=Users::model()->findByPk($arResult['section']->modified_by)->name;?>) [<?=$arResult['section']->modified_by?>]</label>
                                    </div>
                                </div>
                            <?endif;?>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Раздел активен</label>
                                <div class="col-md-6 col-xs-12">
                                    <label class="check"><input type="checkbox" class="icheckbox1" name="section[active]" value="1" <?if($arResult['section']->active == 'Y'):?>checked="checked"<?endif;?>/></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Родительский раздел</label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control select" name="section[block_section_id]">
                                        <option value="0">Верхний уровень</option>
                                        <?foreach($arResult['sections'] as $obSection):?>
                                            <?
                                            if(intval($arResult['section']->block_section_id) > 0){
                                                $comSection = $arResult['section']->block_section_id;
                                            }else{
                                                $comSection = $_REQUEST['find_section'];
                                            }
                                            if($obSection->id == $comSection){
                                                $selected_parent_section = 'selected';
                                            }else{
                                                $selected_parent_section = '';
                                            }
                                            ?>
                                            <option <?=$selected_parent_section?> value="<?=$obSection->id?>">
                                                <?
                                                $depth_level = $obSection->depth_level;
                                                while($depth_level){
                                                    echo '. ';
                                                    $depth_level -= 1;
                                                }
                                                ?>
                                                <?=$obSection->name?>
                                            </option>
                                        <?endforeach;?>
                                    </select>
                                </div>
                            </div>
                        <?endif;?>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Название</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="section[name]" value="<?=$arResult['section']->name?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Сортировка</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-sort"></span></span>
                                    <input type="text" size="7" class="form-control" name="section[sort]" value="<?=$arResult['section']->sort?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Изображение</label>
                            <div class="col-md-6 col-xs-12">
                                <?/*?><input type="file" class="fileinput btn-primary" name="section_picture" id="filename" title="Browse file"/><?*/?>

                                <?=CHtml::activeFileField($arResult['section'],'section_picture',
                                    array('class' => 'fileinput btn-primary',
                                        'id' => 'filename',
                                        'data-filename-placement'=>"inside",
                                        'title' => "Выбрать файл",
                                    )); ?>

                                <?if($block->section_picture_hint):?>
                                    <small><?echo $block->section_picture_hint?></small>
                                <?endif;?>
                            </div>
                        </div>
                        <?if($arResult['section']->picture):?>
                            <div class="form-group">
                                <div class="col-md-3 col-xs-12"></div>
                                <div class="col-md-6 col-xs-12">
                                    <img style="width:200px; margin-right:10px" src="<?=Files::getPath($arResult['section']->picture)?>">
                                </div>
                            </div>
                        <?endif;?>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Описание</label>
                            <div class="col-md-6 col-xs-12">
                                <textarea class="form-control summernote" name="section[description]" rows="15"><?=$arResult['section']->description?></textarea>
                            </div>
                        </div>
                        <?if($current_user->role == 1):?>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Символьный код</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-code"></span></span>
                                        <input type="text" size="7" class="form-control" name="section[code]" value="<?=$arResult['section']->code?>"/>
                                    </div>
                                </div>
                            </div>
                        <?endif;?>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Детальная картинка</label>
                            <div class="col-md-6 col-xs-12">
                                <?/*?><input type="file" class="fileinput btn-primary" name="section_detail_picture" id="filename" title="Browse file"/><?*/?>


                                <?=CHtml::activeFileField($arResult['section'],'section_detail_picture',
                                    array('class' => 'fileinput btn-primary',
                                        'id' => 'filename',
                                        'data-filename-placement'=>"inside",
                                        'title' => "Выбрать файл",
                                    )); ?>


                                <?if($block->section_detail_picture_hint):?>
                                    <small><?echo $block->section_detail_picture_hint?></small>
                                <?endif;?>
                            </div>
                        </div>
                        <?if($arResult['section']->detail_picture):?>
                            <div class="form-group">
                                <div class="col-md-3 col-xs-12"></div>
                                <div class="col-md-6 col-xs-12">
                                    <img style="width:200px; margin-right:10px" src="<?=Files::getPath($arResult['section']->detail_picture)?>">
                                </div>
                            </div>
                        <?endif;?>
                    </div>
                </div>
                <? if(Users::isDetail(Yii::app()->user->id)): ?>
                <div class="page-content-wrap page-tabs-item" id="seo">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Настройка SEO информации</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Header H1</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="section[meta_h1]" value="<?=$arResult['section']->meta_h1?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">META Title</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="section[meta_title]" value="<?=$arResult['section']->meta_title?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">META Keywords</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="section[meta_keywords]" value="<?=$arResult['section']->meta_keywords?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">META Description</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="section[meta_description]" value="<?=$arResult['section']->meta_description?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <? endif; ?>
                <div class="panel-footer">
                    <button class="btn btn-primary">Сохранить</button>
                    <button class="btn btn-default pull-right">Очистить форму</button>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    $(function(){
        if($(".icheckbox1").length > 0){
            $(".icheckbox1").iCheck({checkboxClass: 'icheckbox_minimal-grey'});
        }
    });
</script>