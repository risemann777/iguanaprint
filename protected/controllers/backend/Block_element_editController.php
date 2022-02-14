<?php

class Block_element_editController extends BackEndController
{
    public function actionIndex()
    {

        if(!isset($_REQUEST['block_id']) || !isset($_REQUEST['id'])){
            $this->redirect($this->createUrl('admin/block'));
        }else{

            $block_id = intval($_REQUEST['block_id']);
            $id = intval($_REQUEST['id']);
            $find_section = 0;
            $uploadDir = $_SERVER['DOCUMENT_ROOT'].Files::DIR;
            $current_user = Users::model()->findByPk(Yii::app()->user->id);

            $arElementSections = array();
            if(isset($_REQUEST['element']['block_section_id'])){
                $arElementSections = $_REQUEST['element']['block_section_id'];
            }

            $block = Block::model()->findByPk($block_id);
            $properties = BlockProperty::model()->findAll('block_id='.$block_id);
            // echo '<pre>'; print_r($properties); echo '</pre>';

            if(isset($_REQUEST['find_section']))
            {
                $find_section = intval($_REQUEST['find_section']);
            }

            $selected_sections = array();

            // разделы, выбранные в элементе
            $blockSectionElement = BlockSectionElement::model()->findAll('block_element_id='.$id);

            if($id > 0){
                // echo 'редактирование элемента';
                $element = BlockElement::model()->findByPk($id);
                $element->modified_by = Yii::app()->user->id;
                $element->timestamp_x = date('Y-m-d H:i:s');

                if(empty($blockSectionElement)){
                    $selected_sections[] = 0;
                }else{
                    foreach($blockSectionElement as $val){
                        $selected_sections[] = $val->block_section_id;
                    }
                }

            }else{
                // echo 'добавление нового элемента';
                $element = new BlockElement();
                $now_date = date('Y-m-d H:i:s');
                $element->timestamp_x = $now_date;
                $element->date_create = $now_date;
                $element->created_by = Yii::app()->user->id;

                $selected_sections[] = intval($_REQUEST['block_section_id']);
            }

            if(isset($_REQUEST['element']))
            {
                $element->attributes = $_REQUEST['element'];

                if($block->is_shop == 'Y'){
                    if(isset($_REQUEST['element']['price'])){
                        $element->price = $this->tofloat($_REQUEST['element']['price']);
                    }
                }

                if(isset($_REQUEST['element']['is_popular'])){
                    $element->is_popular = 'Y';
                }else{
                    $element->is_popular = 'N';
                }

                // **************** обработка привязки элемента к разделу НАЧАЛО ****************
                if(!empty($arElementSections)){

                    // echo 'есть массив разделов<br>';
                    if(count($arElementSections) == 1){
                        if($arElementSections[0] == 0){
                            // echo 'значение одно и равно нулю<br>';
                            $element->block_section_id = NULL;
                        }else{
                            $element->block_section_id = intval($arElementSections[0]);
                        }

                    }else{

                        // в элементе сохраняем id первого выбранного раздела из массива
                        if($arElementSections[0] == 0){
                            // echo 'первое значение - ноль!<br>';
                            $element->block_section_id = intval($arElementSections[1]);
                        }else{
                            // echo 'первое значение не равно нулю<br>';
                            $element->block_section_id = intval($arElementSections[0]);
                        }
                    }

                }else{
                    $element->block_section_id = NULL;
                }
                // **************** обработка привязки элемента к разделу ОКОНЧАНИЕ ****************


                // **************** process PREVIEW PICTURE ****************

                $previewPicture = CUploadedFile::getInstance($element,'element_preview_picture');
                // var_dump($previewPicture); die();
                if (!empty($previewPicture))
                {
                    $fileInfo = new SplFileInfo($previewPicture->getName());
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

                    if(move_uploaded_file($previewPicture->getTempName(), $mkdir . $newFileName))
                    {
                        // if preview picture exists, we delete it
                        if($element->preview_picture)
                            Files::deleteFile($element->preview_picture);

                        // add new preview picture
                        $file = new Files();

                        $file->timestamp_x = date('Y-m-d H:i:s');
                        $file->block_element_id = $element->id;
                        $file->file_name = $newFileName;
                        $file->subdir = $subdir;
                        $file->real_name = $fileInfo->getFilename();

                        if($file->save()){
                            $element->preview_picture = $file->id;
                        }


                        // если нужно ресайзить картинку
                        // $this->ResizeImage($filePath . $newFileName, 600, 100, 1, 'res_'.$newFileName);
                        // $element->preview_picture = 'res_'.$newFileName;
                        // unlink($filePath.$newFileName);

                        // иначе просто сохраняем
                        // $element->preview_picture = $newFileName;
                    }
                }


                // **************** process DETAIL PICTURE ****************

                $detailPicture = CUploadedFile::getInstance($element,'element_detail_picture');
                // var_dump($previewPicture); die();
                if (!empty($detailPicture))
                {
                    $fileInfo = new SplFileInfo($detailPicture->getName());
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

                    if(move_uploaded_file($detailPicture->getTempName(), $mkdir . $newFileName))
                    {
                        // if preview detail exists, we delete it
                        if($element->detail_picture)
                            Files::deleteFile($element->detail_picture);

                        // add new detail picture
                        $file = new Files();

                        $file->timestamp_x = date('Y-m-d H:i:s');
                        $file->block_element_id = $element->id;
                        $file->file_name = $newFileName;
                        $file->subdir = $subdir;
                        $file->real_name = $fileInfo->getFilename();

                        if($file->save()){
                            $element->detail_picture = $file->id;
                        }


                        // если нужно ресайзить картинку
                        // $this->ResizeImage($filePath . $newFileName, 600, 100, 1, 'res_'.$newFileName);
                        // $element->preview_picture = 'res_'.$newFileName;
                        // unlink($filePath.$newFileName);

                        // иначе просто сохраняем
                        // $element->preview_picture = $newFileName;
                    }
                }

                if($element->save())
                {
                    // обработка тэгов
                    // сначала удалим уже сохраненные в базе тэги
                    $criteria = new CDbCriteria(array(
                        'condition'=>'block_element_id=:block_element_id',
                        'params'=>array(':block_element_id' => $element->id),
                    ));
                    BlockElementTag::model()->deleteAll($criteria);

                    if(isset($_REQUEST['element']['tags']))
                    {
                        $arTags = $_REQUEST['element']['tags'];
                        // echo '<pre>'; print_r($arTags); die();

                        foreach($arTags as $tag){
                            $newTagToSave = new BlockElementTag();
                            $newTagToSave->block_element_id = $element->id;
                            $newTagToSave->block_tag_id = $tag;
                            $newTagToSave->save();
                        }
                    }

                    // прикрепленный файл
                    /*
                    if(isset($_FILES['attached_file']))
                    {
                        if($_FILES['attached_file']['name'] != '')
                        {
                            $date = date('Ymd_His');

                            // echo $this->transl(basename($_FILES['attached_file']['name'])); die();

                            $uploadFile = $date.'_'.$this->transl(basename($_FILES['attached_file']['name']));

                            if(move_uploaded_file($_FILES['attached_file']['tmp_name'], $filePath.$uploadFile))
                            {
                                // если файл уже был прикреплен, удаляем его
                                $file_to_delete = Files::model()->find('block_element_id = '.$element->id);

                                if(!empty($file_to_delete))
                                {
                                    if(is_file($filePath.$file_to_delete->file_name))
                                    {
                                        unlink($filePath.$file_to_delete->file_name);
                                    }
                                    $file_to_delete->delete();
                                }

                                // прикрепляем новый файл
                                $attached_file = new Files();
                                $attached_file->block_element_id = $element->id;
                                $attached_file->file_name = $uploadFile;
                                $attached_file->save();

                            }
                        }
                        // echo '<pre>'; print_r($_FILES); echo '<pre>'; die();
                    }
                    */

                    // **************** process GALLERY ****************
                    do{
                        static $uploadedImages = array();
                        static $iterate = 0;
                        $uploadedImage = CUploadedFile::getInstance($element,'element_gallery['.$iterate.']');

                        if(!empty($uploadedImage)){
                            $uploadedImages[] = $uploadedImage;
                        }
                        $iterate++;
                    }while(!empty($uploadedImage));

                    // echo '<pre>'; print_r($uploadedImages); echo '</pre>'; die();

                    if (!empty($uploadedImages))
                    {
                        foreach($uploadedImages as $file)
                        {
                            $fileInfo = new SplFileInfo($file->getName());
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

                            if(move_uploaded_file($file->getTempName(), $mkdir . $newFileName))
                            {
                                $file = new Files();

                                $file->timestamp_x = date('Y-m-d H:i:s');
                                $file->block_element_id = $element->id;
                                $file->file_name = $newFileName;
                                $file->subdir = $subdir;
                                $file->real_name = $fileInfo->getFilename();

                                if($file->save()){
                                    $photo = new BlockElementGallery();
                                    $photo->block_element_id = $element->id;
                                    $photo->file_id = $file->id;
                                    $photo->save();
                                }

                            }
                        }
                    }

                    // alt для галереи
                    if(isset($_REQUEST['gal_item_alt']))
                    {
                        foreach($_REQUEST['gal_item_alt'] as $key => $value){
                            $model = BlockElementGallery::model()->findByPk($key);
                            $file = Files::model()->findByPk($model->file_id);
                            $file->alt = $value;
                            $file->save();
                        }
                    }

                    // title для галереи
                    if(isset($_REQUEST['gal_item_title']))
                    {
                        foreach($_REQUEST['gal_item_title'] as $key => $value){
                            $model = BlockElementGallery::model()->findByPk($key);
                            $file = Files::model()->findByPk($model->file_id);
                            $file->title = $value;
                            $file->save();
                        }
                    }

                    // обработка свойств элемента Блока НАЧАЛО
                    if(isset($_REQUEST['prop']))
                    {
                        $arProps = $_REQUEST['prop'];

                        if(is_array($arProps))
                        {
                            // echo '<pre>'; var_dump($arProps); die();
                            // проходим по свойствам
                            foreach($arProps as $property_id => $property_val)
                            {
                                if(is_array($property_val))
                                {
                                    // если среди ключей массива есть ноль, то это свойство типа Список
                                    if(array_key_exists(0, $property_val))
                                    {
                                        // очищаю все значения списка
                                        $criteria = new CDbCriteria(array(
                                            'condition'=>'block_element_id=:block_element_id AND block_property_id=:block_property_id',
                                            'params'=>array(':block_element_id' => $element->id, ':block_property_id' => $property_id),
                                        ));
                                        BlockElementProperty::model()->deleteAll($criteria);

                                        // проходим по массиву выбранных значений свойства и сохраняем
                                        foreach($property_val as $value)
                                        {
                                            $blockElementProperty = new BlockElementProperty();
                                            $blockElementProperty->block_property_id = $property_id;
                                            $blockElementProperty->block_element_id = $element->id;
                                            $blockElementProperty->value = $value;
                                            $blockElementProperty->value_enum = $value; // enum сохраняем только для свойства типа Список
                                            $blockElementProperty->save();
                                        }

                                    }else{

                                        foreach($property_val as $element_prop_id => $element_prop_value)
                                        {
                                            // найдем сохранено ли значение в базе
                                            $element_prop_id = intval($element_prop_id);

                                            // значение существует в базе
                                            if($element_prop_id > 0)
                                            {
                                                $blockElementProperty = BlockElementProperty::model()->findByPk($element_prop_id);

                                                // если значение передается, то обновляем значение свойства
                                                if(strlen($element_prop_value) > 0){
                                                    $blockElementProperty->value = $element_prop_value;
                                                    $blockElementProperty->save();
                                                }else{
                                                    // иначе удаляем это свойство из базы
                                                    $blockElementProperty->delete();
                                                }
                                            }else{
                                                // иначе, добавляем новое значение
                                                $blockElementProperty = new BlockElementProperty();
                                                $blockElementProperty->block_property_id = $property_id;
                                                $blockElementProperty->block_element_id = $element->id;
                                                $blockElementProperty->value = $element_prop_value;
                                                $blockElementProperty->save();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    // обработка свойств элемента Блока ОКОНЧАНИЕ

                    // **************** обработка привязки элемента к множеству разделов НАЧАЛО ****************
                    if(!empty($arElementSections)){

                        // удаляем все привязки
                        $criteria = new CDbCriteria(array(
                            'condition'=>'block_element_id=:block_element_id',
                            'params'=>array(':block_element_id' => $element->id),
                        ));
                        BlockSectionElement::model()->deleteAll($criteria);

                        // echo 'есть массив разделов<br>';
                        if(count($arElementSections) == 1)
                        {
                            if($arElementSections[0] > 0)
                            {
                                // echo 'значение одно и не равно нулю<br>';
                                $sectionElements = new BlockSectionElement();
                                $sectionElements->block_section_id = intval($arElementSections[0]);
                                $sectionElements->block_element_id = $element->id;
                                $sectionElements->save();
                            }

                        }else{

                            // echo 'больше одного значения в массиве<br>';
                            // сохраняю множество значений id-шников разделов для текущего элемента
                            $sec_id = '';
                            foreach($arElementSections as $sec_id){

                                if($sec_id == 0)
                                    continue;

                                $sectionElements = new BlockSectionElement();
                                $sectionElements->block_section_id = $sec_id;
                                $sectionElements->block_element_id = $element->id;
                                $sectionElements->save();
                            }
                            if(isset($sec_id))
                                unset($sec_id);
                        }
                    }


                    $this->redirect($this->createUrl('admin/block_list', array('block_id' => $block_id, 'find_section' => $find_section)));
                }
            }

            if(isset($_REQUEST['action']) && isset($_REQUEST['type']))
            {
                $element = BlockElement::model()->findByPk($id);

                $action = strip_tags($_REQUEST['action']);
                $type = strip_tags($_REQUEST['type']);
                $redirect_url = $this->createUrl('admin/block_element_edit', array('block_id' => $block_id, 'id' => $id, 'find_section' => $find_section));

                if($action == 'remove_picture')
                {
                    switch($type){
                        case 'preview_picture':

                            if($element->preview_picture)
                            {

                                $file = Files::model()->findByPk($element->preview_picture);
                                $fileForDelete = $uploadDir . '/' .$file->subdir . '/' . $file->file_name;

                                if(is_file($fileForDelete))
                                {
                                    if($file->delete())
                                    {
                                        unlink($fileForDelete);
                                        $element->preview_picture = NULL;
                                        if($element->save())
                                        {
                                            $this->redirect($redirect_url);
                                        }
                                    }
                                }
                            }
                            break;

                        case 'detail_picture':

                            if($element->detail_picture)
                            {
                                $file = Files::model()->findByPk($element->detail_picture);
                                $fileForDelete = $uploadDir . '/' .$file->subdir . '/' . $file->file_name;

                                if(is_file($fileForDelete))
                                {
                                    if($file->delete())
                                    {
                                        unlink($fileForDelete);
                                        $element->detail_picture = NULL;
                                        if($element->save())
                                        {
                                            $this->redirect($redirect_url);
                                        }
                                    }
                                }
                            }
                            break;

                        case 'gallery_picture':

                            $picture_id = intval($_REQUEST['picture_id']);
                            $picture = BlockElementGallery::model()->findByPk($picture_id);

                            $file = Files::model()->findByPk($picture->file_id);
                            $fileForDelete = $uploadDir . '/' .$file->subdir . '/' . $file->file_name;

                            if(is_file($fileForDelete))
                            {
                                if($file->delete())
                                {
                                    unlink($fileForDelete);

                                    if($picture->delete())
                                    {
                                        $this->redirect($redirect_url);
                                    }
                                }
                            }
                            break;

                    }
                }

                /*
                if($action == 'remove_attached_file')
                {
                    switch($type){
                        case 'single':

                            $file_to_delete = Files::model()->find('block_element_id = '.$element->id);

                            if(!empty($file_to_delete))
                            {
                                if(is_file($destination.$file_to_delete->file_name))
                                {
                                    unlink($destination.$file_to_delete->file_name);
                                }
                                if($file_to_delete->delete()){
                                    $this->redirect($redirect_url);
                                }
                            }
                            break;

                    }
                }
                */
            }

            $criteria = new CDbCriteria(array(
                'condition'=>'block_id=:block_id',
                'params'=>array(':block_id' => $block_id),
                'order'=>'left_margin ASC',
            ));

            $sections = BlockSection::model()->findAll($criteria);

            // получаю галерею элемента
            $criteria = new CDbCriteria(array(
                'condition'=>'block_element_id=:block_element_id',
                'params'=>array(':block_element_id' => $id),
            ));

            $gallery = BlockElementGallery::model()->findAll($criteria);


            // ****** TAGS ******
            $tags = BlockElementTag::model()->findAll($criteria);

            $criteria = new CDbCriteria(array(
                'condition'=>'tag_block_id=:tag_block_id',
                'params'=>array(':tag_block_id' => $block_id),
            ));

            $allTags = BlockTag::model()->findAll($criteria);

            $selectedTags = array();
            if(!empty($tags)){
                foreach($tags as $tag){
                    $selectedTags[] = $tag->block_tag_id;
                }
            }

            $this->render('index', array(
                'element' => $element,
                'sections' => $sections,
                'selected_sections' => $selected_sections,
                'gallery' => $gallery,
                'properties' => $properties,
                'block' => $block,
                'current_user' => $current_user,
                'tags' => $allTags,
                'selectedTags' => $selectedTags
            ));
        }
    }

    public function ResizeImage ($filename, $size = 600, $quality = 85, $path_save, $new_filename)
    {
        /*
        * Адрес директории для сохранения картинки
        */
        $dir  =  $_SERVER['DOCUMENT_ROOT'].'/assets/upload/';

        /*
        * Извлекаем формат изображения, то есть получаем
        * символы находящиеся после последней точки
        */
        $ext  = strtolower(strrchr(basename($filename), "."));

        /*
        * Допустимые форматы
        */
        $extentions = array('.jpg', '.gif', '.png', '.bmp');

        if (in_array($ext, $extentions)) {
            $percent = $size; // Ширина изображения миниатюры

            list($width, $height) = getimagesize($filename); // Возвращает ширину и высоту
            $newheight    = $height * $percent;
            $newwidth    = $newheight / $width;

            $thumb = imagecreatetruecolor($percent, $newwidth);

            //Отключаем режим сопряжения цветов
            imagealphablending($thumb, false);

            //Включаем сохранение альфа канала
            imagesavealpha($thumb, true);

            switch ($ext) {
                case '.jpg':
                    $source = @imagecreatefromjpeg($filename);
                    break;

                case '.gif':
                    $source = @imagecreatefromgif($filename);
                    break;

                case '.png':
                    $source = @imagecreatefrompng($filename);
                    break;

                case '.bmp':
                    $source = @imagecreatefromwbmp($filename);
            }

            /*
            * Функция наложения, копирования изображения
            */
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $percent, $newwidth, $width, $height);

            /*
            * Создаем изображение
            */
            switch ($ext) {
                case '.jpg':
                    imagejpeg($thumb, $dir . $new_filename, $quality);
                    break;

                case '.gif':
                    imagegif($thumb, $dir . $new_filename);
                    break;

                case '.png':
                    imagepng($thumb, $dir . $new_filename, 0);
                    break;

                case '.bmp':
                    imagewbmp($thumb, $dir . $new_filename);
                    break;
            }


            /************** WATERMARK START ****************/
            /*
            // загрузка watermark
            $watermark_path = $_SERVER['DOCUMENT_ROOT'].'/assets/images/watermark.png'; // путь к водяной знак
            $watermark = imagecreatefrompng($watermark_path); // водяной знак

            //Отключаем режим сопряжения цветов
            imagealphablending($watermark, false);

            //Включаем сохранение альфа канала
            imagesavealpha($watermark, true);

            // Установка полей для штампа и получение высоты/ширины штампа
            $marge_right = 10;
            $marge_bottom = 10;
            $sx = imagesx($watermark);
            $sy = imagesy($watermark);


            // Копирование и наложение
            imagecopymerge($thumb, $watermark, 10, 10, 0, 0, 100, 47, 75);

            // Сохранение фотографии в файл и освобождение памяти
            imagepng($thumb, $dir . $new_filename);
            */
            /************** WATERMARK END ****************/


        } else {
            return false;
        }

        /*
        *  Очищаем оперативную память сервера от временных файлов,
        *  которые потребовались для создания миниатюры
        */
        @imagedestroy($thumb);
        @imagedestroy($source);

        return true;
    }

    public function tofloat($num) {
        $dotPos = strrpos($num, '.');
        $commaPos = strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
            ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

        if (!$sep) {
            return floatval(preg_replace("/[^0-9]/", "", $num));
        }

        return floatval(
            preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
        );
    }

    public function transl($text) {
        $trans = array(
            "а" => "a",
            "б" => "b",
            "в" => "v",
            "г" => "g",
            "д" => "d",
            "е" => "e",
            "ё" => "e",
            "ж" => "zh",
            "з" => "z",
            "и" => "i",
            "й" => "y",
            "к" => "k",
            "л" => "l",
            "м" => "m",
            "н" => "n",
            "о" => "o",
            "п" => "p",
            "р" => "r",
            "с" => "s",
            "т" => "t",
            "у" => "u",
            "ф" => "f",
            "х" => "kh",
            "ц" => "ts",
            "ч" => "ch",
            "ш" => "sh",
            "щ" => "shch",
            "ы" => "y",
            "э" => "e",
            "ю" => "yu",
            "я" => "ya",
            "А" => "A",
            "Б" => "B",
            "В" => "V",
            "Г" => "G",
            "Д" => "D",
            "Е" => "E",
            "Ё" => "E",
            "Ж" => "Zh",
            "З" => "Z",
            "И" => "I",
            "Й" => "Y",
            "К" => "K",
            "Л" => "L",
            "М" => "M",
            "Н" => "N",
            "О" => "O",
            "П" => "P",
            "Р" => "R",
            "С" => "S",
            "Т" => "T",
            "У" => "U",
            "Ф" => "F",
            "Х" => "Kh",
            "Ц" => "Ts",
            "Ч" => "Ch",
            "Ш" => "Sh",
            "Щ" => "Shch",
            "Ы" => "Y",
            "Э" => "E",
            "Ю" => "Yu",
            "Я" => "Ya",
            "Ъ" => "",
            "ъ" => "",
            "ь" => "",
            "Ь" => ""
        );
        if(preg_match("/[А-Яа-яa-zA-Z\.]/", $text)) {
            return strtr($text, $trans);
        }
        else {
            return $text;
        }
    }
}