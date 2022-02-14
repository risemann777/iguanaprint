<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type='text/javascript' src='/js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="/js/plugins/bootstrap/bootstrap-select.js"></script>

<?
$this->pageTitle = $element->isNewRecord?$block->sign_element_name.': Добавление': ' '.$block->sign_element_name.': '.$element->name.' - Редактирование';
$this->rightFrameTitle = $block->name;

$this->breadcrumbs = BlockSection::getBreadcrumbArray($block->id, $_REQUEST['find_section']);
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class="btn btn-primary" href="<?= $this->createUrl('/admin/block_list', array('block_id' => $_REQUEST['block_id'], 'find_section' => $_REQUEST['find_section']));?>">
                    <span class="fa fa-arrow-circle-left"></span><?echo $block->sign_elements_name;?>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="page-tabs">
            <a href="#element" class="active">Основная информация</a>
            <? if(Users::isDetail(Yii::app()->user->id)): ?>
                <a href="#seo" class="">SEO</a>
            <? endif; ?>
        </div>
    </div>
</div>

<form method="post" class="form-horizontal" enctype="multipart/form-data" id="main">
    <input type="hidden" name="element[block_id]" value="<?=$block->id?>">
    <div class="row">
        <? // Вкладка "Основная информация" ?>
        <div class="page-content-wrap page-tabs-item active" id="element">
            <? // Блок ТЕКСТОВЫЙ ?>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong><?echo $element->isNewRecord ? $block->sign_element_name.': Добавление' : $block->sign_element_name.': '.$element->name.' - Редактирование';?></strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label" for="element-name">Название</label>
                            <div class="col-md-8 col-xs-7">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input id="element-name" type="text" class="form-control" name="element[name]" value='<?=$element->name?>' required />
                                </div>
                            </div>
                        </div>
                        <?if($block->is_active_from == 'Y'):?>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label" for="active-from">Дата начала публикации</label>
                            <div class="col-md-8 col-xs-7"> 
                                <input id="active-from" type="text" class="form-control datepicker" name="element[active_from]" value="<?=Yii::app()->dateFormatter->format("yyyy-MM-dd", $element->active_from)?>" />
                            </div>
                        </div>
                        <?endif;?>
                        <?if($block->is_active_to == 'Y'):?>
                        <div class="form-group">
                            <label class="col-md-4 col-xs-5 control-label" for="active-to">Дата окончания публикации</label>
                            <div class="col-md-8 col-xs-7">
                                <input id="active-to" type="text" class="form-control datepicker" name="element[active_to]" value="<?=Yii::app()->dateFormatter->format("yyyy-MM-dd", $element->active_to)?>" />
                            </div>
                        </div>
                        <?endif;?>
                        <?if($block->is_sections == 'Y'):?>
                            <div class="form-group">
                                <label class="col-md-4 col-xs-5 control-label">Раздел</label>
                                <div class="col-md-8 col-xs-7">
                                    <select class="form-control select" size="15" name="element[block_section_id][]">
                                        <? //  if($current_user->role == 1):?>
                                            <option <?if($selected_sections[0] == 0):?>selected<?endif;?> value="0">Верхний уровень</option>
                                        <? // endif;?>
                                        <?foreach($sections as $obSection):?>
                                            <option <?if(in_array($obSection->id, $selected_sections)):?>selected<?endif;?> value="<?=$obSection->id?>">
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
                        <?if($block->is_tag == 'Y'):?>
                            <div class="form-group">
                                <label class="col-md-4 col-xs-5 control-label">Тэги</label>
                                <div class="col-md-8 col-xs-7">
                                    <select multiple class="form-control select" name="element[tags][]">
                                        <?foreach($tags as $tag):?>
                                            <?//  var_dump($tag)?>
                                            <option <?if(in_array($tag->id, $selectedTags)):?>selected<?endif;?> value="<?=$tag->id?>"><?=$tag->name?></option>
                                        <?endforeach;?>
                                    </select>
                                </div>
                            </div>
                        <?endif;?>
                        <? // if($block->id !=2):?>
                            <div class="form-group">
                                <label class="col-md-4 col-xs-5 control-label" for="sort">Сортировка</label>
                                <div class="col-md-8 col-xs-7">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-sort"></span></span>
                                        <input id="sort" type="text" size="7" class="form-control" name="element[sort]" value="<?=$element->sort?>"/>
                                    </div>
                                </div>
                            </div>
                        <? // endif;?>

                        <?if($block->is_element_popular == "Y"):?>
                            <div class="form-group">
                                <label class="col-md-4 col-xs-5 control-label"><?=$block->popular_option_name?></label>
                                <div class="col-md-8 col-xs-7">
                                    <label class="check"><input type="checkbox" class="icheckbox1" name="element[is_popular]" value="1" <?if($element->is_popular == 'Y'):?>checked="checked"<?endif;?>/></label>
                                </div>
                            </div>
                        <?endif;?>

                        <? // ЦЕНА ?>
                        <?if($block->is_shop == "Y"):?>
                            <div class="form-group">
                                <label class="col-md-4 col-xs-5 control-label" for="price">Цена</label>
                                <div class="col-md-8 col-xs-7">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                        <input id="price" type="text" class="form-control" name="element[price]" size="30" value="<?=$element->price?>" />
                                    </div>
                                </div>
                            </div>
                        <?endif;?>

                        <? // PREVIEW TEXT ?>
                        <?if($block->is_element_preview_text == "Y"):?>
                            <div class="form-group">
                                <label class="col-md-4 col-xs-5 control-label" for="preview-text"><?=$block->sign_element_preview_text_name?></label>
                                <div class="col-md-8 col-xs-7">
                                    <textarea id="preview-text" class="form-control" name="element[preview_text]" rows="7"><?=$element->preview_text?></textarea>
                                </div>
                            </div>
                        <?endif;?>

                        <? // DETAIL TEXT ?>
                        <?if($block->is_element_detail_text == "Y"):?>
                            <div class="form-group">
                                <label class="col-md-4 col-xs-5 control-label" for="detail-text"><?=$block->sign_element_detail_text_name?></label>
                                <div class="col-md-8 col-xs-7">
                                    <textarea id="detail-text" class="form-control <?if($block->is_element_detail_text_html == 'Y'):?>summernote<?endif;?>" name="element[detail_text]" rows="15"><?=$element->detail_text?></textarea>
                                </div>
                            </div>
                        <?endif;?>

                        <?if(!empty($properties)): // у Блока есть свойства ?>
                            <? // echo '<pre>'; print_r($properties); echo '</pre>';?>

                            <? // обойдем свойства элемента ?>
                            <?foreach($properties as $property):?>
                                <?
                                // выбираю значение свойства элемента
                                $criteria = new CDbCriteria(array(
                                    'condition'=>'block_property_id=:block_property_id AND block_element_id=:block_element_id',
                                    'params'=>array(':block_property_id' => $property->id, ':block_element_id' => $element->id),
                                ));
                                $blockElementProperties = BlockElementProperty::model()->findAll($criteria);
                                ?>
                                <div class="form-group">
                                    <label class="col-md-4 col-xs-5 control-label"><?=$property->name?></label>
                                    <div class="col-md-8 col-xs-7">
                                        <div class="input-group">

                                            <? // свойство типа - Строка?>
                                            <?if($property->property_type == 'S'):?>

                                                <? // строка одинарная ?>
                                                <?if($property->multiple == 'N'):?>
                                                    <?if($property->user_type == 'HTML'):?>
                                                        <div class="form-group">
                                                            <?if(!empty($blockElementProperties)):?>
                                                                <textarea rows="<?=$property->row_count?>" cols="<?=$property->col_count?>" class="form-control<?if($property->is_html == 'Y'):?> summernote<?endif;?>" name="prop[<?=$property->id?>][<?=$blockElementProperties[0]->id?>]"><?=$blockElementProperties[0]->value?></textarea>
                                                            <?else:?>
                                                                <textarea rows="<?=$property->row_count?>" cols="<?=$property->col_count?>" class="form-control<?if($property->is_html == 'Y'):?> summernote<?endif;?>" name="prop[<?=$property->id?>][n0]"></textarea>
                                                            <?endif;?>
                                                        </div>
                                                    <?else:?>
                                                        <span class="input-group-addon"></span>
                                                        <?if(!empty($blockElementProperties)):?>
                                                            <?// echo '<pre>'; print_r($blockElementProperty); echo '</pre>';?>
                                                            <input type="text" size="7" class="form-control" name="prop[<?=$property->id?>][<?=$blockElementProperties[0]->id?>]" value="<?=$blockElementProperties[0]->value?>"/>
                                                        <?else:?>
                                                            <input type="text" size="7" class="form-control" name="prop[<?=$property->id?>][n0]" value=""/>
                                                        <?endif;?>
                                                    <?endif;?>
                                                <?endif;?>

                                                <? // строка множественная ?>
                                                <?if($property->multiple == 'Y'):?>
                                                    <?if($property->user_type == 'HTML'):?>
                                                        <? // Сначала выведем уже заполненные значения множественного свойства?>
                                                        <?if(!empty($blockElementProperties)):?>
                                                            <?foreach($blockElementProperties as $blockElementProperty):?>
                                                                <div class="form-group">
                                                                    <textarea rows="<?=$property->row_count?>" cols="<?=$property->col_count?>" class="form-control<?if($property->is_html == 'Y'):?> summernote<?endif;?>" name="prop[<?=$property->id?>][<?=$blockElementProperty->id?>]"><?=$blockElementProperty->value?></textarea>
                                                                </div>
                                                            <?endforeach;?>
                                                        <?endif;?>
                                                        <? // после несколько пустых полей для заполнения новыми значениями ?>
                                                        <div class="form-group">
                                                            <textarea rows="<?=$property->row_count?>" cols="<?=$property->col_count?>" class="form-control" name="prop[<?=$property->id?>][n0]"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea rows="<?=$property->row_count?>" cols="<?=$property->col_count?>" class="form-control" name="prop[<?=$property->id?>][n1]"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea rows="<?=$property->row_count?>" cols="<?=$property->col_count?>" class="form-control" name="prop[<?=$property->id?>][n2]"></textarea>
                                                        </div>
                                                    <?else:?>
                                                        <? // Сначала выведем уже заполненные значения множественного свойства?>
                                                        <?if(!empty($blockElementProperties)):?>
                                                            <?foreach($blockElementProperties as $blockElementProperty):?>
                                                                <input type="text" size="7" class="form-control" name="prop[<?=$property->id?>][<?=$blockElementProperty->id?>]" value="<?=$blockElementProperty->value?>"/>
                                                            <?endforeach;?>
                                                        <?endif;?>
                                                        <? // после несколько пустых полей для заполнения новыми значениями ?>
                                                        <input type="text" size="7" class="form-control" name="prop[<?=$property->id?>][n0]" value=""/>
                                                        <input type="text" size="7" class="form-control" name="prop[<?=$property->id?>][n1]" value=""/>
                                                        <input type="text" size="7" class="form-control" name="prop[<?=$property->id?>][n2]" value=""/>
                                                    <?endif;?>
                                                <?endif;?>

                                            <?endif;?>

                                            <? // свойство типа - Список?>
                                            <?if($property->property_type == 'L'):?>
                                                <?if($property->list_type == 'L'): // тип Списка - Лист?>
                                                    <?
                                                    // выбираю все значения текущего множественного свойства
                                                    $property_enums = BlockPropertyEnum::model()->findAll('property_id = '.$property->id);

                                                    // определяю свойства, выбранные для текущего элемента
                                                    $arSelectedEnums = array();
                                                    // echo '<pre>'; print_r($blockElementProperty); echo '</pre>';

                                                    foreach($blockElementProperties as $value){
                                                        $arSelectedEnums[] = $value->value;
                                                    }
                                                    ?>
                                                    <?if(!empty($property_enums)):?>
                                                        <select <?if($property->multiple == 'Y'):?>multiple<?endif;?> class="<?if($property->multiple == 'N'):?>select <?endif;?>form-control" size="15" name="prop[<?=$property->id?>][]">
                                                            <option value="">(не установлено)</option>
                                                            <?foreach($property_enums as $property_enum):?>
                                                                <option <?if(in_array($property_enum->id, $arSelectedEnums)):?>selected<?endif;?> value="<?=$property_enum->id?>"><?=$property_enum->value?></option>
                                                            <?endforeach;?>
                                                        </select>
                                                    <?endif;?>
                                                <?endif?>
                                            <?endif?>
                                        </div>
                                        <?if($property->hint):?>
                                            <small><?=$property->hint?></small>
                                        <?endif;?>
                                    </div>
                                </div>
                            <?endforeach;?>
                        <?endif;?>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-primary pull-right">Сохранить</button>
                    </div>
                </div>
            </div>
            <? // Блок ФАЙЛЫ ?>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="page-content-wrap">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Файлы</strong></h3>
                        </div>
                        <div class="panel-body form-group-separated">
                            <? // PREVIEW PICTURE ?>
                            <?if($block->is_element_preview_picture == "Y"):?>
                                <div class="form-group">
                                    <label class="col-md-4 control-label"><?=$block->sign_element_preview_picture_name?></label>
                                    <div class="col-md-8 col-xs-12">
                                        <?=CHtml::activeFileField($element,'element_preview_picture',
                                            array('class' => 'fileinput btn-primary',
                                                'id' => 'filename',
                                                'data-filename-placement'=>"inside",
                                                'title' => "Выбрать файл",
                                            )); ?>
                                        <?if($block->preview_picture_hint):?>
                                            <small><?echo $block->preview_picture_hint?></small>
                                        <?endif;?>
                                    </div>
                                </div>
                                <?if($element->preview_picture):?>
                                    <div class="form-group">
                                        <div class="col-md-4 col-xs-12"></div>
                                        <div class="col-md-8 col-xs-12">
                                            <div></div>
                                            <img style="max-width:200px; margin-right:10px" src="<?=Files::getPath($element->preview_picture)?>">
                                            <a href="<?=$this->createUrl('admin/block_element_edit', array('block_id' => $block->id, 'id' => $element->id, 'find_section' => $_REQUEST['find_section'], 'action' => 'remove_picture', 'type' => 'preview_picture'))?>" title="Удалить фотографию" style="vertical-align: top" class="delete-confirm buffer-width-10 mgt">
                                                <i class="fa fa-times text-danger"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?endif;?>
                            <?endif;?>

                            <? // DETAIL PICTURE ?>
                            <?if($block->is_element_detail_picture == "Y"):?>
                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12 control-label"><?=$block->sign_element_detail_picture_name?></label>
                                    <div class="col-md-8 col-xs-12">
                                        <?=CHtml::activeFileField($element,'element_detail_picture',
                                            array('class' => 'fileinput btn-primary',
                                                'id' => 'filename',
                                                'data-filename-placement'=>"inside",
                                                'title' => "Выбрать файл",
                                            )); ?>
                                        <?if($block->detail_picture_hint):?>
                                            <small><?echo $block->detail_picture_hint?></small>
                                        <?endif;?>
                                    </div>
                                </div>
                                <?if($element->detail_picture):?>
                                    <div class="form-group">
                                        <div class="col-md-4 col-xs-12"></div>
                                        <div class="col-md-8 col-xs-12">
                                            <img style="width:200px; margin-right:10px" src="<?=Files::getPath($element->detail_picture)?>">
                                            <a href="<?=$this->createUrl('admin/block_element_edit', array('block_id' => $block->id, 'id' => $element->id, 'find_section' => $_REQUEST['find_section'], 'action' => 'remove_picture', 'type' => 'detail_picture'))?>" title="Удалить картинку" style="vertical-align: top" class="delete-confirm buffer-width-10 mgt">
                                                <i class="fa fa-times text-danger"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?endif;?>
                            <?endif;?>

                            <? // прикрепленные файлы ?>
                            <?/*?>
                            <?if($block->is_file == 'Y'):?>
                                <?if(!$arResult['element']->isNewRecord):?>
                                    <?$attached_file = Files::model()->find('block_element_id = '.$arResult['element']->id);?>
                                <?endif;?>
                                <?if(!empty($attached_file)):?>
                                    <div class="form-group">
                                        <label class="col-md-4 col-xs-10 control-label">
                                            <?if($block->id == 1):?>
                                                Файл прейскуранта
                                            <?else:?>
                                                Прикрепленный файл
                                            <?endif;?>
                                        </label>
                                        <div class="col-md-6">
                                            <a style="display: inline-block; margin: 7px 5px 0 0;" href="/assets/upload/<?=$attached_file->file_name?>"><?=$attached_file->file_name?></a>
                                        </div>
                                        <div class="col-md-2 col-xs-1">
                                            <div class="col-md-12" style="border: none">
                                                <div class="text-center">
                                                    <a href="<?=$this->createUrl('admin/block_element_edit', array('block_id' => $block->id, 'id' => $arResult['element']->id, 'find_section' => $_REQUEST['find_section'], 'action' => 'remove_attached_file', 'type' => 'single'))?>" title="Удалить файл" style="vertical-align: top" class="delete-confirm buffer-width-10 mgt">
                                                        <i class="fa fa-times text-danger"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?else:?>
                                    <div class="form-group">
                                        <label class="col-md-4 col-xs-12 control-label">
                                            <?if($block->id == 1):?>
                                                Прикрепить прейскурант
                                            <?else:?>
                                                Прикрепить файл
                                            <?endif;?>
                                        </label>
                                        <div class="col-md-8 col-xs-12">
                                            <input type="file" class="fileinput btn-primary" name="attached_file" id="filename" title="Выбрать файл"/>
                                        </div>
                                    </div>
                                <?endif;?>
                            <?endif;?>
                            <?*/?>

                            <? // ГАЛЕРЕЯ ?>
                            <?if($block->is_element_gallery == "Y"):?>
                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12 control-label">Галерея</label>
                                    <div class="col-md-8 col-xs-12">
                                        <?=CHtml::activeFileField($element,'element_gallery[]',
                                            array('class' => 'fileinput btn-primary',
                                                'id' => 'cp_photo',
                                                'data-filename-placement'=>"inside",
                                                'title' => "Выбрать файлы",
                                                'multiple' => true
                                            )); ?>

                                    </div>
                                </div>
                                <?if(!empty($gallery)):?>
                                    <?foreach($gallery as $item):?>
                                        <div class="form-group">
                                            <div class="col-md-4 col-xs-10">
                                                <img class="img-text preview-img-2" style="max-width: 100%" src="<?=Files::getPath($item->file_id)?>">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="text" name="gal_item_alt[<?=$item->id?>]" value="<?=Files::getAlt($item->file_id)?>" class="form-control" placeholder="alt" />
                                                    </div>
                                                </div>
                                                <div class="row top-buffer">
                                                    <div class="col-md-12">
                                                        <input type="text" name="gal_item_title[<?=$item->id?>]" value="<?=Files::getTitle($item->file_id)?>" class="form-control" placeholder="title"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-xs-1">
                                                <div class="col-md-12" style="border: none">
                                                    <div class="text-center">
                                                        <a href="<?=$this->createUrl('admin/block_element_edit', array('block_id' => $block->id, 'id' => $element->id, 'find_section' => $_REQUEST['find_section'], 'action' => 'remove_picture', 'type' => 'gallery_picture', 'picture_id' => $item->id))?>" title="Удалить картинку" style="vertical-align: top" class="delete-confirm buffer-width-10 mgt">
                                                            <i class="fa fa-times text-danger"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?endforeach;?>
                                <?endif;?>
                            <?endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <? // Вкладка "SEO" ?>
    <? if(Users::isDetail(Yii::app()->user->id)): ?>
        <div class="page-content-wrap page-tabs-item" id="seo">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Редактирование SEO-настроек</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">H1 Header</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" name="element[meta_h1]" value="<?=$element->meta_h1;?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">META Title</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" name="element[meta_title]" value="<?=$element->meta_title;?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">META Keywords</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" name="element[meta_keywords]" value="<?=$element->meta_keywords;?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">META Description</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" name="element[meta_description]" value="<?=$element->meta_description;?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? endif; ?>
</form>


<script>
    $(function(){
        if($(".icheckbox1").length > 0){
            $(".icheckbox1").iCheck({checkboxClass: 'icheckbox_minimal-grey'});
        }
    });
</script>