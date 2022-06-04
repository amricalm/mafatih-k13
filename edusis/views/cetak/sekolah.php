<html>
<head>
	<title>Edusis Prestasi | Profil Sekolah</title>
</head>
<body>
<table border="0" align="center" style="padding:0px;" width="80%;" cellpadding="0">
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td align="center" colspan="4" ><img src="edusis_asset/edusisimg/mafatih.jpg"/></td>
	</tr>
    <tr>
        <td colspan="4" align="center"><h2>PROFIL SEKOLAH</h2></td>
    </tr>
	<tr>
		<td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="4"><b>I.   SEKOLAH</b></td>
	</tr>
	<tr>
		<td width="15px">1.</td>
		<td width="200px">Nama Sekolah</td>
		<td width="20px">:</td>
		<td><?php echo $data->row()->nama_sekolah; ?></td>
	</tr>
	<tr>
		<td>2.</td>
		<td>NSS</td>
		<td>:</td>
		<td><?php echo $data->row()->nss; ?></td>
	</tr>
	<tr>
		<td>3.</td>
		<td>Status</td>
		<td>:</td>
		<td><?php echo $data->row()->status; ?></td>
	</tr>
	<tr>
		<td>4.</td>
		<td>Tahun Berdiri</td>
		<td>:</td>
        <td><?php echo $data->row()->th_diri;?></td>
	</tr>
	<tr>
		<td>5.</td>
		<td>Alamat</td>
		<td>:</td>
        <td><?php echo $data->row()->alamat_sekolah;?></td>
        </tr>
	<tr>
		<td>6.</td>
		<td>Kelurahan/Desa</td>
		<td>:</td>
		<td><?php echo $data->row()->kelurahan; ?></td>
	</tr>
	<tr>
		<td>7.</td>
		<td>Kecamatan</td>
		<td>:</td>
		<td><?php echo $data->row()->kecamatan; ?></td>
	</tr>
	<tr>
		<td>8.</td>
		<td>Kabupatan/Kota</td>
		<td>:</td>
		<td><?php echo $data->row()->kabupaten; ?></td>
	</tr>
	<tr>
		<td>9.</td>
		<td>Pripinsi</td>
		<td>:</td>
		<td><?php echo $data->row()->propinsi; ?></td>
	</tr>
	<tr>
		<td>10.</td>
		<td>Kode Pos</td>
		<td>:</td>
		<td><?php echo $data->row()->pos; ?></td>
	</tr>
	<tr>
		<td>11.</td>
		<td>Telp</td>
		<td>:</td>
		<td><?php echo $data->row()->telp; ?></td>
	</tr>
	<tr>
		<td>12.</td>
		<td>Fax</td>
		<td>:</td>
		<td><?php echo $data->row()->fax; ?></td>
	</tr>
	<tr>
		<td>13.</td>
		<td>SMS</td>
		<td>:</td>
		<td><?php echo $data->row()->sms; ?></td>
	</tr>
	<tr>
		<td>14.</td>
		<td>Email</td>
		<td>:</td>
		<td><?php echo $data->row()->email; ?></td>
	</tr>
	<tr>
		<td>15.</td>
		<td>Nilai Akreditasi</td>
		<td>:</td>
		<td><?php echo $data->row()->nilai_akreditasi; ?></td>
	</tr>
	<tr>
		<td>16.</td>
		<td>Jumlah Kelas/Rombel</td>
		<td>:</td>
		<td><?php echo $data->row()->jml_kelas; ?></td>
	</tr>
	<tr>
		<td>17.</td>
		<td>Luas tanah seluruhnya</td>
		<td>:</td>
		<td><?php echo $data->row()->luas_tanah; ?>  m2</td>
	</tr>
	<tr>
		<td>18.</td>
		<td>Luas bangunan</td>
		<td>:</td>
		<td><?php echo $data->row()->luas_bangunan; ?>  m2</td>
	</tr>
	<tr>
		<td>19.</td>
		<td>Luas kebun/halaman</td>
		<td>:</td>
		<td><?php echo $data->row()->luas_kebun; ?>  m2</td>
	</tr>
	<tr>
		<td>20.</td>
		<td>Status Tanah</td>
		<td>:</td>
		<td><?php echo $data->row()->status_tanah; ?></td>
	</tr>
    <tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td colspan="4"><b>II.   KEPALA SEKOLAH</b></td>
	</tr>
	<tr>
		<td>1.</td>
		<td>Nama</td>
		<td>:</td>
		<td><?php echo $kepsek->row()->nama_lengkap ?></td>
	</tr>
	<tr>
		<td>2.</td>
		<td>NIP</td>
		<td>:</td>
		<td><?php echo $kepsek->row()->nip ?></td>
	</tr>
	<tr>
		<td>3.</td>
		<td>Jenis Kelamin</td>
		<td>:</td>
		<td><?php $a = ($kepsek->row()->kelamin=='L') ? 'Laki - Laki' : 'Perempuan'; echo $a;?></td>
	</tr>
	<tr>
		<td>4.</td>
		<td>Tempat, Tgl.Lahir</td>
		<td>:</td>
        <td><?php echo $kepsek->row()->tp_lahir; echo ',  '; $tgllahir = explode(' ',$kepsek->row()->tgl_lahir); $a=($tgllahir[0] == '0') ? ' ' : $tgllahir[0] ; $b=($tgllahir[1] == '0') ? ' ' : $tgllahir[1]; $c=($tgllahir[2] == '0') ? ' ' : $tgllahir[2]; echo $a.' '.$b.' '.$c;?></td>
	</tr>
	<tr>
		<td>5.</td>
		<td>Pangkat/Gol</td>
		<td>:</td>
		<td><?php echo $kepsek->row()->kepeg_golongan ?></td>
	</tr>
	<tr>
		<td>6.</td>
		<td>Pendidikan Terakhir</td>
		<td>:</td>
		<td><?php echo $kepsek->row()->pdd_akhir ?></td>
	</tr>
</table>
    <br /><br />
    <table border="0" width="100%">
        <tr>
            <td width="50%"></td>
            <td align="center"><?php echo $data->row()->kabupaten;?>, <?php $pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo $pilihtgl ; echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
        </tr>
        <tr>
            <td width="50%"></td>
            <td align="center">Kepala Sekolah,</td>
        </tr>
        <tr>
            <td width="50%"></td>
            <td>&nbsp;<br />&nbsp;<br /></td>
        </tr>
        <tr>
            <td width="50%"></td>
            <td align="center"><u><?php echo $kepsek->row()->nama_lengkap; ?></u></td>
        </tr>
        <tr>
            <td width="50%"></td>
            <td align="center">NIP.<?php echo $kepsek->row()->nip;  ?></td>
        </tr>
    </table>
</body>
</html>
