<?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>PEMETAAN MATA PELAJARAN PER KELAS</h1>
			
            <?php echo form_open('kkm/daftar',array('name'=>'frmdaftar','id'=>'frmdaftar')) ?>
                <table style="border:none;width:100%">
                    <tr>
                        <td style="width:100px">Pilih Kelas</td>
                        <td style="width:300px">
                            <?php 
                                $option         = array('0'=>'');
                                foreach($kelass->result() as $rowkelas)
                                {
                                    $option     += array(str_replace('+',' ',$rowkelas->kelas)=>$rowkelas->kelas);
                                }
                                echo form_dropdown('kelas',$option,str_replace('+',' ',$this->uri->segment(3)),'id="kelas" onchange="submitbykelas()"');
                            ?>
                        </td>
                        <!--<input type="submit" name="submit" id="submit" value="Filter" class="input button blue"/>-->
                        <td style="text-align:right; width: auto;" rowspan="2">
                        <?php if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0') { ?>
                            <a href="" id="tombol_add" title="Tambah KKM " onclick="return add('<?php echo base_url(); ?>index.php/kkm/kkm_form/db_add/<?php echo $this->uri->segment(3)?>');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>
                            <a href="" id="tombol_edit" title="Edit KKM" onclick="return edit('<?php echo base_url(); ?>index.php/kkm/kkm_form/db_edit/<?php echo $this->uri->segment(3); ?>');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
                            <a href="" id="tombol_del" title="Hapus KKM" onclick="return del('<?php echo base_url(); ?>index.php/kkm/kkm_form/db_del/<?php echo $this->uri->segment(3); ?>');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/hapus.png" /></a>
                        <?php }?>
                        </td>
                    </tr>
                </table>
                </form>
                <br />
			<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    			<table class="tables" width="100%" >
    				<tr>
    				    <th width="1%">#</th>
    				    <th width="21%">Mata Pelajaran</th>
    				    <th width="17%">Guru</th>
    				    <th width="5%">KKM</th>
    				    <th width="45%">Keterangan</th>
    				</tr>
                    <?php if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0'){ ?>
                    <?php
                    $seq = 1;
                    foreach($kkm->result() as $row)
                    {
                        $bg = ($seq%2==0) ? ' class="bg" ' : '';
                        echo '<tr'.$bg.'>';
                        echo '<td><input type="checkbox" id="'.$row->kd_mp.'" name="kode[]" /></td>';
                        echo '<td>'.$row->nm_mp.'</td>';
                        //echo '<td align="center">'.$row->kelas.'</td>';
                        echo '<td>'.$row->nama_lengkap.'</td>';
                        echo '<td align="center">'.$row->skbm.'</td>';
                        echo '<td>'.$row->deskripsi.'</td>';echo '</tr>';
                        $seq++;
                    }
                    ?>
                    <?php } ?>
    			</table>
			</div>
            
            <?php echo $this->pagination->create_links();?>
            </div> <!-- /content -->

</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
<script type="text/javascript">
    function submitbykelas()
    {
        var varkelas = urlencode($('#kelas').val());
        var iddaftar = $('#frmdaftar').attr('action');
        window.location = iddaftar+"/"+varkelas;
        //alert(iddaftar);
    }
</script>
</body>
</html>