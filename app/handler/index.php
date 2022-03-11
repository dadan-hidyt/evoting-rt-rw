<?php
if(cek_peserta_login()===false){
	redirect($config['url']."login");
	die;
}
//cek apakah sudah milih atau belum
if(sudah_milih()){
	unset($_SESSION['peserta_id']);
	unset($_SESSION['peserta_login']);
	set_session("error_mess","kamu sudah memilih sebelumnya!");
	redirect(url("login"));
}
$var['title'] = "homepage";
$var['content'] = load_page("pemilu/show-calon");

?>