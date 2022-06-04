<?php $this->load->view('page_head');?>
<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
			<h1>PRESTASI SISWA</h1>
			<form action="<?php echo base_url() ?>index.php/prestasi/prestasi_siswa_exec/db_add" method="POST" name="frmpelanggaran" id="frmpelanggaran">
            <fieldset>
    		<legend>Input Prestasi Siswa</legend>
    		<input type="hidden" name="kd_prestasi" id="kd_prestasi"/><input type="hidden" name="kelas" id="kelas" />		
            <table width="100%" border="1" style="border: none;">
            <tr>
                <td width="8%">No Induk</td>
                <td width="4%" rowspan="3"><a href="javascript:daftar_siswa()" id="file-add"  class=""><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/file_add2.png" /></a></td>
                <td><input type="text" name="nis" id="nis" placeholder="Nomer Induk" class="input-text"/></td>
            </tr>
            <tr>
                <td>Nama Siswa</td> 
                <td><input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" class="input-text"/></td>
                
            </tr>
            <tr>
                <td class="va-top">Tgl</td> 
                <td class="va-top"><input type="text" name="tgl" id="tgl" placeholder="Tanggal" class="tgl input-text" /></td>
            </tr>
            <tr>
                <td class="va-top">Prestasi</td>
                <td rowspan="2"><a href="javascript:daftar_prestasi()" id="file-add"  class=""><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/file_add2.png" /></a></td> 
                <td><textarea name="nm_prestasi" id="nm_prestasi" class="input-text"></textarea></td>
            </tr>
            <tr>
                <td class="va-top">Point</td>
                <td class="va-top"><input type="text" name="point" id="point" placeholder="Point"class="input-text"/></td>
            </tr>
            <tr>
                <td></td><td></td>
                <td>    
                    <input type="submit" name="" class="input-submit" value="Simpan" />
                    <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/prestasi/daftar_prestasisiswa' ?>';" />
                </td>
            </tr>
            </table>
	        </fieldset>
            </form>
            <?php echo $this->pagination->create_links(); ?> &nbsp;&nbsp;&nbsp;
            </div> <!-- /content -->

	</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
<script type="text/javascript">
    function submitbypelanggaran_siswa()
    {
        var varkelas = $('#pelanggaran_siswa').val();
        var iddaftar = $('#frmpelanggaran_siswa').attr('action');
        window.location = iddaftar+"/"+varkelas;
        //alert(iddaftar);
    }
</script>
</body>
    <script type="text/javascript">
        function daftar_siswa()
        {
            window.open("<?php echo base_url(); ?>index.php/siswapopup/daftar","","width=600,height=560")
        }
        
        function daftar_prestasi()
        {
            window.open("<?php echo base_url(); ?>index.php/prestasi/daftar_popupprestasi","","width=600,height=560")
        }
    </script>
</html>