<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>SEKOLAH</h1>
        <form action="<?php echo base_url() ?>index.php/sekolah/sekolah_exec/db_add" method="POST" name="frmsekolah" id="frmsekolah">
        <br />
        <legend>Edit Sekolah</legend>
		<div id="tabs">	
        <table style="width:100%;font-size: 14px;">            
            <tr>
                <td style="width:10%; ">Kode Sekolah</td>
                <td style="width:1%;">:</td>
                <td style="width:89%"><input type="text" name="kd_sekolah" id="kd_sekolah" class="input-text"/></td>
            </tr>
            <tr>
                <td>Nama Sekolah</td>
                <td>:</td>
                <td><input type="text" name="nama_sekolah" id="nama_sekolah" class="input-text" /></td>
            </tr>
            <tr>
                <td>NSS</td>
                <td>:</td>
                <td><input type="text" name="nss" id="nss" class="input-text" /></td>
            </tr>
            <tr>
                <td>Tingkat</td>
                <td>:</td>
                <td><input type="text" name="tingkat" id="tingkat" class="input-text" /></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><input type="text" name="alamat_sekolah" id="alamat_sekolah" class="input-text" /></td>
            </tr>
            <tr>
                <td>Kelurahan</td>
                <td>:</td>
                <td><input type="text" name="kelurahan" id="kelurahan" class="input-text" /></td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td><input type="text" name="kecamatan" id="kecamatan" class="input-text" /></td>
            </tr>
            <tr>
                <td>Kode Pos</td>
                <td>:</td>
                <td><input type="text" name="pos" id="pos" class="input-text" /></td>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>:</td>
                <td><input type="text" name="kabupaten" id="kabupaten" class="input-text" /></td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td>:</td>
                <td>
                <select name="propinsi" id="propinsi" class="input-text">
                    <?php echo $this->app_model->list_provinsi(''); ?>                                  
                </select>
                </td>
            </tr>
            <tr>
                <td>Telp</td>
                <td>:</td>
                <td><input type="text" name="telp" id="telp" class="input-text" /></td>
            </tr>
            <tr>
                <td>Fax</td>
                <td>:</td>
                <td><input type="text" name="fax" id="fax" class="input-text" /></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><input type="text" name="email" id="email" class="input-text" /></td>
            </tr>
            <tr>
                <td>SMS</td>
                <td>:</td>
                <td><input type="text" name="sms" id="sms" class="input-text" /></td>
            </tr>
            <tr>
            <td></td><td></td>
            <td>
                <input type="submit" name="edit" class="input-submit" value="Tambah" />
                <input type="button" name="batal" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/sekolah/daftar' ?>';" />
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