<?php
class Block_listController extends BackEndController
{
    public function actionIndex()
    {
        if(!isset($_REQUEST['block_id']) || !isset($_REQUEST['find_section'])){
            $this->redirect($this->createUrl('admin/block'));
        }else{
            $block_id = intval($_REQUEST['block_id']);
            $section_id = intval($_REQUEST['find_section']);
            $uploadDir = $_SERVER['DOCUMENT_ROOT'].Files::DIR;
            // текущий пользователь
            $current_user = Users::model()->findByPk(Yii::app()->user->id);


            if($section_id == 0){

                // корневой раздел. Выводим секции с depth level = 1
                $sectionCriteria = new CDbCriteria(array(
                    'condition'=>'block_id=:block_id and depth_level=:depth_level',
                    'params'=>array(':block_id' => $block_id, ':depth_level' => '1'),
                    'order'=>'left_margin ASC',
                ));

                // и элементы, не привязанные к разделам
                if($block_id == 2){
                    $elementCriteria = new CDbCriteria(array(
                        'condition'=>'block_id=:block_id and block_section_id IS NULL',
                        'params'=>array(':block_id' => $block_id),
                        'order'=>'sort ASC, active_from DESC',
                    ));
                }else{
                    $elementCriteria = new CDbCriteria(array(
                        'condition'=>'block_id=:block_id and block_section_id IS NULL',
                        'params'=>array(':block_id' => $block_id),
                        'order'=>'sort ASC, date_create DESC',
                    ));
                }

            }else{

                // подраздел $section_id. Выводим секции $section_id
                $sectionCriteria = new CDbCriteria(array(
                    'condition'=>'block_id=:block_id and block_section_id=:block_section_id',
                    'params'=>array(':block_id' => $block_id, ':block_section_id' => $section_id),
                    'order'=>'left_margin ASC',
                ));

                // и элементы, привязанные к $section_id
                // во втором блоке сортирую по дате активности
                if($block_id == 2){
                    $elementCriteria = new CDbCriteria(array(
                        'condition'=>'block_id=:block_id and block_section_id=:block_section_id',
                        'params'=>array(':block_id' => $block_id, ':block_section_id' => $section_id),
                        'order' => 'sort ASC, active_from DESC',
                    ));
                }else{
                    $elementCriteria = new CDbCriteria(array(
                        'condition'=>'block_id=:block_id and block_section_id=:block_section_id',
                        'params'=>array(':block_id' => $block_id, ':block_section_id' => $section_id),
                        'order' => 'sort ASC, date_create DESC',
                    ));
                }
            }

            $sectionsDataProvider = new CActiveDataProvider('BlockSection', array(
                'criteria' => $sectionCriteria,
                'pagination' => false
            ));

            $elementDataProvider = new CActiveDataProvider('BlockElement', array(
                'criteria' => $elementCriteria,
                'pagination' => array(
                    'pageSize' => 20,
                    'pageVar' => 'page'
                ),
            ));

            $block = Block::model()->findByPk($block_id);

            if(isset($_REQUEST['id']) && isset($_REQUEST['action']) && isset($_REQUEST['type']))
            {
                $id = intval($_REQUEST['id']);
                $action = strip_tags($_REQUEST['action']);
                $type = strip_tags($_REQUEST['type']);

                // удаление элемента или раздела
                if($action == 'remove')
                {
                    switch($type){
                        case 'section':
                            $section = BlockSection::model()->findByPk($id);

                            if($section->delete())
                            {
                                // if section picture exists, we delete it
                                if($section->picture)
                                    Files::deleteFile($section->picture);

                                // if section detail picture exists, we delete it
                                if($section->detail_picture)
                                    Files::deleteFile($section->detail_picture);

                                $this->redirect($this->createUrl('admin/block_list', array('block_id' => $block_id, 'find_section' => $section_id)));
                            }

                            break;

                        case 'element':

                            $element = BlockElement::model()->findByPk($id);

                            if($element->delete())
                            {
                                // удаляем все привязки Элемента к Разделам и к Тэгам
                                $criteria = new CDbCriteria(array(
                                    'condition'=>'block_element_id=:block_element_id',
                                    'params'=>array(':block_element_id' => $element->id),
                                ));
                                BlockSectionElement::model()->deleteAll($criteria);
                                BlockElementTag::model()->deleteAll($criteria);

                                // if element preview picture exists, we delete it
                                if($element->preview_picture)
                                    Files::deleteFile($element->preview_picture);

                                // if element detail picture exists, we delete it
                                if($element->detail_picture)
                                    Files::deleteFile($element->detail_picture);

                                // удаляем галерею элемента
                                $gallery = BlockElementGallery::model()->findAll($criteria);

                                foreach($gallery as $item)
                                    Files::deleteFile($item->file_id);

                                BlockElementGallery::model()->deleteAll($criteria);

                                // удаляем свойства элемента
                                BlockElementProperty::model()->deleteAll($criteria);

                                $this->redirect($this->createUrl('admin/block_list', array('block_id' => $block_id, 'find_section' => $section_id)));
                            }

                            break;
                    }
                }
            }

            $this->render('index', array(
                'arResult' => array(
                    'sections' => $sectionsDataProvider,
                    'elements' => $elementDataProvider,
                    'section_id' => $section_id,
                ),
                'block' => $block,
                'current_user' => $current_user
            ));
        }
    }
}