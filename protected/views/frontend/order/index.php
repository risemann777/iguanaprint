<div class="container" id="blog">
  <div class="row">
    <aside class="span3 sidebar" id="widgetarea-sidebar">
      <? $this->renderPartial('/common/_sidebar_search'); ?>
      <? $this->renderPartial('/common/_sidebar_slider'); ?>
      <? $this->renderPartial('/common/_popular'); ?>
    </aside>
    <div class="span9">
      <? // echo 'form_type = '.$form_type.'<br>'?>
      <? if (Yii::app()->user->hasFlash('order_sent')): ?>
        <h1 style="margin-left:35px;"><?= Yii::app()->user->getFlash('order_sent') ?></h1>
      <? else: ?>
        <? if ($form_type == 'order'): ?>
          <h1 style="margin-left:35px;">Оформление заказа</h1>
          <p><a href="/order/?form=r" style="margin-left:45px; text-decoration:underline">Переключиться на
              индивидуальный расчет стоимости</a></p>
        <? elseif ($form_type == 'calc'): ?>
          <h1 style="margin-left:35px;">Запрос на расчет тиража</h1>
          <p><a href="/order/?form=p" style="margin-left:45px; text-decoration:underline">Переключиться на оформление
              заказа</a></p>
        <? endif; ?>
        <div class="screen-reader-response"></div>
        <? echo CHtml::beginForm('/order/', 'post', array('enctype' => 'multipart/form-data', 'class' => 'wpcf7-form')) ?>
        <? if ($form_type == 'order'): ?>
          <input type="hidden" name="Order[type]" value="order">
        <? elseif ($form_type == 'calc'): ?>
          <input type="hidden" name="Order[type]" value="calc">
        <? endif; ?>
        <p style="text-align:right">Поля помеченные * - обязательны для заполнения.</p>
        <? if (!empty($errorMessage)): ?>
          <div class="error-message">
            <? foreach ($errorMessage as $errorItem): ?>
              <p><? echo $errorItem ?></p>
            <? endforeach; ?>
          </div>
        <? endif; ?>
        <p>
          <label for="name">Ваше имя*:</label>
          <? echo CHtml::activeTextField($order, 'name', array('size' => '40')) ?>
        </p>
        <p>
          <label for="email">Ваш e-mail*:</label>
          <? echo CHtml::activeTextField($order, 'email', array('size' => '40')) ?>
        </p>
        <p>
          <label for="phone">Контактный телефон*:</label>
          <? echo CHtml::activeTextField($order, 'phone', array('size' => '40')) ?>
        </p>
        <p>
          <label for="product">Вид продукции*:</label>
          <? echo CHtml::activeTextField($order, 'product', array('size' => '40')) ?>
        </p>
        <p>
          <label for="technical_task">Техническое задание:</label>
          <? echo CHtml::activeTextArea($order, 'technical_task', array('cols' => '40', 'rows' => '10')) ?>
        </p>
        <p>
          <label for="tirazh">Тираж:</label>
          <input id="tirazh" type="text" name="Order[tirazh]" value="" size="40"/>
        </p>
        <p>
          <label for="maket">Прикрепите макет (если есть):</label>
          <?= CHtml::activeFileField($order, 'maket', array(
            'id' => 'maket',
            'data-filename-placement' => "inside",
            'title' => "Выбрать файл",
          )); ?>
        </p>

        <? if ($form_type == 'order'): ?>
          <p style="height:25px">
          <? if (!empty($payment_method)): ?>
            <p style="width:39%; float:left; height:75px;">
              <label for="payment_method">Предпочтительный способ оплаты:</label>
              <select id="payment_method" name="Order[payment_method]">
                <option value="">---</option>
                <? foreach ($payment_method as $item): ?>
                  <option value="<?= $item->id ?>"><?= $item->name ?></option>
                <? endforeach; ?>
              </select>
            </p>
          <? endif; ?>
          <p style="width:40%;margin-left:40%;height:75px;">
            <label for="billing_details">Загрузить реквизиты для выставления счета:</label>
            <?= CHtml::activeFileField($order, 'billing_details', array(
              'id' => 'billing_details',
              'data-filename-placement' => "inside",
              'title' => "Выбрать файл",
            )); ?>
          </p>
          <p>
            <label for="additional_info">Дополнительная информация:</label>
            <textarea id="additional_info" name="order[additional_info]" cols="40" rows="10"></textarea>
          </p>
        <? endif; ?>
        <div class="g-recaptcha" data-sitekey="<?php echo Yii::app()->params->reCaptchaSiteKey; ?>"></div>
        <p><input type="submit" value="Отправить заказ" class="wpcf7-form-control wpcf7-submit"/></p>
        <div class="wpcf7-response-output wpcf7-display-none"></div>
        <? echo CHtml::endForm() ?>
      <? endif; ?>
    </div>
  </div>
</div>