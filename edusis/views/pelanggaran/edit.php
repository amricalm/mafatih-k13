<?php $this->load->view('page_head');?>
<body>
<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>Edit Data Pelanggaran</h1><br /><br />
            <form action="<?php echo base_url() ?>index.php/pelanggaran/pelanggaran_exec/db_edit" method="POST" name="frmedit" id="frmedit"> 
    			<?php echo form_hidden('kd_pelanggaran',$data->row()->kd_pelanggaran); ?>
			<fieldset>
			<legend>Input Jenis Pelanggaran</legend>
			<table class="nostyle" style="font-size: small;">
                <tr>
					<td style="width:200px;">Jenis Pelanggaran</td>
                    <td style="width:5px;">:</td>
					<td> 
                    <select name="kd_tpelanggaran" id="pelanggaran">
            		<?php
            			echo '<option value="0" class="input-text" ></option>';
                        $kd_tpelanggaran = trim($data->row()->kd_tpelanggaran);
            			foreach($pelanggaran->result () as $row_pelanggaran )
        				{
        					$selected		= '';
        					if($kd_tpelanggaran == trim($row_pelanggaran->kd_tpelanggaran))
        					{
        						$selected	= 'selected="selected"';
        					}
        				echo '<option value="'.trim($row_pelanggaran->kd_tpelanggaran).'" '.$selected.'>'.$row_pelanggaran->nm_tpelanggaran.'</option>';
        				}
            		?>
            		</select>
                    </td>
 				</tr>
                <tr>
					<td style="width:200px;" class="va-top">Nama Pelanggaran</td>
                    <td style="width:5px;" class="va-top">:</td>
					<td><textarea name="nm_pelanggaran" id="nm_pelanggaran" class="input-text"><?php echo $data->row()->nm_pelanggaran; ?></textarea></td>
				</tr>
				<tr>
					<td style="width:200px;">Point</td>
                    <td style="width:5px;">:</td>
					<td><input type="text" size="40" name="point" id="point" class="input-text" value="<?php echo $data->row()->point; ?>" /></td>
                </tr>
                <tr>
					<td style="width:200px; font-size: 14px;" class="va-top">Keterangan</td>
                    <td style="width:5px;" class="va-top">:</td>
					<td><textarea name="ket" id="ket" class="input-text"><?php echo $data->row()->ket;?></textarea></td>
                </tr>
                <tr>
                    <td></td><td></td>
            		<td>
                        <input type="submit" name="" class="input-submit" value="Simpan" />
                        <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/pelanggaran/daftar/' ?>';" />
                    </td>
            	</tr>
              </table><br /><br /> 
              <table class="nostyle">
            </table>
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