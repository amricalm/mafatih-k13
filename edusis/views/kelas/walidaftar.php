 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>WALI KELAS</h1>
                <table style="border:none;width:100%">
                    <tr>
                        <td style="border:none;text-align:left"></td>
                        <td style="border:none;text-align:right">
                            <!--<a href="" id="tombol_add" title="Input" onclick="return add('<?php //echo base_url(); ?>index.php/walikelas/wali_form/db_add');" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>-->
                            <a href="<?php echo base_url().'index.php/export/daftar_kelas/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Daftar Kelas" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
                            <a href="" id="tombol_edit" title="Edit" onclick="return edit('<?php echo base_url(); ?>index.php/walikelas/wali_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
                        </td>
                    </tr>
                </table>
			<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    			<table style="width:100%" class="tables">
                <form action="" name="" method=""> 
    				<tr>
    				    <th style="width:2%">#</th>
    				    <th style="width:20%">Kelas</th>
    				    <th style="width:60%">Wali Kelas</th>
    				    <!--<th style="width:20%">Total</th>-->
    				</tr>
					<?php
                        $totalsiswa	    = 0;
                        $seq            = 1;
						foreach($kelas->result() as $row):
					?>						
    				<tr class="<?php  if($seq % 2 == 0) echo "bg"; else echo "";?>">
                        <td><input type="checkbox" id="<?php echo $row->kelas;?>" name="kode[]" /></td>
    				    <td><?php echo $row->kelas;?></td>
                        <td><?php echo $row->nama_lengkap;?></td>
					<?php
                        $data['kls']    = $row->kelas;
//                        $siswajml       = $this->kelas_model->get_jmlsiswaperkelas($data)->num_rows();	
//                        echo '<td align="center">'.$siswajml.'</td>';
//                        $totalsiswa += $siswajml;
                        $seq++;
						endforeach;
					?>							
    				</tr>
<!--                    <tr>
                        <td colspan="3"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Kelas</b></td>
                        <td align="center"><b><?php //echo $totalsiswa; ?></b></td>
                    </tr>-->
                </form>
    			</table>
		  </div>
    <?php //echo $this->pagination->create_links(); ?> &nbsp;&nbsp;&nbsp;
	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
</body>
</html>