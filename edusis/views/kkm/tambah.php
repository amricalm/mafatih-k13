<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
<div id="content" class="box">
<h1>PEMETAAN MATA PELAJARAN PER KELAS</h1>
<form action="<?php echo base_url().'index.php/kkm/kkm_exec/db_add'?>" method="post">
<br />
<fieldset>
<legend>Input KKM</legend>
<table width="100%">
<input type="hidden" name="kelas" id="kelas" value="<?php echo str_replace('+',' ',$this->uri->segment(4));?>"/>
<tr>
    <td>Kelas</td><td width="5px">:</td>
    <td><input type="text" disabled="disabled" name="kelas" id="kelas" value="<?php echo str_replace('+',' ',$this->uri->segment(4));?>"/></td>                      
</tr>
<tr>
    <td>Mata Pelajaran</td><td>:</td>
    <td>
    <?php
        $arraymp = array('');
        foreach($kdmp->result () as $rowmp )
        {
            $arraymp[$rowmp->kd_mp]=$rowmp->nm_mp;
        }
        echo form_dropdown('kd_mp',$arraymp,$kdmp,' id="mp" ');
    ?>
    </td>
</tr>
<tr>
    <td>Guru</td><td width="5px">:</td>
    <td>
    <?php
        $arrayguru = array('');
        foreach($guru->result () as $rowguru )
        {
            $arrayguru[$rowguru->nip]=$rowguru->nama_lengkap;
        }
        echo form_dropdown('guru',$arrayguru,$guru,' id="guru" ');
    ?>
    </td>                      
</tr>
<tr>
    <td style="width:100px">KKM</td><td>:</td>
    <td>
        <input type="text" name="kkm" id="kkm" value="" class="input-text"/>
    </td>
</tr>
<tr>
    <td style="width:100px" class="va-top" >Keterangan</td><td class="va-top" >:</td>
    <td>
        <textarea style="height: 105px; width: 380px;" name="deskripsi" ></textarea>
    </td>
</tr>
<tr>
    <td></td><td></td>
    <td>
        <input type="submit" name="simpan" id="simpan" class="input-submit" value="Simpan" />
        <input type="reset" name="batal" id="batal" class="input-submit"value="Batal"onclick="javascript:window.location='<?php echo base_url().'index.php/kkm/daftar/'.$this->uri->segment(4);?>';" />
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