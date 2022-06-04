<?php 

class Kesehatansiswa_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get()
    {
        $sql            = " SELECT kd_kesehatan,uid,tgl_tambah,uid_edit,tgl_edit ";
        $sql            .= " FROM ms_kesehatan ";
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
        $kd_eskul       = $data['kd_kesehatan'];
        
        $sql            = " select ms.kd_kesehatan,nm_kesehatan,hasil ";
        $sql            .= " from ms_kesehatan ms ";
        
        $sql            .= " left outer join nl_kesehatan nl ";
        $sql            .= " on ms.kd_kesehatan = nl.kd_kesehatan ";
        $sql            .= " and kd_sekolah = '$kdsekolah'";
        $sql            .= " and nis        = '$nis' ";
        $sql            .= " and kelas      = '$kelas' ";
        $sql            .= " and th_ajar    = '$th_ajar' ";
        $sql            .= " and p_nl       = '$p_nl' ";
        $sql            .= ($kd_eskul!='') ? " where nl.kd_kesehatan = '$kd_eskul'" : '';
        $sql            .= " order by kategori desc, tgl_tambah ";

        $hasil          = $this->db->query($sql);
        return $hasil;
    }
    function simpan_id($data)
    {
        $this->db->insert('nl_kesehatan',$data);
        return $this->db->insert_id();
    }
    function simpan($data)
    {
        return $this->db->insert('nl_kesehatan',$data);
    }
    function update($data)
    {
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('kd_kesehatan',$data['kd_kesehatan']);
        
        $this->db->set('hasil',$data['hasil']);
        return $this->db->update('nl_kesehatan',$data);
    }
    function hapus($kd_eskul)
    {
        $this->db->where('nl_kesehatan',$kd_eskul);
        return $this->db->delete('nl_kesehatan');
    }
}

?>