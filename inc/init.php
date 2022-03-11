<?php
error_reporting(E_ALL);
define("SELF_PATH",dirname(__FILE__));
include SELF_PATH.DS."konstanta".EXT;
include SELF_PATH.DS."functions/function_global".EXT;
mulai_session();
include SELF_PATH.DS."functions/function_peserta".EXT;
/**
 * Cek apakah Extensi PDO sudah terinstall
 * Karena sebagian besar web ini mengunakan teknik PDO
 * Untuk koneksi ke dabatabsenya
 */
$pdo_exetension = extension_loaded("pdo_mysql");
if($pdo_exetension === false){
    die("Extension PDO tidak terinstal di server");
}
//membuat koneksi ke databse dengan PDO
try {
    $host = $config['host'];
    $db_name = $config['db_name'];
    $pass = $config['pass'];
    $user = $config['user'];
    //membuat 
    $dsn = "mysql:host={$host};dbname={$db_name};";
    $db = new PDO($dsn,$user,$pass);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_SILENT);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $th) {
    print "ERROR: ".$th->getMessage();
    die();
}
//mengambil konfigurasi dari database
try{
    $sqh = $db->query("SELECT * FROM ".TB_SETTING);
}catch(PDOException $e){
    print_error($e->getMessage());
    die();
}
$pengaturan_from_db = array();
while ($set = $sqh->fetch()) {
    $pengaturan_from_db[$set['nama_pengaturan']] = $set['value'];
}
$config = array_merge($pengaturan_from_db,$config);
//menggenerate token csrf
$data = array();
$data['csrf_token'] = generate_csrf();
?>