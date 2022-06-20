<?php
class Hasilbelajar_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function tampil($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['pilihkelas'];
        $nis            = $data['pilihnis'];
        //echo $nis;
        //$kd_mp          = $data['kd_mp'];

        $sql        = " select mpk.*,uht1.nama_lengkap,mp.kd_mp, mp.nm_mp, coalesce(uht1.kgn,' ') UHT1, coalesce(uht2.kgn,' ') UHT2, coalesce(uht3.kgn,' ') UHT3, coalesce(uhp1.kgn,0) UHP1, coalesce(uhp2.kgn,0) UHP2, coalesce(uhp3.kgn,0) UHP3, coalesce(tgs1.kgn,0) TGS1, coalesce(tgs2.kgn,0) TGS2, coalesce(tgs3.kgn,0) TGS3, coalesce(utst.kgn,0) UTST, coalesce(utsp.kgn,0) UTSP, coalesce(uast.kgn,0) UAST, coalesce(UASP.kgn,0) UASP, uht1.ayah_nama
                        from ms_mp_kelas mpk
                        inner join ms_mp mp
                        	on mpk.kd_mp = mp.kd_mp
                        	and mpk.kd_sekolah = mp.kd_sekolah

                        left outer  join
                        	(
                        		select kd_mp, kgn, nama_lengkap, ayah_nama from tgh_siswa ts
                                inner join ms_siswa
                                on ts.nis = ms_siswa.nis
                                and ts.kd_sekolah= ms_siswa.kd_sekolah
                        		where kd_tagihan = 'UHT1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      = '$p_nl'
                        		and ts.kelas	 = '$kelas'
                        		and ts.nis       = '$nis'
                        	)uht1
                        	on mpk.kd_mp = uht1.kd_mp

                        left outer  join
                        	(
                        		select kd_mp, kgn from tgh_siswa ts
                        		where kd_tagihan  = 'UHT2'
                        		and kd_sekolah	     = '$kd_sekolah'
                        		and th_ajar          = '$th_ajar'
                        		and p_nl             = '$p_nl'
                        		and kelas	         = '$kelas'
                        		and nis              = '$nis'
                        	)uht2
                        	on mpk.kd_mp = uht2.kd_mp

                        left outer  join
                        	(
                        		select kd_mp, kgn from tgh_siswa ts
                        		where kd_tagihan  = 'UHT3'
                        		and kd_sekolah	     = '$kd_sekolah'
                        		and th_ajar          = '$th_ajar'
                        		and p_nl             = '$p_nl'
                        		and kelas	         = '$kelas'
                        		and nis              = '$nis'
                        	)uht3
                        	on mpk.kd_mp = uht3.kd_mp


                        left outer  join
                        	(
                        		select kd_mp, kgn from tgh_siswa ts
                        		where kd_tagihan = 'UHT1'
                        		and kd_sekolah	     = '$kd_sekolah'
                        		and th_ajar          = '$th_ajar'
                        		and p_nl             = '$p_nl'
                        		and kelas	         = '$kelas'
                        		and nis              = '$nis'
                        	)uhp1
                        	on mpk.kd_mp = uhp1.kd_mp
                        left outer  join
                        	(
                        		select kd_mp, kgn from tgh_siswa ts
                        		where kd_tagihan = 'UHT2'
                        		and kd_sekolah	     = '$kd_sekolah'
                        		and th_ajar          = '$th_ajar'
                        		and p_nl             = '$p_nl'
                        		and kelas	         = '$kelas'
                        		and nis              = '$nis'
                        	)uhp2
                        	on mpk.kd_mp = uhp2.kd_mp
                        left outer  join
                        	(
                        		select kd_mp, kgn from tgh_siswa ts
                        		where kd_tagihan = 'UHT3'
                        		and kd_sekolah	     = '$kd_sekolah'
                        		and th_ajar          = '$th_ajar'
                        		and p_nl             = '$p_nl'
                        		and kelas	         = '$kelas'
                        		and nis              = '$nis'
                        	)uhp3
                        	on mpk.kd_mp = uhp3.kd_mp


                        left outer  join
                        	(
                        		select kd_mp, kgn from tgh_siswa ts
                        		where kd_tagihan = 'TGS1'
                        		and kd_sekolah	     = '$kd_sekolah'
                        		and th_ajar          = '$th_ajar'
                        		and p_nl             = '$p_nl'
                        		and kelas	         = '$kelas'
                        		and nis              = '$nis'
                        	)tgs1
                        	on mpk.kd_mp = tgs1.kd_mp

                        left outer  join
                        	(
                        		select kd_mp, kgn from tgh_siswa ts
                        		where kd_tagihan = 'TGS2'
                        		and kd_sekolah	     = '$kd_sekolah'
                        		and th_ajar          = '$th_ajar'
                        		and p_nl             = '$p_nl'
                        		and kelas	         = '$kelas'
                        		and nis              = '$nis'
                        	)tgs2
                        	on mpk.kd_mp = tgs2.kd_mp

                        left outer  join
                        	(
                        		select kd_mp, kgn from tgh_siswa ts
                        		where kd_tagihan = 'TGS3'
                        		and kd_sekolah	     = '$kd_sekolah'
                        		and th_ajar          = '$th_ajar'
                        		and p_nl             = '$p_nl'
                        		and kelas	         = '$kelas'
                        		and nis              = '$nis'
                        	)tgs3
                        	on mpk.kd_mp = tgs3.kd_mp


                        left outer  join
                        	(
                        		select kd_mp, kgn from tgh_siswa ts
                        		where kd_tagihan = 'UTST'
                        		and kd_sekolah	     = '$kd_sekolah'
                        		and th_ajar          = '$th_ajar'
                        		and p_nl             = '$p_nl'
                        		and kelas	         = '$kelas'
                        		and nis              = '$nis'
                        	)utst
                        	on mpk.kd_mp = utst.kd_mp

                        left outer  join
                        	(
                        		select kd_mp, kgn from tgh_siswa ts
                        		where kd_tagihan = 'UTSP'
                        		and kd_sekolah	     = '$kd_sekolah'
                        		and th_ajar          = '$th_ajar'
                        		and p_nl             = '$p_nl'
                        		and kelas	         = '$kelas'
                        		and nis              = '$nis'
                        	)utsp
                        	on mpk.kd_mp = utsp.kd_mp

                        left outer  join
                        	(
                        		select kd_mp, kgn from tgh_siswa ts
                        		where kd_tagihan = 'UAST'
                        		and kd_sekolah	     = '$kd_sekolah'
                        		and th_ajar          = '$th_ajar'
                        		and p_nl             = '$p_nl'
                        		and kelas	         = '$kelas'
                        		and nis              = '$nis'
                        	)uast
                        	on mpk.kd_mp = uast.kd_mp

                        left outer  join
                        	(
                        		select kd_mp, kgn from tgh_siswa ts
                        		where kd_tagihan = 'UASP'
                        		and kd_sekolah	     = '$kd_sekolah'
                        		and th_ajar          = '$th_ajar'
                        		and p_nl             = '$p_nl'
                        		and kelas	         = '$kelas'
                        		and nis              = '$nis'
                        	)uasp
                        	on mpk.kd_mp = uasp.kd_mp


                        where mpk.kd_sekolah ='$kd_sekolah'
                        and th_ajar          ='$th_ajar'
                        and semester         = $p_nl
                        and kelas            ='$kelas' ";
        $hasil      = $this->db->query($sql);
        return $hasil;

    }
    function nilai_ledger_pengetahuan_k13_sma($data)
    {
      $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];

        $sqlRjkn        = array();
        $sqlRjknUts     = array();
        $sqlSelect      = '';

        $KdArr          = array('KD1','KD2', 'KD3', 'KD4', 'KD5', 'KD6', 'KD7', 'KD8', 'KD9', 'KD10', 'KD11', 'KD12');
        $rjknKd         = array('NH1','NH2','NH3','NH4','NH5','NH6','PAS');

        $sql            = '';

        for ($v=0; $v < count($KdArr) ; $v++) {
          for ($a=0; $a < count($rjknKd); $a++)
          {
            array_push($sqlRjkn,
            " LEFT OUTER JOIN (
                select nis, max(kgn) $rjknKd[$a] FROM (
                SELECT nis, kgn FROM tgh_siswa ts
                WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
                AND ts.kd_kd = '$KdArr[$v]'
                AND ts.kd_sekolah= '$kd_sekolah'
                AND ts.th_ajar = '$th_ajar'
                AND ts.p_nl = '$p_nl'
                AND ts.sub_pnl = 'UAS'
                AND ts.kelas = '$kelas'
                AND ts.kd_mp = '$kd_mp'
                ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a] ON ks.nis = $KdArr[$v]_$rjknKd[$a].nis  "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select nis, max(kgn) $rjknKd[$a] FROM (
            SELECT nis, kgn FROM tgh_siswa ts
            WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
            AND ts.kd_kd = '".$KdArr[$v]."'
            AND ts.kd_sekolah= '$kd_sekolah'
            AND ts.th_ajar = '$th_ajar'
            AND ts.p_nl = '$p_nl'
            AND ts.sub_pnl = 'UTS'
            AND ts.kelas = '$kelas'
            AND ts.kd_mp = '$kd_mp'
            ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a]_UTS
                    ON ks.nis = $KdArr[$v]_$rjknKd[$a]_UTS.nis "
          );
          }
        }

        $sql_tbl = "";
        if ($sub_pnl == 'UAS') {
          //====================================Start UAS======================================//====//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c]);
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        else
        {
          //====================================Start UAS============================================//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        $sql            .= " SELECT ks.nis, ms.nama_lengkap, ms.nama_panggilan, COALESCE(uas.kgn, 0) UAS
                            ".$sqlSelect."
                            FROM kelas_siswa ks
                            INNER JOIN ms_siswa ms
                            ON ks.nis = ms.nis ";

        foreach ($sqlRjkn as $value) {
          $sql .= $value;
        }

        $sql .= " left outer  join
                  (
                    select * from tgh_siswa ts
                    where kd_tagihan = 'UAS'
					and ts.kd_kd     = ''
                    and ts.kd_sekolah= '$kd_sekolah'
                    and ts.th_ajar   = '$th_ajar'
                    and ts.p_nl      =  '$p_nl'
                    and ts.sub_pnl   = '$sub_pnl'
                    and ts.kelas	 = '$kelas'
                    and ts.kd_mp     = '$kd_mp'
                  )uas
                  on ks.nis = uas.nis

                  WHERE ks.kd_sekolah = '$kd_sekolah'
                  AND ks.th_ajar = '$th_ajar'
                  AND ks.kelas = '$kelas'
                  ORDER BY nama_lengkap ";
        //echo $sql; die();
        $hasil        = $this->db->query($sql)->result();
        return $hasil;
        
    }
    function nilai_ledger_keterampilan_k13_sma($data)
    {
      $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];

        $sqlRjkn        = array();
        $sqlRjknUts     = array();
        $sqlSelect      = '';

        $KdArr          = array('KD1','KD2', 'KD3', 'KD4', 'KD5', 'KD6', 'KD7', 'KD8', 'KD9', 'KD10', 'KD11', 'KD12');
        $rjknKd         = array('KIN1','KIN2','PRJ1','PRJ2','POR1','POR2','PAS');

        $sql            = '';

        for ($v=0; $v < count($KdArr) ; $v++) {
          for ($a=0; $a < count($rjknKd); $a++)
          {
            array_push($sqlRjkn,
            " LEFT OUTER JOIN (
                select nis, max(psk) $rjknKd[$a] FROM (
                SELECT nis, psk FROM tgh_siswa ts
                WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
                AND ts.kd_kd = '$KdArr[$v]'
                AND ts.kd_sekolah= '$kd_sekolah'
                AND ts.th_ajar = '$th_ajar'
                AND ts.p_nl = '$p_nl'
                AND ts.sub_pnl = 'UAS'
                AND ts.kelas = '$kelas'
                AND ts.kd_mp = '$kd_mp'
                ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a] ON ks.nis = $KdArr[$v]_$rjknKd[$a].nis  "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select nis, max(psk) $rjknKd[$a] FROM (
            SELECT nis, psk FROM tgh_siswa ts
            WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
            AND ts.kd_kd = '".$KdArr[$v]."'
            AND ts.kd_sekolah= '$kd_sekolah'
            AND ts.th_ajar = '$th_ajar'
            AND ts.p_nl = '$p_nl'
            AND ts.sub_pnl = 'UTS'
            AND ts.kelas = '$kelas'
            AND ts.kd_mp = '$kd_mp'
            ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a]_UTS
                    ON ks.nis = $KdArr[$v]_$rjknKd[$a]_UTS.nis "
          );
          }
        }

        $sql_tbl = "";
        if ($sub_pnl == 'UAS') {
          //====================================Start UAS======================================//====//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c]);
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        else
        {
          //====================================Start UAS============================================//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        $sql            .= " SELECT ks.nis, ms.nama_lengkap, ms.nama_panggilan, COALESCE(uas.psk, 0) UAS
                            ".$sqlSelect."
                            FROM kelas_siswa ks
                            INNER JOIN ms_siswa ms
                            ON ks.nis = ms.nis ";

        foreach ($sqlRjkn as $value) {
          $sql .= $value;
        }

        $sql .= " left outer  join
                  (
                    select * from tgh_siswa ts
                    where kd_tagihan = 'UAS'
                    and ts.kd_kd     = ''
                    and ts.kd_sekolah= '$kd_sekolah'
                    and ts.th_ajar   = '$th_ajar'
                    and ts.p_nl      =  '$p_nl'
                    and ts.sub_pnl   = '$sub_pnl'
                    and ts.kelas     = '$kelas'
                    and ts.kd_mp     = '$kd_mp'
                  )uas
                  on ks.nis = uas.nis

                  WHERE ks.kd_sekolah = '$kd_sekolah'
                  AND ks.th_ajar = '$th_ajar'
                  AND ks.kelas = '$kelas'
                  ORDER BY nama_lengkap ";
        //echo $sql; die();
        $hasil        = $this->db->query($sql)->result();
        return $hasil;
        
    }
    function nilai_ledger_sikap_k13_spr($data)
    {
       $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $tk             = $data['tk'];
        $kd_mp          = $data['kd_mp'];

        $sqlRjkn        = array();
        $sqlRjknUts     = array();
        $sqlSelect      = '';

        $KdArr          = array('KD1','KD2', 'KD3', 'KD4', 'KD5', 'KD6', 'KD7', 'KD8', 'KD9', 'KD10', 'KD11', 'KD12');
        $rjknKd         = array('SPR');

        $sql            = '';

        for ($v=0; $v < count($KdArr) ; $v++) {
          for ($a=0; $a < count($rjknKd); $a++)
          {
            array_push($sqlRjkn,
            " LEFT OUTER JOIN (
                select nis, max(afk) $rjknKd[$a] FROM (
                SELECT nis, afk FROM tgh_siswa ts
                WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
                AND ts.kd_kd = '$KdArr[$v]'
                AND ts.kd_sekolah= '$kd_sekolah'
                AND ts.th_ajar = '$th_ajar'
                AND ts.p_nl = '$p_nl'
                AND ts.sub_pnl = 'UAS'
                AND ts.kelas = '$kelas'
                AND ts.kd_mp = '$kd_mp'
                ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a] ON ks.nis = $KdArr[$v]_$rjknKd[$a].nis  "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select nis, max(afk) $rjknKd[$a] FROM (
            SELECT nis, afk FROM tgh_siswa ts
            WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
            AND ts.kd_kd = '".$KdArr[$v]."'
            AND ts.kd_sekolah= '$kd_sekolah'
            AND ts.th_ajar = '$th_ajar'
            AND ts.p_nl = '$p_nl'
            AND ts.sub_pnl = 'UTS'
            AND ts.kelas = '$kelas'
            AND ts.kd_mp = '$kd_mp'
            ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a]_UTS
                    ON ks.nis = $KdArr[$v]_$rjknKd[$a]_UTS.nis "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select tk, ket_kd SPR FROM (
            SELECT tk, ket_kd FROM ms_mp_kd_dtl kd
            WHERE kd.kd_ki = 'ki1'
            AND kd.kd_kd = '".$KdArr[$v]."'
            AND kd.kd_sekolah= '$kd_sekolah'
            AND kd.th_ajar = '$th_ajar'
            AND kd.kd_semester = '$p_nl'
            AND kd.tk = '$tk'
            AND kd.kd_mp = '$kd_mp'
            ) tr ) $KdArr[$v]_$rjknKd[$a]_DES ON kls.tingkat = $KdArr[$v]_$rjknKd[$a]_DES.tk "
            );
          }
        }

        $sql_tbl = "";
        if ($sub_pnl == 'UAS') {
          //====================================Start UAS======================================//====//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c]);
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_des');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_DES.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        else
        {
          //====================================Start UAS============================================//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_des');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_DES.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        $sql            .= " SELECT ks.nis, ms.nama_lengkap, ms.nama_panggilan, COALESCE(uas.afk, 0) UAS
                            ".$sqlSelect."
                            FROM kelas_siswa ks
                            INNER JOIN ms_siswa ms
                            ON ks.nis = ms.nis
                            INNER JOIN ms_kelas kls
                            ON ks.kelas = kls.kelas ";

        foreach ($sqlRjkn as $value) {
          $sql .= $value;
        }

        $sql .= " left outer  join
                  (
                    select * from tgh_siswa ts
                    where kd_tagihan = 'UAS'
                    and ts.kd_kd     = ''
                    and ts.kd_sekolah= '$kd_sekolah'
                    and ts.th_ajar   = '$th_ajar'
                    and ts.p_nl      =  '$p_nl'
                    and ts.sub_pnl   = '$sub_pnl'
                    and ts.kelas     = '$kelas'
                    and ts.kd_mp     = '$kd_mp'
                  )uas
                  on ks.nis = uas.nis

                  WHERE ks.kd_sekolah = '$kd_sekolah'
                  AND ks.th_ajar = '$th_ajar'
                  AND ks.kelas = '$kelas'
                  ORDER BY nama_lengkap ";
        //echo $sql; die();
        $hasil        = $this->db->query($sql)->result();
        return $hasil;
        
    }

    function nilai_ledger_sikap_k13_sos($data)
    {
       $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $tk             = $data['tk'];
        $kd_mp          = $data['kd_mp'];

        $sqlRjkn        = array();
        $sqlRjknUts     = array();
        $sqlSelect      = '';

        $KdArr          = array('KD1','KD2', 'KD3', 'KD4', 'KD5', 'KD6', 'KD7', 'KD8', 'KD9', 'KD10', 'KD11', 'KD12');
        $rjknKd         = array('SOS');

        $sql            = '';

        for ($v=0; $v < count($KdArr) ; $v++) {
          for ($a=0; $a < count($rjknKd); $a++)
          {
            array_push($sqlRjkn,
            " LEFT OUTER JOIN (
                select nis, max(afk) $rjknKd[$a] FROM (
                SELECT nis, afk FROM tgh_siswa ts
                WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
                AND ts.kd_kd = '$KdArr[$v]'
                AND ts.kd_sekolah= '$kd_sekolah'
                AND ts.th_ajar = '$th_ajar'
                AND ts.p_nl = '$p_nl'
                AND ts.sub_pnl = 'UAS'
                AND ts.kelas = '$kelas'
                AND ts.kd_mp = '$kd_mp'
                ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a] ON ks.nis = $KdArr[$v]_$rjknKd[$a].nis  "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select nis, max(afk) $rjknKd[$a] FROM (
            SELECT nis, afk FROM tgh_siswa ts
            WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
            AND ts.kd_kd = '".$KdArr[$v]."'
            AND ts.kd_sekolah= '$kd_sekolah'
            AND ts.th_ajar = '$th_ajar'
            AND ts.p_nl = '$p_nl'
            AND ts.sub_pnl = 'UTS'
            AND ts.kelas = '$kelas'
            AND ts.kd_mp = '$kd_mp'
            ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a]_UTS
                    ON ks.nis = $KdArr[$v]_$rjknKd[$a]_UTS.nis "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select tk, ket_kd SOS FROM (
            SELECT tk, ket_kd FROM ms_mp_kd_dtl kd
            WHERE kd.kd_ki = 'ki2'
            AND kd.kd_kd = '".$KdArr[$v]."'
            AND kd.kd_sekolah= '$kd_sekolah'
            AND kd.th_ajar = '$th_ajar'
            AND kd.kd_semester = '$p_nl'
            AND kd.tk = '$tk'
            AND kd.kd_mp = '$kd_mp'
            ) tr ) $KdArr[$v]_$rjknKd[$a]_DES ON kls.tingkat = $KdArr[$v]_$rjknKd[$a]_DES.tk "
            );
          }
        }

        $sql_tbl = "";
        if ($sub_pnl == 'UAS') {
          //====================================Start UAS======================================//====//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c]);
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_des');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_DES.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        else
        {
          //====================================Start UAS============================================//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_des');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_DES.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        $sql            .= " SELECT ks.nis, ms.nama_lengkap, ms.nama_panggilan, COALESCE(uas.afk, 0) UAS
                            ".$sqlSelect."
                            FROM kelas_siswa ks
                            INNER JOIN ms_siswa ms
                            ON ks.nis = ms.nis
                            INNER JOIN ms_kelas kls
                            ON ks.kelas = kls.kelas ";

        foreach ($sqlRjkn as $value) {
          $sql .= $value;
        }

        $sql .= " left outer  join
                  (
                    select * from tgh_siswa ts
                    where kd_tagihan = 'UAS'
                    and ts.kd_kd     = ''
                    and ts.kd_sekolah= '$kd_sekolah'
                    and ts.th_ajar   = '$th_ajar'
                    and ts.p_nl      =  '$p_nl'
                    and ts.sub_pnl   = '$sub_pnl'
                    and ts.kelas     = '$kelas'
                    and ts.kd_mp     = '$kd_mp'
                  )uas
                  on ks.nis = uas.nis

                  WHERE ks.kd_sekolah = '$kd_sekolah'
                  AND ks.th_ajar = '$th_ajar'
                  AND ks.kelas = '$kelas'
                  ORDER BY nama_lengkap ";
        //echo $sql; die();
        $hasil        = $this->db->query($sql)->result();
        return $hasil;
        
    }

    function nilai_rapor_sikap_k13_spr($data)
    {
       $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $tk             = $data['tk'];
        $kd_mp          = 'PAI';
        $nis            = $data['pilihnis'];
        $sqlRjkn        = array();
        $sqlRjknUts     = array();
        $sqlSelect      = '';
        $KdArr          = array('KD1','KD2', 'KD3', 'KD4', 'KD5', 'KD6', 'KD7', 'KD8', 'KD9', 'KD10', 'KD11', 'KD12');
        $rjknKd         = array('SPR');
        $sql            = '';
        for ($v=0; $v < count($KdArr) ; $v++) {
          for ($a=0; $a < count($rjknKd); $a++)
          {
            array_push($sqlRjkn,
            " LEFT OUTER JOIN (
                select nis, max(afk) $rjknKd[$a] FROM (
                SELECT nis, afk FROM tgh_siswa ts
                WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
                AND ts.kd_kd = '$KdArr[$v]'
                AND ts.kd_sekolah= '$kd_sekolah'
                AND ts.th_ajar = '$th_ajar'
                AND ts.p_nl = '$p_nl'
                AND ts.sub_pnl = 'UAS'
                AND ts.kelas = '$kelas'
                AND ts.kd_mp = '$kd_mp'
                AND ts.nis = '$nis'
                ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a] ON ks.nis = $KdArr[$v]_$rjknKd[$a].nis  "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select nis, max(afk) $rjknKd[$a] FROM (
            SELECT nis, afk FROM tgh_siswa ts
            WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
            AND ts.kd_kd = '".$KdArr[$v]."'
            AND ts.kd_sekolah= '$kd_sekolah'
            AND ts.th_ajar = '$th_ajar'
            AND ts.p_nl = '$p_nl'
            AND ts.sub_pnl = 'UTS'
            AND ts.kelas = '$kelas'
            AND ts.kd_mp = '$kd_mp'
            AND ts.nis = '$nis'
            ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a]_UTS
                    ON ks.nis = $KdArr[$v]_$rjknKd[$a]_UTS.nis "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select tk, ket_kd SPR FROM (
            SELECT tk, ket_kd FROM ms_mp_kd_dtl kd
            WHERE kd.kd_ki = 'ki1'
            AND kd.kd_kd = '".$KdArr[$v]."'
            AND kd.kd_sekolah= '$kd_sekolah'
            AND kd.th_ajar = '$th_ajar'
            AND kd.kd_semester = '$p_nl'
            AND kd.tk = '$tk'
            AND kd.kd_mp = '$kd_mp'
            ) tr ) $KdArr[$v]_$rjknKd[$a]_DES ON kls.tingkat = $KdArr[$v]_$rjknKd[$a]_DES.tk "
            );
          }
        }

        $sql_tbl = "";
        if ($sub_pnl == 'UAS') {
          //====================================Start UAS======================================//====//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c]);
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_des');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_DES.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        else
        {
          //====================================Start UAS============================================//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_des');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_DES.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        $sql            .= " SELECT ms.nama_panggilan
                            ".$sqlSelect."
                            FROM kelas_siswa ks
                            INNER JOIN ms_siswa ms
                            ON ks.nis = ms.nis
                            INNER JOIN ms_kelas kls
                            ON ks.kelas = kls.kelas ";

        foreach ($sqlRjkn as $value) {
          $sql .= $value;
        }

        $sql .= " WHERE ks.kd_sekolah = '$kd_sekolah'
                  AND ks.th_ajar = '$th_ajar'
                  AND ks.kelas = '$kelas'
                  AND ms.nis = '$nis'
                  ORDER BY nama_lengkap ";
        //echo $sql; die();
        $hasil        = $this->db->query($sql)->result();
        return $hasil;
        
    }

    function nilai_rapor_sikap_k13_sos($data)
    {
       $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $tk             = $data['tk'];
        $kd_mp          = 'PKN';
        $nis            = $data['pilihnis'];

        $sqlRjkn        = array();
        $sqlRjknUts     = array();
        $sqlSelect      = '';

        $KdArr          = array('KD1','KD2', 'KD3', 'KD4', 'KD5', 'KD6', 'KD7', 'KD8', 'KD9', 'KD10', 'KD11', 'KD12');
        $rjknKd         = array('SOS');

        $sql            = '';

        for ($v=0; $v < count($KdArr) ; $v++) {
          for ($a=0; $a < count($rjknKd); $a++)
          {
            array_push($sqlRjkn,
            " LEFT OUTER JOIN (
                select nis, max(afk) $rjknKd[$a] FROM (
                SELECT nis, afk FROM tgh_siswa ts
                WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
                AND ts.kd_kd = '$KdArr[$v]'
                AND ts.kd_sekolah= '$kd_sekolah'
                AND ts.th_ajar = '$th_ajar'
                AND ts.p_nl = '$p_nl'
                AND ts.sub_pnl = 'UAS'
                AND ts.kelas = '$kelas'
                AND ts.kd_mp = '$kd_mp'
                AND ts.nis = '$nis'
                ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a] ON ks.nis = $KdArr[$v]_$rjknKd[$a].nis  "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select nis, max(afk) $rjknKd[$a] FROM (
            SELECT nis, afk FROM tgh_siswa ts
            WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
            AND ts.kd_kd = '".$KdArr[$v]."'
            AND ts.kd_sekolah= '$kd_sekolah'
            AND ts.th_ajar = '$th_ajar'
            AND ts.p_nl = '$p_nl'
            AND ts.sub_pnl = 'UTS'
            AND ts.kelas = '$kelas'
            AND ts.kd_mp = '$kd_mp'
            AND ts.nis = '$nis'
            ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a]_UTS
                    ON ks.nis = $KdArr[$v]_$rjknKd[$a]_UTS.nis "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select tk, ket_kd SOS FROM (
            SELECT tk, ket_kd FROM ms_mp_kd_dtl kd
            WHERE kd.kd_ki = 'ki2'
            AND kd.kd_kd = '".$KdArr[$v]."'
            AND kd.kd_sekolah= '$kd_sekolah'
            AND kd.th_ajar = '$th_ajar'
            AND kd.kd_semester = '$p_nl'
            AND kd.tk = '$tk'
            AND kd.kd_mp = '$kd_mp'
            ) tr ) $KdArr[$v]_$rjknKd[$a]_DES ON kls.tingkat = $KdArr[$v]_$rjknKd[$a]_DES.tk "
            );
          }
        }

        $sql_tbl = "";
        if ($sub_pnl == 'UAS') {
          //====================================Start UAS======================================//====//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c]);
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_des');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_DES.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        else
        {
          //====================================Start UAS============================================//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_des');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_DES.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        $sql            .= " SELECT ms.nama_panggilan
                            ".$sqlSelect."
                            FROM kelas_siswa ks
                            INNER JOIN ms_siswa ms
                            ON ks.nis = ms.nis
                            INNER JOIN ms_kelas kls
                            ON ks.kelas = kls.kelas ";

        foreach ($sqlRjkn as $value) {
          $sql .= $value;
        }

        $sql .= " WHERE ks.kd_sekolah = '$kd_sekolah'
                  AND ks.th_ajar = '$th_ajar'
                  AND ks.kelas = '$kelas'
                  AND ms.nis = '$nis'
                  ORDER BY nama_lengkap ";
        //echo $sql; die();
        $hasil        = $this->db->query($sql)->result();
        return $hasil;
        
    }

    function nilai_rapor_kgn_k13_2($kelas)
    {
       $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        //$kelas          = $data['pilihkelas'];
        // $kd_mp          = $data['kd_mp'];
        // $nis            = $data['pilihnis'];
        

        $sql            = " SELECT nis, kd_tagihan, kd_kd, kd_mp, AVG(CAST(kgn AS DECIMAL(12,2))) AS kgn  
                            FROM tgh_siswa ts 
                            WHERE ts.kd_sekolah = '$kd_sekolah' 
                            AND ts.th_ajar = '$th_ajar' 
                            AND ts.p_nl = '$p_nl' 
                            -- AND ts.sub_pnl = '$sub_pnl'     
                            AND ts.kelas = '$kelas'
                            -- AND ts.nis = '1415100476'
                            -- AND ts.kd_mp = 'IPS'
                            GROUP BY nis, kd_kd, kd_tagihan, kd_mp 
                        ";
        // echo $sql; die();
        $hasil        = $this->db->query($sql)->result_array();
        return $hasil;
    }

    function nilai_rapor_kgn_pts_k13_2($kelas)
    {
       $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        //$kelas          = $data['pilihkelas'];
        // $kd_mp          = $data['kd_mp'];
        // $nis            = $data['pilihnis'];
        

        $sql            = " SELECT nis, kd_tagihan, kd_kd, kd_mp, kgn  
                            FROM tgh_siswa ts 
                            WHERE ts.kd_sekolah = '$kd_sekolah' 
                            AND ts.th_ajar = '$th_ajar' 
                            AND ts.p_nl = '$p_nl' 
                            AND ts.sub_pnl = 'UTS'     
                            AND ts.kelas = '$kelas'
                            AND ts.kd_tagihan = 'PAS'
                            -- AND ts.nis = '1415100476'
                            -- AND ts.kd_mp = 'IPS' 
                        ";
        // echo $sql; die();
        $hasil        = $this->db->query($sql)->result_array();
        return $hasil;
    }

    function nilai_rapor_kgn_pas_k13_2($kelas)
    {
       $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        //$kelas          = $data['pilihkelas'];
        // $kd_mp          = $data['kd_mp'];
        // $nis            = $data['pilihnis'];
        

        $sql            = " SELECT nis, kd_tagihan, kd_kd, kd_mp, kgn  
                            FROM tgh_siswa ts 
                            WHERE ts.kd_sekolah = '$kd_sekolah' 
                            AND ts.th_ajar = '$th_ajar' 
                            AND ts.p_nl = '$p_nl' 
                            AND ts.sub_pnl = 'UAS'     
                            AND ts.kelas = '$kelas'
                            AND ts.kd_tagihan = 'PAS'
                            -- AND ts.nis = '1415100476'
                            -- AND ts.kd_mp = 'IPS'
                        ";
        // echo $sql; die();
        $hasil        = $this->db->query($sql)->result_array();
        return $hasil;
    }

    function nilai_rapor_psk_pts_k13_2($kelas)
    {
       $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        //$kelas          = $data['pilihkelas'];
        // $kd_mp          = $data['kd_mp'];
        // $nis            = $data['pilihnis'];
        

        $sql            = " SELECT nis, kd_tagihan, kd_kd, kd_mp, AVG(CAST(psk AS DECIMAL(12,2))) AS psk  
                            FROM tgh_siswa ts 
                            WHERE ts.kd_sekolah = '$kd_sekolah' 
                            AND ts.th_ajar = '$th_ajar' 
                            AND ts.p_nl = '$p_nl' 
                            -- AND ts.sub_pnl = '$sub_pnl'     
                            AND ts.kelas = '$kelas'
                            -- AND ts.nis = '1415100476'
                            -- AND ts.kd_mp = 'IPS'
                            GROUP BY nis, kd_kd, kd_tagihan, kd_mp 
                        ";
        // echo $sql; die();
        $hasil        = $this->db->query($sql)->result_array();
        return $hasil;
    }

    function nilai_rapor_psk_k13_2($kelas)
    {
       $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        //$kelas          = $data['pilihkelas'];
        // $kd_mp          = $data['kd_mp'];
        // $nis            = $data['pilihnis'];
        

        $sql            = " SELECT nis, kd_tagihan, kd_kd, kd_mp, AVG(CAST(psk AS DECIMAL(12,2))) AS psk  
                            FROM tgh_siswa ts 
                            WHERE ts.kd_sekolah = '$kd_sekolah' 
                            AND ts.th_ajar = '$th_ajar' 
                            AND ts.p_nl = '$p_nl' 
                            -- AND ts.sub_pnl = '$sub_pnl'     
                            AND ts.kelas = '$kelas'
                            -- AND ts.nis = '1415100476'
                            -- AND ts.kd_mp = 'IPS'
                            GROUP BY nis, kd_kd, kd_tagihan, kd_mp 
                        ";
        // echo $sql; die();
        $hasil        = $this->db->query($sql)->result_array();
        return $hasil;
    }

    function nilai_rapor_kgn_k13($kelas,$kd_mp,$nis)
    {
       $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        // $kelas          = $data['pilihkelas'];
        // $kd_mp          = $data['kd_mp'];
        // $nis            = $data['pilihnis'];
        $sqlRjkn        = array();
        $sqlRjknUts     = array();
        $sqlSelect      = '';

        $KdArr          = array('KD1','KD2', 'KD3', 'KD4', 'KD5', 'KD6', 'KD7', 'KD8', 'KD9', 'KD10', 'KD11', 'KD12');
        $rjknKd         = array('NH1','NH2','NH3','NH4','NH5','NH6','PAS');

        $sql            = '';

        for ($v=0; $v < count($KdArr) ; $v++) {
          for ($a=0; $a < count($rjknKd); $a++)
          {
            array_push($sqlRjkn,
            " LEFT OUTER JOIN (
                select nis, max(kgn) $rjknKd[$a] FROM (
                SELECT nis, kgn FROM tgh_siswa ts
                WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
                AND ts.kd_kd = '$KdArr[$v]'
                AND ts.kd_sekolah= '$kd_sekolah'
                AND ts.th_ajar = '$th_ajar'
                AND ts.p_nl = '$p_nl'
                AND ts.sub_pnl = 'UAS'
                AND ts.kelas = '$kelas'
                AND ts.kd_mp = '$kd_mp'
                AND ts.nis = '$nis'
                ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a] ON ks.nis = $KdArr[$v]_$rjknKd[$a].nis  "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select nis, max(kgn) $rjknKd[$a] FROM (
            SELECT nis, kgn FROM tgh_siswa ts
            WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
            AND ts.kd_kd = '".$KdArr[$v]."'
            AND ts.kd_sekolah= '$kd_sekolah'
            AND ts.th_ajar = '$th_ajar'
            AND ts.p_nl = '$p_nl'
            AND ts.sub_pnl = 'UTS'
            AND ts.kelas = '$kelas'
            AND ts.kd_mp = '$kd_mp'
            AND ts.nis = '$nis'
            ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a]_UTS
                    ON ks.nis = $KdArr[$v]_$rjknKd[$a]_UTS.nis "
          );
          }
        }

        $sql_tbl = "";
        if ($sub_pnl == 'UAS') {
          //====================================Start UAS======================================//====//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c]);
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        else
        {
          //====================================Start UAS============================================//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        $sql            .= " SELECT ms.nama_panggilan
                            ".$sqlSelect."
                            FROM kelas_siswa ks
                            INNER JOIN ms_siswa ms
                            ON ks.nis = ms.nis ";

        foreach ($sqlRjkn as $value) {
          $sql .= $value;
        }

        $sql .="  WHERE ks.kd_sekolah = '$kd_sekolah'
                  AND ks.th_ajar = '$th_ajar'
                  AND ks.kelas = '$kelas'
                  AND ks.nis = '$nis'
                  ORDER BY nama_lengkap ";
        //echo $sql; die();
        $hasil        = $this->db->query($sql)->result();
        return $hasil;
        
    }

    function nilai_rekap_kgn_k13($data)
    {
       $CI              = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];
        $nis            = $data['pilihnis'];
        $sqlRjkn        = array();
        $sqlRjknUts     = array();
        $sqlSelect      = '';

        $KdArr          = array('KD1','KD2', 'KD3', 'KD4', 'KD5', 'KD6', 'KD7', 'KD8', 'KD9', 'KD10', 'KD11', 'KD12');
        $rjknKd         = array('NH1','NH2','NH3','NH4','NH5','NH6','PAS');

        $sql            = '';

        for ($v=0; $v < count($KdArr) ; $v++) {
          for ($a=0; $a < count($rjknKd); $a++)
          {
            array_push($sqlRjkn,
            " LEFT OUTER JOIN (
                select nis, max(kgn) $rjknKd[$a] FROM (
                SELECT nis, kgn FROM tgh_siswa ts
                WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
                AND ts.kd_kd = '$KdArr[$v]'
                AND ts.kd_sekolah= '$kd_sekolah'
                AND ts.th_ajar = '$th_ajar'
                AND ts.p_nl = '$p_nl'
                AND ts.sub_pnl = 'UAS'
                AND ts.kelas = '$kelas'
                AND ts.kd_mp = '$kd_mp'
                ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a] ON ks.nis = $KdArr[$v]_$rjknKd[$a].nis  "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select nis, max(kgn) $rjknKd[$a] FROM (
            SELECT nis, kgn FROM tgh_siswa ts
            WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
            AND ts.kd_kd = '".$KdArr[$v]."'
            AND ts.kd_sekolah= '$kd_sekolah'
            AND ts.th_ajar = '$th_ajar'
            AND ts.p_nl = '$p_nl'
            AND ts.sub_pnl = 'UTS'
            AND ts.kelas = '$kelas'
            AND ts.kd_mp = '$kd_mp'
            ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a]_UTS
                    ON ks.nis = $KdArr[$v]_$rjknKd[$a]_UTS.nis "
          );
          }
        }

        $sql_tbl = "";
        if ($sub_pnl == 'UAS') {
          //====================================Start UAS======================================//====//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c]);
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        else
        {
          //====================================Start UAS============================================//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        $sql            .= " SELECT ms.nama_panggilan
                            ".$sqlSelect."
                            FROM kelas_siswa ks
                            INNER JOIN ms_siswa ms
                            ON ks.nis = ms.nis ";

        foreach ($sqlRjkn as $value) {
          $sql .= $value;
        }

        $sql .="  WHERE ks.kd_sekolah = '$kd_sekolah'
                  AND ks.th_ajar = '$th_ajar'
                  AND ks.kelas = '$kelas'
                  ORDER BY nama_lengkap ";
        //echo $sql; die();
        $hasil        = $this->db->query($sql)->result();
        return $hasil;
        
    }

    function nilai_rapor_psk_k13($kelas,$kd_mp,$nis)
    {
       $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        // $kelas          = $data['pilihkelas'];
        // $kd_mp          = $data['kd_mp'];
        // $nis            = $data['pilihnis'];
        $sqlRjkn        = array();
        $sqlRjknUts     = array();
        $sqlSelect      = '';

        $KdArr          = array('KD1','KD2', 'KD3', 'KD4', 'KD5', 'KD6', 'KD7', 'KD8', 'KD9', 'KD10', 'KD11', 'KD12');
        $rjknKd         = array('KIN1','KIN2','PRJ1','PRJ2','POR1','POR2','PAS');

        $sql            = '';

        for ($v=0; $v < count($KdArr) ; $v++) {
          for ($a=0; $a < count($rjknKd); $a++)
          {
            array_push($sqlRjkn,
            " LEFT OUTER JOIN (
                select nis, max(psk) $rjknKd[$a] FROM (
                SELECT nis, psk FROM tgh_siswa ts
                WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
                AND ts.kd_kd = '$KdArr[$v]'
                AND ts.kd_sekolah= '$kd_sekolah'
                AND ts.th_ajar = '$th_ajar'
                AND ts.p_nl = '$p_nl'
                AND ts.sub_pnl = 'UAS'
                AND ts.kelas = '$kelas'
                AND ts.kd_mp = '$kd_mp'
                AND ts.nis = '$nis'
                ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a] ON ks.nis = $KdArr[$v]_$rjknKd[$a].nis  "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select nis, max(psk) $rjknKd[$a] FROM (
            SELECT nis, psk FROM tgh_siswa ts
            WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
            AND ts.kd_kd = '".$KdArr[$v]."'
            AND ts.kd_sekolah= '$kd_sekolah'
            AND ts.th_ajar = '$th_ajar'
            AND ts.p_nl = '$p_nl'
            AND ts.sub_pnl = 'UTS'
            AND ts.kelas = '$kelas'
            AND ts.kd_mp = '$kd_mp'
            AND ts.nis = '$nis'
            ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a]_UTS
                    ON ks.nis = $KdArr[$v]_$rjknKd[$a]_UTS.nis "
          );
          }
        }

        $sql_tbl = "";
        if ($sub_pnl == 'UAS') {
          //====================================Start UAS======================================//====//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c]);
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        else
        {
          //====================================Start UAS============================================//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        $sql            .= " SELECT ms.nama_panggilan
                            ".$sqlSelect."
                            FROM kelas_siswa ks
                            INNER JOIN ms_siswa ms
                            ON ks.nis = ms.nis ";

        foreach ($sqlRjkn as $value) {
          $sql .= $value;
        }

        $sql .= " WHERE ks.kd_sekolah = '$kd_sekolah'
                  AND ks.th_ajar = '$th_ajar'
                  AND ks.kelas = '$kelas'
                  AND ks.nis = '$nis'
                  ORDER BY nama_lengkap ";
        //echo $sql; die();
        $hasil        = $this->db->query($sql)->result();
        return $hasil;
        
    }

    function nilai_rekap_psk_k13($data)
    {
       $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];
        $nis            = $data['pilihnis'];
        $sqlRjkn        = array();
        $sqlRjknUts     = array();
        $sqlSelect      = '';

        $KdArr          = array('KD1','KD2', 'KD3', 'KD4', 'KD5', 'KD6', 'KD7', 'KD8', 'KD9', 'KD10', 'KD11', 'KD12');
        $rjknKd         = array('KIN1','KIN2','PRJ1','PRJ2','POR1','POR2','PAS');

        $sql            = '';

        for ($v=0; $v < count($KdArr) ; $v++) {
          for ($a=0; $a < count($rjknKd); $a++)
          {
            array_push($sqlRjkn,
            " LEFT OUTER JOIN (
                select nis, max(psk) $rjknKd[$a] FROM (
                SELECT nis, psk FROM tgh_siswa ts
                WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
                AND ts.kd_kd = '$KdArr[$v]'
                AND ts.kd_sekolah= '$kd_sekolah'
                AND ts.th_ajar = '$th_ajar'
                AND ts.p_nl = '$p_nl'
                AND ts.sub_pnl = 'UAS'
                AND ts.kelas = '$kelas'
                AND ts.kd_mp = '$kd_mp'
                AND ts.nis = '$nis'
                ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a] ON ks.nis = $KdArr[$v]_$rjknKd[$a].nis  "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select nis, max(psk) $rjknKd[$a] FROM (
            SELECT nis, psk FROM tgh_siswa ts
            WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
            AND ts.kd_kd = '".$KdArr[$v]."'
            AND ts.kd_sekolah= '$kd_sekolah'
            AND ts.th_ajar = '$th_ajar'
            AND ts.p_nl = '$p_nl'
            AND ts.sub_pnl = 'UTS'
            AND ts.kelas = '$kelas'
            AND ts.kd_mp = '$kd_mp'
            AND ts.nis = '$nis'
            ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a]_UTS
                    ON ks.nis = $KdArr[$v]_$rjknKd[$a]_UTS.nis "
          );
          }
        }

        $sql_tbl = "";
        if ($sub_pnl == 'UAS') {
          //====================================Start UAS======================================//====//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c]);
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        else
        {
          //====================================Start UAS============================================//
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
            }
          }
          //====================================END UAS======================================//====//
        }
        $sql            .= " SELECT ms.nama_panggilan
                            ".$sqlSelect."
                            FROM kelas_siswa ks
                            INNER JOIN ms_siswa ms
                            ON ks.nis = ms.nis ";

        foreach ($sqlRjkn as $value) {
          $sql .= $value;
        }

        $sql .= " WHERE ks.kd_sekolah = '$kd_sekolah'
                  AND ks.th_ajar = '$th_ajar'
                  AND ks.kelas = '$kelas'
                  AND ks.nis = '$nis'
                  ORDER BY nama_lengkap ";
        //echo $sql; die();
        $hasil        = $this->db->query($sql)->result();
        return $hasil;
        
    }

    function nilai($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];
        $sql        = " select ks.nis, ms.nama_lengkap,
                            coalesce(tgs1.kgn,0) TGS1, coalesce(tgs2.kgn,0) TGS2, coalesce(tgs3.kgn,0) TGS3,
                            coalesce(tgs1_uts.kgn,0) TGS1_UTS, coalesce(tgs2_uts.kgn,0) TGS2_UTS, coalesce(tgs3_uts.kgn,0) TGS3_UTS,
                            coalesce(uht1_uts.kgn,' ') UHT1_UTS,
                            coalesce(uht2_uts.kgn,' ') UHT2_UTS,
                            coalesce(uht3_uts.kgn,' ') UHT3_UTS,
                            coalesce(uht1.kgn,' ') UHT1,
                            coalesce(uht2.kgn,' ') UHT2,
                            coalesce(uht3.kgn,' ') UHT3,
                            coalesce(uts.kgn,0) UTS, coalesce(uas.kgn,0) UAS,
                            coalesce(port1.kgn, ' ') Port1,
                            coalesce(port2.kgn, ' ') Port2,
                            coalesce(port1_uts.kgn, ' ') Port1_uts,
                            coalesce(port2_uts.kgn, ' ') Port2_uts,
                            COALESCE(lisan1.kgn, ' ') Lisan1,
                            COALESCE(lisan2.kgn, ' ') Lisan2,
                            COALESCE(lisan1_uts.kgn, ' ') Lisan1_uts,
                            COALESCE(lisan2_uts.kgn, ' ') Lisan2_uts

                        from kelas_siswa ks
                        inner join ms_siswa ms
                        on ks.nis = ms.nis
                        left outer join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uht1
                        	on ks.nis = uht1.nis
                          LEFT OUTER JOIN
							              (
                    					SELECT * FROM tgh_siswa ts
                    					WHERE kd_tagihan = 'POR1'
                    					AND ts.kd_sekolah = '$kd_sekolah'
                    					AND ts.th_ajar = '$th_ajar'
                    					AND ts.p_nl = '$p_nl'
                    					AND ts.sub_pnl = 'UAS'
                    					AND ts.kelas = '$kelas'
                    					AND ts.kd_mp = '$kd_mp'
                  				  )port1
                  				ON ks.nis = port1.nis
                          LEFT OUTER JOIN
                    				(
                    					SELECT * FROM tgh_siswa ts
                    					WHERE kd_tagihan = 'POR2'
                    					AND ts.kd_sekolah = '$kd_sekolah'
                    					AND ts.th_ajar = '$th_ajar'
                    					AND ts.p_nl = '$p_nl'
                    					AND ts.sub_pnl = 'UAS'
                    					AND ts.kelas = '$kelas'
                    					AND ts.kd_mp = '$kd_mp'
                    					)port2
                    					ON ks.nis = port2.nis
                          LEFT OUTER JOIN
        							        (
                            		SELECT * FROM tgh_siswa ts
                            		WHERE kd_tagihan = 'POR1'
                            		AND ts.kd_sekolah = '$kd_sekolah'
                            		AND ts.th_ajar = '$th_ajar'
                            		AND ts.p_nl = '$p_nl'
                            		AND ts.sub_pnl = 'UTS'
                            		AND ts.kelas = '$kelas'
                            		AND ts.kd_mp = '$kd_mp'
                          	  )port1_uts
                          		ON ks.nis = port1_uts.nis
                          LEFT OUTER JOIN
                          	(
                          		SELECT * FROM tgh_siswa ts
                          		WHERE kd_tagihan = 'POR2'
                          		AND ts.kd_sekolah = '$kd_sekolah'
                          		AND ts.th_ajar = '$th_ajar'
                          		AND ts.p_nl = '$p_nl'
                          		AND ts.sub_pnl = 'UTS'
                          		AND ts.kelas = '$kelas'
                          		AND ts.kd_mp = '$kd_mp'
                          	)port2_uts
                          	ON ks.nis = port2_uts.nis
                          LEFT OUTER JOIN
                    				(
                    					SELECT * FROM tgh_siswa ts
                    					WHERE kd_tagihan = 'PMT1'
                    					AND ts.kd_sekolah = '$kd_sekolah'
                    					AND ts.th_ajar = '$th_ajar'
                    					AND ts.p_nl = '$p_nl'
                    					AND ts.sub_pnl = 'UAS'
                    					AND ts.kelas = '$kelas'
                    					AND ts.kd_mp = '$kd_mp'
                    				)lisan1
                    				ON ks.nis = lisan1.nis
                          LEFT OUTER JOIN
                        		(
                        			SELECT * FROM tgh_siswa ts
                        			WHERE kd_tagihan = 'PMT2'
                        			AND ts.kd_sekolah = '$kd_sekolah'
                        			AND ts.th_ajar = '$th_ajar'
                        			AND ts.p_nl = '$p_nl'
                        			AND ts.sub_pnl = 'UAS'
                        			AND ts.kelas = '$kelas'
                        			AND ts.kd_mp = '$kd_mp'
                        		)lisan2
                        		ON ks.nis = lisan2.nis
                          LEFT OUTER JOIN
                            (
                              SELECT * FROM tgh_siswa ts
                              WHERE kd_tagihan = 'PMT1'
                              AND ts.kd_sekolah = '$kd_sekolah'
                              AND ts.th_ajar = '$th_ajar'
                              AND ts.p_nl = '$p_nl'
                              AND ts.sub_pnl = 'UTS'
                              AND ts.kelas = '$kelas'
                              AND ts.kd_mp = '$kd_mp'
                            )lisan1_uts
                            ON ks.nis = lisan1_uts.nis
                          LEFT OUTER JOIN
                            (
                              SELECT * FROM tgh_siswa ts
                              WHERE kd_tagihan = 'PMT2'
                              AND ts.kd_sekolah = '$kd_sekolah'
                              AND ts.th_ajar = '$th_ajar'
                              AND ts.p_nl = '$p_nl'
                              AND ts.sub_pnl = 'UtS'
                              AND ts.kelas = '$kelas'
                              AND ts.kd_mp = '$kd_mp'
                            )lisan2_uts
                            ON ks.nis = lisan2_uts.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uht2
                        	on ks.nis = uht2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uht3
                        	on ks.nis = uht3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'REM1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)REM1
                        	on ks.nis = REM1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'REM2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)REM2
                        	on ks.nis = REM2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'REM3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)REM3
                        	on ks.nis = REM3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)tgs1
                        	on ks.nis = tgs1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)tgs2
                        	on ks.nis = tgs2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)tgs3
                        	on ks.nis = tgs3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UTS'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uts
                        	on ks.nis = uts.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UAS'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uas
                        	on ks.nis = uas.nis

                        left outer  join
                        	(
                        		select comment,ts.nis from nl_comment_pengetahuan ts
                        		where  ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)cm
                        	on ks.nis = cm.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uht1_uts
                        	on ks.nis = uht1_uts.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uht2_uts
                       	on ks.nis = uht2_uts.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uht3_uts
                        	on ks.nis = uht3_uts.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                            and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                            and ts.kd_mp     = '$kd_mp'
                        	)tgs1_uts
                        	on ks.nis = tgs1_uts.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)tgs2_uts
                        	on ks.nis = tgs2_uts.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)tgs3_uts
                        	on ks.nis = tgs3_uts.nis
                        where ks.kd_sekolah     ='$kd_sekolah'
                        and ks.th_ajar          ='$th_ajar'
                        and ks.kelas            ='$kelas'
						ORDER BY nama_lengkap ";
        $hasil        = $this->db->query($sql);
        return $hasil;
    }

	function nl_ips($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];
        $sql        = " select ks.nis, ms.nama_lengkap,
                            coalesce(kgn,0)KGN , 
                            coalesce(psk,0)PSK
                        from kelas_siswa ks
                        inner join ms_siswa ms
                        on ks.nis = ms.nis
                        LEFT OUTER JOIN
					              (
            					SELECT * FROM nl_ips ips
            					WHERE ips.kd_sekolah = '$kd_sekolah'
            					AND ips.th_ajar = '$th_ajar'
            					AND ips.p_nl = '$p_nl'
            					AND ips.sub_pnl = 'UAS'
            					AND ips.kelas = '$kelas'
            					AND ips.kd_mp = '$kd_mp'
          				  )ips
          				ON ks.nis = ips.nis
                        where ks.kd_sekolah     ='$kd_sekolah'
                        and ks.th_ajar          ='$th_ajar'
                        and ks.kelas            ='$kelas'
						ORDER BY nama_lengkap ";
        //echo $sql; die();
        $hasil        = $this->db->query($sql);
        return $hasil;
    }
	
    function getKompetensiDasar($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];
        $kd_tagihan     = $data['kd_tagihan'];

        $sql = "select distinct kd_kd
                from tgh_siswa ts
                where kd_tagihan     = '$kd_tagihan'
            		and ts.kd_sekolah= '$kd_sekolah'
            		and ts.th_ajar   = '$th_ajar'
            		and ts.p_nl      =  $p_nl
                    and ts.sub_pnl   = '$sub_pnl'
            		and ts.kelas	 = '$kelas'
                    and ts.kd_mp     = '$kd_mp'";

        return $this->db->query($sql);
    }

    function getKompetensiDasarLengkap($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];
        $kd_tagihan     = $data['kd_tagihan'];

        $sql = "select *
                from
                (
                select distinct kd_kd
                from tgh_siswa ts
                where kd_tagihan     = '$kd_tagihan'
            		and ts.kd_sekolah= '$kd_sekolah'
            		and ts.th_ajar   = '$th_ajar'
            		and ts.p_nl      =  $p_nl
                    and ts.sub_pnl   = '$sub_pnl'
            		and ts.kelas	 = '$kelas'
                    and ts.kd_mp     = '$kd_mp'";

        return $this->db->query($sql);
    }

    function nilai_sd($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];
        $kol_sum        = $data['tgh_select_sum'];
        $kol            = $data['tgh_select'];
        $sql_tema        = array();

        $tgh            = array("TEMA1_1","TEMA1_2","TEMA1_3","TEMA1_4",
                                "TEMA2_1","TEMA2_2","TEMA2_3","TEMA2_4",
                                "TEMA3_1","TEMA3_2","TEMA3_3","TEMA3_4",
                                "TEMA4_1","TEMA4_2","TEMA4_3","TEMA4_4");

        for($i=0;$i<count($tgh);$i++)
        {
            $sql_tema[$i]  = "select nis, $kol_sum[$i]
                            from
                            (
                                select nis, $kol[$i]
                                from tgh_siswa ts
                        		where kd_tagihan = '$tgh[$i]'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                            ) tr
                            group by nis ";
        }

        $sql_tbl = "";
        $sql_top = "";
        for($i=0;$i<count($sql_tema);$i++)
        {
            $sql_tbl .= " left outer  join
                        	(
                                $sql_tema[$i]

                        	)$tgh[$i]
                        	on ks.nis = $tgh[$i].nis ";
            if($sql_top!='')$sql_top.=',';
            $sql_top .= $data['tgh_select_top'][$i];
        }




        $sql            = " select ks.nis, ms.nama_lengkap,";
        $sql.=$sql_top;
                            //coalesce(tema11.kgn,0) tema11,
//                            coalesce(tema12.kgn,0) tema12,
//                            coalesce(tema13.kgn,0) tema13,
//                            coalesce(tema14.kgn,0) tema14,
//                            coalesce(tema21.kgn,0) tema21,
//                            coalesce(tema22.kgn,0) tema22,
//                            coalesce(tema23.kgn,0) tema23, coalesce(tema24.kgn,0) tema24,
//                            coalesce(tema31.kgn,0) tema31, coalesce(tema32.kgn,0) tema32, coalesce(tema33.kgn,0) tema33, coalesce(tema34.kgn,0) tema34,
//                            coalesce(tema41.kgn,0) tema41, coalesce(tema42.kgn,0) tema42, coalesce(tema43.kgn,0) tema43, coalesce(tema44.kgn,0) tema44,
        $sql.="                    ,coalesce(uts.kgn,0) UTS, coalesce(uas.kgn,0) UAS,coalesce(uts.psk,0) UTS_PSK, coalesce(uas.psk,0) UAS_PSK, coalesce(cm.comment,'') DESKRIPSI

                        from kelas_siswa ks
                        inner join ms_siswa ms
                        on ks.nis = ms.nis ";
        $sql .= $sql_tbl;
                        //left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA1-1'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema11
//                        	on ks.nis = tema11.nis
//                        left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA1-2'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema12
//                        	on ks.nis = tema12.nis
//                        left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA1-3'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema13
//                        	on ks.nis = tema13.nis
//
//                         left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA1-4'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema14
//                        	on ks.nis = tema14.nis
//
//
//                        left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA2-1'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema21
//                        	on ks.nis = tema21.nis
//                        left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA2-2'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema22
//                        	on ks.nis = tema22.nis
//                        left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA2-3'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema23
//                        	on ks.nis = tema23.nis
//
//                        left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA2-4'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema24
//                        	on ks.nis = tema24.nis
//
//                        left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA3-1'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema31
//                        	on ks.nis = tema31.nis
//                        left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA3-2'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema32
//                        	on ks.nis = tema32.nis
//                        left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA3-3'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema33
//                        	on ks.nis = tema33.nis
//
//                       left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA3-4'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema34
//                        	on ks.nis = tema34.nis
//
//                        left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA4-1'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema41
//                        	on ks.nis = tema41.nis
//                        left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA4-2'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema42
//                        	on ks.nis = tema42.nis
//                        left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA4-3'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema43
//                        	on ks.nis = tema43.nis
//
//                        left outer  join
//                        	(
//                        		select * from tgh_siswa ts
//                        		where kd_tagihan = 'TEMA4-4'
//                        		and ts.kd_sekolah= '$kd_sekolah'
//                        		and ts.th_ajar   = '$th_ajar'
//                        		and ts.p_nl      =  $p_nl
//                                and ts.sub_pnl   = '$sub_pnl'
//                        		and ts.kelas	 = '$kelas'
//                                and ts.kd_mp     = '$kd_mp'
//                        	)tema44
//                        	on ks.nis = tema44.nis

          $sql .="      left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UTS'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uts
                        	on ks.nis = uts.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UAS'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uas
                        	on ks.nis = uas.nis

                        left outer  join
                        	(
                        		select comment,ts.nis from nl_comment_pengetahuan ts
                        		where  ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)cm
                        	on ks.nis = cm.nis

                        where ks.kd_sekolah     ='$kd_sekolah'
                        and ks.th_ajar          ='$th_ajar'
                        and ks.kelas            ='$kelas'
						ORDER BY nama_lengkap ";

        $hasil        = $this->db->query($sql);

        return $hasil;
    }
    function nilai_keterampilan_sma($data)
    {
      $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];

        $sqlRjkn        = array();
        $sqlRjknUts     = array();
        $sqlSelect      = '';

        $KdArr          = array('KD1','KD2', 'KD3', 'KD4', 'KD5', 'KD6', 'KD7', 'KD8', 'KD9', 'KD10', 'KD11', 'KD12');
        $rjknKd         = array('PRK1', 'PRK2', 'KPD1', 'KPD2', 'POR1', 'POR2', 'PRJ1', 'PRJ2');

        $sql            = '';

        for ($v=0; $v < count($KdArr) ; $v++) {
          for ($a=0; $a < count($rjknKd); $a++)
          {
            array_push($sqlRjkn,
            " LEFT OUTER JOIN (
                select nis, max(kgn) $rjknKd[$a] FROM (
                SELECT nis, kgn FROM tgh_siswa ts
                WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
                AND ts.kd_kd = '$KdArr[$v]'
                AND ts.kd_sekolah= '$kd_sekolah'
                AND ts.th_ajar = '$th_ajar'
                AND ts.p_nl = '$p_nl'
                AND ts.sub_pnl = 'UAS'
                AND ts.kelas = '$kelas'
                AND ts.kd_mp = '$kd_mp'
                ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a] ON ks.nis = $KdArr[$v]_$rjknKd[$a].nis  "
            );
            array_push($sqlRjkn,
            "  LEFT OUTER JOIN (
            select nis, max(kgn) $rjknKd[$a] FROM (
            SELECT nis, kgn FROM tgh_siswa ts
            WHERE ts.kd_tagihan = '".$rjknKd[$a]."'
            AND ts.kd_kd = '".$KdArr[$v]."'
            AND ts.kd_sekolah= '$kd_sekolah'
            AND ts.th_ajar = '$th_ajar'
            AND ts.p_nl = '$p_nl'
            AND ts.sub_pnl = 'UTS'
            AND ts.kelas = '$kelas'
            AND ts.kd_mp = '$kd_mp'
            ) tr group by nis
            ) $KdArr[$v]_$rjknKd[$a]_UTS
                    ON ks.nis = $KdArr[$v]_$rjknKd[$a]_UTS.nis "
          );
          }
        }

        $sql_tbl = "";
        //====================================Start UAS======================================//====//
        for($i=0;$i<count($KdArr);$i++)
        {
          for ($c=0; $c < count($rjknKd) ; $c++)
          {
            $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c]);
            $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'.'.$rjknKd[$c].', 0) '.$slc;
          }
        }
        for($i=0;$i<count($KdArr);$i++)
        {
          for ($c=0; $c < count($rjknKd) ; $c++)
          {
            $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
            $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;
          }
        }
        /*if ($sub_pnl == 'UAS') {
            for($i=0;$i<count($KdArr);$i++)
            {
              for ($c=0; $c < count($rjknKd) ; $c++)
              {

                $sql_tbl .= " LEFT OUTER JOIN ( ";

                $sql_tbl .= $sqlRjkn[$c];
                $sql_tbl .= " ) $KdArr[$i]_$rjknKd[$c] ON ks.nis = $KdArr[$i]_$rjknKd[$c].nis ";
              }
            }
            for($i=0;$i<count($KdArr);$i++)
            {
              for ($c=0; $c < count($rjknKd) ; $c++)
              {
                $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
                $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;

                $sql_tbl .= " LEFT OUTER JOIN ( ";
                $sql_tbl .= $sqlRjknUts[$c];
                $sql_tbl .= " ) $KdArr[$i]_$rjknKd[$c]_UTS
                        ON ks.nis = $KdArr[$i]_$rjknKd[$c]_UTS.nis ";
                      }
                    }
        }*/
        //=======================================END UAS ===========================================//
        //=======================================START UTS ===========================================//
        /*else
        {
          for($i=0;$i<count($KdArr);$i++)
          {
            for ($c=0; $c < count($rjknKd) ; $c++)
            {
              $slc = strtolower($KdArr[$i].'_'.$rjknKd[$c].'_uts');
              $sqlSelect .= ', COALESCE('.$KdArr[$i].'_'.$rjknKd[$c].'_UTS.'.$rjknKd[$c].', 0) '.$slc;

              $sql_tbl .= " LEFT OUTER JOIN ( ";

                $sql_tbl .= $sqlRjknUts[$c];
              $sql_tbl .= " ) $KdArr[$i]_$rjknKd[$c]_UTS
                          ON ks.nis = $KdArr[$i]_$rjknKd[$c]_UTS.nis ";
            }
          }
        }*/
        //=======================================END UTS ===========================================//
        $sql            .= " SELECT ks.nis, ms.nama_lengkap
                            ".$sqlSelect."
                            FROM kelas_siswa ks
                            INNER JOIN ms_siswa ms
                            ON ks.nis = ms.nis ";

        foreach ($sqlRjkn as $value) {
          $sql .= $value;
        }

        $sql .= " WHERE ks.kd_sekolah = '$kd_sekolah'
                  AND ks.th_ajar = '$th_ajar'
                  AND ks.kelas = '$kelas'
                  ORDER BY nama_lengkap ";

        $hasil        = $this->db->query($sql)->result();
        return $hasil;

    }
    function nilai_keterampilan($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];
        $sql        = " select ks.nis, ms.nama_lengkap,
                            coalesce(prk1.kgn,0) PRK1, coalesce(prk2.kgn,0) PRK2, coalesce(prk3.kgn,0) PRK3,
                            coalesce(por1.kgn,0) POR1, coalesce(por2.kgn,0) POR2, coalesce(por3.kgn,0) POR3,
                            coalesce(prj1.kgn,0) PRJ1, coalesce(prj2.kgn,0) PRJ2, coalesce(prj3.kgn,0) PRJ3,
                            coalesce(prk1_uts.kgn,0) PRK1_UTS, coalesce(prk2_uts.kgn,0) PRK2_UTS, coalesce(prk3_uts.kgn,0) PRK3_UTS,
                            coalesce(por1_uts.kgn,0) POR1_UTS, coalesce(por2_uts.kgn,0) POR2_UTS, coalesce(por3_uts.kgn,0) POR3_UTS,
                            coalesce(prj1_uts.kgn,0) PRJ1_UTS, coalesce(prj2_uts.kgn,0) PRJ2_UTS, coalesce(prj3_uts.kgn,0) PRJ3_UTS,
                            coalesce(cm.comment,'') DESKRIPSI,
                            COALESCE(KPD1_UAS.kgn, 0) KPD1_UAS, COALESCE(kpd2_UAS.kgn, 0) KPD2_UAS, COALESCE(kpd3_UAS.kgn, 0) KPD3_UAS,
                            COALESCE(KPD1_UTS.kgn, 0) KPD1_UTS, COALESCE(kpd2_UTS.kgn, 0) KPD2_UTS, COALESCE(kpd3_UTS.kgn, 0) KPD3_UTS
                        from kelas_siswa ks
                        inner join ms_siswa ms
                        on ks.nis = ms.nis
                        LEFT OUTER JOIN
                        	(
                        		SELECT * FROM tgh_siswa ts
                        		WHERE kd_tagihan = 'KPD1'
                        		AND ts.kd_sekolah= '$kd_sekolah'
                        		AND ts.th_ajar   = '$th_ajar'
                        		AND ts.p_nl      =  $p_nl
                            AND ts.sub_pnl   = 'UAS'
                        		AND ts.kelas	 = '$kelas'
                            AND ts.kd_mp     = '$kd_mp'
                        	)KPD1_UAS
                        	ON ks.nis = KPD1_UAS.nis
                        LEFT OUTER JOIN
                          (
                          	SELECT * FROM tgh_siswa ts
                          	WHERE kd_tagihan = 'KPD2'
                          	AND ts.kd_sekolah= '$kd_sekolah'
                          	AND ts.th_ajar   = '$th_ajar'
                          	AND ts.p_nl      =  $p_nl
                            AND ts.sub_pnl   = 'UAS'
                          	AND ts.kelas	 = '$kelas'
                            AND ts.kd_mp     = '$kd_mp'
                          )KPD2_UAS
                          ON ks.nis = KPD2_UAS.nis
                          LEFT OUTER JOIN
                            (
                            	SELECT * FROM tgh_siswa ts
                            	WHERE kd_tagihan = 'KPD3'
                            	AND ts.kd_sekolah= '$kd_sekolah'
                            	AND ts.th_ajar   = '$th_ajar'
                            	AND ts.p_nl      =  $p_nl
                              AND ts.sub_pnl   = 'UAS'
                            	AND ts.kelas	 = '$kelas'
                              AND ts.kd_mp     = '$kd_mp'
                            )KPD3_UAS
                            ON ks.nis = KPD3_UAS.nis
                            LEFT OUTER JOIN
                            	(
                            		SELECT * FROM tgh_siswa ts
                            		WHERE kd_tagihan = 'KPD1'
                            		AND ts.kd_sekolah= '$kd_sekolah'
                            		AND ts.th_ajar   = '$th_ajar'
                            		AND ts.p_nl      =  $p_nl
                                AND ts.sub_pnl   = 'UTS'
                            		AND ts.kelas	 = '$kelas'
                                AND ts.kd_mp     = '$kd_mp'
                            	)KPD1_UTS
                            	ON ks.nis = KPD1_UTS.nis
                            LEFT OUTER JOIN
                              (
                              	SELECT * FROM tgh_siswa ts
                              	WHERE kd_tagihan = 'KPD2'
                              	AND ts.kd_sekolah= '$kd_sekolah'
                              	AND ts.th_ajar   = '$th_ajar'
                              	AND ts.p_nl      =  $p_nl
                                AND ts.sub_pnl   = 'UTS'
                              	AND ts.kelas	 = '$kelas'
                                AND ts.kd_mp     = '$kd_mp'
                              )KPD2_UTS
                              ON ks.nis = KPD2_UTS.nis
                              LEFT OUTER JOIN
                                (
                                	SELECT * FROM tgh_siswa ts
                                	WHERE kd_tagihan = 'KPD3'
                                	AND ts.kd_sekolah= '$kd_sekolah'
                                	AND ts.th_ajar   = '$th_ajar'
                                	AND ts.p_nl      =  $p_nl
                                  AND ts.sub_pnl   = 'UTS'
                                	AND ts.kelas	 = '$kelas'
                                  AND ts.kd_mp     = '$kd_mp'
                                )KPD3_UTS
                                ON ks.nis = KPD3_UTS.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'PRK1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)PRK1
                        	on ks.nis = PRK1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'PRK2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)PRK2
                        	on ks.nis = PRK2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'PRK3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)PRK3
                        	on ks.nis = PRK3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'POR1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)POR1
                        	on ks.nis = POR1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'POR2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)POR2
                        	on ks.nis = POR2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'POR3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)POR3
                        	on ks.nis = POR3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'PRJ1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)PRJ1
                        	on ks.nis = PRJ1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'PRJ2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)PRJ2
                        	on ks.nis = PRJ2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'PRJ3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)PRJ3
                        	on ks.nis = PRJ3.nis



                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'PRK1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)PRK1_UTS
                        	on ks.nis = PRK1_UTS.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'PRK2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)PRK2_UTS
                        	on ks.nis = PRK2_UTS.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'PRK3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)PRK3_UTS
                        	on ks.nis = PRK3_UTS.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'POR1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)POR1_UTS
                        	on ks.nis = POR1_UTS.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'POR2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)POR2_UTS
                        	on ks.nis = POR2_UTS.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'POR3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)POR3_UTS
                        	on ks.nis = POR3_UTS.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'PRJ1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)PRJ1_UTS
                        	on ks.nis = PRJ1_UTS.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'PRJ2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)PRJ2_UTS
                        	on ks.nis = PRJ2_UTS.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'PRJ3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)PRJ3_UTS
                        	on ks.nis = PRJ3_UTS.nis



                        left outer  join
                        	(
                        		select comment,ts.nis from nl_comment_keterampilan ts
                        		where  ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)cm
                        	on ks.nis = cm.nis

                        where ks.kd_sekolah     ='$kd_sekolah'
                        and ks.th_ajar          ='$th_ajar'
                        and ks.kelas            ='$kelas'
						ORDER BY nama_lengkap ";
        $hasil        = $this->db->query($sql);
        return $hasil;
    }
    function nilai_sikap_sma($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];

        $sql            = "SELECT mss.nama_lengkap, mss.nis, ncs.*
	                         ,COALESCE(jjr_uas.kgn, 0) JJR_UAS, COALESCE(jjr_uts.kgn, 0) JJR_UTS
                           ,COALESCE(dsp_uas.kgn, 0) DSP_UAS, COALESCE(dsp_uts.kgn, 0) DSP_UTS
                           ,COALESCE(tgjb_uas.kgn, 0) TGJB_UAS, COALESCE(tgjb_uts.kgn, 0) TGJB_UTS
                           ,COALESCE(tlrs_uas.kgn, 0) TLRS_UAS, COALESCE(tlrs_uts.kgn, 0) TLRS_UTS
                           ,COALESCE(gtry_uas.kgn, 0) GTRY_UAS, COALESCE(gtry_uts.kgn, 0) GTRY_UTS
                           ,COALESCE(sntn_uas.kgn, 0) SNTN_UAS, COALESCE(sntn_uts.kgn, 0) SNTN_UTS
                           ,COALESCE(pcdr_uas.kgn, 0) PCDR_UAS, COALESCE(pcdr_uts.kgn, 0) PCDR_UTS
                           ,COALESCE(ibdh_uas.kgn, 0) IBDH_UAS, COALESCE(ibdh_uts.kgn, 0) IBDH_UTS
                           ,COALESCE(twkl_uas.kgn, 0) TWKL_UAS, COALESCE(twkl_uts.kgn, 0) TWKL_UTS
                           ,COALESCE(hrtol_uas.kgn, 0) HRTOL_UAS, COALESCE(HRTOL_uts.kgn, 0) HRTOL_UTS
                           ,COALESCE(mbrslm_uas.kgn, 0) MBRSLM_UAS, COALESCE(mbrslm_uts.kgn, 0) MBRSLM_UTS
                           ,COALESCE(mjglkgn_uas.kgn, 0) MJGLKGN_UAS, COALESCE(mjglkgn_uts.kgn, 0) MJGLKGN_UTS
                           FROM kelas_siswa ks
                           INNER JOIN ms_siswa mss
                           ON mss.nis = ks.nis

                           LEFT OUTER JOIN
                           (
                             SELECT * FROM nl_comment_sikap nl
                             WHERE nl.kd_sekolah= '$kd_sekolah'
                             and nl.kelas       = '$kelas'
                             and nl.sub_pnl     = '$sub_pnl'
                             and nl.p_nl        = '$p_nl'
                             and nl.kd_mp       = '$kd_mp'
                             and nl.th_ajar     = '$th_ajar'
                           ) ncs
                           on ks.nis = ncs.nis

                           LEFT OUTER JOIN
                           (
	                          SELECT * FROM tgh_siswa tghs
	                          WHERE tghs.kd_sekolah = '$kd_sekolah'
	                          AND tghs.th_ajar = '$th_ajar'
	                          AND tghs.p_nl = '$p_nl'
	                          AND tghs.kd_mp = '$kd_mp'
	                          AND tghs.kelas = '$kelas'
	                          AND tghs.sub_pnl = 'UAS'
	                          AND tghs.kd_tagihan = 'IBDH'
                            ) ibdh_uas
                            On ks.nis = ibdh_uas.nis
                            LEFT OUTER JOIN
                            (
 	                          SELECT * FROM tgh_siswa tghs
 	                          WHERE tghs.kd_sekolah = '$kd_sekolah'
 	                          AND tghs.th_ajar = '$th_ajar'
 	                          AND tghs.p_nl = '$p_nl'
 	                          AND tghs.kd_mp = '$kd_mp'
 	                          AND tghs.kelas = '$kelas'
 	                          AND tghs.sub_pnl = 'UTS'
 	                          AND tghs.kd_tagihan = 'IBDH'
                            ) ibdh_uts
                            On ks.nis = ibdh_uts.nis
                            LEFT OUTER JOIN
                            (
 	                          SELECT * FROM tgh_siswa tghs
 	                          WHERE tghs.kd_sekolah = '$kd_sekolah'
 	                          AND tghs.th_ajar = '$th_ajar'
 	                          AND tghs.p_nl = '$p_nl'
 	                          AND tghs.kd_mp = '$kd_mp'
 	                          AND tghs.kelas = '$kelas'
 	                          AND tghs.sub_pnl = 'UAS'
 	                          AND tghs.kd_tagihan = 'MBRSLM'
                            ) mbrslm_uas
                            On ks.nis = mbrslm_uas.nis
                            LEFT OUTER JOIN
                            (
 	                          SELECT * FROM tgh_siswa tghs
 	                          WHERE tghs.kd_sekolah = '$kd_sekolah'
 	                          AND tghs.th_ajar = '$th_ajar'
 	                          AND tghs.p_nl = '$p_nl'
 	                          AND tghs.kd_mp = '$kd_mp'
 	                          AND tghs.kelas = '$kelas'
 	                          AND tghs.sub_pnl = 'UTS'
 	                          AND tghs.kd_tagihan = 'MBRSLM'
                            ) mbrslm_uts
                            On ks.nis = mbrslm_uts.nis
                            LEFT OUTER JOIN
                            (
 	                          SELECT * FROM tgh_siswa tghs
 	                          WHERE tghs.kd_sekolah = '$kd_sekolah'
 	                          AND tghs.th_ajar = '$th_ajar'
 	                          AND tghs.p_nl = '$p_nl'
 	                          AND tghs.kd_mp = '$kd_mp'
 	                          AND tghs.kelas = '$kelas'
 	                          AND tghs.sub_pnl = 'UAS'
 	                          AND tghs.kd_tagihan = 'TWKL'
                            ) twkl_uas
                            On ks.nis = twkl_uas.nis
                            LEFT OUTER JOIN
                            (
 	                          SELECT * FROM tgh_siswa tghs
 	                          WHERE tghs.kd_sekolah = '$kd_sekolah'
 	                          AND tghs.th_ajar = '$th_ajar'
 	                          AND tghs.p_nl = '$p_nl'
 	                          AND tghs.kd_mp = '$kd_mp'
 	                          AND tghs.kelas = '$kelas'
 	                          AND tghs.sub_pnl = 'UTS'
 	                          AND tghs.kd_tagihan = 'TWKL'
                            ) twkl_uts
                            On ks.nis = twkl_uts.nis
                            LEFT OUTER JOIN
                            (
 	                          SELECT * FROM tgh_siswa tghs
 	                          WHERE tghs.kd_sekolah = '$kd_sekolah'
 	                          AND tghs.th_ajar = '$th_ajar'
 	                          AND tghs.p_nl = '$p_nl'
 	                          AND tghs.kd_mp = '$kd_mp'
 	                          AND tghs.kelas = '$kelas'
 	                          AND tghs.sub_pnl = 'UAS'
 	                          AND tghs.kd_tagihan = 'MJGLKGN'
                            ) mjglkgn_uas
                            On ks.nis = mjglkgn_uas.nis
                            LEFT OUTER JOIN
                            (
 	                          SELECT * FROM tgh_siswa tghs
 	                          WHERE tghs.kd_sekolah = '$kd_sekolah'
 	                          AND tghs.th_ajar = '$th_ajar'
 	                          AND tghs.p_nl = '$p_nl'
 	                          AND tghs.kd_mp = '$kd_mp'
 	                          AND tghs.kelas = '$kelas'
 	                          AND tghs.sub_pnl = 'UTS'
 	                          AND tghs.kd_tagihan = 'MJGLKGN'
                            ) mjglkgn_uts
                            On ks.nis = mjglkgn_uts.nis
                            LEFT OUTER JOIN
                            (
 	                          SELECT * FROM tgh_siswa tghs
 	                          WHERE tghs.kd_sekolah = '$kd_sekolah'
 	                          AND tghs.th_ajar = '$th_ajar'
 	                          AND tghs.p_nl = '$p_nl'
 	                          AND tghs.kd_mp = '$kd_mp'
 	                          AND tghs.kelas = '$kelas'
 	                          AND tghs.sub_pnl = 'UAS'
 	                          AND tghs.kd_tagihan = 'HRTOL'
                            ) hrtol_uas
                            On ks.nis = hrtol_uas.nis
                            LEFT OUTER JOIN
                            (
 	                          SELECT * FROM tgh_siswa tghs
 	                          WHERE tghs.kd_sekolah = '$kd_sekolah'
 	                          AND tghs.th_ajar = '$th_ajar'
 	                          AND tghs.p_nl = '$p_nl'
 	                          AND tghs.kd_mp = '$kd_mp'
 	                          AND tghs.kelas = '$kelas'
 	                          AND tghs.sub_pnl = 'UTS'
 	                          AND tghs.kd_tagihan = 'HRTOL'
                            ) hrtol_uts
                            On ks.nis = hrtol_uts.nis

                           LEFT OUTER JOIN
                           (
	                          SELECT * FROM tgh_siswa tghs
	                          WHERE tghs.kd_sekolah = '$kd_sekolah'
	                          AND tghs.th_ajar = '$th_ajar'
	                          AND tghs.p_nl = '$p_nl'
	                          AND tghs.kd_mp = '$kd_mp'
	                          AND tghs.kelas = '$kelas'
	                          AND tghs.sub_pnl = 'UAS'
	                          AND tghs.kd_tagihan = 'JJR'
                            ) jjr_uas
                          On ks.nis = jjr_uas.nis
                          LEFT OUTER JOIN
                          (
                           SELECT * FROM tgh_siswa tghs
                           WHERE tghs.kd_sekolah = '$kd_sekolah'
                           AND tghs.th_ajar = '$th_ajar'
                           AND tghs.p_nl = '$p_nl'
                           AND tghs.kd_mp = '$kd_mp'
                           AND tghs.kelas = '$kelas'
                           AND tghs.sub_pnl = 'UTS'
                           AND tghs.kd_tagihan = 'JJR'
                          ) jjr_uts
                          On ks.nis = jjr_uts.nis
                          LEFT OUTER JOIN
                          (
                           SELECT * FROM tgh_siswa tghs
                           WHERE tghs.kd_sekolah = '$kd_sekolah'
                           AND tghs.th_ajar = '$th_ajar'
                           AND tghs.p_nl = '$p_nl'
                           AND tghs.kd_mp = '$kd_mp'
                           AND tghs.kelas = '$kelas'
                           AND tghs.sub_pnl = 'UAS'
                           AND tghs.kd_tagihan = 'DSP'
                           ) dsp_uas
                         On ks.nis = dsp_uas.nis
                         LEFT OUTER JOIN
                         (
                          SELECT * FROM tgh_siswa tghs
                          WHERE tghs.kd_sekolah = '$kd_sekolah'
                          AND tghs.th_ajar = '$th_ajar'
                          AND tghs.p_nl = '$p_nl'
                          AND tghs.kd_mp = '$kd_mp'
                          AND tghs.kelas = '$kelas'
                          AND tghs.sub_pnl = 'UTS'
                          AND tghs.kd_tagihan = 'DSP'
                        ) dsp_uts
                        On ks.nis = dsp_uts.nis
                        LEFT OUTER JOIN
                        (
                         SELECT * FROM tgh_siswa tghs
                         WHERE tghs.kd_sekolah = '$kd_sekolah'
                         AND tghs.th_ajar = '$th_ajar'
                         AND tghs.p_nl = '$p_nl'
                         AND tghs.kd_mp = '$kd_mp'
                         AND tghs.kelas = '$kelas'
                         AND tghs.sub_pnl = 'UAS'
                         AND tghs.kd_tagihan = 'TGJB'
                       ) tgjb_uas
                       On ks.nis = tgjb_uas.nis
                       LEFT OUTER JOIN
                       (
                        SELECT * FROM tgh_siswa tghs
                        WHERE tghs.kd_sekolah = '$kd_sekolah'
                        AND tghs.th_ajar = '$th_ajar'
                        AND tghs.p_nl = '$p_nl'
                        AND tghs.kd_mp = '$kd_mp'
                        AND tghs.kelas = '$kelas'
                        AND tghs.sub_pnl = 'UTS'
                        AND tghs.kd_tagihan = 'TGJB'
                      ) tgjb_uts
                      On ks.nis = tgjb_uts.nis
                      LEFT OUTER JOIN
                      (
                       SELECT * FROM tgh_siswa tghs
                       WHERE tghs.kd_sekolah = '$kd_sekolah'
                       AND tghs.th_ajar = '$th_ajar'
                       AND tghs.p_nl = '$p_nl'
                       AND tghs.kd_mp = '$kd_mp'
                       AND tghs.kelas = '$kelas'
                       AND tghs.sub_pnl = 'UAS'
                       AND tghs.kd_tagihan = 'TLRS'
                     ) tlrs_uas
                     On ks.nis = tlrs_uas.nis
                     LEFT OUTER JOIN
                     (
                      SELECT * FROM tgh_siswa tghs
                      WHERE tghs.kd_sekolah = '$kd_sekolah'
                      AND tghs.th_ajar = '$th_ajar'
                      AND tghs.p_nl = '$p_nl'
                      AND tghs.kd_mp = '$kd_mp'
                      AND tghs.kelas = '$kelas'
                      AND tghs.sub_pnl = 'UTS'
                      AND tghs.kd_tagihan = 'TLRS'
                    ) tlrs_uts
                    On ks.nis = tlrs_uts.nis
                    LEFT OUTER JOIN
                    (
                     SELECT * FROM tgh_siswa tghs
                     WHERE tghs.kd_sekolah = '$kd_sekolah'
                     AND tghs.th_ajar = '$th_ajar'
                     AND tghs.p_nl = '$p_nl'
                     AND tghs.kd_mp = '$kd_mp'
                     AND tghs.kelas = '$kelas'
                     AND tghs.sub_pnl = 'UAS'
                     AND tghs.kd_tagihan = 'GTRY'
                     ) gtry_uas
                     On ks.nis = gtry_uas.nis
                     LEFT OUTER JOIN
                     (
                      SELECT * FROM tgh_siswa tghs
                      WHERE tghs.kd_sekolah = '$kd_sekolah'
                      AND tghs.th_ajar = '$th_ajar'
                      AND tghs.p_nl = '$p_nl'
                      AND tghs.kd_mp = '$kd_mp'
                      AND tghs.kelas = '$kelas'
                      AND tghs.sub_pnl = 'UTS'
                      AND tghs.kd_tagihan = 'GTRY'
                      ) gtry_uts
                      On ks.nis = gtry_uts.nis
                      LEFT OUTER JOIN
                      (
                       SELECT * FROM tgh_siswa tghs
                       WHERE tghs.kd_sekolah = '$kd_sekolah'
                       AND tghs.th_ajar = '$th_ajar'
                       AND tghs.p_nl = '$p_nl'
                       AND tghs.kd_mp = '$kd_mp'
                       AND tghs.kelas = '$kelas'
                       AND tghs.sub_pnl = 'UAS'
                       AND tghs.kd_tagihan = 'SNTN'
                       ) sntn_uas
                       On ks.nis = sntn_uas.nis
                       LEFT OUTER JOIN
                       (
                        SELECT * FROM tgh_siswa tghs
                        WHERE tghs.kd_sekolah = '$kd_sekolah'
                        AND tghs.th_ajar = '$th_ajar'
                        AND tghs.p_nl = '$p_nl'
                        AND tghs.kd_mp = '$kd_mp'
                        AND tghs.kelas = '$kelas'
                        AND tghs.sub_pnl = 'UTS'
                        AND tghs.kd_tagihan = 'SNTN'
                        ) sntn_uts
                        On ks.nis = sntn_uts.nis
                        LEFT OUTER JOIN
                        (
                         SELECT * FROM tgh_siswa tghs
                         WHERE tghs.kd_sekolah = '$kd_sekolah'
                         AND tghs.th_ajar = '$th_ajar'
                         AND tghs.p_nl = '$p_nl'
                         AND tghs.kd_mp = '$kd_mp'
                         AND tghs.kelas = '$kelas'
                         AND tghs.sub_pnl = 'UAS'
                         AND tghs.kd_tagihan = 'PCDR'
                         ) pcdr_uas
                         On ks.nis = pcdr_uas.nis
                         LEFT OUTER JOIN
                         (
                          SELECT * FROM tgh_siswa tghs
                          WHERE tghs.kd_sekolah = '$kd_sekolah'
                          AND tghs.th_ajar = '$th_ajar'
                          AND tghs.p_nl = '$p_nl'
                          AND tghs.kd_mp = '$kd_mp'
                          AND tghs.kelas = '$kelas'
                          AND tghs.sub_pnl = 'UTS'
                          AND tghs.kd_tagihan = 'PCDR'
                          ) pcdr_uts
                          On ks.nis = pcdr_uts.nis


                          WHERE ks.kelas = '$kelas'
                          AND ks.th_ajar = '$th_ajar'
                          AND ks.kd_sekolah = '$kd_sekolah'
                          ORDER BY nama_lengkap";

        $hasil        = $this->db->query($sql)->result();
        return $hasil;
    }
    function nilai_sikap($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];
        $sql        = " select ks.nis, ms.nama_lengkap,
                        coalesce(DIR_UTS.kgn,0) DIR_UTS, coalesce(JUR_UTS.kgn,0) JUR_UTS,
                        coalesce(OBS_UTS.kgn,0) OBS_UTS,coalesce(TMN_UTS.kgn,0) TMN_UTS,
							          coalesce(DIR.kgn,0) DIR, coalesce(JUR.kgn,0) JUR,
                        coalesce(OBS.kgn,0) OBS,coalesce(TMN.kgn,0) TMN, coalesce(cm.comment,'') DESKRIPSI,
                        COALESCE(atr_uts.kgn, 0) ATR_UTS, COALESCE(atr_uas.kgn, 0) ATR_UAS
                        from kelas_siswa ks
                        inner join ms_siswa ms
                        on ks.nis = ms.nis
                        LEFT OUTER JOIN
                        	(
                        		SELECT * FROM tgh_siswa ts
                        		WHERE kd_tagihan = 'ATR'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		AND ts.th_ajar   = '$th_ajar'
                        		AND ts.p_nl      =  $p_nl
                            AND ts.sub_pnl   = 'UTS'
                        		AND ts.kelas	 = '$kelas'
                            AND ts.kd_mp     = '$kd_mp'
                        	)atr_uts
                        	on ks.nis = atr_uts.nis
                        LEFT OUTER JOIN
                          (
                          	SELECT * FROM tgh_siswa ts
                          	WHERE kd_tagihan = 'ATR'
                          	and ts.kd_sekolah= '$kd_sekolah'
                          	AND ts.th_ajar   = '$th_ajar'
                          	AND ts.p_nl      =  $p_nl
                            AND ts.sub_pnl   = 'UAS'
                          	AND ts.kelas	 = '$kelas'
                            AND ts.kd_mp     = '$kd_mp'
                          )atr_uas
                          on ks.nis = atr_uas.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'DIR'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)DIR_UTS
                        	on ks.nis = DIR_UTS.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'JUR'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)JUR_UTS
                        	on ks.nis = JUR_UTS.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'OBS'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)OBS_UTS
                        	on ks.nis = OBS_UTS.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TMN'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UTS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)TMN_UTS
                        	on ks.nis = TMN_UTS.nis

						left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'DIR'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)DIR
                        	on ks.nis = DIR.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'JUR'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)JUR
                        	on ks.nis = JUR.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'OBS'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)OBS
                        	on ks.nis = OBS.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TMN'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = 'UAS'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)TMN
                        	on ks.nis = TMN.nis

                        left outer  join
                        	(
                        		select comment,ts.nis from nl_comment_sikap ts
                        		where  ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)cm
                        	on ks.nis = cm.nis

                        where ks.kd_sekolah     ='$kd_sekolah'
                        and ks.th_ajar          ='$th_ajar'
                        and ks.kelas            ='$kelas'
						ORDER BY nama_lengkap ";
        $hasil        = $this->db->query($sql);
        return $hasil;
    }

    function nilaiPerNis($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];
        $nis            = $data['nis'];
        $sql        = " select ks.nis, ms.nama_lengkap, coalesce(uht1.kgn,' ') UHT1, coalesce(uht2.kgn,' ') UHT2, coalesce(uht3.kgn,' ') UHT3, coalesce(uhp1.psk,0) UHP1, coalesce(uhp2.psk,0) UHP2, coalesce(uhp3.psk,0) UHP3, coalesce(tgs1.kgn,0) TGS1, coalesce(tgs2.kgn,0) TGS2, coalesce(tgs3.kgn,0) TGS3, coalesce(utst.kgn,0) UTST, coalesce(utsp.psk,0) UTSP, coalesce(uast.kgn,0) UAST, coalesce(uasp.psk,0) UASP
                        from kelas_siswa ks
                        inner join ms_siswa ms
                        on ks.nis = ms.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uht1
                        	on ks.nis = uht1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uht2
                        	on ks.nis = uht2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uht3
                        	on ks.nis = uht3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uhp1
                        	on ks.nis = uhp1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uhp2
                        	on ks.nis = uhp2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uhp3
                        	on ks.nis = uhp3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)tgs1
                        	on ks.nis = tgs1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)tgs2
                        	on ks.nis = tgs2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)tgs3
                        	on ks.nis = tgs3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UTST'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)utst
                        	on ks.nis = utst.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UTST'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)utsp
                        	on ks.nis = utsp.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UAST'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uast
                        	on ks.nis = uast.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UAST'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                                and ts.sub_pnl   = '$sub_pnl'
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                        	)uasp
                        	on ks.nis = uasp.nis

                        where ks.kd_sekolah     ='$kd_sekolah'
                        and ks.th_ajar          ='$th_ajar'
                        and ks.kelas            ='$kelas'
                        and ks.nis              ='$nis' ";
        $hasil        = $this->db->query($sql);
        return $hasil;
    }


    function avg($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];
        $kd_mp          = $data['kd_mp'];
        $sql        = " select nis, kd_mp, avg(kgn) as nlkgn, avg(psk) as nlpsk, avg(afk) as nlafk
                        from tgh_siswa

                        where kd_sekolah ='$kd_sekolah'
                        and th_ajar      ='$th_ajar'
                        and p_nl         = $p_nl
                        and kelas        ='$kelas'
                        and nis          ='$nis'
                        and kd_mp        ='$kd_mp'

                        group by nis,kd_mp
                        order by nis,kd_mp ";

        $hasil      = $this->db->query($sql);
        return $hasil;

    }
    function rapor_akhir($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];

        $sql        = " select ks.nis, ms.nama_lengkap, 
                        coalesce(nh1.kgn,' ') NH1,   coalesce(nh2.kgn,' ') NH2,   coalesce(nh3.kgn,' ') NH3, coalesce(nh4.kgn,' ') NH4,   coalesce(nh5.kgn,' ') NH5,   coalesce(nh6.kgn,' ') NH6, 
                        coalesce(kin1.psk,' ') KIN1,   coalesce(kin2.psk,' ') KIN2,   coalesce(prj1.psk,' ') PRJ1, coalesce(prj2.psk,' ') PRJ2,   coalesce(por1.psk,' ') POR1,   coalesce(por2.psk,' ') POR2,
                        coalesce(spr.afk,' ') SPR,   coalesce(sos.afk,' ') SOS,
                        coalesce(pts.kgn,' ') PTS_KGN,   coalesce(pts.psk,' ') PTS_PSK,

                        coalesce(nha1.kgn,' ') NHA1,   coalesce(nha2.kgn,' ') NHA2,   coalesce(nha3.kgn,' ') NHA3, coalesce(nha4.kgn,' ') NHA4,   coalesce(nha5.kgn,' ') NHA5,   coalesce(nha6.kgn,' ') NHA6, 
                        coalesce(kina1.psk,' ') KINA1,   coalesce(kina2.psk,' ') KINA2,   coalesce(prja1.psk,' ') PRJA1, coalesce(prja2.psk,' ') PRJA2,   coalesce(pora1.psk,' ') PORA1,   coalesce(pora2.psk,' ') PORA2,
                        coalesce(spra.afk,' ') SPRA,   coalesce(sosa.afk,' ') SOSA,
                        coalesce(pas.kgn,' ') PAS_KGN,   coalesce(pas.psk,' ') PAS_PSK
                                                    
                        from kelas_siswa ks
                        inner join ms_siswa ms
                        on ks.nis = ms.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'NH1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UTS'
                        	)nh1
                        	on ks.nis = nh1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'NH2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)nh2
                        	on ks.nis = nh2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'NH3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)nh3
                        	on ks.nis = nh3.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'NH4'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                        and ts.kd_mp     = '$kd_mp'
                                        and ts.sub_pnl   = 'UTS'
                            )nh4
                            on ks.nis = nh4.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'NH5'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UTS'
                            )nh5
                            on ks.nis = nh5.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'NH6'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UTS'
                            )nh6
                            on ks.nis = nh6.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'KIN1'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UTS'
                            )kin1
                            on ks.nis = kin1.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'KIN2'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UTS'
                            )kin2
                            on ks.nis = kin2.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'PRJ1'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UTS'
                            )prj1
                            on ks.nis = prj1.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'PRJ2'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                        and ts.kd_mp     = '$kd_mp'
                                        and ts.sub_pnl   = 'UTS'
                            )prj2
                            on ks.nis = prj2.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'POR1'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UTS'
                            )por1
                            on ks.nis = por1.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'POR2'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UTS'
                            )por2
                            on ks.nis = por2.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'SPR'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UTS'
                            )spr
                            on ks.nis = spr.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'SOS'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UTS'
                            )sos
                            on ks.nis = sos.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'PAS'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)pts
                        	on ks.nis = pts.nis
                        



                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'NH1'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )nha1
                            on ks.nis = nha1.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'NH2'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )nha2
                            on ks.nis = nha2.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'NH3'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )nha3
                            on ks.nis = nha3.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'NH4'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )nha4
                            on ks.nis = nha4.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'NH5'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )nha5
                            on ks.nis = nha5.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'NH6'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )nha6
                            on ks.nis = nha6.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'KIN1'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )kina1
                            on ks.nis = kina1.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'KIN2'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )kina2
                            on ks.nis = kina2.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'PRJ1'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )prja1
                            on ks.nis = prja1.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'PRJ2'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                        and ts.kd_mp     = '$kd_mp'
                                        and ts.sub_pnl   = 'UAS'
                            )prja2
                            on ks.nis = prja2.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'POR1'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )pora1
                            on ks.nis = pora1.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'POR2'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )pora2
                            on ks.nis = pora2.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'SPR'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )spra
                            on ks.nis = spra.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'SOS'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )sosa
                            on ks.nis = sosa.nis
                        left outer  join
                            (
                                select * from tgh_siswa ts
                                where kd_tagihan = 'PAS'
                                and ts.kd_sekolah= '$kd_sekolah'
                                and ts.th_ajar   = '$th_ajar'
                                and ts.p_nl      =  $p_nl
                                and ts.kelas     = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                                and ts.sub_pnl   = 'UAS'
                            )pas
                            on ks.nis = pas.nis
                        where ks.kd_sekolah     = '$kd_sekolah'
                        and ks.th_ajar          ='$th_ajar'
                        and ks.kelas            ='$kelas'
						ORDER BY nama_lengkap ";
        //echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;

    }

    function raporAkhirPerNis($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp'];
        $nis            = $data['nis'];

        $sql        = " select ks.nis, ms.nama_lengkap, coalesce(uht1.kgn,' ') UHT1,   coalesce(uht2.kgn,' ') UHT2,   coalesce(uht3.kgn,' ') UHT3,   coalesce(uhp1.psk,' ') UHP1,   coalesce(uhp2.psk,' ') UHP2,   coalesce(uhp3.psk,' ') UHP3,   coalesce(tgs1.kgn,' ') TGS1,   coalesce(tgs2.kgn,' ') TGS2,   coalesce(tgs3.kgn,' ') TGS3,   coalesce(utst.kgn,' ') UTST,   coalesce(utsp.psk,' ') UTSP,
                                                        coalesce(uhta1.kgn,' ') UHTA1, coalesce(uhta2.kgn,' ') UHTA2, coalesce(uhta3.kgn,' ') UHTA3, coalesce(uhpa1.psk,' ') UHPA1, coalesce(uhpa2.psk,' ') UHPA2, coalesce(uhpa3.psk,' ') UHPA3, coalesce(tgsa1.kgn,' ') TGSA1, coalesce(tgsa2.kgn,' ') TGSA2, coalesce(tgsa3.kgn,' ') TGSA3, coalesce(utsta.kgn,' ') UTSTA, coalesce(utspa.psk,' ') UTSPA
                        from kelas_siswa ks
                        inner join ms_siswa ms
                        on ks.nis = ms.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)uht1
                        	on ks.nis = uht1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)uht2
                        	on ks.nis = uht2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)uht3
                        	on ks.nis = uht3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)uhp1
                        	on ks.nis = uhp1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)uhp2
                        	on ks.nis = uhp2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)uhp3
                        	on ks.nis = uhp3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)tgs1
                        	on ks.nis = tgs1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)tgs2
                        	on ks.nis = tgs2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)tgs3
                        	on ks.nis = tgs3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UTST'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)utst
                        	on ks.nis = utst.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UTST'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UTS'
                        	)utsp
                        	on ks.nis = utsp.nis

                        left outer  join
                        	(
                                    select * from tgh_siswa ts
                                    where kd_tagihan = 'UHT1'
                                    and ts.kd_sekolah= '$kd_sekolah'
                                    and ts.th_ajar   = '$th_ajar'
                                    and ts.p_nl      =  $p_nl
                                    and ts.kelas	 = '$kelas'
                                    and ts.kd_mp     = '$kd_mp'
                                    and ts.sub_pnl   = 'UAS'
                        	)uhta1
                        	on ks.nis = uhta1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UAS'
                        	)uhta2
                        	on ks.nis = uhta2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UAS'
                        	)uhta3
                        	on ks.nis = uhta3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UAS'
                        	)uhpa1
                        	on ks.nis = uhpa1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UAS'
                        	)uhpa2
                        	on ks.nis = uhpa2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UHT3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UAS'
                        	)uhpa3
                        	on ks.nis = uhpa3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UAS'
                        	)tgsa1
                        	on ks.nis = tgsa1.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS2'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UAS'
                        	)tgsa2
                        	on ks.nis = tgsa2.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'TGS3'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UAS'
                        	)tgsa3
                        	on ks.nis = tgsa3.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UTST'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UAS'
                        	)utsta
                        	on ks.nis = utsta.nis
                        left outer  join
                        	(
                        		select * from tgh_siswa ts
                        		where kd_tagihan = 'UTST'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      =  $p_nl
                        		and ts.kelas	 = '$kelas'
                                and ts.kd_mp     = '$kd_mp'
                   	            and ts.sub_pnl   = 'UAS'
                        	)utspa
                        	on ks.nis = utspa.nis

                        where ks.kd_sekolah     = '$kd_sekolah'
                        and ks.th_ajar          ='$th_ajar'
                        and ks.kelas            ='$kelas'
                        and ks.nis              ='$nis'";
        $hasil      = $this->db->query($sql);
        return $hasil;

    }

    function proses_nilai($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];
        $kd_mp          = $data['kd_mp'];
        $sql        = " select * from nl_ips
                        where kd_sekolah ='$kd_sekolah'
                        and th_ajar      ='$th_ajar'
                        and p_nl         = $p_nl
                       	and nis	         ='$nis'
                        and kd_mp        ='$kd_mp'
                        and kelas        ='$kelas'";

        $query      = $this->db->query($sql);
        return $query;
    }
    function Get_Nilai($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];
        $kd_mp          = $data['kd_mp'];
        $sql        = " select * from tgh_siswa
                        where kd_sekolah ='$kd_sekolah'
                        and th_ajar      ='$th_ajar'
                        and p_nl         = $p_nl
                        and sub_pnl      ='$sub_pnl'
                       	and nis	         ='$nis'
                        and kd_mp        ='$kd_mp'
                        and kelas        ='$kelas'";
        $query      = $this->db->query($sql);
        return $query;
    }

    function get_nilai_per_kelas_per_mp($kd_sekolah='',$th_ajar='', $p_nl='', $sub_pnl='', $kelas='', $kd_mp='')
    {
        $sql        = " select kd_tagihan, kgn, psk, afk
                        from tgh_siswa tgh
                        inner join ms_mp ms
                            on tgh.kd_mp        = ms.kd_mp
                            and tgh.kd_sekolah  = ms.kd_sekolah
                        where tgh.kd_sekolah ='$kd_sekolah'
                        and th_ajar         ='$th_ajar'
                        and p_nl            = $p_nl
                        and sub_pnl         ='$sub_pnl'
                        and tgh.kd_mp       ='$kd_mp'
                        and kelas           ='$kelas'
                        order by ms.urutan";

        $query      = $this->db->query($sql);
        return $query;
    }

    function Get_Nilaitgs1($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];
        $kd_mp          = $data['kd_mp'];
        $sql        = " select * from tgh_siswa
                        where kd_sekolah ='$kd_sekolah'
                        and th_ajar      ='$th_ajar'
                        and p_nl         = $p_nl
                        and sub_pnl      ='$sub_pnl'
                       	and nis	         ='$nis'
                        and kd_mp        ='$kd_mp'
                        and kelas        ='$kelas'
                        and kd_nilai     ='TGS1'";
        $query      = $this->db->query($sql);
        return $query;
    }
    function getcoment($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        $sql            = " select * from nl_comment
                            where kd_sekolah ='$kd_sekolah'
                            and th_ajar ='$th_ajar'
                            and p_nl = $p_nl
                            and nis='$nis'
                            and sub_pnl = '$sub_pnl'
                            and kelas ='$kelas' ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getcomentPengembanganDiri($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        $sql            = " select * from nl_comment_kepribadian
                            where kd_sekolah ='$kd_sekolah'
                            and th_ajar ='$th_ajar'
                            and p_nl = $p_nl
                            and nis='$nis'
                            and sub_pnl = '$sub_pnl'
                            and kelas ='$kelas' ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getcomentCatatanUmum($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        $sql            = " select * from nl_comment_catatan_umum
                            where kd_sekolah ='$kd_sekolah'
                            and th_ajar ='$th_ajar'
                            and p_nl = $p_nl
                            and nis='$nis'
                            and sub_pnl = '$sub_pnl'
                            and kelas ='$kelas' ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function Get_Nilai1($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];
        $kd_mp          = $data['kd_mp'];
        $sql        = " select * from tgh_siswa
                        where kd_sekolah ='$kd_sekolah'
                        and th_ajar      ='$th_ajar'
                        and p_nl         = $p_nl
                       	and nis	         ='$nis'
                        and kd_mp        ='$kd_mp'
                        and kelas        ='$kelas'";
        $query      = $this->db->query($sql);
        return $query;
    }
    function Get_NilaiRaporUts($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];
        $kd_mp          = $data['kd_mp'];
        $sql        = " select * from tgh_siswa
                        where kd_sekolah ='$kd_sekolah'
                        and th_ajar      ='$th_ajar'
                        and p_nl         = $p_nl
                        and sub_pnl      ='$sub_pnl'
                       	and nis	         ='$nis'
                        and kd_mp        ='$kd_mp'
                        and kelas        ='$kelas'";
        $query      = $this->db->query($sql);
        return $query;
    }
    function getReport1($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['pilihkelas'];
        $nis            = $data['pilihnis'];
        $kd_mp          = $data['kd_mp'];

        $sql        = " select skbm, ut1.nama_lengkap, nm_mp, ut1.nis, mpk.kelas
                        from ms_mp_kelas mpk
                        inner join ms_mp mp
                       	on mpk.kd_mp = mp.kd_mp
                       	and mpk.kd_sekolah = mp.kd_sekolah
                        left outer  join
                        	(
                        		select kd_mp, nl, nama_lengkap, ts.nis from tgh_siswa ts
                                inner join ms_siswa
                                on ts.nis = ms_siswa.nis
                                and ts.kd_sekolah= ms_siswa.kd_sekolah
                        		where kd_tagihan = 'UT1'
                        		and ts.kd_sekolah= '$kd_sekolah'
                        		and ts.th_ajar   = '$th_ajar'
                        		and ts.p_nl      = '$p_nl'
                        		and ts.kelas	 = '$kelas'
                        		and ts.nis       = '$nis'
                        	)ut1
                        	on mpk.kd_mp = ut1.kd_mp";
        $sql        .= " where mpk.kd_sekolah ='$kd_sekolah'
                        and th_ajar          ='$th_ajar'
                        and semester         = $p_nl
                        and kelas            ='$kelas' ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function get_avg_nilai($data)
    {
      $CI             = &get_instance();
      $kd_sekolah     = $CI->session->userdata('kd_sekolah');
      $th_ajar        = $CI->session->userdata('th_ajar');
      $p_nl           = $CI->session->userdata('kd_semester');
      $sub_pnl        = $CI->session->userdata('sub_pnl');
      $kelas          = $data['pilihkelas'];
      $nis            = $data['pilihnis'];

      $sql            = "SELECT AVG(kgn) as avg_nilai
                         FROM nl_ips
                         WHere th_ajar = '".$th_ajar."'
                         AND sub_pnl = '".$sub_pnl."'
                         AND kelas = '".$kelas."'
                         AND p_nl = '".$p_nl."'
                         AND nis = '".$nis."'";

    $q                = $this->db->query($sql);
    return $q;
    }
    function get_nilai_siswa($data)
    {
      $CI             = &get_instance();
      $kd_sekolah     = $CI->session->userdata('kd_sekolah');
      $th_ajar        = $CI->session->userdata('th_ajar');
      $p_nl           = $CI->session->userdata('kd_semester');
      $sub_pnl        = $CI->session->userdata('sub_pnl');
      $kelas          = $data['pilihkelas'];
      $nis            = $data['pilihnis'];

      $sql            = "SELECT * FROM nl_ips
                        where th_ajar = '".$th_ajar."'
                        AND kelas = '".$kelas."'
                        AND nis = '".$nis."'
                        AND sub_pnl = '".$sub_pnl."'
                        AND p_nl = '".$p_nl."'";

      $q = $this->db->query($sql)->result();
      return $q;
    }
    function getkpa($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $nis            = $data['pilihnis'];

        $sql            = " select skbm, nm_mp, deskripsi, mp.kd_mp, mpk.kelas, mpk.skbm, COALESCE(nk.kgn, 0) kgn,
                                COALESCE(nk.psk, 0) psk, COALESCE(nk.afk, 0) afk, ms.nama_lengkap, nk.nis, ms.ayah_nama, nc.comment
                                , nc_mp.comment as antar_mp
                                , nk.deskripsi_kgn as comment_pengetahuan
                                , nk.deskripsi_psk as comment_keterampilan
                                , nk.deskripsi_afk as comment_sikap
                                , nlk.comment as comment_keterampilan_sma_uts, nlkk.comment as comment_keterampilan_sma_uas
								, nlp.comment as comment_pengetahuan_sma_uts
                                , nlpp.comment as comment_pengetahuan_sma_uas
								, mp.urutan
                               , nc_pg.comment as comment_tbl_pengetahuan
                               , nc_ket.comment as comment_tbl_keterampilan
                               , nc_skp.comment as comment_tbl_sikap";
      $sql            .= "  from ms_mp_kelas mpk
                            inner join ms_mp mp
                            on mpk.kd_mp = mp.kd_mp
                            and mpk.kd_sekolah = mp.kd_sekolah

                            left outer join nl_ips nk
                            on mpk.kd_sekolah = nk.kd_sekolah
                            and mpk.th_ajar = nk.th_ajar
                            and mpk.semester = nk.p_nl
                            and mpk.kd_mp = nk.kd_mp
                            and nk.nis='$nis'
                            and nk.sub_pnl ='$sub_pnl'

                            left outer join nl_comment nc
                            on mpk.kd_sekolah = nc.kd_sekolah
                            and mpk.th_ajar = nc.th_ajar
                            and mpk.semester = nc.p_nl
                            and nc.nis='$nis'
                            and nc.sub_pnl = '$sub_pnl'

                           left outer join nl_comment_pengetahuan nc_pg
                           on mpk.kd_sekolah = nc_pg.kd_sekolah
                           and mpk.th_ajar = nc_pg.th_ajar
                           and mpk.semester = nc_pg.p_nl
                           and mpk.kd_mp = nc_pg.kd_mp
                           and nc_pg.nis='$nis'
                           and nc_pg.sub_pnl = '$sub_pnl'

                           left outer join nl_comment_keterampilan nc_ket
                           on mpk.kd_sekolah = nc_ket.kd_sekolah
                           and mpk.th_ajar = nc_ket.th_ajar
                           and mpk.semester = nc_ket.p_nl
                           and mpk.kd_mp = nc_ket.kd_mp
                           and nc_ket.nis='$nis'
                           and nc_ket.sub_pnl = '$sub_pnl'

                           left outer join nl_comment_sikap nc_skp
                           on mpk.kd_sekolah = nc_skp.kd_sekolah
                           and mpk.th_ajar = nc_skp.th_ajar
                           and mpk.semester = nc_skp.p_nl
                           and mpk.kd_mp = nc_skp.kd_mp
                           and nc_skp.nis='$nis'
                           and nc_skp.sub_pnl = '$sub_pnl'";

        $sql            .= "  left outer join nl_comment_antar_mapel nc_mp
                            on mpk.kd_sekolah = nc_mp.kd_sekolah
                            and mpk.th_ajar = nc_mp.th_ajar
                            and mpk.semester = nc_mp.p_nl
                            and nc_mp.nis='$nis'
                            and nc_mp.sub_pnl = '$sub_pnl'

                            left outer join ms_siswa ms
                            on nk.nis = ms.nis
							
							LEFT OUTER JOIN nl_comment_pengetahuan nlp
							ON mpk.kd_sekolah = nlp.kd_sekolah 
							AND mpk.th_ajar = nlp.th_ajar 
							AND mpk.semester = nlp.p_nl 
							AND nlp.sub_pnl = 'UTS'
							AND mpk.kd_mp = nlp.kd_mp 
							AND nlp.nis = '$nis'
							
							LEFT OUTER JOIN nl_comment_pengetahuan nlpp
							ON mpk.kd_sekolah = nlpp.kd_sekolah 
							AND mpk.th_ajar = nlpp.th_ajar 
							AND mpk.semester = nlpp.p_nl 
							AND nlpp.sub_pnl = 'UAS'
							AND mpk.kd_mp = nlpp.kd_mp 
							AND nlpp.nis = '$nis'

                            LEFT OUTER JOIN nl_comment_keterampilan nlk
                            ON mpk.kd_sekolah = nlk.kd_sekolah
                            AND mpk.th_ajar = nlk.th_ajar
                            AND mpk.semester = nlk.p_nl
                            AND nlk.sub_pnl = 'UTS'
                            AND mpk.kd_mp = nlk.kd_mp
                            AND nlk.nis = '$nis'
							
							LEFT OUTER JOIN nl_comment_keterampilan nlkk
                            ON mpk.kd_sekolah = nlkk.kd_sekolah
                            AND mpk.th_ajar = nlkk.th_ajar
                            AND mpk.semester = nlkk.p_nl
                            AND nlkk.sub_pnl = 'UAS'
                            AND mpk.kd_mp = nlkk.kd_mp
                            AND nlkk.nis = '$nis'

                            where mpk.kd_sekolah ='$kd_sekolah'
                            and mpk.th_ajar ='$th_ajar'
                            and semester = '$p_nl'

                            and mpk.kelas ='$kelas' ";
        $sql            .= " order by mp.urutan ASC";
        //echo $sql; die();

        $hasil      = $this->db->query($sql);

        return $hasil;
    }
    function getkpa2($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $nis            = $data['pilihnis'];

        $sql            = " select skbm, nm_mp, deskripsi, mp.kd_mp, mpk.kelas, mpk.skbm, COALESCE(nk.kgn, 0) kgn,
                                COALESCE(nk.psk, 0) psk, COALESCE(nk.afk, 0) afk, ms.nama_lengkap, nk.nis, ms.ayah_nama, nc.comment, mp.urutan";
        $sql           .= "  from ms_mp_kelas mpk
                            inner join ms_mp mp
                            on mpk.kd_mp = mp.kd_mp
                            and mpk.kd_sekolah = mp.kd_sekolah

                            left outer join nl_ips nk
                            on mpk.kd_sekolah = nk.kd_sekolah
                            and mpk.th_ajar = nk.th_ajar
                            and mpk.semester = nk.p_nl
                            and mpk.kd_mp = nk.kd_mp
                            and nk.nis='$nis'
                            and nk.sub_pnl ='$sub_pnl'

                            left outer join ms_siswa ms
                            on nk.nis = ms.nis

                            left outer join nl_comment nc
                            on mpk.kd_sekolah = nc.kd_sekolah
                            and mpk.th_ajar = nc.th_ajar
                            and mpk.semester = nc.p_nl
                            and nc.nis='$nis'
                            and nc.sub_pnl = '$sub_pnl'

                            where mpk.kd_sekolah ='$kd_sekolah'
                            and mpk.th_ajar ='$th_ajar'
                            and semester = '$p_nl'
                            and mpk.kelas ='$kelas'

                            order by mp.urutan ASC";
        //echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getNHperKDMP($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $nis            = $data['pilihnis'];
        $kd_mp          = $data['kd_mp'];
        $kd_kd          = $data['kd_kd'];
        $sql            = " SELECT kd_mp, kd_kd, ROUND(AVG(kgn)) AS nh
                            FROM tgh_siswa 
                            WHERE kd_sekolah = '$kd_sekolah'
                            AND th_ajar = '$th_ajar' 
                            AND p_nl = $p_nl
                            AND sub_pnl ='$sub_pnl'
                            AND kd_tagihan LIKE 'NH%' 
                            AND kd_kd = '$kd_kd' 
                            AND nis = '$nis' 
                            AND kelas = '$kelas'
                            AND kd_mp = '$kd_mp'
                            GROUP BY kd_mp";
        // echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }

    function getKinperKDMP($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $nis            = $data['pilihnis'];
        $kd_mp          = $data['kd_mp'];
        $kd_kd          = $data['kd_kd'];
        $sql            = " SELECT kd_mp, kd_kd, ROUND(AVG(psk)) AS kin
                            FROM tgh_siswa 
                            WHERE (kd_sekolah = '$kd_sekolah'
                            AND th_ajar = '$th_ajar' 
                            AND p_nl = $p_nl
                            AND sub_pnl ='$sub_pnl'
                            AND kd_kd = '$kd_kd' 
                            AND nis = '$nis' 
                            AND kelas = '$kelas'
                            AND kd_mp = '$kd_mp')
                            AND (kd_tagihan LIKE 'KIN%' OR kd_tagihan LIKE 'PRJ%' OR kd_tagihan LIKE 'POR%')
                            GROUP BY kd_mp";
        // echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }

    function getPASperKDMP($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $nis            = $data['pilihnis'];
        $kd_mp          = $data['kd_mp'];
        $kd_kd          = $data['kd_kd'];
        $sql            = " SELECT kd_mp, ROUND(AVG(kgn)) AS pas_kgn, ROUND(AVG(psk)) AS pas_psk, ROUND(AVG(psk)) AS pas_psk
                            FROM tgh_siswa 
                            WHERE kd_sekolah = '$kd_sekolah'
                            AND th_ajar = '$th_ajar' 
                            AND p_nl = $p_nl
                            AND sub_pnl ='$sub_pnl'
                            AND kd_tagihan = 'PAS'
                            AND kd_kd = '$kd_kd' 
                            AND nis = '$nis' 
                            AND kelas = '$kelas'
                            AND kd_mp = '$kd_mp'";
        // echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }

    function getSprperKDMP($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $nis            = $data['pilihnis'];
        $kd_mp          = $data['kdMpPsk'];
        $kd_tagihan     = $data['kdTghPsk'];
        $kdKiPsk        = $data['kdKiPsk'];
        
        $sql            = " SELECT ms.kd_mp, ms.kd_kd, ms.afk, dtl.ket_kd
                            FROM tgh_siswa ms
                            
                            RIGHT JOIN ms_kelas kls
                            ON ms.kd_sekolah = kls.kd_sekolah
                            AND ms.kelas = kls.kelas
                            
                            INNER JOIN ms_mp_kd_dtl dtl
                            ON ms.kd_sekolah = dtl.`kd_sekolah`
                            AND ms.th_ajar = dtl.th_ajar
                            AND ms.p_nl = dtl.kd_semester
                            AND ms.kd_mp = dtl.kd_mp
                            AND ms.kd_kd = dtl.kd_kd
                            AND kls.tingkat = dtl.tk
                            
                            WHERE (ms.kd_sekolah = '$kd_sekolah' 
                            AND ms.th_ajar = '$th_ajar' 
                            AND ms.p_nl = $p_nl 
                            AND ms.sub_pnl = '$sub_pnl'
                            AND ms.kd_tagihan = '$kd_tagihan'
                            AND ms.nis = '$nis' 
                            AND ms.kelas = '$kelas'
                            AND ms.kd_mp = '$kd_mp')
                            AND (dtl.kd_ki = '$kdKiPsk' OR dtl.kd_ki = UPPER('$kdKiPsk'))
                            ";
        // echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }

    function getKkmMp($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['pilihkelas'];
        $kd_mp          = $data['kd_mp_rpt'];
        $sql            = " SELECT skbm
                            FROM ms_mp_kelas
                            WHERE kd_sekolah = '$kd_sekolah'
                            AND th_ajar = '$th_ajar' 
                            AND semester = $p_nl
                            AND kelas = '$kelas'
                            AND kd_mp = '$kd_mp'";
        // echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }

    function getDeskripsiKD($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $tk             = $data['tk'];
        $kd_mp          = $data['kd_mp_rpt'];
        $kd_ki          = $data['kd_ki'];
        $kd_kd          = $data['kd_max_min'];
        $sql            = " SELECT ket_kd
                            FROM ms_mp_kd_dtl 
                            WHERE kd_sekolah = '$kd_sekolah'
                            AND th_ajar = '$th_ajar' 
                            AND kd_semester = $p_nl
                            AND kd_ki = '$kd_ki'
                            AND kd_kd = '$kd_kd'
                            AND tk = '$tk'
                            AND kd_mp = '$kd_mp'";
        // echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }

    function dapat($data)
    {
      $CI             = &get_instance();
      $kd_sekolah     = $CI->session->userdata('kd_sekolah');
      $th_ajar        = $CI->session->userdata('th_ajar');
      $p_nl           = $CI->session->userdata('kd_semester');
      $sub_pnl        = $CI->session->userdata('sub_pnl');
      $kelas          = $data['pilihkelas'];
      $nis            = $data['pilihnis'];
      $kd_mp          = $data['kd_mp'];
      $sql =   " select *
                  from nl_ips 
                  where kd_sekolah = '$kd_sekolah'
                  and th_ajar     = '$th_ajar' 
                  and p_nl = '$p_nl'
                  and sub_pnl = '$sub_pnl'
                  and kelas = '$kelas'
                  and nis = '$nis'
                  and kd_mp = '$kd_mp'";
      $query = $this->db->query($sql); 
      return $query;
    }

    function simpanNilaiRaport($data)
    {
        $CI                   = &get_instance();
        $db['kd_sekolah']     = $CI->session->userdata('kd_sekolah');
        $db['th_ajar']        = $CI->session->userdata('th_ajar');
        $db['p_nl']           = $CI->session->userdata('kd_semester');
        $db['sub_pnl']        = $CI->session->userdata('sub_pnl');
        $db['kelas']          = $data['pilihkelas'];
        $db['nis']            = $data['pilihnis'];
        $db['kd_mp']          = $data['kd_mp'];
        $db['kgn']            = $data['kgn'];
        $db['deskripsi_kgn']  = $data['deskripsi_kgn'];
        return $this->db->insert('nl_ips',$db);
    }

    function updateNilaiRaport($data)
    {
        $CI                   = &get_instance();
        $db['kd_sekolah']     = $CI->session->userdata('kd_sekolah');
        $db['th_ajar']        = $CI->session->userdata('th_ajar');
        $db['p_nl']           = $CI->session->userdata('kd_semester');
        $db['sub_pnl']        = $CI->session->userdata('sub_pnl');
        $db['kelas']          = $data['pilihkelas'];
        $db['nis']            = $data['pilihnis'];
        $db['kd_mp']          = $data['kd_mp'];

        //update data
        $dbdata = array(
          'kgn' => $data['kgn'],
          'deskripsi_kgn' => $data['deskripsi_kgn']
        ); 

        $this->db->where('kd_sekolah',$db['kd_sekolah']);
        $this->db->where('th_ajar',$db['th_ajar']);
        $this->db->where('p_nl',$db['p_nl']);
        $this->db->where('sub_pnl',$db['sub_pnl']);
        $this->db->where('kelas',$db['kelas']);
        $this->db->where('nis',$db['nis']);
        $this->db->where('kd_mp',$db['kd_mp']);

        return $this->db->update('nl_ips', $dbdata);
    }

    function simpanNilaiRaportPsk($data)
    {
        $CI                   = &get_instance();
        $db['kd_sekolah']     = $CI->session->userdata('kd_sekolah');
        $db['th_ajar']        = $CI->session->userdata('th_ajar');
        $db['p_nl']           = $CI->session->userdata('kd_semester');
        $db['sub_pnl']        = $CI->session->userdata('sub_pnl');
        $db['kelas']          = $data['pilihkelas'];
        $db['nis']            = $data['pilihnis'];
        $db['kd_mp']          = $data['kd_mp'];
        $db['psk']            = $data['psk'];
        $db['deskripsi_psk']  = $data['deskripsi_psk'];
        return $this->db->insert('nl_ips',$db);
    }

    function updateNilaiRaportPsk($data)
    {
        $CI                   = &get_instance();
        $db['kd_sekolah']     = $CI->session->userdata('kd_sekolah');
        $db['th_ajar']        = $CI->session->userdata('th_ajar');
        $db['p_nl']           = $CI->session->userdata('kd_semester');
        $db['sub_pnl']        = $CI->session->userdata('sub_pnl');
        $db['kelas']          = $data['pilihkelas'];
        $db['nis']            = $data['pilihnis'];
        $db['kd_mp']          = $data['kd_mp'];

        //update data
        $dbdata = array(
          'psk' => $data['psk'],
          'deskripsi_psk' => $data['deskripsi_psk']
        ); 

        $this->db->where('kd_sekolah',$db['kd_sekolah']);
        $this->db->where('th_ajar',$db['th_ajar']);
        $this->db->where('p_nl',$db['p_nl']);
        $this->db->where('sub_pnl',$db['sub_pnl']);
        $this->db->where('kelas',$db['kelas']);
        $this->db->where('nis',$db['nis']);
        $this->db->where('kd_mp',$db['kd_mp']);

        return $this->db->update('nl_ips', $dbdata);
    }

    function simpanNilaiRaportAfk($data)
    {
        $CI                   = &get_instance();
        $db['kd_sekolah']     = $CI->session->userdata('kd_sekolah');
        $db['th_ajar']        = $CI->session->userdata('th_ajar');
        $db['p_nl']           = $CI->session->userdata('kd_semester');
        $db['sub_pnl']        = $CI->session->userdata('sub_pnl');
        $db['kelas']          = $data['pilihkelas'];
        $db['nis']            = $data['pilihnis'];
        $db['kd_mp']          = $data['kdMpPsk'];
        if($db['kd_mp'] == 'PAI') {
          $db['afk_spiritual']  = $data['afk'];
          $db['deskripsi_afk_spiritual']  = $data['deskripsi_afk'];
        } elseif($db['kd_mp'] == 'PKN') {
          $db['afk']  = $data['afk'];
          $db['deskripsi_afk']  = $data['deskripsi_afk'];
        }

        return $this->db->insert('nl_ips',$db);
    }

    function updateNilaiRaportAfk($data)
    {
        $CI                   = &get_instance();
        $db['kd_sekolah']     = $CI->session->userdata('kd_sekolah');
        $db['th_ajar']        = $CI->session->userdata('th_ajar');
        $db['p_nl']           = $CI->session->userdata('kd_semester');
        $db['sub_pnl']        = $CI->session->userdata('sub_pnl');
        $db['kelas']          = $data['pilihkelas'];
        $db['nis']            = $data['pilihnis'];
        $db['kd_mp']          = $data['kdMpPsk'];

        //update data
        if($db['kd_mp'] == 'PAI') {
          $dbdata = array(
            'afk_spiritual' => $data['afk'],
            'deskripsi_afk_spiritual' => $data['deskripsi_afk']
          ); 
        } elseif($db['kd_mp'] == 'PKN') {
          $dbdata = array(
            'afk' => $data['afk'],
            'deskripsi_afk' => $data['deskripsi_afk']
          ); 
        }
        
        $this->db->where('kd_sekolah',$db['kd_sekolah']);
        $this->db->where('th_ajar',$db['th_ajar']);
        $this->db->where('p_nl',$db['p_nl']);
        $this->db->where('sub_pnl',$db['sub_pnl']);
        $this->db->where('kelas',$db['kelas']);
        $this->db->where('nis',$db['nis']);
        $this->db->where('kd_mp',$db['kd_mp']);

        return $this->db->update('nl_ips', $dbdata);
    }

    function getNilaiRapot($data)
    {
      $CI             = &get_instance();
      $kd_sekolah     = $CI->session->userdata('kd_sekolah');
      $th_ajar        = $CI->session->userdata('th_ajar');
      $p_nl           = $CI->session->userdata('kd_semester');
      $kelas          = $data['pilihkelas'];
      $nis            = $data['pilihnis'];
      $sql =   " SELECT nm_mp, ips.kgn, ips.psk, ips.afk, deskripsi_kgn, deskripsi_psk, deskripsi_afk, deskripsi_afk_spiritual, urutan FROM nl_ips ips
                  LEFT JOIN ms_mp mp
                  ON ips.kd_mp = mp.kd_mp
                  where ips.kd_sekolah = '$kd_sekolah'
                  and ips.th_ajar = '$th_ajar' 
                  and ips.p_nl = '$p_nl'
                  and ips.kelas = '$kelas'
                  and ips.nis = '$nis'
                  ORDER BY urutan ASC";
      $query = $this->db->query($sql); 
      return $query;
    }

    function getrekap($kelas)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');

        $sql            = " select kls.kd_mp, mp.nm_mp, mp.urutan from ms_mp_kelas kls
                            inner join ms_mp mp
                            on kls.kd_mp = mp.kd_mp
                            where kls.kd_sekolah = '$kd_sekolah'
                            and kls.th_ajar = '$th_ajar'
                            and kls.kelas = '$kelas'
                            and kls.semester = '$p_nl'
                            order by mp.urutan asc";
        //echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function get_comment_predikat($data)
    {
      $CI             = &get_instance();
      $kd_sekolah     = $CI->session->userdata('kd_sekolah');
      $th_ajar        = $CI->session->userdata('th_ajar');
      $p_nl           = $CI->session->userdata('kd_semester');
      $sub_pnl        = $CI->session->userdata('sub_pnl');
      $kelas          = $data['pilihkelas'];
      $arr            = array(
                          'kd_sekolah' => $kd_sekolah,
                          'th_ajar' => $th_ajar,
                          'tk' => '2'
                        );
      $this->db->select('nilai, kd_mp, jn_nilai, deskripsi')
               ->from('tlck_template')
               ->where($arr);

      $q = $this->db->get()->result();
      return $q;

    }

    function getkpa_sd($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['pilihkelas'];
        $nis            = $data['pilihnis'];

        $sql            = " select skbm, nm_mp, mp.kd_mp, mpk.kelas, mpk.skbm,
                                 ms.nama_lengkap, nc_pg.nis, ms.ayah_nama
                                , nc_pg.comment as comment_pengetahuan
                                , nc_ket.comment as comment_keterampilan
                                , nc_skp.comment as comment_sikap
                            from ms_mp_kelas mpk
                            inner join ms_mp mp
                            on mpk.kd_mp = mp.kd_mp
                            and mpk.kd_sekolah = mp.kd_sekolah


                            inner join  nl_comment_pengetahuan nc_pg
                            on mpk.kd_sekolah = nc_pg.kd_sekolah
                            and mpk.th_ajar = nc_pg.th_ajar
                            and mpk.semester = nc_pg.p_nl
                            and mpk.kd_mp = nc_pg.kd_mp
                            and nc_pg.nis='$nis'
                            and nc_pg.sub_pnl = 'UTS'

                            left outer join nl_comment_keterampilan nc_ket
                            on mpk.kd_sekolah = nc_ket.kd_sekolah
                            and mpk.th_ajar = nc_ket.th_ajar
                            and mpk.semester = nc_ket.p_nl
                            and mpk.kd_mp = nc_ket.kd_mp
                            and nc_ket.nis='$nis'
                            and nc_ket.sub_pnl = 'UTS'

                            left outer join nl_comment_sikap nc_skp
                            on mpk.kd_sekolah = nc_skp.kd_sekolah
                            and mpk.th_ajar = nc_skp.th_ajar
                            and mpk.semester = nc_skp.p_nl
                            and mpk.kd_mp = nc_skp.kd_mp
                            and nc_skp.nis='$nis'
                            and nc_skp.sub_pnl = 'UTS'

                            left outer join ms_siswa ms
                            on nc_pg.nis = ms.nis

                            where mpk.kd_sekolah ='$kd_sekolah'
                            and mpk.th_ajar ='$th_ajar'
                            and semester = $p_nl
                            and mpk.kelas ='$kelas'
                            and mp.kd_mp ='TEM'";
        $sql            .= " order by mp.urutan ";

        $hasil      = $this->db->query($sql);

        return $hasil;
    }

    function getLck($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kelas          = $data['pilihkelas'];
        $nis            = $data['pilihnis'];
        $tk             = $data['tk'];

        $sql            = " select tgh.kd_mp, tgh.kd_kd, kd.kd_ki, ki.deskripsi, kd.ket_kd,
                            avg(kgn) kgn, avg(psk) psk, avg(afk) afk,avg(uts)uts, avg(uas)uas
                            ,avg(utspsk)utspsk, avg(uaspsk)uaspsk
                            from tgh_siswa tgh
                            inner join ms_mp_kd_dtl kd
                            on tgh.kd_sekolah = kd.kd_sekolah
                            and tgh.th_ajar = kd.th_ajar
                            and tgh.p_nl = kd.kd_semester
                            and tgh.kd_mp = kd.kd_mp
                            and tgh.kd_kd = kd.kd_kd
                            and kd.tk =$tk
                            left outer join ms_mp_ki ki
                            on kd.kd_ki = ki.kd_ki

                            left outer join
                            (
                            	select kd_mp, sum(coalesce(uts,0))uts, sum(coalesce(uas,0))uas
                                ,sum(coalesce(utspsk,0))utspsk, sum(coalesce(uaspsk,0))uaspsk
                            	from
                            	(
                            	select tgh.kd_mp,
                            	'UTS'= case when kd_tagihan='UTS' then avg(kgn) end,
                            	'UAS'= case when kd_tagihan='UAS' then avg(kgn) end,
                                'UTSPSK' = case when kd_tagihan='UTS' then avg(psk) end,
                                'UASPSK' = case when kd_tagihan='UAS' then avg(psk) end
                            	from tgh_siswa tgh
                            	where tgh.kd_sekolah ='$kd_sekolah'
                            	and tgh.th_ajar = '$th_ajar'
                            	and tgh.p_nl = '$p_nl'
                                and tgh.sub_pnl = '$sub_pnl'
                            	and nis = '$nis'
                            	and (kd_tagihan ='UTS' OR kd_tagihan ='UAS')
                            	group by tgh.kd_mp,kd_tagihan
                            	)tbl
                            	group by kd_mp
                            )uji
                            on tgh.kd_mp = uji.kd_mp

                            where tgh.kd_sekolah ='$kd_sekolah'
                            and tgh.th_ajar = '$th_ajar'
                            and tgh.p_nl= '$p_nl'
                            and tgh.sub_pnl=  '$sub_pnl'
                            and nis = '$nis'
                            and (kgn>0 or psk>0)
                            group by tgh.kd_mp, tgh.kd_kd,kd.kd_ki, kd.ket_kd, ki.deskripsi
                            order by kd.kd_ki desc ";
        //echo $sql;die;
        $hasil      = $this->db->query($sql);
        return $hasil;

    }

    function getLedgerMpTabular($data,$kolom,$SumKolom)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['pilihkelas'];

        $sql            = "
                            select tbl.nis, sis.nama_lengkap, $SumKolom
                            from ms_siswa sis
                            inner join kelas_siswa ks
                                on sis.kd_sekolah = ks.kd_sekolah
                                and sis.nis = ks.nis
                                and ks.kd_sekolah ='$kd_sekolah'
                                and ks.th_ajar = '$th_ajar'
                                and ks.kelas = '$kelas'
                            left outer join
                            (
                            select nis,$kolom
                            from tgh_siswa tgh
                            where tgh.kd_sekolah ='$kd_sekolah'
                            and tgh.th_ajar = '$th_ajar'
                            and tgh.sub_pnl= 'UAS'
                            and kelas = '$kelas'
                            group by nis,kd_mp
                            )tbl
                            on tbl.nis = ks.nis
                            group by tbl.nis, sis.nama_lengkap
                            order by tbl.nis";

        $hasil      = $this->db->query($sql);
        return $hasil;

    }

    function getComment($th_ajar, $kd_sekolah, $p_nl,  $nis)
    {
        $sql            = " select comment from nl_comment
                            where kd_sekolah ='$kd_sekolah'
                            and th_ajar ='$th_ajar'
                            and p_nl = $p_nl
                            and nis='$nis'";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function kelas()
    {
        $sql        = " select * from ms_kelas ";
        $hasil      = $this->db->query($sql);
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
        //echo $sql; die();
        $query      = $this->db->query($sql);
        return $query;
    }
    function mp_kelas($pilihkelas)
    {
        $CI         = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        $p_nl       = $CI->session->userdata('kd_semester');

        $sql        = " SELECT kd_mp 
                        FROM ms_mp_kelas
                        WHERE kd_sekolah= '$kd_sekolah' 
                        AND th_ajar = '$th_ajar'
                        AND kelas = '$pilihkelas'
                        AND semester = '$p_nl'";
        // echo $sql; die();
        $query      = $this->db->query($sql);
        return $query;

    }

//======== report nilai 3 Ketercapaian kompetensi siswa ===========//

    function getKKS($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['pilihkelas'];
        $nis            = $data['nis'];

        $sql        = " select  nm_mp, mp.kd_mp, mpk.kelas, kks, nk.nis, ms.nama_lengkap
                        from ms_mp_kelas mpk
                        inner join ms_mp mp
                        	on mpk.kd_mp = mp.kd_mp
                        	and mpk.kd_sekolah = mp.kd_sekolah
                        left outer join nl_kks nk
                        	on mpk.kd_sekolah = nk.kd_sekolah
                        	and mpk.th_ajar = nk.th_ajar
                        	and mpk.kelas = nk.kelas
                        	and mpk.semester = nk.p_nl
                        	and mpk.kd_mp = nk.kd_mp
                        	and nk.nis	='$nis'

                        left outer join ms_siswa ms
                        on nk.nis = ms.nis

                        where mpk.kd_sekolah ='$kd_sekolah'
                        and mpk.th_ajar      ='$th_ajar'
                        and semester         = $p_nl
                        and mpk.kelas        ='$kelas'";

        $query      = $this->db->query($sql);
        return $query;
    }
    function getKKSInput($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];
        $kd_mp          = $data['kd_mp'];

        $sql        = " select  nm_mp, mp.kd_mp, mpk.kelas, kks, nk.nis, ms.nama_lengkap
                        from ms_mp_kelas mpk
                        inner join ms_mp mp
                        	on mpk.kd_mp = mp.kd_mp
                        	and mpk.kd_sekolah = mp.kd_sekolah
                        left outer join nl_kks nk
                        	on mpk.kd_sekolah = nk.kd_sekolah
                        	and mpk.th_ajar = nk.th_ajar
                        	and mpk.kelas = nk.kelas
                        	and mpk.semester = nk.p_nl
                        	and mpk.kd_mp = nk.kd_mp
                        left outer join ms_siswa ms
                        on nk.nis = ms.nis

                        where mpk.kd_sekolah ='$kd_sekolah'
                       	and nk.nis	         ='$nis'
                        and mpk.th_ajar      ='$th_ajar'
                        and semester         = $p_nl
                        and mp.kd_mp         ='$kd_mp'
                        and mpk.kelas        ='$kelas'";

        $query      = $this->db->query($sql);
        return $query;
    }
    function simpan($data)
    {
        return $this->db->insert('nl_kks',$data);
    }
    function update($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('kd_mp',$data['kd_mp']);

        $this->db->set('kks',$data['kks']);
        return $this->db->update('nl_kks');
    }


//======== report nilai 2 ===========//
    function getkaryatulis($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        //$p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];
        $sql            = " select * from nl_karyatulis
                            where kd_sekolah = '$kd_sekolah'
                            and th_ajar	= '$th_ajar'
                            and kelas	= '$kelas'
                            and nis		= '$nis'";
        $query     = $this->db->query($sql);
        return $query;
    }
    function geteskul($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        $sql        = " select nm_eskul, hasil from nl_eskul ne
                        inner join ms_eskul me
                        on ne.kd_eskul = me.kd_eskul
                        where kd_sekolah = '$kd_sekolah'
                        and th_ajar	 = '$th_ajar'
                        and p_nl	= $p_nl
                        and kelas	= '$kelas'
                        and nis		= '$nis'
                        and rtrim(hasil) <> ''";
                        //echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function gettinggibadan($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        $sql        = " select COALESCE(hasil_1.p_nl, hasil_2.p_nl) p_nl ,COALESCE(hasil_1.nm_kesehatan, hasil_2.nm_kesehatan) nm_kesehatan, COALESCE(hasil_1.HS1,hasil_2.HS2) hasil
                        from nl_kesehatan nl 
                        inner join ms_kesehatan me 
                        on nl.kd_kesehatan = me.kd_kesehatan";

        $sql.= " left outer join
                        ( select p_nl,nm_kesehatan, hasil HS1
                        from nl_kesehatan ne 
                        inner join ms_kesehatan me 
                        on ne.kd_kesehatan = me.kd_kesehatan 
                        where kd_sekolah = '$kd_sekolah' 
                        and th_ajar = '$th_ajar' 
                        and p_nl = 1
                        and kelas = '$kelas' 
                        and nis = '$nis' 
                        and rtrim(hasil) <> '' 
                        and kategori = 'Tinggi dan Berat Badan'
                        ) hasil_1 on nl.p_nl = hasil_1.p_nl

                        left outer join
                        (select p_nl,nm_kesehatan, hasil HS2
                        from nl_kesehatan ne 
                        inner join ms_kesehatan me 
                        on ne.kd_kesehatan = me.kd_kesehatan 
                        where kd_sekolah = '$kd_sekolah' 
                        and th_ajar = '$th_ajar' 
                        and p_nl = 2
                        and kelas = '$kelas' 
                        and nis = '$nis' 
                        and rtrim(hasil) <> '' 
                        and kategori = 'Tinggi dan Berat Badan'
                        ) hasil_2 on nl.p_nl = hasil_2.p_nl

                        where kd_sekolah = '$kd_sekolah' 
                        and th_ajar = '$th_ajar' 
                        and kelas = '$kelas' 
                        and nis = '$nis' 
                        and rtrim(hasil) <> '' 
                        and me.kategori = 'Tinggi dan Berat Badan'
                        and me.nm_kesehatan = 'Tinggi Badan'";

                        // echo $sql; die();
        $hasil      = $this->db->query($sql)->result_array();
        return $hasil;
    }
    function gettinggibadan_sem1($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        $sql        = " select nm_kesehatan, hasil from nl_kesehatan ne
                        inner join ms_kesehatan me
                        on ne.kd_kesehatan = me.kd_kesehatan
                        where kd_sekolah = '$kd_sekolah'
                        and th_ajar  = '$th_ajar'
                        and kelas   = '$kelas'
                        and nis     = '$nis'
                        and rtrim(hasil) <> ''
                        and kategori = 'Tinggi dan Berat Badan'
                        order by p_nl asc";
                        // echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getkesehatan($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        $sql        = " select nm_kesehatan, hasil from nl_kesehatan ne
                        inner join ms_kesehatan me
                        on ne.kd_kesehatan = me.kd_kesehatan
                        where kd_sekolah = '$kd_sekolah'
                        and th_ajar  = '$th_ajar'
                        and p_nl    = $p_nl
                        and kelas   = '$kelas'
                        and nis     = '$nis'
                        and rtrim(hasil) <> ''
                        and kategori = 'Kondisi Kesehatan'
                        order by tgl_tambah";
                        //echo $sql; die();
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getabsena($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        $sql        = " select count(absen) alfa from siswa_absen
                        where absen     = 'a'
                        and kd_sekolah  = '$kd_sekolah'
                        and th_ajar	    = '$th_ajar'
                        and p_nl	    = $p_nl
                        and kode_kelas	= '$kelas'
                        and nis		    = '$nis' ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getabsens($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        $sql        = " select count(absen) alfa from siswa_absen
                        where absen     = 's'
                        and kd_sekolah  = '$kd_sekolah'
                        and th_ajar	    = '$th_ajar'
                        and p_nl	    = $p_nl
                        and kode_kelas	= '$kelas'
                        and nis		    = '$nis' ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getabseni($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['kelas'];
        $nis            = $data['nis'];

        $sql        = " select count(absen) alfa from siswa_absen
                        where absen     = 'i'
                        and kd_sekolah  = '$kd_sekolah'
                        and th_ajar	    = '$th_ajar'
                        and p_nl	    = $p_nl
                        and kode_kelas	= '$kelas'
                        and nis		    = '$nis' ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function getpribadi($data)
    {
        $CI         = &get_instance();
        $kd_sekolah = $CI->session->userdata('kd_sekolah');
        $th_ajar    = $CI->session->userdata('th_ajar');
        $p_nl       = $CI->session->userdata('kd_semester');
        $kelas      = $data['kelas'];
        $nis        = $data['nis'];

        $sql        = " select *, ket_pribadi from nl_pribadi nl
                        inner join ref_pribadi ref
                        on nl.kd_pribadi = ref.kd_pribadi
                        where kd_sekolah = '$kd_sekolah'
                        and th_ajar 	= '$th_ajar'
                        and p_nl	= $p_nl
                        and kelas	= '$kelas'
                        and nis 	= '$nis' ";
        $hasil      = $this->db->query($sql);
        return $hasil;
    }
    function simpannl($data)
    {
        return $this->db->insert('nl_ips',$data);
    }
    function updatenl($data)
    {
        $this->db->where('kd_sekolah',$data['kd_sekolah']);
        $this->db->where('th_ajar',$data['th_ajar']);
        $this->db->where('p_nl',$data['p_nl']);
        $this->db->where('kelas',$data['kelas']);
        $this->db->where('nis',$data['nis']);
        $this->db->where('kd_mp',$data['kd_mp']);

        $this->db->set('kgn',$data['kgn']);
        return $this->db->update('nl_ips');
    }
	function getnilai_mulok($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $sub_pnl        = $CI->session->userdata('sub_pnl');
        $kd_tagihan     = $CI->session->userdata('kd_tagihan');
        $kelas          = $data['pilihkelas'];
        $nis            = $data['pilihnis'];

        $sql            = " select tgh.kd_mp, nm_mp, tgh.kgn from tgh_siswa tgh
                            inner join ms_mp mp
                            on tgh.kd_mp = mp.kd_mp
                            and tgh.kd_sekolah = mp.kd_sekolah
                           where th_ajar = '$th_ajar'
                           and p_nl = '$p_nl'
                           and kd_tagihan = 'MULOK'
                           and sub_pnl = 'UAS'
                           and nis = '$nis'
                           ";

        $hasil      = $this->db->query($sql);

        return $hasil;
    }
	function getKompetensi($data)
    {
        $CI             = &get_instance();
        $kd_sekolah     = $CI->session->userdata('kd_sekolah');
        $th_ajar        = $CI->session->userdata('th_ajar');
        $p_nl           = $CI->session->userdata('kd_semester');
        $kelas          = $data['pilihkelas'];
        $nis            = $data['pilihnis'];


        $sql            = " select nm_mp, mp.kd_mp, mpk.kelas, mpk.skbm, ms.nama_lengkap, nc.nis, ms.ayah_nama, deskripsi
                            from ms_mp_kelas mpk
                            inner join ms_mp mp
                            on mpk.kd_sekolah = mp.kd_sekolah
                            and mpk.kd_mp = mp.kd_mp

                            left outer join nl_kompetensi nc
                            on mpk.kd_sekolah = nc.kd_sekolah
                            and mpk.th_ajar = nc.th_ajar
                            and mpk.semester = nc.p_nl

                            and nc.nis='$nis'

                            left outer join ms_siswa ms
                            on nc.nis = ms.nis

                            where mpk.kd_sekolah ='$kd_sekolah'
                            and mpk.th_ajar ='$th_ajar'
                            and semester = $p_nl
                            and mpk.kelas ='$kelas' ";
        $sql            .= " order by mp.urutan ";
        $hasil      = $this->db->query($sql);
        //echo $sql; die();
        return $hasil;
    }
}
?>
