<?php
/**
 * Aplikasi pemilihan ketua RT/RW berbasis web
 * @link http://hanjuangcoder.my.id/ertvoting
 * @license BELUM ADA
 * @author dadan <dadanhidyt@gmail.com>
 * PERINGATAN
 *  1.dilarang memperjual  belikan aplikasi ini tanpa seijin pengembang
 *  2.dilarang merusak aplikasi ini
 *  3.Jika ingin mngembangkan silahkan hubungi kontak pengembang
 */
define("BASE_PATH",dirname(__FILE__));
define("DS",DIRECTORY_SEPARATOR);
define("EXT",".php");
//including file configurasi
include BASE_PATH.DS."config/config.php";
include BASE_PATH.DS."inc/init.php";
$app = "index";
if(isset($_GET['app']) && !empty($_GET['app'])){
    $app = $_GET['app'];
}
$handler_path = BASE_PATH.DS."app/handler".DS.$app.EXT;
$page = array(
    "index",
    "auth",
    "kotak-suara",
    "detail-calon",
    "sudah-pilih",
    "tidak-memilih",
);
//cek apakah halaman ada
if(!file_exists($handler_path) && !in_array($app,$page)){
    tampil_404();
    die;
}
//untuk mengecek apakah pemilihan sudah di tutup
if(get_config('tutup_pemilihan') == "true"){
	print file_get_contents(BASE_PATH.DS."template/pemilihan_di_tutup.html");
	die;
}
//include page handler
include $handler_path;
//set root page
$root_page = load_page("root_page");
echo $root_page;
unset($var);
$db = NULL;
?>