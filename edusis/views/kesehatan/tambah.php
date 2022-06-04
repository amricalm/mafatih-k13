<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>KESEHATAN</h1>
		<div id="tab01">
        <form action="<?php echo base_url() ?>index.php/kesehatan/kesehatan_exec/db_add" method="POST" name="frmekstrakurikuler" id="frmekstrakurikuler">
        <table style="border:none ;width:100%;font-size: 14px;">
            <tr>
                <td style="border:none;width:5%; ">Kode</td>
                <td style="border:none;width:1%;">:</td>
                <td style="border:none;width:94%"><input type="text" name="kd_eskul" id="kd_eskul" class="input-text"/></td>
            </tr>
            <tr>
                <td style="border:none;width:5%;">Kesehatan</td>
                <td style="border:none;width:1%;">:</td>
                <td style="border:none;width:94%;"><input type="text" name="nm_eskul" id="nm_eskul" class="input-text"/></td>
            </tr>
            <tr>
                <td style="border:none;width:5%;">Kategori</td>
                <td style="border:none;width:1%;">:</td>
                <td style="border:none;width:94%;">
                    <select name="kategori" id="kategori" required>
                        <option></option>
                        <option value="Tinggi dan Berat Badan">Tinggi dan Berat Badan</option>
                        <option value="Kondisi Kesehatan">Kondisi Kesehatan</option>
                    </select>
                </td>
            </tr>
            <tr>
            <td></td><td></td>
            <td colspan="2" style="text-align:left; border:none">
                <input type="submit" name="" class="input-submit" value="Simpan" />
                <input type="button" name="" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/kesehatan/daftar' ?>';" />
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
</body>
</html>