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
    <?php echo form_open('kompetensi/daftar/',array('name'=>'frmdaftar','id'=>'frmdaftar')) ?>
    <table width="100%">
    <tr>
        <td width="120px">Muatan Pelajaran</td>
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
        <?php if($this->uri->segment(3)!='' && $this->uri->segment(4) != '' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '0') { ?>
            <a href="" id="tombol_add" onclick="return add('<?php echo base_url(); ?>index.php/kompetensi/kompetensi_dasar_form/db_add/<?php echo $this->uri->segment(3).'/'.$this->uri->segment(4)?>')" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//tambah.png" /></a>
            <a href="" id="tombol_edit" onclick="return edit('<?php echo base_url(); ?>index.php/kompetensi/kompetensi_dasar_form/db_edit/<?php echo $this->uri->segment(3).'/'.$this->uri->segment(4)?>');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//edit.png" /></a>
            <a href="" id="tombol_del" onclick="return del('<?php echo base_url(); ?>index.php/kompetensi/kompetensi_dasar_form/db_del/<?php echo $this->uri->segment(3).'/'.$this->uri->segment(4)?>');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//hapus.png" /></a>
        <?php }?>
        </td>
        
    </tr>
    <tr>
        <td >Level</td>
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
    
    <div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    <table width="100%" class="tables">
        <input type="hidden" name="kd_semester" id="kd_semester" value="<?php echo $this->session->userdata('kd_semester'); ?>"/>
        <input type="hidden" name="tk" id="tk" value="<?php echo $this->uri->segment(4); ?>"/>
        <input type="hidden" name="kd_mp" id="kd_mp" value="<?php echo $this->uri->segment(3);?>"/>
    <tr>
        <th width="2%">#</th>
        <th width="10%">Kompetensi Inti</th>
        <th width="5%">Kompetensi Dasar</th>
        <th width="75%">Deskripsi Kompetensi Dasar</th>
        <!-- <th width="5%">SKM</th> -->
    </tr>
    <?php if($this->uri->segment(3)!='' && $this->uri->segment(4) != '' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '0') { ?>
        <?php
            $i = 1;
            foreach($kompetensi->result() as $row)
            {
                $jml = '';
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td><input type="checkbox" id="'.$row->kd_ki.'/'.$row->kd_kd.'" value="'.$row->kd_ki.'/'.$row->kd_kd.'"name="kode[]" /></td>';
                echo '<td align="left">'.strtoupper($row->kd_ki).'</td>';
                echo '<td align="left">'.$row->kd_kd.'</td>';
                echo '<input type="hidden" name="id_sk[]" id="id_sk[]" value="'.$row->id_sk.'"/>';
        ?>            
                <td>
                <!-- <a href="<?php //echo base_url() ?>index.php/kompetensi/standar_kd/<?php echo trim($row->id_sk).'/'.trim($row->kd_semester).'/'.trim($row->tk).'/'.trim($row->kd_mp).'/'.trim($row->kd_kd) ?>" title="Klik untuk menambah kompetensi dasar" class="namalengkap" style="text-decoration: none; ">-->
                <?php echo $row->ket_kd;?>
                <!--</a>-->
                </td>
        <?php
                
//                $a      = 0;
//                $jmlskm = 0;
//                foreach($kompetensi->result() as $row_array)
//                {
//                    $jml = $row_array->skm;
//                    $jmlskm += $jml;
//                    $a++;
//                }
//                $y = ($jmlskm==0 || $a==0) ? ' ' : round($jmlskm/($a));
                
                //echo '<td align="right"><input type="text" disabled="disabled" name="skm'.($i-1).'" id="skm" value="'.$row->skm.'" style="width: 100%;  background: transparent; text-align:center; border:none;"/></td>';
                $i++;
                echo '</tr>';
                
            }
        ?>
    <?php }?>
    </table>
</div>
<hr class="noscreen" />

</div>
<!-- Footer -->
<?php   $this->load->view('page_footer'); ?>

<script type="text/javascript">

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
});//document.ready()

</script>
</body>
</html>
