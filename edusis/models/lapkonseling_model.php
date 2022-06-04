<?php 

class Lapkonseling_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($tgl_dari,$tgl_sampai,$teks='')
    {
        $sql        = "select kd_konseling,bp_tkonseling.nis,ms_siswa.nama_lengkap,
						kelas_siswa.kelas,bp_tkonseling.kd_sekolah,bp_tkonseling.th_ajar,tgl,masalah,solusi,
						DATE_FORMAT(tgl, '%d %M %Y') as tglpanjang ";
        $sql        .= " from bp_tkonseling ";
        $sql        .= " inner join ms_siswa on bp_tkonseling.nis = ms_siswa.nis ";
        $sql        .= " inner join kelas_siswa on ms_siswa.nis = kelas_siswa.nis ";
        $sql        .= " WHERE bp_tkonseling.tgl >= '$tgl_dari' ";
        $sql        .= " AND bp_tkonseling.tgl <= '$tgl_sampai' ";
        
        $hasil          = $this->db->query($sql);
        if($teks!='')
        {
            $hasil      = $sql;
        }
        return $hasil;
    }
    function get_persiswa($nis)
    {
        $sql        = "select kd_konseling,bp_tkonseling.nis,ms_siswa.nama_lengkap,kelas_siswa.kelas,
						bp_tkonseling.kd_sekolah,bp_tkonseling.th_ajar,tgl,masalah,solusi,DATE_FORMAT(tgl, '%d %M %Y') as tglpanjang ";
        $sql        .= " from bp_tkonseling ";
        $sql        .= " inner join ms_siswa on bp_tkonseling.nis = ms_siswa.nis ";
        $sql        .= " inner join kelas_siswa on ms_siswa.nis = kelas_siswa.nis ";        
        $sql        .= " WHERE bp_tkonseling.nis ='$nis'";
        $hasil          = $this->db->query($sql);
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
    function update($kd_konseling,$data)
    {
        $this->db->where('kd_konseling',$kd_konseling);
        return $this->db->update('bp_tkonseling',$data);
    }
    function hapus($kd_konseling)
    {
        $this->db->where('kd_konseling',$kd_konseling);
        return $this->db->delete('bp_tkonseling');
    }
}

?>