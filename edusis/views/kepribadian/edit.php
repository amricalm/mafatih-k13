<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>KEPRIBADIAN</h1>
        <form action="<?php echo base_url() ?>index.php/kepribadian/kepribadian_exec/db_edit" method="POST" name="frmekstrakurikuler" id="frmekstrakurikuler">
        <input type="hidden" name="kd_pribadi" id="kd_pribadi" value="<?php echo trim($data->row()->kd_pribadi)?>"/>
        <br />
        <legend>Edit Kepribadian</legend>
		<div id="tabs">	
        <table style="width:100%;font-size: 14px;">            
            <tr>
                <td style="width:10%; ">Kode</td>
                <td style="width:1%;">:</td>
                <td style="width:89%"><input type="text" disabled="disabled" name="kd_pribadi" id="kd_pribadi" class="input-text" value="<?php echo trim($data->row()->kd_pribadi)?>"/></td>
            </tr>
            <tr>
                <td>Kepribadian</td>
                <td>:</td>
                <td><input type="text" name="ket_pribadi" id="ket_pribadi" class="input-text" value="<?php echo trim($data->row()->ket_pribadi)?>"/></td>
            </tr>
            <tr>
            <td></td><td></td>
            <td>
                <input type="submit" name="edit" class="input-submit" value="Edit" />
                <input type="button" name="batal" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/kepribadian/daftar' ?>';" />
            </td>
            </tr>
        </table>
        </form>
		</div>
    </div> <!-- /content -->
</div> <!-- /cols -->
<hr class="noscreen" />
<!-- Footer -->
<?php $this->load->view('page_footer'); ?>
</body>
</html>