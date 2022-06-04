<?php 

class Ekstrakurikuler_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($kd='')
    {
        $sql            = " SELECT kd_eskul,nm_eskul,uid,tgl_tambah,uid_edit,tgl_edit ";
        $sql            .= " FROM ms_eskul ";
        if($kd !='')
        {
            $sql        .= " where kd_eskul = '$kd' ";
        }
        $sql            .= " order by nm_eskul ";
        $hasil          = $this->db->query($sql);
        return $hasil;        
    }
    function simpan_id($data)
    {
        $this->db->insert('ms_eskul',$data);
        return $this->db->insert_id();
    }
    function simpan($data)
    {
        return $this->db->insert('ms_eskul',$data);
    }
    function update($kd,$data)
    {
        $this->db->where('kd_eskul',$kd);
        return $this->db->update('ms_eskul',$data);
    }
    function hapus($kd)
    {
        $this->db->where('kd_eskul',$kd);
        return $this->db->delete('ms_eskul');
    }
}

?>