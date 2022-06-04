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
	<title>Ledger Pengetahuan</title>
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
<!-- Hasil Study Pengetahuan -->
<table style=" border-collapse:collapse; size: landscape; font-size: 11px; " align="center" border="1" align="center%" width="100%" cellpadding="0">
        	<tr>
        		<th rowspan="3" width="2%">NO</th>
        		<th rowspan="3" width="5%">NO.INDUK</th>
        		<th rowspan="3" width="14%">NAMA SISWA</th>
                <?php

                    if($this->session->userdata('sub_pnl')=='UTS')
                    {
        		          echo '<th colspan="20">NILAI PENGETAHUAN</th>';
                    }
                    else
                    {
                            echo '<th colspan="22">NILAI PENGETAHUAN</th>';
                    }
                ?>


        		</tr>
        	<tr>
        		<th colspan="7" style="font-size:11px ;">TUGAS + QUIZ </th>
        		<th colspan="7" style="font-size:11px ;">ULANGAN HARIAN</th>
        		<!--<th rowspan="2" style="font-size:11px ;" width="2%">NILAI<BR/>UH</th>-->
        		<th rowspan="2" style="font-size:11px ;" width="2%">60% NH</th>

                <?php
                if($this->session->userdata('sub_pnl')=='UTS')
                    {
                        echo '<th rowspan="2" style="font-size:11px ;" width="2%">UTS</th>';
                		echo '<th rowspan="2" style="font-size:11px ;" width="2%">40% UTS</th>';
                    }
                    else
                    {
                        echo '<th rowspan="2" style="font-size:11px ;" width="2%">UTS</th>';
                		echo '<th rowspan="2" style="font-size:11px ;" width="2%">20% UTS</th>';
                		echo '<th rowspan="2" style="font-size:11px ;" width="2%">UAS</th>';
                		echo '<th rowspan="2" style="font-size:11px ;" width="2%">20% UAS</th>';
                    }
                ?>

                <th rowspan="2" style="font-size:11px ;" width="2%">RPT</th>
                <th colspan="2" style="font-size:11px ;" width="2%">LCKPD</th>
<!--                <th rowspan="2" style="font-size:11px ;" width="12%">DESKRIPSI PENGETAHUAN</th> -->
        	</tr>
        	<tr>
        		<th width="2%" style="font-size:11px ;">1</th>
        		<th width="2%" style="font-size:11px ;">2</th>
        		<th width="2%" style="font-size:11px ;">3</th>
                <th width="2%" style="font-size:11px ;">4</th>
        		<th width="2%" style="font-size:11px ;">5</th>
        		<th width="2%" style="font-size:11px ;">6</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
        		<th width="2%" style="font-size:11px ;">KD1</th>
                <th width="2%" style="font-size:11px ;">KD2</th>
                <th width="2%" style="font-size:11px ;">KD3</th>
                <th width="2%" style="font-size:11px ;">KD4</th>
        		<th width="2%" style="font-size:11px ;">KD5</th>
        		<th width="2%" style="font-size:11px ;">KD6</th>
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

                echo '<td align="center" style="font-size:11px ;">'.$row->TGS1_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->TGS2_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->TGS3_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->TGS1.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->TGS2.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->TGS3.'</td>';


                $TGS = $row->TGS1_UTS + $row->TGS2_UTS + $row->TGS3_UTS + $row->TGS1 + $row->TGS2 + $row->TGS3;

                $e = ($row->TGS1_UTS == '0' || $row->TGS1_UTS == '' ) ? '0' : 1;
                $f = ($row->TGS2_UTS == '0' || $row->TGS2_UTS == '' ) ? '0' : 1;
                $g = ($row->TGS3_UTS == '0' || $row->TGS3_UTS == '' ) ? '0' : 1;
                $h = ($row->TGS1 == '0' || $row->TGS1 == '' ) ? '0' : 1;
                $l = ($row->TGS2 == '0' || $row->TGS2 == '' ) ? '0' : 1;
                $j = ($row->TGS3 == '0' || $row->TGS3 == '' ) ? '0' : 1;
                $k = $e + $f + $g + $h + $l + $j;

                $RT1    = ($k==0) ? 0 : $TGS/$k;
                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.round($RT1).'</font></td>';

                echo '<td align="center" style="font-size:11px ;">'.$row->UHT1_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->UHT2_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->UHT3_UTS.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->UHT1.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->UHT2.'</td>';
                echo '<td align="center" style="font-size:11px ;">'.$row->UHT3.'</td>';

                $UHT = $row->UHT1_UTS + $row->UHT2_UTS + $row->UHT3_UTS +$row->UHT1 + $row->UHT2 + $row->UHT3;

                $ei = ($row->UHT1_UTS == '0' || $row->UHT1_UTS == '' ) ? '0' : 1;
                $fi = ($row->UHT2_UTS == '0' || $row->UHT2_UTS == '' ) ? '0' : 1;
                $gi = ($row->UHT3_UTS == '0' || $row->UHT3_UTS == '' ) ? '0' : 1;
                $hi = ($row->UHT1 == '0' || $row->UHT1 == '' ) ? '0' : 1;
                $li = ($row->UHT2 == '0' || $row->UHT2 == '' ) ? '0' : 1;
                $ji = ($row->UHT3 == '0' || $row->UHT3 == '' ) ? '0' : 1;
                $ki = $ei + $fi + $gi + $hi + $li + $ji;

                $RT2    = ($ki==0) ? 0 : $UHT/$ki;
                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.round($RT2).'</font></td>';

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


                $empatskala	= konversi_sma_4skala($RPT);
                if ($kd_sekolah=='04')
                {
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$empatskala.'</font></b></td>';
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.konversi_sma($empatskala).'</font></b></td>';
                }
                else
                {
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$RPT*4/100 .'</font></b></td>';
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.konversi($RPT*4/100).'</font></b></td>';
                }
                //echo '<td align="justify" style="font-size:11px ;"><b><font color="blue">'.$row->DESKRIPSI.'</font></b></td>';

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
