  <?php $this->load->view('page_head');?>

<body>
 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>
  
		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>Form Input Pelanggaran</h1>
            <form action="<?php echo base_url() ?>index.php/pelanggaran/pelanggaran_exec/db_add" method="POST" name="frmpelanggaran" id="frmpelanggaran"> 
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
            			if($pelanggaran->num_rows() !=0)
            			{
            				foreach($pelanggaran->result () as $rowkd_tpelanggaran )
            				{
            					$selected		= '';
            					if($pilihkd_tpelanggaran == trim($rowkd_tpelanggaran->kd_tpelanggaran))
            					{
            						$selected	= 'selected="selected"';
            					}
            				echo '<option value="'.trim($rowkd_tpelanggaran->kd_tpelanggaran).'" '.$selected.'>'.$rowkd_tpelanggaran->nm_tpelanggaran.'</option>';
            				}
            			}
            		?>
            		</select>
                    </td>
				</tr>
                <!--<tr>
					<td style="width:200px;">Kode Pelanggaran</td>
                    <td style="width:5px;">:</td>
					<td><input type="text" size="40" name="kd_pelanggaran" id="kd_pelanggaran" class="input-text" /></td>
				</tr>-->
                <tr>
					<td style="width:200px; font-size: 14px;" class="va-top">Nama Pelanggaran</td>
                    <td style="width:5px;" class="va-top">:</td>
					<td><textarea name="nm_pelanggaran" id="nm_pelanggaran" class="input-text"></textarea></td>
                </tr>
				<tr>
					<td style="width:200px; font-size: 14px;">Point</td>
                    <td style="width:5px;">:</td>
					<td><input type="text" size="40" name="point" id="point" class="input-text" /></td>
				</tr>
                <tr>
					<td style="width:200px; font-size: 14px;" class="va-top">Keterangan</td>
                    <td style="width:5px;" class="va-top">:</td>
					<td><textarea name="ket" id="ket" class="input-text"></textarea></td>
                </tr>
                <tr>
                    <td></td><td></td>
            		<td>
                        <input type="submit" name="" class="input-submit" value="Simpan" />
                        <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/pelanggaran/daftar/' ?>';" />
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