<html>
<head>
<title>Raport</title>
<body>
<table align="center" border="0" align="center" width="100%" cellpadding="0"><tr><td>
<table align="center" border="0" align="center" width="100%" cellpadding="0">
<tr>
    <td align="center" height="5px" style="font-size: 18px;font: bold;" >LAPORAN HASIL BELAJAR SISWA</td>
</tr>
<tr>
    <td align="center" style="font-size: 18px; font: bold;" >MADINA ISLAMIC SCHOOL [ PRIMARY ]</td>
</tr>
<tr>
    <td align="center" style="font-size: 18px;font: bold;" >TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?><hr size="2px" style="color: black;"/></td>
</tr>
</table>
<table align="center" border="0" align="center" width="100%" cellpadding="0">
<tr>
	<td width="20%">Nama Siswa</td>
	<td width="1%">:</td>
    <td width="57%"><?php echo $hasilbelajar->row()->nama_lengkap;?></td>
	<td width="15%">Kelas</td>
	<td width="1%">:</td>
    <td width="6%"><?php echo $hasilbelajar->row()->kelas;?></td>
</tr>
<tr>
	<td>Nomor Induk Siswa</td>
	<td>: </td>
    <td><?php echo $hasilbelajar->row()->nis;?></td>
	<td>Semester</td>
	<td>: </td>
    <td><?php echo $this->session->userdata('kd_semester');?></td>
</tr>
</table>
<br />
<br />
<table style=" border-collapse:collapse; " align="center" border="1" align="center" width="100%" cellpadding="0">
<tr style="background: #E1E1E1;" >
    <label>Ketercapaian Kompetensi Siswa</label>
	<th width="5%" height="25%">No</th>
    <th width="20%">Mata Pelajaran</th>
    <th width="75%">Ketercapaian Kompetensi</th>
</tr>
<?php 
$i  = 1;
foreach($hasilbelajar->result() as $row)
{
    $bg = ($i%2==0) ? ' class="bg" ' : '';
    echo '<tr'.$bg.'>';
    echo '<td width="1%" align="center">'.$i.'</td>';
    echo '<td width="20%">'.$row->nm_mp.'</td>';
    echo '<td width="79%">'.$row->kks.'</td>';
    $i++;
    echo '</tr>';
}

?>
</table>
<br />
<table align="center" border="0" width="100%" >
<tr>
    <td>
    <table>
        <tr>
            <td align="center">Mengetahui</td>
        </tr>
        <tr>
        	<td align="center">Orang Tua / Wali <br /><br /><br /><br /></td>
        </tr>
        <tr>
        	<td align="center" style="border-bottom: 1px; text-decoration: underline;"><?php //$hasilbelajar->row()->ayah_nama; ?></td>
        </tr>
    </table>
    </td>
    <td  width="20%">
    <table>
        <tr>
            <td align="center">Jakarta, 24 Desember 2011</td>
        </tr>
        <tr>
        	<td align="center">Wali Kelas <br /><br /><br /></td>
        </tr>
        <tr>
        	<td align="center" style="border-bottom: 1px; text-decoration: underline;"><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></td>
        </tr>
        <tr>
        	<td align="center">NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?></td>
        </tr>
    </table>
    </td>
</tr>
</table> 
</td></tr>
</table>
<div class="sembunyi">
    <a href="<?php echo base_url().'index.php/export/export_ledger3_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>">Export Pdf</a> |
</div>
</body>
</html>
