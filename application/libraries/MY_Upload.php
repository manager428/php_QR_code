<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Upload extends CI_Upload{

    public function __construct($config = array())
    {
        parent::__construct($config);
    }

    public function upload_to_local($save_path, $field = 'file'){
        $upload_path = UPLOADS_PATH;
        if(!empty($save_path)){
            $upload_path = UPLOADS_PATH."/".$save_path;
        }
        if(!file_exists($upload_path) || !is_dir($upload_path))
            mkdir($upload_path, 0755, true);

        $config['upload_path']          = $upload_path;
        $config['allowed_types']        = 'gif|jpg|jpeg|png|mp3|wav|mp4|avi|wma';
        $config['max_size']             = 0;//UPLOAD_FILE_SIZE_MAX;
        $config['max_width']            = UPLOAD_IMAGE_WIDTH_MAX;
        $config['max_height']           = UPLOAD_IMAGE_HEIGHT_MAX;
        $this->initialize($config);

        if ( ! $this->do_upload($field)) {
            return array(false, $this->display_errors());
        }

        $upload_data = $this->data();

        $upload_file_name = $upload_data['file_name'];

        if(!empty($upload_file_name))
            return array(true, $upload_file_name);
        else
            return array(false, 'Upload failed');
    }

}