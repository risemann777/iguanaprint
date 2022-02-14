<?php

/**
 * This is the model class for table "{{block_property}}".
 *
 * The followings are the available columns in table '{{block_property}}':
 * @property integer $id
 * @property integer $block_id
 * @property string $name
 * @property string $code
 * @property string $default_value
 * @property string $property_type (S-строка, N-число, L-список, F-файл)
 * @property integer $row_count
 * @property integer $col_count
 * @property string $list_type (L-список, C-флажки)
 * @property string $multiple - (множественное свойство Y, N)
 * @property integer $multiple_cnt (количество полей для множественного ввода)
 * @property string $with_description (выводить поле для описания значения Y, N)
 * @property string $is_required (обязательное поле)
 * @property string $user_type (тип пользовательского поля, HTML - для ввода значения поля выводится textarea)
 * @property string $is_html (нужен ли Визивиг для поля)
 * @property string $hint (подсказка)
 *
 */
class BlockProperty extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{block_property}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('block_id, name', 'required'),
			array('block_id, row_count, col_count, multiple_cnt', 'numerical', 'integerOnly'=>true),
			array('name, user_type, hint', 'length', 'max'=>255),
			array('code', 'length', 'max'=>50),
			array('property_type, list_type, multiple, with_description, is_required, is_html', 'length', 'max'=>1),
			array('default_value', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, block_id, name, code, default_value, property_type, row_count, col_count, list_type, multiple, multiple_cnt, with_description, is_required, user_type, is_html, hint', 'safe', 'on'=>'search'),
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
			'block_id' => 'Block',
			'name' => 'Name',
			'code' => 'Code',
			'default_value' => 'Default Value',
			'property_type' => 'Property Type',
			'row_count' => 'Row Count',
			'col_count' => 'Col Count',
			'list_type' => 'List Type',
			'multiple' => 'Multiple',
			'multiple_cnt' => 'Multiple Cnt',
			'with_description' => 'With Description',
			'is_required' => 'Is Required',
			'user_type' => 'User Type',
			'is_html' => 'Is Html',
			'hint' => 'Hint',
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
		$criteria->compare('block_id',$this->block_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('default_value',$this->default_value,true);
		$criteria->compare('property_type',$this->property_type,true);
		$criteria->compare('row_count',$this->row_count);
		$criteria->compare('col_count',$this->col_count);
		$criteria->compare('list_type',$this->list_type,true);
		$criteria->compare('multiple',$this->multiple,true);
		$criteria->compare('multiple_cnt',$this->multiple_cnt);
		$criteria->compare('with_description',$this->with_description,true);
		$criteria->compare('is_required',$this->is_required,true);
		$criteria->compare('user_type',$this->user_type,true);
		$criteria->compare('is_html',$this->is_html,true);
		$criteria->compare('hint',$this->hint,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BlockProperty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
