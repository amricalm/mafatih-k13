<html>
<head>
    <title>Ledger UTS</title>
</head>
<body>
<table style="width: 95%;font-size: 11px;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" rowspan="4" ><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/mafatih.jpg"/></td>
        <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $sekolah->row()->nama_sekolah ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>DAFTAR NILAI HASIL BELAJAR</b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
    </tr>
    
    <tr>
        <td align="left" colspan="2" >&nbsp;</td>
    </tr>
    <tr>
        <td style="width:14%;font-size: 11px;">Mata Pelajaran<br /></td>
        <td style="width:1%;font-size: 11px;">:<br /></td>
        <td style="width:89%;font-size: 11px;"><?php echo $mp->row()->nm_mp; ?><br /></td>
    </tr>
    <tr>
        <td style="font-size: 11px;">Kelas<br /><br /></td>
        <td style="font-size: 11px;">:<br /><br /></td>
        <td style="font-size: 11px;"><?php echo str_replace('+',' ',$this->uri->segment(3)); ?><br /><br /></td>
    </tr>
</table>
<table style=" border-collapse:collapse; size: landscape; font-size: 11px; " align="center" border="1" align="center%" width="100%" cellpadding="0">
    <tr  style="background: #E1E1E1;" >
		<th rowspan="2" width="2%">NO</th>
		<th rowspan="2" width="8%">NO.INDUK</th>
		<th rowspan="2" width="18%">NAMA </th>
		<th rowspan="2" width="8%">NA UH<BR/>30%</th>
		<th rowspan="2" width="8%">NA TUGAS<BR/>30%</th>
		<th rowspan="2" width="8%">NA UTS<BR/>40%</th>
		<th>NA R1</th>
		<th rowspan="2" width="8%">NA UH<BR/>30%</th>
		<th rowspan="2" width="8%">NA TUGAS<BR/>30%</th>
		<th rowspan="2" width="8%">NA UAS<BR/>40%</th>
		<th>NA R2</th>
		<th rowspan="2" width="8%">NR FINAL<BR/>R1 + R2 / 2</th>
	</tr>
	<tr  style="background: #E1E1E1;" >
		<th width="8%" style="font-size:12px ;">KKM=<?php $a=''; if($kkm->num_rows()>0){ $a = ($kkm->row()->skbm == '' || $kkm->row()->skbm == '0') ? '' : $kkm->row()->skbm; echo $a;}?></th>
	    <th width="8%" style="font-size:12px ;">KKM=<?php $a=''; if($kkm->num_rows()>0){ $a = ($kkm->row()->skbm == '' || $kkm->row()->skbm == '0') ? '' : $kkm->row()->skbm; echo $a;}?></th>
	</tr> 
    <?php 
            $i  = 1;
            if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') { 
            foreach($hasilbelajar->result() as $row)
            {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$i.'</td>';
                echo '<td align="center">'.$row->nis.'</td>';
                echo '<td>&nbsp;&nbsp;'.$row->nama_lengkap.'</td>';
                $jmluht     = $row->UHT1 + $row->UHT2 + $row->UHT3;
                $h = ($row->UHT1 == '0' || $row->UHT1 == '' ) ? '0' : 1;
                $l = ($row->UHT2 == '0' || $row->UHT2 == '' ) ? '0' : 1;
                $j = ($row->UHT3 == '0' || $row->UHT3 == '' ) ? '0' : 1;
                $k = $h + $l + $j;
                $RT1        = round(($k==0) ? 0 : $jmluht/$k);
                //$RT1        = $jmluht/3;
                $jmluhp     = $row->UHP1 + $row->UHP2 + $row->UHP3;
                $hi = ($row->UHP1 == '0' || $row->UHP1 == '' ) ? '0' : 1;
                $li = ($row->UHP2 == '0' || $row->UHP2 == '' ) ? '0' : 1;
                $ji = ($row->UHP3 == '0' || $row->UHP3 == '' ) ? '0' : 1;
                $ki = $hi + $li + $ji;
                $RT2        = round(($ki==0) ? 0 : $jmluhp/$ki);              
                //$RT2        = $jmluhp/3;
                $NaUH       = round(($RT1 + $RT2) / 2);
                echo '<td align="center"><b>'.$NaUH.'</b></td>';
                
                $BBT1       = $NaUH * 0.30;
                $jmltgs     = $row->TGS1 + $row->TGS2 + $row->TGS3;
                $ho = ($row->TGS1 == '0' || $row->TGS1 == '' ) ? '0' : 1;
                $lo = ($row->TGS2 == '0' || $row->TGS2 == '' ) ? '0' : 1;
                $jo = ($row->TGS3 == '0' || $row->TGS3 == '' ) ? '0' : 1;
                $ko = $ho + $lo + $jo;
                $RT3        = round(($ko==0) ? 0 : $jmltgs/$ko);
                //$RT3        = round($jmltgs/3);
                echo '<td align="center"><b>'.$RT3.'</b></td>';
                
                $BBT2       = $RT3 * 0.30;
                $jmluts     = $row->UTST + $row->UTSP;
                $ha = ($row->UTST == '0' || $row->UTST == '' ) ? '0' : 1;
                $la = ($row->UTSP == '0' || $row->UTSP == '' ) ? '0' : 1;
                $ka = $ha + $la;
                $RT4        = round(($ka==0) ? 0 : $jmluts/$ka);
                //$RT4        = round($jmluts/2);
                $BBT3       = round($RT4 * 0.40);
                echo '<td align="center"><b font-color="blue">'.$RT4.'</td>';
                
                $HSL        = round($BBT1 + $BBT2 + $BBT3);
                echo '<td align="center"><b>';
                echo ($HSL < $a) ? '<font color="red">' : '<font color="black">';
                echo $HSL.'</font></b></td>';
                
                
                $jmluhtA    = $row->UHTA1 + $row->UHTA2 + $row->UHTA3;
                $hp = ($row->UHTA1 == '0' || $row->UHTA1 == '' ) ? '0' : 1;
                $lp = ($row->UHTA2 == '0' || $row->UHTA2 == '' ) ? '0' : 1;
                $jp = ($row->UHTA3 == '0' || $row->UHTA3 == '' ) ? '0' : 1;
                $kp = $hp + $lp + $jp;
                $RTA1        = round(($kp==0) ? 0 : $jmluhtA/$kp);
                //$RTA1       = $jmluhtA/3;
                $jmluhpA    = $row->UHPA1 + $row->UHPA2 + $row->UHPA3;
                $hiq = ($row->UHPA1 == '0' || $row->UHPA1 == '' ) ? '0' : 1;
                $liq = ($row->UHPA2 == '0' || $row->UHPA2 == '' ) ? '0' : 1;
                $jiq = ($row->UHPA3 == '0' || $row->UHPA3 == '' ) ? '0' : 1;
                $kiq = $hiq + $liq + $jiq;
                $RTA2        = round(($kiq==0) ? 0 : $jmluhpA/$kiq);             
                //$RTA2       = $jmluhpA/3;
                $NaUHA      = round(($RTA1 + $RTA2) / 2);
                echo '<td align="center"><b>'.$NaUHA.'</b></td>';
                
                $BBTA1      = $NaUHA * 0.30;
                $jmltgsA    = $row->TGSA1 + $row->TGSA2 + $row->TGSA3;
                $hor = ($row->TGSA1 == '0' || $row->TGSA1 == '' ) ? '0' : 1;
                $lor = ($row->TGSA2 == '0' || $row->TGSA2 == '' ) ? '0' : 1;
                $jor = ($row->TGSA3 == '0' || $row->TGSA3 == '' ) ? '0' : 1;
                $kor = $hor + $lor + $jor;
                $RTA3        = round(($kor==0) ? 0 : $jmltgsA/$kor);
                //$RTA3       = round($jmltgsA/3);
                echo '<td align="center"><b>'.$RTA3.'</b></td>';
                
                $BBTA2      = $RTA3 * 0.30;
                $jmlutsA    = $row->UTSTA + $row->UTSPA;
                $has = ($row->UTSTA == '0' || $row->UTSTA == '' ) ? '0' : 1;
                $las = ($row->UTSPA == '0' || $row->UTSPA == '' ) ? '0' : 1;
                $kas = $has + $las;
                $RTA4        = round(($kas==0) ? 0 : $jmlutsA/$kas);
                //$RTA4       = $jmlutsA/2;
                $BBTA3      = round($RTA4 * 0.40);
                echo '<td align="center"><b font-color="blue">'.$RTA4.'</td>';
                
                $HSLA       = round($BBTA1 + $BBTA2 + $BBTA3);
                echo '<td align="center"><b>';
                echo ($HSLA < $a) ? '<font color="red">' : '<font color="black">';
                echo $HSLA.'</font></b></td>';
                
                $RTF        = round(($HSL + $HSLA) / 2);
                echo '<td align="center"><b>';
                echo ($RTF < $a) ? '<font color="red">' : '<font color="black">';
                echo $RTF.'</font></b></td>';
                
                $sum[$i] = $RTF;
                $i++;
                echo '</tr>';
            }
                $ratakelas= (($i-1)==0) ? 0 : array_sum($sum)/($i-1);
            
    ?>
    <tr>
        <td>&nbsp;</td>
        <td colspan="2"><b>&nbsp;&nbsp;Rata-rata Kelas</b></td>
        <td colspan="8"></td>
        <td align="center"><b style="color: blue;"><?php echo round($ratakelas); ?></b></td>
    </tr>
            <?php } ?>
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
        	<td align="left"><b>Kelapa Sekolah</b><br /><br /></td>
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
<!--<div class="sembunyi">
    <a href="<?php //echo base_url().'index.php/export/export_to_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>">Inport Pdf</a> |
</div>-->
</body>
</html>