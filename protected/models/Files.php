<?php

/**
 * This is the model class for table "{{files}}".
 *
 * The followings are the available columns in table '{{files}}':
 * @property integer $id
 * @property string $timestamp_x
 * @property integer $block_element_id
 * @property string $file_name
 * @property string $subdir
 * @property integer $width
 * @property integer $height
 * @property string $filesize
 * @property string $alt
 * @property string $title
 * @property string $real_name
 */
class Files extends CActiveRecord
{
	const DIR = '/assets/upload/block';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{files}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file_name, subdir', 'required'),
			array('block_element_id, width, height', 'numerical', 'integerOnly'=>true),
			array('file_name, alt, title, real_name', 'length', 'max'=>255),
			array('subdir', 'length', 'max'=>3),
			array('filesize', 'length', 'max'=>20),
			array('timestamp_x', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, timestamp_x, block_element_id, file_name, subdir, width, height, filesize, alt, title, real_name', 'safe', 'on'=>'search'),
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
			'timestamp_x' => 'Timestamp X',
			'block_element_id' => 'Block Element',
			'file_name' => 'File Name',
			'subdir' => 'Subdir',
			'width' => 'Width',
			'height' => 'Height',
			'filesize' => 'Filesize',
			'alt' => 'Alt',
			'title' => 'Title',
			'real_name' => 'Real Name',
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
		$criteria->compare('timestamp_x',$this->timestamp_x,true);
		$criteria->compare('block_element_id',$this->block_element_id);
		$criteria->compare('file_name',$this->file_name,true);
		$criteria->compare('subdir',$this->subdir,true);
		$criteria->compare('width',$this->width);
		$criteria->compare('height',$this->height);
		$criteria->compare('filesize',$this->filesize,true);
		$criteria->compare('alt',$this->alt,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('real_name',$this->real_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Files the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getPath($file_id)
	{
		$file = self::model()->findByPk($file_id);
		return self::DIR . '/' . $file->subdir . '/' . $file->file_name;
	}

	public static function getAlt($file_id)
	{
		$file = self::model()->findByPk($file_id);
		return $file->alt;
	}

	public static function getTitle($file_id)
	{
		$file = self::model()->findByPk($file_id);
		return $file->title;
	}

	public static function deleteFile($file_id)
	{
		$uploadDir = $_SERVER['DOCUMENT_ROOT'].Files::DIR;
		$file = self::model()->findByPk($file_id);
		$fileForDelete = $uploadDir . '/' .$file->subdir . '/' . $file->file_name;

		if(is_file($fileForDelete))
		{
			if($file->delete())
			{
				unlink($fileForDelete);
			}
		}
	}

	public static function saveFile($model, $attribute)
	{
		$fileToSave = CUploadedFile::getInstance($model, $attribute);
		$uploadDir = $_SERVER['DOCUMENT_ROOT'].Files::DIR;

		if (!empty($fileToSave))
		{
			$fileInfo = new SplFileInfo($fileToSave->getName());
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

			if(move_uploaded_file($fileToSave->getTempName(), $mkdir . $newFileName))
			{
				// add new preview picture
				$file = new Files();

				$file->timestamp_x = date('Y-m-d H:i:s');
				$file->file_name = $newFileName;
				$file->subdir = $subdir;
				$file->real_name = $fileInfo->getFilename();

				if($file->save()){
					return $file->id;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else{
			return false;
		}
	}
}
