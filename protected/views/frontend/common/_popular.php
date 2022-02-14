<?
$popular = BlockElement::model()->findAll('block_id=:block_id AND is_popular=:is_popular', array(':block_id' => 2, ':is_popular' => 'Y'));
?>
<?if(!empty($popular)):?>
    <div class="widget widget_shortcode">
        <h5 class="widget-title">Популярные продукты:</h5>
        <div class="row-fluid">
            <ul class="page-list ">
                <?foreach ($popular as $item):?>
                    <li class="page_item"><a href="<?=$this->createUrl('/catalog/item', array('id' => $item->id))?>"><?=$item->name?></a></li>
                <?endforeach;?>
            </ul>
        </div>
    </div>
<?endif;?>