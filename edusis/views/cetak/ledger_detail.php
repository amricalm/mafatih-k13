<html>
<head>
    <title>Ledger UTS</title>
    <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
    <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" />
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
        <td style="width:10%;font-size: 9px;">Nama Sekolah<br /></td>
        <td></td>
        <td style="width:89%;font-size: 9px;"><?php echo ': ' . $sekolah->row()->nama_sekolah; ?><br /></td>
    </tr>
    <tr>
        <td style="font-size: 9px;">Kelas<br /><br /></td>
        <td style="font-size: 9px;"></td>
        <td style="font-size: 9px;"><?php echo ': ' .  str_replace('+',' ',$this->uri->segment(3)); ?><br /><br /></td>
    </tr>
</table>
<table style=" border-collapse:collapse; size: landscape; font-size: 8px;"  width="100%" align="center" border="1" align="center%" cellpadding="0">
        <tr>
            <th style="width:5px; height: 25px;">NO</th>
            <th style="width:10px">NO.INDUK</th>
            <th style="width:150px">NAMA SISWA</th>   
        
            <?php 
                $this->load->helper('adn_text_helper');
                $seq = 1;
               
                    foreach($mp->result() as $row)
                    {
                        echo '<th>'.$row->kd_mp.'</th>';
                        $seq++;
                    }
                    echo '<th>JMH</th>';                        
                    echo '<th>NR</th>';                        
                
                
            ?>
        </tr>
            <?php
            $seq = 1;
                foreach($nilai as $isi)
                {
                    $bg = ($seq%2==0) ? ' class="bg" ' : '';
                    echo '<tr'.$bg.'>';
                    echo '<td align="center">'.$seq.'</td>';
                    echo '<td>'.$isi['nis'].'</td>';
                    echo '<td>&nbsp;&nbsp;'.$isi['nm'].'</td>';
                    $j = 0;
                    $jmlnr[$seq]                  = 0;
                    $nr = 0;
                     //print_r($mp->result());die();
                    foreach($mp->result() as $rowmp)
                    {
                        echo '<td align="center">'.
                                  round($isi['mp'][$j]['tgh']['RFINAL']).
                              '</td>';
                        $nr = $nr + $isi['mp'][$j]['tgh']['RFINAL'];
                        $j++;
                    }
                    if ($j==0)$j=1;
                    echo '<td align="center">' . round($nr). '</td>';
                    echo '<td align="center">' . round($nr/$j). '</td>';
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