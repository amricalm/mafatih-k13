<?php 

class Mp_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function get($kd='',$kd_sekolah='',$thn_ajar='',$kelas='',$limit='',$off='')
    {
        $this->db->select('ms_mp.kd_mp,nm_mp,ms_mp.urutan');
        $this->db->from('ms_mp');
        $this->db->join('ms_mp_kelas','ms_mp.kd_mp=ms_mp_kelas.kd_mp and ms_mp.kd_sekolah=ms_mp.kd_sekolah','left outer');
        if($kd!='')
        {
            $this->db->where('ms_mp.kd_mp',$kd);
        }
        if($kd_sekolah!='')
        {
            $this->db->where('ms_mp.kd_sekolah',$kd_sekolah);
        }
        if($thn_ajar!='')
        {
            $this->db->where('th_ajar',$thn_ajar);
        }
        if($kelas!='')
        {
            $this->db->where('kelas',$kelas);
        }
        $this->db->order_by('urutan');
        $this->db->limit($limit,$off);
        
        return $this->db->get();
    }
    function geta()
    {
        $sql        =" SELECT kd_mp, kd_sekolah, nm_mp FROM ms_mp";
        $sql        .=" ORDER BY urutan, nm_mp";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function get_all($kd='')
    {
        $sql        = " select * from ms_mp";
        if($kd!='')
        {
            $sql    .= " where kd_mp = '$kd'";
        }
        $sql        .=" ORDER BY urutan, nm_mp";
        $hasil      = $this->db->query($sql);
        return $hasil;
//        $this->db->select('*');
//        $this->db->from('ms_mp');
//        $this->db->where('kd_sekolah',$kd_sekolah);
//        $this->db->order_by('urutan');
//        
//        return $this->db->get();
    }
    function get_mp($kd_sekolah)
    {
        $sql        =" SELECT kd_mp, kd_sekolah, nm_mp FROM ms_mp";
        $sql        .=" WHERE kd_sekolah='$kd_sekolah'";
        $sql        .=" ORDER BY urutan, nm_mp";
        $query      = $this->db->query($sql);
        return $query;
    }
    function get_mpotorisasi($kd_sekolah)
    {
        $CI         = &get_instance();
        $kd_group   = $CI->session->userdata('kode_group');
        $sql        ="  SELECT kd_mp, kd_sekolah, nm_mp FROM ms_mp
                        WHERE kd_sekolah='$kd_sekolah'
                        and kd_mp IN(select distinct kd_mp from sc_group_data where kd_group='$kd_group')
                        ORDER BY urutan, nm_mp";
        $query      = $this->db->query($sql);
        return $query;
    }
    function getMpByKelas($kelas)
    {
        $CI         = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $p_nl       = $CI->session->userdata('kd_semester');
        $th_ajar    = $CI->session->userdata('th_ajar');
        $sql        =" select mmk.kelas, mmk.kd_mp, mm.nm_mp
                    from ms_mp_kelas mmk
                    inner join ms_mp mm
                    on mmk.kd_mp = mm.kd_mp
                    where mmk.kd_sekolah = '$kd_sekolah'
                    and mmk.th_ajar	     = '$th_ajar'
                    and mmk.semester	 =  $p_nl
                    and mmk.kelas        = '$kelas'";
        $sql        .=" ORDER BY urutan, nm_mp";
        $query      = $this->db->query($sql);
        return $query;
    }
    function simpan($data)
    {
        return $this->db->insert('ms_mp',$data);
    }
    function update($kd,$data)
    {
        $this->db->where('kd_mp',$kd['kd_mp']);
        $this->db->where('kd_sekolah',$kd['kd_sekolah']);
        return $this->db->update('ms_mp',$data);
    }
    function hapus($kd)
    {
        $this->db->where('kd_mp',$kd['kd_mp']);
        $this->db->where('kd_sekolah',$kd['kd_sekolah']);
        return $this->db->delete('ms_mp');
    }
    function get_per_kelas($kelas, $kd_sekolah, $th_ajar, $p_nl)
    {
        $sql        =" select mmk.kelas, mmk.kd_mp, mm.nm_mp, mm.urutan
                       from ms_mp_kelas mmk
                       inner join ms_mp mm
                            on mmk.kd_mp = mm.kd_mp
                            and mmk.kd_sekolah = mm.kd_sekolah
                        where mmk.kd_sekolah    = '$kd_sekolah'
                            and mmk.th_ajar     = '$th_ajar'
                            and mmk.semester    = '$p_nl'
                            and mmk.kelas       = '$kelas'
                        ORDER BY mm.urutan";
        $query      = $this->db->query($sql);
        return $query;
    }
    function mp()
    {
        $CI         = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $sql        =" SELECT * FROM ms_mp";
        $sql        .=" WHERE kd_sekolah='$kd_sekolah'";
        $sql        .= " ORDER BY urutan ";
        $hasil      = $this->db->query($sql);
        return $hasil;        
    }
    function periksamp($data)
    {
        $kd_sekolah = $data['kd_sekolah'];
        $kd_mp      = $data['kd_mp'];
        $sql        =" SELECT * FROM ms_mp";
        $sql        .=" WHERE kd_sekolah='$kd_sekolah'";
        $sql        .=" AND kd_mp='$kd_mp'";
        $sql        .= " ORDER BY urutan ";
        $hasil      = $this->db->query($sql);
        return $hasil;        
    }
    function jn()
    {
        $sql        =" SELECT * FROM rf_jenis_nilai ";
        $sql        .=" WHERE kurikulum ='K13'";
        $sql        .=" ORDER BY ket ASC";
        $hasil      = $this->db->query($sql);
        return $hasil;        
    }
	function jn_ktsp_sma()
    {
        $sql        =" SELECT * FROM rf_jenis_nilai ";
		$sql        .=" WHERE kurikulum ='KTSP'";
        $sql        .=" AND SMP ='true'";
        $sql        .=" ORDER BY urutan ";
        $hasil      = $this->db->query($sql);
        return $hasil;        
    }
    function siswa()
    {
        $sql        =" select * from ms_siswa";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function add($data)
    {
        return $this->db->insert('nl_ips',$data);
    }
}

?>