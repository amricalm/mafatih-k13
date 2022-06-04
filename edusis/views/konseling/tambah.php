<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
	<h1>KONSELING SISWA</h1>
	<form action="<?php echo base_url() ?>index.php/konseling/konseling_exec/db_add" method="POST" name="frmkonseling" id="frmkonseling">
        <fieldset>
        <legend>Input Konseling Siswa</legend>
        <table style="width:100%;font-size: 14px;">
        <tr>
            <td style="width:0.5%; " rowspan="3"><a href="javascript:siswapopup()" id="file-add" onclick="return file_add('<?php echo base_url(); ?>index.php/konseling/daftar_siswapopup/');" class=""><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/file_add2.png" /></a></td>
            <td style="width:20%">
                <table style="width:50%">
                    <tr>
                        <td><input type="text" name="nis" id="nis" placeholder="Nomor Induk" class="input-text"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama" class="input-text"/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="tgl" id="tgl" placeholder="Tanggal" class="tgl input-text"/></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td><legend style="font-size:12px; color: black;">Konseling Siswa</legend>
            <textarea style="height:70px; width:400px;" name="masalah" id="masalah" class="input-text"></textarea>
            </td>
        </tr>
        <tr>    
            <td><legend style="font-size:12px; color: black;">Solusi Guru BK</legend>
            <textarea style="height:70px; width:400px;" name="solusi" id="solusi" class="input-text"></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td class="t-left">
                <input style="height:35px;" type="submit" name="" class="input-submit" value="Simpan" />
                <input style="height:35px;" type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/konseling/daftar' ?>';" />
            </td>
        </tr>
        </table>
        </fieldset>
    </form>
</div> <!-- /content -->
	</div> <!-- /cols -->
	<hr class="noscreen" />
	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
<script type="text/javascript">
    function submitbykonseling()
    {
        var varkelas = $('#konseling').val();
        var iddaftar = $('#frmdaftar').attr('action');
        window.location = iddaftar+"/"+varkelas;
    }
</script>
</body>
<script type="text/javascript">
		function siswapopup()
		{
			window.open("<?php echo base_url(); ?>index.php/siswapopup/daftar","daftarsiswa","width=600,height=560,scrollbars=yes");
		}
	</script>
</html>