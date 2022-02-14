<?php

class Block_editController extends BackEndController
{
    public function actionIndex()
    {
        $uploadDir = $_SERVER['DOCUMENT_ROOT'].Files::DIR;
        $current_user = Users::model()->findByPk(Yii::app()->user->id);

        if(!isset($_REQUEST['id']) || $current_user->role != 1){
            $this->redirect($this->createUrl('admin/block'));
        }else{

            $id = intval($_REQUEST['id']);

            if($id > 0){
                // echo 'редактирование блока';
                $block = Block::model()->findByPk($id);
            }else{
                // echo 'создание нового блока';
                $block = new Block();
            }

            if(isset($_REQUEST['block']))
            {
                $block->attributes = $_REQUEST['block'];

                if(isset($_REQUEST['block']['active'])){
                    $block->active = 'Y';
                }else{
                    $block->active = 'N';
                }

                if(isset($_REQUEST['block']['is_tag'])){
                    $block->is_tag = 'Y';
                }else{
                    $block->is_tag = 'N';
                }

                if(isset($_REQUEST['block']['is_element_popular'])){
                    $block->is_element_popular = 'Y';
                }else{
                    $block->is_element_popular = 'N';
                }

                if(isset($_REQUEST['block']['is_element_preview_picture'])){
                    $block->is_element_preview_picture = 'Y';
                }else{
                    $block->is_element_preview_picture = 'N';
                }

                if(isset($_REQUEST['block']['is_element_preview_text'])){
                    $block->is_element_preview_text = 'Y';
                }else{
                    $block->is_element_preview_text = 'N';
                }

                if(isset($_REQUEST['block']['is_element_detail_picture'])){
                    $block->is_element_detail_picture = 'Y';
                }else{
                    $block->is_element_detail_picture = 'N';
                }

                if(isset($_REQUEST['block']['is_element_detail_text'])){
                    $block->is_element_detail_text = 'Y';
                }else{
                    $block->is_element_detail_text = 'N';
                }

                if(isset($_REQUEST['block']['is_element_detail_text_html'])){
                    $block->is_element_detail_text_html = 'Y';
                }else{
                    $block->is_element_detail_text_html = 'N';
                }

                if(isset($_REQUEST['block']['is_element_gallery'])){
                    $block->is_element_gallery = 'Y';
                }else{
                    $block->is_element_gallery = 'N';
                }

                if(isset($_REQUEST['block']['is_sections'])){
                    $block->is_sections = 'Y';
                }else{
                    $block->is_sections = 'N';
                }

                if(isset($_REQUEST['block']['is_shop'])){
                    $block->is_shop = 'Y';
                }else{
                    $block->is_shop = 'N';
                }

                if(isset($_REQUEST['block']['is_file'])){
                    $block->is_file = 'Y';
                }else{
                    $block->is_file = 'N';
                }

                if(isset($_REQUEST['block']['is_active_from'])){
                    $block->is_active_from = 'Y';
                }else{
                    $block->is_active_from = 'N';
                }

                if(isset($_REQUEST['block']['is_active_to'])){
                    $block->is_active_to = 'Y';
                }else{
                    $block->is_active_to = 'N';
                }

                // **************** process PICTURE ****************
                $picture = CUploadedFile::getInstance($block,'picture');
                // var_dump($previewPicture); die();
                if (!empty($picture))
                {
                    $fileInfo = new SplFileInfo($picture->getName());
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

                    if(move_uploaded_file($picture->getTempName(), $mkdir . $newFileName))
                    {
                        // if picture exists, we delete it
                        if($block->picture)
                            Files::deleteFile($block->picture);

                        // add new picture
                        $file = new Files();

                        $file->timestamp_x = date('Y-m-d H:i:s');
                        $file->file_name = $newFileName;
                        $file->subdir = $subdir;
                        $file->real_name = $fileInfo->getFilename();

                        if($file->save()){
                            $block->picture = $file->id;
                        }
                    }
                }

                if($block->save()){
                    $this->redirect($this->createUrl('admin/block'));
                }
            }

            if(isset($_REQUEST['action']))
            {
                // echo 'action isset'; die();
                $action = strip_tags($_REQUEST['action']);

                if($action == 'remove_picture')
                {
                    if($block->picture)
                    {
                        $file = Files::model()->findByPk($block->picture);
                        $fileForDelete = $uploadDir . '/' .$file->subdir . '/' . $file->file_name;

                        if(is_file($fileForDelete))
                        {
                            if($file->delete())
                            {
                                unlink($fileForDelete);
                                $block->picture = NULL;
                                if($block->save())
                                {
                                    $this->redirect($this->createUrl('admin/block_edit', array('id' => $block->id)));
                                }
                            }
                        }
                    }
                }
            }

            $this->render('index', array(
                'block' => $block
            ));
        }

    }
}