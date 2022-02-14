<?$current_user = Users::model()->findByPk(Yii::app()->user->id);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="/assets/images/favicon.png" type="image/x-icon" />

    <link rel="stylesheet/less" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.less"/>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/lesscss/less.min.js"></script>


    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/summernote/summernote.js"></script>

</head>
<body>

<div class="page-container <? if(Users::isNavLeft(Yii::app()->user->id)): ?>page-navigation-toggled page-container-wide<? endif; ?>">
    <div class="page-sidebar">
        <ul class="x-navigation <? if(Users::isNavLeft(Yii::app()->user->id)): ?>x-navigation-minimized<? endif; ?>">
            <li class="xn-logo">
                <a href="<?= $this->createUrl('/admin');?>" style="background: url(<?= Settings::getSetValue('logo_url'); ?>) center no-repeat #22242a;"></a>
                <a href="#" class="x-navigation-control"></a>
            </li>
            <li class="xn-profile">
                <div class="profile">
                    <div class="profile-data">
                        <div class="profile-data-name"><?= Users::getUserName(Yii::app()->user->id); ?></div>
                        <div class="profile-data-title"><?= Users::getUserEmail(Yii::app()->user->id); ?></div>
                    </div>
                </div>
            </li>
            <li class="<? if(Yii::app()->controller->id == 'site'):?> active <? endif; ?>">
                <a href="<?= $this->createUrl('/admin');?>">
                    <span class="fa fa-desktop"></span>
                    <span class="xn-text">Главная</span>
                </a>
            </li>

            <? // КПОПКА ПЕРЕХОДА В СПИСОК БЛОКОВ ?>
            <?$userID = Yii::app()->user->id?>
            <? if($userID == 1 || Users::isDetail($userID)): ?>
                <li class="<? if(Yii::app()->controller->id == 'block'):?> active <? endif; ?>">
                    <a href="<?= $this->createUrl('/admin/block');?>">
                        <span class="glyphicon glyphicon-th"></span>
                        <span class="xn-text">Блоки</span>
                    </a>
                </li>
            <? endif; ?>

            <?// вывод списка блоков ?>

            <?
            $сriteria = new CDbCriteria(array(
                'condition'=>'active=:active',
                'params'=>array('active' => 'Y'),
            ));
            $blocks = Block::model()->findAll($сriteria);
            ?>
            <?if(!empty($blocks)):?>
                <?
                $current_block_id = false;
                $current_section_id = false;
                if(isset($_REQUEST['block_id'])){
                    $current_block_id = $_REQUEST['block_id'];
                    $current_section_id = $_REQUEST['find_section'];
                }
                ?>
                <?foreach($blocks as $block):?>
                    <?
                    $сriteria = new CDbCriteria(array(
                        'condition'=>'block_id=:block_id',
                        'params'=>array('block_id' => $block->id),
                        'order'=>'left_margin ASC',
                    ));
                    $sections = BlockSection::model()->findAll($сriteria);
                    ?>
                    <li class="<?if(!empty($sections)):?>xn-openable<?endif;?> <?if($current_block_id == $block->id):?> active <?endif;?>">
                        <a href="<?= $this->createUrl('/admin/block_list', array('block_id' => $block->id, 'find_section' => 0));?>">
                            <span class="glyphicon glyphicon-list"></span>
                            <span class="xn-text"><?=$block->name?></span>
                        </a>
                        <?
                        if(isset($_REQUEST['find_section']))
                            $this->find_section = intval($_REQUEST['find_section']);
                        ?>
                        <?if(!empty($sections)):?>

                            <?
                            $TOP_DEPTH = 0;
                            $CURRENT_DEPTH = $TOP_DEPTH;

                            foreach($sections as $section)
                            {
                                if($CURRENT_DEPTH < $section->depth_level)
                                {
                                    echo "\n",str_repeat("\t", $section->depth_level-$TOP_DEPTH),"<ul>";
                                }
                                elseif($CURRENT_DEPTH == $section->depth_level)
                                {
                                    echo "</li>";
                                }
                                else
                                {
                                    while($CURRENT_DEPTH > $section->depth_level)
                                    {
                                        echo "</li>";
                                        echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
                                        $CURRENT_DEPTH--;
                                    }
                                    echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</li>";
                                }

                                echo "\n",str_repeat("\t", $section->depth_level-$TOP_DEPTH);
                                ?><li <?if($section->id == $this->find_section):?>class="active"<?endif;?> id="<?=$section->id;?>"><a href="<?= $this->createUrl('/admin/block_list', array('block_id' => $block->id, 'find_section' => $section->id));?>"><span class="fa fa-clipboard"></span><?=$section->name?></a><?

                                    $CURRENT_DEPTH = $section->depth_level;
                            }

                            while($CURRENT_DEPTH > $TOP_DEPTH)
                            {
                                echo "</li>";
                                echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
                                $CURRENT_DEPTH--;
                            }
                            ?>

                        <?endif;?>
                    </li>
                <?endforeach;?>
            <?endif;?>

            <li class="<? if(Yii::app()->controller->id == 'orders'):?> active <? endif; ?>">
                <a href="<?= $this->createUrl('/admin/orders');?>">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    <span class="xn-text">Заказы</span>
                </a>
            </li>

            <li class="<? if(Yii::app()->controller->id == 'users'):?> active <? endif; ?>">
                <a href="<?= $this->createUrl('/admin/users');?>">
                    <span class="glyphicon glyphicon-user"></span>
                    <span class="xn-text">Пользователи</span>
                </a>
            </li>
            <li class="<? if(Yii::app()->controller->id == 'settings'):?> active <? endif; ?>">
                <a href="<?= $this->createUrl('/admin/settings');?>">
                    <span class="glyphicon glyphicon-cog"></span>
                    <span class="xn-text">Настройки</span>
                </a>
            </li>
            <li>
                <a href="<?php echo Yii::app()->params->base_url; ?>">
                    <span class="glyphicon glyphicon-arrow-left"></span>
                    <span class="xn-text">Вернуться на сайт</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="page-content">
        <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
            <div>
                <li class="xn-icon-button">
                    <a href="#" class="x-navigation-minimize x-nav_my" id="nav_left">
                        <span class="fa fa-dedent"></span>
                    </a>
                </li>
                <li class="xn-icon-button pull-right last">
                    <a href="#" class="mb-control x-nav_my" data-box="#mb-signout">
                        <span class="fa fa-power-off"></span>
                    </a>
                </li>
            </div>
        </ul>

        <?php $this->renderPartial('/common/breadcrumbs', array()); ?>

        <div class="content-frame" style="overflow: hidden">

            <div id="t_rf">
                <?php $this->renderPartial('/common/right_frame_title', array()); ?>
            </div>

            <div class="content-frame-body">
                <div id="loader" class="loader" style="display: none">
                    <h4>Загрузка данных...</h4><img src="/assets/images/default.gif">
                </div>
                <?php echo $content; ?>
            </div>
        </div>

    </div>
</div>


<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title">
                <span class="fa fa-sign-out"></span> Выход ?</div>
            <div class="mb-content">
                <p>Вы уверены что хотите выйти?</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="<?= $this->createUrl('/admin/users/logout');?>" class="btn btn-success btn-lg">Да</a>
                    <button class="btn btn-default btn-lg mb-control-close">Нет</button>
                </div>
            </div>
        </div>
    </div>
</div>



<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/scrolltotop/scrolltopcontrol.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/morris/morris.min.js"></script>

<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/datepicker/js/bootstrap-datepicker.js'></script>
<script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/datepicker/locales/bootstrap-datepicker.ru.min.js'></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/owl/owl.carousel.min.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/bootstrap/bootstrap-select.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/imgLiquid.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/actions.js"></script>

<script>
    $(document).ready(function() {

        $('#nav_left').click(function(){
            $.ajax({
                url: '<?= $this->createUrl('admin/users/changeNavLeft');?>',
                type: "POST",
                data: {
                    id:'sd'
                },
                dataType: 'JSON'
            });
        });
    });
</script>

</body>
</html>






