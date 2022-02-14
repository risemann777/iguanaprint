<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = Users::model()->find('LOWER(email)=?',array(strtolower($this->username)));
		if($user===null){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
            Yii::app()->user->setFlash('error_user','Пользователь с таким почтовым адресом не найден.');
        }
		else if(!$user->validatePassword($this->password)){
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
            Yii::app()->user->setFlash('error_password','Не верный пароль.');
        }
		else
		{
            if($user->active){
                $this->_id=$user->id;
                // $this->name=$user->name;
                $this->errorCode=self::ERROR_NONE;
            } else {
                Yii::app()->user->setFlash('error_active','Пользователь с таким почтовым адресом уже зарегистрирован, но не подтвержден.');
                Yii::app()->user->setFlash('error_active_user', $user->id);
            }
		}
		return $this->errorCode==self::ERROR_NONE;
	}

    public function authenticateVK()
    {
        $user = Users::model()->find('LOWER(email)= "'.strtolower($this->name).'"');
        if($user===null){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        else
        {
            $this->_id=$user->id;
           // $this->name=$user->name;
            $this->errorCode=self::ERROR_NONE;
        }
        return $this->errorCode==self::ERROR_NONE;
    }

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}