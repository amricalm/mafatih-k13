 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>DAFTAR SISWA</h1>

			<div id="tab01">
                <?php echo form_open('siswa/daftar',array('name'=>'frmdaftar','id'=>'frmdaftar')) ?>
                <table style="border:none;width:100%">
                    <tr>
                        <td style="border:none;text-align:left;width:100px">NIS / Nama</td>
                        <td style="border:none;text-align:left;width:250px">
                            <input type="text" size="50" name="txtcari" id="txtcari" class="input-text" value="<?php echo $txtcarisiswa ?>" /><br/>							
                        </td>
                        <td style="border:none;text-align:left"><input type="submit" class="input-submit" name="submit" value="Pencarian" /></td>
                        <td style="border:none;text-align:right" rowspan="2">
                            <a href="" id="tombol_excel" onclick="return excel('<?php echo base_url(); ?>index.php/export/data_siswa/');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/excel.png" /></a>
                            <a href="" id="tombol_add" onclick="return add('<?php echo base_url(); ?>index.php/siswa/siswa_form/db_add');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>
                            <a href="" id="tombol_edit" onclick="return edit('<?php echo base_url(); ?>index.php/siswa/siswa_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
                            <a href="" id="tombol_del" onclick="return del('<?php echo base_url(); ?>index.php/siswa/siswa_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/hapus.png" /></a>
                            <br /><br />Jumlah Siswa : <?php echo $jmhsiswa; ?> Orang.
                        </td>
                    </tr>
                    <tr>
                        <td style="border:none;text-align:left;width:100px">Kelas</td>
                        <td style="border:none;text-align:left;width:250px">
                            <?php 
                                $option         = array('0'=>'');
                                foreach($kelas->result() as $rowkelas)
                                {
                                    $option     += array($rowkelas->kd_kelas=>$rowkelas->kelas);
                                }
                                echo form_dropdown('kelas',$option,$this->uri->segment(3),'id="kelas" onchange="submitbykelas()"');
                            ?>
                        </td>
                        <td style="border:none;text-align:left"></td>
                    </tr>
                </table>
                </form>
    			<table width="100%" >
    				<tr>
    				    <th width="1%"></th>
    				    <th width="5%">NIS</th>
						<th width="10%">Nama Lengkap</th>
    				    <th width="5%">Kelas</th>
    				</tr>
                    <?php 
                    $seq = 1;
                    foreach($siswa->result() as $row)
                    {
                        $bg = ($seq%2==0) ? ' class="bg" ' : '';
                        echo '<tr'.$bg.'>';
                        echo '<td><input type="checkbox" id="'.$row->nis.'" name="kode[]" /></td>';
                        echo '<td>'.$row->nis.'</td>';
                        echo '<td>'.$row->nama_lengkap.'</td>';
                        echo '<td>'.$row->kelas.'</td>';
                        echo '</tr>';
                        $seq++;
                    }
                    ?>
    			</table>
			</div>
            <?php echo $this->pagination->create_links(); ?> &nbsp;&nbsp;&nbsp;
            </div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
<script type="text/javascript">
    function submitbykelas()
    {
        var varkelas = $('#kelas').val();
        var iddaftar = $('#frmdaftar').attr('action');
        window.location = iddaftar+"/"+varkelas;
        //alert(iddaftar);
    }
</script>
</body>
</html>