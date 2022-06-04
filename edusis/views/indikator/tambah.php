<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>INDIKATOR SIKAP</h1>
        <br />
        <legend>Tambah Indikator Sikap</legend>	
		<div id="tabs">
        <form action="<?php echo base_url() ?>index.php/indikator/indikator_exec/db_add" method="POST" name="frmekstrakurikuler" id="frmekstrakurikuler">
        <div id="tab01">
		<table style="border:none ;width:100%;font-size: 14px;">
            <tr>
                <td style="border:none;width:10%; ">Kode</td>
                <td style="border:none;width:1%;">:</td>
                <td style="border:none;width:89%"><input type="text" name="kd_sikap" id="kd_sikap" class="input-text"/></td>
            </tr>
            <tr>
                <td style="width:100px" class="va-top" >Indikator</td><td class="va-top" >:</td>
                <td>
                    <textarea style="height: 105px; width: 380px;" name="nm_sikap" ></textarea>
                </td>
            </tr>
            <tr>
            <td></td><td></td>
            <td colspan="2" style="text-align:left; border:none">
                <input type="submit" name="" class="input-submit" value="Simpan" />
                <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/indikator/daftar' ?>';" />
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