<div class="container" id="blog">
    <div class="row">
        <aside class="span3 sidebar" id="widgetarea-sidebar">
            <?$this->renderPartial('/common/_sidebar_search');?>
            <?$this->renderPartial('/common/_sidebar_slider');?>
            <?$this->renderPartial('/common/_popular');?>
        </aside>
        <div class="span9">
            <div class="prodstyle">
                <div align="center"><strong><? echo $section->meta_h1; ?></strong></div>
                <?if(!empty($items)):?>
                    <? // echo 'есть элементы'?>
                    <br>
                    <div class="page-list page-list-ext pl-text">
                        <?foreach ($items as $item):?>
                            <div class="page-list-ext-item">
                                <?if($item->preview_picture):?>
                                    <div class="page-list-ext-image">
                                        <a href="<?=$this->createUrl('/catalog/item', array('id' => $item->id))?>" title="<?=$item->name?>">
                                            <img src="<?=Files::getPath($item->preview_picture)?>" width="100" alt="<?=$item->name?>" />
                                        </a>
                                    </div>
                                <?endif;?>
                                <h3 class="page-list-ext-title"><a href="<?=$this->createUrl('/catalog/item', array('id' => $item->id))?>" title="<?=$item->name?>"><?=$item->name?></a></h3>
                            </div>
                        <?endforeach;?>
                    </div>
                <?endif;?>
                <?
                if($section->description){
                    echo $section->description;
                }?>
            </div>
        </div>
    </div>
</div>