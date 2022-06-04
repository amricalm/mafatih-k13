<html>
<head>
<title>Raport</title>
</head>
<body>
<br /><br />
<table align="center" border="0" width="90%" style=" font-size: 0.9em;">
    <tr>
    	<td width="25%">Nama Peserta Didik</td>
    	<td width="40%px">: <?php echo $datasiswa->row()->nama_lengkap;?></td>
    	<td width="15%">Kelas</td>
    	<td width="20%">: <?php echo str_replace('+',' ',$this->uri->segment(3));?></td>
    </tr>
    <tr>
    	<td>Nomor Induk</td>
    	<td>: <?php echo $datasiswa->row()->nis;?></td>
    	<td>Semester</td>
    	<td>: <?php echo $this->session->userdata('kd_semester');?></td>
    </tr>
    <tr>
    	<td>Nama Sekolah</td>
    	<td>: <?php echo $sekolah->row()->nama_sekolah;?></td>
    	<td>Tahun Ajaran</td>
    	<td>: <?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
    	<td>Alamat Sekolah</td>
    	<td>: <?php echo $sekolah->row()->alamat_sekolah;?></td>
    </tr>
</table>
<br /><br />
<table align="center" border="0" width="95%" style=" font-size: 0.9em;">
<tr>
    <td>
        <table style=" border-collapse:collapse; font-size: 1em; " align="center" border="1" width="95%" cellpadding="0">
        <tr>
            <td style="width:100% ;height: 250px; " border="1">
                <div style="text-align: center;"><h3>CATATAN TENTANG PENGEMBANGAN DIRI</h3></div>
               <textarea style="width:100% ; height: 200px; font-family: sans-serif ; font-size:14px ; padding: 25px 25px; border: none; resize:none; "><?php echo ($catatan_pengembangan_diri->num_rows()>0) ? $catatan_pengembangan_diri->row()->comment : '' ; ?></textarea>
            </td>
        </tr>
        </table>
    </td>
</tr>
<tr>
    <td>
        <table style=" border-collapse:collapse; font-size: 1em; " align="center" border="1" width="95%" cellpadding="0">
        <tr>
            <td style="width:100% ; height: 250px;">
                <div style="text-align: center;"><h3>CATATAN</h3></div>
                <textarea style="width:100% ; height: 200px; font-family: sans-serif ; font-size:14px ; padding: 25px 25px; border: none; resize:none; "><?php echo ($catatan_umum->num_rows()>0) ? $catatan_umum->row()->comment : '' ; ?></textarea>
            </td>
        </tr>
        </table>
    </td>
</tr>
<tr>
    <td>
        <table align="center" border="0" width="95%" >
        <tr>
            <td>
            <br /><br />
            <table>
                <tr>
                    <td align="center">Mengetahui</td>
                </tr>
                <tr>
                	<td align="center">Orang Tua / Wali <br /><br /><br /><br /></td>
                </tr>
                <tr>
                	<td align="center" style="border-bottom: 1px; text-decoration: underline;"><?php echo $hasilbelajar->row()->ayah_nama; ?></td>
                </tr>
            </table>
            </td>
            <td  width="30%">
            <br /><br />
            <table>
                <tr>
                    <td align="center"><?php echo $sekolah->row()->kabupaten;?>, <?php echo $tgl_rapor;//$arraytgl = $this->app_model->tgl(); $pilihtgl = date('d'); $pilihbln = date('m');;$pilihth = date('y'); echo $pilihtgl ;echo ' - '; echo $pilihbln; echo ' - ';echo '20'; echo $pilihth;?></td>
                </tr>
                <tr>
                	<td align="center">Wali Kelas <br /><br /><br /></td>
                </tr>
                <tr>
                	<td align="center"><u><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></u></td>
                </tr>
                <tr>
                	<td align="center">NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?><?php echo $walikelas->row()->nip; ?></td>
                </tr>
            </table>
            </td>
        </tr>
        </table>
    </td>
</tr>
</table>
</body>
</html>