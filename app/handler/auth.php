<?php
/**
 * autentikasi handler
 * ^login
 */
if(cek_peserta_login()===true){
	redirect($config['url']);
	die;
}
if(input_get("auth_type")==="login"){
	
	if(is_ajax()){
		echo "hello world";
	}
	$var['title'] = "login";
	$var['page']  = "login";
	$var['content'] = load_page("auth/login");
}else{
	header("location:login");
}
