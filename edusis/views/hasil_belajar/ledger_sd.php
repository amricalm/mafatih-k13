<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>LEDGER <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?></h1>

    <form action="<?php echo base_url().'index.php/hasilbelajar/ledger' ?>" method="POST" id="frmhasilbelajar">
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
                <a href="<?php echo base_url().'index.php/export/export_to_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
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
    <div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
        <table class="tables" align="center" width="100%" cellpadding="0">
        	<?php if($this->session->userdata('sub_pnl')=='UTS'){ ?>
                <tr>
            		<th rowspan="3" width="2%">NO</th>
            		<th rowspan="3" width="5%">NO.INDUK</th>
            		<th rowspan="3" width="14%">NAMA SISWA</th>
            		<th colspan="10">ULANGAN HARIAN ( 40% )</th>
            		<th colspan="5">TUGAS ( 20% )</th>
            		<th colspan="4"><?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?> ( 40% )</th>
            		<th rowspan="2" style="font-size:11px ;">RAPOR<BR/><?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?></th>
            	</tr>
            	<tr>
            		<th colspan="4" style="font-size:11px ;">TERTULIS</th>
            		<th colspan="4" style="font-size:11px ;">PRAKTEK</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">NILAI<BR/>UH</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">NILAI<br />BOBOT</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">1</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">2</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">3</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">RT2</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">NILAI<br />BOBOT</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">TULIS</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">PRAK<br/>TEK</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">RT2</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">NILAI<br />BOBOT</th>
            	</tr>
            	<tr>
            		<th width="2%" style="font-size:11px ;">1</th>
            		<th width="2%" style="font-size:11px ;">2</th>
            		<th width="2%" style="font-size:11px ;">3</th>
            		<th width="2%" style="font-size:11px ;">RT2</th>
            		<th width="2%" style="font-size:11px ;">1</th>
            		<th width="2%" style="font-size:11px ;">2</th>
            		<th width="2%" style="font-size:11px ;">3</th>
            		<th width="2%" style="font-size:11px ;">RT2</th>
            		<th width="2%" style="font-size:11px ;">KKM=<?php $a=''; if($kkm->num_rows()>0){ $a = ($kkm->row()->skbm == '' || $kkm->row()->skbm == '0') ? '' : $kkm->row()->skbm; echo $a;}?></th>
            	</tr>
            <?php } else { ?>
                <tr>
            		<th rowspan="3" width="2%">NO</th>
            		<th rowspan="3" width="5%">NO.INDUK</th>
            		<th rowspan="3" width="14%">NAMA SISWA</th>
            		<th colspan="10">ULANGAN HARIAN ( 40% )</th>
            		<th colspan="5">TUGAS ( 20% )</th>
                    <th colspan="2">UTS ( 20% )</th>
                    <th colspan="4">UAS ( 20% )</th>
     <!--       		<th colspan="4"><?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?> ( 40% )</th> -->
            		<th rowspan="2" style="font-size:11px ;">RAPOR<BR/><?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?></th>
            	</tr>
            	<tr>
            		<th colspan="4" style="font-size:11px ;">TERTULIS</th>
            		<th colspan="4" style="font-size:11px ;">PRAKTEK</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">NILAI<BR/>UH</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">NILAI<br />BOBOT</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">1</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">2</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">3</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">RT2</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">NILAI<br />BOBOT</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">UTS</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">NILAI BOBOT</th>
                    <th rowspan="2" style="font-size:11px ;" width="2%">TULIS</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">PRAK<br/>TEK</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">RT2</th>
            		<th rowspan="2" style="font-size:11px ;" width="2%">NILAI<br />BOBOT</th>
            	</tr>
            	<tr>
            		<th width="2%" style="font-size:11px ;">1</th>
            		<th width="2%" style="font-size:11px ;">2</th>
            		<th width="2%" style="font-size:11px ;">3</th>
            		<th width="2%" style="font-size:11px ;">RT2</th>
            		<th width="2%" style="font-size:11px ;">1</th>
            		<th width="2%" style="font-size:11px ;">2</th>
            		<th width="2%" style="font-size:11px ;">3</th>
            		<th width="2%" style="font-size:11px ;">RT2</th>
            		<th width="2%" style="font-size:11px ;">KKM=<?php $a=''; if($kkm->num_rows()>0){ $a = ($kkm->row()->skbm == '' || $kkm->row()->skbm == '0') ? '' : $kkm->row()->skbm; echo $a;}?></th>
            	</tr>
            <?php } ?>
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
                $UHT1    = $row->UHT1;
                echo '<td align="center" style="font-size:11px ;">'.$UHT1.'</td>';   
                $UHT2    = $row->UHT2;
                echo '<td align="center" style="font-size:11px ;">'.$UHT2.'</td>';
                $UHT3    = $row->UHT3;
                echo '<td align="center" style="font-size:11px ;">'.$UHT3.'</td>';
                
                $jmluht = $UHT1 + $UHT2 + $UHT3;
                $h = ($UHT1 == '0' || $UHT1 == '' ) ? '0' : 1;
                $l = ($UHT2 == '0' || $UHT2 == '' ) ? '0' : 1;
                $j = ($UHT3 == '0' || $UHT3 == '' ) ? '0' : 1;
                $k = $h + $l + $j;
                $RT1    = round(($k==0) ? 0 : $jmluht/$k);
                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT1.'</font></td>';
                
                $UHP1    = $row->UHP1;
                echo '<td align="center" style="font-size:11px ;">'.$UHP1.'</td>';
                $UHP2    = $row->UHP2;
                echo '<td align="center" style="font-size:11px ;">'.$UHP2.'</td>';
                $UHP3    = $row->UHP3;
                echo '<td align="center" style="font-size:11px ;">'.$UHP3.'</td>';
                
                $jmluhp = $UHP1 + $UHP2 + $UHP3;
                $hi = ($UHP1 == '0' || $UHP1 == '' ) ? '0' : 1;
                $li = ($UHP2 == '0' || $UHP2 == '' ) ? '0' : 1;
                $ji = ($UHP3 == '0' || $UHP3 == '' ) ? '0' : 1;
                $ki = $hi + $li + $ji;
                $RT2    = round(($ki==0) ? 0 : $jmluhp/$ki);              
                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT2.'</font></td>';
                
				$his = ($RT1 == '0' || $RT1 == '' ) ? '0' : 1;
                $lis = ($RT2 == '0' || $RT2 == '' ) ? '0' : 1;
                $kis = $his + $lis;
				$NaUH   = ($kis==0) ? 0 : (round(($RT1 + $RT2) / $kis));              
                //$NaUH   = round(($RT1 + $RT2) / 2);
                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$NaUH.'</font></td>';
                $BBT1   = $NaUH * 0.40;
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT1.'</font></b></td>';

                $TGST1    = $row->TGST1;
                $TGSP1    = $row->TGSP1;
                $TGS1     = $TGST1 + $TGSP1;
                $e = ($TGST1 == '0' || $TGST1 == '' ) ? '0' : 1;
                $f = ($TGSP1 == '0' || $TGSP1 == '' ) ? '0' : 1;  
                $g = $e + $f;
                $RTTGS1    = round(($g==0) ? 0 : $TGS1/$g);
                echo '<td align="center" style="font-size:11px ;">'.$RTTGS1.'</td>';
                
                $TGST2    = $row->TGST2;
                $TGSP2    = $row->TGSP2;
                $TGS2     = $TGST2 + $TGSP2;
                $h = ($TGST2 == '0' || $TGST2 == '' ) ? '0' : 1;
                $is = ($TGSP2 == '0' || $TGSP2 == '' ) ? '0' : 1;
                $j = $h + $is;
                $RTTGS2    = round(($j==0) ? 0 : $TGS2/$j);
                echo '<td align="center" style="font-size:11px ;">'.$RTTGS2.'</td>';
                
                $TGST3    = $row->TGST3;
                $TGSP3    = $row->TGSP3;
                $TGS3     = $TGST3 + $TGSP3;
                $k = ($TGST3 == '0' || $TGST3 == '' ) ? '0' : 1;
                $l = ($TGSP3 == '0' || $TGSP3 == '' ) ? '0' : 1;
                $m = $k + $l;
                $RTTGS3    = round(($m==0) ? 0 : $TGS3/$m);
                echo '<td align="center" style="font-size:11px ;">'.$RTTGS3.'</td>';
                
                $jmltgs = $RTTGS1 + $RTTGS2 + $RTTGS3;
                $ho = ($RTTGS1 == '0' || $RTTGS1 == '' ) ? '0' : 1;
                $lo = ($RTTGS2 == '0' || $RTTGS2 == '' ) ? '0' : 1;
                $jo = ($RTTGS3 == '0' || $RTTGS3 == '' ) ? '0' : 1;
                $ko = $ho + $lo + $jo;
                $RT3    = round(($ko==0) ? 0 : $jmltgs/$ko);
                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT3.'</font></td>';
                $BBT2   = $RT3 * 0.20;
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT2.'</font></b></td>';
            if($this->session->userdata('sub_pnl')=='UTS')
            {
                $UTST    = $row->UTST;
                echo '<td align="center" style="font-size:11px ;">'.$UTST.'</td>';
                $UTSP    = $row->UTSP;
                echo '<td align="center" style="font-size:11px ;">'.$UTSP.'</td>';
                
                $jmluts = $UTST + $UTSP;
                $ha = ($UTST == '0' || $UTST == '' ) ? '0' : 1;
                $la = ($UTSP == '0' || $UTSP == '' ) ? '0' : 1;
                $ka = $ha + $la;
                $RT4    = round(($ka==0) ? 0 : $jmluts/$ka);
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$RT4.'</font></b></td>';
                $BBT3   = $RT4 * 0.40;
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT3.'</font></b></td>';
                $HSL    = round($BBT1 + $BBT2 + $BBT3);
                echo '<td align="center" style="font-size:11px ;"><b>';
                echo ($HSL < $a) ? '<font color="red">' : '<font color="black">';
                echo $HSL.'</font></b></td>';
             } else {
                $RPTUTS  = $row->RPTUTS;
                echo '<td align="center" style="font-size:11px ;">'.$RPTUTS.'</td>';
                $BBT4   = $RPTUTS * 0.20;
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT4.'</font></b></td>';
                $UAST    = $row->UAST;
                echo '<td align="center" style="font-size:11px ;">'.$UAST.'</td>';
                $UASP    = $row->UASP;
                echo '<td align="center" style="font-size:11px ;">'.$UASP.'</td>';
                $jmluas = $UAST + $UASP;
                $ha = ($UAST == '0' || $UAST == '' ) ? '0' : 1;
                $la = ($UASP == '0' || $UASP == '' ) ? '0' : 1;
                $ka = $ha + $la;
                $RT4    = round(($ka==0) ? 0 : $jmluas/$ka);
                echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT4.'</font></td>';
                $BBT3   = $RT4 * 0.20;
                echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.$BBT3.'</font></b></td>';
                $HSL    = round($BBT1 + $BBT2 + $BBT3 + $BBT4);
                echo '<td align="center" style="font-size:11px ;"><b>';
                echo ($HSL < $a) ? '<font color="red">' : '<font color="black">';
                echo $HSL.'</font></b></td>';
             }   
                $sum[$i] = $HSL;
                $i++;
                echo '</tr>';
            }
                $ratakelas= (($i-1)==0) ? 0 : array_sum($sum)/($i-1);
            ?>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2"><b>&nbsp;&nbsp;Rata-rata Kelas</b></td>
                <?php if($this->session->userdata('sub_pnl')=='UTS'){ ?>
                    <td colspan="19"></td>
                <?php }else{ ?>
                    <td colspan="21"></td>
                <?php } ?>
                <td align="center" style="font-size:11px ;"><b style="color: blue;"><?php echo round($ratakelas,1); ?></b></td>
            </tr>
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