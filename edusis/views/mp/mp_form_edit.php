 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>MATA PELAJARAN</h1>
            <br />
			<div id="tabs">
                <form action="<?php echo base_url() ?>index.php/mp/mp_exec/db_edit" method="POST" onsubmit="return validasi()">
                <?php echo form_hidden('kd_mp',$data->row()->kd_mp); ?>
    			<div id="tab01">
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td style="width:10%;">Kode</td>
                            <td style="width:1%;">:</td>
                            <td style="width:89%;"><input type="text" size="40" name="kd_mp" id="kd_mp" class="input-text" value="<?php echo $data->row()->kd_mp ?>" disabled="disabled" /></td>
    					</tr>
    					<tr>
    						<td>Mata Pelajaran</td>
                            <td>:</td>
                            <td><input type="text" name="nm_mp" id="nm_mp" class="input-text" value="<?php echo $data->row()->nm_mp ?>" /></td>
    					</tr>
    					<tr>
    						<td>Urutan</td>
                            <td >:</td>
                            <td><input type="text" name="urutan" id="urutan" class="number input-text" value="<?php echo $data->row()->urutan; ?>" /></td>
    					</tr>
                        <tr>
                            <td></td><td></td>
                            <td>
                                <input type="submit" name="simpan" class="input-submit" value="Edit" />
                                <input type="button" name="batal" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/mp/daftar' ?>';" />
                            </td>
                    	</tr>
    				</table>	
    			</div>
			</div>
            </form>
		</div>
	</div> <!-- /cols -->
	<hr class="noscreen" />
	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
</div> <!-- /main -->
<script type="text/javascript">
function validasi()
{
    var peringatan = '';
    var mp = $('#kd_mp').val();
    var nmmp = $('#nm_mp').val();
    peringatan  += (mp=='') ? "Kode Mata Pelajaran harus diisi!\n" : '';
    peringatan  += (nmmp=='') ? "Nama Mata Pelajaran harus diisi!\n" : '';
    if(peringatan!='')
    {
        alert(peringatan);
        return false;
    }
    else
    {
        return true;
    }
}
</script>
</body>
</html>