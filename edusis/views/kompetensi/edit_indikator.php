<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
<div id="content" class="box">
<h1>INDIKATOR</h1>
<form action="<?php echo base_url() ?>index.php/kompetensi/indikator_exec/db_edit/<?php echo $this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8).'/'.$this->uri->segment(9).'/'.$this->uri->segment(10); ?>" name="frmfilter" id="frmfilter" method="POST">
<fieldset>
<legend>Edit Indikator</legend>
<table>
<!--<input type="hidden" name="id_sk" id="id_sk"/>-->
<input type="hidden" name="kd_mp" id="kd_mp" value="<?php echo $this->uri->segment(7); ?>"/>
<input type="hidden" name="id_sk" id="id_sk" value="<?php echo $this->uri->segment(4); ?>"/>
<input type="hidden" name="kd_semester" id="kd_semester" value="<?php echo $this->uri->segment(5); ?>"/>
<input type="hidden" name="tk" id="tk" value="<?php echo $this->uri->segment(6); ?>"/>
<input type="hidden" name="kd_idr" id="kd_idr" value="<?php echo $this->uri->segment(10); ?>"/>
<input type="hidden" name="kd_sk" id="kd_sk" value="<?php echo $this->uri->segment(8); ?>"/>
<input type="hidden" name="kd_kd" id="kd_kd" value="<?php echo $this->uri->segment(9); ?>"/>
<tr>
<td>
<table>
<tr>
    <td>Mata Pelajaran</td>
    <td><input type="text" disabled="disabled" name="nm_mp" id="nm_mp" value="<?php echo $mp->row()->nm_mp; ?>" /></td>
</tr>
<tr>
    <td>Tingkat/Semester</td>
    <td><input style="width: 144px;" type="text" disabled="disabled" name="tk" id="tk" value="<?php echo $this->uri->segment(6); ?>" /> / <input style="width: 144px;" type="text" disabled="disabled" name="kd_semester" id="kd_semester" value="<?php echo $this->uri->segment(5); ?>" /></td>
</tr>
<!--<tr>
    <td>Kode Indikator</td>
    <td><input type="text" disabled="disabled" name="kd_idr" id="kdidr" value="<?php //echo $this->uri->segment(8); ?>"/></td>
</tr>-->
<tr>
    <td style="width:200px;" class="va-top">Indikator</td>
    <td><textarea name="ket_idr" id="ket_idr" style="font-size: 12px; width: 380px; height: 70px;" ><?php echo $ket_idr->row()->ket_idr; ?></textarea></td>
</tr>
<tr>
    <td></td>
    <td>
        <input type="submit" name="simpan" id="simpan" value="Simpan" class="input-submit"/>
        <input type="reset" name="reset" id="reset" value="Cancel" class="input-submit" onclick="javascript:window.location='<?php echo base_url().'index.php/kompetensi/indikator/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7).'/'.$this->uri->segment(8).'/'.$this->uri->segment(9) ?>';"/>
    </td>
</tr>
</table>
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
