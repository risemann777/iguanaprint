<?php

class SiteController extends BackEndController
{
    public function actionIndex()
    {
		$seo = Seo::model()->find('name = "main"');
        $resources_seo = Seo::model()->find('name = "resources"');
        $brief_seo = Seo::model()->find('name = "brief"');

        if(isset($_REQUEST['main_seo']))
        {
            $seo->attributes = $_REQUEST['main_seo'];

            if($seo->save())
            {
                $this->redirect('/admin/');
            }
        }

        if(isset($_REQUEST['resources_seo']))
        {
            $resources_seo->attributes = $_REQUEST['resources_seo'];

            if($resources_seo->save())
            {
                $this->redirect('/admin/');
            }
        }

        if(isset($_REQUEST['brief_seo']))
        {
            $brief_seo->attributes = $_REQUEST['brief_seo'];

            if($brief_seo->save())
            {
                $this->redirect('/admin/');
            }
        }

        $this->render('index', array(
            'seo' => $seo,
            'resources_seo' => $resources_seo,
            'brief_seo' => $brief_seo
        ));
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
