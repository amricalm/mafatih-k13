<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>Edit Standar Kompetensi</h1>
<form action="<?php echo base_url() ?>index.php/kompetensi/kompetensi_exec/db_edit/<?php echo $this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6); ?>" name="frmfilter" id="frmfilter" method="POST">
<!--<input type="hidden" name="id_sk" id="id_sk"/>-->
<input type="hidden" name="kd_mp" id="kd_mp" class="input-text" value="<?php echo $data->row()->kd_mp?>"/>
<input type="hidden" name="tk" id="tk" class="input-text" value="<?php echo $data->row()->tk?>"/>
<input type="hidden" name="kd_sk" id="kd_sk" class="input-text" value="<?php echo $data->row()->kd_sk;?>"/>
<fieldset>
<legend>Edit Standar Kompetensi</legend>
<table>
<tr>
    <td>Muatan Pelajaran</td>
    <td >
        <input type="text" disabled="disabled" name="" id="" class="input-text" value="<?php echo $data->row()->nm_mp?>"/>
    </td>
</tr>
<tr>
    <td>Tingkat</td>
    <td>
        <input style="width: 120px;" type="text" disabled="disabled" name="" id="" class="input-text" value="<?php echo $data->row()->tk?>"/>
    </td>
</tr>
<!--<tr>
    <td>Kode SK</td>
    <td>
        <input type="text" disabled="disabled" name="" id="" class="input-text" value="<?php //echo $data->row()->kd_sk;?>"/>
    </td>
</tr>-->
<tr>
    <td style="width:200px;" class="va-top">Standard Kompetensi</td>
    <td><textarea style="font-size: 12px; width: 380px; height: 70px;" name="ket_sk" id="ket_sk" ><?php echo $data->row()->ket_sk;?></textarea></td>
</tr>
<!--<tr>
    <td>KKM</td>
    <td><input type="text" name="skm" id="skm" class="input-text" value="<?php //echo $data->row()->skm;?>"/></td>
</tr>-->
<tr>
    <td></td>
    <td>
        <input type="submit" name="simpan" id="simpan" value="Simpan" class="input-submit"/>
        <input type="reset" name="reset" id="reset" value="Cancel" class="input-submit" onclick="javascript:window.location='<?php echo base_url().'index.php/kompetensi/daftar/'.$this->uri->segment(4).'/'.$this->uri->segment(5) ?>';"/>
    </td>
</tr>
</table>
</fieldset>
</form>
</div>
<hr class="noscreen" />

<!-- Footer -->
<?php $this->load->view('page_footer'); ?>
</script>
</body>
</html>
