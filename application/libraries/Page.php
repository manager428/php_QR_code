<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page {

    function __construct()
    {

    }
    // --------------------------------------------------------------------
    function showpage($data=array(), $layout='', $view='')
    {
        $base_url=base_url();
        $theme_url=base_url().ASSETS_PATH.'/default/';
        $user_login_theme_url=base_url().ASSETS_PATH.'/user_login/';

        $view_file_path="";
        $CI=get_instance();
        $current_directory=$CI->router->fetch_directory();
        $current_controller=strtolower($CI->router->fetch_class());
        $current_method=$CI->router->fetch_method();
        $current_uri=strtolower($current_directory.$current_controller.'/'.$current_method);
        $base_dir=VIEWPATH.$current_directory;
        if(empty($view)){
            $view_file_path=$base_dir.$current_controller.'/'.$current_method.'.php';
        }else{
            $view_file_path=$base_dir.$view.'.php';
        }
        if(!file_exists($view_file_path)){
            $view_file_path=$base_dir.'index.php';
        }
        if($layout==''){
            $layout=$base_dir.'layout/main_layout.php';
        }else{
            $layout=$base_dir.'layout/'.$layout.'_layout.php';
        }
        include($layout);
        exit;
    }

}