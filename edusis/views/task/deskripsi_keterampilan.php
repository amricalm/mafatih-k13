<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>DESKRIPSI KETERAMPILAN</h1>
<?php echo form_open('task/deskripsi_keterampilan/',array('name'=>'frmdaftar','id'=>'frmdaftar','onsubmit'=>'return submitbaru()')) ?>
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
<tr>
    <td>Mata Pelajaran</td>
    <td>
    <?php
        $arraymp = array('');
        foreach($df_mp->result () as $rowmp )
        {
            $arraymp[$rowmp->kd_mp]=$rowmp->nm_mp;
        }
        echo form_dropdown('kd_mp',$arraymp,$kd_mp,' id="mp" ');
    ?>
    </td>
</tr>
</table>
</form>
<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
<form action="<?php echo base_url().'index.php/task/inputCatatanKeterampilan'?>" method="post">
<input type="hidden" name="kelas" id="kelas" value="<?php echo $kelas; ?>"/>
<input type="hidden" name="mp"  value="<?php echo $kd_mp; ?>"/>
<table id="AdnTable" style="width:100%;" class="tables">
<tr>
    <th width="2%">No.</th>
    <th width="5%">NIS</th>
    <th width="20%">Nama Siswa</th>
    <th width="73%">Deskripsi Keterampilan</th>
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
                echo '<td class="va-top" data-kolom="nis">'.$row->nis.'</td>';
                echo '<td class="va-top">'.$row->nama_lengkap.'</td>';
                echo '<input type="hidden" name="nilai[]" id="nilai[]" value="'.$row->nis.'"/>';
                echo '<td class="va-top" cellpadding="0" cellspacing="0" ><textarea data-kolom="nilai" style="background:transparent; width: 100%; height:50px; border:none; font-size: 12px; resize:none; " name="comment'.($i-1).'" id="comment" >'.$row->comment.'</textarea></td>';
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
        <input type="button" name="simpan" id="btnSimpan" class="input-submit blue" value="Simpan" />
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
$(document).ready(function()
{
    console.log("Loading... Sukses");
    $('#btnSimpan').click(function(){
        simpan();
    });
});

//------------------- CRUD ----------------------------------------------------
function simpan()
{
    console.log('Eksekusi Simpan....');
    
    var AoA = new Array();
    var iUrutan = 0;
    var kd_mp = $('#mp').val();
    var kelas = $('#kelas').val();
    
    $('#AdnTable tr').each(function(){

            var nis = $(this).find("[data-kolom='nis']");

            if ($(nis).val()!=undefined)
            {                
                var deskripsi = $(this).find("[data-kolom='nilai']").val();
                var o = new NilaiDtl(kd_mp, kelas, $(nis).html(),deskripsi);
                AoA.push(o);
                iUrutan++;
            }
    });

    if($(AoA).length <1)
    {
        alert('Nilai Tidak boleh kosong!');
        //$('#niai').focus();
    }
    else
    {
        $("#proses").dialog("open");
        var data = {
            kd_mp       : $('#mp').val(),
            kelas       : $('#kelas').val(),

            rows        : AoA
        };

        var json = JSON.stringify(data); 
        //console.log(json);
        $.ajax(
        {
            type    : 'POST',
            url     : '<?php echo base_url(); ?>index.php/task/aj_update_deskripsi_keterampilan',
            data    : {data:json},
            dataType: 'text',
            success : function(res)
            {
                console.log(res);
                var obj;
                try{
                    obj = JSON.parse(res);
                    if (obj.IsSuccess) 
                    {
                        console.log(obj.Message);   
                    }
                    alert("Update Data: " + obj.Message);
                    $("#proses").dialog("close");
                }
                catch(e)
                {
                    alert("Terjadi Kesalahan di Server.\n"+e); 
                }
                
            }
        });
        
        console.log('Akhir Eksekusi Simpan....');
        return false; 
    }
}
    
// END CRUD ===============================================================  

function NilaiDtl(kd_mp, kelas, nis, deskripsi)
{
    this.kd_mp = kd_mp;
    this.kelas = kelas;
    this.nis = nis;
    this.deskripsi = deskripsi;   
}
</script>
</body>
</html>