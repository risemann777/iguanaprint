<?
$this->widget('CLinkPager', array(
    'pages' => $dataProvider->pagination,
    'firstPageCssClass'=>'first-page hidden',
    'lastPageCssClass'=>'last-page hidden',
    'header' => '',
    'firstPageLabel'=>'<<',
    'lastPageLabel'=>'>>',
    'nextPageLabel'=>'>',
    'prevPageLabel'=>'<',
    'maxButtonCount'=> 5,
    'selectedPageCssClass'=>'active',
    'previousPageCssClass'=>'prev-page',
    'nextPageCssClass'=>'next-page',
    'hiddenPageCssClass'=>'disabled hidden',
    'htmlOptions'=>array(
        'class'=>'pagination'
    ),
)); ?>

<? // php $this->widget('СLinkPager', array('pages'=>$data->pagination)); ?>
