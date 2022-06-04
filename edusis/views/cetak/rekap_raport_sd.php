<html>
<head>
    <title>Ledger UTS</title>
    <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
    <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" />
</head>
<body>
<?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS';?>
<table style="width: 100%;font-size: 11px;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="80%">
            <table>
                <tr>
                    <td align="center" rowspan="4" ><img src="edusis_asset/edusisimg/logo.jpg" style="width: 60px; padding-right: 20px;"/></td>
                    <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $sekolah->row()->nama_sekolah ?></b></td>
                </tr>
                <tr>
                    <td align="left" colspan="2"><b>DAFTAR NILAI REKAP <?php echo $q;?></b></td>
                </tr>
                <tr>
                    <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
                </tr>
            </table>
        </td>
        <td width="20%">
            <table>
                <tr>
                    <td style="font-size:10px;">Kelas</td>
                    <td style="font-size:10px;">:</td>
                    <td style="font-size:10px;"><?php echo str_replace('+',' ',$this->uri->segment(3)); ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table style=" border-collapse:collapse; size: landscape; font-size: 11px;"  width="100%" align="center" border="1" align="center%" cellpadding="0">
        <tr  style="background: #E1E1E1;" >
            <th style="width:2%; ">NO</th>
            <th style="width:5%">NO.INDUK</th>
            <th style="width:15%">NAMA SISWA</th>
            <?php 
                $this->load->helper('adn_text_helper');
                $seq = 1;
                foreach($mp->result() as $row)
                {
                    echo '<th width="3%">' .$row->kd_mp.'</th>';
                    
                    $seq++;
                }
                echo '<th width="3%">JMH</th>';
                echo '<th width="3%">RT2</th>';
                $seq = 1;
            ?>
        </tr>
            <?php
            $seq = 1;    
                foreach($nilai as $isi)
                {  
                    $bg = ($seq%2==0) ? ' class="bg" ' : '';
                    echo '<tr'.$bg.'>';
                    echo '<td align="center">'.$seq.'</td>';
                    echo '<td align="center">'. $isi['nis'] .'</td>';
                    echo '<td>&nbsp;&nbsp;'.$isi['nm'].'</td>';
                    $j = 0;
                    $nilai_rataan   = 0;
                    foreach($mp->result() as $rowmp)
                    {
                        $NA = round($isi['mp'][$j]['tgh']['NA']);
                        $a = $isi['mp'][$j]['kkm'];
                        echo '<td align="center">';
                        if ($NA < $a)
                        {
                            echo '<font color="red">'.$NA.'</font></td>';
                        } else {
                            echo '<font color="black">'.$NA.'</font></td>';
                        }
                        $nilai_rataan = $nilai_rataan + $isi['mp'][$j]['tgh']['NA'];
                        $j++;
                    }
                    echo '<td align="center">'.round($nilai_rataan).'</td>';
                    
                    $m      = round(($j!=0) ? $nilai_rataan/$j : '');
                    echo '<td align="center">'.$m.'</td>';
                    echo '</tr>';
                    $sum[$seq] = $m;
                    $seq++;
               }
               $ratakelas= (($seq-1)==0) ? 0 : array_sum($sum)/($seq-1);
               echo '<tr>
                        <td>&nbsp;</td>
                        <td colspan="2"><b>&nbsp;&nbsp;Rata-rata Kelas</b></td>
                        <td colspan='.($j+1).'>&nbsp;</td>
                        <td align="center"><b>'.round($ratakelas,1).'</b></td>
                    </tr>';    
            ?>
</table>
<table style="font-size: 11px;" align="center" border="0" width="100%" >
<tr>
    <td width="2%">&nbsp;</td>
    <td width="78%">
    <table style="font-size: 11px;">
        <tr>
            <td align="left">Mengetahui,</td>
        </tr>
        <tr>
        	<td align="left"><b>Kepala <?php echo $sekolah->row()->nama_sekolah ?></b><br /><br /><br /><br /><br /></td>
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
        	<td align="left"><b>Wali Kelas</b><br /><br /><br /><br /><br /></td>
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