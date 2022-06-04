<?php
class Student_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function th_ajar()
    {
        $sql    = " select * from th_ajar " ;
        $query  = $this->db->query($sql);
        return $query;
        
    }
    function dapat($pilihth_ajar, $kd_sekolah, $pilihkelas,$pilihbulan,$nis)
    {
         $sql =   " select *
                    from tstudent_year 
                    where kd_sekolah = '$kd_sekolah' 
                    and th_ajar = '$pilihth_ajar' 
                    and bulan = $pilihbulan
                    and kelas = '$pilihkelas' 
                    and nis = '$nis' ";
        $query = $this->db->query($sql); 
        return $query;
    }
    
    function get($th_ajar,$kd_sekolah,$kelas,$bulan)
    {
        $sql = " select ks.kd_sekolah, ks.th_ajar, ks.nis, ks.kelas, ms.nama_lengkap,ts.bulan, ts.report,ts.ibadah, ts.activity,
                ts.class_behavior, ts.daily_behavior, ts.total
                from kelas_siswa ks
                inner join ms_siswa ms
                on ks.kd_sekolah = ms.kd_sekolah
                and ks.nis = ms.nis
                left outer join tstudent_year ts
                on ks.kd_sekolah = ts.kd_sekolah
                and ks.th_ajar = ts.th_ajar
                and ks.kelas = ts.kelas
                and ks.nis = ts.nis
                and ts.bulan = $bulan
                where ks.kd_sekolah = '$kd_sekolah'
                and ks.th_ajar      = '$th_ajar'
                and ks.kelas        = '$kelas'
                order by nama_lengkap ";
        $hasil = $this->db->query($sql);
        return $hasil;
                    
    }
    function tampil()
    {
        $sql    = " select * from ms_siswa ";
        $query  = $this->db->query($sql);
        return $query;
    }
    function simpan($data)
    {
        return $this->db->insert('tstudent_year',$data);
    }
    function update($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('bulan',$data['bulan']);
        
        $this->db->set('report',$data['report']);
        $this->db->set('ibadah',$data['ibadah']);
        $this->db->set('activity',$data['activity']);
        $this->db->set('class_behavior',$data['class_behavior']);
        $this->db->set('daily_behavior',$data['daily_behavior']);
        $this->db->set('total',$data['total']);
        $this->db->set('bulan',$data['bulan']);
        
        return $this->db->update('tstudent_year');
        
    }       
    
}
?>