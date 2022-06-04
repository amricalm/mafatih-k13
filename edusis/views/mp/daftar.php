 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>MATA PELAJARAN</h1>
            
                <table style="border:none;width:100%">
                    <tr>
                        <td style="border:none;text-align:left"></td>
                        <td style="border:none;text-align:right">
                            <a href="" id="tombol_add" title="Tambah Mata Pelajaran " onclick="return add('<?php echo base_url(); ?>index.php/mp/mp_form/db_add');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//tambah.png" /></a>
                            <a href="" id="tombol_edit" title="Edit Mata Pelajaran" onclick="return edit('<?php echo base_url(); ?>index.php/mp/mp_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//edit.png" /></a>
                            <a href="" id="tombol_del" title="Hapus Mata Pelajaran" onclick="return del('<?php echo base_url(); ?>index.php/mp/mp_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//hapus.png" /></a>
                        </td>
                    </tr>
                </table>
			<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    			<table class="tables" style="width:100%">
    				<tr>
    				    <th style="width:5px"></th>
                                    <th style="width:10%">Kode</th>
    				    <th style="width:90%">Mata Pelajaran</th>
    				</tr>
					<?php	
                        $seq = 1;
						foreach($mp->result() as $row):
					?>						
    				<tr class="<?php  if($seq % 2 == 0) echo "bg"; else echo "";?>">
                        <td><input type="checkbox" id="<?php echo $row->kd_mp;?>" name="kode[]" /></td>
                        <td><?php echo $row->kd_mp;?></td>
    				    <td><?php echo $row->nm_mp;?></td>
					<?php	
                        $seq++;
						endforeach;
					?>							
    				</tr>
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