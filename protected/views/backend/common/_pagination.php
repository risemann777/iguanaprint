
<div class="text-center">
<?php
// $data->pagination->pageVar='page';
$this->widget('CLinkPager', array(
    'pages' => $data->pagination,
    'firstPageCssClass'=>'',
    'header' => '',
    'adminka' => '/admin',
    'firstPageLabel'=>'<i class="fa fa-angle-double-left"></i>',
    'lastPageLabel'=>'<i class="fa fa-angle-double-right"></i>',
    'maxButtonCount'=>5,
    'selectedPageCssClass'=>'page active',
    'previousPageCssClass'=>'page',
    'nextPageCssClass'=>'page',
    'hiddenPageCssClass'=>'disabled',
    'htmlOptions'=>array(
        'class'=>'pagination'
    ),
)); ?>
</div>