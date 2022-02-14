<?php

/**
 * This is the model class for table "{{photos}}".
 *
 * The followings are the available columns in table '{{photos}}':
 * @property integer $id
 * @property integer $element_id
 * @property string $name
 * @property integer $section
 * @property string $title
 * @property string $alt
 */
class Photos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{photos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('element_id, name, section, title, alt', 'safe'),
			array('element_id, section', 'numerical', 'integerOnly'=>true),
			array('name, title, alt', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, element_id, name, section, title, alt', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'element_id' => 'Element',
			'name' => 'Name',
			'section' => 'Section',
			'title' => 'Title',
			'alt' => 'Alt',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('element_id',$this->element_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('section',$this->section);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alt',$this->alt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Photos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function resizePhoto($tmp_name, $new_name, $resolution_width, $resolution_height, $max_size)
	{

		//проверяем размер файла
		$image_size = filesize($tmp_name);
		$image_size = floor($image_size / '9048576');
		if ($image_size <= $max_size) {

			$params = getimagesize($tmp_name);
			//проверяем ширину и высоту, нужно ли обрезание
			if ($params['0'] > $resolution_width || $params['1'] > $resolution_height) {
				//пишем фото --------->
				//получаем нужные переменные
				switch ($params['2']) {
					case 1:
						$old_img = imagecreatefromgif($tmp_name);
						break;
					case 2:
						$old_img = imagecreatefromjpeg($tmp_name);
						break;
					case 3:
						$old_img = imagecreatefrompng($tmp_name);
						break;
					case 6:
						$old_img = imagecreatefromwbmp($tmp_name);
						break;
				}
				//вычисляем новые размеры
				if ($params['0'] > $params['1']) {
					$size = $params['0'];
					$resolution = $resolution_width;
				} else {
					$size = $params['1'];
					$resolution = $resolution_height;
				}
				$new_width = floor($params['0'] * $resolution / $size);
				$new_height = floor($params['1'] * $resolution / $size);
				//создаём новое изображение
				$new_img = imagecreatetruecolor($new_width, $new_height);
				imagecopyresampled($new_img, $old_img, 0, 0, 0, 0, $new_width, $new_height, $params['0'], $params['1']);

				//сохраняем новое изображение----->>>>>>
				//определяем тип изображения
				switch ($params['2']) {
					case 1:
						$type = '.gif';
						break;
					case 2:
						$type = '.jpg';
						break;
					case 3:
						$type = '.png';
						break;
					case 6:
						$type = '.bmp';
						break;
				}
//Сохраняем
				$new_name = "$new_name$type";
				switch ($type) {
					case '.gif':
						imagegif($new_img, $new_name);
						break;
					case '.jpg':
						imagejpeg($new_img, $new_name, 100);
						break;
					case '.bmp':
						imagejpeg($new_img, $new_name, 100);
						break;
					case '.png':
						imagepng($new_img, $new_name);
						break;
				}
				$message = ('<font class="message">Изображение добавлено</font><br>');
				imagedestroy($old_img);
			} else {//если не нужно обрезать-------------------->>>>>>>>>>>>>>>>>>>>>>>
				//сохраняем новое изображение----->>>>>>
				//определяем тип изображения
				switch ($params['2']) {
					case 1:
						$type = '.gif';
						break;
					case 2:
						$type = '.jpg';
						break;
					case 3:
						$type = '.png';
						break;
					case 6:
						$type = '.bmp';
						break;
				}
				//Сохраняем
				$new_name = "$new_name$type";
				copy($tmp_name, $new_name);
				$message = ('<font class="message">Изображение добавлено</font><br>');
			}
		} else $errors = ('<font class="error">Слишком большой размер</font><br>');


		return ($message);
		return ($errors);

	}
}
