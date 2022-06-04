<?php $this->load->view('page_head');?>
<body>
<style type="text/css">
    @import url("<?php echo base_url().'edusis_asset/css/adn.css'; ?>");
</style>
<script type="text/javascript">
$(document).ready(function(){
        $("a.namalengkap").easyTooltip();
    });
</script>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
<div id="content" class="box">
<h1>KOMPETENSI DASAR</h1>
<?php echo form_open('kompetensi/standar_kd/',array('name'=>'frmdaftar','id'=>'frmdaftar','onsubmit'=>'return submitbaru()')) ?>
<table width="100%">
<tr>
    <td width="130px">Mata Pelajaran</td>
    <td><input type="text" disabled="disabled" name="" id="" value="<?php echo $mp->row()->nm_mp; ?>" /></td>
    <td align="right">
    <a href="" id="tombol_add" onclick="return add('<?php echo base_url(); ?>index.php/kompetensi/kd_form/db_add/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo $this->uri->segment(6); ?>/<?php echo $this->uri->segment(7); ?>/<?php echo $this->uri->segment(8); ?>');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//tambah.png" /></a>
    <a href="" id="tombol_edit" onclick="return edit('<?php echo base_url(); ?>index.php/kompetensi/kd_form/db_edit/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo $this->uri->segment(6); ?>/<?php echo $this->uri->segment(7); ?>/<?php echo $this->uri->segment(8); ?>');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//edit.png" /></a>
    <a href="" id="tombol_del" onclick="return del('<?php echo base_url(); ?>index.php/kompetensi/kd_form/db_del/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>/<?php echo $this->uri->segment(5); ?>/<?php echo $this->uri->segment(6); ?>/<?php echo $this->uri->segment(7); ?>/<?php echo $this->uri->segment(8); ?>');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//hapus.png" /></a>
    </td>
</tr>
<tr>
    <td >Tingkat/Semester</td>
    <td width="300px"><input style="width: 144px;" disabled="disabled" type="text" name="" id="" value="<?php echo $this->uri->segment(5);  ?>" />  /  <input style="width: 144px;" type="text" disabled="disabled" name="" id="" value="<?php echo $this->uri->segment(4); ?>" /> </td>
    <td></td>
</tr>
<tr>
    <td class="va-top">Standar Kompetensi</td>
    <td><textarea style="font-size: 12px;height: 65px; width: 370px;" disabled="disabled"><?php echo $sk->row()->ket_sk; ?></textarea></td>
</tr>
</table>
</form>
<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
<table width="100%" class="tables">
<tr>
    <th width="2%">#</th>
    <th width="3%">No</th>
    <th width="90%">Kompetensi Dasar</th>
    <th width="5%">SKM</th>
</tr>
<?php
    $i = 1;
    foreach($kd->result() as $row)
    {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        echo '<tr'.$bg.'>';
        echo '<td><input type="checkbox" id="'.$row->kd_kd.'" value="'.$row->id_sk.'/'.$row->kd_kd.'/'.$row->kd_sk.'/'.$row->tk.'/'.$row->kd_mp.'/'.$row->th_ajar.'/'.$row->kd_sekolah.'/'.$row->kd_semester.'"name="kode[]" /></td>';
        echo '<td align="center">'.$i.'</td>';
        //echo '<td>'.$row->ket_kd.'</td>';
?>            
        <td><a href="<?php echo base_url() ?>index.php/kompetensi/indikator/<?php echo trim($row->id_sk).'/'.trim($row->kd_semester).'/'.trim($row->tk).'/'.trim($row->kd_mp).'/'.trim($row->kd_sk).'/'.trim($row->kd_kd) ?>" title="Klik untuk menambah indikator" class="namalengkap" style="text-decoration: none;"><?php echo $row->ket_kd;?></a></td>
<?php        
        
        echo '<td align="right"><input type="text" name="skm" id="skm" value="'.$row->skm.'" style="width: 100%;  background: transparent; text-align:center; border:none;"/></td>';
        $i++;
        echo '</tr>';
    }
?>
</table>
    </div>
<table>
<tr>
    <td colspan="4" style="border-bottom: none; border-left: none;border-right: none;"><input type="reset" name="reset" id="reset" value="Tutup" class="input-submit" onclick="javascript:window.location='<?php echo base_url().'index.php/kompetensi/daftar/'.$this->uri->segment(6).'/'.$this->uri->segment(5) ?>';"/></td>
</tr>
</table>
</div>
<hr class="noscreen" />

<!-- Footer -->
<?php $this->load->view('page_footer'); ?>

<script type="text/javascript">
function submitbaru()
{
    var aksi = $('#frmdaftar').attr('action');
    var mppilih = urlencode($('#kdmp').val());
    var tkpilih = urlencode($('#tk').val());
    var actionbaru = aksi + "/" + mppilih + "/" + tkpilih;
    $('#frmdaftar').attr('action',actionbaru);
    return true;
}
//untuk link ambil nilai
    function ambil(id_sk,kd_jurusan,kd_semester,tk,kd_mp,ket_sk)
    {
		document.getElementById("id_sk").value = id_sk;
        document.getElementById("ket_sk").value = ket_sk;
        document.getElementById("kd_semester").value = kd_semester;
        document.getElementById('tk').value = tk;
        document.getElementById('kd_mp').value = kd_mp;
        ambildatanilaikom(id_sk,ket_sk,kd_semester,tk,kd_mp);
	}
    
//untuk input nilai dari text box kedatabase
    function ambildatanilaikom(id_sk,kd_jurusan,kd_semester,tk,kd_mp)
    {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().'index.php/kompetensi/get_skkd' ?>",
            data: "id_sk="+id_sk+"&kd_jurusan="+kd_jurusan+"&kd_semester="+kd_semester+"&tk="+tk+"&kd_mp="+kd_mp,
            success : function(msg) {
                $('#datakom').remove();
                $('#tempatdatakom').append(msg);
            }
        });
    }

</script>
</body>
</html>
