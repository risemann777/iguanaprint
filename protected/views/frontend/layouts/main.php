<?
$default_email = Settings::model()->find('set_name=:set_name', array(':set_name' => 'default_email'));
$address = Settings::model()->find('set_name=:set_name', array(':set_name' => 'address'));
$phone = Settings::model()->find('set_name=:set_name', array(':set_name' => 'phone'));
$twitter = Settings::model()->find('set_name=:set_name', array(':set_name' => 'twitter'));
$facebook = Settings::model()->find('set_name=:set_name', array(':set_name' => 'facebook'));
// echo '<pre>'; print_r($phone); echo '</pre>';
?>
<!DOCTYPE html>
<html lang="ru-RU" class="css3transitions">
<head>
  <meta charset="UTF-8"/>
  <title><? echo $this->getPageTitle() ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <link rel='stylesheet' href='/assets/theme/init.css'/>
  <link rel='stylesheet' href='/assets/plugins/LayerSlider/css/layerslider.css'/>
  <link rel='stylesheet' href='/assets/plugins/contact-form-7/includes/css/styles.css'/>
  <link rel='stylesheet' href='/assets/plugins/revslider/rs-plugin/css/settings.css'/>
  <link rel='stylesheet' href='/assets/theme/style.css'/>
  <link rel='stylesheet' href='/assets/theme/css/bootstrap-responsive.css'/>
  <link rel='stylesheet' href='/assets/theme/css/mediaelementplayer.css'/>
  <link rel='stylesheet' href='/assets/theme/fancybox/source/jquery.fancybox.css'/>
  <link rel='stylesheet' href='/assets/theme/css/hoverex-all.css'/>
  <link rel='stylesheet' href='/assets/theme/css/vector-icons.css'/>
  <link rel='stylesheet' href='/assets/theme/css/jquery.easy-pie-chart.css'/>
  <link rel='stylesheet' href='/assets/plugins/page-list/css/page-list.css'/>
  <script src='/js/frontend/jquery-1.11.1.min.js'></script>
  <script src='/assets/vendor/js/jquery/jquery-migrate.min.js'></script>
  <script src='/assets/plugins/mailchimp/js/scrollTo.js'></script>
  <script src='/assets/plugins/contact-form-7/includes/js/jquery.form.min.js'></script>
  <script src='/assets/vendor/js/jquery/ui/core.min.js'></script>
  <script src='/assets/plugins/mailchimp/js/datepicker.js'></script>
  <script src='/assets/plugins/LayerSlider/js/layerslider.kreaturamedia.jquery.js'></script>
  <script src='/assets/plugins/LayerSlider/js/jquery-easing-1.3.js'></script>
  <script src='/assets/plugins/LayerSlider/js/jquerytransit.js?'></script>
  <script src='/assets/plugins/LayerSlider/js/layerslider.transitions.js'></script>
  <script src='/assets/plugins/revslider/rs-plugin/js/jquery.themepunch.revolution.min.js'></script>
  <script src='/assets/theme/js/jquery.easy-pie-chart.js'></script>
  <script src='/assets/theme/js/jquery.appear-1.1.1.modified.js'></script>
  <script src='/assets/theme/js/modernizr.custom.66803.js'></script>
  <script src='/assets/theme/js/animations.js'></script>
  <script src='/assets/theme/js/waypoints.min.js'></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="home page page-id-33 page-template-default header_3">
<div class="top_nav">
  <div class="container">
    <div class="row-fluid">
      <div class="span6">
        <div class="pull-left">
          <div id="text-2" class="widget widget_text">
            <div class="textwidget">тел.: <?= $phone->value ?> | mail: <?= $default_email->value ?></div>
          </div>
        </div>
      </div>
      <div class="span6">
        <div class="pull-right">
          <div id="social_widget-3" class="widget social_widget">
            <div class="row-fluid social_row">
              <div class="span12">
                <ul class="footer_social_icons">
                  <li class="mail"><a title="Написать нам" href="mailto:<?= $default_email->value ?>"><span></span></a>
                  </li>
                  <li class="twitter"><a title="Мы в Twitter" target="_blank"
                                         href="<?= $twitter->value ?>"><span></span></a></li>
                  <li class="facebook"><a title="Наша страница Facebook" target="_blank" href="<?= $facebook->value ?>"><span></span></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Header -->
<div id="page-bg"></div>
<header id="header" class="header_3">
  <div class="container">
    <div class="row-fluid">
      <div class="span12">
        <!-- Logo -->
        <div id="logo">
          <a href='/'><img src="/assets/uploads/2013/05/neo_logo-02.jpg" alt=""/></a>
        </div>
        <!-- #logo -->
        <form action="<?= $_SERVER["PHP_SELF"] ?>" id="search-form">
          <div class="input-append">
            <input type="text" size="16" placeholder="Поиск&hellip;" name="s" id="s">
            <button type="submit" class="more">Поиск</button>
          </div>
        </form>
        <div id="navigation" class="nav_top pull-right  ">
          <nav>
            <ul id="menu-home" class="menu themeple_megemenu">
              <li class="menu-item menu-item-type-post_type menu-item-object-page<? if (Yii::app()->controller->id == 'site'): ?> current-menu-item<? endif; ?>">
                <? echo CHtml::link('Главная', '/') ?>
              </li>
              <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children">
                <a>Продукция</a>
                <ul class="sub-menu non_mega_menu">
                  <li class="menu-item menu-item-type-post_type menu-item-object-page">
                    <? echo CHtml::link('Полиграфия', '/catalog/?section_id=1') ?>

                  </li>
                  <li class="menu-item menu-item-type-post_type menu-item-object-page">
                    <? echo CHtml::link('Интерьерная печать', '/catalog/?section_id=2') ?>
                  </li>
                  <li class="menu-item menu-item-type-post_type menu-item-object-page">
                    <? echo CHtml::link('Сувениры', '/catalog/?section_id=3') ?>
                  </li>
                </ul>
              </li>
              <li class="menu-item menu-item-type-post_type menu-item-object-page<? if (Yii::app()->controller->id == 'zakaz'): ?> current-menu-item<? endif; ?>">
                <? echo CHtml::link('Заказ', $this->createUrl('/order/')) ?>
              </li>
              <li class="menu-item menu-item-type-post_type menu-item-object-page<? if (Yii::app()->controller->id == 'requirements'): ?> current-menu-item<? endif; ?>">
                <? echo CHtml::link('Требования к макетам', $this->createUrl('/requirements/')) ?>
              </li>
              <li class="menu-item menu-item-type-post_type menu-item-object-page<? if (Yii::app()->controller->id == 'blog'): ?> current-menu-item<? endif; ?>">
                <? echo CHtml::link('Статьи', $this->createUrl('/blog/')) ?>
              </li>
              <li class="menu-item menu-item-type-post_type menu-item-object-page<? if (Yii::app()->controller->id == 'about'): ?> current-menu-item<? endif; ?>">
                <? echo CHtml::link('Контакты', $this->createUrl('/about/')) ?>
              </li>
            </ul>
          </nav>
        </div>
        <!-- #navigation -->
      </div>
    </div>
  </div>
</header>


<div class="top_wrapper">
  <? if (Yii::app()->controller->id == 'site'): ?>
    <? $this->renderPartial('/common/_main_slider') ?>
  <? else: ?>
    <div class="header_page">
      <div class="container">
        <div class="row-fluid">
          <div class="span6">
            <h4><? echo $this->page_header ?></h4>
          </div>
          <div class="pull-right">
            <?php $this->renderPartial('/common/breadcrumbs', array()); ?>
          </div>
        </div>
      </div>
    </div>
  <? endif; ?>
  <!-- .header -->
  <section id="content" class="sequentialchildren">
    <?= $content; ?>
  </section>
  <!-- Social Profiles -->
  <!-- Footer -->
</div>
<a href="#" class="scrollup">Scroll</a>
<div class="footer_wrapper">
  <footer id="footer">
    <div class="inner">
      <div class="container">
        <div class="row-fluid ff">
          <!-- widget -->
          <div class="span6">
            <div id="widget_contact_info-2" class="widget widget_contact_info">
              <h4 class="widget-title">Контакты:</h4>
              <p>Позвоните нам, напишите нам, приезжайте в гости!</p>
              <ul>
                <li class="address"><?= $address->value ?></li>
                <li class="phone">Phone: <span><?= $phone->value ?></span></li>
                <li class="email">Email: <span><?= $default_email->value ?></span></li>
                <li class="web">Web: <span>www.iguanaprint.ru</span></li>
              </ul>
            </div>
          </div>
          <? /*?>
                    <div class="span6">
                        <div id="tag_cloud-3" class="widget widget_tag_cloud">
                            <h4 class="widget-title">Метки:</h4>
                            <div class="tagcloud"><a href='tag/news/' class='tag-link-50' title='2 записи' style='font-size: 8pt;'>Новости</a>
                                <a href='tag/public-2/' class='tag-link-20' title='3 записи' style='font-size: 22pt;'>Публикации</a>
                                <a href='tag/event/' class='tag-link-19' title='2 записи' style='font-size: 8pt;'>События</a>
                            </div>
                        </div>
                    </div>
                    <?*/ ?>
        </div>
      </div>
    </div>
    <div id="copyright">
      <div class="container">
        <div class="row">
          <div class="span12">
            <? echo Yii::app()->name ?> © <? echo date('Y') ?>
            <div class="pull-right">
              <ul class="footer_social_icons">
                <li class="mail"><a title="Написать нам" href="mailto:<?= $default_email->value ?>"><span></span></a>
                </li>
                <li class="twitter"><a title="Мы в Twitter" target="_blank" href="<?= $twitter->value ?>"><span></span></a>
                </li>
                <li class="facebook"><a title="Наша страница Facebook" target="_blank"
                                        href="<?= $facebook->value ?>"><span></span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- #copyright -->
  </footer>
  <!-- #footer -->
</div>
<script src='/assets/plugins/contact-form-7/includes/js/scripts.js'></script>
<script src='/assets/plugins/wp-retina-2x/js/retina.js'></script>
<script src='/assets/theme/js/bootstrap.min.js'></script>
<script src='/assets/theme/js/jquery.easing.1.1.js'></script>
<script src='/assets/theme/js/jquery.easing.1.3.js'></script>
<script src='/assets/theme/js/jquery.mobilemenu.js'></script>
<script src='/assets/theme/js/isotope.js'></script>
<script src='/assets/theme/js/jquery.cycle.all.js'></script>
<script src='/assets/theme/js/customSelect.jquery.min.js'></script>
<script src='/assets/theme/js/jquery.flexslider-min.js'></script>
<script src='/assets/theme/fancybox/source/jquery.fancybox.js'></script>
<!--<script src='/assets/theme/fancybox/source/helpers/jquery.fancybox-media.js'></script>-->
<script src='/assets/theme/js/jquery.carouFredSel-6.1.0-packed.js'></script>
<script src='/assets/theme/js/mediaelement-and-player.min.js'></script>
<script src='/assets/theme/js/tooltip.js'></script>
<script src='/assets/theme/js/jquery.hoverex.js'></script>
<script src='/assets/theme/js/jquery.imagesloaded.min.js'></script>
<script src='/assets/theme/js/switcher.js'></script>
<script src='/assets/theme/js/main.js'></script>
<script src='/assets/vendor/js/comment-reply.min.js'></script>
<script src='/assets/theme/js/jquery.placeholder.min.js'></script>
<script src='/assets/theme/js/jquery.livequery.js'></script>
</body>
</html>



