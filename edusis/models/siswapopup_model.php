<?php 

class Siswapopup_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($kd='',$kd_sekolah='',$kelas='',$limit='',$off='',$cari='',$teks='')
    {
        $CI = & get_instance();
        $sql            = " SELECT * FROM ms_siswa ";
        if($kd!='')
        {
            $sql        .= " WHERE ms_siswa.nis = '".$kd."'";
        }
        if($kelas!='0' && $kelas!='')
        {
            $cond        = 'ms_siswa.nis = kelas_siswa.nis';
            $sql        .= " INNER JOIN kelas_siswa ON ".$cond;
            $sql        .= ($kd!='') ? ' AND ' : ' WHERE ';
            $sql        .= " kelas_siswa.th_ajar = '".$CI->session->userdata('th_ajar')."'";
            $sql        .= " AND kelas_siswa.kelas = '".$kelas."'";
            $sql        .= " ORDER BY nama_lengkap ";
        }
        if($cari!='')
        {
            $sql        .= ($kd!='' && $kelas!='0' && $kelas!='') ? ' AND ' : ' WHERE ';
            $sql        .= " nama_lengkap LIKE '%".$cari."%' OR kelas LIKE '%".$cari."%'";
        }
        
        
        $hasil = $this->db->query($sql);
        if($teks!='')
        {
            $hasil = $sql;
        }
        
        return $hasil;
    }

    function get_siswa_kelas($kelas='',$kd_sekolah='',$th_ajar='')
    {
        $this->db->select('kelas_siswa.nis,nama_lengkap,kelamin');
        $this->db->from('kelas_siswa');
        $this->db->join('ms_siswa','kelas_siswa.nis=ms_siswa.nis and kelas_siswa.kd_sekolah=ms_siswa.kd_sekolah','inner');
        if($kelas!='')
        {
            $this->db->where('kelas_siswa.kelas',$kelas);
        }
        if($kd_sekolah!='')
        {
            $this->db->where('kelas_siswa.kd_sekolah',$kd_sekolah);
        }
        if($th_ajar!='')
        {
            $this->db->where('kelas_siswa.th_ajar',$th_ajar);
        }
        $this->db->order_by('nama_lengkap,kelas_siswa.nis');
        
        return $this->db->get();
    }
}

?>