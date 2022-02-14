<div class="row-fluid">
    <div class="span12">
        <div class="row-fluid row-dynamic-el  third_space" style="">
            <div class="container">
                <div class="row-fluid">
                    <div class="span12 dynamic_page_header" style="">
                        <h2 style="color:#187e24;">Выберите интересующий Вас тип продукции:</h2>
                        <p class="no_border" style="color:#CC3300;"></p>
                        <div class="btns"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid row-dynamic-el " style="">
            <div class="container">
                <div class="row-fluid">
                    <div class="span4 services_medium">
                        <a href="/catalog/?section_id=1"><span class="icon_up" style="background:url('/assets/uploads/2013/05/poly240-01.png') center no-repeat;"></span></a>
                        <h4><a href="/catalog/?section_id=1">Полиграфия</a></h4>
                        <span class="border_"></span>
                        <p></p>
                    </div>
                    <div class="span4 services_medium">
                        <a href="/catalog/?section_id=2"><span class="icon_up" style="background:url('/assets/uploads/2013/05/prod_type-02_blue.png') center no-repeat;"></span></a>
                        <h4><a href="/catalog/?section_id=2">Интерьерная печать</a></h4>
                        <span class="border_"></span>
                        <p></p>
                    </div>
                    <div class="span4 services_medium">
                        <a href="/catalog/?section_id=3"><span class="icon_up" style="background:url('/assets/uploads/2013/05/prod_type-03_green.png') center no-repeat;"></span></a>
                        <h4><a href="/catalog/?section_id=3">Сувенирная продукция</a></h4>
                        <span class="border_"></span>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid row-dynamic-el section-style" style="background-image:url(/assets/uploads/2013/05/slide_02.jpg); ">
            <div class="container">
                <div class="row-fluid">
                    <div class="row-fluid row-dynamic-el  third_space" style="">
                        <div class="container">
                            <div class="row-fluid">
                                <div class="span12 dynamic_page_header" style="">
                                    <h2 style="color:#187e24;">Готовы перейти к оформлению заказа?</h2>
                                    <p class="no_border" style="color:#cc3300;"><strong>Разместить заказ очень просто! Свяжитесь с нами выбрав наиболее удобный для Вас способ:</strong></p>
                                    <div class="btns"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid row-dynamic-el " style="">
                        <div class="container">
                            <div class="row-fluid">
                              <?if(isset($settings['phone'])):?>
                                <div class="span4 services_creative" style="background:#fff;">
                                    <span class="icon_wrapper"><i class="moon-phone-4 icon"></i></span>
                                    <h4><a href="tel:<?=$settings['phone']?>">Позвоните нам!</a></h4>
                                    <p><font size="5"><?=$settings['phone']?></font></p>
                                    <a href="/about/" class="link">Контакты</a>
                                </div>
                              <?endif;?>
                              <?if(isset($settings['default_email'])):?>
                                <div class="span4 services_creative" style="background:#fff;">
                                    <span class="icon_wrapper"><i class="moon-quill-3 icon"></i></span>
                                    <h4><a href="mailto:<?=$settings['default_email']?>">Напишите E-mail!</a></h4>
                                    <p><font size="5"><?=$settings['default_email']?></font></p>
                                    <a href="mailto:<?=$settings['default_email']?>" class="link">Отправить письмо</a>
                                </div>
                              <?endif;?>
                                <div class="span4 services_creative" style="background:#fff;">
                                    <span class="icon_wrapper"><i class="moon-cart-5 icon"></i></span>
                                    <h4><a href="#">Воспользуйтесь формой</a></h4>
                                    <p><font size="5">заказа</font></p>
                                    <a href="/order/" class="link">Перейти к форме</a>
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
                    <?if($recent_news->totalItemCount > 0):?>
                        <div class="span6 recent_news">
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="header">
                                        <h5>Последние новости:</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12">
                                    <?foreach ($recent_news->getData() as $item):?>
                                        <dl class="news-article blog-article style_2 dl-horizontal">
                                            <dt>
                                                <span class="date"><?=Yii::app()->dateFormatter->format('dd', $item->date_create)?></span>
                                                <span class="month"><?=Yii::app()->dateFormatter->format('MMM', $item->date_create)?>
                                                </span><span class="year"><?=Yii::app()->dateFormatter->format('yyyy', $item->date_create)?></span></dt>
                                            <dd>
                                                <h5><a href="<?=$this->createUrl('/blog/item', array('id' => $item->id))?>"><?=$item->name?></a></h5>
                                                <p><?=$item->preview_text?></p>
                                            </dd>
                                        </dl>
                                    <?endforeach;?>
                                </div>
                            </div>
                        </div>
                    <?endif;?>
                    <div class="span6 get_free_quote">
                        <div class="header">
                            <h5>Подпишитесь на нашу рассылку:</h5>
                        </div>
                        <div class="box">
                            <p>Хотите получать информацию о специальных предложениях и акциях на полиграфическую продукцию?</p>
                            <form action="https://iguanaprint.us3.list-manage.com/subscribe/post?u=949f4f85c3cebc430d6e399ed&amp;id=536ce40955" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <input type="text" placeholder="Ваше имя" id="mce-FNAME" name="FNAME" /><input type="email" placeholder="E-mail" id="mce-EMAIL" name="EMAIL" />
                                <div id="mce-responses" class="clear">
                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <div style="position: absolute; left: -5000px;"><input type="text" name="b_949f4f85c3cebc430d6e399ed_536ce40955" value=""></div>
                                <input type="submit" value="Подписаться" name="subscribe" id="mc-embedded-subscribe" class="btn-system" style="width:135px">
                        </div>
                        <span class="shadow"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid row-dynamic-el section-style" style="background-color:#f0f0f0; ">
            <div class="container">
                <div class="row-fluid">
                    <div class="row-fluid row-dynamic-el " style="">
                        <div class="container">
                            <div class="row-fluid">
                                <div class="span12 services_group">
                                    <div class="header">
                                        <h4 style="color:#c33">Почему стоит выбрать нас?</h4>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span3 left_desc">
                                            <h6>Для этого есть множество причин!</h6>
                                            <p>Качественная деловая полиграфия и сувенирная продукция формируют успешный имидж Вашей компании, увеличивают показатели узнаваемости торговой марки и лояльности клиентов.</p>
                                        </div>
                                        <div class="span9">
                                            <dl class="dl-horizontal">
                                                <dt><i class="moon-brush" style="color:#187e24"></i></dt>
                                                <dd>
                                                    <h4 style="color:#c33">Дизайн</h4>
                                                    <p>Наши дизайнеры разработают для Вас макеты полиграфической продукции или помогут внести корректировки в существующий макет.</p>
                                                </dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt><i class="moon-spinner" style="color:#187e24"></i></dt>
                                                <dd>
                                                    <h4 style="color:#c33">Сроки</h4>
                                                    <p>Современное оборудование и автоматизированная система обработки заказов позволяют нам решать интересные задачи в короткие сроки.</p>
                                                </dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt><i class="moon-search" style="color:#187e24"></i></dt>
                                                <dd>
                                                    <h4 style="color:#c33">Качество</h4>
                                                    <p>Строгий контроль на каждом этапе производства позволит Вам быть уверенными в качестве исполнения заказа.</p>
                                                </dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt><i class="moon-star" style="color:#187e24"></i></dt>
                                                <dd>
                                                    <h4 style="color:#c33">Креатив</h4>
                                                    <p>Мы умеем разрабатывать новые виды и конструкции фирменной упаковки и сделаем ваш продукт или сувенир по настоящему уникальным.</p>
                                                </dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt><i class="moon-graduation" style="color:#187e24"></i></dt>
                                                <dd>
                                                    <h4 style="color:#c33">Знания</h4>
                                                    <p>Мы регулярно работаем над изучением новых инновационных технологий для того чтобы наша продукция удовлетворяла самым взыскательным требованиям.</p>
                                                </dd>
                                            </dl>
                                            <dl class="dl-horizontal">
                                                <dt><i class="moon-cog" style="color:#187e24"></i></dt>
                                                <dd>
                                                    <h4 style="color:#c33">Партнерство</h4>
                                                    <p>Мы стремимся к установлению долгосрочных партнерских отношений с нашими клиентами, поэтому работа с нашей типографией становится для них действи- тельно взаимовыгодным сотрудничеством.</p>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
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
                            <div class="pagination"><a href="" class="prev" title="Previous"></a><a href="" class="next" title="Next"></a></div>
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