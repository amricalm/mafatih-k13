<?php
class Absen_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function siswa($pilihkelas)
    {
        $CI         = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        
        $sql         =" select ks.nis,nama_lengkap, ks.kelas "; 
        $sql        .=" from kelas_siswa ks ";
        $sql        .=" inner join ms_siswa ms ";
        $sql        .=" on ks.nis = ms.nis "; 
        $sql        .=" where ks.kd_sekolah = '$kd_sekolah' ";
        $sql        .=" and ks.th_ajar ='$th_ajar' ";
        $sql        .=" and ks.kelas='$pilihkelas' ";
        $sql        .=" ORDER BY nama_lengkap ";
        $query      = $this->db->query($sql);
        return $query;
        
    }
   
    function dapat($data)
    {
        $CI         = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        $bulan      = $data['bulan'];
        $kelas      = $data['kode_kelas'];
        $p_nl       = $data['p_nl'];
        $nis        = $data['nis'];
        $tgl        = $data['tgl'];
        $sql =   " select *
                    from siswa_absen 
                    where kd_sekolah = '$kd_sekolah'
                    and th_ajar     = '$th_ajar' 
                    and p_nl = '$p_nl'
                    and bulan = '$bulan'
                    and nis = '$nis'
                    and kode_kelas = '$kelas'
                    and tgl = '$tgl' ";
        $query = $this->db->query($sql); 
        return $query;
    }
    function get($bulan,$th_ajar,$kd_sekolah,$kelas,$tgl,$p_nl)
    {
        $sql                = " select ks.kd_sekolah as kd_sekolah, ks.th_ajar, ks.nis, ks.kelas, ms.nama_lengkap,na.bulan,
                                na.absen, na.tgl
                                from kelas_siswa ks 
                                inner join ms_siswa ms 
                                on ks.kd_sekolah = ms.kd_sekolah 
                                and ks.nis = ms.nis 
                                left outer join siswa_absen na 
                                on ks.kd_sekolah = na.kd_sekolah 
                                and ks.th_ajar = na.th_ajar 
                                and ks.kelas = na.kode_kelas 
                                and ks.nis = na.nis 
                                and na.bulan = $bulan
                                and na.tgl = $tgl
                                and na.p_nl = '$p_nl' 
                                where ks.kd_sekolah = '$kd_sekolah'
                                and ks.th_ajar = '$th_ajar' 
                                and ks.kelas = '$kelas'";
        //$sql                = " and ks.p_nl = '$p_nl' 
        $sql                .= " order by nama_lengkap ";
                                
        $hasil              = $this->db->query($sql);
        return $hasil;
    }
    function simpan($data)
    {
        return $this->db->insert('siswa_absen',$data);
    }
    function update($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('kode_kelas',$data['kode_kelas']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('tgl',$data['tgl']);
        $this->db->where('bulan',$data['bulan']);
        
        $this->db->set('absen',$data['absen']);
        return $this->db->update('siswa_absen');
    }
    function getlap($kd_sekolah,$th_ajar,$kelas,$p_nl)
    {
        $sql                = " select *,ms_siswa.nama_lengkap  from kelas_siswa
                                inner join ms_siswa
                                on kelas_siswa.kd_sekolah = ms_siswa.kd_sekolah
                                and kelas_siswa.nis = ms_siswa.nis
                                where kelas_siswa.kd_sekolah = '$kd_sekolah'
                                and th_ajar		             = '$th_ajar'
                                and kelas_siswa.kelas		 = '$kelas'";
        //$sql                = " and kelas_siswa.p_nl = $p_nl'";
        $sql                .= " order by ms_siswa.nama_lengkap,kelas_siswa.nis ";
                                
        $hasil              = $this->db->query($sql);
        return $hasil;
    }
    function getabsen($bulan,$th_ajar,$kd_sekolah,$kelas,$tgl,$p_nl,$nis)
    {
        $sql                = " select * from siswa_absen
                                where kd_sekolah = '$kd_sekolah'
                                and th_ajar		= '$th_ajar'
                                and kode_kelas	= '$kelas'
                                and p_nl		= '$p_nl'
                                and nis			= '$nis'
                                and bulan		= '$bulan'
                                and tgl			= '$tgl'";
        $hasil              = $this->db->query($sql);
        return $hasil;
    }   
}
?>