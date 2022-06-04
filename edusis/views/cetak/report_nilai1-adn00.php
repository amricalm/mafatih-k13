<html>
<head>
<?php
function konversi($tmp)
{
    $predikat = "";
    if($tmp<=1){
                    $predikat = 'D';
                }elseif ($tmp<=1.33){
                    $predikat = 'D+';
                }elseif ($tmp<=1.67){
                    $predikat = 'C-';
                }elseif ($tmp<=2){
                    $predikat = 'C';
                }elseif ($tmp<=2.33){
                    $predikat = 'C+';
                }elseif ($tmp<=2.67){
                    $predikat = 'B-';
                }elseif ($tmp<=3){
                    $predikat = 'B';
                }elseif ($tmp<=3.33){
                    $predikat = 'B+';
                }elseif ($tmp<=3.67){
                    $predikat = 'A-';
                }elseif ($tmp<=4){
                    $predikat = 'A';
                }
    return $predikat;
}

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
function konversi_sikap_sma($tmp)
{
    $predikat = "";
                if($tmp==0){
                    $predikat = '';
                }
                elseif($tmp<=59){
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
?>
    <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" /><!-- WRITE YOUR CSS CODE HERE -->
<title>Raport</title>
<style>
	@media all {*{
		
		
	}
	}
</style>
<body>
 <table align="center" border="0" width="95%" style=" font-size: 0.9em;">
    <tr>
    	<td width="25%">Nama Sekolah</td>
    	<td width="35%">: <?php echo $nama_sekolah; ?></td>
    	<td width="25%">Kelas</td>
    	<td width="20%">: <?php echo str_replace('+',' ',$this->uri->segment(3));?></td>
    </tr>
    <tr>
    	<td>Alamat</td>
    	<td>: <?php echo $alamat_sekolah; //$sekolah->row()->alamat_sekolah; ?></td>
    	<td>Semester</td>
    	<td>: <?php echo $this->session->userdata('kd_semester');?></td>
    </tr>
    <tr>
    	<td>Nama Peserta Didik</td>
    	<td>: <?php echo $datasiswa->row()->nama_lengkap;?></td>
    	<td>Tahun Pelajaran</td>
    	<td>: <?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
        <td>Nomor Induk/NISN</td>
    	<td>: <?php echo $datasiswa->row()->nis; ?></td>
    </tr>
</table>
<h4><b>&nbsp;&nbsp;&nbsp;&nbsp;CAPAIAN KOMPETENSI</b></h4>
<div style="margin-left:0px;">
<div id="hdr">
    <div style="font-size: 0.8em;margin-left:18px;padding:0;margin-right:0;" >
        <div id="kol1" style="display:inline-block;width:193px;border-style:solid;border-bottom-style:none;padding-bottom:2px;margin:0px;text-align:center">Mata Pelajaran</div>
        <div id="kol2" style="display:inline-block;width:126px;border-style:solid;padding:0;margin-left:-6px;text-align:center">Pengetahuan (KI-3)</div>
        <div id="kol3" style="display:inline-block;width:125px;border-style:solid;padding:0;margin-left:-5px;text-align:center">Keterampilan (KI-4)</div>
        <div id="kol4" style="display:inline-block;width:236px;border-style:solid;padding:0;margin-left:-5px;text-align:center">Sikap Spiritual dan Sosial (KI-1 dan KI-2)</div>
    </div>
    <div style="font-size: 0.8em;margin-left:18px;padding:0;margin-right:0;" >
        <div id="kol1" style="display:inline-block;width:193px;border-left-style:solid;border-bottom-style:solid;border-top-style:none; padding:0;padding-bottom:2px;margin:0px;">&nbsp;</div>
        <div id="kol2" style="display:inline-block;width:61px;border-style:solid;padding:0;margin-left:-4px;text-align:center">Angka</div>
        <div id="kol2" style="display:inline-block;width:62px;border-style:solid;padding:0;margin-left:-4px;text-align:center">Predikat</div>
        
        <div id="kol2" style="display:inline-block;width:61px;border-style:solid;padding:0;margin-left:-5px;text-align:center">Angka</div>
        <div id="kol2" style="display:inline-block;width:61px;border-style:solid;padding:0;margin-left:-4px;text-align:center">Predikat</div>
        <div id="kol4" style="display:inline-block;width:62px;border-style:solid;padding:0;margin-left:-5px;text-align:center">Mapel</div>
		<div id="kol4" style="display:inline-block;width:171px;border-style:solid;padding:0;margin-left:-5px;text-align:center">Antar Mapel</div>
    </div>
</div>
<table style="border-collapse:collapse; font-size: 0.9em;" align="center" border="1" width="95%" cellpadding="0">
<!--
    <tr>
        <th colspan="2" width="100%">
            <table width="100%">
            <tr>
            	<th rowspan="2" colspan="2" width="38%">Mata Pelajaran</th>
                <th colspan="2" width="15%">Pengetahuan<br />(KL-3)</th>
                <th colspan="2" width="15%">Keterampilan<br />(KL-4)</th>
                <th colspan="2" width="30%">Sikap Spiritual dan Sosial (KI-1 dan KI-2)</th>
            </tr>
            <tr>
                <th width="35px">Angka</th>
                <th width="35px">Predikat</th>
                <th width="35px">Angka</th>
                <th width="35px">Predikat</th>
                <th width="45px">Dalam Mapel</th>
                <th width="85px">Antar Mapel</th>
            </tr>
            </table>
        </th>
    </tr>
-->
	<?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
        <?php
        $a  = 0;
        $i  = 1;
        $jmlkgn = 0;
        
		$jmh_mp = $hasilbelajar->num_rows();
        
        $kolom1 = "";
        $kolom2 = "";
		foreach($hasilbelajar->result() as $row)
        { 
            $bg = ($i%2==0) ? ' class="bg" ' : '';
//            if($a==0)
//            {
				$kolom1 .= '<tr'.$bg.'>';
				$kolom1 .= '<td width="5%" align="center" style="height: 20px;">'.$i.'</td>';
				$kolom1 .= '<td width="25%">'.$row->nm_mp.'</td>';
				$kolom1 .= '<td width="10%" align="center">  '. $row->kgn*4/100 .'</td>';
				
				$kgn    = ($row->kgn=='0') ? '0' : $row->kgn;
				
				$tmp   =$row->kgn*4/100;
                $predikat = konversi($tmp);
				
				$kolom1 .= '<td width="10%" align="center">'.$predikat .'</td>';
				$jmlkgn += $row->kgn;
    			
                $kolom1 .= '<td width="10%" align="center">'. $row->psk*4/100 .'</td>';
                
                $tmp   =$row->psk*4/100;
                $predikat = konversi($tmp);
                
                $kolom1 .= '<td width="10%" align="center">'. $predikat .'</td>';
                
				
				if($this->session->userdata('kd_sekolah') =="04")
                {
					$predikat = konversi_sikap_sma($row->afk);
				}
				else
				{
					$predikat = konversi_sikap($row->afk);
				}
				
				
                $kolom1 .= '<td width="10%" align="center">'. $predikat .'</td>';
                $kolom1 .= '</tr>';
//            }
//			else
//            {
//                echo '<tr'.$bg.'>';
//                echo '<td width="3%" align="center">'.$i.'</td>';
//                echo '<td width="22%">'.$row->nm_mp.'</td>';
//                echo '<td width="4%" align="center"> '. $row->kgn*4/100 .'</td>';
//                
//                $kgn    = ($row->kgn=='0') ? '0' : $row->kgn;
//                $tmp   =$row->kgn*4/100;
//                $predikat = konversi($tmp);
//                
//                echo '<td width="4%" align="center">'. $predikat .'</td>';
//                $jmlkgn += $row->kgn;
//    			echo '<td width="4%" align="center">'. $row->psk*4/100 .'</td>';
//                $tmp   =$row->psk*4/100;
//                $predikat = konversi($tmp);
//                echo '<td width="4%" align="center">'. $predikat .'</td>';
//                
//                $predikat = konversi_sikap($row->afk);
//                echo '<td width="4%" align="justify">'. $predikat .'</td>';
//                echo '</tr>';
//            }
            $i++;
            $a++;
            $kolom2 = $row->antar_mp;
        }
        
        echo '<tr>';
                echo '<td width="75%" style="padding:0;margin:0">';
                    echo '<table style="border-collapse:collapse;margin:0;padding:0;" border=1 width="100%" >'. $kolom1 .'</table>';
                echo '</td>';
                
                echo '<td width="25%" style="text-align:left; vertical-align: text-top; padding: 5px; " >' . $kolom2 .'</td>';
        echo '</tr>';
        
        ?>

        <?php }?>

</table>
</div>
<br />
<div>
    <table style=" border-collapse:collapse; font-size: 0.9em; " align="center" border="1" width="95%" cellpadding="0">
        <tr>
        	<th width="4%;" align:"center">No</th>
    		<th width="38%" style="height: 20px;">Ekstra Kurikuler</th>
            <th width="58%">Keikutsertaan dalam kegiatan</th>
        </tr>
        <?php   
                    $i = 1;
                    foreach($eskul->result() as $row)
                    {
    //                    $kd = (trim($row->kd_pribadi)=='KSP' || trim($row->kd_pribadi)=='KBSH' || trim($row->kd_pribadi)=='KDSP') ? 'a' : 'b';
    //                    if($kd == 'a')
    //                    {
                        $bg = ($i%2==0) ? ' class="bg" ' : '';
                        echo '<tr'.$bg.'>';
                        echo '<td align="center">'.$i.'</td>';
                        echo '<td style="padding-left: 5px;">'.$row->nm_eskul.'</td>';
                        $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
                        echo '<td align="center">'.$nilai.'</td>';
                        echo '</tr>';
                        $i++;
                        //}
                    }
                ?>
    </table>
    <br />
    <table style=" border-collapse:collapse; font-size: 0.9em; padding-left: 17px;" align="left" frame="box" width="50%">
        <tr frame="box">
            <th colspan="3" width="35%" style="height: 20px;">Ketidakhadiran</th>
        </tr>
        <tr>
            <td width="77%" style="height: 20px;">&nbsp;&nbsp;&nbsp;Sakit</td>
            <td width="3%">:</td>
            <td width="30%" align="center"><?php $a=($absens->row()->alfa == '0') ? '-' : $absens->row()->alfa; echo $a; ?>&nbsp;&nbsp;Hari</td>
        </tr>
        <tr>
            <td style="height: 20px;">&nbsp;&nbsp;&nbsp;Ijin</td>
            <td>:</td>
            <td align="center"><?php $a=($abseni->row()->alfa == '0') ? '-' : $abseni->row()->alfa; echo $a; ?>&nbsp;&nbsp;Hari</td>
        </tr>
        <tr>
            <td style="height: 20px;">&nbsp;&nbsp;&nbsp;Tanpa Keterangan</td>
            <td>:</td>
            <td align="center"><?php $a=($abseina->row()->alfa == '0') ? '-' : $abseina->row()->alfa; echo $a; ?>&nbsp;&nbsp;Hari</td>
        </tr>
    </table>
</div>
<br /><br /><br /><br /><br /><br />
<table style="font-size: 0.9em;" align="center" border="0" width="100%" >
<tr>
    <td width="45%">
    <table align="center" style="padding-top: -30px;">
        <tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
            <td align="center">Mengetahui</td>
        </tr>
        <tr>
        	<td align="Center">Orang Tua / Wali <br /><br /><br /><br /><br /></td>
        </tr>
        <tr>
        	<td align="center" style="border-bottom: 1px; text-decoration: underline;"><?php echo $datasiswa->row()->ayah_nama; ?></td>
        </tr>
    </table>
    </td>
    <td width="45%">
    <table align="center">
        <tr>
            <td align="center"><?php echo $sekolah->row()->kabupaten;?>, 20 Desember 2014 <?php // echo $pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
        </tr>
        <tr>
        	<td align="center">Wali Kelas, <br /><br /><br /><br /><br /></td>
        </tr>
        <tr>
            <td align="center"><u><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></u></td>
        </tr>
        <tr>
            <td align="center">NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?></td>
        </tr>
    </table>
    </td>
</tr>
</table> 
</body>
</html>