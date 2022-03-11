<?php
/**
 * Fungsi untuk mengecek token yang di submit
 * @param mixed $token
 * @return Boolean
 * **/
function check_token($token = null)
{
	//memanggil variabel $db
	global $db;
	//jika parameter $token nilainya null return false
	if(is_null($token))return false;
	//check token di database
	$check_token = $db->prepare("SELECT * FROM ".TB_PESERTA." WHERE BINARY(token)=:token");
	$data = array(
		":token"=>$token
	);
	if($check_token->execute($data)){
		if($check_token->rowCount() == 1){
			$data_user_login = $check_token->fetch(PDO::FETCH_OBJ);
			return $data_user_login;
		}else{
			return false;
		}
	}else{
		return true;
	}

}
/**
 * Fungsi untuk mengcek apakah peserta sudah login atau belum
 * @return bool
 */
function cek_peserta_login()
{

	if(!get_session('peserta_login')){
		return false;
	}
	return true;
}
/**
 * fungsi untuk mendapatkan data peserta yang sudah login
 * @param mixed $field
 * @return mixed
 */
function data_peserta_login($field = null)
{
	global $db;
	if(!get_session("peserta_login")){
		return false;
	}
	if(get_session("peserta_id")){
		$id = base64_decode(get_session('peserta_id'));
		$gets = $db->prepare("SELECT * FROM ".TB_PESERTA." WHERE id_peserta=:id");
		$data = array(
			":id"=>$id
		);
		if($gets->execute($data)){
			$hasil = $gets->fetch(PDO::FETCH_ASSOC);
			if(!empty($field)){
				return isset($hasil[$field]) ? $hasil[$field] : null;
			}else{
				return $hasil;
			}
		}
	}
}
?>