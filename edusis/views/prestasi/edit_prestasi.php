<?php $this->load->view('page_head');?>

<body>
 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>
  
		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>PRESTASI</h1>
            <form action="<?php echo base_url() ?>index.php/prestasi/prestasi_exec/db_edit" method="POST" name="frmpelanggaran" id="frmpelanggaran"> 
			<input type="hidden" name="kd_prestasi" value="<?php echo trim($data->row()->kd_prestasi) ?>" />
            <fieldset>
			<legend>Edit Prestasi</legend>
			<table class="nostyle" style="font-size: small;">
                <tr>
					<td class="va-top">Prestasi</td>
                    <td class="va-top">:</td>
					<td><textarea style="font-size : 14px; height:60px; width:300px;" name="nm_prestasi" id="nm_prestasi" class="input-text"><?php echo $data->row()->nm_prestasi; ?></textarea></td>
                </tr>
                <tr>
					<td>Poin</td>
                    <td>:</td>
					<td><input type="text" size="40" name="point" id="point" class="input-text" value="<?php echo $data->row()->point; ?>" /></td>
				</tr>
                <tr>
					<td class="va-top">Keterangan</td>
                    <td class="va-top">:</td>
					<td><textarea style="font-size : 14px; height:60px; width:300px;" name="ket" id="ket" class="input-text"><?php echo $data->row()->ket; ?></textarea></td>
                </tr>
                <tr>
                    <td></td><td></td>
            		<td>
                        <input type="submit" name="" class="input-submit" value="Edit" />
                        <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/prestasi/daftar_prestasi/' ?>';" />
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