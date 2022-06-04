<html>
<head>
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" /><!-- WRITE YOUR CSS CODE HERE -->
<title>Raport Nilai Mulok</title>
<style>
	@media all {*{
		
	}
	}
</style>
<body>
<?php $kd_semester = $this->session->userdata('kd_semester'); ?>
<img style="width: 100px; position: absolute; border: none; z-index: -1; padding-left: 50px;" src="edusis_asset/edusisimg/sdit-almadinah.png"/>
<table align="center" border="0" width="50%" style="font-family: serif; font-weight: bold;">
    <tr>
        <td style="font-size: 0.8em; text-align: center;">YAYASAN PENDIDIKAN ISLAM AR-ROHMAN</td>
    </tr>
    <tr>
        <td style="font-size: 1.2 em; text-align: center;">
            <?php 
                if($kd_sekolah == "02")
                {
                    echo 'SD ISLAM TERPADU AL-MADINAH';
                }
                else
                {
                    echo 'SMP ISLAM TERPADU AL-MADINAH';
                }
            ?>
        </td>
    </tr>
    <tr>
        <td style="font-size: 1.2 em; text-align: center;">"TERAKREDITASI A"</td>
    </tr>
    <tr>
        <td style="font-size: 0.7em; text-align: center;"><?php echo $sekolah->row()->alamat_sekolah;?> <?php echo $data->row()->kelurahan; ?> <?php echo $data->row()->kecamatan; ?> <?php echo $data->row()->kabupaten; ?> <?php echo $data->row()->pos; ?></td>
    </tr>
    <tr>
        <td style="font-size: 0.7em; text-align: center;">Telp. <?php echo $data->row()->telp; ?>, Fax. <?php echo $data->row()->fax; ?></td>
    </tr>
</table>
<hr align="center" width="95%" /><br />
<table align="center" border="0" width="95%" style="font-size: 1.2em;">
    <tr>
        <td style="text-align: center; font-weight: bold;">LAPORAN HASIL NILAI BELAJAR PESERTA DIDIK</td>
    </tr>
    <tr>
        <td style="text-align: center; font-weight: bold; text-transform:uppercase;">AKHIR SEMESTER 
        <?php 
                if($kd_semester == "1")
                {
                    echo 'Ganjil';
                }
                else
                {
                    echo 'Genap';
                }
            ?></td>
    </tr>
    <tr>
        <td style="text-align: center; font-weight: bold;">MUATAN LOKAL (MULOK)</td>
    </tr>
</table>
<br />
<table align="center" border="0" width="95%" style=" font-size: 0.9em;">
    <tr>
    	<td width="25%">Nama Peserta Didik</td>
    	<td width="40%">: <?php echo $datasiswa->row()->nama_lengkap;?></td>
    	<td width="15%">Kelas</td>
    	<td width="20%">: <?php echo str_replace('+',' ',$this->uri->segment(3));?></td>
    </tr>
    <tr>
    	<td>Nomor Induk / NISN</td>
    	<td>: <?php echo $datasiswa->row()->nis;?></td>
    	<td>Semester</td>
    	<td>: 
         <?php 
                if($kd_semester == "1")
                {
                    echo 'Ganjil';
                }
                else
                {
                    echo 'Genap';
                }
            ?>
        <?php // echo $this->session->userdata('kd_semester');?></td>
    </tr>
    <tr>
    	<td>Nama Sekolah</td>
    	<td>: <?php echo $sekolah->row()->nama_sekolah;?></td>
    	<td>Tahun Ajaran</td>
    	<td>: <?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
    	<td style="mar">Alamat Sekolah</td>
    	<td>: <?php echo $sekolah->row()->alamat_sekolah;?> <?php echo $data->row()->kelurahan; ?> <?php echo $data->row()->kecamatan; ?> - <?php echo $data->row()->kabupaten; ?> <?php echo $data->row()->pos; ?></td>
    </tr>
</table>
<br />
<table style=" border-collapse:collapse; font-size: 0.9em; " align="center" border="1" width="95%" cellpadding="0">
		<thead>
		<tr>
        	<th height="50px;" width="4%">NO</th>
            <th width="40%">MATA PELAJARAN</th>
            <th width="10%">NILAI</th>
            <th width="40%">HURUF</th>
        </tr>
		</thead>
        <?php 
        $i = 1;
        $jmlkgn = 0;
        foreach($hasilbelajar->result() as $row)
        {
            $bg = ($i%2==0) ? ' class="bg" ' : '';
            echo '<tr'.$bg.'>';
            echo '<td height="28px;"><center>'.$i.'</center></td>';
            echo '<td>&nbsp;&nbsp;'.$row->nm_mp.'</td>';
            
            $kgn    = ($row->kgn=='0') ? '0' : $row->kgn;
            echo '<td><center>'.$row->kgn.'</center></td>';
            $jmlkgn += $row->kgn;
			if ($kgn=='') 
			{
				echo '<td>&nbsp;</td>';
			}
			else
			{
				echo '<td><center>'.$this->terbilang->rp_terbilang($kgn,0).'</center></td>';
            }
            $i++;
            echo '</tr>';
        }
        ?>
</table>
<br /><br />
<table style="font-size: 0.9em;"align="center" border="0" width="95%" >
<tr>
    <td width="30%">
    <table>
        <tr>
            <td align="left"><?php echo $sekolah->row()->kabupaten;?>, 20 Desember 2014 <?php // echo $pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
        	<td align="left">Kepala Sekolah<br /><br /><br /><br /><br /></td>
        </tr>
        <tr>
            <td align="left">(<?php echo $kepsek->row()->nama_lengkap; ?>)</td>
        </tr>
    </table>
    </td>
</tr>
</table>
</body>
</html>