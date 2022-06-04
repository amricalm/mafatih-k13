<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
<div id="content" class="box">
<h1>KOMPETENSI DASAR</h1>
<form action="<?php echo base_url() ?>index.php/kompetensi/kompetensi_dasar_exec/db_edit/<?php echo $this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(7); ?>" name="frmfilter" id="frmfilter" method="POST">
<fieldset>
<legend>Edit Kompetensi Dasar</legend>
<table>
<tr>
<td>
<table>
    <!--<input type="hidden" name="id_sk" id="id_sk" value="<?php echo $this->uri->segment(4); ?>"/>-->
    <input type="hidden" name="kd_mp" id="kd_mp" value="<?php echo $this->uri->segment(4); ?>"/>
    <!--<input type="hidden" name="kd_semester" id="kd_semester" value="<?php echo $this->uri->segment(5); ?>"/>-->
    <!--<input type="hidden" name="kd_sk" id="kd_sk" value="<?php echo $this->uri->segment(8); ?>"/>-->
    <!--<input type="hidden" name="tk" id="tk" value="<?php echo $this->uri->segment(6); ?>"/>-->
    <!--<input type="hidden" name="kd_kd" id="kd_kd" value="<?php echo $this->uri->segment(9); ?>"/>-->
    <tr>
        <td>Mata Pelajaran</td>
        <td><input type="text" disabled="disabled" name="kd_mp" id="nm_mp" value="<?php echo $mp->row()->nm_mp; ?>" /></td>
    </tr>
    <tr>
        <td>Level</td>
        <td><input style="width: 144px;" type="text" readonly="readonly" name="tk" id="tk" value="<?php echo $this->uri->segment(5); ?>" /></td>
    </tr>
    <tr>
        <td>Kompetensi Inti</td>
        <td>
            <input type="text" readonly="readonly" name="kd_ki" id="kd-ki" value="<?php echo strtoupper($this->uri->segment(6)); ?>"/>
        <input type="hidden" disabled="disabled" name="kd_sk" id="kd_sk" value="<?php //echo $sk; ?>"/></td>
    </tr>
    <tr>
        <td>Kompetensi Dasar</td>
        <td>
            <input type="text" readonly="readonly" name="kd_kd" id="kd_kd" value="<?php echo $this->uri->segment(7) ?>"/>
            </td>
    </tr>
    <tr>
        <td style="width:200px;" class="va-top">Deskripsi KD</td>
        <td><textarea name="ket_kd" id="ket_kd" style="font-size: 12px; width: 500px; height: 120px;" ><?php echo $data->ket_kd; ?></textarea></td>
    </tr>
    <!-- <tr>
        <td>SKM</td>
        <td><input type="text" name="skm" id="skm" value="<?php echo $data->skm; ?>"/></td>
    </tr> -->
    <tr>
        <td></td>
        <td>
            <input type="submit" name="simpan" id="simpan" value="Simpan" class="input-submit"/>
            <input type="reset" name="reset" id="reset" value="Cancel" class="input-submit" onclick="javascript:window.location='<?php echo base_url().'index.php/kompetensi/daftar/'.$this->uri->segment(4).'/'.$this->uri->segment(5); ?>';"/>
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
