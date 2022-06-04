<?php 
class kepribadian_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($kd='')
    {
        $sql            = " SELECT kd_pribadi,ket_pribadi ";
        $sql            .= " FROM ref_pribadi ";
        if($kd !='')
        {
            $sql        .= " where kd_pribadi = '$kd' ";
        }
        $sql            .= " order by ket_pribadi ";
        $hasil          = $this->db->query($sql);
        return $hasil;        
    }
    function simpan($data)
    {
        return $this->db->insert('ref_pribadi',$data);
    }
    function update($kd,$data)
    {
        $this->db->where('kd_pribadi',$kd);
        return $this->db->update('ref_pribadi',$data);
    }
    function hapus($kd)
    {
        $this->db->where('kd_pribadi',$kd);
        return $this->db->delete('ref_pribadi');
    }
}

?>