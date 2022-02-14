<?php

class RegController extends FrontEndController
{
    public function actionIndex()
    {
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name'])){

            $ex_user = Users::model()->find('email = "'.$_POST['email'].'"');
            if(!$ex_user){
                $user = new Users();
                $user->name = $_POST['name'];
                $user->active = 0;
                $user->role = 2;
                $user->password = $user->hashPassword($_POST['password']);
                $user->email = $_POST['email'];
                $user->date = date('Y-m-d H:i:s');
                $user->save();

                HelpUser::sendVerify($user->id);
            } else {
                Yii::app()->user->setFlash('error','Пользователь с таким почтовым адресом уже зарегистрирован.');
            }
        }

        if(isset($_GET['regsubmit']) && isset($_GET['user'])){
            $user_register = Users::model()->findByPk($_GET['user']);
            if($user_register){
                $user_register->active = 1;
                $user_register->save();

                $user_contact = new UsersContacts();
                $user_contact->user_id = $user_register->id;
                $user_contact->contact_id = 1;
                $user_contact->save();

                $user_contact = new UsersContacts();
                $user_contact->user_id = 1;
                $user_contact->contact_id = $user_register->id;
                $user_contact->save();

                $user_notify = new UsersNotify();
                $user_notify->auto_email = 1;
                $user_notify->auto_lenta = 1;
                $user_notify->user_id = $user_register->id;
                $user_notify->manual_email = 1;
                $user_notify->manual_lenta = 1;
                $user_notify->manual_mass_email = 1;
                $user_notify->manual_mass_lenta = 1;
                $user_notify->balance_email = 1;
                $user_notify->balance_lenta = 1;
                $user_notify->balance_min = 10;
                $user_notify->news_email = 1;
                $user_notify->news_lenta = 1;
                $user_notify->save();
            }

            if($user_register->login()){
                $this->redirect($this->createUrl('/space'));
            } else {
                $this->redirect($this->createUrl('/space'));
            }
        }

        $this->render('index');
    }
}
