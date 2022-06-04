 <?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>Edit Pelanggaran Siswa</h1>

			<div id="tab01">
            <form action="<?php echo base_url() ?>index.php/pelanggaran_siswa/pelanggaran_siswa_exec/db_edit" method="POST" name="frmedit" id="frmedit">
            <input type="hidden" name="kd_pelanggaran_siswa" value="<?php echo $data->row()->kd_pelanggaran_siswa;?>"/>
            <input type="hidden" name="kd_pelanggaran" id="kd_pelanggaran" value="<?php echo $data->row()->kd_pelanggaran;?>"/>
            <input type="hidden" name="nis" value="<?php echo $data->row()->nis;?>"/>
            <input type="hidden" name="nama_lengkap" value="<?php echo $data->row()->nama_lengkap;?>"/>
            <fieldset>
            <legend>Edit Pelanggaran Siswa</legend>
            <table width="100%" border="1" style="border: none;">
            <tr>
                <td width="8%">No Induk</td>
                <td width="4%" rowspan="3"><a href="javascript:daftar_siswa()" id="file-add"  class=""><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/file_add2.png" /></a></td>
                <td><input type="text" disabled="disabled" name="nis" id="nis" placeholder="Nomer Induk" class="input-text" value="<?php echo $data->row()->nis;  ?>"/></td>
            </tr>
            <tr>
                <td>Nama Siswa</td>
                <td><input type="text" disabled="disabled" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" class="input-text" value="<?php echo $data->row()->nama_lengkap;  ?>"/></td>
            </tr>
            <tr>
                <td class="va-top">Tgl</td> 
                <td class="va-top"><input type="text" name="tgl" id="tgl" placeholder="Tanggal" class="tgl input-text" value="<?php echo $tgl->row()->th; echo ' - '; echo $tgl->row()->bln; echo ' - '; echo $tgl->row()->hr;?>"/></td>
            </tr>
            <tr>
                <td class="va-top">Pelanggaran</td> 
                <td rowspan="4" class="va-top"><a href="javascript:daftar_pelanggaran()" id="file-add"  class=""><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/file_add2.png" /></a></td>
                <td><input type="text" name="nm_pelanggaran" id="nm_pelanggaran" placeholder="Pelanggaran" class="input-text" value="<?php echo $data->row()->nm_pelanggaran;  ?>" /></td>
            </tr>
            <tr>
                <td class="va-top">Poin</td> 
                <td><input type="text" name="point" id="point" placeholder="Point"class="input-text" value="<?php echo $data->row()->point;  ?>"/></td>
            </tr>
            <tr>
                <td class="va-top">Kejadian</td>
                <td><textarea style="font-size : 14px; height:60px; width:300px;" name="kejadian" id="kejadian" class="input-text"><?php echo $data->row()->kejadian;  ?></textarea></td>
            </tr>
            <tr>
                <td class="va-top">Hukuman</td>
                <td><textarea style="font-size : 14px; height:60px; width:300px;" name="hukuman" id="hukuman" class="input-text"><?php echo $data->row()->hukuman; ?></textarea></td>
            </tr>
            <tr>
                <td></td><td></td>
                <td>    
                    <input type="submit" name="" class="input-submit" value="Simpan" />
                    <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/pelanggaran_siswa/form_pelanggaran' ?>';" />
                </td>
            </tr>
            </table>
            </fieldset>
            </form>
            </div>
            <?php echo $this->pagination->create_links(); ?> &nbsp;&nbsp;&nbsp;
            </div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
</body>
<script type="text/javascript">
    function daftar_pelanggaran()
    {
        window.open("<?php echo base_url(); ?>index.php/pelanggaran/daftar_pelanggaran","","width=600,height=560")
    }
</script>
</html>