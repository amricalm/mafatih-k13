<?php 

class Kesehatan_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($kd='')
    {
        $sql            = " SELECT kd_kesehatan,nm_kesehatan,kategori,uid,tgl_tambah,uid_edit,tgl_edit ";
        $sql            .= " FROM ms_kesehatan ";
        if($kd !='')
        {
            $sql        .= " where kd_kesehatan = '$kd' ";
        }
        $sql            .= " order by kategori desc, tgl_tambah ";
        $hasil          = $this->db->query($sql);
        return $hasil;        
    }
    function simpan_id($data)
    {
        $this->db->insert('ms_kesehatan',$data);
        return $this->db->insert_id();
    }
    function simpan($data)
    {
        return $this->db->insert('ms_kesehatan',$data);
    }
    function update($kd,$data)
    {
        $this->db->where('kd_kesehatan',$kd);
        return $this->db->update('ms_kesehatan',$data);
    }
    function hapus($kd)
    {
        $this->db->where('kd_kesehatan',$kd);
        return $this->db->delete('ms_kesehatan');
    }
}

?>