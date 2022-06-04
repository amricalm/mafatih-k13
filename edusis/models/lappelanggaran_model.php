<?php 

class Lappelanggaran_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($tgl_dari='',$tgl_sampai='',$teks='')
    {
        $CI         = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        $p_nl       = $CI->session->userdata('kd_semester');
        
        $sql        = " select  bp_tpelanggaran_siswa.*, ms_siswa.*, kelas_siswa.*, bpm.*,DATE_FORMAT(tgl, '%d %M %Y') as tglpanjang ";
        $sql        .= " from bp_tpelanggaran_siswa ";
        $sql        .= " inner join ms_siswa on bp_tpelanggaran_siswa.nis = ms_siswa.nis ";
        $sql        .= " inner join kelas_siswa on ms_siswa.nis = kelas_siswa.nis ";
        $sql        .= " inner join bp_mpelanggaran bpm on bp_tpelanggaran_siswa.kd_pelanggaran = bpm.kd_pelanggaran "; 
        $sql        .= " WHERE bp_tpelanggaran_siswa.kd_sekolah = '$kd_sekolah'";
        $sql        .= " and bp_tpelanggaran_siswa.th_ajar = '$th_ajar'";
        $sql        .= " and bp_tpelanggaran_siswa.p_nl = '$p_nl'";
        $sql        .= " order by bp_tpelanggaran_siswa.tgl";
        if($tgl_dari!='' && $tgl_sampai!='')
        {
            $sql        = " select  bp_tpelanggaran_siswa.*, ms_siswa.*, kelas_siswa.*, bpm.* ";
            $sql        .= " from bp_tpelanggaran_siswa ";
            $sql        .= " inner join ms_siswa on bp_tpelanggaran_siswa.nis = ms_siswa.nis ";
            $sql        .= " inner join kelas_siswa on ms_siswa.nis = kelas_siswa.nis ";
            $sql        .= " inner join bp_mpelanggaran bpm on bp_tpelanggaran_siswa.kd_pelanggaran = bpm.kd_pelanggaran "; 
            $sql        .= " WHERE bp_tpelanggaran_siswa.tgl >= '$tgl_dari' ";
            $sql        .= " AND bp_tpelanggaran_siswa.tgl <= '$tgl_sampai' ";
            $sql        .= " AND bp_tpelanggaran_siswa.kd_sekolah = '$kd_sekolah'";
            $sql        .= " AND bp_tpelanggaran_siswa.th_ajar = '$th_ajar'";
            $sql        .= " AND bp_tpelanggaran_siswa.p_nl = '$p_nl'";
            $sql        .= " order by bp_tpelanggaran_siswa.tgl";
        }
        $hasil          = $this->db->query($sql);
        if($teks!='')
        {
            $hasil      = $sql;
        }
        return $hasil;
    }
    function getpelanggaranpersiswa($data)
    {
        $CI         = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        $p_nl       = $CI->session->userdata('kd_semester');
        $nis        = $data['pilihnis'];        
        $sql        = " select bpts.*, bpm.*,DATE_FORMAT(tgl, '%d %M %Y') as tglpanjang
                        from bp_tpelanggaran_siswa bpts
                        inner join bp_mpelanggaran bpm
                        on bpts.kd_pelanggaran = bpm.kd_pelanggaran
                        where kd_sekolah   = '$kd_sekolah'
                        and th_ajar 	   = '$th_ajar'
                        and p_nl	       = $p_nl
                        and nis		       = '$nis'
                        order by tgl ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    } 
    
    function simpan_id($data)
    {
        $this->db->insert('bp_tpelanggaran_siswa',$data);
        return $this->db->insert_id();
    }
    function simpan($data)
    {
        return $this->db->insert('bp_tpelanggaran_siswa',$data);
    }
    function update($kd_pelanggaran_siswa,$data)
    {
        $this->db->where('kd_pelanggaran_siswa',$kd_pelanggaran_siswa);
        return $this->db->update('bp_tpelanggaran_siswa',$data);
    }
    function hapus($kd_pelanggaran_siswa)
    {
        $this->db->where('kd_pelanggaran_siswa',$kd_pelanggaran_siswa);
        return $this->db->delete('bp_tpelanggaran_siswa');
    }
}

?>