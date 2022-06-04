<?php 

class Jurusan_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($kd='',$limit='',$off='')
    {
        $this->db->select('*');
        $this->db->from('rf_jurusan');
        if($kd!='')
        {
            $this->db->where('kd_jurusan',$kd);
        }
        $this->db->order_by('nm_jurusan');
        $this->db->limit($limit,$off);
        
        return $this->db->get();
    }
    function simpan($data)
    {
        if($this->db->insert('rf_jurusan',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function update($kd,$data)
    {
        $this->db->where('kd_jurusan',$kd);
        return $this->db->update('rf_jurusan',$data);
    }
    function hapus($kd)
    {
        $this->db->where('kd_jurusan',$kd);
        return $this->db->delete('rf_jurusan');
    }
}

?>