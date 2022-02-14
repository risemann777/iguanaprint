<?php

class BackEndController extends CController
{
    // лейаут
    public $layout = 'main';

    // section
    public $type = 0;

    // меню
    public $menu = array();

    // крошки
    public $breadcrumbs = array();

    // заголовок страницы
    public $rightFrameTitle = array();

    // текущая секция блока
    public $find_section = 0;
    /*
        Фильтры
    */
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    /*
        Права доступа
    */
    public function accessRules()
    {
        return array(
            // даем доступ только админам
            array(
                'allow',
                'users'=>array('@'),
            ),
            // всем остальным разрешаем посмотреть только на страницу авторизации
            array(
                'allow',
                'actions'=>array('login','vkLogin','vkResult','googleLogin','googleResult','verify','recovery'),
                'users'=>array('?'),
            ),
            // запрещаем все остальное
            array(
                'deny',
                'users'=>array('*'),
            ),
        );
    }

    public function ajaxResponse($status, $message = '', $data = array(), $jsonp = false)
    {
        header('Content-Type: application/json');
        if (is_array($message)) {
            $data = $message;
            $message = '';
        }

        if($jsonp){
            echo $_GET['callback'].'('.json_encode(array(
                    'status' => $status,
                    'message' => $message,
                    'data' => $data,
                )).')';
        }else{
            echo json_encode(array(
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ));
        }

        return;
    }
}