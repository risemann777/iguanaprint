<?php

class SettingsController extends BackEndController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Settings');
        $dataProvider->criteria->addCondition('hide = 0');

        $dataProvider_system = new CActiveDataProvider('Settings');
        $dataProvider_system->criteria->addCondition('hide = 1');

        $notify_mail = new CActiveDataProvider('NotifyEmail');

        if(isset($_REQUEST['id'])){
            $user = Settings::model()->findByPk($_REQUEST['id']);
            $user->value = $_REQUEST['value'];

            if(isset($_FILES['logo'])) {
                if($_FILES['logo']['name'] != '') {
                    $destination = $_SERVER['DOCUMENT_ROOT'].$_REQUEST['value'];

                    if(move_uploaded_file($_FILES['logo']['tmp_name'], $destination)){
                        chmod($destination, 0777);
                    }
                }
            }

            if($user->save()){
                $this->redirect($this->createUrl('/admin/settings'));
            }
        }

        if(isset($_REQUEST['name'])){
            $user = new Settings();
            $user->name = $_REQUEST['name'];
            $user->set_name = $_REQUEST['set_name'];
            $user->value = $_REQUEST['value'];
            $user->hide = $_REQUEST['hide'];

            if($user->save()){
                $this->redirect($this->createUrl('/admin/settings'));
            }
        }

        if(isset($_REQUEST['notify_email']))
        {
            if(isset($_REQUEST['notify_email']['id']))
            {
                $id = intval($_REQUEST['notify_email']['id']);
                $notify_email = NotifyEmail::model()->findByPk($id);
                $notify_email->email = $_REQUEST['notify_email']['email'];

                if(isset($_REQUEST['notify_email']['is_feedback'])){
                    $notify_email->is_feedback = 'Y';
                }else{
                    $notify_email->is_feedback = 'N';
                }

                if(isset($_REQUEST['notify_email']['is_order'])){
                    $notify_email->is_order = 'Y';
                }else{
                    $notify_email->is_order = 'N';
                }

                if($notify_email->save()){
                    $this->redirect($this->createUrl('/admin/settings'));
                }
            }
            else
            {
                // new email
                $notify_email = new NotifyEmail();
                $notify_email->email = $_REQUEST['notify_email']['email'];

                if(isset($_REQUEST['notify_email']['is_feedback'])){
                    $notify_email->is_feedback = 'Y';
                }else{
                    $notify_email->is_feedback = 'N';
                }

                if(isset($_REQUEST['notify_email']['is_order'])){
                    $notify_email->is_order = 'Y';
                }else{
                    $notify_email->is_order = 'N';
                }

                if($notify_email->save()){
                    $this->redirect($this->createUrl('/admin/settings'));
                }
            }
        }

        $this->render('index', array(
            'data' => $dataProvider,
            'data_system' => $dataProvider_system,
            'notify_mail' => $notify_mail
        ));
    }

    public function actionDelete($id)
    {
        $user = Settings::model()->findByPk($id);
        if($user->delete()){
            $this->redirect($this->createUrl('/admin/settings'));
        }
    }

    public function actionRemove_email($id)
    {
        $model = NotifyEmail::model()->findByPk($id);

        if($model->delete()){
            $this->redirect($this->createUrl('/admin/settings'));
        }
    }
}
