<?php 
class Kkm_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($kelas='')
    {
        $CI         = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        //$p_nl       = $CI->session->userdata('kd_semester');
        $sql        = " select mmk.kd_mp, mp.nm_mp, kelas, mk.nama_lengkap, skbm, deskripsi ";
        $sql        .= " from ms_mp_kelas mmk ";
    	
        $sql        .= " inner join ms_mp mp ";
    	$sql        .= " on mmk.kd_sekolah = mp.kd_sekolah ";
    	$sql        .= " and mmk.kd_mp = mp.kd_mp ";
    	
    	$sql        .= " left outer join ms_karyawan mk ";
    	$sql        .= " on mmk.nip = mk.nip ";
        //$sql        .= " where kelas = '$kelas' ";
        $sql        .= " and mmk.kd_sekolah = '$kd_sekolah'";
        $sql        .= " and mmk.th_ajar = '$th_ajar' ";
        
        
        if($kelas!='0' && $kelas!='')
        {
            $sql        = " select mmk.kd_mp, mp.nm_mp, kelas, mk.nama_lengkap, skbm, deskripsi ";
            $sql        .= " from ms_mp_kelas mmk ";
        	
            $sql        .= " inner join ms_mp mp ";
        	$sql        .= " on mmk.kd_sekolah = mp.kd_sekolah ";
            $sql        .= " and mmk.kd_mp = mp.kd_mp ";
            
            $sql        .= " left outer join ms_karyawan mk ";
    	    $sql        .= " on mmk.nip = mk.nip ";
       	    
            
            $sql        .= " where kelas = '$kelas' ";
            $sql        .= " and mmk.kd_sekolah = '$kd_sekolah'";
            $sql        .= " and mmk.th_ajar = '$th_ajar' ";
            //$sql        .= " and mmk.semester = '$p_nl' ";
        }
        
    	$sql        .= " ORDER BY kelas, mp.urutan";
        
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    
    function get_per_kelas($kelas='',$kd_sekolah='', $th_ajar='', $p_nl='')
    {
        $sql         = " select mmk.kd_mp, mp.nm_mp, kelas, mk.nama_lengkap, skbm, deskripsi ";
        $sql        .= " from ms_mp_kelas mmk ";
        $sql        .= " inner join ms_mp mp ";
    	$sql        .= " on mmk.kd_sekolah = mp.kd_sekolah ";
    	$sql        .= " and mmk.kd_mp = mp.kd_mp ";
    	$sql        .= " left outer join ms_karyawan mk ";
    	$sql        .= " on mmk.nip = mk.nip ";
        $sql        .= " where mmk.kd_sekolah = '$kd_sekolah'";
        $sql        .= " and mmk.th_ajar    = '$th_ajar' ";
        $sql        .= " and mmk.semester   = '$p_nl'";
        $sql        .= " and mmk.kelas      = '$kelas'";
    	$sql        .= " ORDER BY kelas, mp.urutan";
        
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    
    function get_per_kelas_mp($kelas='',$kd_sekolah='', $th_ajar='', $p_nl='', $kd_mp='')
    {
        $sql         = " select mmk.kd_mp, mp.nm_mp, kelas, mk.nama_lengkap, skbm, deskripsi, mmk.nip";
        $sql        .= " from ms_mp_kelas mmk ";
        $sql        .= " inner join ms_mp mp ";
    	$sql        .= " on mmk.kd_sekolah = mp.kd_sekolah ";
    	$sql        .= " and mmk.kd_mp = mp.kd_mp ";
    	$sql        .= " left outer join ms_karyawan mk ";
    	$sql        .= " on mmk.nip = mk.nip ";
        $sql        .= " where mmk.kd_sekolah = '$kd_sekolah'";
        $sql        .= " and mmk.th_ajar    = '$th_ajar' ";
        $sql        .= " and mmk.semester   = '$p_nl'";
        $sql        .= " and mmk.kelas      = '$kelas'";
        $sql        .= " and mmk.kd_mp      = '$kd_mp'";
    	$sql        .= " ORDER BY kelas, mp.urutan";
        
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    
    function get_kkm($kd_sekolah='', $th_ajar='', $p_nl='',$kelas='', $kd_mp='')
    {
        $sql         = " select skbm ";
        $sql        .= " from ms_mp_kelas mmk ";
        $sql        .= " inner join ms_mp mp ";
    	$sql        .= " on mmk.kd_sekolah = mp.kd_sekolah ";
    	$sql        .= " and mmk.kd_mp = mp.kd_mp ";
        $sql        .= " where mmk.kd_sekolah   = '$kd_sekolah'";
        $sql        .= " and mmk.th_ajar        = '$th_ajar' ";
        $sql        .= " and mmk.semester       = '$p_nl'";
        $sql        .= " and mmk.kelas          = '$kelas'";
        $sql        .= " and mmk.kd_mp          = '$kd_mp'";
    	$sql        .= " ORDER BY kelas, mp.urutan";
        
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    
    function getAll($data,$datas)
    {
        $CI         = &get_instance();
        $kd         = $datas;
        $kelas      = str_replace('+',' ',$data);
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        
        $sql        = " select *, ms_karyawan.nama_lengkap from ms_mp_kelas";
        $sql        .= " left outer join ms_karyawan on ms_mp_kelas.nip = ms_karyawan.nip ";
        if($kd!='' && $kd_sekolah!='')
        {
            $sql    .= " where kd_sekolah = '$kd_sekolah' ";
            $sql    .= " and th_ajar = '$th_ajar' ";
            $sql    .= " and kd_mp = '$kd' ";
            $sql    .= " and kelas = '$kelas' ";
        }
    	$hasil      = $this->db->query($sql);
        return $hasil;
    }
    
    function periksampkelas($data)
    {
        $CI         = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        $p_nl       = $CI->session->userdata('kd_semester');
        $kd_mp      = $data['kd_mp'];
        $kelas      = $data['kelas'];
        
        $sql        = " select * from ms_mp_kelas";
        $sql        .= " where kd_sekolah = '$kd_sekolah' ";
        $sql        .= " and th_ajar = '$th_ajar' ";
        $sql        .= " and semester = '$p_nl' ";
        $sql        .= " and kd_mp = '$kd_mp' ";
        $sql        .= " and kelas = '$kelas' ";
    	$hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getgurump($data)
    {
        $CI         = &get_instance();
        $kd         = $data['kd_mp'];
        $kelas      = $data['kelas'];
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        
        $sql        = " select *, ms_karyawan.nama_lengkap from ms_mp_kelas";
        $sql        .= " inner join ms_karyawan on ms_mp_kelas.nip = ms_karyawan.nip ";
        if($kd!='' && $kd_sekolah!='')
        {
            $sql    .= " where kd_sekolah = '$kd_sekolah' ";
            $sql    .= " and th_ajar = '$th_ajar' ";
            $sql    .= " and kd_mp = '$kd' ";
            $sql    .= " and kelas = '$kelas' ";
        }
    	$hasil      = $this->db->query($sql);
        return $hasil;
    }
    function simpan($data)
    {
        return $this->db->insert('ms_mp_kelas',$data);
    }
    
    function update($kd,$data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('semester',$data['semester']);
        $this->db->where('kd_mp',$data['kd_mp']);
        $this->db->where('kelas',$data['kelas']);
        
        $this->db->set('skbm',$data['skbm']);
        $this->db->set('nip',$data['nip']);
        $this->db->set('deskripsi',$data['deskripsi']);
        return $this->db->update('ms_mp_kelas',$data);
    }
    function hapus($kd,$kd_mp,$data)
    {
        $this->db->where('kd_mp',$kd_mp);
        $this->db->where('kelas',str_replace('+',' ',$kd));
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('semester',$data['semester']);
        return $this->db->delete('ms_mp_kelas');
    }
    
}
?>