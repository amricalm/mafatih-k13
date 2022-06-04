 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>KELAS</h1>
                <table style="border:none;width:100%">
                    <tr>
                        <td style="border:none;text-align:left"></td>
                        <td style="border:none;text-align:right">
                            <a href="" id="tombol_add" title="Tambah Kelas " onclick="return add('<?php echo base_url(); ?>index.php/kelas/kelas_form/db_add');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>
                            <a href="" id="tombol_edit" title="Edit Kelas " onclick="return edit('<?php echo base_url(); ?>index.php/kelas/kelas_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
                            <a href="" id="tombol_del" title="Hapus Kelas " onclick="return del('<?php echo base_url(); ?>index.php/kelas/kelas_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/hapus.png" /></a>
                        </td>
                    </tr>
                </table>
			<div style="border:1px solid #999999" border="1">
    			<table style="width:100%" class="tables">
                <form action="" name="" method=""> 
    				<tr>
    				    <th style="width:2%"></th>
    				    <th style="width:98%">Kelas</th>
    				    <!--<th style="width:50%">Jurusan</th>-->
    				</tr>
					<?php	
                        $seq = 1;
						foreach($kelas->result() as $row):
					?>						
    				<tr class="<?php  if($seq % 2 == 0) echo "bg"; else echo "";?>">
                        <td><input type="checkbox" id="<?php echo $row->kelas;?>" name="kode[]" /></td>
    				    <td><?php echo $row->kelas;?></td>
					<?php	
                        $seq++;
						endforeach;
					?>							
    				</tr>
                </form>
    			</table>
		  </div>
	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
</body>
</html>