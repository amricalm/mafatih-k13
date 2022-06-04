<html>
<head>
<title>Raport</title>
<body>
<br />
<br />
<table align="center" border="0" width="95%" style=" font-size: 0.9em;">
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
    	<td>: <?php echo ($this->session->userdata('kd_semester')=='1') ? 'Ganjil' : 'Genap';?></td>
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
<br />
<br />
<a><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KEPRIBADIAN</b></a>
<table style=" border-collapse:collapse; " align="center" border="1" align="center" width="95%" cellpadding="0">
<tr style="background: #E1E1E1;" >
	<th width="5%" height="25px" >No</th>
    <th width="80%">Kepribadian</th>
    <th width="15%">Nilai</th>
</tr>
<?php   
    $i = 1;
    foreach($pribadi->result() as $row)
    {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        echo '<tr'.$bg.'>';
        echo '<td align="center">'.$i.'</td>';
        echo '<td>&nbsp;&nbsp;'.$row->ket_pribadi.'</td>';
        $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
        echo '<td align="center">'.$nilai.'</td>';
        echo '</tr>';
        $i++;
    }
?>
</table>
<br />
<a><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EKSTRAKURIKULER</b></a>
<table style=" border-collapse:collapse; " align="center" border="1" align="center" width="95%" cellpadding="0">
<tr style="background: #E1E1E1;" >
	<th width="5%" height="25px">No</th>
    <th width="80%">Jenis Ekstrakurikuler</th>
    <th width="15%">Nilai</th>
</tr>
<?php   
    $i = 1;
    foreach($eskul->result() as $row)
    {   
        $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
        if($nilai != '-')
        {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        echo '<tr'.$bg.'>';
        echo '<td align="center">'.$i.'</td>';
        echo '<td>&nbsp;&nbsp;'.$row->nm_eskul.'</td>';
        //$nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
        echo '<td align="center">'.$nilai.'</td>';
        echo '</tr>';
        $i++;
        }
    }
?>
</table>
<br />
<a><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KETIDAKHADIRAN</b></a>
<table style=" border-collapse:collapse; " align="center" border="1" align="center" width="95%" cellpadding="0">
<tr style="background: #E1E1E1;" >
	<th width="5%" height="25px">No</th>
    <th width="80%">Alasan</th>
    <th width="15%">Jumlah</th>
</tr>
<tr>
    <td align="center">1</td>
    <td>&nbsp;&nbsp;Sakit</td>
    <td align="center"><?php $a=($absens->row()->alfa == '0') ? '-' : $absens->row()->alfa; echo $a; ?></td>
</tr>
<tr>
    <td align="center">2</td>
    <td>&nbsp;&nbsp;Ijin</td>
    <td align="center"><?php $a=($abseni->row()->alfa == '0') ? '-' : $abseni->row()->alfa; echo $a; ?></td>
</tr>
<tr>
    <td align="center">3</td>
    <td>&nbsp;&nbsp;Tanpa Keterangan</td>
    <td align="center"><?php $a=($absena->row()->alfa == '0') ? '-' : $absena->row()->alfa; echo $a; ?></td>
</tr>
</table>
<br />
<a><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CATATAN WALI KELAS</b></a>
<table style=" border-collapse:collapse;font-size: 12px; " align="center" border="1" align="center" width="95%" cellpadding="0">
<tr>
    <td style="width:100% ; height: 90px;" align="center">
        <textarea align="center" style="width:100% ; height: 95px; font-family: bradley hand ITC ; font-size:13px; font-weight: bold; padding: 0px 0px; border: none; resize:none; "><?php echo ($coment->num_rows()>0) ? $coment->row()->comment : '' ; ?></textarea>
    </td>
</tr>
</table>
<?php if($this->session->userdata('kd_semester')==1){ ?>
    <table align="center" border="0" width="95%"  >
    <tr>
        <td width="5%"></td>
        <td>
        <table style="border: 1px; border-collapse: collapse; font-size: 13px;">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="center">Mengetahui</td>
            </tr>
            <tr>
            	<td align="center">Orang Tua / Wali <br /><br /><br /></td>
            </tr>
            <tr>
            	<td align="center" style="border-bottom: 1px; text-decoration: underline;"><?php echo $datasiswa->row()->ayah_nama  ?></td>
            </tr>
        </table>
        </td>
        <td  width="30%">
        <table style="border: 1px; border-collapse: collapse; font-size: 13px;">
            <tr>
                <td align="left;"><?php echo $sekolah->row()->kabupaten;?>,&nbsp;<?php $pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo $pilihtgl ; echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>Wali Kelas</b><br /><br /><br /></td>
            </tr>
            <tr>
            	<td align="center" colspan="3" style="border-bottom: 1px; text-decoration: underline;"><b><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></b></td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?></b></td>
            </tr>
        </table>
        </td>
    </tr>
    </table>
<?php } else{?>
    <table align="center" border="0" width="95%" style="font-size: 13px;"  >
    <tr>
        <td colspan="2" width="33%">
        <table style="border: 1px; border-collapse: collapse; font-size: 13px; width: 100%;">
            <tr>
                <td>&nbsp;</td>
            </tr><tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
            	<td align="center"><b>Orang Tua / Wali</b><br /><br /><br /></td>
            </tr>
            <tr>
            	<td align="center" style="border-bottom: 1px; text-decoration: underline;"><b><?php echo $datasiswa->row()->ayah_nama  ?></b></td>
            </tr>
        </table>
        </td>
        <td colspan="2" width="34%"  align="center">
        <table style="border: 1px; border-collapse: collapse; font-size: 13px; width: 100%;">
            <tr>
                <td>&nbsp;</td>
            </tr><tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>Wali Kelas</b><br/><br/><br/></td>
            </tr>
            <tr>
            	<td align="center" colspan="3" style="border-bottom: 1px; text-decoration: underline;"><b><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></b></td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?></b></td>
            </tr>
        </table>
        </td>
        <td colspan="2" width="33%" align="center">
        <table style="border: 1px; border-collapse: collapse; font-size: 13px; width: 100%;">
            <tr>
                <td align="center;" colspan="3" ><?php echo $sekolah->row()->kabupaten;?>,&nbsp;<?php $pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo $pilihtgl ; echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
            </tr>
            <tr>
            	<td align="center" colspan="3">Mengetahui<br /></td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>Kepala Madrasah</b><br /><br /><br /></td>
            </tr>
            <tr>
            	<td align="center" colspan="3" style="border-bottom: 1px; text-decoration: underline;"><b><?php $h= ($kepsek->num_rows()>0) ? $kepsek->row()->nama_lengkap : ''; echo $h ?></b></td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>NIP.<?php $nip= ($kepsek->num_rows()>0) ? $kepsek->row()->nip : ''; echo $nip ?></b></td>
            </tr>
        </table>
        </td>
    </tr>
    </table>
<?php }?>
</body>
</html>
