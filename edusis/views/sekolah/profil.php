<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
	<!-- Content (Right Column) -->
<div id="content" class="box">

<h1>SEKOLAH</h1>
<div id="tab01" style="background: url(<?php echo base_url()?>edusis_asset/edusisimg/ct.jpg) left repeat-x;opacity:0.7;filter:alpha(opacity=60)">
<?php echo form_open('sekolah/daftar',array('name'=>'frmdaftar','id'=>'frmdaftar')) ?>
<table style="border:none;width:100%; ">
    <tr>
        <td style="border:none;text-align:right">
            <!--<a href="" id="tombol_add" title="Tambah Sekolah" onclick="return add('<?php //echo base_url(); ?>index.php/sekolah/sekolah_form/db_add');" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/tambah.png" /></a>
            <a href="" id="tombol_edit" title="Edit Profil Sekolah" onclick="return edit('<?php //echo base_url(); ?>index.php/sekolah/sekolah_form/db_edit');" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
            <a href="" id="tombol_del" title="Hapus Sekolah" onclick="return del('<?php //echo base_url(); ?>index.php/Sekolah/sekolah_form/db_del');" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/hapus.png" /></a>-->
            <a href="<?php echo base_url().'index.php/sekolah/profile/'.$this->session->userdata('kd_sekolah');?>" class="small button blue" title="Print Profil Sekolah "><img src="<?php echo base_url().'edusis_asset/edusisimg/pdf.png'?>" alt="Print Profile Sekolah" /></a>
            <a href="<?php echo base_url().'index.php/sekolah/sekolah_form/db_edit/'.$this->session->userdata('kd_sekolah');?>" class="small button blue" title="Edit Profil Sekolah" ><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/edit.png" /></a>
            </td>
    </tr>
</table>
<br />
</form>
<table align="center" style="width: 95%; font-size: 14px; color: black; font-weight: bold;">
    <tr>
        <td colspan="3" style="text-align:center;font-size: 20px;"><b>PROFIL SEKOLAH</b></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Nama Sekolah</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->nama_sekolah; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">NSS</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->nss; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Status Akreditasi</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->status; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Nilai Akreditasi</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->nilai_akreditasi; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Tahun Berdiri</td>
        <td style="width: 1%;text-align: center;">:</td>
        <?php if (!empty($data->row()->th))
        { ?>
        <td style="width: 47%;text-align: left;"><?php  echo $data->row()->hr.'-'.$this->app_model->bulanind($data->row()->bln).'-'.$data->row()->th; ?></td>
        <?php
        }?>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Alamat</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->alamat_sekolah; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Kelurahan/Desa</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->kelurahan; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Kecamatan</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->kecamatan; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">kabupaten/Kota</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->kabupaten; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Propinsi</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->propinsi; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Kode Pos</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->pos; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Telp</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->telp; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Fax</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->fax; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">SMS</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->sms; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Email</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->email; ?></td>
    </tr>
<!--<tr>
        <td style="width: 47%;text-align: right;">Nilai Akreditasi</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->nilai_akreditasi; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Jumlah Kelas/Rombel</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php echo $data->row()->jml_kelas; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Luas Tanah Selanjutnya</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php //echo $data->row()->luas_tanah; ?>&nbsp;&nbsp;m2</td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Luas Bangunan</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php //echo $data->row()->luas_bangunan; ?>&nbsp;&nbsp;m2</td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Luas Kebun / Halaman</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php //echo $data->row()->luas_kebun; ?>&nbsp;&nbsp;m2</td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Status Tanah</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php //echo $data->row()->status_tanah; ?></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center;"><b>KEPALA SEKOLAH</b></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Nama</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php //echo $kepsek->row()->nama_lengkap; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">NIP</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php //echo $kepsek->row()->nip; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Jenis Kelamin</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php //$a = ($kepsek->row()->kelamin=='L') ? 'Laki - Laki' : 'Perempuan'; echo $a;?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Tempat, Tgl Lahir</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php //echo $kepsek->row()->tp_lahir; echo ',  '; $tgllahir = explode(' ',$kepsek->row()->tgl_lahir); $a=($tgllahir[0] == '0') ? ' ' : $tgllahir[0] ; $b=($tgllahir[1] == '0') ? ' ' : $tgllahir[1]; $c=($tgllahir[2] == '0') ? ' ' : $tgllahir[2]; echo $a.' '.$b.' '.$c;?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Pangkat / Gol</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php //echo $kepsek->row()->kepeg_golongan; ?></td>
    </tr>
    <tr>
        <td style="width: 47%;text-align: right;">Pendidikan terakhir</td>
        <td style="width: 1%;text-align: center;">:</td>
        <td style="width: 47%;text-align: left;"><?php //echo $kepsek->row()->pdd_akhir; ?></td>
    </tr>-->
</table>
			</div>
            <?php //echo $this->pagination->create_links();?>
            </div> <!-- /content -->

</div> <!-- /cols -->

	<hr class="noscreen" />

	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
<script type="text/javascript">
    function submitbykelas()
    {
        var varkelas = urlencode($('#kelas').val());
        var iddaftar = $('#frmdaftar').attr('action');
        window.location = iddaftar+"/"+varkelas;
        //alert(iddaftar);
    }
</script>
</body>
</html>