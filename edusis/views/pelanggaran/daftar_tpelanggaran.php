<?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>JENIS PELANGGARAN</h1>

		
            
                <?php echo form_open('pelanggaran/daftar',array('name'=>'frmdaftar','id'=>'frmdaftar')) ?>
                <table style="border:1 ;width:100%">
                    <tr>
                        <td style="border:none;text-align:right" rowspan="2">
                            <?php //if ($this->session->userdata('user_id')=="Admin") {?>
                            <a href="" id="tombol_add" onclick="return add('<?php echo base_url(); ?>index.php/pelanggaran/tpelanggaran_form/db_add');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>
                            <a href="" id="tombol_edit" onclick="return edit('<?php echo base_url(); ?>index.php/pelanggaran/tpelanggaran_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
                            <a href="" id="tombol_del" onclick="return del('<?php echo base_url(); ?>index.php/pelanggaran/tpelanggaran_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/hapus.png" /></a>
                            <?php //}?>
                        </td>
                    </tr>
                </table>
                </form>
			<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    			<table width="100%"  class="tables" border="1">
    				<tr>
    				    <th width="1%">#</th>
    				    <th width="8%">Kode</th>
    				    <th width="87%" align="left">Pelanggaran</th>
    				</tr>
                    <?php 
                    $seq = 1;
                    foreach($pelanggaran->result() as $row)
                    {
                        $bg = ($seq%2==0) ? ' class="bg" ' : '';
                        echo '<tr'.$bg.'>';
                        echo '<td><input type="checkbox" id="'.$row->kd_tpelanggaran.'" name="kode[]" /></td>';
                        echo '<td>'.$row->kd_tpelanggaran.'</td>';
                        echo '<td>'.$row->nm_tpelanggaran.'</td>';
                        //echo '<td>'.$row->point.'</td>';
                        echo '</tr>';
                        $seq++;
                    }
                    ?>
    			</table>
			</div>
            </div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
<script type="text/javascript">
    function submitbypelanggaran()
    {
        var varkelas = $('#pelanggaran').val();
        var iddaftar = $('#frmdaftar').attr('action');
        window.location = iddaftar+"/"+varkelas;
        alert(iddaftar);
    }
</script>
</body>
</html>