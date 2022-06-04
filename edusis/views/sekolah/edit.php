<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<!-- Content (Right Column) -->
	<div id="content" class="box">
		<h1>SEKOLAH</h1>
	<div id="tabs">
		<ul>
			<li><a href="#tab01"><span><b>[ 1 ]</b></span></a></li>
			<li><a href="#tab02"><span><b>[ 2 ]</b></span></a></li>
		</ul>
        <form action="<?php echo base_url() ?>index.php/sekolah/sekolah_exec/db_edit" method="POST" name="frmsekolah" id="frmsekolah">
        <input type="hidden" name="kd_sekolah" id="kd_sekolah" value="<?php echo trim($data->row()->kd_sekolah)?>"/>
        <br />
		<div id="tab01">
		<table class="nostyle" style="font-size: small;">
            <tr>
                <td style="width:10%; ">Kode Sekolah</td>
                <td style="width:1%;">:</td>
                <td style="width:89%"><input type="text" disabled="disabled" name="kd_sekolah" id="kd_sekolah" class="input-text" value="<?php echo $data->row()->kd_sekolah?>"/></td>
            </tr>
            <tr>
                <td>Nama Sekolah</td>
                <td>:</td>
                <td><input type="text" name="nama_sekolah" id="nama_sekolah" class="input-text" value="<?php echo $data->row()->nama_sekolah?>"/></td>
            </tr>
            <tr>
                <td>NSS</td>
                <td>:</td>
                <td><input type="text" name="nss" id="nss" class="input-text" value="<?php echo $data->row()->nss?>"/></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td><input type="text" name="status" id="status" class="input-text" value="<?php echo $data->row()->status?>"/></td>
            </tr>
            <tr>
                <td>Tahun Berdiri</td>
                <td>:</td>
                <td><input type="text" name="th_diri" id="th_diri" class="tgl input-text" value="<?php echo $data->row()->th; echo '-'; echo $data->row()->bln; echo '-'; echo $data->row()->hr;?>"/></td>
            </tr>
            <tr>
                <td>Tingkat</td>
                <td>:</td>
                <td><input type="text" name="tingkat" id="tingkat" class="input-text" value="<?php echo $data->row()->tingkat?>"/></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><input type="text" name="alamat_sekolah" id="alamat_sekolah" class="input-text" value="<?php echo $data->row()->alamat_sekolah?>"/></td>
            </tr>
            <tr>
                <td>Kelurahan</td>
                <td>:</td>
                <td><input type="text" name="kelurahan" id="kelurahan" class="input-text" value="<?php echo $data->row()->kelurahan?>"/></td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td><input type="text" name="kecamatan" id="kecamatan" class="input-text" value="<?php echo $data->row()->kecamatan?>"/></td>
            </tr>
            <tr>
                <td>Kode Pos</td>
                <td>:</td>
                <td><input type="text" name="pos" id="pos" class="input-text" value="<?php echo $data->row()->pos?>"/></td>
            </tr>
        </table>
        </div>
		<div id="tab02">
		<table class="nostyle" style="font-size: small;">
            <tr>
                <td style="width:10%; ">Kabupaten</td>
                <td style="width:1%; ">:</td>
                <td style="width:89%; "><input type="text" name="kabupaten" id="kabupaten" class="input-text" value="<?php echo $data->row()->kabupaten?>"/></td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td>:</td>
                <td>
                <select name="propinsi" id="propinsi" class="input-text">
                    <?php echo $this->app_model->list_provinsi($data->row()->propinsi); ?>                                   
                </select>
                </td>
            </tr>
            <tr>
                <td>Nilai Akreditasi</td>
                <td>:</td>
                <td><input type="text" name="nilai_akreditasi" id="nilai_akreditasi" class="input-text" value="<?php echo $data->row()->nilai_akreditasi?>"/></td>
            </tr>
            <tr>
                <td>Jumlah Kelas/Rombel</td>
                <td>:</td>
                <td><input type="text" name="jml_kelas" id="jml_kelas" class="input-text" value="<?php echo $data->row()->jml_kelas?>"/></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td>:</td>
                <td><input type="text" name="telp" id="telp" class="input-text" value="<?php echo $data->row()->telp?>"/></td>
            </tr>
            <tr>
                <td>Fax</td>
                <td>:</td>
                <td><input type="text" name="fax" id="fax" class="input-text" value="<?php echo $data->row()->fax?>"/></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><input type="text" name="email" id="email" class="input-text" value="<?php echo trim($data->row()->email)?>"/></td>
            </tr>
            <tr>
                <td>SMS</td>
                <td>:</td>
                <td><input type="text" name="sms" id="sms" class="input-text" value="<?php echo trim($data->row()->sms)?>"/></td>
            </tr>
            <tr>
                <td>Luas Tanah Keseluruhan</td>
                <td>:</td>
                <td><input type="text" name="luas_tanah" id="luas_tanah" class="input-text" value="<?php echo trim($data->row()->luas_tanah)?>"/></td>
            </tr>
            <tr>
                <td>Luas Bangunan</td>
                <td>:</td>
                <td><input type="text" name="luas_bangunan" id="luas_bangunan" class="input-text" value="<?php echo trim($data->row()->luas_bangunan)?>"/></td>
            </tr>
            <tr>
                <td>Luas halaman / Kebun</td>
                <td>:</td>
                <td><input type="text" name="luas_kebun" id="luas_kebun" class="input-text" value="<?php echo trim($data->row()->luas_kebun)?>"/></td>
            </tr>
            <tr>
                <td>Status Tanah</td>
                <td>:</td>
                <td><input type="text" name="status_tanah" id="status_tanah" class="input-text" value="<?php echo trim($data->row()->status_tanah)?>"/></td>
            </tr>
        </table>
		</div>
		</div>
        <table class="nostyle">
            <tr>
            <td>
                <input type="submit" name="edit" class="input-submit" value="Edit" />
                <input type="button" name="batal" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url().'index.php/sekolah/daftar' ?>';" />
            </td>
            </tr>
        </table>
        </form>
    </div> <!-- /content -->
</div> <!-- /cols -->
<hr class="noscreen" />
<!-- Footer -->
<?php $this->load->view('page_footer'); ?>
</body>
</html>