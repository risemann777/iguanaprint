<div class="container" id="page">
    <div class="row">
        <div class="span3">
            <ul class="side-nav">
                <li ><a href="/catalog/?section_id=<?=$section->id?>" title="На уровень выше"><?=$section->name?></a></li>
                <?if(!empty($cur_section_items)):?>
                <? // echo 'есть еще элементы'?>
                    <?foreach ($cur_section_items as $cur_section_item):?>
                        <li class="page_item page-item-768<?if($cur_section_item->id == $item->id):?> current_page_item<?endif;?>">
                            <a href="<?=$this->createUrl('/catalog/item', array('id' => $cur_section_item->id))?>"><?=$cur_section_item->name?></a>
                        </li>
                    <?endforeach;?>
                <?endif;?>
            </ul>
            <div class="boxed_content_prod">
                <div>
                    <strong>
                        <a href="<?=$this->createUrl('/requirements/')?>">
                            <p style="color:#357511; text-decoration: underline;">Требования к макетам</p>
                        </a>
                        <p></p>
                    </strong>
                </div>
            </div>
        </div>
        <div class="span9">
            <div style="text-align: center; font-size: 20px; color: #666; font-weight: bold;">
                <?
                if($item->meta_h1)
                    echo $item->meta_h1;
                else
                    echo $item->name;
                ?>
            </div>
            <p style="text-align: center;">
                <?if($item->detail_picture):?>
                    <img class="alignnone size-full wp-image-1552" src="<?=Files::getPath($item->detail_picture)?>" alt="<?=$item->name?>" />
                <?elseif($item->preview_picture):?>
                    <img class="alignnone size-full wp-image-1552" src="<?=Files::getPath($item->preview_picture)?>" alt="<?=$item->name?>" />
                <?endif;?>
            </p>
            <?if($item->detail_text){
                echo $item->detail_text;
            }?>

            <?if(isset($properties["price_name"]) || isset($properties["price_description"]) || isset($properties["price_table"])):?>
                <div class="sticky_box">
                    <div class="stickyy">
                        <?if(!empty($properties["price_name"]["value"])):?>
                            <h1><?=$properties["price_name"]["value"]?></h1>
                        <?endif;?>
                        <?if(!empty($properties["price_description"]["value"])):?>
                            <p style="margin-bottom: 15px;"><?=$properties["price_description"]["value"]?></p>
                        <?endif;?>
                        <?if(!empty($properties["price_table"]["value"])):?>
                            <div class="themeple_sc">
                                <div class="border-table">
                                    <?=$properties["price_table"]["value"]?>
                                </div>
                            </div>
                            <p>* Сумма указана без учета стоимости разработки макета.</p>
                        <?endif;?>
                    </div>
                </div>
            <?endif;?>
            <p><a class="btn-system btn_prod" href="/order?fom=p"><span class="btn_prod_span">Заказать!</span></a></p>
        </div>
    </div>
</div>