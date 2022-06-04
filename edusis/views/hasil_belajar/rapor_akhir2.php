<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>LEDGER AKHIR</h1>

    <form action="<?php echo base_url().'index.php/hasilbelajar/rapor_akhir2' ?>" method="POST" id="frmhasilbelajar">
    <!--atur pd (edusis_system/helpers/form_helper.php)function form_hidden, dg menambahkan (id="'.$name.'")-->
    <?php echo form_hidden('myurl',site_url('hasilbelajar')) ?>
    <!--table filter-->                            
        <table  border="0" width="100%">
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
                <!--<a href="javascript:ledger_depan('<?php //echo base_url(); ?>index.php/export/ledger_sampul_depan/');" id="" title="Print Cover" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg//print.png" /></a>-->
                <a href="<?php echo base_url().'index.php/export/export_rapor_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
                <?php } ?>
                </td>  
            </tr>
            <tr>
                <td>Mata pelajaran</td>   
                <td>
                    <?php
                        $arraymp = array('');
                        foreach($df_mp->result () as $rowmp )
                        {
                            $arraymp[$rowmp->kd_mp]=$rowmp->nm_mp;
                        }
                        echo form_dropdown('kd_mp',$arraymp,$pilihmp,' id="mp" onchange="pilih()" ');
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
        <table id="tdata" class="tables" align="center" width="100%" cellpadding="0">
            <tr>
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
    		<tr>
    			<th width="8%" style="font-size:12px ;">KKM=<?php $a=''; if($kkm->num_rows()>0){ $a = ($kkm->row()->skbm == '' || $kkm->row()->skbm == '0') ? '' : $kkm->row()->skbm; echo $a;}?></th>
        	    <th width="8%" style="font-size:12px ;">KKM=<?php $a=''; if($kkm->num_rows()>0){ $a = ($kkm->row()->skbm == '' || $kkm->row()->skbm == '0') ? '' : $kkm->row()->skbm; echo $a;}?></th>
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
        $('#frmhasilbelajar').attr('name','filter');
        $('#frmhasilbelajar').attr('action',form_wi+'/'+kelas+'/'+mp);
        $('#frmhasilbelajar').submit();
    }
    function pilih()
    {
        $('#tdata tr td').each(function(){
            $(this).remove();
        });

    }
</script>

</body>
</html>
