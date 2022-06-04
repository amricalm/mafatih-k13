<?php 
class Sekolah_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($kd='')
    {
        $sql            = " SELECT *,year(th_diri) th,month(th_diri) bln,day(th_diri) hr ";
        $sql            .= " FROM ms_sekolah ";
        if($kd !='')
        {
            $sql        .= " where kd_sekolah = '$kd' ";
        }
        $sql            .= " order by nama_sekolah ";
        $hasil          = $this->db->query($sql);
        return $hasil;        
    }
    function simpan($data)
    {
        return $this->db->insert('ms_sekolah',$data);
    }
    function update($kd,$data)
    {
        $this->db->where('kd_sekolah',$kd);
        return $this->db->update('ms_sekolah',$data);
    }
    function hapus($kd)
    {
        $this->db->where('kd_sekolah',$kd);
        return $this->db->delete('ms_sekolah');
    }
}
?>