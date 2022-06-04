<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
<div id="content" class="box">
<h1>PEMETAAN MATA PELAJARAN PER KELAS</h1>
<form action="<?php echo base_url().'index.php/kkm/kkm_exec/db_edit'?>" method="post">
<input type="hidden" name="kd_mp" id="kd_mp" value="<?php echo $data->row()->kd_mp;?>"/>
<input type="hidden" name="kelas" id="kelas" value="<?php echo $data->row()->kelas;?>"/>
<fieldset>
<legend>Edit KKM</legend>
<table width="100%">
<tr>
    <td>Mata Pelajaran</td><td>:</td>
    <td><input type="text" disabled="disabled" name="kd_mp" id="kd_mp" class="input-text" value="<?php echo $mp->row()->nm_mp;?>"/></td>
</tr>
<tr>
    <td>Kelas</td><td width="5px">:</td>
    <td><input type="text" disabled="disabled" name="kelas" id="kelas" class="input-text" value="<?php echo $data->row()->kelas;?>"/></td>                  
</tr>
<tr>
    <td>Guru</td><td width="5px">:</td>
    <td>
    
    <?php
        $arrayguru = array('');
        foreach($guru->result () as $rowguru )
        {
            $arrayguru[trim($rowguru->nip)]=$rowguru->nama_lengkap;
        }
        echo form_dropdown('guru',$arrayguru,trim($data->row()->nip),' id="guru" ');
    ?>
    </td>
</tr>
<!--<tr>
    <td>Teacher</td><td width="5px">:</td>
    <td><input type="text" name="guru" id="geru" class="input-text" value="<?php //echo $data->row()->nip;?>"/></td>                    
</tr>-->
<tr>
    <td style="width:150px">KKM</td><td>:</td>
    <td>
        <input type="text" name="kkm" id="kkm" class="input-text" value="<?php echo $data->row()->skbm; ?>"/>
    </td>
</tr>
<tr>
    <td style="width:150px" class="va-top">Keterangan</td><td class="va-top" >:</td>
    <td>
        <textarea style="height: 105px; width: 380px;" name="deskripsi" ><?php echo $data->row()->deskripsi ?></textarea>
    </td>
</tr>
<tr>
    <td></td><td></td>
    <td>
        <input type="submit" name="simpan" id="simpan" class="input-submit" value="Edit" />
        <input type="reset" name="batal" id="batal" class="input-submit"value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/kkm/daftar/'.$this->uri->segment(4); ?>'" />
    </td>
</tr>
</table>
</fieldset>
</form>
</div>
</div>
<!-- Footer -->
<?php $this->load->view('page_footer'); ?>
</body>
</html>