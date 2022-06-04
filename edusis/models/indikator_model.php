<?php 
class Indikator_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($kd='')
    {
        $sql            = " SELECT * ";
        $sql            .= " FROM rf_sikap_indikator ";
        if($kd !='')
        {
            $sql        .= " where kd_sikap = '$kd' ";
        }
        $sql            .= " order by nm_sikap ";
        $hasil          = $this->db->query($sql);
        return $hasil;        
    }
    function simpan($data)
    {
        return $this->db->insert('rf_sikap_indikator',$data);
    }
    function update($kd,$data)
    {
        $this->db->where('kd_sikap',$kd);
        return $this->db->update('rf_sikap_indikator',$data);
    }
    function hapus($kd)
    {
        $this->db->where('kd_sikap',$kd);
        return $this->db->delete('rf_sikap_indikator');
    }
}

?>