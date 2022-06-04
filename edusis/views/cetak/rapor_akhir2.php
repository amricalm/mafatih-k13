<html>
<head>
    <title>Ledger UTS</title>
</head>
<body>
<table style="width: 95%;font-size: 11px;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" rowspan="4" ><img src="edusis_asset/edusisimg/mafatih.jpg"/></td>
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
    <?php $a=''; if($kkm->num_rows()>0){ $a = ($kkm->row()->skbm == '' || $kkm->row()->skbm == '0') ? '' : $kkm->row()->skbm;}?>
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
        		<th width="8%" style="font-size:12px ;">KKM=<?php echo $a;?></th>
        	    <th width="8%" style="font-size:12px ;">KKM=<?php echo $a;?></th>
        	</tr> 
         <?php 
            $i  = 1;
            if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') { 
            foreach($nilai as $row)
            {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$i.'</td>';
                echo '<td align="center">'.$row['nis'].'</td>';
                echo '<td>&nbsp;&nbsp;'.$row['nm'].'</td>';
                echo '<td align="center"><b>'.$row['tgh']['UH'].'</b></td>';
                echo '<td align="center"><b>'.$row['tgh']['TGS'].'</b></td>';
                echo '<td align="center"><b font-color="blue">'.$row['tgh']['UTS'].'</td>';
                
                echo '<td align="center"><b>';
                echo ($row['tgh']['RUTS'] < $a) ? '<font color="red">' : '<font color="black">';
                echo $row['tgh']['RUTS'].'</font></b></td>';                
                
                echo '<td align="center"><b>'.$row['tgh']['UHA'].'</b></td>';
                echo '<td align="center"><b>'.$row['tgh']['TGSA'].'</b></td>';
                echo '<td align="center"><b font-color="blue">'.$row['tgh']['UTSA'].'</td>';
                echo '<td align="center"><b>';
                echo ($row['tgh']['RUAS'] < $a) ? '<font color="red">' : '<font color="black">';
                echo $row['tgh']['RUAS'].'</font></b></td>';
                
                echo '<td align="center"><b>';
                echo ($row['tgh']['RFINAL'] < $a) ? '<font color="red">' : '<font color="black">';
                echo $row['tgh']['RFINAL'].'</font></b></td>';
                
                $sum[$i] = $row['tgh']['RFINAL'];
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
        <!-- end table hsil study -->
  
<table style="font-size: 11px;" align="center" border="0" width="100%">
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