<?php


class FrontEndController extends CController
{
    // лейаут
    public $layout = 'main';

    // меню
    public $menu = array();

    // крошки
    public $breadcrumbs = array();

    // активный пункт меню
    public $active_menu_item = 0;

    public $page_header = '';

    public $meta_title = '';

    public $meta_keywords = '';

    public $meta_description = '';


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