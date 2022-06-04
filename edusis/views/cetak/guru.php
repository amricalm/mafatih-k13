<html>
<head>
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" /><!-- WRITE YOUR CSS CODE HERE -->
<title>Edusis Prestasi | Daftar Guru</title>
</head>
<body>
<table align="center" border="0" align="center" width="95%" cellpadding="0">
<tr>
    <td align="center" style="font-size: 11px;font: bold;" colspan="3">DAFTAR GURU</td>
</tr>
<tr>
    <td align="center" style="font-size: 11px;font: bold; text-transform: uppercase;;" colspan="3">SEKOLAH <?php echo $nama_sekolah ?></td>
</tr>
<tr>
    <td align="center" style="font-size: 11px;font: bold;" colspan="3">TAHUN <?php echo $this->session->userdata('th_ajar') ?><br /></td>
</tr>
<tr>
    <td align="left" style="font-size: 13px;" colspan="3">&nbsp;&nbsp;&nbsp;Jumlah Guru : <?php echo $jmhguru; ?> Orang</td>
</tr>
</table>
<table style="border-collapse: collapse; font-family: sans-serif;font-size: 11px; border: black; padding: 5px;margin: 5px auto; " width="95%" border="1" cellpadding="3px" >
	<tr  style="background: #E1E1E1;" >
	    <th width="3%" height="25px" >#</th>
	    <th style="width:8%; align:ceter;">NIP</th>
		<th width="20%">Nama Lengkap</th>
	    <th width="13%">Tanggal Lahir</th>
	    <th width="43%">Alamat</th>
	    <th width="13%">Telp</th>
	</tr>
        <?php
        $seq = 1; 
        foreach($guru->result() as $row)
        {
            $bg = ($seq%2==0) ? ' class="bg" ' : '';
            echo '<tr'.$bg.'>';
            echo '<td align="center" width="3%" >'.$seq.'</td>';
            echo '<td align="center" width="8%">'.$row->nip.'</td>';
            echo '<td width="20%">&nbsp;&nbsp;'.$row->nama_lengkap.'</td>';
            //echo '<td>&nbsp;&nbsp;'.$row->tp_lahir.'</td>';
            
            //$tgllahir = ($row->tgl_lahir == '' || $row->tgl_lahir == '0'|| $row->tgl_lahir == 'NULL') ? explode(' ','0 0 0') : explode(' ',$row->tgl_lahir);
            //$a=($tgllahir[0] == '0') ? ' ' : $tgllahir[0];
            //$b=($tgllahir[1] == '0') ? ' ' : $tgllahir[1];
            //$c=($tgllahir[2] == '0') ? ' ' : $tgllahir[2];
            echo '<td align="center" width="13%">'.$row->tglpanjang.'</td>';
            echo '<td width="43%">&nbsp;&nbsp;'.$row->alamat.'</td>';
            echo '<td width="13%">&nbsp;&nbsp;'.$row->hp.'</td>';
            $seq++;
            echo '</tr>';
        }
        ?>
</table>
<br />
<table style="border-collapse: collapse; font-family: sans-serif;font-size: 12px; border: black; padding: 5px;margin: 5px auto; " width="95%" border="0" >
	<tr>
        <td width="50%"></td>
        <td align="center"><?php echo $sekolah->row()->kabupaten;?>, <?php $pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo $pilihtgl ; echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
    </tr>
    <tr>
        <td width="50%"></td>
        <td align="center"><b>Kepala Sekolah.</b></td>
    </tr>
    <tr>
        <td width="50%"></td>
        <td>&nbsp;<br />&nbsp;<br /></td>
    </tr>
    <tr>
        <td width="50%"></td>
        <td align="center"><b><u><?php $h= ($kepsek->num_rows()>0) ? $kepsek->row()->nama_lengkap : ''; echo $h ?></u></b></td>
    </tr>
    <tr>
        <td width="50%"></td>
        <td align="center">NIP.<?php $nip= ($kepsek->num_rows()>0) ? $kepsek->row()->nip : ''; echo $nip ?></td>
    </tr>
</table>
<!--<div class="sembunyi-kanan">
    <a style="color: white;" href="<?php //echo base_url().'index.php/guru/daftarprint_pdf/'.$this->uri->segment(3); ?>">Export Pdf</a>
</div>-->
</body>
</html>
