<?php
function tampil_404()
{
	header("HTTP/1.1 404 Not Found");
	print file_get_contents(BASE_PATH.DS."template/404.html");
}
function get_config($key = "")
{
	global $config;
	if(empty($config)){
		return;
	}
	if(!empty($key)){
		return isset($config[$key]) ? $config[$key] : null;
	}else{
		return $config;
	}

}
//simple parse page
function load_page($file, $data = [])
{
	global $config,
	$var,
	$data;
	if(!empty($data) && is_array($data)){
		extract($data);
	}
	if(!empty($var) && is_array($var)){
		extract($var);
	}
	$var['url'] = $config['url'];
	$path = BASE_PATH.DS."app/view/{$file}.html";//path url file
	if(!file_exists($path)) return;
	ob_start();
	include $path;
	$content = ob_get_clean();
	$context = preg_replace_callback("/\{(\w+\s{0,5}?(\w+)?)\}/i", function($v)use($config,$var,$data)
	{
		$key = $v[1];
		if(isset($var[$key])){
			return $var[$key];
		}
		if(preg_match("/config\s{0,4}(\w+)/", $key,$vars)){
			if(isset($config[$vars[1]])){
				return $config[$vars[1]];
			}
		}elseif(isset($data[$key])){
			if(isset($data[$key])){
				return $data[$key];
			}
		}
	}, $content);
	return $context;
}

function input_get($key = "")
{
	if(!empty($key)){
		$v = isset($_GET[$key]) ? $_GET[$key] : false;
		return $v;
	}else{
		return $_GET;
	}
}
function input_post($key = "")
{
	if(empty($key)){
		return;
	}else{
		if(isset($_POST[$key])){
			return $_POST[$key];
		}else{
			return $_POST;
		}
	}
}
function server()
{

}
function anti_xss()
{

}

function text_sekuriti($string = "")
{
	$string = trim($string);
	$string = stripslashes($string);
	$string = strip_tags($string);
	$string = htmlspecialchars($string,ENT_QUOTES);
	$string = str_replace("&amp;#", "&#", $string);
	return $string;
}
function redirect($to = null){
	header("location:$to");
}
function mulai_session()
{
	$session_name = SESS_NAME;
	session_name($session_name);
	$cookie_params = session_get_cookie_params();
	$domain = $cookie_params['domain'];
	session_set_cookie_params(0,"/",$domain,false,true);
	session_start();
	session_regenerate_id();

}
function get_session($key = null)
{
	if(!empty($key)){
		if(!isset($_SESSION[$key])){
			return false;
		}else{
			return $_SESSION[$key];
		}
	}
}
function set_session($key = false, $value = false){
	if(!empty($key) || !empty($value)){
		return $_SESSION[$key] = $value;
	}
}

function generate_csrf()
{
	if(!get_session("csrf")){
		$_SESSION['csrf'] = bin2hex(random_bytes(32));
	}
	return $_SESSION['csrf'];
}

function output_json($data = null)
{
	if(is_null($data)){
		return false;
	}
	return json_encode($data);
}

function is_ajax()
{
	
}

function verifikasi_csrf($token = null){
	if(is_null($token) && empty($token)){
		return false;
	}
	if(get_session('csrf') === $token){
		return true;
	}else{
		return false;
	}
}
//fungsi untuk url
function url()
{
	global $config;
	return $config['url'];
}
function upload()
{

}
//fungsi untuk membuat random tokens
function buat_random_token($nik = null){
	$range = array_merge(range("A","Z"),range(0,9));
	shuffle($range);
	$nik = "3211172910030001";
	$token = "";
	for ($i=0; $i <=7 ; $i++) { 
		$token .= $range[$i];
	}
	$token = $nik.$token;
	return $token;
}


function print_error($error = "")
{
	print "<b>Kesalahan: </b>".$error;
}

//END code