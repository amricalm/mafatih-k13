<!DOCTYPE html>
<html>
<head>
    <title>Ledger Nilai</title>
</head>
<body>
    <table style="width: 100%;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" colspan="4" ><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/head.jpg" height="155px" width="355px"/><br /><br /></td>
    </tr>
    <tr>
        <td align="center"style="font-size: 22px; font: bold;" colspan="3" >Ledger Nilai</td>
    </tr>
    <tr>
        <td align="center" style="font-size: 22px; font: bold;" colspan="3">Term <?php echo $this->session->userdata('kd_semester') ?> Tahun Ajaran <?php echo $this->session->userdata('th_ajar') ?><br /><br /></td>
    </tr>
    <tr>
        <td style="width:10%;">Nama Siswa<br /></td>
        <td style="width:1%;">:<br /></td>
        <td style="width:89%;"><?php $hasilbelajar->row()->nama_lengkap?><br /></td>
    </tr>
    <tr>
        <td>Kelas<br /><br /></td>
        <td>:<br /><br /></td>
        <td><?php echo $hasilbelajar->row()->kelas; ?><br /><br /></td>
    </tr>
    </table>
<table style=" border-collapse:collapse; " align="center" border="1" align="center%" width="100%" cellpadding="0">
<tr  style="background: #E1E1E1;" >
	<th width="3%" height="25px">#</th> 
	<th width="22%">Subject</th>
	<th colspan="4" width="16%">Unit Test</th>
	<th colspan="4" width="16%">School Work</th>
	<th colspan="4" width="16%">Home Work</th>
	<th colspan="4" width="16%">Project</th>
	<th width="5%">Mid Test</th>
	<th width="5%">Average</th>
</tr>
<?php 
$i  = 1;
foreach($hasilbelajar->result() as $row)
{
    $jumlah = 0;
    $bg = ($i%2==0) ? ' class="bg" ' : '';
    echo '<tr'.$bg.'>';
    echo '<td width="3%" align="center">'.$i.'</td>';
    echo '<td width="22%">'.$row->nm_mp.'</td>';
    $UT1    = ($row->UT1=='0') ? ' ' : $row->UT1;
    echo '<td width="4%" align="center">'.$UT1.'</td>';
    $jumlah += $row->UT1;
    $UT2    = ($row->UT2=='0') ? ' ' : $row->UT2;
    echo '<td width="4%" align="center">'.$UT2.'</td>';
    $jumlah += $row->UT2;
    $UT3    = ($row->UT3=='0') ? ' ' : $row->UT3;
    echo '<td width="4%" align="center">'.$UT3.'</td>';
    $jumlah += $row->UT3;
    $UT4    = ($row->UT4=='0') ? ' ' : $row->UT4;
    echo '<td width="4%" align="center">'.$UT4.'</td>';
    $jumlah += $row->UT4;
    $SW1    = ($row->SW1=='0') ? ' ' : $row->SW1;
    echo '<td width="4%" align="center">'.$SW1.'</td>';
    $jumlah += $row->SW1;
    $SW2    = ($row->SW2=='0') ? ' ' : $row->SW2;
    echo '<td width="4%" align="center">'.$SW2.'</td>';
    $jumlah += $row->SW2;
    $SW3    = ($row->SW3=='0') ? ' ' : $row->SW3;
    echo '<td width="4%" align="center">'.$SW3.'</td>';
    $jumlah += $row->SW3;
    $SW4    = ($row->SW4=='0') ? ' ' : $row->SW4;
    echo '<td width="4%" align="center">'.$SW4.'</td>';
    $jumlah += $row->SW4;
    $HW1    = ($row->HW1=='0') ? ' ' : $row->HW1;
    echo '<td width="4%" align="center">'.$HW1.'</td>';
    $jumlah += $row->HW1;
    $HW2    = ($row->HW2=='0') ? ' ' : $row->HW2;
    echo '<td width="4%" align="center">'.$HW2.'</td>';
    $jumlah += $row->HW2;
    $HW3    = ($row->HW3=='0') ? ' ' : $row->HW3;
    echo '<td width="4%" align="center">'.$HW3.'</td>';
    $jumlah += $row->HW3;
    $HW4    = ($row->HW4=='0') ? ' ' : $row->HW4;
    echo '<td width="4%" align="center">'.$HW4.'</td>';
    $jumlah += $row->HW4;
    $P1    = ($row->P1=='0') ? ' ' : $row->P1;
    echo '<td width="4%" align="center">'.$P1.'</td>';
    $jumlah += $row->P1;
    $P2    = ($row->P2=='0') ? ' ' : $row->P2;
    echo '<td width="4%" align="center">'.$P2.'</td>';
    $jumlah += $row->P2;
    $P3    = ($row->P3=='0') ? ' ' : $row->P3;
    echo '<td width="4%" align="center">'.$P3.'</td>';
    $jumlah += $row->P3;
    $P4    = ($row->P4=='0') ? ' ' : $row->P4;
    echo '<td width="4%" align="center">'.$P4.'</td>';
    $jumlah += $row->P4;
    $MT    = ($row->MT=='0') ? ' ' : $row->MT;
    echo '<td width="5%" align="center">'.$MT.'</td>';
    $jumlah += $row->MT;
    $ratarata = $jumlah/17;
    
    $ratarata = (round($ratarata)=='0') ? ' ' : round($ratarata);//round berfungsi untuk pembulatan desimal, ceil desimal keatas, floor desimal kebawah 
    echo '<td width="5%" align="center">'.$ratarata.'</td>';//
    $i++;
    echo '</tr>';
}
?>
</table>
<br /><br />
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
        	<td align="center" style="border-bottom: 1px; text-decoration: underline;">Wiharwin</td>
        </tr>
    </table>
    </td>
    <td  width="20%">
    <table>
        <tr>
            <td align="center"><?php echo $sekolah->row()->kabupaten;?>, <?php $arraytgl = $this->app_model->tgl(); $pilihtgl = date('d'); $pilihbln = date('m');;$pilihth = date('y'); echo $pilihtgl ;echo ' - '; echo $pilihbln; echo ' - ';echo '20'; echo $pilihth;?></td>
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

<br /><br /><br /><br /><br /><br /><br /><br />
<table align="center" border="0" align="center%" width="80%" cellpadding="0">
<tr>
    <td align="center" height="5px" style="font-size: 9px;font: bold;" >Jl. Tebet Dalam IV No. 1 Jakarta 12810 - Indonesia</td>
</tr>
<tr>
    <td align="center" style="font-size: 9px; font: bold;" >Phone : (62-21) 831 3211, 830 9379, Fax : (62-21) 830 9373</td>
</tr>
<tr>
    <td align="center" style="font-size: 9px;font: bold;" >Website : Http://www.madinaschool.sch.id e-mail : info@madinaschool.sch.id</td>
</tr>
</table>
<div class="sembunyi">
    <a href="<?php echo base_url().'index.php/export/export_to_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>">Inport Pdf</a> |
</div>
</body>
</html>