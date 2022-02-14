<?php

class Block_section_editController extends BackEndController
{
    public function actionIndex()
    {
        $current_user = Users::model()->findByPk(Yii::app()->user->id);

        if(!isset($_REQUEST['block_id']) || !isset($_REQUEST['id']) || $current_user->role != 1){
            $this->redirect($this->createUrl('admin/block'));
        }else{

            $block_id = intval($_REQUEST['block_id']);
            $id = intval($_REQUEST['id']);
            $find_section = intval($_REQUEST['find_section']);
            $uploadDir = $_SERVER['DOCUMENT_ROOT'].Files::DIR;

            if($id > 0){
                // echo 'Редактирование раздела';
                $section = BlockSection::model()->findByPk($id);
                $section->modified_by = Yii::app()->user->id;
            }else{
                // echo 'Добавление раздела';
                $section = new BlockSection();
                $section->date_create = date('Y-m-d H:i:s');
                $section->created_by = Yii::app()->user->id;
            }

            if(isset($_REQUEST['section'])){

                $section->attributes = $_REQUEST['section'];
                $section->timestamp_x = date('Y-m-d H:i:s');

                if($_REQUEST['section']['block_section_id'] == 0){
                    $section->block_section_id = NULL;
                }

                if(!isset($_REQUEST['section']['active'])){
                    $section->active = 'N';
                }else{
                    $section->active = 'Y';
                }

                // **************** process SECTION PICTURE ****************
                $sectionPicture = CUploadedFile::getInstance($section,'section_picture');
                // var_dump($previewPicture); die();
                if (!empty($sectionPicture))
                {
                    $fileInfo = new SplFileInfo($sectionPicture->getName());
                    $typeFile = $fileInfo->getExtension();

                    do {
                        $token = md5(uniqid(rand(), true));
                        $newFileName = $token . '.' . $typeFile;
                        $subdir = substr(md5(mt_rand()), 0, 3);
                        $mkdir = $uploadDir.'/'.$subdir.'/';

                        // папка не существует, создаем ее
                        if(!file_exists($mkdir))
                            mkdir($mkdir);

                    } while (file_exists($mkdir.$newFileName));

                    if(move_uploaded_file($sectionPicture->getTempName(), $mkdir . $newFileName))
                    {

                        if($section->picture)
                        {
                            // if section picture exists, we delete it
                            Files::deleteFile($section->picture);
                        }

                        // add new section picture
                        $file = new Files();

                        $file->timestamp_x = date('Y-m-d H:i:s');
                        $file->file_name = $newFileName;
                        $file->subdir = $subdir;
                        $file->real_name = $fileInfo->getFilename();

                        if($file->save()){
                            $section->picture = $file->id;
                        }
                    }
                }


                // **************** process SECTION DETAIL PICTURE ****************
                $sectionDetailPicture = CUploadedFile::getInstance($section,'section_detail_picture');
                // var_dump($previewPicture); die();
                if (!empty($sectionDetailPicture))
                {
                    $fileInfo = new SplFileInfo($sectionDetailPicture->getName());
                    $typeFile = $fileInfo->getExtension();

                    do {
                        $token = md5(uniqid(rand(), true));
                        $newFileName = $token . '.' . $typeFile;
                        $subdir = substr(md5(mt_rand()), 0, 3);
                        $mkdir = $uploadDir.'/'.$subdir.'/';

                        // папка не существует, создаем ее
                        if(!file_exists($mkdir))
                            mkdir($mkdir);

                    } while (file_exists($mkdir.$newFileName));

                    if(move_uploaded_file($sectionDetailPicture->getTempName(), $mkdir . $newFileName))
                    {

                        if($section->detail_picture)
                        {
                            // if section detail picture exists, we delete it
                            Files::deleteFile($section->detail_picture);
                        }

                        // add new section picture
                        $file = new Files();

                        $file->timestamp_x = date('Y-m-d H:i:s');
                        $file->file_name = $newFileName;
                        $file->subdir = $subdir;
                        $file->real_name = $fileInfo->getFilename();

                        if($file->save()){
                            $section->detail_picture = $file->id;
                        }
                    }
                }

                if($section->save()){
                    if(BlockSection::TreeReSort($block_id)){
                        $this->redirect($this->createUrl('admin/block_list', array('block_id' => $block_id, 'find_section' => $find_section)));
                    }
                }
            }

            $block = Block::model()->findByPk($block_id);

            $criteria = new CDbCriteria(array(
                'condition'=>'block_id=:block_id',
                'params'=>array(':block_id' => $block_id),
                'order'=>'left_margin ASC',
            ));
            $sections = BlockSection::model()->findAll($criteria);

            $this->render('index', array(
                'arResult' => array(
                    'block' => $block,
                    'section' => $section,
                    'sections' => $sections
                ),
                'block' => $block,
                'current_user' => $current_user
            ));
        }
    }
}