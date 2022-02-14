<?php

class BlogController extends FrontEndController
{
    public function actionIndex()
    {
        $block_id = 1;

        $this->setPageTitle(Yii::app()->name.' | Статьи');

        $this->page_header = 'Статьи';

        $this->breadcrumbs = array(
            'Статьи'
        );

        $criteria = new CDbCriteria(array(
            'condition'=>'block_id=:block_id AND active=:active',
            'params'=>array(':block_id' => 1, 'active' => 'Y'),
            'order' => 'sort ASC, date_create DESC',
        ));

        if(isset($_REQUEST['tag'])){
            $criteria->with = array(
                'tagFilter' => array(
                    'params' => array(
                        ':tag' => $_REQUEST['tag']
                    )
                )
            );
        }

        $elements = new CActiveDataProvider('BlockElement', array(
            'criteria' => $criteria,
            'pagination' => false
        ));

        /* RECENT NEWS */
        $criteria = new CDbCriteria(array(
            'condition'=>'block_id=:block_id AND active=:active',
            'params'=>array(':block_id' => 1, 'active' => 'Y'),
            'order' => 'sort ASC, date_create DESC',
        ));

        $recent_news = new CActiveDataProvider('BlockElement', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5
            )
        ));

        /* TAGS LIST */
        $criteria = new CDbCriteria(array(
            'condition'=>'tag_block_id=:tag_block_id',
            'params'=>array(':tag_block_id' => 1),
            'order' => 'name ASC',
        ));

        $tags_list = new CActiveDataProvider('BlockTag', array(
            'criteria' => $criteria,
            'pagination' => false
        ));

        // echo '<pre>'; print_r($tags_list); echo '</pre>';

        $this->render('index', array(
            'elements' => $elements,
            'recent_news' => $recent_news,
            'tags_list' => $tags_list
        ));
    }

    public function actionItem($id)
    {
        $element = BlockElement::model()->with('tags')->findByPk($id);

        if(!empty($element))
        {
            $this->setPageTitle(Yii::app()->name.' | '.$element->name);

            $this->page_header = $element->name;

            $this->breadcrumbs = array(
                'Статьи' => array('/blog/'),
                $element->name
            );

            /* RECENT NEWS */
            $criteria = new CDbCriteria(array(
                'condition'=>'block_id=:block_id AND active=:active',
                'params'=>array(':block_id' => 1, 'active' => 'Y'),
                'order' => 'sort ASC, date_create DESC',
            ));

            $recent_news = new CActiveDataProvider('BlockElement', array(
                'criteria' => $criteria,
                'pagination' => array(
                    'pageSize' => 5
                )
            ));

            /* TAGS LIST */
            $criteria = new CDbCriteria(array(
                'condition'=>'tag_block_id=:tag_block_id',
                'params'=>array(':tag_block_id' => 1),
                'order' => 'name ASC',
            ));

            $tags_list = new CActiveDataProvider('BlockTag', array(
                'criteria' => $criteria,
                'pagination' => false
            ));

            $this->render('item', array(
                'element' => $element,
                'recent_news' => $recent_news,
                'tags_list' => $tags_list
            ));
        }else{
            $this->redirect($this->createUrl('/blog/'));
        }

    }
}