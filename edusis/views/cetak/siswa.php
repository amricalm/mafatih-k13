<html><head><link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" /><!-- WRITE YOUR CSS CODE HERE -->
	<title>Identitas Peserta Didik</title>
	<style>
	@media all {*{
		font-family: Calibri, sans-serif;
	}
	}
</style>
</head><body><table border="0" align="center" style="padding:0px;" width="80%;" cellpadding="0">
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
    <tr>
		<td colspan="4">&nbsp;</td>
	</tr>
    <tr>
        <td colspan="4" align="center"><h2>IDENTITAS PESERTA DIDIK</h2></td>
    </tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td width="15px">1.</td>
		<td width="200px">Nama Peserta Didik</td>
		<td width="20px">:</td>
		<td><?php echo $data->row()->nama_lengkap; ?></td>
	</tr>
	<tr>
		<td>2.</td>
		<td>Nomor Induk</td>
		<td>:</td>
		<td><?php echo $data->row()->nis; ?></td>
	</tr>
	<tr>
		<td>3.</td>
		<td>Tempat, Tanggal Lahir</td>
		<td>:</td>
        <td><?php echo $data->row()->tp_lahir; echo ',  '; echo $tgl->row()->hr; echo ' - '; echo $tgl->row()->bln; echo ' - '; echo $tgl->row()->th;?></td>
	</tr>
	<tr>
		<td>4.</td>
		<td>Jenis Kelamin</td>
		<td>:</td>
		<td><?php $a = ($data->row()->kelamin=='L') ? 'Laki - Laki' : 'Perempuan'; echo $a;?></td>
	</tr>
	<tr>
		<td>5.</td>
		<td>Agama</td>
		<td>:</td>
		<td><?php echo $data->row()->agama; ?></td>
	</tr>
    
	<tr>
		<td>6.</td>
		<td>Pendidikan Sebelumnya</td>
		<td>:</td>
		<td><?php echo $data->row()->asal_sekolah; ?></td>
	</tr>
	<tr>
		<td style="vertical-align: top !important;">7.</td>
		<td style="vertical-align: top !important;">Alamat Peserta Didik</td>
		<td style="vertical-align: top !important;">:</td>
		<td><textarea style="border: none; width: 100%;height: 40px; background: transparent; resize: none;"><?php echo $data->row()->alamat; ?></textarea></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>8.</td>
		<td>Nama Orang Tua</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td>a. Ayah</td>
		<td>:</td>
		<td><?php echo $data->row()->ayah_nama; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>b. Ibu</td>
		<td>:</td>
		<td><?php echo $data->row()->ibu_nama; ?></td>
	</tr>
    <tr>
		<td>9.</td>
		<td>Pekerjaan Orang Tua</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td>a. Ayah</td>
		<td>:</td>
		<td><?php echo $data->row()->ayah_pekerjaan; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>b. Ibu</td>
		<td>:</td>
		<td><?php echo $data->row()->ibu_pekerjaan; ?></td>
	</tr>
	<tr>
		<td>10.</td>
		<td>Alamat Orang Tua</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td>a. Jalan</td>
		<td>:</td>
		<td><?php echo $data->row()->ibu_alamat; ?></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td>Telp <?php echo $data->row()->ibu_telp; ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td>b. Kelurahan/Desa</td>
		<td>:</td>
		<td><?php echo $data->row()->ibu_kelurahan; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>c. Kecamatan</td>
		<td>:</td>
		<td><?php echo $data->row()->ibu_kecamatan; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>d. Kabupaten/Kota</td>
		<td>:</td>
		<td><?php echo $data->row()->ibu_kota; ?></td>
	</tr>
	<!--<tr>
		<td></td>
		<td>e. Privinsi</td>
		<td>:</td>
		<td><?php //echo $data->row()->ayah_provisi; ?></td>
	</tr>-->
	<tr>
		<td>11.</td>
		<td>Wali Peserta Didik</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td>a.  Nama</td>
		<td>:</td>
		<td><?php if ($data->row()->wali_nama != '') {
			echo $data->row()->wali_nama;
		} else {
			echo '-';
		} ?></td>
	</tr>
	<tr>
		<td></td>
		<td>b.  Pekerjaan</td>
		<td>:</td>
		<td><?php if ($data->row()->wali_pekerjaan != 'TB') {
			echo $data->row()->wali_pekerjaan;
		} else {
			echo '-';
		} ?></td>
	</tr>
	<tr>
		<td></td>
		<td style="vertical-align: top !important;">c.  Alamat</td>
		<td style="vertical-align: top !important;">:</td>
		<td><textarea style="border: none; width: 90%;height: 40px; background: transparent; resize: none;"><?php if ($data->row()->wali_alamat != '') {
			echo $data->row()->wali_alamat;
		} else {
			echo '-';
		} ?></textarea></td>
	</tr>
	<!-- <tr>
		<td></td>
		<td></td>
		<td></td>
		<td>Telp  <?php echo $data->row()->wali_telp; ?></td>
	</tr> -->
    <tr><td colspan="4">
    <br /><br /><br />
    <table border="0" width="100%">
        <tr>
			<?php
      $dlmtStr = explode('-', $tgl_lhb);
      switch ($dlmtStr[1]) {
        case 1:
          $bln = 'Januari';
          break;
        case 2:
          $bln = 'Februari';
          break;
        case 3:
          $bln = 'Maret';
          break;
        case 4:
          $bln = 'April';
          break;
        case 5:
          $bln = 'Mei';
          break;
        case 6:
          $bln = 'Juni';
          break;
        case 7:
          $bln = 'Juli';
          break;
        case 8:
          $bln = 'Agustus';
          break;
        case 9:
          $bln = 'September';
          break;
        case 10:
          $bln = 'Oktober';
          break;
        case 11:
          $bln = 'November';
          break;
        case 12:
          $bln = 'Desember';
          break;
      }
      ?>
            <td width="50%"></td>
            <td align="center"><?php echo $sekolah->row()->kabupaten;?>, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?></td>
        </tr>
        <tr>
            <td width="50%"></td>
            <td align="center">Kepala Sekolah,</td>
        </tr>
        <tr>
            <td width="50%"></td>
            <td>&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br /></td>
        </tr>
        <tr>
            <td width="50%"></td>
            <td align="center"><u><?php echo $kepsek->row()->nama_lengkap; ?></u></td>
        </tr>
        <tr>
            <td width="50%"></td>
            <td align="center">NIP.<?php echo $kepsek->row()->nip;  ?></td>
        </tr>
    </table></td></tr>
</table></body></html>
