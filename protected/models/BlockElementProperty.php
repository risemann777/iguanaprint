<?php

/**
 * This is the model class for table "{{block_element_property}}".
 *
 * The followings are the available columns in table '{{block_element_property}}':
 * @property integer $id
 * @property integer $block_property_id
 * @property integer $block_element_id
 * @property string $value
 * @property integer $value_enum
 * @property string $description
 */
class BlockElementProperty extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{block_element_property}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('block_property_id, block_element_id, value', 'required'),
			array('block_property_id, block_element_id, value_enum', 'numerical', 'integerOnly'=>true),
			array('description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, block_property_id, block_element_id, value, value_enum, description', 'safe', 'on'=>'search'),
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
			'valueEnum' => array(self::BELONGS_TO, 'BlockPropertyEnum', 'value_enum'),
			'blockProperty' => array(self::BELONGS_TO, 'BlockProperty', 'block_property_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'block_property_id' => 'Block Property',
			'block_element_id' => 'Block Element',
			'value' => 'Value',
			'value_enum' => 'Value Enum',
			'description' => 'Description',
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
		$criteria->compare('block_property_id',$this->block_property_id);
		$criteria->compare('block_element_id',$this->block_element_id);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('value_enum',$this->value_enum);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BlockElementProperty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
