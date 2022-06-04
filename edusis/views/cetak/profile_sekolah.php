<html>
<head>
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" />
	<title>Edusis Prestasi | Profil Sekolah</title>
	<style>
	@media all {*{
		font-family: Arial, sans-serif;
	}
	}
</style>
</head>
<body>
<table border="0" align="center" style="padding:0px;" width="75%;" cellpadding="0">
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
    <tr>
		<td colspan="3">&nbsp;</td>
	</tr>
    <tr>
        <td colspan="3" align="center" style="font-size: 24px;">RAPOR</td>
    </tr>
	<tr>
		<td colspan="3" align="center" style="font-size: 24px;">SEKOLAH MENENGAH ATAS</td>
	</tr>
	<tr>
		<td colspan="3" align="center" style="font-size: 24px;"><?php echo $sekolah->row()->nama_sekolah; ?></td>
	</tr>
	<tr>
		<td colspan="3"><br><br><br><br><br></td>
	</tr>
	<tr>
		<td width="20%" style="height: 30px">Nama Sekolah</td>
		<td width="10px">:</td>
		<td width="45%"><?php echo $sekolah->row()->nama_sekolah; ?></td>
	</tr>
	<tr>
		<td style="height: 32px">NPSN</td>
		<td>:</td>
        <td><?php echo $sekolah->row()->npsn; ?></td>
	</tr>
	<tr>
		<td style="height: 32px">NIS/NSS/NDS</td>
		<td>:</td>
        <td><?php echo $sekolah->row()->nss; ?></td>
	</tr>
	<tr>
		<td style="height: 32px">Alamat Sekolah</td>
		<td>:</td>
        <td><?php echo $sekolah->row()->alamat_sekolah; ?></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
        <td>Kode Pos <?php echo $sekolah->row()->pos; ?>&nbsp;&nbsp;&nbsp; Telp. <?php echo $sekolah->row()->telp; ?></td>
	</tr>
	<tr>
		<td style="height: 32px">Desa/Kelurahan</td>
		<td>:</td>
        <td><?php echo $sekolah->row()->kelurahan; ?></td>
	</tr>
	<tr>
		<td style="height: 32px">Kecamatan</td>
		<td>:</td>
        <td><?php echo $sekolah->row()->kecamatan; ?></td>
	</tr>
	<tr>
		<td style="height: 32px">Kota/Kabupaten</td>
		<td>:</td>
        <td><?php echo $sekolah->row()->kabupaten; ?></td>
	</tr>
	<tr>
		<td style="height: 32px">Provinsi</td>
		<td>:</td>
        <td><?php echo $sekolah->row()->propinsi; ?></td>
	</tr>
	<tr>
		<td style="height: 32px">Website</td>
		<td>:</td>
        <td><?php echo $sekolah->row()->web; ?></td>
	</tr>
</table>
</body>
</html>
