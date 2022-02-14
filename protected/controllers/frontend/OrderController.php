<?php

class OrderController extends FrontEndController
{
  public function actionIndex()
  {
    $form_type = "order";
    $this->setPageTitle(Yii::app()->name . ' | Оформление заказа');
    $this->page_header = 'Оформление заказа';
    $this->breadcrumbs = array(
      'Оформление заказа'
    );

    if (isset($_GET["form"])) {
      // echo 'form isset';
      if ($_GET["form"] == 'p') {
        $form_type = "order";
      } elseif ($_GET["form"] == 'r') {
        $form_type = "calc";
        $this->setPageTitle(Yii::app()->name . ' | Запрос на расчет тиража');
        $this->page_header = 'Запрос на расчет тиража';
        $this->breadcrumbs = array(
          'Запрос на расчет тиража'
        );
      }
    }

    $order = new Order();
    $errorMessage = array();
    $reCaptchaSecretKey = Yii::app()->params->reCaptchaSecretKey;

    if (isset($_REQUEST["Order"])) {

      $arOrder = $_REQUEST["Order"];
      $order->attributes = $arOrder;
      $order->timestamp_x = date('Y-m-d H:i:s');

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

      if (strlen($arOrder["name"]) <= 3) {
        $errorMessage[] = 'Укажите Ваше имя';
      }

      if (strlen($arOrder["email"]) <= 1) {
        $errorMessage[] = 'Укажите Ваш E-mail';
      }

      if(strlen($arOrder["email"]) > 1 && !$this->check_email($arOrder["email"]))
        $errorMessage[] = 'Укажите корректный E-mail';

      if (strlen($arOrder["phone"]) <= 7) {
        $errorMessage[] = 'Укажите номер телефона для связи с Вами';
      }

      if (strlen($arOrder["product"]) <= 4) {
        $errorMessage[] = 'Укажите вид продукции';
      }

      if (empty($errorMessage)) {


        if ($file_id = Files::saveFile($order, 'maket'))
          $order->maket = $file_id;

        if ($file_id = Files::saveFile($order, 'billing_details'))
          $order->billing_details = $file_id;

        if ($order->save()) {
          $subject = Yii::app()->name . '. Новое письмо с сайта';
          if ($order->type == 'order')
            $subject = Yii::app()->name . '. Новый заказ на сайте';
          elseif ($order->type == 'calc')
            $subject = Yii::app()->name . '. Новый запрос на индивидуальный расчет стоимости';

          $body = 'Дата заказа: ' . Yii::app()->dateFormatter->format('dd MMMM yyyy kk:mm', $order->timestamp_x) .
            '<br>Имя: ' . strip_tags($order->name) .
            '<br>E-mail: ' . strip_tags($order->email) .
            '<br>Телефон: ' . strip_tags($order->phone) .
            '<br>Продукт: ' . strip_tags($order->product) .
            '<br>Техническое задание: ' . htmlspecialchars($order->technical_task) .
            '<br>Тираж: ' . strip_tags($order->tirazh);

          // info@iguanaprint.ru
          $toDefaultEmail = Settings::model()->find('set_name = "default_email"')->value;

          // HelpUser::sendHtmlMail(Yii::app()->params->app_email, $toDefaultEmail, $subject, $body);
          HelpUser::sendHtmlMail(Yii::app()->params->app_email, 'iguanaprint-check@yandex.ru', $subject, $body);
          Yii::app()->user->setFlash('order_sent', 'Ваша заявка принята.');
        }
      }

    }

    $payment_method = PaymentMethod::model()->findAll();

    $this->render('index', array(
      'payment_method' => $payment_method,
      'form_type' => $form_type,
      'order' => $order,
      'errorMessage' => $errorMessage
    ));
  }

  public function check_email($email, $bStrict=false)
  {
    if(!$bStrict)
    {
      $email = trim($email);
      if(preg_match("#.*?[<\\[\\(](.*?)[>\\]\\)].*#i", $email, $arr) && strlen($arr[1])>0)
        $email = $arr[1];
    }

    //http://tools.ietf.org/html/rfc2821#section-4.5.3.1
    //4.5.3.1. Size limits and minimums
    if(strlen($email) > 320)
    {
      return false;
    }

    //http://tools.ietf.org/html/rfc2822#section-3.2.4
    //3.2.4. Atom
    static $atom = "=_0-9a-z+~'!\$&*^`|\\#%/?{}-";

    //"." can't be in the beginning or in the end of local-part
    //dot-atom-text = 1*atext *("." 1*atext)
    if(preg_match("#^[".$atom."]+(\\.[".$atom."]+)*@(([-0-9a-z_]+\\.)+)([a-z0-9-]{2,20})$#i", $email))
    {
      return true;
    }
    else
    {
      return false;
    }
  }

}