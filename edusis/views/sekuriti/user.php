<?php $this->load->view('page_head');?>
<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
		<h1>USER</h1>
        
                <table style="border:none;width:100%">
                    <tr>
                        <td style="border:none"></td>
                        <td style="border:none;text-align:right">
                            <a href="" id="tombol_add" onclick="return add('<?php echo base_url(); ?>index.php/sekuriti/user_form/db_add');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>
                            <a href="" id="tombol_edit" onclick="return edit('<?php echo base_url(); ?>index.php/sekuriti/user_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
                            <a href="" id="tombol_del" onclick="return del('<?php echo base_url(); ?>index.php/sekuriti/user_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/hapus.png" /></a>
                        </td>
                    </tr>
                </table>
            <div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    			<table style="width:100%" class="tables">
    				<tr>
    				    <th style="width:5px">#</th>
    				    <th style="width:25%">Nama Login</th>
    				    <th style="width:50%">Nama User</th>
    				    <th style="width:25%">Group User</th>
    				</tr>
					<?php	
                        $seq = 1;
						foreach($user->result() as $row):
					?>						
    				<tr class="<?php  if($seq % 2 == 0) echo "bg"; else echo "";?>">
                        <td><input type="checkbox" id="<?php echo $row->nama_login;?>" name="kode[]" /></td>
    				    <td><?php echo $row->nama_login; ?></td>
    				    <td><?php echo $row->nama_lengkap; ?></td>
    				    <td><?php echo $row->nm_group; ?></td>
    				</tr>
					<?php	
                        $seq++;
						endforeach;
					?>	
    			</table>
			</div>

            </div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
<script type="text/javascript">
function submitbaru()
{
    var aksi = $('#frmdaftar').attr('action');
    var kelaspilih = urlencode($('#kelas').val());
    var bulanpilih = urlencode($('#bulan').val());
    var tglpilih   = urlencode($('#tgl').val());
    var actionbaru = aksi + "/" + kelaspilih + "/" + bulanpilih + "/" + tglpilih;
    $('#frmdaftar').attr('action',actionbaru);
    return true;
}
</script>
</body>
</html>