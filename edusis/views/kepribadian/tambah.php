<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>KEPRIBADIAN</h1>
        <br />
        <legend>Tambah Kepribadian</legend>	
		<div id="tabs">
        <form action="<?php echo base_url() ?>index.php/kepribadian/kepribadian_exec/db_add" method="POST" name="frmekstrakurikuler" id="frmekstrakurikuler">
        <div id="tab01">
		<table style="border:none ;width:100%;font-size: 14px;">
            <tr>
                <td style="border:none;width:10%; ">Kode</td>
                <td style="border:none;width:1%;">:</td>
                <td style="border:none;width:89%"><input type="text" name="kd_pribadi" id="kd_pribadi" class="input-text"/></td>
            </tr>
            <tr>
                <td>Kepribadian</td>
                <td>:</td>
                <td><input type="text" name="ket_pribadi" id="ket_pribadi" class="input-text"/></td>
            </tr>
            <tr>
            <td></td><td></td>
            <td colspan="2" style="text-align:left; border:none">
                <input type="submit" name="" class="input-submit" value="Simpan" />
                <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/kepribadian/daftar' ?>';" />
            </td>
            </tr>
        </table>
        </div>
		</div>
    <?php echo $this->pagination->create_links(); ?> &nbsp;&nbsp;&nbsp;
    </div> <!-- /content -->
</div> <!-- /cols -->
<hr class="noscreen" />
<!-- Footer -->
<?php $this->load->view('page_footer'); ?>
</body>
</html>