<html>
<head>
<title>Pelanggaran siswa</title>
<body>
<br /><br /><br />
<table border="0" align="center"  width="90%" style=" font-size: 13px;">
    <tr>
    	<td width="22%">Nama Siswa</td>
    	<td width="1%">:</td>
        <td width="35%">&nbsp;&nbsp;<?php echo $datasiswa->row()->nama_lengkap;?></td>
    	<td width="20%">Kelas</td>
    	<td width="1%">:</td>
        <td width="21%">&nbsp;&nbsp;<?php echo str_replace('+',' ',$this->uri->segment(3));?></td>
    </tr>
    <tr>
    	<td>Nomor Induk / NISN</td>
    	<td>: </td>
        <td>&nbsp;&nbsp;<?php echo $datasiswa->row()->nis;?></td>
    	<td>Semester</td>
    	<td>: </td>
        <td>&nbsp;&nbsp;<?php echo ($this->session->userdata('kd_semester')==1) ? 'Ganjil' : 'Genap';?></td>
    </tr>
    <tr>
    	<td>Nama Madrasah</td>
    	<td>: </td>
        <td>&nbsp;&nbsp;<?php echo $sekolah->row()->nama_sekolah;?></td>
    	<td>Tahun Pelajaran</td>
    	<td>: </td>
        <td>&nbsp;&nbsp;<?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
    	<td>Alamat</td>
    	<td>: </td>
        <td>&nbsp;&nbsp;<?php echo $sekolah->row()->alamat_sekolah;?></td>
     </tr>
</table>
<table  align="center"  width="90%" >
    <tr>
        <td >&nbsp;</td>
    </tr>
</table>
<table border="1"  align="center"  width="90%" style="border-collapse: collapse; font-size: 12px;" cellpadding="3px" >
    <tr style="background: #E1E1E1;">
    	<th width="2%" height="25px">No.</th> 
    	<th width="15%">Tanggal</th>
    	<th width="40%">Jenis Pelanggaran</th>
    	<th width="10%">Tempat</th>
    	<th width="30%">Hukuman</th>
    	<th width="8%">Poin</th>
    </tr>
    <?php 
    $jumlah = 0;
    $i = 1;
    foreach($pelanggaran->result() as $row)
        {
            $bg = ($i%2==0) ? ' class="bg" ' : '';
            echo '<tr'.$bg.'>';
            echo '<td align="center">'.$i.'</td>';
            //$tgl = ($row->tgl == '' || $row->tgl == '0'|| $row->tgl == 'NULL') ? explode(' ','0 0 0') : explode(' ',$row->tgl);
            //$a=($tgl[0] == '0') ? ' ' : $tgl[0];
            //$b=($tgl[1] == '0') ? ' ' : $tgl[1];
            //$c=($tgl[2] == '0') ? ' ' : $tgl[2];
            echo '<td align="center">'.$row->tglpanjang.'</td>';
            echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.$row->nm_pelanggaran.'</td>';
            echo '<td>'.$row->kejadian.'</td>';
            echo '<td>'.$row->hukuman.'</td>';
            echo '<td align="center">'.$row->point.'</td>';
            $jumlah += $row->point;
            $i++;
            echo '</tr>';
        }
        if($jumlah>=300)
        {
            $ket='Dikembalikan pada orang tua';
        }
        elseif($jumlah>=250)
        {
            $ket='Skorsing';
        }
        elseif($jumlah>=200)
        {
            $ket='Panggilan Orang Tua / Wali Murid Untuk yang Kedua Kali';
        }
        elseif($jumlah>=150)
        {
            $ket='Panggilan Orang Tua / Wali Murid Untuk yang Pertama Kali';
        }
        else{$ket='';}
    ?>
    <tr>
        <td colspan="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah poin</td>
        <td align="center"><?php echo ($jumlah==0) ? '' : $jumlah; ?></td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keterangan</td>
        <td colspan="4"><span style="color:red;">&nbsp;&nbsp;&nbsp;<?php echo $ket; ?></span></td>
    </tr>
</table>
<br />
<table border="0"  align="center"  width="90%" style="font-size: 13px;"  >
    <tr>
        <td width="8%">&nbsp;</td>
        <td width="32%">
        <table style="border: 1px; border-collapse: collapse; font-size: 13px;">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
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
        <td  width="20%"  align="center">
        <table style="border: 1px; border-collapse: collapse; font-size: 13px;">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>Mengetahui,</b></td>
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
        <td>&nbsp;</td>
        <td width="30%" align="center">
        <table style="border: 1px; border-collapse: collapse; font-size: 13px;">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="left;"><?php echo $sekolah->row()->kabupaten;?>, <?php $pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo $pilihtgl ; echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
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
</body>
</html>