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
        		          echo '<th colspan="86">NILAI PENGETAHUAN</th>';
                    }
                    else
                    {
                            echo '<th colspan="28">NILAI PENGETAHUAN</th>';
                    }
                ?>
       		
        	</tr>
        	<tr>
            <?php
            if($this->session->userdata('sub_pnl')=='UTS')
                {
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 1.1 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 1.2 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 1.3 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 1.4 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 2.1 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 2.2 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 2.3 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 2.4 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 3.1 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 3.2 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 3.3 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 3.4 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 4.1 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 4.2 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 4.3 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 4.4 </th>';
                }
                else
                {
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 1 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 2 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 3 </th>';
                    echo '<th colspan="5" style="font-size:11px ;">TEMA 4 </th>';
                }
            ?>
        		<th rowspan="2" style="font-size:11px ;" width="2%">60% PB</th>
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
               
        	</tr>
        	<tr>
            <?php
        	if($this->session->userdata('sub_pnl')=='UTS')
            {
            	echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
        	} else {
        	   echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
                
                echo '<th width="2%" style="font-size:11px ;">K1</th>';
        		echo '<th width="2%" style="font-size:11px ;">K2</th>';
        		echo '<th width="2%" style="font-size:11px ;">K3</th>';
                echo '<th width="2%" style="font-size:11px ;">K4</th>';
        		echo '<th width="2%" style="font-size:11px ;">RT2</th>';
        	}
            ?>	

                <th width="2%" style="font-size:11px ;">KON</th>
                <th width="2%" style="font-size:11px ;">PRE</th>
        </tr>
            <?php 
            
            $i  = 1;
            if($this->session->userdata('sub_pnl')=='UTS')
            {
                $tgh            = array("TEMA1_1","TEMA1_2","TEMA1_3","TEMA1_4",
                                "TEMA2_1","TEMA2_2","TEMA2_3","TEMA2_4",
                                "TEMA3_1","TEMA3_2","TEMA3_3","TEMA3_4",
                                "TEMA4_1","TEMA4_2","TEMA4_3","TEMA4_4");
            } else {
                $tgh            = array("TEMA1_1","TEMA2_1","TEMA3_1","TEMA4_1");
            }
            
                                
            if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') { 
            
            foreach($hasilbelajar->result_array() as $row)
            {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$i.'</td>';
                echo '<td align="left">'.$row['nis'].'</td>';
                echo '<td>'.$row['nama_lengkap'].'</td>';
                
                $NaUH = 0;
                $CountUH = 0;
                for($x=0;$x<count($tgh);$x++)
                {
                    echo '<td align="center" style="font-size:11px ;">'.$row["$tgh[$x]K1"].'</td>';   
                    echo '<td align="center" style="font-size:11px ;">'.$row["$tgh[$x]K2"].'</td>';
                    echo '<td align="center" style="font-size:11px ;">'.$row["$tgh[$x]K3"].'</td>';
                    echo '<td align="center" style="font-size:11px ;">'.$row["$tgh[$x]K4"].'</td>';
                    
                    $subtema =  (is_null($row["$tgh[$x]K1"])?0:$row["$tgh[$x]K1"]) + (is_null($row["$tgh[$x]K2"])?0:$row["$tgh[$x]K2"]) + (is_null($row["$tgh[$x]K3"])?0:$row["$tgh[$x]K3"])+(is_null($row["$tgh[$x]K4"])?0:$row["$tgh[$x]K4"]);
                                    
                    $h = (is_null($row["$tgh[$x]K1"]) || $row["$tgh[$x]K1"] == 0 ) ? '0' : 1;
                    $l = (is_null($row["$tgh[$x]K2"]) || $row["$tgh[$x]K2"] == 0 ) ? '0' : 1;
                    $j = (is_null($row["$tgh[$x]K3"]) || $row["$tgh[$x]K3"] == 0 ) ? '0' : 1;
                    $k = (is_null($row["$tgh[$x]K4"]) || $row["$tgh[$x]K4"] == 0 ) ? '0' : 1;
                    $m = $h + $l + $j + $k;
                    
                    $RT    = round(($m==0) ? 0 : $subtema/$m);
                    $NaUH = $NaUH + $RT;
                    
                    if($RT>0)$CountUH++;                    
                    
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT.'</font></td>';
                }
                
                
                if($this->session->userdata('sub_pnl')=='UTS')
                {
                    echo '<td align="center" style="font-size:11px ;">'.$row->tema21.'</td>';   
                    echo '<td align="center" style="font-size:11px ;">'.$row->tema22.'</td>';
                    echo '<td align="center" style="font-size:11px ;">'.$row->tema23.'</td>';
                    echo '<td align="center" style="font-size:11px ;">'.$row->tema24.'</td>';
                    
                    $tema2 = $row->tema21 + $row->tema22 + $row->tema23 + $row->tema24;
                    
                    $h = ($row->tema21 == '0' || $row->tema21 == '' ) ? '0' : 1;
                    $l = ($row->tema22 == '0' || $row->tema22 == '' ) ? '0' : 1;
                    $j = ($row->tema23 == '0' || $row->tema23 == '' ) ? '0' : 1;
                    $k = ($row->tema24 == '0' || $row->tema24 == '' ) ? '0' : 1;
                    $m = $h + $l + $j + $k;
                    
                    $RT2    = round(($m==0) ? 0 : $tema2/$m);
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT2.'</font></td>';
                    
                    echo '<td align="center" style="font-size:11px ;">'.$row->tema31.'</td>';   
                    echo '<td align="center" style="font-size:11px ;">'.$row->tema32.'</td>';
                    echo '<td align="center" style="font-size:11px ;">'.$row->tema33.'</td>';
                    echo '<td align="center" style="font-size:11px ;">'.$row->tema34.'</td>';
                    
                    $tema3 = $row->tema31 + $row->tema32 + $row->tema33 + $row->tema34;
                    
                    $h = ($row->tema31 == '0' || $row->tema31 == '' ) ? '0' : 1;
                    $l = ($row->tema32 == '0' || $row->tema32 == '' ) ? '0' : 1;
                    $j = ($row->tema33 == '0' || $row->tema33 == '' ) ? '0' : 1;
                    $k = ($row->tema34 == '0' || $row->tema34 == '' ) ? '0' : 1;
                    $m = $h + $l + $j + $k;
                    
                    $RT3    = round(($m==0) ? 0 : $tema3/$m);
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT3.'</font></td>';
                    
                    echo '<td align="center" style="font-size:11px ;">'.$row->tema41.'</td>';   
                    echo '<td align="center" style="font-size:11px ;">'.$row->tema42.'</td>';
                    echo '<td align="center" style="font-size:11px ;">'.$row->tema43.'</td>';
                    echo '<td align="center" style="font-size:11px ;">'.$row->tema44.'</td>';
                    
                    $tema4 = $row->tema41 + $row->tema42 + $row->tema43 + $row->tema44;
                    
                    $h = ($row->tema41 == '0' || $row->tema41 == '' ) ? '0' : 1;
                    $l = ($row->tema42 == '0' || $row->tema42 == '' ) ? '0' : 1;
                    $j = ($row->tema43 == '0' || $row->tema43 == '' ) ? '0' : 1;
                    $k = ($row->tema44 == '0' || $row->tema44 == '' ) ? '0' : 1;
                    $m = $h + $l + $j + $k;
                    
                    $RT4    = round(($m==0) ? 0 : $tema4/$m);
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT4.'</font></td>';
                    
                    
                    
    				$his = ($RT1 == '0' || $RT1 == '' ) ? '0' : 1;
                    $lis = ($RT2 == '0' || $RT2 == '' ) ? '0' : 1;
                    $mis = ($RT3 == '0' || $RT3 == '' ) ? '0' : 1;
                    $nis = ($RT4 == '0' || $RT4 == '' ) ? '0' : 1;                
                    
                    $kis = $his + $lis +$mis +$nis ;
    				$NaUH   = ($kis==0) ? 0 : (round(($RT1+$RT2+$RT3+$RT4) / $kis));   
                }
                
           
                
                $BBT1 =0;
                if ($CountUH>0) $BBT1   = round($NaUH/$CountUH * 0.60);
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT1.'</font></b></td>';
                    

                if($this->session->userdata('sub_pnl')=='UTS')
                {
                    echo '<td align="center" style="font-size:11px ;">'.$row['UTS'].'</td>';
                    $BBT2   = round($row['UTS'] * 0.40);
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT2.'</font></b></td>';
                                    
                    $RPT    = $BBT1 + $BBT2 ;
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$RPT.'</font></b></td>';
                }
                else
                {
                    echo '<td align="center" style="font-size:11px ;">'.$row['UTS'].'</td>';
                    $BBT2   = round($row['UTS'] * 0.20);
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT2.'</font></b></td>';
                    
                    echo '<td align="center" style="font-size:11px ;">'.$row['UAS'].'</td>';
                    $BBT3   = round($row['UAS'] * 0.20);
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT3.'</font></b></td>';
                
                    $RPT    = $BBT1 + $BBT2 + $BBT3;
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$RPT.'</font></b></td>';
                }
                
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$RPT*4/100 .'</font></b></td>';
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'. konversi($RPT*4/100) .'</font></b></td>';
                //echo '<td align="justify" style="font-size:11px ;"><b><font color="blue">'.$row['DESKRIPSI'].'</font></b></td>';
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
		<br /><br />
<!--	<table style=" border-collapse:collapse; size: landscape; font-size: 11px; " align="center" border="1" align="center%" width="100%" cellpadding="0">	
		<thead>
			<tr>
        		<th width="3%">NO</th>
        		<th width="7%">NO.INDUK</th>
        		<th width="20%">NAMA SISWA</th>
                <th width="70%" style="font-size:11px ;">DESKRIPSI PENGETAHUAN</th>
        	</tr>
		</thead> -->
				<?php 
				
//				$i  = 1;
//				if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') 
//				{ 
//					foreach($hasilbelajar->result() as $row)
//					{
//						$bg = ($i%2==0) ? ' class="bg" ' : '';
//						echo '<tr'.$bg.'>';
//						echo '<td align="center">'.$i.'</td>';
//						echo '<td align="left" style="padding-left: 2px;">'.$row->nis.'</td>';
//						echo '<td style="padding-left: 2px;">'.$row->nama_lengkap.'</td>';
//						echo '<td style="padding-left: 2px;">'.$row->DESKRIPSI.'</td>';
//						echo '</tr>';
//					$i++;
//					}
//				}
				?>
<!--	</table> -->
		
        <!-- end table hsil study -->
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
            <td align="left"><?php echo $sekolah->row()->kabupaten;?>, 20 Desember 2014<?php // $arraytgl = $this->app_model->tgl(); $pilihtgl = date('d'); $pilihbln = date('m');;$pilihth = date('y'); echo $pilihtgl ;echo ' - '; echo $pilihbln; echo ' - ';echo '20'; echo $pilihth;?></td>
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