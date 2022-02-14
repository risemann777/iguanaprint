<?php

class UsersController extends BackEndController
{
    public function actionIndex()
    {
        // текущий пользователь
        $current_user = Users::model()->findByPk(Yii::app()->user->id);

        if($current_user->id == 1)
        {
            // если текущий пользователь ID=1, выводим всех пользователей
            $criteria = new CDbCriteria();
        }
        else
        {
            // иначе выводим всех пользователей, кроме пользователя с ID=1
            $criteria = new CDbCriteria(array(
                'condition'=>'id != 1',
            ));
        }

        $dataProvider = new CActiveDataProvider('Users', array(
            'criteria' => $criteria
        ));

        // добавлять и редактировать пользователей может только пользователь с ролью 1
        if($current_user->role == 1)
        {
            if(isset($_REQUEST['user_id'])){
                $user = Users::model()->findByPk($_REQUEST['user_id']);
                $user->name = $_REQUEST['name'];
                $user->role = $_REQUEST['role'];
                $user->active = $_REQUEST['active'];
                $user->detail = $_REQUEST['detail'];

                if($user->save()){
                    $this->redirect($this->createUrl('/admin/users'));
                }
            }

            if(isset($_REQUEST['name'])){
                $user = new Users();
                $user->name = $_REQUEST['name'];
                $user->role = $_REQUEST['role'];
                $user->email = $_REQUEST['email'];
                $user->password = $user->hashPassword($_REQUEST['password']);
                $user->active = $_REQUEST['active'];
                $user->detail = $_REQUEST['detail'];

                if($user->save()){
                    $this->redirect($this->createUrl('/admin/users'));
                }
            }
        }

        $this->render('index', array(
            'data' => $dataProvider,
            'current_user' => $current_user
        ));
    }

    public function actionDelete($id)
    {
        $user = Users::model()->findByPk($id);
        if($user->delete()){
            $this->redirect($this->createUrl('/admin/users'));
        }
    }

    public function actionChangeNavRight(){
        $user = Users::model()->findByPk(Yii::app()->user->id);
        $navType = $user->nav_right;
        if($navType){
            $user->nav_right = 0;
        } else {
            $user->nav_right = 1;
        }
        $user->save();
    }

    public function actionChangeNavLeft(){
        $user = Users::model()->findByPk(Yii::app()->user->id);
        $navType = $user->nav_left;
        if($navType){
            $user->nav_left = 0;
        } else {
            $user->nav_left = 1;
        }
        var_dump($user);
        $user->save();
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        $this->setPageTitle('Login Page');

        $model = new Users();

        if(isset($_POST['email']) && isset($_POST['password']))
        {
            $model->name = $_POST['email'];
            $model->password = $_POST['password'];
            if($model->login())
                $this->redirect($this->createUrl('/admin'));
        }

        // echo $model->hashPassword('123qwe');

        $this->render('login',array('model'=>$model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect($this->createUrl('/admin'));
    }

}
