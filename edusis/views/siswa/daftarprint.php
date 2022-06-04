<html>
<head>
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" /><!-- WRITE YOUR CSS CODE HERE -->
<title>Edusis Prestasi | Daftar Siswa Perkelas</title>
</head>
<body>
<table border="0" align="center" width="80%">
<tr>
    <td align="center" style="font-size: 16px;font: bold;" colspan="3">DAFTAR SISWA</td>
</tr>
<tr>
    <td align="center" style="font-size: 16px;font: bold;" colspan="3">TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?><br /><br /></td>
</tr>
<tr>
    <td align="left" style="font-size: 11px; width: 100px;" >Sekolah</td><td style="width:5px;font-size: 11px; font: bold;">:</td>
    <td style="font-size: 11px;"><?php echo $nama_sekolah ?></td>
</tr>
<tr>
    <td align="left" style="font-size: 11px;" >Kelas</td><td style="width:5px;font-size: 11px; font: bold;">:</td>
    <td style="font-size: 11px;"><?php $a=str_replace('+',' ',$this->uri->segment(3));echo $a ; ?></td>
</tr>
</table>
<table style="border-collapse: collapse; font-size: 10px;" width="80%" border="1" align="center" >
	<tr  style="background: #E1E1E1;" >
        <th style="width:5px; height:25px;">NO</th>
	    <th style="width:40px; ">NIS</th>
		<th style="width:130px; ">Nama Lengkap</th>
		<th style="width:60px; ">Tgl Lahir</th>
	    <th style="width:120px; ">Nama Orang Tua</th>
	    <th style="width:200px; ">Alamat</th>
	    <th style="width:60px; ">Telp</th>
	</tr>
    <?php 
    $seq = 1;
    foreach($siswa->result() as $row)
    {
        $bg = ($seq%2==0) ? ' class="bg" ' : '';
        echo '<tr'.$bg.'>';
        echo '<td align="center">'.$seq.'</td>';
        echo '<td align="center">'.$row->nis.'</td>';
        echo '<td>'.$row->nama_lengkap.'</td>';
        
        //$tgllahir = ($row->tgl_lahir == '' || $row->tgl_lahir == '0'|| $row->tgl_lahir == 'NULL') ? explode(' ','0 0 0') : explode(' ',$row->tgl_lahir);
        //$a=($tgllahir[0] == '0') ? ' ' : $tgllahir[0];
        ///$b=($tgllahir[1] == '0') ? ' ' : $tgllahir[1];
        //$c=($tgllahir[2] == '0') ? ' ' : $tgllahir[2];
        echo '<td>'.$row->tglpanjang.'</td>';
                                        
        echo '<td style="text-transform: lowercase;">'.$row->ayah_nama.'</td>';
        echo '<td>'.$row->alamat.'</td>';
        echo '<td>'.$row->telp.'</td>';
        echo '</tr>';
        $seq++;
    }
    ?>
</table>
<br />
<table style="border-collapse: collapse; font-family: sans-serif;font-size: 11px;" width="80%" border="0" >
	<tr>
        <td width="80%"></td>
        <td align="center"><?php echo $sekolah->row()->kabupaten;?>, <?php $pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo $pilihtgl ; echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
    </tr>
    <tr>
        <td width="80%"></td>
        <td align="center"><b>Wali Kelas.</b></td>
    </tr>
    <tr>
        <td width="80%"></td>
        <td>&nbsp;<br />&nbsp;<br /></td>
    </tr>
    <tr>
        <td width="80%"></td>
        <td align="center"><u><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></u></td>
    </tr>
    <tr>
        <td width="80%"></td>
        <td align="center">NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?></td>
    </tr>
</table>
<div class="sembunyi-kanan">
    <a style="color: white;" href="<?php echo base_url().'index.php/siswa/daftarprint_pdf/'.$this->uri->segment(3); ?>">Export Pdf</a>
</div>
</body>
</html>
