<?php 

class Konseling_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getkonseling()
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sql            = " select kd_konseling,bp_tkonseling.nis,nama_lengkap,bp_tkonseling.kd_sekolah,
							bp_tkonseling.th_ajar,tgl,masalah,solusi,kelas_siswa.kelas,DATE_FORMAT(tgl, '%d %M %Y') as tglpanjang ";
        $sql            .= " from bp_tkonseling ";
        $sql            .= " left outer join ms_siswa on bp_tkonseling.nis = ms_siswa.nis ";
        $sql            .= " inner join kelas_siswa on bp_tkonseling.nis = kelas_siswa.nis";
        $sql            .= " where bp_tkonseling.kd_sekolah = '$kd_sekolah'";
        $sql            .= " and bp_tkonseling.th_ajar = '$th_ajar'";
        $sql            .= " and bp_tkonseling.p_nl = '$p_nl'";
        $sql            .= " order by bp_tkonseling.tgl";
        $hasil          = $this->db->query($sql);
        return $hasil;
    }
    function get($kd,$kd_konseling='',$limit='',$off='',$cari,$teks='')
    {
        $sql            = " select kd_konseling,bp_tkonseling.nis,nama_lengkap,bp_tkonseling.kd_sekolah,bp_tkonseling.th_ajar,tgl,masalah,solusi,kelas_siswa.kelas ";
        $sql            .= " from bp_tkonseling ";
        $sql            .= " left outer join ms_siswa on bp_tkonseling.nis = ms_siswa.nis ";
        $sql            .= " inner join kelas_siswa on bp_tkonseling.nis = kelas_siswa.nis";
        
        if($kd!='')
        {
            $sql        .= " WHERE bp_tkonseling.kd_konseling = $kd";
        }
        
        $hasil          = $this->db->query($sql);
        if($teks!='')
        {
            $hasil      = $sql;
        }
        return $hasil;
    }
     
    function simpan_id($data)
    {
        $this->db->insert('bp_tkonseling',$data);
        return $this->db->insert_id();
    }
    function simpan($data)
    {
        return $this->db->insert('bp_tkonseling',$data);
    }
    function update($kd,$data)
    {
        $this->db->where('kd_konseling',$kd);
        return $this->db->update('bp_tkonseling',$data);
    }
    function hapus($kd_konseling)
    {
        $this->db->where('kd_konseling',$kd_konseling);
        return $this->db->delete('bp_tkonseling');
    }
}

?>