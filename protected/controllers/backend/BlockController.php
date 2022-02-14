<?php
class BlockController extends BackEndController
{
    public function actionIndex()
    {
        $current_user = Users::model()->findByPk(Yii::app()->user->id);

        if($current_user->role != 1){
            $this->redirect($this->createUrl('/admin/'));
        }else{
            $dataProvider = new CActiveDataProvider('Block', array(
                'pagination' => false
            ));

            $this->render('index', array(
                'data' => $dataProvider
            ));
        }
    }

    public function actionDelete($id)
    {
        $model = Block::model()->findByPk($id);
        if($model->delete()){
            $this->redirect($this->createUrl('/admin/block'));
        }
    }
}