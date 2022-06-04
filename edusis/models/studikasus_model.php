<?php 

class Studikasus_model extends CI_Model
{
    function __construct()
    {
        parent::__Construct();
        
    }
    function get($kd='',$kd_studi_kasus='',$limit='',$off='',$teks='')
    {
        $CI = & get_instance();
        $sql  =' select kd_studi_kasus,bp_tstudi_kasus.nis,ms_siswa.nama_lengkap,bp_mpelanggaran.nm_pelanggaran,bp_tstudi_kasus.kd_sekolah,bp_tstudi_kasus.th_ajar,tindakan_ortu
                    from bp_tstudi_kasus
                    left outer join ms_siswa on bp_tstudi_kasus.nis = ms_siswa.nis
                    left outer join bp_tpelanggaran_siswa on bp_tstudi_kasus.nis = bp_tpelanggaran_siswa.nis
                    left outer join bp_mpelanggaran on bp_tpelanggaran_siswa.kd_pelanggaran = bp_mpelanggaran.kd_pelanggaran';
        
        if($kd!='')
        {
            $sql .=' WHERE bp_tstudi_kasus.kd_studi_kasus ='.$kd;
        }
        $hasil          = $this->db->query($sql);
        if($teks!='')
        {
            $hasil      = $sql;
        }
        return $hasil;
    }
    function simpan($data)
    {
        if($this->db->insert('bp_tstudi_kasus',$data))
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
        $this->db->where('kd_studi_kasus',$kd);
        return $this->db->update('bp_tstudi_kasus',$data);
    }
    function hapus($kd)
    {
        $this->db->where('kd_studi_kasus',$kd);
        return $this->db->delete('bp_tstudi_kasus');
    }
}
?>