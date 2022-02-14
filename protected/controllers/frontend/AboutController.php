<?php

class AboutController extends FrontEndController
{
  public function actionIndex()
  {
    $this->setPageTitle(Yii::app()->name . ' | Контакты');
    $this->page_header = 'Контакты';
    $this->breadcrumbs = array(
      'О нас'
    );

    $default_email = Settings::model()->find('set_name=:set_name', array(':set_name' => 'default_email'));
    $address = Settings::model()->find('set_name=:set_name', array(':set_name' => 'address'));
    $phone = Settings::model()->find('set_name=:set_name', array(':set_name' => 'phone'));

    $feedback = new Feedback();
    $errorMessage = array();
    $reCaptchaSecretKey = Yii::app()->params->reCaptchaSecretKey;

    if (isset($_REQUEST["Feedback"])) {
      // echo '<pre>'; print_r($_REQUEST["Feedback"]); echo '</pre>';

      $arFeedback = $_REQUEST["Feedback"];
      $feedback->attributes = $arFeedback;

      if(isset($_POST['g-recaptcha-response'])){

        spl_autoload_unregister(array('YiiBase','autoload'));
        Yii::import('application.extensions.recaptcha.autoload', true);
        spl_autoload_register(array('YiiBase','autoload'));

        $reCaptcha = new \ReCaptcha\ReCaptcha($reCaptchaSecretKey);

        $resp = $reCaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

        if (!$resp->isSuccess()){
          $errorMessage[] = 'Вы не прошли reCaptcha';
        }
      }

      if (strlen($arFeedback["name"]) <= 3) {
        $errorMessage[] = 'Укажите Ваше имя';
      }

      if (strlen($arFeedback["email"]) <= 1) {
        $errorMessage[] = 'Укажите Ваш E-mail';
      }

      if(strlen($arFeedback["email"]) > 1 && !$this->check_email($arFeedback["email"]))
        $errorMessage[] = 'Укажите корректный E-mail';

      if (empty($errorMessage)) {
        if ($feedback->save()) {
          $subject = Yii::app()->name . '. Сообщение из формы обратной связи';

          $body = 'Имя: ' . strip_tags($feedback->name) .
            '<br>E-mail: ' . strip_tags($feedback->email) .
            '<br>Тема: ' . strip_tags($feedback->subject) .
            '<br>Сообщение: ' . htmlspecialchars($feedback->message);

          // info@iguanaprint.ru
          $toDefaultEmail = Settings::model()->find('set_name = "default_email"')->value;

          // HelpUser::sendHtmlMail(Yii::app()->params->app_email, $toDefaultEmail, $subject, $body);
          HelpUser::sendHtmlMail(Yii::app()->params->app_email, 'iguanaprint-check@yandex.ru', $subject, $body);

          Yii::app()->user->setFlash('feedback_sent', 'Спасибо, ваше сообщение отправлено.');
        }
      }


    }

    $this->render('index', array(
      'default_email' => $default_email,
      'address' => $address,
      'phone' => $phone,
      'feedback' => $feedback,
      'errorMessage' => $errorMessage
    ));
  }

  public function check_email($email, $bStrict = false)
  {
    if (!$bStrict) {
      $email = trim($email);
      if (preg_match("#.*?[<\\[\\(](.*?)[>\\]\\)].*#i", $email, $arr) && strlen($arr[1]) > 0)
        $email = $arr[1];
    }

    //http://tools.ietf.org/html/rfc2821#section-4.5.3.1
    //4.5.3.1. Size limits and minimums
    if (strlen($email) > 320) {
      return false;
    }

    //http://tools.ietf.org/html/rfc2822#section-3.2.4
    //3.2.4. Atom
    static $atom = "=_0-9a-z+~'!\$&*^`|\\#%/?{}-";

    //"." can't be in the beginning or in the end of local-part
    //dot-atom-text = 1*atext *("." 1*atext)
    if (preg_match("#^[" . $atom . "]+(\\.[" . $atom . "]+)*@(([-0-9a-z_]+\\.)+)([a-z0-9-]{2,20})$#i", $email)) {
      return true;
    } else {
      return false;
    }
  }
}