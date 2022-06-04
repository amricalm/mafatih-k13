 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>TAHUN AJAR</h1>
                <br />
                <form action="<?php echo base_url() ?>index.php/th_ajar/th_ajar_exec/db_edit" method="POST" onsubmit="return validasi()">
                <?php echo form_hidden('th_ajar',$data->row()->th_ajar); ?>
    			<fieldset>
    				<legend>Edit Tahun Ajar</legend>
    				<table class="nostyle" style="font-size: small;">
    					<tr>
    						<td class="va-top">Tahun Ajar</td>
                            <td>:</td>
                            <td><input type="text" size="40" name="th_ajar" id="th_ajar" class="input-text" value="<?php echo $data->row()->th_ajar ?>" disabled="disabled" /></td>
    					</tr>
    					<tr>
    						<td class="va-top">Keterangan</td>
                            <td class="va-top">:</td>
                            <td><textarea name="keterangan" id="keterangan"><?php echo $data->row()->keterangan ?></textarea></td>
    					</tr>
    					<tr>
    						<td class="va-top">Kepala Sekolah</td>
                            <td>:</td>
                            <td>
                                <select name="nip" id="nip">
                                    <option value=""></option>
                                    <?php
                                        foreach($pegawai->result() as $rowpegawai)
                                        {
                                            $pilih      = ($data->row()->nip==$rowpegawai->nip) ? ' selected="selected" ' : '';
                                            echo '<option value="'.$rowpegawai->nip.'"'.$pilih.'>'.$rowpegawai->nama_lengkap.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
    					</tr>
                        <tr>
                            <td style="width: 100px;"></td><td>&nbsp;</td>
                    		<td colspan="2" class="t-left">
                                <input type="submit" name="" class="input-submit" value="Edit" />
                                <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/th_ajar/daftar'; ?>'" />
                            </td>
                    	</tr>
    				</table>
                </fieldset>	
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
    var th_ajar = $('#th_ajar').val();
    peringatan  += (th_ajar=='') ? "Tahun Ajar harus diisi!\n" : '';
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