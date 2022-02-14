<div class="container">
  <div class="row-fluid">
    <aside class="span3 sidebar" id="widgetarea-sidebar">
      <? $this->renderPartial('/common/_sidebar_search'); ?>
      <? $this->renderPartial('/common/_sidebar_slider'); ?>
      <? $this->renderPartial('/common/_popular'); ?>
    </aside>
    <div class="span9">
      <div class="row-fluid row-dynamic-el " style="">
        <div class="container">
          <div class="row-fluid">
            <div class="span12 post_page_cont">
              <div class="header">
                <h5>О себе:</h5>
              </div>
              <p><span style="color: #333333;">Мы работаем на рынке полиграфических услуг уже более пяти лет&#8230; и т.д. и т.п. вобщем скучный текст как у всех в этом разделе сайта..</span>
              </p>
              <p><span style="color: #333333;">На самом деле нельзя передать, что за официальной статьей &#171;про нас&#187; скрываются интересные заказы, ответственность, восторг клиентов, встречи с уникальными людьми, радость от работы в позитивной команде и все то, что делает работу в полиграфии таким интересным и увлекательным!</span>
              </p>
              <p><span style="color:#a0ce4e; font-weight:bold;">Присоединяйтесь!</span><br/>
                <strong><span
                      style="color: #c33;">И позвольте нам стать Вашим надежным полиграфическим партнером!</span></strong>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="row-fluid row-dynamic-el " style="">
        <div class="container">
          <div class="row-fluid">
            <div class="span12">
              <div class="header">
                <h5>Как нас найти:</h5>
                <span class="border_style_color"></span>
              </div>
              <div class="map" style="height: 460px; background: #f0f0f0; clear: both;">
                <script type="text/javascript" charset="utf-8" async
                        src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=XYNNq0GcEaQHYXoW0kWDx1hP4HhBS7hT&amp;width=100%&amp;height=460&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row-fluid row-dynamic-el " style="">
        <div class="container">
          <div class="row-fluid">
            <div class="span12 post_page_cont">
              <div class="row-fluid">
                <div class="span6">
                  <div class="header">
                    <h5>Наши контакты:</h5>
                  </div>
                  <div class="boxed_content_red">
                    <div style="height: 436px;">
                      <p><strong>Адрес:</strong><br/>
                        <?= $address->value ?>
                      </p>
                      <p><strong>Телефон:</strong><br/><?= $phone->value ?></p>
                      <p><strong>E-mail:</strong><br/><?= $default_email->value ?></p>
                    </div>
                  </div>
                </div>
                <div class="span6">
                  <div class="header">
                    <h5>Форма обратной связи:</h5>
                  </div>
                  <div class="boxed_content_green">
                    <? if (Yii::app()->user->hasFlash('feedback_sent')): ?>
                      <p><? echo Yii::app()->user->getFlash('feedback_sent') ?></p>
                    <? else: ?>
                      <? echo CHtml::beginForm('/about/', 'post', array('class' => 'wpcf7-form')) ?>
                      <? if (!empty($errorMessage)): ?>
                        <div class="error-message">
                          <? foreach ($errorMessage as $errorItem): ?>
                            <p><? echo $errorItem ?></p>
                          <? endforeach; ?>
                        </div>
                      <? endif; ?>
                      <?php // echo CHtml::errorSummary($feedback); ?>

                      <p>
                        <? echo CHtml::activeLabel($feedback, 'name') ?>
                        <? echo CHtml::activeTextField($feedback, 'name') ?>
                      </p>
                      <p>
                        <? echo CHtml::activeLabel($feedback, 'email') ?>
                        <? echo CHtml::activeEmailField($feedback, 'email') ?>
                      </p>
                      <p>
                        <? echo CHtml::activeLabel($feedback, 'subject') ?>
                        <? echo CHtml::activeTextField($feedback, 'subject') ?>
                      </p>
                      <p>
                        <? echo CHtml::activeLabel($feedback, 'message') ?>
                        <? echo CHtml::activeTextArea($feedback, 'message') ?>
                      </p>
                    <div class="form-controls">
                      <? echo CHtml::submitButton('Отправить', array('class' => 'btn-submit')) ?>
                      <div class="g-recaptcha" data-sitekey="<?php echo Yii::app()->params->reCaptchaSiteKey; ?>"></div>
                    </div>

                      <p></p>
                      <? echo CHtml::endForm() ?>
                    <? endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row-fluid row-dynamic-el " style="">
        <div class="container">
          <div class="row-fluid">
            <div class="span12">
              <div class="header">
                <h5>Нам доверяют:</h5>
                <div class="pagination"><a href="" class="prev" title="Previous"></a><a href="" class="next"
                                                                                        title="Next"></a></div>
              </div>
              <section class="row-fluid clients">
                <div class="item">
                  <a href="http://www.shoko.ru" target="_blank">
                    <img src="/assets/uploads/2014/03/client_b-01.png" alt="">
                    <img src="/assets/uploads/2014/03/client_h-01.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="http://www.expoline.ru" target="_blank">
                    <img src="/assets/uploads/2014/03/client_b-02.png" alt="">
                    <img src="/assets/uploads/2014/03/client_h-02.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="http://www.l-pro.com" target="_blank">
                    <img src="/assets/uploads/2014/03/client_b-03.png" alt="">
                    <img src="/assets/uploads/2014/03/client_h-03.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="http://www.proklumbu.ru" target="_blank">
                    <img src="/assets/uploads/2014/03/client_b-04.png" alt="">
                    <img src="/assets/uploads/2014/03/client_h-04.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="http://www.srochnodengi.ru" target="_blank">
                    <img src="/assets/uploads/2014/03/client_b-06.png" alt="">
                    <img src="/assets/uploads/2014/03/client_h-06.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="http://www.bcnn.ru" target="_blank">
                    <img src="/assets/uploads/2014/03/client_b-05.png" alt="">
                    <img src="/assets/uploads/2014/03/client_h-05.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="http://www.bplab.ru/" target="_blank">
                    <img src="/assets/uploads/2014/03/client_b-07.png" alt="">
                    <img src="/assets/uploads/2014/03/client_h-07.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="http://www.autodevice-nn.ru/" target="_blank">
                    <img src="/assets/uploads/2014/03/client_b-08.png" alt="">
                    <img src="/assets/uploads/2014/03/client_h-08.png" alt="">
                  </a>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
