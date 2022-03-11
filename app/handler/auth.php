<?php
/**
 * autentikasi handler
 * ^login
 */

if(input_get("auth_type")==="login"){
	//cek apakah sudah login jika sudah login
	//arahkan ke halaman pemilihan
	if(cek_peserta_login()===true){
		redirect($config['url']);
		die;
	}
	$var['title'] = "login";
	$var['page']  = "login";
	$var['content'] = load_page("auth/login");
}elseif(input_get("auth_type")==="logout"){
	unset($_SESSION['peserta_id']);
	unset($_SESSION['peserta_login']);
	redirect($config['url']."login");
	die;
}else{
	header("location:login");
}
