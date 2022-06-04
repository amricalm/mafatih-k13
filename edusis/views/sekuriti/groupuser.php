<?php $this->load->view('page_head');?>
<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
		<h1>GROUP USER</h1>
		
                <table style="border:none;width:100%">
                    <tr>
                        <td style="border:none"></td>
                        <td style="border:none;text-align:right">
                            <a href="" id="tombol_add" onclick="return add('<?php echo base_url(); ?>index.php/sekuriti/group_form/DB_ADD');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>
                            <a href="" id="tombol_edit" onclick="return edit('<?php echo base_url(); ?>index.php/sekuriti/group_form/DB_EDIT');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
                            <a href="" id="tombol_del" onclick="return del('<?php echo base_url(); ?>index.php/sekuriti/group_form/DB_DEL');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/hapus.png" /></a>
                        </td>
                    </tr>
                </table>
            <div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    			<table style="width:100%" class="tables">
    				<tr>
    				    <th style="width:1px">#</th>
    				    <th style="width:1px">No</th>
                        <th style="width:500px">Nama Group User</th>
                        <th style="width:500px">Keterangan</th>
    				</tr>
                    <form name="form">
					<?php	
                        $seq = 1;
						foreach($group->result() as $row):
					?>						
    				<tr class="<?php  if($seq % 2 == 0) echo "bg"; else echo "";?>">
                        <td align="center"><input type="checkbox" id="<?php echo $row->kd_group;?>" name="kode[]" /></td>
    				    <td align="right"><?php echo $seq;?></td>
                        <!--<td align="center" style="width:5px"><a href="<?php //echo site_url('sekuriti/role/' . $row->kd_group);?>"><img title="Otorisasi Group" src="<?php //echo base_url()?>edusis_asset/edusisimg/cog.png" /></a></td>
						<td align="center" style="width:5px"><?php //echo $row->kd_group ?></td>-->
						<td style="width:200px"><?php echo $row->nm_group;?></td>
						<td style="width:300px"><?php echo $row->ket;?></td>
					<?php	
                        $seq++;
						endforeach;
					?>							
    				</tr>
                    </form>
    			</table>
            </div>
        </div>
	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
<script type="text/javascript" src="<?php echo base_url(); ?>edusis_asset/js/aksi.js"></script>
</body>
</html>