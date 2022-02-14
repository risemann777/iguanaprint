<?php

class SearchController extends FrontEndController
{
    public function actionIndex()
    {
        if(isset($_REQUEST['q']))
        {

            $match = strip_tags($_REQUEST['q']);
            $match = addcslashes($match, '%_'); // escape LIKE's special characters

            $q = new CDbCriteria( array(
                'condition' => "name LIKE :match",         // no quotes around :match
                'params'    => array(':match' => "%$match%")  // Aha! Wildcards go here
            ) );

            $result = new CActiveDataProvider('BlockElement', array(
                'criteria' => $q,
                'pagination' => array(
                    'pageSize' => 10,
                    'pageVar' => 'page'
                )
            ));

            // $result = BlockElement::model()->findAll( $q );     // works!

            $this->meta_title = 'Поиск';
            $this->page_header = 'Результаты поиска';

            $this->breadcrumbs = array(
                'Результаты поиска по запросу: "'.$match.'""'
            );

            $this->render('index', array(
                'match' => $match,
                'result' => $result
            ));

        }else{
            $this->redirect($this->createUrl('/site/index'));
        }


    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
}
