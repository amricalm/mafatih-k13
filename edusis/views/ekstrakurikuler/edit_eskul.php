<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>EKSTRAKURIKULER</h1>
		<div id="tab01">
        <form action="<?php echo base_url() ?>index.php/ekstrakurikuler/ekstrakurikuler_exec/db_edit" method="POST" name="frmekstrakurikuler" id="frmekstrakurikuler">
        <input type="hidden" name="kd_eskul" value="<?php echo $data->row()->kd_eskul?>"/>
        <table style="width:100%;font-size: 14px;">
            <tr>
                <td style="width:5%; ">Kode</td>
                <td style="width:1%;">:</td>
                <td style="width:94%"><input type="text" disabled="disabled" name="kd_eskul" id="kd_eskul" class="input-text" value="<?php echo $data->row()->kd_eskul?>"/></td>
            </tr>
            <tr>
                <td style="width:5%;">Ekstrakurikuler</td>
                <td style="width:1%;">:</td>
                <td style="width:94%;"><input type="text" name="nm_eskul" id="nm_eskul" class="input-text" value="<?php echo $data->row()->nm_eskul?>"/></td>
            </tr>
            <tr>
            <td></td><td></td>
            <td>
                <input type="submit" name="edit" class="input-submit" value="Edit" />
                <input type="button" name="batal" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/ekstrakurikuler/daftar' ?>';" />
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