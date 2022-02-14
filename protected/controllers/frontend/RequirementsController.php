<?php

class RequirementsController extends FrontEndController
{
    public function actionIndex(){
        $this->setPageTitle(Yii::app()->name.' | Требования к макетам');
        $this->breadcrumbs = array(
            'Требования к макетам'
        );
        $this->render('index');
    }
}