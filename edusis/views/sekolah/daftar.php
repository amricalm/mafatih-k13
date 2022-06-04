<?php $this->load->view('page_head');?>
<body>
<div id="main">
    <?php $this->load->view('page_menu');?>
		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>SEKOLAH</h1>

			<div id="tab01">
                <?php echo form_open('sekolah/daftar',array('name'=>'frmdaftar','id'=>'frmdaftar')) ?>
                <table style="border:none;width:100%">
                    <tr>
                        <td style="border:none;text-align:right">
                            <?php //if ($this->session->userdata('user_id')=="Admin") {?>
                            <!--<a href="" id="tombol_add" title="Tambah Sekolah" onclick="return add('<?php //echo base_url(); ?>index.php/sekolah/sekolah_form/db_add');" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>
                            <a href="" id="tombol_del" title="Hapus Sekolah" onclick="return del('<?php //echo base_url(); ?>index.php/Sekolah/sekolah_form/db_del');" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/hapus.png" /></a>-->
                            <a href="<?php echo base_url().'index.php/sekolah/profile/'.$this->session->userdata('kd_sekolah');?>" class="small button blue" title="Print Profil Sekolah "><img src="<?php echo base_url().'edusis_asset/edusisimg/pdf.png'?>" alt="Print Profile Sekolah" /></a>
                            <a href="" id="tombol_edit" title="Edit Profil Sekolah" onclick="return edit('<?php echo base_url(); ?>index.php/sekolah/sekolah_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
                            <?php //}?>
                        </td>
                    </tr>
                </table>
                <br />
                </form>
    			<table class="tables" width="100%" >
    				<tr>
    				    <th width="1%">No.</th>
    				    <th width="15%">Nama Institusi</th>
    				    <th width="39%">Alamat</th>
    				    <th width="9%">Telp</th>
    				    <th width="9%">Fax</th>
    				    <th width="9%">SMS</th>
    				    <th width="19%">Email</th>
    				</tr>
                    <?php 
                    $seq = 1;
                    foreach($sekolah->result() as $row)
                    {
                        $bg = ($seq%2==0) ? ' class="bg" ' : '';
                        echo '<tr'.$bg.'>';
                        //echo '<td><input type="checkbox" id="'.$row->kd_sekolah.'" name="kode[]" /></td>';
                        echo '<td align="center">'.$seq.'</td>';
                        echo '<td>'.$row->nama_sekolah.'</td>';
                        echo '<td>'.$row->alamat_sekolah.'</td>';
                        echo '<td align="center">'.$row->telp.'</td>';
                        echo '<td align="center">'.$row->fax.'</td>';
                        echo '<td align="center">'.$row->sms.'</td>';
                        echo '<td>'.$row->email.'</td>';
                        //echo '<td><a href="'.base_url().'index.php/sekolah/profile/'.$row->kd_sekolah.'" class="small button blue" title="Print Profil Sekolah "><img src="'.base_url().'edusis_asset/edusisimg/pdf.png" alt="Print Profile Sekolah" /></a></td>';
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