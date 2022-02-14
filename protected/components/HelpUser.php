<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 07.01.2015
 * Time: 17:01
 */
class HelpUser
{
    public static function getUserInfo($user_id)
    {
        $user = Users::model()->findByPk($user_id);
        if($user){
            return $user;
        }
    }

    public static function getCountNewMessage($contact_id)
    {
        $topics = UsersTopics::model()->findAll('(user_id = '.Yii::app()->user->id.' and contact_id = '.$contact_id.') OR (user_id = '.$contact_id.' and contact_id = '.Yii::app()->user->id.')');
        if(count($topics) > 0)
        {
            foreach($topics as $topic){
                $topic_arr[] = $topic->id;
            }
            return UsersMessage::model()->count('topic_id in ('.implode(',', $topic_arr).') and new = 0 and from_id <> '.Yii::app()->user->id);
        } else {
            return 0;
        }
    }

    public static function getLastMessageTopic($topic_id)
    {
        $mess = UsersMessage::model()->find(array('condition' => 'topic_id ='.$topic_id, 'order' => 'id DESC'));
        if($mess){
            return $mess;
        }
    }

    public static function getCountNewMessageAllContacts()
    {
        $topics = UsersTopics::model()->findAll('user_id = '.Yii::app()->user->id.' OR contact_id = '.Yii::app()->user->id);
        if(count($topics) > 0)
        {
            foreach($topics as $topic){
                $topic_arr[] = $topic->id;
            }
            return UsersMessage::model()->count('topic_id in ('.implode(',', $topic_arr).') and new = 0 and from_id <> '.Yii::app()->user->id);
        } else {
            return 0;
        }
    }

    public static function getCountNewMessageTopic($topic_id)
    {
        return UsersMessage::model()->count('topic_id = '.$topic_id.' and new = 0 and from_id <> '.Yii::app()->user->id);
    }

    public static function getContactsList($user_id)
    {
        $user = Users::model()->findByPk($user_id);
        if($user){
            return UsersContacts::model()->findAll('user_id ='.$user->id);
        }
    }

    public static function sendVerify($user_id)
    {
        $user = Users::model()->findByPk($user_id);
        if($user){
            $code = rand(10000000, 9999999999);

            $user->submit_code = $code;
            $user->save();

            $url = Yii::app()->params->base_url.'reg/index?regsubmit='.$code.'&user='.$user->id;

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From:".Yii::app()->params->app_email . "\r\n";

            $body = '<p><strong>Вы зарегистрированы на сайте '.Yii::app()->name.'</strong></p>
            <p>Для завершения регистрации необходимо поддтвердить Ваш аккаунт пройдя по ссылке ниже.</p>
            <a href="'.$url.'" target="_blank">'.$url.'</a>';

            if(self::sendHtmlMail(Yii::app()->params->app_email, $user->email, 'Регистрация на '.Yii::app()->name, $body)){
                Yii::app()->user->setFlash('reg','На Ваш почтовый адрес отправлено письмо с инструкцией для завершения процедуры регистрации.');
            } else {
                Yii::app()->user->setFlash('reg','Не удалось отправить письмо, попробуйте чуть позже.');
            }
        }
    }

    public static function recoveryPassword($user_id)
    {
        $user = Users::model()->findByPk($user_id);
        if($user){
            $password = rand(10000000, 9999999999);

            $user->password = $user->hashPassword($password);
            $user->save();

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= "From:".Yii::app()->params->app_email . "\r\n";

            $body = '<p><strong>Восстановление пароля на сайте '.Yii::app()->name.'</strong></p>
            <p>Новый пароль для входа '.$password.'</p>
            <a href="'.Yii::app()->params->base_url.'" target="_blank">перейти на сайт</a>';

            if(self::sendHtmlMail(Yii::app()->params->app_email, $user->email, 'Восстановление пароля на '.Yii::app()->name, $body)){
                Yii::app()->user->setFlash('recovery','На Ваш почтовый адрес отправлено письмо с инструкцией для завершения процедуры восстановление пароля.');
            } else {
                Yii::app()->user->setFlash('recovery','Не удалось отправить письмо, попробуйте чуть позже.');
            }
        }
    }

    public static function manualNotify($user_id, $checkpoint_id)
    {
        $user = Users::model()->findByPk($user_id);
        if($user){
            $checkpoint = Checkpoint::model()->findByPk($checkpoint_id);

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            //$headers .= "From:".Yii::app()->params->app_email . "\r\n";

            $body = '<p><strong>Ручная проверка позиций на сайте '.Yii::app()->name.'</strong></p>
            <p>Проект: '.$checkpoint->title.'</p>
            <p>Время: '.date('Y-m-d H:i:s').'</p>
            <a href="'.Yii::app()->params->base_url.'" target="_blank">перейти на сайт</a>';

            if(self::sendHtmlMail(Yii::app()->params->app_email, $user->email, 'Ручная проверка позиций на сайте '.Yii::app()->name, $body)){
                return true;
            } else {
                return false;
            }
        }
    }

    public static function inviteUserToGroup($email, $user_id, $group_id)
    {
        if($email){
            $group = Groups::model()->findByPk($group_id);

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            //$headers .= "From:".Yii::app()->params->app_email . "\r\n";

            $body = '<p><strong>Приглашение в группу на сайте '.Yii::app()->name.'</strong></p>
            <p>Группа: '.$group->name.'</p>
            <a href="'.Yii::app()->params->base_url.'" target="_blank">перейти на сайт</a>';

            if(self::sendHtmlMail(Yii::app()->params->app_email, $email, 'Приглашение в группу на сайте '.Yii::app()->name, $body)){
                return true;
            } else {
                return false;
            }
        }
    }

    public static function newsNotify($user_id)
    {

    }

    public static function manualMassNotify($user_id, $checkpoint_id)
    {
        $user = Users::model()->findByPk($user_id);
        if($user){
            $checkpoint = Checkpoint::model()->findByPk($checkpoint_id);

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            //$headers .= "From:".Yii::app()->params->app_email . "\r\n";

            $body = '<p><strong>Массовая ручная проверка позиций на сайте '.Yii::app()->name.'</strong></p>
            <p>Проект: '.$checkpoint->title.'</p>
            <p>Время: '.date('Y-m-d H:i:s').'</p>
            <a href="'.Yii::app()->params->base_url.'" target="_blank">перейти на сайт</a>';

            if(self::sendHtmlMail(Yii::app()->params->app_email, $user->email, 'Массовая ручная проверка позиций на сайте '.Yii::app()->name, $body)){
                return true;
            } else {
                return false;
            }
        }
    }

    public static function autoNotify($user_id, $checkpoint_id)
    {
        $user = Users::model()->findByPk($user_id);
        if($user){
            $checkpoint = Checkpoint::model()->findByPk($checkpoint_id);

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            //$headers .= "From:".Yii::app()->params->app_email . "\r\n";

            $body = '<p><strong>Автоматическая проверка позиций на сайте '.Yii::app()->name.'</strong></p>
            <p>Проект: '.$checkpoint->title.'</p>
            <p>Время: '.date('Y-m-d H:i:s').'</p>
            <a href="'.Yii::app()->params->base_url.'" target="_blank">перейти на сайт</a>';

            if(self::sendHtmlMail(Yii::app()->params->app_email, $user->email, 'Автоматическая проверка позиций на сайте '.Yii::app()->name, $body)){
                return true;
            } else {
                return false;
            }
        }
    }

    public static function balanceNotify($user_id, $balance)
    {
        $user = Users::model()->findByPk($user_id);
        if($user){
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            //$headers .= "From:".Yii::app()->params->app_email . "\r\n";

            $body = '<p>Ваш баланс на сайте <strong>'.Yii::app()->name.'</strong> менее '.$balance.'</p>
            <p>Для использования всех возможностей ресурса необходимо пополнить Ваш баланс</p>
            <a href="'.Yii::app()->params->base_url.'" target="_blank">перейти на сайт</a>';

            if(self::sendHtmlMail(Yii::app()->params->app_email, $user->email, 'Необходимо пополнить баланс на сайте '.Yii::app()->name, $body)){
                return true;
            } else {
                return false;
            }
        }
    }

    public static function balanceMinNotify($user_id, $min_balance)
    {
        $user = Users::model()->findByPk($user_id);
        if($user){
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            //$headers .= "From:".Yii::app()->params->app_email . "\r\n";

            $body = '<p>Ваш баланс на сайте <strong>'.Yii::app()->name.'</strong> менее '.$min_balance.'</p>
            <p>Данная настройка указана Вами в настройках профиля, рекомендуем пополнить баланс</p>
            <a href="'.Yii::app()->params->base_url.'" target="_blank">перейти на сайт</a>';

            if(self::sendHtmlMail(Yii::app()->params->app_email, $user->email, 'Баланс на сайте '.Yii::app()->name.' менее '.$min_balance, $body)){
                return true;
            } else {
                return false;
            }
        }
    }

    public static function sendHtmlMail($from, $to, $subject, $body, $attachments = array()) {
        spl_autoload_unregister(array('YiiBase','autoload'));
        Yii::import('application.extensions.swiftmailer.lib.swift_required', true);
        spl_autoload_register(array('YiiBase','autoload'));

        $message = Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body, 'text/html');

        $transport = Swift_SmtpTransport::newInstance('smtp.yandex.ru', 465, 'ssl')
            ->setUsername('noreply@iguanaprint.ru')
            ->setPassword('gfhfgnthbrc4');

        $mailer = Swift_Mailer::newInstance($transport);
        return $mailer->send($message);
    }
}