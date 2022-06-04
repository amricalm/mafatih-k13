<?php 

class Siswa_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getall($kd='')
    {
        $sql        = " select * from ms_siswa ";
        if($kd!='')
        {
            $sql    .= " where nis = '$kd'";
        }
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getprofile($data)
    {
        $CI         = &get_instance();
        $nis        = $data['nis'];
        $sql        = " select * from ms_siswa ";
        $sql        .= " where nis = '$nis'";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getprintbykelas($data)
    {
        $CI         = &get_instance();
        $th_ajar    = $CI->session->userdata('th_ajar');
        $kelas      = $data['kelas'];
        $sql        = " SELECT  rtrim(ms_siswa.nis) nis,nama_lengkap,alamat,telp,ayah_nama,tgl_lahir, kelas_siswa.kelas
						,DATE_FORMAT(tgl_lahir, '%d-%m-%Y') as tglpanjang
                        FROM ms_siswa
                        LEFT OUTER JOIN kelas_siswa on ms_siswa.nis = kelas_siswa.nis and kelas_siswa.kd_sekolah=ms_siswa.kd_sekolah
                        WHERE kelas_siswa.th_ajar='$th_ajar'
                        AND kelas_siswa.kelas ='$kelas'
                        ORDER BY ms_siswa.nama_lengkap asc " ;
        $hasil      = $this->db->query($sql);
        return $hasil;
    }      
    function gettgllahir($nis)
    {
        $sql        = " select year(tgl_lahir) th,month(tgl_lahir) bln,day(tgl_lahir) hr 
                        from ms_siswa ";
        $sql        .= " where nis = '$nis'";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getmasuktgl($nis)
    {
        $sql        = " select year(diterima_tgl) th,month(diterima_tgl) bln,day(diterima_tgl) hr 
                        from ms_siswa ";
        $sql        .= " where nis = '$nis'";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
//    function get($kd='',$kd_sekolah='',$kelas='',$limit='',$off='',$cari='')
//    {
//        $CI = & get_instance();
//        $kd_sekolah = $CI->session->userdata('kd_sekolah');
//        $th_ajar    = $CI->session->userdata('th_ajar');
//        $test = '';
//        if ($off == 0 || $off == '') 
//		{
//			$sqllimit	= ($limit!='') ? 'TOP '.$limit : '';
//            $sql 		= " SELECT $sqllimit rtrim(ms_siswa.nis) nis,nama_lengkap,alamat,telp,ayah_nama,tgl_lahir, ms_siswa.* "
//						." FROM ms_siswa ";
//            $sql		.= " WHERE kd_sekolah = '$kd_sekolah' ";
//            
//			$sql		.= ($kd!='') ? ' WHERE ms_siswa.nis = '."'$kd'"  : '';
//			$sql		.= ($cari!='') ? " AND nama_lengkap LIKE '%$cari%' OR ms_siswa.nis LIKE '%$cari%'" : '';
//            $sql		.= " ORDER BY ms_siswa.nis,ms_siswa.nama_lengkap asc";
//        } 
//		else 
//		{
//			$sqllimit	= ($limit!='') ? 'TOP '.$limit : '';
//            $sql 		= "SELECT $sqllimit rtrim(ms_siswa.nis) nis,nama_lengkap,alamat,telp,ayah_nama,tgl_lahir "
//			   			. " FROM ms_siswa "
//						. " WHERE ms_siswa.nis NOT IN "
//						. " ( "
//						. "     SELECT TOP $off nis " 
//						. " 	FROM ms_siswa "
//						. " 	ORDER BY nama_lengkap,nis asc "
//						. " ) "
//                        . " and kd_sekolah = '$kd_sekolah'";
//			$sql		.= ($kd!='') ? ' AND nis = '."'$kd'" : '';
//			$sql		.= ($cari!='') ? " AND nama_lengkap LIKE '%$cari%' OR ms_siswa.nis LIKE '%$cari%'" : '';
//            $sql		.= " ORDER BY ms_siswa.nis,ms_siswa.nama_lengkap asc";
//        }
//        if($kelas!='0' && $kelas!='')
//        {
//            $sqllimit	= ($limit!='') ? 'TOP '.$limit : '';
//            $sql 		= " SELECT $sqllimit rtrim(ms_siswa.nis) nis,nama_lengkap,alamat,telp,ayah_nama,tgl_lahir, kelas_siswa.kelas "
//						. " FROM ms_siswa ";
//			$sql		.= " LEFT OUTER JOIN kelas_siswa on ms_siswa.nis = kelas_siswa.nis and kelas_siswa.kd_sekolah=ms_siswa.kd_sekolah";
//            $sql		.= " WHERE kelas_siswa.th_ajar    ='$th_ajar'";
//            $sql		.= " AND kelas_siswa.kd_sekolah   ='$kd_sekolah'";
//            $sql		.= " AND kelas_siswa.kelas        ='$kelas'";
//            $sql		.= " ORDER BY ms_siswa.nis,ms_siswa.nama_lengkap asc";
//        }
//        $query = $this->db->query($sql);
//        if ($query->result()) 
//		{
//            if($test=='')
//            {
//                return $query;
//            }
//            else
//            {
//                return $sql;
//            }
//        } 
//		else 
//		{
//            return $query;
//        }
//    }
    function get($kd='',$kd_sekolah='',$kelas='',$limit='',$off='',$cari='')
    {
        $CI = & get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        $test = '';
        if ($off == 0 || $off == '') 
		{
			$sqllimit	= ($limit!='') ? 'LIMIT '.$limit : '';
            $sql 		= " SELECT rtrim(ms_siswa.nis) nis,nama_lengkap,tgl_lahir,ayah_nama,alamat,telp,kelas_siswa.kelas "
						 ." ,DATE_FORMAT(tgl_lahir, '%d-%m-%Y') as tglpanjang FROM ms_siswa 
                            left outer join kelas_siswa
                            on ms_siswa.kd_sekolah = kelas_siswa.kd_sekolah
                            and ms_siswa.nis = kelas_siswa.nis
                            and kelas_siswa.th_ajar = '$th_ajar'";
            $sql		.= " WHERE ms_siswa.kd_sekolah = '$kd_sekolah' ";
            
			$sql		.= ($kd!='') ? ' WHERE ms_siswa.nis = '."'$kd'"  : '';
			$sql		.= ($cari!='') ? " AND nama_lengkap LIKE '%$cari%' OR ms_siswa.nis LIKE '%$cari%'" : '';
            $sql		.= " ORDER BY nama_lengkap asc $sqllimit";
        } 
		else 
		{
			$sqllimit	= ($limit!='') ? 'LIMIT '.$limit : '';
            $sql 		= "SELECT rtrim(ms_siswa.nis) nis,nama_lengkap,tgl_lahir,ayah_nama,alamat,telp,kelas_siswa.kelas "
			   			. " ,DATE_FORMAT(tgl_lahir, '%d-%m-%Y') as tglpanjang FROM ms_siswa 
                            left outer join kelas_siswa
                            on ms_siswa.kd_sekolah = kelas_siswa.kd_sekolah
                            and ms_siswa.nis = kelas_siswa.nis
                            and kelas_siswa.th_ajar = '$th_ajar'"
						. " WHERE ms_siswa.nis NOT IN "
						. " ( "
						. "     SELECT TOP $off ms_siswa.nis " 
						. " 	FROM ms_siswa "
						. " 	ORDER BY nama_lengkap asc "
						. " ) "
                        . " and ms_siswa.kd_sekolah = '$kd_sekolah'";
			$sql		.= ($kd!='') ? ' AND ms_siswa.nis = '."'$kd'" : '';
			$sql		.= ($cari!='') ? " AND nama_lengkap LIKE '%$cari%' OR ms_siswa.nis LIKE '%$cari%'" : '';
            $sql		.= " ORDER BY nama_lengkap asc $sqllimit";
        }
        if($kelas!='0' && $kelas!='')
        {
            //if ($off == 0 || $off == '') 
    		//{
                $sqllimit	= ($limit!='') ? 'LIMIT '.$limit : '';
                $sql 		= " SELECT rtrim(ms_siswa.nis) nis,nama_lengkap,tgl_lahir,ayah_nama,alamat,telp,kelas_siswa.kelas "
    						. " ,DATE_FORMAT(tgl_lahir, '%d-%m-%Y') as tglpanjang FROM ms_siswa ";
    			$sql		.= " LEFT OUTER JOIN kelas_siswa on ms_siswa.nis = kelas_siswa.nis and kelas_siswa.kd_sekolah=ms_siswa.kd_sekolah";
                $sql		.= " WHERE kelas_siswa.th_ajar    ='$th_ajar'";
                $sql		.= " AND kelas_siswa.kd_sekolah   ='$kd_sekolah'";
                $sql		.= " AND kelas_siswa.kelas        ='$kelas'";
                $sql		.= " ORDER BY nama_lengkap asc $sqllimit";
            //}
            //else
            //{
            //    $sqllimit	= ($limit!='') ? 'TOP '.$limit : '';
            //    $sql 		= " SELECT $sqllimit rtrim(ms_siswa.nis) nis,nama_lengkap,tgl_lahir,ayah_nama,alamat,telp,kelas_siswa.kelas "
    		//				. " FROM ms_siswa ";
    		//	$sql		.= " LEFT OUTER JOIN kelas_siswa on ms_siswa.nis = kelas_siswa.nis and kelas_siswa.kd_sekolah=ms_siswa.kd_sekolah";
            //    $sql		.= " WHERE ms_siswa.nis NOT IN "
    		//				. " ( "
    		//				. "     SELECT TOP $off ms_siswa.nis " 
    		//				. " 	FROM ms_siswa "
            //                . "     LEFT OUTER JOIN kelas_siswa on ms_siswa.nis = kelas_siswa.nis and kelas_siswa.kd_sekolah=ms_siswa.kd_sekolah"
    		//				. " 	ORDER BY nama_lengkap,ms_siswa.nis asc "
    		//				. " ) "
            //                . " and kelas_siswa.th_ajar    ='$th_ajar'";
            //    $sql		.= " AND kelas_siswa.kd_sekolah   ='$kd_sekolah'";
            //    $sql		.= " AND kelas_siswa.kelas        ='$kelas'";
            //    $sql		.= " ORDER BY nama_lengkap,ms_siswa.nis asc";
            //}
       }
        
        $query = $this->db->query($sql);
        if ($query->result()) 
		{
            if($test=='')
            {
                return $query;
            }
            else
            {
                return $sql;
            }
        } 
		else 
		{
            return $query;
        }
    }
    function simpan($data)
    {
        if($this->db->insert('ms_siswa',$data))
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
        $this->db->where('nis',$kd);
        return $this->db->update('ms_siswa',$data);
    }
    function hapus($kd)
    {
        $this->db->where('nis',$kd);
        return $this->db->delete('ms_siswa');
    }
    function getBySiswaKelas($pilihnis)
    {
        $sql        = " select ms.nama_lengkap, ks.kelas
                        from ms_siswa ms
                        inner join kelas_siswa ks
                        on ms.kd_sekolah = ks.kd_sekolah
                        and ms.nis = ks.nis
                        where ks.nis = '$pilihnis' ";
        $hasil        = $this->db->query($sql);
        return $hasil;
    }
    function nama($pilihkelas)
    {
        $CI         = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        
        $sql        =" select ks.nis,nama_lengkap, ks.kelas "; 
        $sql        .=" from kelas_siswa ks ";
        $sql        .=" inner join ms_siswa ms ";
        $sql        .=" on ks.nis = ms.nis and ks.kd_sekolah = ms.kd_sekolah"; 
        $sql        .=" where ks.kd_sekolah = '$kd_sekolah' ";
        $sql        .=" and ks.th_ajar ='$th_ajar' ";
        $sql        .=" and ks.kelas='$pilihkelas' ";
        $sql        .=" ORDER BY nama_lengkap ";
        $query      = $this->db->query($sql);
        return $query;
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
    
    function get_per_kelas($kelas='',$kd_sekolah='',$th_ajar='')
    {
        $hasil['jmhBaris'] = 0;
        
        $sql    =   "select ks.nis, nama_lengkap
                    from kelas_siswa ks
                    inner join ms_siswa ms
                        on ks.nis = ms.nis
                        and ks.kd_sekolah = ms.kd_sekolah 
                    where ks.th_ajar        = '$th_ajar'
                        and ks.kd_sekolah   = '$kd_sekolah'
                        and ks.kelas        = '$kelas'
					ORDER BY nama_lengkap ";
        
        $hasil['hBaris']   = $this->db->query($sql);
        
        if ($hasil['hBaris']->num_rows() <= 0) {
//          $msg = $this->db->_error_message();
//          $num = $this->db->_error_number();
//
//          $hasil['msg'] = "Error(".$num.") ".$msg;
        } 
        else
        {
            $hasil['jmhBaris'] = $hasil['hBaris']->num_rows();
        }
        return  $hasil;
    }
}
?>