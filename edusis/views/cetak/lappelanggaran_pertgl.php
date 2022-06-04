<html>
<head>
<title>Pelanggaran siswa</title>
<body>
<table style="width:95%;font-size: 11px;" align="center" border="0" >
    <tr>
        <td align="center" width="150px" rowspan="4" ><img src="edusis_asset/edusisimg/mafatih.jpg"/></td>
        <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $sekolah->row()->nama_sekolah ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>DAFTAR LAPORAN PELANGGARAN SISWA</b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
    </tr>
    
    <tr>
        <td align="left" colspan="2" >&nbsp;</td>
    </tr>
    <?php if($this->uri->segment(3)!='' && $this->uri->segment(4) != '' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '0') { ?>
    <tr>
        <?php $tgla = explode('-',$this->uri->segment(3)); $k=($tgla[0] == '0') ? ' ' : $tgla[0]; $l=($tgla[1] == '0') ? ' ' : $tgla[1];$m=($tgla[2] == '0') ? ' ' : $tgla[2]; ?>
        <?php $tglb = explode('-',$this->uri->segment(4)); $s=($tglb[0] == '0') ? ' ' : $tglb[0]; $t=($tglb[1] == '0') ? ' ' : $tglb[1];$u=($tglb[2] == '0') ? ' ' : $tglb[2]; ?>
        <td colspan="3"  style="width:10%; font-size: 11px;"><b>Periode&nbsp;:&nbsp;&nbsp;<?php echo $m.' '.$l.' '.$k?>&nbsp;S/d&nbsp;<?php echo $u.' '.$t.' '.$s?></b><br /></td>
    </tr>
    <?php } ?>
</table>
<br />
<table border="1"  align="center"  width="95%" style="border-collapse: collapse; font-size: 11px;" cellpadding="3px" >
    <tr style="background: #E1E1E1;">
        <th width="1%" height="25px">No.</th>
		<th width="8%">Tanggal</th>
		<th width="5%">No.Induk</th>
        <th width="15%">Nama</th>
        <th width="10%">Kelas</th>
		<th width="28%">Pelanggaran</th>
		<th width="8%">Kejadian</th>
		<th width="22%">Hukuman</th>
		<th width="3%">Poin</th>
    </tr>
    <?php
        $seq        = 1;
        $jmhdatapeserta = 0;
        foreach($pelanggaran_siswa->result() as $row)
        {
            $class = ($seq%2==0) ? ' class="bg" ' : '';
    ?>
    <tr<?php echo $class; ?>>
        <td align="center"><?php echo $seq; ?></td>
        <?php //$tgl = ($row->tgl == '' || $row->tgl == '0'|| $row->tgl == 'NULL') ? explode(' ','0 0 0') : explode(' ',$row->tgl);
        //$a=($tgl[0] == '0') ? ' ' : $tgl[0];
        //$b=($tgl[1] == '0') ? ' ' : $tgl[1];
        //$c=($tgl[2] == '0') ? ' ' : $tgl[2];
        echo '<td align="center">'.$row->tglpanjang.'</td>';?>
        <td align="center"><?php echo $row->nis;?></td>
        <td><?php echo $row->nama_lengkap; ?></td>
        <td><?php echo $row->kelas; ?></td>
        <td><?php echo $row->nm_pelanggaran; ?></td>
		<td><?php echo $row->kejadian; ?></td>
		<td><?php echo $row->hukuman; ?></td>
		<td align="center"><?php echo $row->point; ?></td>
    </tr>
    <?php $seq++; }?>
</table>
<br />
<table border="0"  align="center"  width="95%" style="font-size: 12px;"  >
    <tr>
        <td width="70%">&nbsp;</td>
        </td>
        <td>&nbsp;</td>
        <td width="25%" align="center">
        <table style="border: 1px; border-collapse: collapse; font-size: 13px;">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="left;"><?php echo $sekolah->row()->kabupaten;?>, <?php $pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo $pilihtgl ; echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
            </tr>
            <tr>
            	<td align="center" colspan="3"><b>Kepala Sekolah</b><br /><br /><br /></td>
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