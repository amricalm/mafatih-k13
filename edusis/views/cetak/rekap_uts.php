<html>
<head>
    <title>Ledger UTS</title>
</head>
<body>
<?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS';?>
<table style="width: 100%;font-size: 10x;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" rowspan="4" ><img src="edusis_asset/edusisimg/mafatih.jpg"/></td>
        <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $sekolah->row()->nama_sekolah ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>DAFTAR NILAI REKAP <?php echo $q;?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2" >&nbsp;</td>
    </tr>
    <tr>
        <td style="width:14%;font-size: 9px;">Nama Sekolah<br /></td>
        <td style="width:1%;font-size: 9px;">:<br /></td>
        <td style="width:89%;font-size: 9px;"><?php echo $sekolah->row()->nama_sekolah; ?><br /></td>
    </tr>
    <tr>
        <td style="font-size: 9px;">Kelas<br /><br /></td>
        <td style="font-size: 9px;">:<br /><br /></td>
        <td style="font-size: 9px;"><?php echo str_replace('+',' ',$this->uri->segment(3)); ?><br /><br /></td>
    </tr>
</table>
<table style=" border-collapse:collapse; size: landscape; font-size: 8px;"  width="100%" align="center" border="1" align="center%" cellpadding="0">
        <tr  style="background: #E1E1E1;" >
            <th rowspan="2" style="width:1.5%; ">NO</th>
            <th rowspan="2" style="width:5%">NO.INDUK</th>
            <th rowspan="2" style="width:13%">NAMA SISWA</th>
            <?php 
                $this->load->helper('adn_text_helper');
                $seq = 1;
                foreach($mp->result() as $row)
                {
                    echo '<th colspan="4" width="4%">'.$row->nm_mp.'</th>';
                    $seq++;
                }
                echo '<th rowspan="2">Rata-rata</th>';
            ?>
        </tr>
        <tr  style="background: #E1E1E1;" >
            <?php 
                $this->load->helper('adn_text_helper');
                $seq = 1;
                foreach($mp->result() as $row)
                {
                    echo '<th width="1%">TGS</th>';
                    echo '<th width="1%">UH</th>';
                    echo '<th width="1%">'.$q.'</th>';
                    echo '<th width="1%">NR</th>';
                    $seq++;
                }
            ?>
        </tr>
            <?php
            $seq    = 1;
            $nama   = $this->siswa_model->nama(str_replace('+',' ',$this->uri->segment(3)));
            $nilai      = array();      
            foreach($nama->result() as $row)
            {
                $bg = ($seq%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$seq.'</td>';
                echo '<td align="center">'.$row->nis.'</td>';
                echo '<td>&nbsp;&nbsp;'.$row->nama_lengkap.'</td>';
                $j = 0;
                $jmlnr[$seq]                  = 0;
                foreach($mp->result() as $rowmp)
                {
                    $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
                    $data['th_ajar']        = $this->session->userdata('th_ajar');
                    $data['p_nl']           = $this->session->userdata('kd_semester');
                    $data['sub_pnl']        = $this->session->userdata('sub_pnl');
                    $data['kelas']          = str_replace('+',' ',$this->uri->segment(3));
                    $data['kd_mp']          = $rowmp->kd_mp;
                    $data['nis']            = $row->nis;
                    $var_array              = $this->hasilbelajar_model->Get_Nilai($data);
                        //echo $this->db->last_query();
                        //die();
                        $TGS                    = 0;
                        $Na                     = 0;
                        $UH                     = 0;
                        $jumlahNaUH             = 0;
                        $jumlahNa               = 0;
                        $jumlahUH               = 0;
                        $NaUH                   = 0;
                        $UTS                    = 0;
                        $NR                     = 0;
                        $jumlahTGS              = 0;
                        $jumlahUTST             = 0;
                        $jumlahUTSP             = 0;
                        $NR1                    = 0;
                        $NR2                    = 0;
                        $NR3                    = 0;
                        if($var_array->num_rows()>0)
                        {
                            //print_r($var_array->result_array());
                            $arrayvar = $var_array->result_array();
                            for($g=0;$g<count($arrayvar);$g++)
                            {
                                if(strpos($arrayvar[$g]['kd_tagihan'],'UHT')!==false)
                                {
                                    $Na         += $arrayvar[$g]['kgn'];
                                    $jumlahNa   = ($arrayvar[$g]['kgn']!='0'&&$arrayvar[$g]['kgn']!='') ? $jumlahNa+1 : $jumlahNa;
                                    $UH         += $arrayvar[$g]['psk'];
                                    $jumlahUH   = ($arrayvar[$g]['psk']!='0'&&$arrayvar[$g]['psk']!='') ? $jumlahUH+1 : $jumlahUH;
                                }
                                elseif(strpos($arrayvar[$g]['kd_tagihan'],'TGS')!==false)
                                {
                                    $TGS        += $arrayvar[$g]['kgn'];
                                    $jumlahTGS  = ($arrayvar[$g]['kgn']!='0'&&$arrayvar[$g]['kgn']!='') ? $jumlahTGS+1 : $jumlahTGS;
                                }
                                elseif(strpos($arrayvar[$g]['kd_tagihan'],'UTS')!==false)
                                {
                                    $UTST       = $arrayvar[$g]['kgn'];
                                    $UTSP       = $arrayvar[$g]['psk'];
                                    $jumlahUTST = ($arrayvar[$g]['kgn']!='0'&&$arrayvar[$g]['kgn']!='') ? 1 : 0;
                                    $jumlahUTSP = ($arrayvar[$g]['psk']!='0'&&$arrayvar[$g]['psk']!='') ? 1 : 0;
                                }
                            }
                            $jNa                = ($jumlahNa!=0) ? ($Na/$jumlahNa) : 0;
                            $jUH                = ($jumlahUH!=0) ? ($UH/$jumlahUH) : 0;
                            $NaUH               = ($jNa+$jUH)/2;
                            $NR1                = $NaUH*0.3;
                            $TGS                = ($jumlahTGS!=0) ? $TGS/$jumlahTGS : 0;
                            $NR2                = ($TGS)*0.3;
                            $UTS                = (($jumlahUTST+$jumlahUTSP)!=0) ? ($UTST+$UTSP)/($jumlahUTST+$jumlahUTSP) : 0;
                            $NR3                = ($UTS)*0.4;              
                            $NR                 = $NR1+$NR2+$NR3;
                        }
                        //echo strstr($rowvar_array->kd_tagihan,'TGS');
                        echo '<td align="center">'.round($TGS).'</td>';
                        echo '<td align="center">'.round($NaUH).'</td>';
                        echo '<td align="center">'.round($UTS).'</td>';
                        echo '<td align="center">'.round($NR).'</td>';
                        $jmlnr[$seq] += $NR;
                        $j++;
                    }
                    $m = ($j!=0) ? $jmlnr[$seq]/$j : '';
                    echo '<td align="center">'.round($m,1).'</td>';
                    echo '</tr>';
                    $seq++;
               } 
            ?>
</table>
<br />
<table style="font-size: 11px;" align="center" border="0" width="100%" >
<tr>
    <td width="2%">&nbsp;</td>
    <td width="78%">
    <table style="font-size: 11px;">
        <tr>
            <td align="left">Mengetahui,</td>
        </tr>
        <tr>
        	<td align="left"><b>Kepala <?php echo $sekolah->row()->nama_sekolah ?></b><br /><br /></td>
        </tr>
        <tr>
        	<td align="left"><u><?php echo $kepsek->row()->nama_lengkap;?></u></td>
        </tr>
        <tr>
        	<td align="left">NIP. <?php echo $kepsek->row()->nip; ?></td>
        </tr>
    </table>
    </td>
    <td width="20%">
    <table style="font-size: 11px;">
        <tr>
            <td align="left"><?php echo $sekolah->row()->kabupaten;?>, <?php $arraytgl = $this->app_model->tgl(); $pilihtgl = date('d'); $pilihbln = date('m');;$pilihth = date('y'); echo $pilihtgl ;echo ' - '; echo $pilihbln; echo ' - ';echo '20'; echo $pilihth;?></td>
        </tr>
        <tr>
        	<td align="left"><b>Wali Kelas</b><br /><br /></td>
        </tr>
        <tr>
        	<td align="left"><u><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></u></td>
        </tr>
        <tr>
        	<td align="left">NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?></td>
        </tr>
    </table>
    </td>
</tr>
</table>
</body>
</html>