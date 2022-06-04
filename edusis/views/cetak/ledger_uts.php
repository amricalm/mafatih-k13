<?php
function konversi_sikap($tmp)
{
    $predikat = "";
                if($tmp==0){
                    $predikat = '';
                }
                elseif($tmp<=25){
                    $predikat = 'K';
                }elseif ($tmp<=50){
                    $predikat = 'C';
                }elseif ($tmp<=75){
                    $predikat = 'B';
                }elseif ($tmp<=100){
                    $predikat = 'SB';
                }
    return $predikat;
}
?>

<html>
<head>
    <title>Ledger UTS</title>
</head>
<body>
<table style="width: 100%;font-size: 11px;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" rowspan="4" ><img src="edusis_asset/edusisimg/logo.jpg" style="width: 60px;"/></td>
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
        <td style="width:14%;font-size: 11px;"><br/>Mata Pelajaran<br /></td>
        <td style="width:1%;font-size: 11px;">:<br /></td>
        <td style="width:89%;font-size: 11px;"><?php echo $mp->row()->nm_mp; ?><br /></td>
    </tr>
    <tr>
        <td style="font-size: 11px;">Kelas<br /><br /></td>
        <td style="font-size: 11px;">:<br /><br /></td>
        <td style="font-size: 11px;"><?php echo str_replace('+',' ',$this->uri->segment(3)); ?><br /><br /></td>
    </tr>
</table>
<!-- Table dari App -->
        <table style=" border-collapse:collapse; size: landscape; font-size: 11px; " align="center" border="1" align="center%" width="100%" cellpadding="0">
        	<tr>
        		<th rowspan="2" width="2%">NO</th>
        		<th rowspan="2" width="5%">NO.INDUK</th>
        		<th rowspan="2" width="25%">NAMA SISWA</th>
        		<th colspan="8" width="75%">NILAI SIKAP</th></tr>
        	<tr>
        		<th style="font-size:11px ;" width="2%">DIRI</th>
        		<th style="font-size:11px ;" width="2%">TEMAN</th>
        		<th style="font-size:11px ;" width="2%">JURNAL</th>
        		<th style="font-size:11px ;" width="2%">OBS</th>
        		<th style="font-size:11px ;" width="2%">RAPORT</th>
                <th style="font-size:11px ;" width="2%">KON</th>
                <th style="font-size:11px ;" width="2%">PRE</th>
                <th style="font-size:11px ;" width="54%">DESKRIPSI SIKAP SOSIAL - SPIRITUAL</th>
        	</tr>
            <?php 
            $i  = 1;
            if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') { 
            foreach($hasilbelajar->result() as $row)
            {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$i.'</td>';
                echo '<td align="left">'.$row->nis.'</td>';
                echo '<td>'.$row->nama_lengkap.'</td>';
                
                echo '<td align="center" style="font-size:11px ;">80</td>';   
                echo '<td align="center" style="font-size:11px ;">70</td>';
                echo '<td align="center" style="font-size:11px ;">65</td>';
                echo '<td align="center" style="font-size:11px ;">70</td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">71</font></b></td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">2.33</font></b></td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">C+</font></b></td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">Capaiannya Sudah Sesuai Kompetensi</font></b></td>';
                echo '</tr>';
              }
              }  
            ?>
        </table>
<!-- End Table dari APP -->
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
<!-- Tabel Hasil Study -->
<table style=" border-collapse:collapse; size: landscape; font-size: 11px; " align="center" border="1" align="center%" width="100%" cellpadding="0">
        	<tr>
        		<th rowspan="3" width="2%">NO</th>
        		<th rowspan="3" width="5%">NO.INDUK</th>
        		<th rowspan="3" width="14%">NAMA SISWA</th>
        		<th colspan="16">NILAI KETERAMPILAN</th>
          </tr>
        	<tr>
        		<th colspan="4" style="font-size:11px ;">PRAKTEK</th>
        		<th colspan="4" style="font-size:11px ;">PORTOFOLIO</th>
                <th colspan="4" style="font-size:11px ;">PROYEK</th>
        		<th rowspan="2" style="font-size:11px ;" width="2%">RPT</th>
                <th colspan="2" style="font-size:11px ;" width="2%">LCKPD</th>
                <th rowspan="2" style="font-size:11px ;" width="15%">DESKRIPSI KETERAMPILAN</th>
        	</tr>
        	<tr>
        		<th width="2%" style="font-size:11px ;">1</th>
        		<th width="2%" style="font-size:11px ;">2</th>
        		<th width="2%" style="font-size:11px ;">3</th>
        		<th width="2%" style="font-size:11px ;">RT1</th>
        		<th width="2%" style="font-size:11px ;">1</th>
                <th width="2%" style="font-size:11px ;">2</th>
        		<th width="2%" style="font-size:11px ;">3</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                <th width="2%" style="font-size:11px ;">1</th>
        		<th width="2%" style="font-size:11px ;">2</th>
        		<th width="2%" style="font-size:11px ;">3</th>
        		<th width="2%" style="font-size:11px ;">RT3</th>
                <th width="2%" style="font-size:11px ;">KON</th>
                <th width="2%" style="font-size:11px ;">PRE</th>
       	</tr>
            <?php 
            $i  = 1;
            if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') { 
            foreach($hasilbelajar->result() as $row)
            {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$i.'</td>';
                echo '<td align="left">'.$row->nis.'</td>';
                echo '<td>'.$row->nama_lengkap.'</td>';
                
                echo '<td align="center" style="font-size:11px ;">90</td>';   
                echo '<td align="center" style="font-size:11px ;">80</td>';
                echo '<td align="center" style="font-size:11px ;">70</td>';
                echo '<td align="center" style="font-size:11px ;">80<font color="blue"></font></td>';
                echo '<td align="center" style="font-size:11px ;">60</td>';
                echo '<td align="center" style="font-size:11px ;">0</td>';
                echo '<td align="center" style="font-size:11px ;">0</td>';
                echo '<td align="center" style="font-size:11px ;">60<font color="blue"></font></td>';
                echo '<td align="center" style="font-size:11px ;">90</td>';
                echo '<td align="center" style="font-size:11px ;">0</td>';
                echo '<td align="center" style="font-size:11px ;">0</td>';
                echo '<td align="center" style="font-size:11px ;">90<font color="blue"></font></td>';
                echo '<td align="center" style="font-size:11px ;">77<b><font color="blue"></font></b></td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">2.66</font></b></td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">B-</font></b></td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">Tampil, Keran</font></b></td>';
                echo '</tr>';
            }
            }
            ?>
        </table>
        <!-- end table hasil study keterampilan -->
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
<br><br>
<!-- Hasil Study Pengetahuan -->
<table style=" border-collapse:collapse; size: landscape; font-size: 11px; " align="center" border="1" align="center%" width="100%" cellpadding="0">
        	<tr>
        		<th rowspan="3" width="2%">NO</th>
        		<th rowspan="3" width="5%">NO.INDUK</th>
        		<th rowspan="3" width="14%">NAMA SISWA</th>
        		<th colspan="18">NILAI PENGETAHUAN</th></tr>
        	<tr>
        		<th colspan="4" style="font-size:11px ;">TUGAS </th>
        		<th colspan="7" style="font-size:11px ;">NILAI HARIAN</th>
        		<th rowspan="2" style="font-size:11px ;" width="2%">60% UH</th>
        		<th rowspan="2" style="font-size:11px ;" width="2%">UTS</th>
        		<th rowspan="2" style="font-size:11px ;" width="2%">20% UTS</th>
        		<th rowspan="2" style="font-size:11px ;" width="2%">RPT</th>
        		<th colspan="2" style="font-size:11px ;" width="2%">LCKPD</th>
                <th rowspan="2" style="font-size:11px ;" width="12%">DESKRIPSI PENGETAHUAN</th>
        	</tr>
        	<tr>
        		<th width="2%" style="font-size:11px ;">1</th>
        		<th width="2%" style="font-size:11px ;">2</th>
        		<th width="2%" style="font-size:11px ;">3</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
        		<th width="2%" style="font-size:11px ;">KD1</th>
                <th width="2%" style="font-size:11px ;">REM</th>
        		<th width="2%" style="font-size:11px ;">KD2</th>
                <th width="2%" style="font-size:11px ;">REM</th>
        		<th width="2%" style="font-size:11px ;">KD3</th>
                <th width="2%" style="font-size:11px ;">REM</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                <th width="2%" style="font-size:11px ;">KON</th>
                <th width="2%" style="font-size:11px ;">PRE</th>
       		</tr>
            <?php 
            $i  = 1;
            if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') { 
            foreach($hasilbelajar->result() as $row)
            {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$i.'</td>';
                echo '<td align="left">'.$row->nis.'</td>';
                echo '<td>'.$row->nama_lengkap.'</td>';
                
                echo '<td align="center" style="font-size:11px ;">'.$row->TGS1.'</td>';   
                echo '<td align="center" style="font-size:11px ;">'.$row->TGS2.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->TGS3.'</td>';
                
                $TGS = $row->TGS1 + $row->TGS2 + $row->TGS3;
                
                $h = ($row->TGS1 == '0' || $row->TGS1 == '' ) ? '0' : 1;
                $l = ($row->TGS2 == '0' || $row->TGS2 == '' ) ? '0' : 1;
                $j = ($row->TGS3 == '0' || $row->TGS3 == '' ) ? '0' : 1;
                $k = $h + $l + $j;
                
                $RT1    = round(($k==0) ? 0 : $TGS/$k);
                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT1.'</font></td>';
                
                echo '<td align="center" style="font-size:11px ;">'.$row->UHT1.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->REM1.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->UHT2.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->REM2.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->UHT3.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->REM3.'</td>';
                
                $UHT = $row->UHT1 + $row->UHT2 + $row->UHT3;
                
                $hi = ($row->UHT1 == '0' || $row->UHT1 == '' ) ? '0' : 1;
                $li = ($row->UHT2 == '0' || $row->UHT2 == '' ) ? '0' : 1;
                $ji = ($row->UHT3 == '0' || $row->UHT3 == '' ) ? '0' : 1;
                $ki = $hi + $li + $ji;
                
                $RT2    = round(($ki==0) ? 0 : $UHT/$ki);              
                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT2.'</font></td>';
                
				$his = ($RT1 == '0' || $RT1 == '' ) ? '0' : 1;
                $lis = ($RT2 == '0' || $RT2 == '' ) ? '0' : 1;
                $kis = $his + $lis;
				$NaUH   = ($kis==0) ? 0 : (round(($RT1 + $RT2) / $kis));              
                //$NaUH   = round(($RT1 + $RT2) / 2);
                //echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$NaUH.'</font></b></td>';
                $BBT1   = round($NaUH * 0.60);
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT1.'</font></b></td>';
                    

                if($this->session->userdata('sub_pnl')=='UTS')
                {
                    echo '<td align="center" style="font-size:11px ;">'.$row->UTS.'</td>';
                    $BBT2   = round($row->UTS * 0.40);
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT2.'</font></b></td>';
                                    
                    $RPT    = $BBT1 + $BBT2 ;
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$RPT.'</font></b></td>';
                }
                else
                {
                    echo '<td align="center" style="font-size:11px ;">'.$row->UTS.'</td>';
                    $BBT2   = round($row->UTS * 0.20);
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT2.'</font></b></td>';
                    
                    echo '<td align="center" style="font-size:11px ;">'.$row->UAS.'</td>';
                    $BBT3   = round($row->UAS * 0.20);
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT3.'</font></b></td>';
                
                    $RPT    = $BBT1 + $BBT2 + $BBT3;
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$RPT.'</font></b></td>';
                }
                

                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'. $RPT*4/100 .'</font></b></td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'. konversi_sikap($RPT) . '</font></b></td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$row->DESKRIPSI.'</font></b></td>';
                //echo ($HSL < $a) ? '<font color="red">' : '<font color="black">';
                
                //echo ''.'</font></b></td>';
                
                
                
                
                
                
                
                
                
                $sum[$i] = $RPT;
                $i++;
                echo '</tr>';
            }
                $ratakelas= (($i-1)==0) ? 0 : array_sum($sum)/($i-1);
            ?>
           <!-- <tr>
                <td>&nbsp;</td>
                <td colspan="2"><b>&nbsp;&nbsp;Rata-rata Kelas</b></td>
                <td colspan="19"></td>
                <td align="center" style="font-size:11px ;"><b style="color: blue;"><?php //echo round($ratakelas,1); ?></b></td>
            </tr>-->
            <?php } ?>
        </table>
        <!-- end table hsil study -->
</body>
</html>