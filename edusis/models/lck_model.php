<?php
class Lck_model extends CI_Model
{
    function construct()
    {
        parent::__construct();
    }
    function get($kd_sekolah,$th_ajar,$kd_semester,$tk,$kd_jurusan,$kd_mp)
    {
        $sql       = " select sys.nilai,jn.ket as aspek, coalesce(lck.deskripsi,'') deskripsi
                        from sys_nilai_skala sys
                        
                        cross join
                        (             
                        select 'Pengetahuan' as ket
                        UNION 
                        select 'Keterampilan' as ket
                        UNION
                        select 'Sikap' as ket
                        )jn
                        
                        left outer join tlck_template lck
                        on sys.nilai = lck.nilai 
                        and jn.ket = lck.jn_nilai";
                        
 
        $sql       .= " and lck.kd_sekolah = '$kd_sekolah' ";
        $sql       .= " and lck.th_ajar      = '$th_ajar' ";
        $sql       .= " and lck.p_nl         = '$kd_semester' ";
 
        $sql       .= " and lck.kd_jurusan   = '$kd_jurusan' ";
        
        if($kd_sekolah!='02')
        {
            $sql       .= " and lck.tk           = '$tk' ";
            $sql       .= " and lck.kd_mp        = '$kd_mp' ";
        }
        
        $sql        .= " order by sys.nilai, jn.ket ";
           
        $hasil      = $this->db->query($sql);
        
        return $hasil;
    }
}

?>