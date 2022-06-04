<?php
function konversi($tmp)
{
    $predikat = "";
    if($tmp<=1.17){
                    $predikat = 'D';
                }elseif ($tmp<=1.50){
                    $predikat = 'D+';
                }elseif ($tmp<=1.84){
                    $predikat = 'C-';
                }elseif ($tmp<=2.17){
                    $predikat = 'C';
                }elseif ($tmp<=2.50){
                    $predikat = 'C+';
                }elseif ($tmp<=2.84){
                    $predikat = 'B-';
                }elseif ($tmp<=3.17){
                    $predikat = 'B';
                }elseif ($tmp<=3.50){
                    $predikat = 'B+';
                }elseif ($tmp<=3.84){
                    $predikat = 'A-';
                }elseif ($tmp<=4){
                    $predikat = 'A';
                }
    return $predikat;
}
function konversi_sma($tmp)
{
    $predikat = "";
                if($tmp==0) {
					$predikat = '-';
				}elseif($tmp<=1.00){
                    $predikat = 'D';
                }elseif ($tmp<=1.33){
                    $predikat = 'D+';
                }elseif ($tmp<=1.66){
                    $predikat = 'C-';
                }elseif ($tmp<=2.00){
                    $predikat = 'C';
                }elseif ($tmp<=2.33){
                    $predikat = 'C+';
                }elseif ($tmp<=2.66){
                    $predikat = 'B-';
                }elseif ($tmp<=3.00){
                    $predikat = 'B';
                }elseif ($tmp<=3.33){
                    $predikat = 'B+';
                }elseif ($tmp<=3.66){
                    $predikat = 'A-';
                }elseif ($tmp<=4.00){
                    $predikat = 'A';
                }
    return $predikat;
}
function konversi_sma_4skala($tmp)
{
    $predikat = "";
                if($tmp==0) {
					$predikat = '-';
				}elseif($tmp<=54){
                    $predikat = '1.00';
                }elseif ($tmp<=59){
                    $predikat = '1.33';
                }elseif ($tmp<=64){
                    $predikat = '1.66';
                }elseif ($tmp<=69){
                    $predikat = '2.00';
                }elseif ($tmp<=74){
                    $predikat = '2.33';
                }elseif ($tmp<=79){
                    $predikat = '2.66';
                }elseif ($tmp<=84){
                    $predikat = '3.00';
                }elseif ($tmp<=90){
                    $predikat = '3.33';
                }elseif ($tmp<=95){
                    $predikat = '3.66';
                }elseif ($tmp<=100){
                    $predikat = '4.00';
                }
    return $predikat;
}

?>
<html>
<head>
    <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" /><!-- WRITE YOUR CSS CODE HERE -->
	<title>Ledger Keterampilan</title>
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
                <th rowspan="3" width="2%">NO</th>
        		<th rowspan="3" width="5%">NO.INDUK</th>
        		<th rowspan="3" width="14%">NAMA SISWA</th>
        		<th colspan="24">NILAI KETERAMPILAN</th>
          </tr>
        	<tr>
        		<th colspan="7" style="font-size:11px ;">PRAKTEK</th>
        		<th colspan="7" style="font-size:11px ;">PORTOFOLIO</th>
                <th colspan="7" style="font-size:11px ;">PROYEK</th>
        		<th rowspan="2" style="font-size:11px ;" width="2%">RPT</th>
                <th colspan="2" style="font-size:11px ;" width="2%">LCKPD</th>
        	</tr>
        	<tr>
        		<th width="2%" style="font-size:11px ;">1</th>
        		<th width="2%" style="font-size:11px ;">2</th>
        		<th width="2%" style="font-size:11px ;">3</th>
                <th width="2%" style="font-size:11px ;">4</th>
        		<th width="2%" style="font-size:11px ;">5</th>
        		<th width="2%" style="font-size:11px ;">6</th>
        		<th width="2%" style="font-size:11px ;">RT1</th>
        		<th width="2%" style="font-size:11px ;">1</th>
                <th width="2%" style="font-size:11px ;">2</th>
        		<th width="2%" style="font-size:11px ;">3</th>
                <th width="2%" style="font-size:11px ;">4</th>
        		<th width="2%" style="font-size:11px ;">5</th>
        		<th width="2%" style="font-size:11px ;">6</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                <th width="2%" style="font-size:11px ;">1</th>
        		<th width="2%" style="font-size:11px ;">2</th>
        		<th width="2%" style="font-size:11px ;">3</th>
                <th width="2%" style="font-size:11px ;">4</th>
        		<th width="2%" style="font-size:11px ;">5</th>
        		<th width="2%" style="font-size:11px ;">6</th>
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
                
                echo '<td align="center" style="font-size:11px ; ">'.$row->PRK1_UTS.'</td>';   
                echo '<td align="center" style="font-size:11px ;">'.$row->PRK2_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->PRK3_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->PRK1.'</td>';   
                echo '<td align="center" style="font-size:11px ;">'.$row->PRK2.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->PRK3.'</td>';
                
                $PRK = $row->PRK1_UTS + $row->PRK2_UTS + $row->PRK3_UTS + $row->PRK1 + $row->PRK2 + $row->PRK3;
                
                $e = ($row->PRK1_UTS == '0' || $row->PRK1_UTS == '' ) ? '0' : 1;
                $f = ($row->PRK2_UTS == '0' || $row->PRK2_UTS == '' ) ? '0' : 1;
                $g = ($row->PRK3_UTS == '0' || $row->PRK3_UTS == '' ) ? '0' : 1;
                $h = ($row->PRK1 == '0' || $row->PRK1 == '' ) ? '0' : 1;
                $l = ($row->PRK2 == '0' || $row->PRK2 == '' ) ? '0' : 1;
                $j = ($row->PRK3 == '0' || $row->PRK3 == '' ) ? '0' : 1;
                $k = $e + $f + $g + $h + $l + $j;
                
                $RT1    = round(($k==0) ? 0 : $PRK/$k);
                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT1.'</font></td>';
                
                echo '<td align="center" style="font-size:11px ;">'.$row->POR1_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->POR2_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->POR3_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->POR1.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->POR2.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->POR3.'</td>';
                
                $POR = $row->POR1_UTS + $row->POR2_UTS + $row->POR3_UTS + $row->POR1 + $row->POR2 + $row->POR3;
                
                $ei = ($row->POR1_UTS == '0' || $row->POR1_UTS == '' ) ? '0' : 1;
                $fi = ($row->POR2_UTS == '0' || $row->POR2_UTS == '' ) ? '0' : 1;
                $gi = ($row->POR3_UTS == '0' || $row->POR3_UTS == '' ) ? '0' : 1;
                $hi = ($row->POR1 == '0' || $row->POR1 == '' ) ? '0' : 1;
                $li = ($row->POR2 == '0' || $row->POR2 == '' ) ? '0' : 1;
                $ji = ($row->POR3 == '0' || $row->POR3 == '' ) ? '0' : 1;
                $ki = $ei + $fi + $gi + $hi + $li + $ji;
                
                $RT2    = round(($ki==0) ? 0 : $POR/$ki);              
                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT2.'</font></td>';
                
                echo '<td align="center" style="font-size:11px ;">'.$row->PRJ1_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->PRJ2_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->PRJ3_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->PRJ1.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->PRJ2.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->PRJ3.'</td>';
                
                $PRJ = $row->PRJ1_UTS + $row->PRJ2_UTS + $row->PRJ3_UTS + $row->PRJ1 + $row->PRJ2 + $row->PRJ3;
                
                $ei = ($row->PRJ1_UTS == '0' || $row->PRJ1_UTS == '' ) ? '0' : 1;
                $fi = ($row->PRJ2_UTS == '0' || $row->PRJ2_UTS == '' ) ? '0' : 1;
                $gi = ($row->PRJ3_UTS == '0' || $row->PRJ3_UTS == '' ) ? '0' : 1;
                $hi = ($row->PRJ1 == '0' || $row->PRJ1 == '' ) ? '0' : 1;
                $li = ($row->PRJ2 == '0' || $row->PRJ2 == '' ) ? '0' : 1;
                $ji = ($row->PRJ3 == '0' || $row->PRJ3 == '' ) ? '0' : 1;
                $ki = $ei + $fi + $gi + $hi + $li + $ji;
                
                $RT3    = round(($ki==0) ? 0 : $PRJ/$ki);              
                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT3.'</font></td>';
                
                
				$his = ($RT1 == '0' || $RT1 == '' ) ? '0' : 1;
                $lis = ($RT2 == '0' || $RT2 == '' ) ? '0' : 1;
                $jis = ($RT3 == '0' || $RT3 == '' ) ? '0' : 1;
                
                $kis = $his + $lis + $jis;
				$NA   = ($kis==0) ? 0 : (round(($RT1 + $RT2 + $RT3) / $kis));                             
                $RPT    = $NA;
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$RPT.'</font></b></td>';
                $empatskala	= konversi_sma_4skala($RPT);
                if ($kd_sekolah=='04')
                {
					echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'. $empatskala .'</font></b></td>';
                } else {
					echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'. $RPT*4/100 .'</font></b></td>';
				}
				echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.konversi($empatskala).'</font></b></td>';
                
                //echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$row->DESKRIPSI.'</font></b></td>';
                //echo ($HSL < $a) ? '<font color="red">' : '<font color="black">';
                
                //echo ''.'</font></b></td>';
                
                
                $sum[$i] = $RPT;
                $i++;
                echo '</tr>';
            }
                $ratakelas= (($i-1)==0) ? 0 : array_sum($sum)/($i-1);
            ?>
            <!--<tr>
                <td>&nbsp;</td>
                <td colspan="2"><b>&nbsp;&nbsp;Rata-rata Kelas</b></td>
                <td colspan="15"></td>
                <td align="center" style="font-size:11px ;"><b style="color: blue;"><?php //echo round($ratakelas,1); ?></b></td>
            </tr>-->
            <?php } ?>
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