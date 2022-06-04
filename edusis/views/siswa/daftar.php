<?php $this->load->view('page_head');?>
<body>
<div id="main">
    <?php $this->load->view('page_menu');?>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
            <h1>DAFTAR SISWA</h1>
                <?php echo form_open('siswa/daftar',array('name'=>'frmdaftar','id'=>'frmdaftar')) ?>
                <table style="border:none;width:100%">
                    <tr>
                        <td style="width:100px">NIS / Nama</td>
                        <td style="width:300px">
                            <input type="text" size="50" name="txtcari" id="txtcari" class="input-text" value="<?php echo $txtcarisiswa ?>" /><br/>							
                        </td>
                        <td style="width:100px;"><input type="submit" class="input button blue" name="submit" value="Filter" /></td>
                        <td style="width: auto;text-align: right;" rowspan="2" >
                            <!--membuat file pdf-->
                            <!--<a href="<?php //echo base_url().'index.php/siswa/daftarprint/' ?>" id="tombol_pdf" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>-->
                            <?php if($this->uri->segment(3) != '' || $this->uri->segment(3) != '0') {?>
                            <a href="" id="tombol_pdf" title="Print Daftar Siswa Perkelas" onclick="return profile('<?php echo base_url(); ?>index.php/siswa/daftarprint/<?php echo $this->uri->segment(3);?>');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
                            <?php }?>
                            <a href="" id="tombol_add" title="Tambah Siswa " onclick="return add('<?php echo base_url(); ?>index.php/siswa/siswa_form/db_add');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>
                            <a href="" id="tombol_edit" title="Edit Profil Siswa " onclick="return edit('<?php echo base_url(); ?>index.php/siswa/siswa_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
                            <a href="" id="tombol_del" title="Hapus Siswa " onclick="return del('<?php echo base_url(); ?>index.php/siswa/siswa_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/hapus.png" /></a>
                            <br /><br />Jumlah Siswa : <?php echo $jmhsiswa; ?> Orang.
                        </td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>
                            <?php 
                                $option         = array('0'=>'');
                                foreach($kelas->result() as $rowkelas)
                                {
                                    $option     += array(str_replace('+',' ',$rowkelas->kelas)=>$rowkelas->kelas);
                                }
                                echo form_dropdown('kelas',$option,str_replace('+',' ',$this->uri->segment(3)),'id="kelas" onchange="submitbykelas()"');
                            ?>
                        </td>
                    </tr>
                </table>
                <br />
                </form>
			<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    			<table class="tables" width="100%" >
    				<tr>
    				    <th width="1%">#</th>
    				    <th width="5%">NIS</th>
						<th width="18%">Nama Lengkap</th>
    				    <th width="8%">Tgl Lahir</th>
    				    <th width="13%">Nama Orang Tua</th>
    				    <th width="28%">Alamat</th>
    				    <th width="17%">Telp</th>
    				    <th width="7%">Kelas</th>
    				    <th width="3%"></th>
    				</tr>
                    <?php 
                    $this->load->helper('adn_text_helper');
                    $seq = 1;
                    foreach($siswa->result() as $row)
                    {
                        $bg = ($seq%2==0) ? ' class="bg" ' : '';
                        echo '<tr'.$bg.'>';
                        echo '<td><input type="checkbox" id="'.$row->nis.'" name="kode[]" /></td>';
                        echo '<td>'.$row->nis.'</td>';
                        echo '<td><a href="#" class="namalengkap" title="'.$row->nama_lengkap.'" style="text-decoration: none;text-transform:capitalize;">'.persingkat($row->nama_lengkap,25).'</a></td>';
                        //echo '<td>'.$row->nama_lengkap.'</td>';
                        
                        echo '<td>'. $row->tglpanjang /*adn_tgl_to_str($row->tgl_lahir)*/ .'</td>';
                        
                        echo '<td><a href="#" class="namalengkap" title="'.$row->ayah_nama.'" style="text-decoration: none;text-transform:capitalize;">'.persingkat($row->ayah_nama,20).'</a></td>';
                        //echo '<td>'.$row->ayah_nama.'</td>';
                        echo '<td><a href="#" class="namalengkap" title="'.$row->alamat.'" style="text-decoration: none;text-transform:capitalize;">'.persingkat($row->alamat,45).'</a></td>';
                        //echo '<td>'.$row->alamat.'</td>';
                        echo '<td>'.$row->telp.'</td>';
                        echo '<td><a href="#" class="namalengkap" title="'.$row->kelas.'" style="text-decoration: none;text-transform:capitalize;">'.persingkat($row->kelas,8).'</a></td>';
                        //echo '<td>'.$row->kelas.'</td>';
                        echo '<td><a href="" id="tombol_profile" onclick="return profile('."'".base_url().'index.php/siswa/profile/'.$row->nis."'".');" class="small button blue" title="Print Profil Siswa "><img src="'.base_url().'edusis_asset/edusisimg/print.png" alt="Print Student Profile" /></a></td>';
                        echo '</tr>';
                        $seq++;
                    }
                    ?>
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