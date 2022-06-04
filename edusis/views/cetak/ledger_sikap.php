<?php
function konversi_sikap($tmp)
{
    $predikat = "";
                if($tmp==0){
                    $predikat = '-';
                }elseif($tmp<=37.5){
                    $predikat = 'K';
                }elseif ($tmp<=62.5){
                    $predikat = 'C';
                }elseif ($tmp<=87.5){
                    $predikat = 'B';
                }elseif ($tmp<=100){
                    $predikat = 'SB';
                }
    return $predikat;
}
function konversi_sikap_sma($tmp)
{
    $predikat = "";
                if($tmp==0){
                    $predikat = '-';
                }elseif($tmp<=59){
                    $predikat = 'K';
                }elseif ($tmp<=74){
                    $predikat = 'C';
                }elseif ($tmp<=90){
                    $predikat = 'B';
                }elseif ($tmp<=100){
                    $predikat = 'SB';
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
	<title>Ledger Sikap</title>
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
        		<th rowspan="3" width="3%">NO.INDUK</th>
        		<th rowspan="3" width="10%">NAMA SISWA</th>
        		<th colspan="11">NILAI SIKAP</th>
            </tr>
            <tr>
                <th colspan="4" style="font-size:11px ;" width="2%">UTS</th>
        		<th colspan="4" style="font-size:11px ;" width="2%">UAS</th>
                <th rowspan="2" style="font-size:11px ;" width="2%">RAPORT</th>
                <th rowspan="2" style="font-size:11px ;" width="2%">KON</th>
                <th rowspan="2" style="font-size:11px ;" width="2%">PRE</th>
            </tr>
        	<tr>
        		<th  style="font-size:11px ;" width="2%">DIRI</th>
        		<th  style="font-size:11px ;" width="2%">TEMAN</th>
        		<th  style="font-size:11px ;" width="2%">JURNAL</th>
        		<th  style="font-size:11px ;" width="2%">OBS</th>
                <th  style="font-size:11px ;" width="2%">DIRI</th>
        		<th  style="font-size:11px ;" width="2%">TEMAN</th>
        		<th  style="font-size:11px ;" width="2%">JURNAL</th>
        		<th  style="font-size:11px ;" width="2%">OBS</th>
<!--                <th style="font-size:11px ;" width="54%">DESKRIPSI SIKAP SOSIAL - SPIRITUAL</th> -->
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
                
                echo '<td align="center" style="font-size:11px ;">'.$row->DIR_UTS.'</td>';   
                echo '<td align="center" style="font-size:11px ;">'.$row->TMN_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->JUR_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->OBS_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->DIR.'</td>';   
                echo '<td align="center" style="font-size:11px ;">'.$row->TMN.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->JUR.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->OBS.'</td>';
                
                $SKP = $row->DIR_UTS + $row->TMN_UTS + $row->JUR_UTS + $row->OBS_UTS + $row->DIR + $row->TMN + $row->JUR + $row->OBS;
                
                $d = ($row->DIR_UTS == '0' || $row->DIR_UTS == '' ) ? '0' : 1;
                $e = ($row->TMN_UTS == '0' || $row->TMN_UTS == '' ) ? '0' : 1;
                $f = ($row->JUR_UTS == '0' || $row->JUR_UTS == '' ) ? '0' : 1;
                $g = ($row->OBS_UTS == '0' || $row->OBS_UTS == '' ) ? '0' : 1;
                $h = ($row->DIR == '0' || $row->DIR == '' ) ? '0' : 1;
                $l = ($row->TMN == '0' || $row->TMN == '' ) ? '0' : 1;
                $j = ($row->JUR == '0' || $row->JUR == '' ) ? '0' : 1;
                $m = ($row->OBS == '0' || $row->OBS == '' ) ? '0' : 1;
                
                $k = $d + $e + $f + $g + $h + $l + $j + $m ;
                                
                $RT    = round(($k==0) ? 0 : $SKP/$k);                
                $RPT    = $RT;
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$RPT.'</font></b></td>';
                

                
                if($this->session->userdata('kd_sekolah') =="04")
				{
				    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'. $RPT*4/100 .'</font></b></td>';
					echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'. konversi_sikap_sma($RPT) .'</font></b></td>';
				}
				else
				{
				    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'. $RPT*4/100 .'</font></b></td>';
					echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'. konversi_sikap($RPT) .'</font></b></td>';
				}
						
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
                <td colspan=""></td>
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