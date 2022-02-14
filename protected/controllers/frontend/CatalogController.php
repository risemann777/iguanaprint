<?php

class CatalogController extends FrontEndController
{
    public function actionIndex()
    {
        if(isset($_REQUEST["section_id"]))
        {
            $section_id = intval($_REQUEST["section_id"]);
            $section = BlockSection::model()->findByPk($section_id);
            $items = BlockElement::model()->findAll('block_section_id=:block_section_id', array(':block_section_id' => $section_id));

            if(!empty($section))
            {
                $this->setPageTitle(Yii::app()->name.' | '.$section->name);
                $this->page_header = $section->name;

                $this->breadcrumbs = array(
                    $section->name
                );

                $this->render('index', array(
                    'section' => $section,
                    'items' => $items
                ));
            }
            else
            {
                $this->redirect('/');
            }

        }
        else
        {
            $this->redirect('/');
        }

    }

    public function actionItem($id)
    {
        $item = BlockElement::model()->findByPk($id);

        if(!empty($item))
        {
            $this->setPageTitle(Yii::app()->name.' | '.$item->name);
            $this->page_header = $item->name;

            $section = BlockSection::model()->findByPk($item->block_section_id);
            $cur_section_items = BlockElement::model()->findAll('block_section_id=:block_section_id', array(':block_section_id' => $section->id));

            /* PROCESS ELEMENT PROPERTIES */
            $props = BlockElementProperty::model()->with('blockProperty')->findAll('block_element_id = '.$item->id);
            $properties = array();
            foreach($props as $value)
            {
                $properties[$value->blockProperty->code]['name'] = $value->blockProperty->name;
                $properties[$value->blockProperty->code]['value'] = $value->value;
            }

            $this->breadcrumbs = array(
                $section->name => array('/catalog/?section_id='.$section->id),
                $item->name
            );

            $this->render('item', array(
                'item' => $item,
                'section' => $section,
                'cur_section_items' => $cur_section_items,
                'properties' => $properties
            ));
        }
        else{
            $this->redirect('/');
        }
    }
}