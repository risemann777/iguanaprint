<?php

class SiteController extends FrontEndController
{
  public function actionIndex()
  {
    $this->setPageTitle(Yii::app()->name . ' | Главная');

    $seo = Seo::model()->find('name = "main"');
    $this->page_header = $seo->meta_h1;

    if ($seo->meta_title) {
      $this->meta_title = $seo->meta_title;
    } else {
      $this->meta_title = $seo->name;
    }

    $this->meta_keywords = $seo->meta_keywords;
    $this->meta_description = $seo->meta_description;

    $settings = array(
      'default_email' => Settings::model()->find('set_name=:set_name', array(':set_name' => 'default_email'))->value,
      'phone' => Settings::model()->find('set_name=:set_name', array(':set_name' => 'phone'))->value
    );

    // we filtering publication by news tag
    $criteria = new CDbCriteria(array(
      'with' => array(
        'tagFilter' => array(
          'params' => array(
            ':tag' => 'news'
          )
        )
      ),
      'condition' => 'block_id=:block_id AND active=:active',
      'params' => array(':block_id' => 1, 'active' => 'Y'),
      'order' => 'sort ASC, date_create DESC',
    ));

    $recent_news = new CActiveDataProvider('BlockElement', array(
      'criteria' => $criteria,
      'pagination' => array(
        'pageSize' => 2
      )
    ));

    $this->render('index', array(
      'recent_news' => $recent_news,
      'settings' => $settings
    ));

  }

  public function actionReg()
  {
    $this->render('reg');
  }

  public function actionLogout()
  {
    Yii::app()->user->logout();
    $this->redirect(Yii::app()->homeUrl);
  }

  public function actionError()
  {
    if ($error = Yii::app()->errorHandler->error) {
      if (Yii::app()->request->isAjaxRequest)
        echo $error['message'];
      else
        $this->render('error', $error);
    }
  }
}
