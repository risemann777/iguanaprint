<?php
if (!is_null($this->breadcrumbs)) {
    if(empty($this->breadcrumbs)){
        $home = false;
        $this->breadcrumbs = array(
            'Главная'=>'/'
        );
        $active = '<li><a class="active" href="{url}">{label}</a></li>';
    }else{
        $home = '<li><a href="/">Главная</a></li>';
        $active = '<li class=""><a href="{url}">{label}</a></li>';
    }
    $this->widget('zii.widgets.CBreadcrumbs', array(
        'links' => $this->breadcrumbs,
        'separator'=>'',
        'activeLinkTemplate'=>$active,
        'inactiveLinkTemplate'=>'<li>{label}</li>',
        'homeLink'=>$home,
        'tagName'=>'ul',
        'htmlOptions'=>array(
            'class'=>'breadcrumb',
        )
    ));
}