<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>KOMPETENSI DASAR</h1>
<form action="<?php echo base_url() ?>index.php/kompetensi/kompetensi_dasar_exec/db_add/<?php echo $this->uri->segment(4).'/'.$this->uri->segment(5); ?>" name="frmfilter" id="frmfilter" method="POST">
<input type="hidden" name="kd_mp" id="kd_mp" value="<?php echo $this->uri->segment(4); ?>"/>
<input type="hidden" name="tk" id="tk" value="<?php echo $this->uri->segment(5); ?>"/>
<input type="hidden" name="kd_sk" id="kd_sk" value="<?php echo $sk; ?>"/>
<fieldset>
<legend>Input Kompetensi Dasar </legend>
<table>
<!--<input type="hidden" name="id_sk" id="id_sk"/>-->
<tr>
<td>
<table>
<tr>
    <td>Muatan Pelajaran</td>
    <td><input type="text" disabled="disabled" name="nm_mp" id="nm_mp" value="<?php echo $mp->row()->nm_mp; ?>" /></td>
</tr>
<tr>
    <td>Level</td>
    <td><input style="width: 144px;" type="text" disabled="disabled" name="tk" id="tk" value="<?php echo $this->uri->segment(5); ?>" /></td>
</tr>
<tr>
    <td>Kompetensi Inti</td>
    <td><?php
            $arrKi = array('');
            foreach($ki->result () as $row )
            {
                $arrKi[trim($row->kd_ki)]= "[". strtoupper($row->kd_ki) . "] - " . $row->deskripsi;
            }
            echo form_dropdown('kd_ki',$arrKi,"",'class="input-text", id="kd-ki"','required="required"');
        ?>
    <input type="hidden" disabled="disabled" name="kd_sk" id="kd_sk" value="<?php //echo $sk; ?>"/></td>
</tr>
<tr>
    <td>Kompetensi Dasar</td>
    <!--<td><input type="text" name="kd_kd" id="kd_kd" value="<?php //echo $sk; ?>"/></td>-->
		<td>
			<select name="kd_kd" id="kd_kd" required="required">
					<?php
							$kd  = array(''=>'','KD1'=>'KD1','KD2'=>'KD2','KD3'=>'KD3','KD4'=>'KD4','KD5'=>'KD5','KD6'=>'KD6','KD7'=>'KD7','KD8'=>'KD8','KD9'=>'KD9','KD10'=>'KD10','KD11'=>'KD11','KD12'=>'KD12');
							foreach($kd as $keykd=>$valuekd)
							{
									echo '<option value="'.$keykd.'">'.$valuekd.'</option>';
							}
					?>
			</select>
		</td>
</tr>

<tr>
    <td style="width:200px;" class="va-top">Deskripsi KD</td>
    <td><textarea name="ket_kd" id="ket_kd" style="font-size: 12px; width: 500px; height: 120px;" ></textarea></td>
</tr>
<!-- <tr>
    <td>SKM</td>
    <td><input type="text" name="skm" id="skm"/></td>
</tr> -->
<tr>
    <td></td>
    <td>
        <input type="submit" name="simpan" id="simpan" value="Simpan" class="input-submit"/>
        <input type="reset" name="reset" id="reset" value="Cancel" class="input-submit" onclick="javascript:window.location='<?php echo base_url().'index.php/kompetensi/daftar/'.$this->uri->segment(4).'/'.$this->uri->segment(5) ?>';"/>
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
