<?php

class Kelas_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function getfilter($th_ajar,$kd_sekolah='',$limit='',$off='')
    {

        $test = '';
        if ($off == 0 || $off == '')
        {
            $sqllimit	= ($limit!='') ? 'LIMIT '.$limit : '';
            //$sql 		= " SELECT $sqllimit  kd_sekolah,kelas,tingkat,kd_jurusan FROM ms_kelas ";
            $sql 		= " SELECT mk.* , ms_karyawan.nip, nama_lengkap
                            FROM ms_kelas mk
                            left outer join kelas_wali kw
                            on mk.kd_sekolah = kw.kd_sekolah
                            and mk.kelas = kw.kelas
                            and th_ajar = '$th_ajar'
                            left outer join ms_karyawan
                            on kw.wali_kelas = ms_karyawan.nip";
            $sql		.= ($kd_sekolah!='') ? ' WHERE mk.kd_sekolah = '."'$kd_sekolah'" : '';
			$sql		.= " ORDER BY mk.kelas asc $sqllimit";
        }
        else
		{
			$sqllimit	= ($limit!='') ? 'LIMIT '.$limit : '';
            //$sql 		= " SELECT $sqllimit  kd_sekolah,kelas,tingkat,kd_jurusan FROM ms_kelas "
			$sql 		= " SELECT mk.* , ms_karyawan.nip, nama_lengkap
                            FROM ms_kelas mk
                            left outer join kelas_wali kw
                            on mk.kd_sekolah = kw.kd_sekolah
                            and mk.kelas = kw.kelas
                            and th_ajar = '$th_ajar'
                            left outer join ms_karyawan
                            on kw.nip = ms_karyawan.nip"
            			. " WHERE mk.kelas NOT IN "
						. " ( "
						. "     SELECT TOP $off kelas "
						. " 	FROM ms_kelas "
						. " 	ORDER BY mk.kelas asc "
						. " ) ";
			$sql		.= ($kd_sekolah!='') ? ' AND mk.kd_sekolah = '."'$kd_sekolah'" : '';
			$sql		.= " ORDER BY mk.kelas asc $sqllimit";
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
    function getfilterotorisasi($th_ajar,$kd_sekolah)
    {
        $CI         = &get_instance();
        $kd_group   = $CI->session->userdata('kode_group');
        //echo $kd_group;
        //die();
        $sql        =" SELECT mk.*
                        FROM ms_kelas mk
                        WHERE mk.kd_sekolah = '$kd_sekolah' and mk.kelas IN (SElECT distinct  kelas from sc_group_data where kd_group = '$kd_group' )
                        ORDER BY mk.kelas asc ";
        // echo $sql; die();
        $query      = $this->db->query($sql);
        return $query;
    }
    function periksakelas($data)
    {
        $CI = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $kelas      = $data['kelas'];
        $sql        = " select *
                        from ms_kelas
                        where kd_sekolah = '$kd_sekolah'
                        and kelas = '$kelas'";
        $query      = $this->db->query($sql);
        return $query;
    }
    function getwaliall($data)
    {
        $CI = &get_instance();
        $kdsekolah          = $CI->session->userdata('kd_sekolah');
        $th_ajar            = $CI->session->userdata('th_ajar');
        $sql        = " SELECT ks.kelas, kw.th_ajar, kw.kd_sekolah, kw.wali_kelas, mk.*
                        FROM ms_kelas ks
                        left outer join kelas_wali kw
                            on ks.kd_sekolah = kw.kd_sekolah
                            and ks.kelas = kw.kelas
                            and kw.th_ajar= '$th_ajar'
                        left outer join ms_karyawan  mk
                            on kw.wali_kelas = mk.nip
                        WHERE ks.kd_sekolah ='$kdsekolah'
                        order by ks.kelas";
        $query      = $this->db->query($sql);
        return $query;
    }
    function getwalikelas($th_ajar)
    {
        $sql        = " select mk.kelas, nama_lengkap,kw.nip
                        from ms_kelas mk
                        left outer join kelas_wali kw
                        on mk.kd_sekolah = kw.kd_sekolah
                        and mk.kelas = kw.kelas
                        and th_ajar = '$th_ajar'

                        left outer join ms_karyawan
                        on kw.nip = ms_karyawan.nip ";
        //echo $sql; die();
        $query      = $this->db->query($sql);
        return $query;
    }
    function getwali($th_ajar,$kd_sekolah='',$kelas='')
    {
        $this->db->select('*')
                 ->from('ms_karyawan')
                 ->join('kelas_wali', 'kelas_wali.wali_kelas = ms_karyawan.nip', 'inner')
                 ->where('th_ajar', $th_ajar)
                 ->where('kd_sekolah', $kd_sekolah)
                 ->where('kelas', $kelas);
        $h = $this->db->get()->result();
        return $h;
	}
    function simpanwali($data)
    {
        if($this->db->insert('kelas_wali',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    function updatewali($kd,$data)
    {

        $this->db->where('kelas',$kd);
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        return $this->db->update('kelas_wali',$data);

    }

    function get($kd='')
    {
        $sql        = " SELECT * FROM ms_kelas ";
        if($kd!='')
        {
            $sql    .= " WHERE kelas ='$kd' ";
        }
        $query      = $this->db->query($sql);
        return $query;
    }
    function walikelas($kd='',$kd_sekolah='',$th_ajar='')
    {
        $sql        = " SELECT * FROM kelas_wali
                        where th_ajar = '" . trim($th_ajar) . "'
                        and kd_sekolah ='". trim($kd_sekolah) ."'";

        if($kd!='')
        {
            $sql    .= " and kelas ='$kd' ";
        }
        $query      = $this->db->query($sql);
        return $query;
    }
    function kelas_siswa($kelas) //sama dengan siswa_model > siswa
    {
        $sql        =" select kelas_siswa.nis,nama_lengkap, kelas_siswa.kelas";
        $sql        .=" from kelas_siswa ";
        $sql        .=" inner join ms_siswa ";
        $sql        .=" on kelas_siswa.nis = ms_siswa.nis ";
        $sql        .=" where kelas_siswa.kelas='$kelas'";
        $sql        .=" ORDER BY nama_lengkap ";
        $query      = $this->db->query($sql);
        return $query;

    }
    function get_all()
    {
        $sql        =" SELECT nama_lengkap, ms_siswa.kelas ";
        $sql        .=" FROM ms_siswa ";
        $sql        .=" INNER JOIN kelas_siswa ";
        $sql        .=" ON ms_siswa.nis = kelas_siswa.nis";
        $query      = $this->db->query($sql);
        return $query;
    }

    function simpan($data)
    {
        if($this->db->insert('ms_kelas',$data))
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
        $this->db->where('kelas',$kd);
        return $this->db->update('ms_kelas',$data);
    }
//    function update($data)
//    {
//        $this->db->where('th_ajar',$data['th_ajar']);
//        $this->db->where('kd_sekolah',$data['kd_sekolah']);
//        $this->db->where('nis',$data['nis']);
//        $this->db->where('kelas',$data['kelas']);
//        $this->db->where('p_nl',$data['p_nl']);
//        $this->db->where('kd_pribadi',$data['kd_pribadi']);
//        $this->db->set('hasil',$data['hasil']);
//        return $this->db->update('nl_pribadi',$data);
//    }
    function hapus($kd)
    {
        $this->db->where('kelas',$kd);
        return $this->db->delete('ms_kelas');
    }


    function get_kelas_siswa_belum($kd_sekolah,$th_ajar)
    {
        $this->db->select('*');
        $this->db->from('ms_siswa');
        $this->db->where("nis NOT IN (select nis from kelas_siswa where kd_sekolah ='".$kd_sekolah."' and th_ajar ='".$th_ajar."') and kd_sekolah='".$kd_sekolah."'" ) ;

        return $this->db->get();
    }
    function get_kelas_siswa($nis,$kd_sekolah,$th_ajar)
    {
        $this->db->select('*');
        $this->db->from('kelas_siswa');
        $this->db->where('kode_sekoalah',$kd_sekolah);
        $this->db->where('th_ajar',$th_ajar);

        return $this->db->get();
    }
    function simpan_siswa_kelas($data)
    {
        if($this->db->insert('kelas_siswa',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function hapus_siswa_kelas($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('nis',$data['nis']);
        return $this->db->delete('kelas_siswa');
    }
    public function get_mp()
    {
        $sql        ="SELECT kd_mp, kd_sekolah, nm_mp FROM ms_mp";
        $query      = $this->db->query($sql);
        return $query;
    }
    function get_kelas_nis($data)
    {
        $CI = &get_instance();
        $kdsekolah          = $CI->session->userdata('kd_sekolah');
        $th_ajar            = $CI->session->userdata('th_ajar');
        $nis                = $data['nis'];
        $kelas              = $data['kelas'];
        $p_nl               = $data['p_nl'];
        $hasil              = $data['hasil'];
        $kd_pribadi         = $data['kd_pribadi'];
        $sql                = " select rf.kd_pribadi,ket_pribadi, hasil ".
                                ' from ref_pribadi rf '.
                                ' left outer join nl_pribadi nl '.
                                ' on rf.kd_pribadi = nl.kd_pribadi '.
                                " and kd_sekolah = '$kdsekolah'".
                                " and nis = '$nis' ".
                                " and kelas = '$kelas' ".
                                " and th_ajar = '$th_ajar'".
                                " and hasil = '$hasil' " ;
        $sql               .= ($kd_pribadi!='') ? " where nl.kd_pribadi = '$kd_pribadi'" : '';
        $hasil              = $this->db->query($sql);
        return $hasil;
    }
    function get_jmlsiswaperkelas($data)
    {
        $CI = &get_instance();
        $kdsekolah          = $CI->session->userdata('kd_sekolah');
        $th_ajar            = $CI->session->userdata('th_ajar');
        $kls                = $data['kls'];
        $sql                = " select * from kelas_siswa
                                where kd_sekolah = '$kdsekolah'
                                and th_ajar = '$th_ajar'
                                and kelas = '$kls'";
        $hasil              = $this->db->query($sql);
        return $hasil;
    }
}

?>
