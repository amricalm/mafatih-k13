<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Bimbingan & Konseling persiswa</title>
    </head>
    <body>
    <table align="center" border="0" width="100%" style=" font-size: 0.9em;">
        <tr>
            <td align="center" width="150px" rowspan="4" ><img src="edusis_asset/edusisimg/mafatih.jpg"/></td>
            <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $sekolah->row()->nama_sekolah ?></b></td>
        </tr>
        <tr>
            <td align="left" colspan="2"><b>DAFTAR LAPORAN KONSELING SISWA</b></td>
        </tr>
        <tr>
            <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
        </tr>
        
        <tr>
            <td align="left" colspan="2" >&nbsp;</td>
        </tr>
        <tr>
        	<td width="25%">Nama Siswa</td>
        	<td width="40%px">: <?php echo $datasiswa->row()->nama_lengkap;?></td>
        	<td width="8%">Kelas</td>
        	<td width="27%">: <?php echo str_replace('+',' ',$this->uri->segment(3))?></td>
        </tr>
        <tr>
        	<td>Nomor Induk</td>
        	<td>: <?php echo $datasiswa->row()->nis;?></td>
        	<td>Semester</td>
        	<td>: <?php $f = ($this->session->userdata('kd_semester')==1) ? '( Ganjil )' : '( Genap )'; echo $f;?></td>
        </tr>
        <tr>
        	<td colspan="4">&nbsp;</td>
        </tr>
    </table>
        <br/>
    <table style=" border-collapse:collapse; font-size: 0.9em; " align="center" border="1" width="100%" cellpadding="0">
        <tr style="background: #E1E1E1;" >
        	<th width="2%" height="25px">No</th>
			<th width="10%">Tanggal</th>
			<th width="44%">Konseling Siswa</th>
			<th width="44%">Solusi Guru BK</th>
        </tr>
        <?php
            $seq        = 1;
            $jmhdatapeserta = 0;
            foreach($konseling->result() as $row)
            {
                $class = ($seq%2==0) ? ' class="bg" ' : '';
        ?>
        <tr<?php echo $class; ?>>
            <td align="center"><?php echo $seq ?></td>
            <?php //$tgl = ($row->tgl == '' || $row->tgl == '0'|| $row->tgl == 'NULL') ? explode(' ','0 0 0') : explode(' ',$row->tgl);
            //$a=($tgl[0] == '0') ? ' ' : $tgl[0];
            //$b=($tgl[1] == '0') ? ' ' : $tgl[1];
            //$c=($tgl[2] == '0') ? ' ' : $tgl[2]; ?>
            <td align="center"><?php echo $row->tglpanjang ?></td>
            <td>&nbsp;<?php echo $row->masalah; ?></td>
			<td>&nbsp;<?php echo $row->solusi; ?></td>
        </tr>
        <?php $seq++; }?>
	</table>
		<br/>
		<table style="width: 100%; solid #000" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="95%" align="right">Petugas</td>
			<td width="5%"></td>
		</tr>
		</table>
    </body>
</html>