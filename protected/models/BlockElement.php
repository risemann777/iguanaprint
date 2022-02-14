<?php

/**
 * This is the model class for table "{{block_element}}".
 *
 * The followings are the available columns in table '{{block_element}}':
 * @property integer $id
 * @property string $timestamp_x
 * @property integer $modified_by
 * @property string $date_create
 * @property integer $created_by
 * @property integer $block_id
 * @property integer $block_section_id
 * @property string $active
 * @property string $active_from
 * @property string $active_to
 * @property integer $sort
 * @property string $name
 * @property integer $preview_picture
 * @property string $preview_text
 * @property integer $detail_picture
 * @property string $detail_text
 * @property string $meta_h1
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $price
 * @property string $is_popular
 */
class BlockElement extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{block_element}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('modified_by, created_by, block_id, block_section_id, sort, preview_picture, detail_picture', 'numerical', 'integerOnly'=>true),
			array('active, is_popular', 'length', 'max'=>1),
			array('name, meta_h1, meta_title, meta_keywords, meta_description', 'length', 'max'=>255),
			array('price', 'length', 'max'=>18),
			array('timestamp_x, date_create, active_from, active_to, preview_text, detail_text', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, timestamp_x, modified_by, date_create, created_by, block_id, block_section_id, active, active_from, active_to, sort, name, preview_picture, preview_text, detail_picture, detail_text, meta_h1, meta_title, meta_keywords, meta_description, price, is_popular', 'safe', 'on'=>'search'),
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
			'tagFilter' => array(self::MANY_MANY, 'BlockTag', 'tbl_block_element_tag(block_element_id, block_tag_id)',
				'together'=>true,
				'joinType'=>'INNER JOIN',
				'condition'=>'code=:tag'
			),
			'tags' => array(self::MANY_MANY, 'BlockTag', 'tbl_block_element_tag(block_element_id, block_tag_id)'),
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
			'active_from' => 'Active From',
			'active_to' => 'Active To',
			'sort' => 'Sort',
			'name' => 'Name',
			'preview_picture' => 'Preview Picture',
			'preview_text' => 'Preview Text',
			'detail_picture' => 'Detail Picture',
			'detail_text' => 'Detail Text',
			'meta_h1' => 'Meta H1',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'price' => 'Price',
			'is_popular' => 'Is Popular',
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
		$criteria->compare('active_from',$this->active_from,true);
		$criteria->compare('active_to',$this->active_to,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('preview_picture',$this->preview_picture);
		$criteria->compare('preview_text',$this->preview_text,true);
		$criteria->compare('detail_picture',$this->detail_picture);
		$criteria->compare('detail_text',$this->detail_text,true);
		$criteria->compare('meta_h1',$this->meta_h1,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('is_popular',$this->is_popular,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BlockElement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
