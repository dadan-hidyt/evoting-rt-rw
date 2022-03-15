<?php
/**ajax request handler*/
define("BASE_PATH",dirname(dirname(__FILE__)));
define("DS",DIRECTORY_SEPARATOR);
define("EXT",".php");
include '../config/config.php';
include '../inc/init.php';
header("content-type:application/json");
//cek apakah ada token csrf
if(!isset($_POST['token']) && !isset($_GET['token']))
{
	print output_json([
		"status"=>203,
		"message"=>"csrf tidak di temukan"
	]);
	die;
}
//verifikasi token csrf
$token = !empty($_POST['token']) ? $_POST['token'] : $_GET['token'];
if(!verifikasi_csrf($token)){
	print output_json([
		"status"=>203,
		"message"=>"csrf tidak valid"
	]);	
	die;
}
//request type nya apa
$req_type = input_get('req_type');
if($req_type === "auth"){
	$auth_type = input_get("auth");
	if($auth_type === "cek_login"){
		$token = text_sekuriti(input_post('token_login'));
		set_session('last_input',$token);
		if($token == ""){
			print output_json([
				"status"=>203,
				"message"=>"Token masih kosong silahkan cobalagi"
			]);
			die;
		}
		//cek token yang di ketikan pengguna
		$check = check_token($token);
		//jika bernilai true berarti token valid
		if($check){
			$id = $check->id_peserta;
			set_session("peserta_login",true);
			set_session("peserta_id",base64_encode($id));
			print output_json([
				"status"=>200,
				"message"=>"Token valid! Tunggu sebentar..."
			]);
		}else{
			print output_json([
				"status"=>203,
				"message"=>"Maaf token yang kamu ketikan tidak benar, silahkan coba lagi"
			]);
		}
	}
}elseif($req_type == 'get_calon'){
	$calon = get_calon();
	if(!empty($calon)){
		print output_json(["status"=>200,"data"=>$calon]);
	}else{
		echo "22222222";
	}
}
