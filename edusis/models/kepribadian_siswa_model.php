<?php 

class Kepribadian_siswa_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get()
    {
        $sql            = " SELECT kd_pribadi,ket_pribadi";
        $sql            .= " FROM ref_pribadi ";
        $hasil          = $this->db->query($sql);
        return $hasil;
    }
    function get_kelas_nis($data)
    {
        $CI = &get_instance();
        $kdsekolah      = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $nis            = $data['nis'];
        $kelas          = $data['kelas'];
        $p_nl           = $data['p_nl'];
        $kd_pribadi     = trim($data['kd_pribadi']);
        
        $sql            = " select ms.kd_pribadi,ket_pribadi,hasil ";
        $sql            .= " from ref_pribadi ms ";
        
        $sql            .= " left outer join nl_pribadi nl ";
        $sql            .= " on ms.kd_pribadi = nl.kd_pribadi ";
        $sql            .= " and kd_sekolah = '$kdsekolah'";
        $sql            .= " and nis        = '$nis' ";
        $sql            .= " and kelas      = '$kelas' ";
        $sql            .= " and th_ajar    = '$th_ajar' ";
        $sql            .= " and p_nl       = '$p_nl' ";
        $sql            .= ($kd_pribadi!='') ? " where nl.kd_pribadi = '$kd_pribadi'" : '';
        $hasil          = $this->db->query($sql);
        return $hasil;
    }
    function simpan_id($data)
    {
        $this->db->insert('nl_pribadi',$data);
        return $this->db->insert_id();
    }
    function simpan($data)
    {
        return $this->db->insert('nl_pribadi',$data);
    }
    function update($data)
    {
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('kd_pribadi',$data['kd_pribadi']);
        
        $this->db->set('hasil',$data['hasil']);
        return $this->db->update('nl_pribadi',$data);
    }
    function hapus($kd_pribadi)
    {
        $this->db->where('kd_pribadi',$kd_pribadi);
        return $this->db->delete('nl_pribadi');
    }
}

?>