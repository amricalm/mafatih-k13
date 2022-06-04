<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>CATATAN WALI KELAS</h1>
<?php echo form_open('task/comment/',array('name'=>'frmdaftar','id'=>'frmdaftar','onsubmit'=>'return submitbaru()')) ?>
<table width="100%">
<tr>
    <td width="100px">Pilih Kelas</td>
    <td width="300px">
    <?php
        $arraykelas = array('');
        foreach($kelass->result () as $rowkelas )
        {
            $arraykelas[$rowkelas->kelas]=$rowkelas->kelas;
        }
        echo form_dropdown('kelas',$arraykelas,$kelas,' id="kelas" ');
    ?>
    </td>
    <td>
        <input type="submit" name="submit" id="submit" value="Filter" class="input button blue"/>
    </td>                         
</tr>
</table>
</form>
<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
<form action="<?php echo base_url().'index.php/task/input'?>" method="post">
<input type="hidden" name="kelas" id="kelas" value="<?php echo $kelas; ?>"/>
<table style="width:100%;" class="tables">
<tr>
    <th width="2%">No.</th>
    <th width="5%">NIS</th>
    <th width="20%">Nama Siswa</th>
    <th width="73%">Catatan Wali Kelas</th>
</tr>
    <?php
        $i = 1;
        if($this->input->post('submit'))
        {
            foreach($comment->result() as $row )
            {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td class="va-top" align="center">'.$i.'</td>';
                echo '<td class="va-top">'.$row->nis.'</td>';
                echo '<td class="va-top">'.$row->nama_lengkap.'</td>';
                echo '<input type="hidden" name="nilai[]" id="nilai[]" value="'.$row->nis.'"/>';
                echo '<td class="va-top" cellpadding="0" cellspacing="0" ><textarea style="background:transparent; width: 100%; height:50px; border:none; font-size: 12px; resize:none; " name="comment'.($i-1).'" id="comment" >'.$row->comment.'</textarea></td>';
                $i++;
                echo '</tr>';
            }
       
    ?>
<?php }?>
</table>
</div>

<?php if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0') {?>
<table style="width: 100%;">
<tr>
    <td align="right" colspan="4" style="border-bottom: none; border-right: none; border-left: none;">
        <input type="submit" name="simpan" id="simpan" class="input-submit blue" value="Simpan" />
        <input type="reset" name="batal" id="batal" class="input-submit blue"value="Batal"/>
    </td>
</tr>
</table>
<?php }?>
</form>
</div>
</div>
<?php $this->load->view('page_footer'); ?>
<script type="text/javascript">
function submitbaru()
{
    var aksi = $('#frmdaftar').attr('action');
    var kelaspilih = urlencode($('#kelas').val());
    //var bulanpilih = urlencode($('#bulan').val());
    //var tglpilih   = urlencode($('#tgl').val());
    var actionbaru = aksi + "/" + kelaspilih;
    $('#frmdaftar').attr('action',actionbaru);
    return true;
}
</script>
</body>
</html>