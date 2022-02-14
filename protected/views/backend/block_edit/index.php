<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-select.js"></script>

<?
if($block->isNewRecord){
    $this->rightFrameTitle = 'Блок: Добавление';
    $this->pageTitle = 'Блок: Добавление';
}else{
    $this->rightFrameTitle = 'Блок: '.$block->name.': Редактирование';
    $this->pageTitle = 'Блок: '.$block->name.': Редактирование';
}

$this->breadcrumbs=array(
    'Блоки' => array('/admin/block'),
    $block->isNewRecord?'Создание нового блока ':''.$block->name
);
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-primary" href="<?= $this->createUrl('/admin/block');?>">
                    <span class="fa fa-arrow-circle-left"></span>Блоки
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="page-tabs">
            <a href="#info" class="active">Блок</a>
            <a href="#elements_settings">Настройки элементов</a>
            <a href="#sections_settings">Настройки разделов</a>
            <a href="#shop">Торговый каталог</a>
            <a href="#signature">Подписи сущностей</a>
            <?if(Users::isDetail(Yii::app()->user->id)):?>
                <a href="#seo">SEO</a>
            <?endif;?>
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
                        <h3 class="panel-title"><strong>Основная информация</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Блок активен</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[active]" value="1" <?if($block->active == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Название</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[name]" value="<?=$block->name?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Символьный код</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[code]" value="<?=$block->code?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Сортировка</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sort]" value="<?=$block->sort?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">URL страницы блока:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[list_page_url]" value="<?=$block->list_page_url?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">URL страницы детального просмотра:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[detail_page_url]" value="<?=$block->detail_page_url?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Изображение</label>
                            <div class="col-md-6 col-xs-12">
                                <?=CHtml::activeFileField($block,'picture',
                                    array('class' => 'fileinput btn-primary',
                                        'id' => 'filename',
                                        'data-filename-placement'=>"inside",
                                        'title' => "Выбрать файл",
                                    )); ?>
                            </div>
                            <?if($block->picture):?>
                                <div class="form-group">
                                    <div class="col-md-4 col-xs-12"></div>
                                    <div class="col-md-8 col-xs-12">
                                        <div></div>
                                        <img style="width:200px; margin-right:10px" src="<?=Files::getPath($block->picture)?>">
                                        <a href="<?=$this->createUrl('admin/block_edit', array('id' => $block->id, 'action' => 'remove_picture'))?>" title="Удалить изображение" style="vertical-align: top" class="delete-confirm buffer-width-10 mgt">
                                            <i class="fa fa-times text-danger"></i>
                                        </a>
                                    </div>
                                </div>
                            <?endif;?>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label" for="description">Описание блока</label>
                            <div class="col-md-6 col-xs-12">
                                <textarea id="description" class="form-control" name="block[description]" rows="7"><?=$block->description?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content-wrap page-tabs-item" id="elements_settings">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Настройки элементов блока</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Тэги</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[is_tag]" value="1" <?if($block->is_tag == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Картинка для анонса</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[is_element_preview_picture]" value="1" <?if($block->is_element_preview_picture == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Подсказка для картинки анонса:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[preview_picture_hint]" value="<?=$block->preview_picture_hint?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Описание для анонса</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[is_element_preview_text]" value="1" <?if($block->is_element_preview_text == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Детальная картинка</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[is_element_detail_picture]" value="1" <?if($block->is_element_detail_picture == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Подсказка для детальной картинки:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[detail_picture_hint]" value="<?=$block->detail_picture_hint?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Детальное описание</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[is_element_detail_text]" value="1" <?if($block->is_element_detail_text == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Визивиг для детального описания</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[is_element_detail_text_html]" value="1" <?if($block->is_element_detail_text_html == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Галерея</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[is_element_gallery]" value="1" <?if($block->is_element_gallery == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Популярность</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[is_element_popular]" value="1" <?if($block->is_element_popular == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Название опции "Популярность":</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[popular_option_name]" value="<?=$block->popular_option_name?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Прикрепление файла</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[is_file]" value="1" <?if($block->is_file == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Показывать поле ввода начала активности</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[is_active_from]" value="1" <?if($block->is_active_from == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Показывать поле ввода окончания активности</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[is_active_to]" value="1" <?if($block->is_active_to == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content-wrap page-tabs-item" id="sections_settings">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Настройки разделов блока</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Создавать разделы в блоке</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[is_sections]" value="1" <?if($block->is_sections == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Подсказка для картинки раздела:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[section_picture_hint]" value="<?=$block->section_picture_hint?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Подсказка для детальной картинки раздела:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[section_detail_picture_hint]" value="<?=$block->section_detail_picture_hint?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content-wrap page-tabs-item" id="shop">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Настройки торгового каталога</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Является торговым каталогом</label>
                            <div class="col-md-6 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox1" name="block[is_shop]" value="1" <?if($block->is_shop == 'Y'):?>checked="checked"<?endif;?>/></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content-wrap page-tabs-item" id="signature">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Подписи сущностей</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Разделы:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_sections_name]" value="<?=$block->sign_sections_name?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Раздел:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_section_name]" value="<?=$block->sign_section_name?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Добавить раздел:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_section_add]" value="<?=$block->sign_section_add?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Изменить раздел:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_section_edit]" value="<?=$block->sign_section_edit?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Удалить раздел:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_section_delete]" value="<?=$block->sign_section_delete?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Элементы:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_elements_name]" value="<?=$block->sign_elements_name?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Элемент:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_element_name]" value="<?=$block->sign_element_name?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Добавить элемент:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_element_add]" value="<?=$block->sign_element_add?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Изменить элемент:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_element_edit]" value="<?=$block->sign_element_edit?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Удалить элемент:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_element_delete]" value="<?=$block->sign_element_delete?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Описание для анонса:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_element_preview_text_name]" value="<?=$block->sign_element_preview_text_name?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Детальное описание:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_element_detail_text_name]" value="<?=$block->sign_element_detail_text_name?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Картинка для анонса:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_element_preview_picture_name]" value="<?=$block->sign_element_preview_picture_name?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Детальная картинка:</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[sign_element_detail_picture_name]" value="<?=$block->sign_element_detail_picture_name?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?if(Users::isDetail(Yii::app()->user->id)):?>
                <div class="page-content-wrap page-tabs-item" id="seo">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Настройка SEO-информации</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">H1 Header</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[meta_h1]" value="<?=$block->meta_h1?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">META Title</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[meta_title]" value="<?=$block->meta_title?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">META Keywords</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[meta_keywords]" value="<?=$block->meta_keywords?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">META Description</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control" name="block[meta_description]" value="<?=$block->meta_description?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?endif;?>
                <div class="panel-footer">
                    <button class="btn btn-primary">Сохранить</button>
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