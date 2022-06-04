<?php 

class Prestasi_model extends CI_Model
{
    function __construct()
    {
        parent::__Construct();
    }
    function get_prestasi($kd='')
    {
        $sql                    = " SELECT * FROM bp_prestasi";
        if($kd!='' && $kd!='0')
        {
            $sql                .= " WHERE kd_prestasi ='$kd' ";
        }
        $sql                    .= " order by kd_prestasi";
        $hasil = $this->db->query($sql);
        return $hasil;
    }
    function get_kdprestasi($kd)
    {
        $sql                    = " SELECT bps.*, ms.nama_lengkap, bp.* FROM bp_prestasi_siswa bps
                                    INNER JOIN ms_siswa ms
                                    on bps.nis = ms.nis
                                    INNER JOIN bp_prestasi bp
                                    ON bps.kd_prestasi = bp.kd_prestasi
                                    where kd_prestasi_siswa = '$kd'";
        $hasil= $this->db->query($sql);
        return $hasil;
    }

    function simpanprestasi($data)
    {
        if($this->db->insert('bp_prestasi',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function updateprestasi($kd,$data)
    {
        $this->db->where('kd_prestasi',$kd);
        return $this->db->update('bp_prestasi',$data);
    }
    function hapusprestasi($kd)
    {
        $this->db->where('kd_prestasi',$kd);
        return $this->db->delete('bp_prestasi');
    }
    function gettgl($kd)
    {
        $sql        = " select year(tgl) th,month(tgl) bln,day(tgl) hr 
                        from bp_prestasi_siswa ";
        $sql        .= " where kd_prestasi_siswa = '$kd'";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function get_prestasisiswa()
    {
        $CI         = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        $p_nl       = $CI->session->userdata('kd_semester');               
        $sql        = " SELECT bps.*, ms.nama_lengkap, bp.*,DATE_FORMAT(tgl, '%d %M %Y') as tglpanjang FROM bp_prestasi_siswa bps
                    INNER JOIN ms_siswa ms
                    on bps.nis = ms.nis
                    INNER JOIN bp_prestasi bp
                    ON bps.kd_prestasi = bp.kd_prestasi
                    where bps.kd_sekolah ='$kd_sekolah'
                    and th_ajar ='$th_ajar'
                    and p_nl = '$p_nl'
                    order by bps.tgl ";
        $hasil= $this->db->query($sql);
        return $hasil;
    }    
    function simpanprestasisiswa($data)
    {
        if($this->db->insert('bp_prestasi_siswa',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function updateprestasisiswa($kd,$data)
    {
        $this->db->where('kd_prestasi_siswa',$kd);
        return $this->db->update('bp_prestasi_siswa',$data);
    }
    function hapusprestasisiswa($kd)
    {
        $this->db->where('kd_prestasi_siswa',(string)$kd);
        return $this->db->delete('bp_prestasi_siswa');
    }
    function get_max()
    {
        $sql            = " select coalesce(max(right(kd_prestasi_siswa,5)),0) as max from bp_prestasi_siswa";
        $hasil          = $this->db->query($sql);
        return $hasil->row()->max;
    }
    
    function getprestasipersiswa($nis='')
    {
        $sql            = " SELECT bps.*, ms.nama_lengkap, bp.* FROM bp_prestasi_siswa bps
                            INNER JOIN ms_siswa ms
                            on bps.nis = ms.nis
                            INNER JOIN bp_prestasi bp
                            ON bps.kd_prestasi = bp.kd_prestasi 
                            order by bps.kd_prestasi";
        if($nis!='' && $nis!='0')
        {                    
            $sql       = " SELECT bps.*, ms.nama_lengkap, bp.* FROM bp_prestasi_siswa bps
                            INNER JOIN ms_siswa ms
                            on bps.nis = ms.nis
                            INNER JOIN bp_prestasi bp
                            ON bps.kd_prestasi = bp.kd_prestasi
                            WHERE bps.nis = '$nis'
                            order by bps.kd_prestasi ";
        }
        $hasil= $this->db->query($sql);
        return $hasil;
    }    
    
}

?>