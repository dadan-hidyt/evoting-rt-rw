<?php
//untuk mendapatkan semua calon yang ada
function get_calon($no_calon = null)
{
    global $db;
    $where = !empty($no_calon) ? "WHERE nomor_calon='$no_calon'" : "";
    $tb_calon = TB_CALON;
    $get_calon = $db->prepare("SELECT * FROM {$tb_calon} $where");
    if($get_calon->execute()){
        if($get_calon->rowCount() > 0){
            $get_calon->setFetchMode(PDO::FETCH_ASSOC);
            $return_calon = array();
            while($calon = $get_calon->fetch()){
                $return_calon[] = $calon;
            }
            return $return_calon;
        }else{
            return null;
        }
    }

}

?>