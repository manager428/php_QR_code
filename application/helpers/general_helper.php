<?php

/**
 * fct_print_debug : 
**/
if ( ! function_exists('fct_print_debug'))
{
	function fct_print_debug($value) {
		print '<pre style="margin:5px;">'; print_r($value); print '</pre>';
	}
}
if ( ! function_exists('get_site_version')) {
	function get_site_version()
	{
		if(IS_DEV){
			return time();
		}else{
			return '20200301-1';
		}

	}
}
if ( ! function_exists('checkSubmit'))
{
	function checkSubmit() {
		if(isset($_POST['action']) && $_POST['action']='submit'){
			return true;
		}else{
			return false;
		}
	}
}
if ( ! function_exists('get_self_url')) {
	function get_self_url()
	{
		$scheme = "http";
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
			$scheme = "https";
		}
		return $scheme.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
}
function array_under_reset($array, $key, $type=1){
	if (is_array($array)){
		$tmp = array();
		foreach ($array as $v) {
			if ($type === 1){
				$tmp[$v[$key]] = $v;
			}elseif($type === 2){
				$tmp[$v[$key]][] = $v;
			}
		}
		return $tmp;
	}else{
		return $array;
	}
}
function array_rearrange($array){
	if(empty($array)) return array();

	$result = array();
	foreach($array as $key =>$val){
		$result[]=$val;
	}
	return $result;
}
function get_img_placeholder(){
	$placeholder = base_url().ASSETS_PATH.'/default/images/blank.jpg';
	return $placeholder;
}

function image_save_from_url($my_img, $fullpath){
	/*if($fullpath!="" && $fullpath){
		$fullpath = $fullpath."/".basename($my_img);
	}*/
	$ch = curl_init ($my_img);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	$rawdata=curl_exec($ch);
	curl_close ($ch);
	if(file_exists($fullpath)){
		unlink($fullpath);
	}
	$fp = fopen($fullpath,'x');
	fwrite($fp, $rawdata);
	fclose($fp);
}

function random($length, $numeric = 0) {
	$seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $seed[mt_rand(0, $max)];
	}
	return $hash;
}
function getFromUrl($url, $method = 'GET', $data = array())
{
	$ch = curl_init();
	$agent = 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0; Trident/5.0)';

	switch(strtoupper($method))
	{
		case 'GET':
			curl_setopt($ch, CURLOPT_URL, $url);
			break;

		case 'POST':
			$info = parse_url($url);
			$url = $info['scheme'] . '://' . $info['host'] . $info['path'];
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			break;

		default:
			return false;
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_REFERER, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	$res = curl_exec($ch);
	curl_close($ch);

	return $res;
}

if ( ! function_exists('check_word_url')) {
	function check_word_url($word) {
		if(strpos($_SERVER['REQUEST_URI'], $word) !== false){
			return 1;
		}else {
			return 0;
		}
	}
}

if ( ! function_exists('check_login')) {
	function check_login() {
        if($this->session->userdata('logged_in') !== TRUE){
        	redirect(base_url().'login');
        }
	}
}

function lan_site($title){
	$CI =& get_instance();
	$CI->load->database();
	$lan_id = $CI->session->userdata('lan_id');
	$sql = "SELECT * FROM ".LANGUAGE_SITE_TB." WHERE fro_titre = '". $title ."' AND lan_id='". $lan_id ."'";
	$query = $CI->db->query($sql);
	if($q_rslt = $query->result_object()){
		$text = $q_rslt[0]->fro_contenu;
	}else{
		$text = '';
	}
	return $text;
}