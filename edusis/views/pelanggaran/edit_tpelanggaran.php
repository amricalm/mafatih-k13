<?php $this->load->view('page_head');?>

<body>
 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>
  
		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>JENIS PELANGGARAN</h1>
            <form action="<?php echo base_url() ?>index.php/pelanggaran/tpelanggaran_exec/db_edit" method="POST" name="frmpelanggaran" id="frmpelanggaran"> 
			<input type="hidden" name="kd_tpelanggaran" value="<?php echo trim($data->row()->kd_tpelanggaran) ?>" />
            <fieldset>
			<legend>Edit Jenis Pelanggaran</legend>
			<table class="nostyle" style="font-size: small;">
                <tr>
					<td style="width:150px;">Kode</td>
                    <td style="width:1px;">:</td>
					<td><input type="text" disabled="disabled" size="40" name="kd_tpelanggaran" id="kd_tpelanggaran" class="input-long" value="<?php echo trim($data->row()->kd_tpelanggaran) ?>" /></td>
				</tr>
                <tr>
					<td>Nama Pelanggaran</td>
                    <td>:</td>
					<td><input type="text" size="40" name="nm_tpelanggaran" id="nm_tpelanggaran" class="input-text" value="<?php echo $data->row()->nm_tpelanggaran ?>" /></td>
				</tr>
                <tr>
                <tr>
                    <td></td><td></td>
            		<td>
                        <input type="submit" name="" class="input-submit" value="Edit" />
                        <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/pelanggaran/daftar_tpelanggaran/' ?>';" />
                    </td>
            	</tr>
             </table>
		      </fieldset>
        </form>
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
        //alert(iddaftar);
    }
</script>
</body>
</html>