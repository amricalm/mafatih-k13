<?php
class Lck_model extends CI_Model
{
    function construct()
    {
        parent::__construct();
    }
    function get($kd_sekolah,$th_ajar,$kd_semester,$tk,$kd_jurusan,$kd_mp)
    {
        $sql       = " select sys.nilai, isnull(lck.deskripsi,'') deskripsi
                        from sys_nilai_skala sys
                        left outer join tlck_template lck
                        on sys.nilai = lck.nilai ";
 
        $sql       .= " and lck.kd_sekolah = '$kd_sekolah' ";
        $sql       .= " and lck.th_ajar      = '$th_ajar' ";
        $sql       .= " and lck.p_nl         = '$kd_semester' ";
        
        $sql       .= " and lck.tk           = '$tk' ";
        $sql       .= " and lck.kd_jurusan   = '$kd_jurusan' ";
        $sql       .= " and lck.kd_mp        = '$kd_mp' ";
           
        $hasil      = $this->db->query($sql);
        
        return $hasil;
    }
}

?>