<?php $this->load->view('page_head');?>

<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>Master Point pelanggaran</h1>

			<div id="tab01">
                <?php echo form_open('pelanggaran/daftar',array('name'=>'frmdaftar','id'=>'frmdaftar')) ?>
                <table style="border:1 ;width:100%">

                    <tr>
                        <td style="border:none;text-align:right" rowspan="2">
                            <a href="" id="tombol_excel" onclick="return excel('<?php echo base_url(); ?>index.php/export/data_siswa/');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/excel.png" /></a>
                            <a href="" id="tombol_add" onclick="return add('<?php echo base_url(); ?>index.php/master_pelanggaran/tambah');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>
                            <a href="" id="tombol_edit" onclick="return edit('<?php echo base_url(); ?>index.php/siswa/siswa_form/db_edit');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
                            <a href="" id="tombol_del" onclick="return del('<?php echo base_url(); ?>index.php/siswa/siswa_form/db_del');" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/hapus.png" /></a>
                        </td>
                    </tr>
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
    function submitbypelanggaran()
    {
        var varkelas = $('#pelanggaran').val();
        var iddaftar = $('#frmdaftar').attr('action');
        window.location = iddaftar+"/"+varkelas;
        //alert(iddaftar);
    }
</script>
</body>
</html>