<?php
if(cek_peserta_login()===false){
	redirect($config['url']."login");
	die;
}
$var['title'] = "homepage";
$var['content'] = load_page("pemilu/show-calon");

?>