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
		<h1>Template - Capaian Kompetensi</h1>
    
    <?php 
    if ($kd_sekolah!='02')
    {    
    ?>
        <?php echo form_open('lck/daftar/',array('name'=>'frmdaftar','id'=>'frmdaftar')) ?>
        <table width="100%">
        <tr>
            <td width="100px">Mata Pelajaran</td>
            <td width="300px">
            <?php
                $arraymp = array('');
                foreach($mp->result () as $rowmp )
                {
                    $arraymp[trim($rowmp->kd_mp)]=$rowmp->nm_mp;
                }
                echo form_dropdown('kd_mp',$arraymp,$kd_mp,'class="input-text", id="kdmp"');
            ?>
            </td>
            <td align="right">
            
            </td>
            
        </tr>
        <tr>
            <td >Tingkat</td>
            <td>
            <?php
                $arraytik = array('');
                if(11)
                {
                    $x = '6';
                }
                elseif(01)
                {
                    $x = '4';
                }
                elseif(21)
                {
                    $x = '3';
                }
                else
                {
                    $x = '3';
                }
                for($i=1;$i<=$x;$i++)
                {
                    $arraytik[$i]=$i;
                }
                echo form_dropdown('tk',$arraytik,$tk,'class="input-text", id="tk"');
            ?>
            </td>
            <td>
                <input class="input button blue" type="submit" name="filter" value="Filter"/>
            </td>
        </tr>
        </table>
        </form>
    <?php
    }
    ?>
    
    <div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    <table width="100%" class="tables" id="AdnTable">
        <input type="hidden" name="kd_semester" id="kd_semester" value="<?php echo $this->session->userdata('kd_semester'); ?>"/>
        <input type="hidden" name="tk" id="tk" value="<?php echo $this->uri->segment(4); ?>"/>
        <input type="hidden" name="kd_mp" id="kd_mp" value="<?php echo $this->uri->segment(3);?>"/>
    <tr>
        <th width="2%">#</th>
        <th width="8%">Nilai</th>
        <th width="10%">Aspek</th>
        <th width="80%">Deskripsi</th>
    </tr>
    <?php 
        
        if($kd_sekolah='02' ||
        ($this->uri->segment(3)!='' && $this->uri->segment(4) != '' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '0')) { ?>
        <?php
            $i = 1;
            
            foreach($isi->result() as $row)
            {
                $jml = '';
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td style="vertical-align:middle">'. $i .'</td>';
                echo '<td style="vertical-align:middle" align="left" data-kolom="nilai">'.$row->nilai.'</td>';
                echo '<td style="vertical-align:middle" align="left" data-kolom="aspek">'.$row->aspek.'</td>';
                //echo '<input type="hidden" name="id_sk[]" id="id_sk[]" value="'.$row->id_sk.'"/>';
        ?>            
                <td>
                <?php  echo '<textarea data-kolom="deskripsi" style="background:transparent; width: 100%; height:50px; border:none; font-size: 12px; resize:none; " id="deskripsi'.$i.'" nama="deskripsi[]">' .$row->deskripsi .'</textarea>' ;?>
                </td>
        <?php
                
                $i++;
                echo '</tr>';
                
            }
        ?>
    <?php }?>
    </table>
    
    <table style="width: 100%;">
    <tr>
        <td align="right" colspan="4" style="border-bottom: none; border-right: none; border-left: none;">
            <input type="button" name="simpan" id="btnSimpan" class="input-submit blue" value="Simpan" />
            <input type="reset" name="batal" id="batal" class="input-submit blue"value="Batal"/>
        </td>
    </tr>
</table>
    
    
</div>
<hr class="noscreen" />

</div>
<!-- Footer -->
<?php   $this->load->view('page_footer'); ?>

<script type="text/javascript">
var KdSekolah = '<?php  echo $kd_sekolah;  ?>';
$(document).ready(function(){
    console.log('Siap...');
    $('#frmdaftar').submit(function(e){
        var aksi = $('#frmdaftar').attr('action');
        var mppilih = urlencode($('#kdmp').val());
        var tkpilih = urlencode($('#tk').val());
        var actionbaru = aksi + "/" + mppilih + "/" + tkpilih;
        //alert(actionbaru);return false;
        $('#frmdaftar').attr('action',actionbaru);
        return true; 
    });
    $('#tombol_edit').click(function(){
        var kd = $( "input:checked" ).val();
        $(this).attr('href','<?php echo base_url(); ?>index.php/kompetensi/kompetensi_dasar_form/db_edit/<?php echo $this->uri->segment(3).'/'.$this->uri->segment(4)?>/'+kd);
     
    });
    
    $('#tombol_del').click(function(){
        var kd = $( "input:checked" ).val();
        $(this).attr('href','<?php echo base_url(); ?>index.php/kompetensi/kompetensi_dasar_form/db_del/<?php echo $this->uri->segment(3).'/'.$this->uri->segment(4)?>/'+kd);
     
    });
    
    $('#btnSimpan').click(function()
    {
        simpan();
    })
});//document.ready()

//------------------- CRUD ----------------------------------------------------
function simpan()
{
    console.log('Eksekusi Simpan....');
    
    var AoA = new Array();
    var iUrutan = 0;
    
    var kd_mp = '';
    var tk = '';
    if (KdSekolah!='02')
    {
        kd_mp = $('#kdmp').val();
        tk = $('#tk').val();
    }
    
    $('#AdnTable tr').each(function(){
        var nilai = $(this).find("[data-kolom='nilai']").html();
        var aspek = $(this).find("[data-kolom='aspek']").html();
        var deskripsi = $(this).find("[data-kolom='deskripsi']").val()
        if (nilai!=undefined)
        {
            AoA.push({nilai:nilai, aspek:aspek, deskripsi:deskripsi});
        }
    });
    console.log(AoA);
    if($(AoA).length <1)
    {
        alert('Nilai Tidak boleh kosong!');
    }
    else
    {
        //$("#proses").dialog("open");
        var data = {
            kd_mp       : kd_mp,
            tk          : tk,
            rows        : AoA
        };

        var json = JSON.stringify(data); 
        //console.log(json);
        $.ajax(
        {
            type    : 'POST',
            url     : '<?php echo base_url(); ?>index.php/lck/aj_simpan',
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

</script>
</body>
</html>
