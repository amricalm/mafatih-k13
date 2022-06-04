<?php 

class Guru_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($kd='',$limit='',$off='')
    {
//        $this->db->select('*');
//        $this->db->from('ms_karyawan');
//        if($kd!='')
//        {
//            $this->db->where('nip',$kd);
//        }
//        $this->db->order_by('nama_lengkap');
//        $this->db->limit($limit,$off);
//        
//        return $this->db->get();
        //$sql        = " SELECT * FROM ms_karyawan ";
        //if($kd!='')
        //{
         //   $sql    .= " WHERE nip = '$kd'";
        //}
        //$sql        .= " ";
        
        if ($off == 0 || $off == '') 
		{
			$sqllimit	= ($limit!='') ? 'LIMIT '.$limit : '';
            $sql 		= " SELECT rtrim(ms_karyawan.nip) nip, ms_karyawan.*,DATE_FORMAT(tgl_lahir, '%d %M %Y') as tglpanjang "
						." FROM ms_karyawan ";
			$sql		.= ($kd!='') ? ' WHERE ms_karyawan.nip = '."'$kd'" : '';
			//$sql		.= ($cari!='') ? " WHERE nama_lengkap LIKE '%$cari%' OR ms_siswa.nis LIKE '%$cari%'" : '';
            $sql		.= " ORDER BY nama_lengkap asc $sqllimit";
        } 
		else 
		{
			$sqllimit	= ($limit!='') ? 'LIMIT '.$limit : '';
            $sqllimit	= ($limit!='') ? 'LIMIT '.$limit : '';
            $sql 		= " SELECT rtrim(ms_karyawan.nip) nip, ms_karyawan.*,DATE_FORMAT(tgl_lahir, '%d %M %Y') as tglpanjang "
						." FROM ms_karyawan "
						. " WHERE ms_karyawan.nip NOT IN "
						. " ( "
						. "     SELECT TOP $off nip " 
						. " 	FROM ms_karyawan "
						. " 	ORDER BY nama_lengkap,nip asc "
						. " ) ";
			$sql		.= ($kd!='') ? ' AND nip = '."'$kd'" : '';
			//$sql		.= ($cari!='') ? " AND nama_lengkap LIKE '%$cari%' OR ms_siswa.nis LIKE '%$cari%'" : '';
            $sql		.= " ORDER BY ms_karyawan.nama_lengkap asc $sqllimit";
        }
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getAll()
    {
        $CI          = &get_instance();
        $kd_sekolah  = $CI->session->userdata('kd_sekolah');
        $sql         = " select *,DATE_FORMAT(tgl_lahir, '%d %M %Y') as tglpanjang from ms_karyawan  order by nama_lengkap";
        $hasil       = $this->db->query($sql);
        return $hasil;
    }
    function simpan($data)
    {
        if($this->db->insert('ms_karyawan',$data))
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
        $this->db->where('nip',$kd);
        return $this->db->update('ms_karyawan',$data);
    }
    function hapus($kd)
    {
        $this->db->where('nip',$kd);
        return $this->db->delete('ms_karyawan');
    }
    function gettgllahir($nip)
    {
        $sql        = " select year(tgl_lahir) th,month(tgl_lahir) bln,day(tgl_lahir) hr 
                        from ms_karyawan ";
        $sql        .= " where nip = '$nip'";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function gettgllahirall()
    {
        $sql        = " select year(tgl_lahir) th,month(tgl_lahir) bln,day(tgl_lahir) hr 
                        from ms_karyawan ";
        //$sql        .= " where nip = '$nip'";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function gettglmasuk($nip)
    {
        $sql        = " select year(tgl_masuk) th,month(tgl_masuk) bln,day(tgl_masuk) hr 
                        from ms_karyawan ";
        $sql        .= " where nip = '$nip'";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function gettglkeluar($nip)
    {
        $sql        = " select year(tgl_keluar) th,month(tgl_keluar) bln,day(tgl_keluar) hr 
                        from ms_karyawan ";
        $sql        .= " where nip = '$nip'";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
}

?>