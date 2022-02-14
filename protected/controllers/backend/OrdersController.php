<?php

class OrdersController extends BackEndController
{
    public function actionIndex()
    {
        $criteria = new CDbCriteria(array(
            'order' => 'id DESC'
        ));
        $orders = new CActiveDataProvider('Order', array(
            'criteria' => $criteria,
            'pagination'=> array(
                'pageSize'=> 20,
                'pageVar' => 'page'
            )
        ));
        $this->render('index', array(
            'orders' => $orders
        ));
    }
    public function actionView($id)
    {
        $order = Order::model()->findByPk($id);

        if(!empty($order))
        {
            if($order->payment_method){
                $payment = PaymentMethod::model()->findByPk($order->payment_method);
                $payment_method = $payment->name;
            }
            else{
                $payment_method = 'не указан';
            }

            $this->render('view', array(
                'order'=> $order,
                'payment_method' => $payment_method
            ));
        }
        else
        {
            $this->redirect($this->createUrl('/admin/orders'));
        }
    }

    public function actionDelete($id)
    {
        $order = Order::model()->findByPk($id);

        if($order->delete())
        {
            if($order->maket)
            {
                Files::deleteFile($order->maket);
            }
            if($order->billing_details)
            {
                Files::deleteFile($order->billing_details);
            }
            $this->redirect($this->createUrl('/admin/orders'));
        }
    }
}