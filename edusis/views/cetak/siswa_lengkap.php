<html>
<head>
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
	<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" /><!-- WRITE YOUR CSS CODE HERE -->
	<title>Edusis Prestasi | Profil Siswa</title>
</head>
<body>
<table border="0" align="center" style="padding:0px;font-size: 13px;" width="80%;" cellpadding="0">
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
		<td width="200px">Nama Lengkap</td>
		<td width="20px">:</td>
		<td><?php echo $data->row()->nama_lengkap; ?></td>
	</tr>
	<tr>
		<td width="15px">2.</td>
		<td width="200px">Nama Panggilan</td>
		<td width="20px">:</td>
		<td><?php echo $data->row()->nama_panggilan; ?></td>
	</tr>
	<tr>
		<td>3.</td>
		<td>NIS / NISN</td>
		<td>:</td>
		<td><?php echo $data->row()->nis .' / '; echo $data->row()->nisn; ?></td>
	</tr>
	<tr>
		<td>4.</td>
		<td>Tempat, Tgl Lahir</td>
		<td>:</td>
        <td><?php echo $data->row()->tp_lahir; echo ',  '; echo $tgl->row()->hr; echo ' - '; echo $tgl->row()->bln; echo ' - '; echo $tgl->row()->th;?></td>
	</tr>
	<tr>
		<td>5.</td>
		<td>Jenis Kelamin</td>
		<td>:</td>
		<td><?php $a = ($data->row()->kelamin=='L') ? 'Laki - Laki' : 'Perempuan'; echo $a;?></td>
	</tr>
	<tr>
		<td>6.</td>
		<td>Agama</td>
		<td>:</td>
		<td><?php echo $data->row()->agama; ?></td>
	</tr>
	<tr>
		<td>7.</td>
		<td>Warganegara</td>
		<td>:</td>
		<td><?php echo $data->row()->wn; ?></td>
	</tr>
	<tr>
		<td>8.</td>
		<td>Anak ke</td>
		<td>:</td>
		<td><?php echo $data->row()->anak_ke.' Dari ';echo $data->row()->jmh_sdr_kandung.' Bersaudara'; ?></td>
	</tr>
	<tr>
		<td>9.</td>
		<td>Jarak Ke Sekolah</td>
		<td>:</td>
		<td><?php echo $data->row()->jarak.' KM'; ?></td>
	</tr>
	<tr>
		<td>10.</td>
		<td>Tinggal Dengan</td>
		<td>:</td>
		<td><?php echo $data->row()->tinggal_dg; ?></td>
	</tr>
	<tr>
		<td>11.</td>
		<td>Alamat</td>
		<td>:</td>
		<td><?php echo $data->row()->alamat; ?></td>
	</tr>
	<tr>
		<td>12.</td>
		<td>Kelurahan</td>
		<td>:</td>
		<td><?php echo $data->row()->kelurahan .',Kec ';echo $data->row()->kecamatan .',Kab ';echo $data->row()->kota; ?></td>
	</tr>
	<tr>
		<td>12.</td>
		<td>Kode Pos</td>
		<td>:</td>
		<td><?php echo $data->row()->kode_pos; ?></td>
	</tr>
	<tr>
		<td>13.</td>
		<td>Telp</td>
		<td>:</td>
		<td><?php echo $data->row()->telp; ?></td>
	</tr>
	<tr>
		<td>14.</td>
		<td>Pendidikan</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td>Pendidikan Sebelumnya</td>
		<td>:</td>
		<td><?php echo $data->row()->asal_sekolah; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>Mulai Jadi Murid</td>
		<td>:</td>
		<td><?php echo $data->row()->diterima_tgl; ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>15.</td>
		<td>Riwayat Kesehatan</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td>Gol Darah</td>
		<td>:</td>
		<td><?php echo $data->row()->gol_darah; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>Penyakit Pernah diderita</td>
		<td>:</td>
		<td><?php echo $data->row()->penyakit; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>TB / BB</td>
		<td>:</td>
		<td><?php echo $data->row()->tinggi_badan.' Cm / ';echo $data->row()->tinggi_badan.' Kg'; ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>16.</td>
		<td>Orang Tua</td>
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
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Pendidikan</td>
		<td>:</td>
		<td><?php echo $data->row()->ayah_pdd; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Pekerjaan</td>
		<td>:</td>
		<td><?php echo $data->row()->ayah_pekerjaan; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>b. Ibu</td>
		<td>:</td>
		<td><?php echo $data->row()->ibu_nama; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Pendidikan</td>
		<td>:</td>
		<td><?php echo $data->row()->ibu_pdd; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Pekerjaan</td>
		<td>:</td>
		<td><?php echo $data->row()->ibu_pekerjaan; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Alamat</td>
		<td>:</td>
		<td><?php echo $data->row()->ibu_alamat; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Kelurahan</td>
		<td>:</td>
		<td><?php echo $data->row()->ibu_kelurahan .',Kec ';echo $data->row()->ibu_kecamatan .',Kab ';echo $data->row()->ibu_kota; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;Telp</td>
		<td>:</td>
		<td><?php echo $data->row()->ibu_telp; ?></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>17.</td>
		<td>Wali Peserta Didik</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td>Nama</td>
		<td>:</td>
		<td><?php echo $data->row()->wali_nama; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>Hubungan</td>
		<td>:</td>
		<td><?php echo $data->row()->wali_hubungan; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>Pendidikan</td>
		<td>:</td>
		<td><?php echo $data->row()->wali_pdd; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>Pekerjaan</td>
		<td>:</td>
		<td><?php echo $data->row()->wali_pekerjaan; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>Alamat</td>
		<td>:</td>
		<td><?php echo $data->row()->wali_alamat; ?></td>
	</tr>
	<tr>
		<td></td>
		<td>Telp</td>
		<td>:</td>
		<td><?php echo $data->row()->wali_telp; ?></td>
	</tr>
    <tr><td colspan="4">
    <br /><br />
    <table border="0" style="font-size: 13px;" width="100%">
        <tr>
            <td width="50%"></td>
            <td align="center"><?php echo $sekolah->row()->kabupaten;?>, <?php $pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo $pilihtgl ; echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
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
    </table></td></tr>
</table>
<div class="sembunyi-kanan">
    <a style="color: white;" href="<?php echo base_url().'index.php/siswa/profilelengkap_pdf/'.$this->uri->segment(3); ?>">Export Pdf</a>
</div>

</body>
</html>
