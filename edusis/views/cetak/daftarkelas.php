<html>
<head>
<title>Daftar Kelas</title>
<body>
<br />
<table border="0" align="center"  width="95%" style=" font-size: 13px;">
    <tr>
        <td align="center"style="font-size: 14px; font: bold;" colspan="3" ><b>DAFTAR KELAS</b></td>
    </tr>
    <tr>
        <td align="center"style="font-size: 14px; font: bold; text-transform: uppercase;" colspan="3" ><b><?php echo $sekolah->row()->nama_sekolah;?></b></td>
    </tr>
    <tr>
        <td style="width:10%; font-size: 13px; ">Tahun Ajar<br /></td>
        <td style="width:1%; font-size: 13px; ">:<br /></td>
        <td style="width:84%; font-size: 13px; "><?php echo $this->session->userdata('th_ajar');?><br /></td>
    </tr>
    <tr>
        <td style="font-size: 13px; ">Semester<br /></td>
        <td style="font-size: 13px; ">:<br /></td>
        <td style="font-size: 13px; "><?php echo ($this->session->userdata('kd_semester')==1) ? 'Ganjil' : 'Genap';?><br /></td>
    </tr>
</table>
<table border="1"  align="center"  width="95%" style="border-collapse: collapse; font-size: 12px;" cellpadding="3px" >
    <tr style="background: #E1E1E1; " >
	    <th style="width:3%; height:25px;"></th>
	    <th style="width:20%">Kelas</th>
	    <th style="width:67%">Wali Kelas</th>
	    <th style="width:9%">Jumlah Siswa</th>
	</tr>
	<?php
        $totalsiswa	= 0;
        $seq        = 1;
		foreach($kelas->result() as $row):
	?>						
	<tr class="<?php  if($seq % 2 == 0) echo "bg"; else echo "";?>">
        <td align="center"><?php echo $seq;?></td>
	    <td>&nbsp;&nbsp;<?php echo $row->kelas;?></td>
        <td>&nbsp;&nbsp;<?php echo $row->nama_lengkap;?></td>
	<?php
        $data['kls']    = $row->kelas;
        $siswajml       = $this->kelas_model->get_jmlsiswaperkelas($data)->num_rows();	
        echo '<td align="center">'.$siswajml.'</td>';
        $totalsiswa += $siswajml;
        $seq++;
		endforeach;
	?>							
	</tr>
    <tr>
        <td colspan="3"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Siswa</b></td>
        <td align="center"><b><?php echo $totalsiswa; ?></b></td>
    </tr>
</table>
<br />
<table border="0" width="95%" style=" font-size: 13px;">
    <tr>
        <td width="80%"></td>
        <td align="center"><?php echo $sekolah->row()->kabupaten;?>, <?php $pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo $pilihtgl ; echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
    </tr>
    <tr>
        <td width="80%"></td>
        <td align="center">Kepala Sekolah,</td>
    </tr>
    <tr>
        <td width="80%"></td>
        <td>&nbsp;<br />&nbsp;<br /></td>
    </tr>
    <tr>
        <td width="80%"></td>
        <td align="center"><u><?php echo $kepsek->row()->nama_lengkap; ?></u></td>
    </tr>
    <tr>
        <td width="80%"></td>
        <td align="center"><!--NIP.<?php echo $kepsek->row()->nip;  ?>--></td>
    </tr>
</table>
</body>
</html>