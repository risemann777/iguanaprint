<?$productTypes = ProductType::model()->findAll();?>
<div class="catalog-menu">
    <div class="title">Каталог</div>
    <ul class="nav">
        <?foreach($productTypes as $productType):?>
            <li <?if($this->active_menu_item == $productType->id):?>class="active"<?endif;?>>
                <a href="<?= $this->createUrl('/catalog/types', array('id' => $productType->id));?>"><?=$productType->name?></a>
                <? $productKinds = ProductKind::model()->findAll('type_id = '.$productType->id)?>
                <?if(!empty($productKinds)):?>
                    <ul class="sub nav">
                        <?foreach($productKinds as $productKind):?>
                            <li>
                                <a href="<?= $this->createUrl('/catalog/items', array('id' => $productKind->id));?>"><?=$productKind->name?></a>
                            </li>
                        <?endforeach;?>
                    </ul>
                <?endif;?>
            </li>
        <?endforeach;?>
        <li>
            <a href="#">Радиостанции</a>
            <ul class="sub nav">
                <li><a href="#">Переносимые</a></li>
                <li><a href="#">Стационарные</a></li>
            </ul>
        </li>
    </ul>
</div>