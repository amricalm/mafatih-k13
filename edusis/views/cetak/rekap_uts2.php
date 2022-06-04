<html>
<head>
    <title>REKAP LEDGER</title>
    <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" />
    <link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" />
</head>
<style>
@font-face {
  font-family: Arial;
  src: url(<?php echo base_url() ?>/edusis_asset/fonts/arial.ttf);
}
  * {
    font-family: Arial, sans-serif;
  }
	@media all {*{


	}
	}
  @page { margin: 15px 10px; } body { margin: 15px 10px; }
</style>
<body>
<?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS';?>
<table style="width: 40%;font-size: 11px;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" rowspan="4" ><img src="edusis_asset/edusisimg/logo.jpg" style="width: 60px;"/></td>
        <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $sekolah->row()->nama_sekolah ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>DAFTAR REKAP NILAI <?php echo $q ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
    </tr>

    <tr>
        <td align="left" colspan="2" >&nbsp;</td>
    </tr>
</table>
<br /><br />
<table width="10%">
    <tr>
        <td style="font-size: 11px;">Kelas</td>
        <td style="font-size: 11px;">:</td>
        <td style="font-size: 11px;"><?php echo str_replace('+',' ',$this->uri->segment(3)); ?></td>
    </tr>
    <tr>
        <td style="font-size: 11px;">Nilai</td>
        <td style="font-size: 11px;">:</td>
        <td style="font-size: 11px;">Pengetahuan</td>
    </tr>
</table>
<table style=" border-collapse:collapse; size: landscape; font-size: 10px;"  width="100%" align="center" border="1" align="center%" cellpadding="0">

        <tr>
            <th style="width:1.5%; ">NO</th>
            <th style="width:5%">NO.INDUK</th>
            <th style="width:13%">NAMA SISWA</th>
            <?php
                $this->load->helper('adn_text_helper');
                $seq = 1;
                foreach($mp->result() as $row)
                {
                    echo '<th width="4%">'.$row->kd_mp.'</th>';
                    $seq++;
                }
                echo '<th>Jumlah</th>';
                echo '<th>Rata-rata</th>';
            ?>
        </tr>
            <?php
            $seq    = 1;
//            $nama   = $this->siswa_model->nama(str_replace('+',' ',$this->uri->segment(3)));
//            $nilai      = array();

            foreach($nilai as $isi)
                {
                $bg = ($seq%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$seq.'</td>';
                echo '<td align="center">'.$isi['nis'].'</td>';
                echo '<td>&nbsp;&nbsp;'.$isi['nm'].'</td>';
//                $j = 0;
//                $jmlnr[$seq]                  = 0;
                 $j = 0;
                 $nilai_rataan           = 0;
                    foreach($mp->result() as $rowmp)
                    {
                        echo '<td align="center">'.round($isi['mp'][$j]['tgh']['NA']).'</td>';
                        $nilai_rataan = $nilai_rataan + $isi['mp'][$j]['tgh']['NA'];
                        $j++;
                    }
                    $m = ($j!=0) ? $nilai_rataan/$j : '';
                    echo '<td align="center">'.$nilai_rataan.'</td>';
                    echo '<td align="center">'.round($m).'</td>';
                    echo '</tr>';
                    $seq++;
               }
            ?>
</table>
<br />
<table style="font-size: 11px;" align="center" border="0" width="100%" >
<tr>
    <td width="2%">&nbsp;</td>
    <td width="78%">
    <table style="font-size: 11px;">
        <tr>
            <td align="left">Mengetahui,</td>
        </tr>
        <tr>
        	<td align="left"><b>Kepala <?php echo $sekolah->row()->nama_sekolah ?></b><br /><br /><br /><br /><br /></td>
        </tr>
        <tr>
        	<td align="left"><u><?php echo $kepsek->row()->nama_lengkap;?></u></td>
        </tr>
        <tr>
        	<td align="left">NIP. <?php echo $kepsek->row()->nip; ?></td>
        </tr>
    </table>
    </td>
    <td width="20%">
    <table style="font-size: 11px;">
        <tr>
            <td align="left"><?php echo $sekolah->row()->kabupaten;?>, <?php $arraytgl = $this->app_model->tgl(); $pilihtgl = date('d'); $pilihbln = date('m');;$pilihth = date('y'); echo $pilihtgl ;echo ' - '; echo $pilihbln; echo ' - ';echo '20'; echo $pilihth;?></td>
        </tr>
        <tr>
        	<td align="left"><b>Wali Kelas</b><br /><br /><br /><br /><br /></td>
        </tr>
        <tr>
        	<td align="left"><u><?php foreach ($walikelas as $key => $value) {echo $value->nama_lengkap;} ?></u></td>
        </tr>
        <tr>
        	<td align="left">NIP.<?php foreach ($walikelas as $key => $value) {echo $value->wali_kelas;} ?></td>
        </tr>
    </table>
    </td>
</tr>
</table>
<table style="page-break-before: always;"></table>
<table style="width: 40%;font-size: 11px;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" rowspan="4" ><img src="edusis_asset/edusisimg/logo.jpg" style="width: 60px;"/></td>
        <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $sekolah->row()->nama_sekolah ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>DAFTAR REKAP NILAI <?php echo $q ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
    </tr>

    <tr>
        <td align="left" colspan="2" >&nbsp;</td>
    </tr>
</table>
<br /><br />
<table width="10%">
    <tr>
        <td style="font-size: 11px;">Kelas</td>
        <td style="font-size: 11px;">:</td>
        <td style="font-size: 11px;"><?php echo str_replace('+',' ',$this->uri->segment(3)); ?></td>
    </tr>
    <tr>
        <td style="font-size: 11px;">Nilai</td>
        <td style="font-size: 11px;">:</td>
        <td style="font-size: 11px;">Keterampilan</td>
    </tr>
</table>
<table style=" border-collapse:collapse; size: landscape; font-size: 10px;"  width="100%" align="center" border="1" align="center%" cellpadding="0">

        <tr>
            <th style="width:1.5%; ">NO</th>
            <th style="width:5%">NO.INDUK</th>
            <th style="width:13%">NAMA SISWA</th>
            <?php
                $this->load->helper('adn_text_helper');
                $seq = 1;
                foreach($mp->result() as $row)
                {
                    echo '<th width="4%">'.$row->kd_mp.'</th>';
                    $seq++;
                }
                echo '<th>Jumlah</th>';
                echo '<th>Rata-rata</th>';
            ?>
        </tr>
            <?php
            $seq    = 1;
//            $nama   = $this->siswa_model->nama(str_replace('+',' ',$this->uri->segment(3)));
//            $nilai      = array();

            foreach($nilai as $isi)
                {
                $bg = ($seq%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$seq.'</td>';
                echo '<td align="center">'.$isi['nis'].'</td>';
                echo '<td>&nbsp;&nbsp;'.$isi['nm'].'</td>';
//                $j = 0;
//                $jmlnr[$seq]                  = 0;
                 $j = 0;
                 $nilai_rataan           = 0;
                    foreach($mp->result() as $rowmp)
                    {
                        echo '<td align="center">'.round($isi['mp'][$j]['tgh']['NA_PSK']).'</td>';
                        $nilai_rataan = $nilai_rataan + $isi['mp'][$j]['tgh']['NA_PSK'];
                        $j++;
                    }
                    $m = ($j!=0) ? $nilai_rataan/$j : '';
                    echo '<td align="center">'.$nilai_rataan.'</td>';
                    echo '<td align="center">'.round($m).'</td>';
                    echo '</tr>';
                    $seq++;
               }
            ?>
</table>
<br />
<table style="font-size: 11px;" align="center" border="0" width="100%" >
<tr>
    <td width="2%">&nbsp;</td>
    <td width="78%">
    <table style="font-size: 11px;">
        <tr>
            <td align="left">Mengetahui,</td>
        </tr>
        <tr>
        	<td align="left"><b>Kepala <?php echo $sekolah->row()->nama_sekolah ?></b><br /><br /><br /><br /><br /></td>
        </tr>
        <tr>
        	<td align="left"><u><?php echo $kepsek->row()->nama_lengkap;?></u></td>
        </tr>
        <tr>
        	<td align="left">NIP. <?php echo $kepsek->row()->nip; ?></td>
        </tr>
    </table>
    </td>
    <td width="20%">
    <table style="font-size: 11px;">
        <tr>
            <td align="left"><?php echo $sekolah->row()->kabupaten;?>, <?php $arraytgl = $this->app_model->tgl(); $pilihtgl = date('d'); $pilihbln = date('m');;$pilihth = date('y'); echo $pilihtgl ;echo ' - '; echo $pilihbln; echo ' - ';echo '20'; echo $pilihth;?></td>
        </tr>
        <tr>
        	<td align="left"><b>Wali Kelas</b><br /><br /><br /><br /><br /></td>
        </tr>
        <tr>
        	<td align="left"><u><?php foreach ($walikelas as $key => $value) {echo $value->nama_lengkap;} ?></u></td>
        </tr>
        <tr>
        	<td align="left">NIP.<?php foreach ($walikelas as $key => $value) {echo $value->wali_kelas;} ?></td>
        </tr>
    </table>
    </td>
</tr>
</table>



</body>
</html>
