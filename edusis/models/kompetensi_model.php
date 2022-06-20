<?php
class Kompetensi_model extends CI_Model
{
    function construct()
    {
        parent::__construct();
    }
    function get($kd_sekolah,$th_ajar,$kd_mp,$tk,$kd_semester,$kd_jurusan,$id_sk)
    {
        $sql       = " select mmk.kd_mp, mmk.tk,mmk.kd_semester, mmk.kd_jurusan,mmk.kd_sk,mmk.ket_sk,mmk.skm, mmk.id_sk";
        $sql       .= " from ms_mp_kd mmk ";
        
        $sql       .= " inner join rf_semester rfs "; 
        $sql       .= " on mmk.kd_semester = rfs.kd_semester ";
        
        $sql       .= " inner join rf_jurusan rfj "; 
        $sql       .= " on mmk.kd_jurusan = rfj.kd_jurusan ";
 
        $sql       .= " where mmk.kd_sekolah = '$kd_sekolah' ";
        $sql       .= " and mmk.th_ajar      = '$th_ajar' ";
        $sql       .= " and mmk.kd_mp        = '$kd_mp' ";
        $sql       .= " and mmk.kd_jurusan   = '$kd_jurusan' ";
        $sql       .= " and mmk.kd_semester  = '$kd_semester' ";
        $sql       .= " and mmk.tk           = '$tk' ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getskmp($kd_sekolah,$th_ajar,$kd_semester,$kd_mp='',$tk='')
    {
        if($kd_mp!='' && $tk!='')
        {               
            $sql   =  " select * from ms_mp_kd
                        where kd_sekolah='$kd_sekolah'
                        and th_ajar 	='$th_ajar'
                        and kd_semester = $kd_semester
                        and kd_mp	    ='$kd_mp'
                        and tk          = $tk 
                        order by tk,kd_sk ";
        }
        else
        {
            $sql       =  " select * from ms_mp_kd
                        where kd_sekolah='$kd_sekolah'
                        and th_ajar 	='$th_ajar'
                        and kd_semester = $kd_semester  
                        and kd_mp	    ='0'
                        and tk          = 0 
                        order by tk,kd_sk ";
        }
        $hasil     = $this->db->query($sql);
        return $hasil;
    }
    function getall()
    {
        $sql       = " select mmk.kd_mp, tk, kd_semester, kd_jurusan, kd_sk, ket_sk, skm, id_sk, nm_mp";
        $sql       .= " FROM ms_mp_kd mmk ";
        $sql       .= " inner join ms_mp mp ";
        $sql       .= " on mmk.kd_sekolah = mp.kd_sekolah ";
        $sql       .= " and mmk.kd_mp = mp.kd_mp ";
        $hasil          = $this->db->query($sql);
        return $hasil;        
    }
    function getbyid_sk($id_sk)
    {
        $sql       = " select mmk.kd_mp, tk, kd_semester, kd_jurusan, kd_sk, ket_sk, skm, id_sk, nm_mp";
        $sql       .= " FROM ms_mp_kd mmk ";
        $sql       .= " inner join ms_mp mp ";
        $sql       .= " on mmk.kd_sekolah = mp.kd_sekolah ";
        $sql       .= " and mmk.kd_mp = mp.kd_mp ";
        $sql       .= " where id_sk = '$id_sk' ";
        $hasil          = $this->db->query($sql);
        return $hasil;        
    }
    
    function get_skkd($data)
    {
        $CI = &get_instance();
        $kdsekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar   = $CI->session->userdata('th_ajar');
        $id_sk     = $data['id_sk'];
        $kd_mp     = $data['kd_mp'];
        $tk        = $data['tk'] ;
        $kd_semester=$data['kd_semester'];
        
        $sql       = " select dtl.id_sk, dtl.ket_kd, dtl.skm ";
        $sql       .= " from ms_mp_kd_dtl dtl ";
                    
        $sql       .= " inner join ms_mp_kd kd ";
        $sql       .= " on dtl.id_sk        = kd.id_sk ";
        $sql       .= " and dtl.kd_sekolah  = '$kdsekolah' ";
        $sql       .= " and dtl.th_ajar     = '$th_ajar' ";
        $sql       .= " and dtl.kd_mp       = '$kd_mp' ";
        $sql       .= " and dtl.kd_semester = '$kd_semester' ";
        $sql       .= " and dtl.tk          = '$tk' ";
        $sql       .= " where dtl.id_sk     = '$id_sk'";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function tingkat()
    {
        $sql        =" select * from ms_kelas ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function semester()
    {
        $sql        =" select * from rf_semester ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function jurusan()
    {
        $sql        =" select * from rf_jurusan ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function simpan($data)
    {
        return $this->db->insert('ms_mp_kd',$data);
    }
    function update($kd_sekolah,$th_ajar,$kd_semester,$kd_mp,$tk,$id_sk,$skm)
    {
        $sql    = " UPDATE ms_mp_kd SET skm = '$skm' 
                    WHERE th_ajar = '$th_ajar' 
                    AND kd_sekolah = '$kd_sekolah' 
                    AND kd_semester = '$kd_semester' 
                    AND kd_mp = '$kd_mp' 
                    AND tk = '$tk' 
                    AND id_sk = $id_sk ";
        $hasil  = $this->db->query($sql);
        return $hasil;
    }
    function ubah($kd,$data)
    {
        $this->db->where('id_sk',$kd);
        return $this->db->update('ms_mp_kd',$data);
    }
    function hapus($kd_sk)
    {
        $this->db->where('id_sk',$kd_sk);
        return $this->db->delete('ms_mp_kd');
    }
    function get_sk($id_sk,$kd_semester,$tk,$kd_mp,$kd_sk,$kd_sekolah,$th_ajar)
    {
        $sql       =" select mmk.kd_mp, mmk.tk,mmk.kd_semester, mmk.kd_jurusan,mmk.kd_sk,mmk.ket_sk,mmk.skm, mmk.id_sk 
                    from ms_mp_kd mmk 
                    inner join rf_semester rfs 
                    on mmk.kd_semester = rfs.kd_semester
                    where mmk.kd_sekolah = '$kd_sekolah' 
                    and mmk.th_ajar = '$th_ajar' 
                    and mmk.kd_mp = '$kd_mp' 
                    and mmk.kd_semester = '$kd_semester' 
                    and mmk.tk = '$tk' 
                    and mmk.kd_sk = '$kd_sk'
                    and mmk.id_sk = '$id_sk'";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }

    function getKompetensiDasar($kd_sk,$kd_semester,$tk,$kd_mp,$kd_sekolah,$th_ajar)
    {
        $sql       =" select dtl.* 
                    from ms_mp_kd_dtl dtl
                    where dtl.kd_mp     = '$kd_mp'
                    and dtl.kd_sekolah  = '$kd_sekolah'
                    and dtl.th_ajar     = '$th_ajar'
                    and dtl.kd_semester = '$kd_semester'
                    and dtl.tk          = '$tk'
                    and dtl.kd_sk       = '$kd_sk'";
        $sql       .= " order by dtl.kd_ki ASC, kd_kd";
        $hasil      = $this->db->query($sql);
        
        return $hasil;
    }

    function getKompetensiDasarPerTingkat($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $kd_semester    = $CI->session->userdata('kd_semester');
        $tk             = $data['tk'];

        $sql       ="SELECT dtl.kd_mp, kd_ki, kd_kd, ket_kd FROM ms_mp_kd_dtl dtl
                    LEFT JOIN ms_mp mp
                    ON dtl.kd_mp = mp.kd_mp
                    where dtl.kd_sekolah  = '$kd_sekolah'
                    and dtl.th_ajar     = '$th_ajar'
                    and dtl.kd_semester = '$kd_semester'
                    and dtl.tk          = '$tk'";
        $sql       .= "order by mp.urutan";
        
        $hasil      = $this->db->query($sql);
        
        return $hasil;
    }

    function getKompetensiDasarForNl($kd_sk,$kd_semester,$tk,$jn,$kd_mp,$kd_sekolah,$th_ajar)
    {
        $sql       =" select dtl.* 
                    from ms_mp_kd_dtl dtl
                    inner join rf_jenis_nilai rfj
                    on dtl.kd_ki = rfj.ket
                    where dtl.kd_mp     = '$kd_mp'
                    and dtl.kd_sekolah  = '$kd_sekolah'
                    and dtl.th_ajar     = '$th_ajar'
                    and dtl.kd_semester = '$kd_semester'
                    and dtl.tk          = '$tk'
                    and dtl.kd_sk       = '$kd_sk'
                    and rfj.kd_jenis_nilai = '$jn'";
        $sql       .= " order by dtl.kd_ki ASC, kd_kd";
        $hasil      = $this->db->query($sql);
        
        return $hasil;
    }
    function getKompetensiDasarForNl_pas($kd_sk,$kd_semester,$tk,$jn,$kd_mp,$kd_sekolah,$th_ajar,$kd_ki)
    {
        $sql       =" select dtl.* 
                    from ms_mp_kd_dtl dtl
                    inner join rf_jenis_nilai rfj
                    on dtl.kd_ki = '$kd_ki'
                    where dtl.kd_mp     = '$kd_mp'
                    and dtl.kd_sekolah  = '$kd_sekolah'
                    and dtl.th_ajar     = '$th_ajar'
                    and dtl.kd_semester = '$kd_semester'
                    and dtl.tk          = '$tk'
                    and dtl.kd_sk       = '$kd_sk'
                    and rfj.kd_jenis_nilai = '$jn'
                    order by dtl.kd_ki ASC, dtl.kd_kd
                    ";
                    //echo $sql; die();
        $hasil      = $this->db->query($sql);
        
        return $hasil;
    }
    function getKompetensiDasarForNl_pas_ki4($kd_sk,$kd_semester,$tk,$jn,$kd_mp,$kd_sekolah,$th_ajar)
    {
        $sql       =" select dtl.* 
                    from ms_mp_kd_dtl dtl
                    inner join rf_jenis_nilai rfj
                    on dtl.kd_ki = 'ki4'
                    where dtl.kd_mp     = '$kd_mp'
                    and dtl.kd_sekolah  = '$kd_sekolah'
                    and dtl.th_ajar     = '$th_ajar'
                    and dtl.kd_semester = '$kd_semester'
                    and dtl.tk          = '$tk'
                    and dtl.kd_sk       = '$kd_sk'
                    and rfj.kd_jenis_nilai = '$jn'
                    order by dtl.kd_ki ASC, dtl.kd_kd
                    ";
                    //echo $sql; die();
        $hasil      = $this->db->query($sql);
        
        return $hasil;
    }
    function getKompetensiInti()
    {
        $sql       =" select *
                    from ms_mp_ki ";
                    
        $hasil      = $this->db->query($sql);
        
        return $hasil;
    }
    function get_kd_idr($kd_semester,$tk,$kd_mp,$kd_sk,$kd_kd,$kd_sekolah)
    {
        $sql        = " select idr.* 
                        from ms_mp_kd_idr idr
                        where idr.kd_mp = '$kd_mp' 
                        and idr.kd_sekolah = '$kd_sekolah' 
                        and idr.tk = '$tk'
                        and idr.kd_semester = '$kd_semester'  
                        and idr.kd_sk = '$kd_sk'   
                        and idr.kd_kd = '$kd_kd' ";
        $sql       .= " order by idr.kd_idr ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    } 
    function get_idr($id_sk,$kd_semester,$tk,$kd_mp,$kd_sk,$kd_kd,$kd_sekolah,$th_ajar)
    {
        $sql        = " select dtl.* 
                    from ms_mp_kd_dtl dtl
                    inner join ms_mp_kd kd on dtl.id_sk = kd.id_sk
                    and  dtl.kd_sekolah = kd.kd_sekolah
                    and  dtl.th_ajar    = kd.th_ajar   
                    and  dtl.kd_mp      = kd.kd_mp    
                    and  dtl.tk         = kd.tk        
                    and  dtl.kd_sk      = kd.kd_sk    
                    and  dtl.tk         = kd.tk 
                    where dtl.kd_mp     = '$kd_mp'
                    and dtl.kd_sekolah  = '$kd_sekolah'
                    and dtl.th_ajar     = '$th_ajar'
                    and dtl.kd_semester = '$kd_semester'
                    and dtl.kd_kd       = '$kd_kd'
                    and dtl.id_sk       = '$id_sk' ";
        $sql       .= " order by dtl.kd_kd";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function get_indikator($id_sk,$kd_semester,$tk,$kd_mp,$kd_sk,$kd_kd,$kd_sekolah,$th_ajar)
    {
        $sql        = " select * from ms_mp_kd_idr
                        where kd_sekolah = '$kd_sekolah'
                        and th_ajar = '$th_ajar'
                        and kd_semester= '$kd_semester'
                        and id_sk = '$id_sk'
                        and kd_mp = '$kd_mp'
                        and tk = '$tk'
                        and kd_sk = '$kd_sk'
                        and kd_kd = '$kd_kd'";
        $sql       .= " order by kd_idr";
        $hasil      = $this->db->query($sql);
        return $hasil;
                        
    }
    function get_kdindikator($id_sk,$kd_semester,$tk,$kd_mp,$kd_sk,$kd_kd,$kd_idr,$kd_sekolah,$th_ajar)
    {
        $sql        = " select * from ms_mp_kd_idr
                        where kd_sekolah = '$kd_sekolah'
                        and th_ajar = '$th_ajar'
                        and kd_semester= '$kd_semester'
                        and id_sk = '$id_sk'
                        and kd_mp = '$kd_mp'
                        and tk = '$tk'
                        and kd_sk = '$kd_sk'
                        and kd_kd = '$kd_kd'
                        and kd_idr = '$kd_idr'";
        $hasil      = $this->db->query($sql);
        return $hasil;
                        
    }
    function get_kdkd($kd_sk,$kd_semester,$tk,$kd_mp,$kd_sekolah,$th_ajar,$kd_ki,$kd_kd)
    {
        $sql       =" select dtl.* 
                    from ms_mp_kd_dtl dtl
                    where dtl.kd_mp     = '$kd_mp'
                    and dtl.kd_sekolah  = '$kd_sekolah'
                    and dtl.th_ajar     = '$th_ajar'
                    and dtl.kd_ki       = '$kd_ki'
                    and dtl.kd_kd       = '$kd_kd'
                    and dtl.kd_semester = '$kd_semester'
                    and dtl.tk          = '$tk'
                    and dtl.kd_sk       = '$kd_sk' 
                    ";
        //echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil->row();
    }
    function simpankd($data)
    {
        return $this->db->insert('ms_mp_kd_dtl',$data);
    }
    function ubahkd($th_ajar,$kd_sekolah,$kd_semester,$tk,$kd_mp,$kd_sk="",$kd_ki,$kd_kd,$data)
    {
        //echo "test"; die();
        $this->db->where('kd_semester',$kd_semester);
        $this->db->where('tk',$tk);
        $this->db->where('kd_mp',$kd_mp);
        $this->db->where('kd_sk',$kd_sk);
        $this->db->where('kd_ki',$kd_ki);
        $this->db->where('kd_kd',$kd_kd);
        $this->db->where('kd_sekolah',$kd_sekolah);
        $this->db->where('th_ajar',$th_ajar);
        return $this->db->update('ms_mp_kd_dtl',$data);
        //echo $this->db->last_query(); die();
    }
    function hapuskd($th_ajar,$kd_sekolah,$kd_semester,$tk,$kd_mp,$kd_sk="",$kd_ki,$kd_kd)
    {
        $this->db->where('kd_semester',$kd_semester);
        $this->db->where('tk',$tk);
        $this->db->where('kd_mp',$kd_mp);
        $this->db->where('kd_sk',$kd_sk);
        $this->db->where('kd_ki',$kd_ki);
        $this->db->where('kd_kd',$kd_kd);
        $this->db->where('kd_sekolah',$kd_sekolah);
        $this->db->where('th_ajar',$th_ajar);
        return $this->db->delete('ms_mp_kd_dtl');
    }
    function get_skkd_bykdmp($datas)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $kd_semester    = $CI->session->userdata('kd_semester');
        $kd_mp          = $datas['kd_mp'];
        $tk             = $datas['tk'] ;
        
        $sql            =" select mp.*,dtl.*,kd.*,idr.* 
                            from ms_mp_kd_dtl dtl  
                            
                            inner join ms_mp_kd kd
                            on dtl.kd_sekolah = kd.kd_sekolah
                            and dtl.th_ajar = kd.th_ajar 
                            and dtl.kd_semester = kd.kd_semester
                            and dtl.kd_mp = kd.kd_mp
                            and dtl.id_sk = kd.id_sk
                            and dtl.tk = kd.tk
                            and dtl.kd_sk = kd.kd_sk
                            
                            left outer join ms_mp_kd_idr idr
                            on dtl.kd_sekolah = idr.kd_sekolah
                            and dtl.kd_semester = idr.kd_semester
                            and dtl.th_ajar = idr.th_ajar
                            and dtl.kd_mp = idr.kd_mp
                            and dtl.id_sk = idr.id_sk
                            and dtl.tk = idr.tk
                            and dtl.kd_sk = idr.kd_sk
                            and dtl.kd_kd = idr.kd_kd
                            
                            inner join ms_mp mp
                            on dtl.kd_mp = mp.kd_mp
                            
                            where dtl.kd_mp     = '$kd_mp'
                            and dtl.tk          = '$tk'
                            and dtl.kd_sekolah  = '$kd_sekolah'
                            and dtl.th_ajar     = '$th_ajar'
                            and dtl.kd_semester = '$kd_semester'
                            order by mp.urutan,kd.id_sk,dtl.kd_kd,idr.kd_idr ";             
        $hasil          = $this->db->query($sql);
        return $hasil;
    }
    function get_skkd_bykdmppdf($datas)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $kd_semester    = $CI->session->userdata('kd_semester');
        //$kd_mp          = $datas['kd_mp'];
        $tk             = $datas['tk'] ;
        
        $sql            =" select mp.*,dtl.*,kd.*,idr.* 
                            from ms_mp_kd_dtl dtl  
                            
                            inner join ms_mp_kd kd
                            on dtl.kd_sekolah = kd.kd_sekolah
                            and dtl.th_ajar = kd.th_ajar 
                            and dtl.kd_semester = kd.kd_semester
                            and dtl.kd_mp = kd.kd_mp
                            and dtl.id_sk = kd.id_sk
                            and dtl.tk = kd.tk
                            and dtl.kd_sk = kd.kd_sk
                            
                            left outer join ms_mp_kd_idr idr
                            on dtl.kd_sekolah = idr.kd_sekolah
                            and dtl.kd_semester = idr.kd_semester
                            and dtl.th_ajar = idr.th_ajar
                            and dtl.kd_mp = idr.kd_mp
                            and dtl.id_sk = idr.id_sk
                            and dtl.tk = idr.tk
                            and dtl.kd_sk = idr.kd_sk
                            and dtl.kd_kd = idr.kd_kd
                            
                            inner join ms_mp mp
                            on dtl.kd_mp = mp.kd_mp
                            
                            where dtl.kd_sekolah  = '$kd_sekolah'
                            and dtl.tk          = '$tk'
                            and dtl.th_ajar     = '$th_ajar'
                            and dtl.kd_semester = '$kd_semester'
                            order by mp.urutan,kd.id_sk,dtl.kd_kd,idr.kd_idr ";
        $hasil          = $this->db->query($sql);
        return $hasil;
    }
    function simpanidr($data)
    {
        return $this->db->insert('ms_mp_kd_idr',$data);
    }
    function ubahidr($id_sk,$kd_semester,$tk,$kd_mp,$kd_sk,$kd_kd,$kd_idr,$data)
    {
        $CI         = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        
        $this->db->where('kd_sekolah',$kd_sekolah);
        $this->db->where('th_ajar',$th_ajar);
        $this->db->where('kd_semester',$kd_semester);
        $this->db->where('tk',$tk);
        $this->db->where('kd_mp',$kd_mp);
        $this->db->where('id_sk',$id_sk);
        $this->db->where('kd_sk',$kd_sk);
        $this->db->where('kd_kd',$kd_kd);
        $this->db->where('kd_idr',$kd_idr);
        return $this->db->update('ms_mp_kd_idr',$data);
    }
    function hapusidr($data)
    {
        //$this->db->where('th_ajar',$data['th_ajar']);
        //$this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('id_sk',$this->uri->segment(4));
        $this->db->where('kd_semester',$this->uri->segment(5));
        $this->db->where('tk',$this->uri->segment(6));
        $this->db->where('kd_mp',$this->uri->segment(7));
        $this->db->where('kd_sk',$this->uri->segment(8));
        $this->db->where('kd_kd',$this->uri->segment(9));
        $this->db->where('kd_idr',$this->uri->segment(10));
        return $this->db->delete('ms_mp_kd_idr');
    }
    function get_kompetensi($kd_sk,$kd_semester,$tk,$kd_mp,$kd_sekolah,$th_ajar,$kd_ki)
    {
        $sql       =" select kd_kd, ket_kd 
                    from ms_mp_kd_dtl dtl
                    where dtl.kd_mp     = '$kd_mp'
                    and dtl.kd_sekolah  = '$kd_sekolah'
                    and dtl.th_ajar     = '$th_ajar'
                    and dtl.kd_semester = '$kd_semester'
                    and dtl.tk          = '$tk'
                    and dtl.kd_sk       = '$kd_sk'
                    and dtl.kd_ki       = '$kd_ki'
                    order by dtl.kd_kd ASC, kd_ki
                    ";
        //echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function get_kompetensi_rpt($kd_semester,$tk,$kd_sekolah,$th_ajar,$kd_ki,$kd_mp)
    {
        $sql       =" select kd_kd, ket_kd
                    from ms_mp_kd_dtl dtl
                    where dtl.kd_sekolah  = '$kd_sekolah'
                    and dtl.th_ajar     = '$th_ajar'
                    and dtl.kd_semester = '$kd_semester'
                    and dtl.tk          = '$tk' 
                    and dtl.kd_ki       = '$kd_ki'
                    and dtl.kd_mp       = '$kd_mp'
                    order by dtl.kd_kd ASC, kd_ki
                    ";
        //echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getCombo($kd_sk,$kd_semester,$tk,$jn,$kd_mp,$kd_sekolah,$th_ajar)
    {
        $sql       =" select dtl.* 
                    from ms_mp_kd_dtl dtl
                    inner join rf_jenis_nilai rfj
                    on dtl.kd_ki = rfj.ket
                    where dtl.kd_mp     = '$kd_mp'
                    and dtl.kd_sekolah  = '$kd_sekolah'
                    and dtl.th_ajar     = '$th_ajar'
                    and dtl.kd_semester = '$kd_semester'
                    and dtl.tk          = '$tk'
                    and dtl.kd_sk       = '$kd_sk'
                    and rfj.kd_jenis_nilai = '$jn'
                    order by dtl.kd_kd ASC
                    ";
        //echo $sql; die();
        $hasil      = $this->db->query($sql);
        return arrayToSelect02($hasil->result_array(),'kd_kd',"kd_ki","kd_kd","ket_kd",true,'');
    }
    function getCombo_pas_ki3($kd_sk,$kd_semester,$tk,$jn,$kd_mp,$kd_sekolah,$th_ajar)
    {
        $sql       =" select dtl.* 
                    from ms_mp_kd_dtl dtl
                    inner join rf_jenis_nilai rfj
                    on dtl.kd_ki = 'ki3'
                    where dtl.kd_mp     = '$kd_mp'
                    and dtl.kd_sekolah  = '$kd_sekolah'
                    and dtl.th_ajar     = '$th_ajar'
                    and dtl.kd_semester = '$kd_semester'
                    and dtl.tk          = '$tk'
                    and dtl.kd_sk       = '$kd_sk'
                    and rfj.kd_jenis_nilai = '$jn'
                    order by dtl.kd_ki ASC, dtl.kd_kd
                    ";
        //echo $sql; die();
        $hasil      = $this->db->query($sql);
        return arrayToSelect02($hasil->result_array(),'kd_kd',"kd_ki","kd_kd","ket_kd",true,'');
    }
    function getCombo_pas_ki4($kd_sk,$kd_semester,$tk,$jn,$kd_mp,$kd_sekolah,$th_ajar)
    {
        $sql       =" select dtl.* 
                    from ms_mp_kd_dtl dtl
                    inner join rf_jenis_nilai rfj
                    on dtl.kd_ki = 'ki4'
                    where dtl.kd_mp     = '$kd_mp'
                    and dtl.kd_sekolah  = '$kd_sekolah'
                    and dtl.th_ajar     = '$th_ajar'
                    and dtl.kd_semester = '$kd_semester'
                    and dtl.tk          = '$tk'
                    and dtl.kd_sk       = '$kd_sk'
                    and rfj.kd_jenis_nilai = '$jn'
                    order by dtl.kd_ki ASC, dtl.kd_kd
                    ";
        //echo $sql; die();
        $hasil      = $this->db->query($sql);
        return arrayToSelect02($hasil->result_array(),'kd_kd',"kd_ki","kd_kd","ket_kd",true,'');
    }
    
}

?>