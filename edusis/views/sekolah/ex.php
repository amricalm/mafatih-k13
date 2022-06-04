<html>
<head><time></time>
</head>
<body>
<table align="center" style="width: 95%;">
    <tr>
        <td colspan="3" style="text-align:center;">SEKOLAH</td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Nama Sekolah</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->nama_sekolah; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">NSS</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->nss; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Status</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->status; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Tahun Berdiri</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->th_diri; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Alamat</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->alamat_sekolah; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Kelurahan/Desa</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->kelurahan; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Kecamatan</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->kecamatan; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">kabupaten/Kota</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->kabupaten; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Propinsi</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->propinsi; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Kode Pos</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->pos; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Telp</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->telp; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Fax</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->fax; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">SMS</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->sms; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Email</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->email; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Nilai Akreditasi</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->nilai_akreditasi; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Jumlah Kelas/Rombel</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->jml_kelas; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Luas Tanah Selanjutnya</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->luas_tanah; ?>&nbsp;&nbsp;m2</td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Luas Bangunan</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->luas_bangunan; ?>&nbsp;&nbsp;m2</td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Luas Kebun / Halaman</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->luas_kebun; ?>&nbsp;&nbsp;m2</td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Status Tanah</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $data->row()->status_tanah; ?></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center;">KEPALA SEKOLAH</td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Nama</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $kepsek->row()->nama_lengkap; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">NIP</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $kepsek->row()->nip; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Jenis Kelamin</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php $a = ($kepsek->row()->kelamin=='L') ? 'Laki - Laki' : 'Perempuan'; echo $a;?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Tempat, Tgl Lahir</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $kepsek->row()->tp_lahir; echo ',  '; $tgllahir = explode(' ',$kepsek->row()->tgl_lahir); $a=($tgllahir[0] == '0') ? ' ' : $tgllahir[0] ; $b=($tgllahir[1] == '0') ? ' ' : $tgllahir[1]; $c=($tgllahir[2] == '0') ? ' ' : $tgllahir[2]; echo $a.' '.$b.' '.$c;?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Pangkat / Gol</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $kepsek->row()->kepeg_golongan; ?></td>
    </tr>
    <tr>
        <td style="width: 45%;text-align: right;">Pendidikan terakhir</td>
        <td style="width: 5%;text-align: center;">:</td>
        <td style="width: 45%;text-align: left;"><?php echo $kepsek->row()->pdd_akhir; ?></td>
    </tr>
</table>
</body>
</html>