<?php

/**
 * This is the model class for table "{{block_section}}".
 *
 * The followings are the available columns in table '{{block_section}}':
 * @property integer $id
 * @property string $timestamp_x
 * @property integer $modified_by
 * @property string $date_create
 * @property integer $created_by
 * @property integer $block_id
 * @property integer $block_section_id
 * @property string $active
 * @property string $global_active
 * @property integer $sort
 * @property string $name
 * @property integer $picture
 * @property integer $left_margin
 * @property integer $right_margin
 * @property integer $depth_level
 * @property string $description
 * @property string $code
 * @property integer $detail_picture
 * @property string $meta_h1
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 */
class BlockSection extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{block_section}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('timestamp_x, block_id, name', 'required'),
			array('modified_by, created_by, block_id, block_section_id, sort, picture, left_margin, right_margin, depth_level, detail_picture', 'numerical', 'integerOnly'=>true),
			array('active, global_active', 'length', 'max'=>1),
			array('name, code, meta_h1, meta_title, meta_keywords, meta_description', 'length', 'max'=>255),
			array('date_create, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, timestamp_x, modified_by, date_create, created_by, block_id, block_section_id, active, global_active, sort, name, picture, left_margin, right_margin, depth_level, description, code, detail_picture, meta_h1, meta_title, meta_keywords, meta_description', 'safe', 'on'=>'search'),
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
			'modified_by' => 'Modified By',
			'date_create' => 'Date Create',
			'created_by' => 'Created By',
			'block_id' => 'Block',
			'block_section_id' => 'Block Section',
			'active' => 'Active',
			'global_active' => 'Global Active',
			'sort' => 'Sort',
			'name' => 'Name',
			'picture' => 'Picture',
			'left_margin' => 'Left Margin',
			'right_margin' => 'Right Margin',
			'depth_level' => 'Depth Level',
			'description' => 'Description',
			'code' => 'Code',
			'detail_picture' => 'Detail Picture',
			'meta_h1' => 'Meta H1',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
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
		$criteria->compare('modified_by',$this->modified_by);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('block_id',$this->block_id);
		$criteria->compare('block_section_id',$this->block_section_id);
		$criteria->compare('active',$this->active,true);
		$criteria->compare('global_active',$this->global_active,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('picture',$this->picture);
		$criteria->compare('left_margin',$this->left_margin);
		$criteria->compare('right_margin',$this->right_margin);
		$criteria->compare('depth_level',$this->depth_level);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('detail_picture',$this->detail_picture);
		$criteria->compare('meta_h1',$this->meta_h1,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BlockSection the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	// resort sections tree after change section
	public static function TreeReSort($block_id, $id=0, $cnt=0, $depth=0, $active="Y")
	{
		$block_id = intval($block_id);

		if($id==0)
		{
			// return false;
		}

		if($id > 0)
		{
			$model = BlockSection::model()->findByPk($id);

			$model->right_margin = intval($cnt);
			$model->left_margin = intval($cnt);
			$model->save();
		}

		if($id > 0)
		{
			$criteria = new CDbCriteria(array(
				'condition' => 'block_id=:block_id AND block_section_id=:block_section_id',
				'params' => array(':block_id' => $block_id, ':block_section_id' => $id),
				'order' => 'sort ASC, name ASC',
			));

		}else{
			$criteria = new CDbCriteria(array(
				'condition' => 'block_id=:block_id AND block_section_id IS NULL',
				'params' => array(':block_id' => $block_id),
				'order' => 'sort ASC, name ASC',
			));
		}

		$cnt++;

		$obSections = BlockSection::model()->findAll($criteria);

		foreach($obSections as $arr){
			// echo '<pre>'; print_r($arr);
			$cnt = BlockSection::TreeReSort($block_id, $arr->id, $cnt, $depth+1, ($active=="Y" && $arr->active=="Y" ? "Y" : "N"));
			// echo $cnt;
		}

		if($id==0)
		{
			return true;
		}

		$model = BlockSection::model()->findByPk(intval($id));
		$model->right_margin = intval($cnt);
		$model->depth_level = intval($depth);
		$model->global_active = $active;
		$model->save();

		return $cnt+1;

	}

	// returns false is section is empty
	public static function isEmpty($section_id)
	{
		$id = intval($section_id);

		if($id > 0){
			// проверим наличие дочерних разделов и элементов
			$sections_count = BlockSection::model()->count('block_section_id = '.$id);
			$elements_count = BlockElement::model()->count('block_section_id = '.$id);

			if($sections_count > 0 || $elements_count > 0){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}

	// построение массива для цепочки навигации Блоков
	public static function getBreadcrumbArray($block_id, $section_id)
	{
		$block_id = intval($block_id);
		$section_id = intval($section_id);
		$result = array();
		$arSections = array();
		$arSec = array();

		$block = Block::model()->findByPk($block_id);

		if($section_id > 0)
		{
			$section = BlockSection::model()->findByPk($section_id);

			while($section->block_section_id != NULL)
			{
				$arSections[$section->depth_level] = array('admin/block_list', 'block_id' => $block_id, 'find_section' => $section->id);
				$section = BlockSection::model()->findByPk($section->block_section_id);
			}

			if($section->block_section_id == NULL)
			{
				$arSections[$section->depth_level] = array('admin/block_list', 'block_id' => $block_id, 'find_section' => $section->id);
			}

			// пересортируем массив по ключу
			ksort($arSections);

			// создаю новый массив, где в качестве ключа должно быть название
			foreach($arSections as $value)
			{
				$sec = BlockSection::model()->findByPk($value['find_section']);
				$arSec[$sec->name] = $value;
			}
		}

		// в любом случае, в массиве цепочки должен быть сам блок
		$arBlock[$block->name] = array('admin/block_list', 'block_id' => $block_id, 'find_section' => 0);

		if(!empty($arSec))
			$result = array_merge($arBlock, $arSec);
		else
			$result = $arBlock;

		return $result;

	}
}
