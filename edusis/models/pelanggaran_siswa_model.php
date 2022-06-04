<?php

class Pelanggaran_siswa_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($kd='',$limit='',$off='',$cari='',$teks='')
    {
        $CI                     = &get_instance();
        $p_nl                   = $CI->session->userdata('kd_semester');
        $sql                    = " select kd_pelanggaran_siswa,bp_tpelanggaran_siswa.nis,nama_lengkap,bp_tpelanggaran_siswa.kd_sekolah,
                                    th_ajar,tgl,bp_tpelanggaran_siswa.kd_pelanggaran,nm_pelanggaran,point,kejadian,hukuman, kelas,
									DATE_FORMAT(tgl, '%d %M %Y') as tglpanjang
                                    from bp_tpelanggaran_siswa
                                    left outer join ms_siswa on bp_tpelanggaran_siswa.nis = ms_siswa.nis
                                    left outer join bp_mpelanggaran on bp_tpelanggaran_siswa.kd_pelanggaran = bp_mpelanggaran.kd_pelanggaran ";
        if($kd!='')
        {
            $sql               .= " WHERE bp_tpelanggaran_siswa.kd_pelanggaran_siswa = '$kd' ";
            //$sql               .= " and bp_tpelanggaran_siswa.p_nl = '$p_nl'";
        }
        $hasil                  = $this->db->query($sql);
        if($teks!='')
        {
            $hasil              = $sql;
        }
        return $hasil;
    }
    function getpelanggaransiswa()
    {
        $CI                     = &get_instance();
        $ka_sekolah             = $CI->session->userdata('kd_sekolah');
        $th_ajar                = $CI->session->userdata('th_ajar');
        $p_nl                   = $CI->session->userdata('kd_semester');
        $sql                    = " select bpt.*,nama_lengkap, bpm.* ,
									DATE_FORMAT(tgl, '%d %M %Y') as tglpanjang
                                    from bp_tpelanggaran_siswa bpt
                                    left outer join ms_siswa 
                                    on bpt.nis = ms_siswa.nis 
                                    left outer join bp_mpelanggaran bpm
                                    on bpt.kd_pelanggaran = bpm.kd_pelanggaran
                                    where bpt.kd_sekolah ='$ka_sekolah'
                                    and bpt.th_ajar = '$th_ajar'
                                    and bpt.p_nl = $p_nl 
                                    order by bpt.tgl";
        $hasil                  = $this->db->query($sql);
        return $hasil;
    }
    function get_max()
    {
        $sql                    = "select coalesce(max(right(kd_pelanggaran_siswa,5)),0) as max from bp_tpelanggaran_siswa";
        $hasil                  = $this->db->query($sql);
        return $hasil->row()->max;
    }
    function simpan($data)
    {
        if($this->db->insert('bp_tpelanggaran_siswa',$data))
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
        $this->db->where('kd_pelanggaran_siswa',$kd);
        return $this->db->update('bp_tpelanggaran_siswa',$data);
        
    }
    function hapus($kd)
    {
        $this->db->where('kd_pelanggaran_siswa',$kd);
        return $this->db->delete('bp_tpelanggaran_siswa');
    }
}