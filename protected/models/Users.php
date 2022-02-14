<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $name
 * @property string $date
 * @property integer $active
 * @property string $password
 * @property string $photo
 * @property integer $vk_id
 * @property string $google_id
 * @property integer $facebook_id
 * @property string $email
 * @property string $role
 * @property string $submit_code
 * @property integer $sex
 * @property string $town
 * @property string $about
 * @property integer $nav_left
 * @property integer $nav_right
 * @property string $logo
 * @property string $person_name
 * @property string $person_phone
 * @property string $person_adress
 * @property string $person_about
 * @property string $person_site
 *
 * The followings are the available model relations:
 * @property CheckpointUsergroups[] $checkpointUsergroups
 * @property UsersContacts[] $usersContacts
 * @property UsersTopics[] $usersTopics
 */
class Users extends CActiveRecord
{
	const LIKE_BOSS = 1;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('name, date, active, password, photo, vk_id, google_id, facebook_id, email, role, submit_code, sex, town, about, nav_left, nav_right, logo, person_name, person_phone, person_adress, person_about, person_site', 'required'),
			//array('active, vk_id, facebook_id, sex, nav_left, nav_right', 'numerical', 'integerOnly'=>true),
			//array('id, name, date, active, password, photo, vk_id, google_id, facebook_id, email, role, submit_code, sex, town, about, nav_left, nav_right, logo, person_name, person_phone, person_adress, person_about, person_site', 'safe'),
			//array('name, password, photo, google_id, email, role, submit_code, town, logo, person_name, person_phone, person_adress, person_site', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			//array('id, name, date, active, password, photo, vk_id, google_id, facebook_id, email, role, submit_code, sex, town, about, nav_left, nav_right, logo, person_name, person_phone, person_adress, person_about, person_site', 'safe', 'on'=>'search'),
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
			'checkpointUsergroups' => array(self::HAS_MANY, 'CheckpointUsergroups', 'user_id'),
			'usersContacts' => array(self::HAS_MANY, 'UsersContacts', 'user_id'),
			'usersTopics' => array(self::HAS_MANY, 'UsersTopics', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'date' => 'Date',
			'active' => 'Active',
			'password' => 'Password',
			'photo' => 'Photo',
			'vk_id' => 'Vk',
			'google_id' => 'Google',
			'facebook_id' => 'Facebook',
			'email' => 'Email',
			'role' => 'Role',
			'submit_code' => 'Submit Code',
			'sex' => 'Sex',
			'town' => 'Town',
			'about' => 'About',
			'nav_left' => 'Nav Left',
			'nav_right' => 'Nav Right',
			'logo' => 'Logo',
			'person_name' => 'Person Name',
			'person_phone' => 'Person Phone',
			'person_adress' => 'Person Adress',
			'person_about' => 'Person About',
			'person_site' => 'Person Site',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('vk_id',$this->vk_id);
		$criteria->compare('google_id',$this->google_id,true);
		$criteria->compare('facebook_id',$this->facebook_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('submit_code',$this->submit_code,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('town',$this->town,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('nav_left',$this->nav_left);
		$criteria->compare('nav_right',$this->nav_right);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('person_name',$this->person_name,true);
		$criteria->compare('person_phone',$this->person_phone,true);
		$criteria->compare('person_adress',$this->person_adress,true);
		$criteria->compare('person_about',$this->person_about,true);
		$criteria->compare('person_site',$this->person_site,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	private $_identity;

	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->name,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration= 3600*24*1; // 1 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}

	public function authenticate($attribute,$params)
	{
		$this->_identity=new UserIdentity($this->username,$this->password);
		if(!$this->_identity->authenticate())
			$this->addError('password','Incorrect username or password.');
	}

	public static function getUserRole($id)
	{
		$user = Users::model()->findByPk($id);
		if($user){
			switch($user->role)
			{
				case 1:
					return 'Администрация';
				case 2:
					return 'Пользователь';
				case 3:
					return 'Разработчик';
			}
		}
	}

	public static function getUserName($id)
	{
		$user = Users::model()->findByPk($id);
		if($user){
			return $user->name;
		}
	}

	public static function getUserEmail($id)
	{
		$user = Users::model()->findByPk($id);
		if($user){
			return $user->email;
		}
	}

	public static function isNavLeft($id)
	{
		$user = Users::model()->findByPk($id);
		if($user){
			return $user->nav_left;
		}
	}

	public static function isDetail($id)
	{
		$user = Users::model()->findByPk($id);
		if($user){
			return $user->detail;
		}
	}

	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password,$this->password);
	}

	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}
}
