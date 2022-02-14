<?php

/**
 * This is the model class for table "{{order}}".
 *
 * The followings are the available columns in table '{{order}}':
 * @property integer $id
 * @property string $timestamp_x
 * @property string $type
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $product
 * @property string $technical_task
 * @property integer $tirazh
 * @property integer $maket
 * @property integer $payment_method
 * @property integer $billing_details
 * @property string $additional_info
 */
class Order extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email, phone, product', 'required'),
			array('tirazh, maket, payment_method, billing_details', 'numerical', 'integerOnly'=>true),
			array('type, name, email, phone, product', 'length', 'max'=>255),
			array('timestamp_x, technical_task, additional_info', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, timestamp_x, type, name, email, phone, product, technical_task, tirazh, maket, payment_method, billing_details, additional_info', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'name' => 'Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'product' => 'Product',
			'technical_task' => 'Technical Task',
			'tirazh' => 'Tirazh',
			'maket' => 'Maket',
			'payment_method' => 'Payment Method',
			'billing_details' => 'Billing Details',
			'additional_info' => 'Additional Info',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('product',$this->product,true);
		$criteria->compare('technical_task',$this->technical_task,true);
		$criteria->compare('tirazh',$this->tirazh);
		$criteria->compare('maket',$this->maket);
		$criteria->compare('payment_method',$this->payment_method);
		$criteria->compare('billing_details',$this->billing_details);
		$criteria->compare('additional_info',$this->additional_info,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
