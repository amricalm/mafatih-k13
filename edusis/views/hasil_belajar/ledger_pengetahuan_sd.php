<?php $this->load->view('page_head');?>
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
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>LEDGER PENGETAHUAN<?php //$q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?></h1>

    <form action="<?php echo base_url().'index.php/hasilbelajar/ledger_pengetahuan' ?>" method="POST" id="frmhasilbelajar">
    <!--atur pd (edusis_system/helpers/form_helper.php)function form_hidden, dg menambahkan (id="'.$name.'")-->
    <?php echo form_hidden('myurl',site_url('hasilbelajar')) ?>
    <!--table filter-->                            
        <table border="0" width="100%">
            <tr>
                <td width="100px">Pilih Kelas</td>
                <td width="300px"> 
                <select name="skelas" id="skelas" onchange="pilih()">
        		<?php
        			echo '<option value="" class="input-text"></option>';
        			$arraykelas = array();
        			if($skelas->num_rows() !=0)
        			{
        				foreach($skelas->result () as $rowkelas )
        				{
        					$selected		='';
        					if($pilihkelas == trim($rowkelas->kelas))
        					{
        						$selected	= 'selected="selected"';
        					}
        				echo '<option value="'.trim($rowkelas->kelas).'" '.$selected.'>'.$rowkelas->kelas.'</option>';
        				}
        			}
        		?>
        		</select>
                </td>
                <td align="right" width="">
                <?php if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') { ?>
                <a href="<?php echo base_url().'index.php/export/export_pengetahuan_to_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
                <?php } ?>
                </td>  
            </tr>
            <tr>
                <td>Mata pelajaran</td> 
                <td>
                    <?php
                        $arraymp = array('');
                        foreach($kdmp->result () as $rowmp )
                        {
                            $arraymp[$rowmp->kd_mp]=$rowmp->nm_mp;
                        }
                        echo form_dropdown('kd_mp',$arraymp,$pilihmp,' id="mp" ');
                    ?>
                </td>
                <td rowspan="2">
                    <a href="javascript:filter()" class="small button blue">Filter</a>
                </td>              
            </tr>
        </table>
    <!--end table filter-->
    <!--table daftar hasil study-->
    <div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999;overflow:auto" border="1">
        <table class="tables" align="center" width="auto" cellpadding="0">
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
                            echo '<th colspan="88">NILAI PENGETAHUAN</th>';
                    }
                ?>
       		
        	</tr>
        	<tr>
        		<th colspan="5" style="font-size:11px ;">TEMA 1.1 </th>
                <th colspan="5" style="font-size:11px ;">TEMA 1.2 </th>
                <th colspan="5" style="font-size:11px ;">TEMA 1.3 </th>
                <th colspan="5" style="font-size:11px ;">TEMA 1.4 </th>
                
                <th colspan="5" style="font-size:11px ;">TEMA 2.1 </th>
                <th colspan="5" style="font-size:11px ;">TEMA 2.2 </th>
                <th colspan="5" style="font-size:11px ;">TEMA 2.3 </th>
                <th colspan="5" style="font-size:11px ;">TEMA 2.4 </th>
                
                <th colspan="5" style="font-size:11px ;">TEMA 3.1 </th>
                <th colspan="5" style="font-size:11px ;">TEMA 3.2 </th>
                <th colspan="5" style="font-size:11px ;">TEMA 3.3 </th>
                <th colspan="5" style="font-size:11px ;">TEMA 3.4 </th>
                
                <th colspan="5" style="font-size:11px ;">TEMA 4.1 </th>
                <th colspan="5" style="font-size:11px ;">TEMA 4.2 </th>
                <th colspan="5" style="font-size:11px ;">TEMA 4.3 </th>
                <th colspan="5" style="font-size:11px ;">TEMA 4.4 </th>
        		
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
        		<!--<th rowspan="2" style="font-size:11px ;" width="2%">KONVERSI</th>-->
                <th colspan="2" style="font-size:11px ;" width="2%">LCKPD</th>
               <!--
 <th rowspan="2" style="font-size:11px ;" width="12%">DESKRIPSI PENGETAHUAN</th>
-->
        	</tr>
        	<tr>
        		<th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
                
                <th width="2%" style="font-size:11px ;">K1</th>
        		<th width="2%" style="font-size:11px ;">K2</th>
        		<th width="2%" style="font-size:11px ;">K3</th>
                <th width="2%" style="font-size:11px ;">K4</th>
        		<th width="2%" style="font-size:11px ;">RT2</th>
        		

                <th width="2%" style="font-size:11px ;">KON</th>
                <th width="2%" style="font-size:11px ;">PRE</th>
        		<!--<th width="2%" style="font-size:11px ;">KKM=<?php $a=''; if($kkm->num_rows()>0){ $a = ($kkm->row()->skbm == '' || $kkm->row()->skbm == '0') ? '' : $kkm->row()->skbm; echo $a;}?></th>-->
        	</tr>
            <?php 
            
            $i  = 1;
            $tgh            = array("TEMA1_1","TEMA1_2","TEMA1_3","TEMA1_4",
                                "TEMA2_1","TEMA2_2","TEMA2_3","TEMA2_4",
                                "TEMA3_1","TEMA3_2","TEMA3_3","TEMA3_4",
                                "TEMA4_1","TEMA4_2","TEMA4_3","TEMA4_4");
                                
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
                
                
                
                //
//                echo '<td align="center" style="font-size:11px ;">'.$row->tema21.'</td>';   
//                echo '<td align="center" style="font-size:11px ;">'.$row->tema22.'</td>';
//                echo '<td align="center" style="font-size:11px ;">'.$row->tema23.'</td>';
//                echo '<td align="center" style="font-size:11px ;">'.$row->tema24.'</td>';
//                
//                $tema2 = $row->tema21 + $row->tema22 + $row->tema23 + $row->tema24;
//                
//                $h = ($row->tema21 == '0' || $row->tema21 == '' ) ? '0' : 1;
//                $l = ($row->tema22 == '0' || $row->tema22 == '' ) ? '0' : 1;
//                $j = ($row->tema23 == '0' || $row->tema23 == '' ) ? '0' : 1;
//                $k = ($row->tema24 == '0' || $row->tema24 == '' ) ? '0' : 1;
//                $m = $h + $l + $j + $k;
//                
//                $RT2    = round(($m==0) ? 0 : $tema2/$m);
//                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT2.'</font></td>';
//                
//                echo '<td align="center" style="font-size:11px ;">'.$row->tema31.'</td>';   
//                echo '<td align="center" style="font-size:11px ;">'.$row->tema32.'</td>';
//                echo '<td align="center" style="font-size:11px ;">'.$row->tema33.'</td>';
//                echo '<td align="center" style="font-size:11px ;">'.$row->tema34.'</td>';
//                
//                $tema3 = $row->tema31 + $row->tema32 + $row->tema33 + $row->tema34;
//                
//                $h = ($row->tema31 == '0' || $row->tema31 == '' ) ? '0' : 1;
//                $l = ($row->tema32 == '0' || $row->tema32 == '' ) ? '0' : 1;
//                $j = ($row->tema33 == '0' || $row->tema33 == '' ) ? '0' : 1;
//                $k = ($row->tema34 == '0' || $row->tema34 == '' ) ? '0' : 1;
//                $m = $h + $l + $j + $k;
//                
//                $RT3    = round(($m==0) ? 0 : $tema3/$m);
//                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT3.'</font></td>';
//                
//                echo '<td align="center" style="font-size:11px ;">'.$row->tema41.'</td>';   
//                echo '<td align="center" style="font-size:11px ;">'.$row->tema42.'</td>';
//                echo '<td align="center" style="font-size:11px ;">'.$row->tema43.'</td>';
//                echo '<td align="center" style="font-size:11px ;">'.$row->tema44.'</td>';
//                
//                $tema4 = $row->tema41 + $row->tema42 + $row->tema43 + $row->tema44;
//                
//                $h = ($row->tema41 == '0' || $row->tema41 == '' ) ? '0' : 1;
//                $l = ($row->tema42 == '0' || $row->tema42 == '' ) ? '0' : 1;
//                $j = ($row->tema43 == '0' || $row->tema43 == '' ) ? '0' : 1;
//                $k = ($row->tema44 == '0' || $row->tema44 == '' ) ? '0' : 1;
//                $m = $h + $l + $j + $k;
//                
//                $RT4    = round(($m==0) ? 0 : $tema4/$m);
//                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT4.'</font></td>';
                
                
                
//				$his = ($RT1 == '0' || $RT1 == '' ) ? '0' : 1;
//                $lis = ($RT2 == '0' || $RT2 == '' ) ? '0' : 1;
//                $mis = ($RT3 == '0' || $RT3 == '' ) ? '0' : 1;
//                $nis = ($RT4 == '0' || $RT4 == '' ) ? '0' : 1;                
//                
//                $kis = $his + $lis +$mis +$nis ;
//				$NaUH   = ($kis==0) ? 0 : (round(($RT1+$RT2+$RT3+$RT4) / $kis));              
                
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
                    
                    $a = (is_null($row['UAS']) || $row['UAS'] == 0 ) ? '0' : 1;
                    $b = (is_null($row['UAS_PSK']) || $row['UAS_PSK'] == 0 ) ? '0' : 1;
                    $c = $a + $b ;
                    
                    $akum_uas = $row['UAS']+$row['UAS_PSK'];
                    $RT_UAS = round(($c==0) ? 0 : $akum_uas/$c);
                    
                    $e = (is_null($row['UTS']) || $row['UTS'] == 0 ) ? '0' : 1;
                    $f = (is_null($row['UTS_PSK']) || $row['UTS_PSK'] == 0 ) ? '0' : 1;
                    $g = $e + $f ;
                    
                    $akum_uts = $row['UTS']+$row['UTS_PSK'];
                    $RT_UTS = round(($g==0) ? 0 : $akum_uts/$g);
                    
                    
                    echo '<td align="center" style="font-size:11px ;">'.$RT_UTS.'</td>';
                    $BBT2   = round($RT_UTS * 0.20);
                    echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT2.'</font></b></td>';
                    
                    echo '<td align="center" style="font-size:11px ;">'.$RT_UAS.'</td>';
                    $BBT3   = round($RT_UAS * 0.20);
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
        <!-- end table hsil study -->
    </form>
</div>
</div> <!-- /content -->
</div> <!-- /cols -->
<hr class="noscreen" />
<!-- Footer -->
<?php $this->load->view('page_footer'); ?>

<script type="text/javascript">

    function filter()
    {
        var kelas         = urlencode($('#skelas').val());//utlencode pd javascript digunakan untuk merubah caracter sepasi, spt str_replece pd php 
        var mp            = $('#mp').val();
        var myurl         = $('#myurl').val();
        var form_wi       = $('#frmhasilbelajar').attr('action');
        $('#frmhasilbelajar').attr('action',form_wi+'/'+kelas+'/'+mp);
        $('#frmhasilbelajar').submit();
    }
    function pilih()
    {
        var kelas         = urlencode($('#skelas').val());
        var myurl         = $('#myurl').val();
        var tujuan        = myurl+"/alokasiwi_filter/"+kelas;
        $.ajax({
           type: "POST",
           async: false,
           url: tujuan,
           success: function (msg){
               if (msg!="") {
                   $("#resultnama").html(msg);
               }                       
           }
        });
    }
</script>

</body>
</html>
