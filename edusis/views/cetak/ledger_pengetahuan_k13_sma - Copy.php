<style>
* {
  font-family: Arial, sans-serif;
}
@page {
  margin: 10px 50px 5px;
}
</style>
<!--------------------------------------------KD1-------------------------------------------------->
<table style="width:100%">
  <tr>
    <td rowspan="4"><img style="width:50px;" src="D:\EDUSIS\App\Prestasi\WebPrestasiSmaKurtilas1617\edusis_asset\edusisimg\logo.jpg" /></td>
    <td colspan="2" style="text-align:center;font-size:0.8em/1.5;text-align:center;font-weight:bold;">LEMBAR HASIL BELAJAR SISWA TAHUN PELAJARAN <?php echo $th_ajar; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;font-size:0.8em/1.5;text-align:center;">Mata Pelajaran : <?php echo $mp->row()->nm_mp; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;width:70%;">KD : 1</td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Kelas : <?php echo $kelas; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Semester : <?php echo $p_nl; ?></td>
    <?php
    foreach ($kkm->result() as $value) { ?>
      <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">KKM : <?php echo $value->skbm ?></td>
      <?php break; } ?>
  </tr>
</table>
<table style="border-collapse:collapse;width:100%;text-align:center;">
  <thead>
    <tr>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NO</td>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;width:30%;">Nama Siswa</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="14" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } else { ?>
        <td colspan="8" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } ?>
    </tr>
    <tr>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">UH</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NH</td>
    </tr>
    <tr>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH6</td>
      <?php } ?>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH6</td>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $i  = 1;
    $brs = '';
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
      foreach($hasilbelajar as $row)
      {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        $brs .= '<tr '.$bg.'>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$i.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
        //==============================================Start UHT=========================================//
        $uht1Kd1Uts = $row->kd1_uht1_uts;
        $uht2Kd1Uts = $row->kd1_uht2_uts;
        $uht3Kd1Uts = $row->kd1_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1Kd1 = $row->kd1_uht1;
          $uht2Kd1 = $row->kd1_uht2;
          $uht3Kd1 = $row->kd1_uht3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1Kd1Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2Kd1Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3Kd1Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1Kd1.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2Kd1.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3Kd1.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $uhtMax = max($uht1Kd1, $uht2Kd1, $uht3Kd1, $uht1Kd1Uts, $uht2Kd1Uts, $uht3Kd1Uts);
        }
        else {
          $uhtMax = max($uht1Kd1Uts, $uht2Kd1Uts, $uht3Kd1Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uhtMax.'</td>';
        //==============================================Start UHT=========================================//
        //==============================================Start tgs=========================================//
        $tgs1Kd1Uts = $row->kd1_tgs1_uts;
        $tgs2Kd1Uts = $row->kd1_tgs2_uts;
        $tgs3Kd1Uts = $row->kd1_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1Kd1 = $row->kd1_tgs1;
          $tgs2Kd1 = $row->kd1_tgs2;
          $tgs3Kd1 = $row->kd1_tgs3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1Kd1Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2Kd1Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3Kd1Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1Kd1.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2Kd1.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3Kd1.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $tgsMax = max($tgs1Kd1, $tgs2Kd1, $tgs3Kd1, $tgs1Kd1Uts, $tgs2Kd1Uts, $tgs3Kd1Uts);
        }
        else {
          $tgsMax = max($tgs1Kd1Uts, $tgs2Kd1Uts, $tgs3Kd1Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgsMax.'</td>';
        //==============================================End tgs=========================================//
        $kd1Jml = $uhtMax + $tgsMax;
        $kd1Dvd1 = ($uhtMax == 0 || $uhtMax == '0' || $uhtMax == '') ? 0 : 1;
        $kd1Dvd2 = ($tgsMax == 0 || $tgsMax == '0' || $tgsMax == '') ? 0 : 1;
        $kd1Dvd = $kd1Dvd1 + $kd1Dvd2;
        $kd1Rt = ($kd1Dvd == 0 || $kd1Dvd == '0' || $kd1Dvd == '') ? 0 : $kd1Jml / $kd1Dvd;
        $brs .= '</tr>';
        $i++;
      }
    }
    echo $brs;
    ?>
  </tbody>
</table>
<?php if ($i<21) {?>
    <table style="width:100%;margin-left:300px;margin-top:10px;">
<?php } else { ?>
  <table style="width:100%;margin-left:300px;page-break-before:always;">
<?php } ?>
  <?php
  $dlmtStr = explode('-', $tgl_lhb);
  switch ($dlmtStr[1]) {
    case 1:
    $bln = 'Januari';
    break;
    case 2:
    $bln = 'Februari';
    break;
    case 3:
    $bln = 'Maret';
    break;
    case 4:
    $bln = 'April';
    break;
    case 5:
    $bln = 'Mei';
    break;
    case 6:
    $bln = 'Juni';
    break;
    case 7:
    $bln = 'Juli';
    break;
    case 8:
    $bln = 'Agustus';
    break;
    case 9:
    $bln = 'September';
    break;
    case 10:
    $bln = 'Oktober';
    break;
    case 11:
    $bln = 'November';
    break;
    case 12:
    $bln = 'Desember';
    break;
  }
  ?>
  <tr>
    <td style='font-size:0.8em/1.5'>Mengetahui,<br />Kepala Sekolah</td>
    <td style='font-size:0.8em/1.5'>Kab. Bogor, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?><br />Guru Mata Pelajaran</td>
  </tr>
  <tr>
    <td style='height:100px;font-size:0.8em/1.5'><?php echo $kepsek->row()->nama_lengkap;?></td>
    <td style='font-size:0.8em/1.5'>
      <?php
      foreach($kkm->result() as $row)
      {
      echo $row->nama_lengkap;
      break;
      }
      ?>
  </td>
  </tr>
</table>
<!--------------------------------------------KD1-------------------------------------------------->
<!--------------------------------------------KD2-------------------------------------------------->
<table style="width:100%;page-break-before:always;">
  <tr>
    <td rowspan="4"><img style="width:50px;" src="D:\EDUSIS\App\Prestasi\WebPrestasiSmaKurtilas1617\edusis_asset\edusisimg\logo.jpg" /></td>
    <td colspan="2" style="text-align:center;font-size:0.8em/1.5;text-align:center;font-weight:bold;">LEMBAR HASIL BELAJAR SISWA TAHUN PELAJARAN <?php echo $th_ajar; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;font-size:0.8em/1.5;text-align:center;">Mata Pelajaran : <?php echo $mp->row()->nm_mp; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;width:70%;">KD : 2</td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Kelas : <?php echo $kelas; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Semester : <?php echo $p_nl; ?></td>
    <?php
    foreach ($kkm->result() as $value) { ?>
      <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">KKM : <?php echo $value->skbm ?></td>
      <?php break; } ?>
  </tr>
</table>
<table style="border-collapse:collapse;width:100%;text-align:center;">
  <thead>
    <tr>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NO</td>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;width:30%;">Nama Siswa</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="14" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } else { ?>
        <td colspan="8" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } ?>
    </tr>
    <tr>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">UH</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NH</td>
    </tr>
    <tr>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH6</td>
      <?php } ?>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH6</td>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $i  = 1;
    $brs = '';
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
      foreach($hasilbelajar as $row)
      {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        $brs .= '<tr '.$bg.'>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$i.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
        //==============================================Start UHT=========================================//
        $uht1kd2Uts = $row->kd2_uht1_uts;
        $uht2kd2Uts = $row->kd2_uht2_uts;
        $uht3kd2Uts = $row->kd2_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd2 = $row->kd2_uht1;
          $uht2kd2 = $row->kd2_uht2;
          $uht3kd2 = $row->kd2_uht3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd2Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd2Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd2Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd2.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd2.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd2.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $uhtMax = max($uht1kd2, $uht2kd2, $uht3kd2, $uht1kd2Uts, $uht2kd2Uts, $uht3kd2Uts);
        }
        else {
          $uhtMax = max($uht1kd2Uts, $uht2kd2Uts, $uht3kd2Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uhtMax.'</td>';
        //==============================================Start UHT=========================================//
        //==============================================Start tgs=========================================//
        $tgs1kd2Uts = $row->kd2_tgs1_uts;
        $tgs2kd2Uts = $row->kd2_tgs2_uts;
        $tgs3kd2Uts = $row->kd2_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd2 = $row->kd2_tgs1;
          $tgs2kd2 = $row->kd2_tgs2;
          $tgs3kd2 = $row->kd2_tgs3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd2Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd2Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd2Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd2.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd2.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd2.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $tgsMax = max($tgs1kd2, $tgs2kd2, $tgs3kd2, $tgs1kd2Uts, $tgs2kd2Uts, $tgs3kd2Uts);
        }
        else {
          $tgsMax = max($tgs1kd2Uts, $tgs2kd2Uts, $tgs3kd2Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgsMax.'</td>';
        //==============================================End tgs=========================================//
        $brs .= '</tr>';
        $i++;
      }
    }
    echo $brs;
    ?>
  </tbody>
</table>
<?php if ($i<21) {?>
    <table style="width:100%;margin-left:300px;margin-top:10px;">
<?php } else { ?>
  <table style="width:100%;margin-left:300px;page-break-before:always;">
<?php } ?>
  <?php
  $dlmtStr = explode('-', $tgl_lhb);
  switch ($dlmtStr[1]) {
    case 1:
    $bln = 'Januari';
    break;
    case 2:
    $bln = 'Februari';
    break;
    case 3:
    $bln = 'Maret';
    break;
    case 4:
    $bln = 'April';
    break;
    case 5:
    $bln = 'Mei';
    break;
    case 6:
    $bln = 'Juni';
    break;
    case 7:
    $bln = 'Juli';
    break;
    case 8:
    $bln = 'Agustus';
    break;
    case 9:
    $bln = 'September';
    break;
    case 10:
    $bln = 'Oktober';
    break;
    case 11:
    $bln = 'November';
    break;
    case 12:
    $bln = 'Desember';
    break;
  }
  ?>
  <tr>
    <td style='font-size:0.8em/1.5'>Mengetahui,<br />Kepala Sekolah</td>
    <td style='font-size:0.8em/1.5'>Kab. Bogor, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?><br />Guru Mata Pelajaran</td>
  </tr>
  <tr>
    <td style='height:100px;font-size:0.8em/1.5'><?php echo $kepsek->row()->nama_lengkap;?></td>
    <td style='font-size:0.8em/1.5'>
      <?php
      foreach($kkm->result() as $row)
      {
      echo $row->nama_lengkap;
      break;
      }
      ?>
  </td>
  </tr>
</table>
<!--------------------------------------------KD2-------------------------------------------------->
<!--------------------------------------------KD3-------------------------------------------------->
<table style="width:100%;page-break-before:always;">
  <tr>
    <td rowspan="4"><img style="width:50px;" src="D:\EDUSIS\App\Prestasi\WebPrestasiSmaKurtilas1617\edusis_asset\edusisimg\logo.jpg" /></td>
    <td colspan="2" style="text-align:center;font-size:0.8em/1.5;text-align:center;font-weight:bold;">LEMBAR HASIL BELAJAR SISWA TAHUN PELAJARAN <?php echo $th_ajar; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;font-size:0.8em/1.5;text-align:center;">Mata Pelajaran : <?php echo $mp->row()->nm_mp; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;width:70%;">KD : 3</td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Kelas : <?php echo $kelas; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Semester : <?php echo $p_nl; ?></td>
    <?php
    foreach ($kkm->result() as $value) { ?>
      <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">KKM : <?php echo $value->skbm ?></td>
      <?php break; } ?>
  </tr>
</table>
<table style="border-collapse:collapse;width:100%;text-align:center;">
  <thead>
    <tr>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NO</td>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;width:30%;">Nama Siswa</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="14" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } else { ?>
        <td colspan="8" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } ?>
    </tr>
    <tr>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">UH</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NH</td>
    </tr>
    <tr>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH6</td>
      <?php } ?>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH6</td>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $i  = 1;
    $brs = '';
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
      foreach($hasilbelajar as $row)
      {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        $brs .= '<tr '.$bg.'>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$i.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
        //==============================================Start UHT=========================================//
        $uht1kd3Uts = $row->kd3_uht1_uts;
        $uht2kd3Uts = $row->kd3_uht2_uts;
        $uht3kd3Uts = $row->kd3_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd3 = $row->kd3_uht1;
          $uht2kd3 = $row->kd3_uht2;
          $uht3kd3 = $row->kd3_uht3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd3Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd3Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd3Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd3.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd3.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd3.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $uhtMax = max($uht1kd3, $uht2kd3, $uht3kd3, $uht1kd3Uts, $uht2kd3Uts, $uht3kd3Uts);
        }
        else {
          $uhtMax = max($uht1kd3Uts, $uht2kd3Uts, $uht3kd3Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uhtMax.'</td>';
        //==============================================Start UHT=========================================//
        //==============================================Start tgs=========================================//
        $tgs1kd3Uts = $row->kd3_tgs1_uts;
        $tgs2kd3Uts = $row->kd3_tgs2_uts;
        $tgs3kd3Uts = $row->kd3_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd3 = $row->kd3_tgs1;
          $tgs2kd3 = $row->kd3_tgs2;
          $tgs3kd3 = $row->kd3_tgs3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd3Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd3Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd3Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd3.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd3.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd3.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $tgsMax = max($tgs1kd3, $tgs2kd3, $tgs3kd3, $tgs1kd3Uts, $tgs2kd3Uts, $tgs3kd3Uts);
        }
        else {
          $tgsMax = max($tgs1kd3Uts, $tgs2kd3Uts, $tgs3kd3Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgsMax.'</td>';
        //==============================================End tgs=========================================//
        $brs .= '</tr>';
        $i++;
      }
    }
    echo $brs;
    ?>
  </tbody>
</table>
<?php if ($i<21) {?>
    <table style="width:100%;margin-left:300px;margin-top:10px;">
<?php } else { ?>
  <table style="width:100%;margin-left:300px;page-break-before:always;">
<?php } ?>
  <?php
  $dlmtStr = explode('-', $tgl_lhb);
  switch ($dlmtStr[1]) {
    case 1:
    $bln = 'Januari';
    break;
    case 2:
    $bln = 'Februari';
    break;
    case 3:
    $bln = 'Maret';
    break;
    case 4:
    $bln = 'April';
    break;
    case 5:
    $bln = 'Mei';
    break;
    case 6:
    $bln = 'Juni';
    break;
    case 7:
    $bln = 'Juli';
    break;
    case 8:
    $bln = 'Agustus';
    break;
    case 9:
    $bln = 'September';
    break;
    case 10:
    $bln = 'Oktober';
    break;
    case 11:
    $bln = 'November';
    break;
    case 12:
    $bln = 'Desember';
    break;
  }
  ?>
  <tr>
    <td style='font-size:0.8em/1.5'>Mengetahui,<br />Kepala Sekolah</td>
    <td style='font-size:0.8em/1.5'>Kab. Bogor, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?><br />Guru Mata Pelajaran</td>
  </tr>
  <tr>
    <td style='height:100px;font-size:0.8em/1.5'><?php echo $kepsek->row()->nama_lengkap;?></td>
    <td style='font-size:0.8em/1.5'>
      <?php
      foreach($kkm->result() as $row)
      {
      echo $row->nama_lengkap;
      break;
      }
      ?>
  </td>
  </tr>
</table>
<!--------------------------------------------KD3-------------------------------------------------->
<!--------------------------------------------KD4-------------------------------------------------->
<table style="width:100%;page-break-before:always;">
  <tr>
    <td rowspan="4"><img style="width:50px;" src="D:\EDUSIS\App\Prestasi\WebPrestasiSmaKurtilas1617\edusis_asset\edusisimg\logo.jpg" /></td>
    <td colspan="2" style="text-align:center;font-size:0.8em/1.5;text-align:center;font-weight:bold;">LEMBAR HASIL BELAJAR SISWA TAHUN PELAJARAN <?php echo $th_ajar; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;font-size:0.8em/1.5;text-align:center;">Mata Pelajaran : <?php echo $mp->row()->nm_mp; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;width:70%;">KD : 4</td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Kelas : <?php echo $kelas; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Semester : <?php echo $p_nl; ?></td>
    <?php
    foreach ($kkm->result() as $value) { ?>
      <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">KKM : <?php echo $value->skbm ?></td>
      <?php break; } ?>
  </tr>
</table>
<table style="border-collapse:collapse;width:100%;text-align:center;">
  <thead>
    <tr>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NO</td>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;width:30%;">Nama Siswa</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="14" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } else { ?>
        <td colspan="8" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } ?>
    </tr>
    <tr>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">UH</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NH</td>
    </tr>
    <tr>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH6</td>
      <?php } ?>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH6</td>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $i  = 1;
    $brs = '';
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
      foreach($hasilbelajar as $row)
      {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        $brs .= '<tr '.$bg.'>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$i.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
        //==============================================Start UHT=========================================//
        $uht1kd4Uts = $row->kd4_uht1_uts;
        $uht2kd4Uts = $row->kd4_uht2_uts;
        $uht3kd4Uts = $row->kd4_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd4 = $row->kd4_uht1;
          $uht2kd4 = $row->kd4_uht2;
          $uht3kd4 = $row->kd4_uht3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd4Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd4Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd4Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd4.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd4.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd4.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $uhtMax = max($uht1kd4, $uht2kd4, $uht3kd4, $uht1kd4Uts, $uht2kd4Uts, $uht3kd4Uts);
        }
        else {
          $uhtMax = max($uht1kd4Uts, $uht2kd4Uts, $uht3kd4Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uhtMax.'</td>';
        //==============================================Start UHT=========================================//
        //==============================================Start tgs=========================================//
        $tgs1kd4Uts = $row->kd4_tgs1_uts;
        $tgs2kd4Uts = $row->kd4_tgs2_uts;
        $tgs3kd4Uts = $row->kd4_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd4 = $row->kd4_tgs1;
          $tgs2kd4 = $row->kd4_tgs2;
          $tgs3kd4 = $row->kd4_tgs3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd4Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd4Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd4Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd4.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd4.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd4.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $tgsMax = max($tgs1kd4, $tgs2kd4, $tgs3kd4, $tgs1kd4Uts, $tgs2kd4Uts, $tgs3kd4Uts);
        }
        else {
          $tgsMax = max($tgs1kd4Uts, $tgs2kd4Uts, $tgs3kd4Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgsMax.'</td>';
        //==============================================End tgs=========================================//
        $brs .= '</tr>';
        $i++;
      }
    }
    echo $brs;
    ?>
  </tbody>
</table>
<?php if ($i<21) {?>
    <table style="width:100%;margin-left:300px;margin-top:10px;">
<?php } else { ?>
  <table style="width:100%;margin-left:300px;page-break-before:always;">
<?php } ?>
  <?php
  $dlmtStr = explode('-', $tgl_lhb);
  switch ($dlmtStr[1]) {
    case 1:
    $bln = 'Januari';
    break;
    case 2:
    $bln = 'Februari';
    break;
    case 3:
    $bln = 'Maret';
    break;
    case 4:
    $bln = 'April';
    break;
    case 5:
    $bln = 'Mei';
    break;
    case 6:
    $bln = 'Juni';
    break;
    case 7:
    $bln = 'Juli';
    break;
    case 8:
    $bln = 'Agustus';
    break;
    case 9:
    $bln = 'September';
    break;
    case 10:
    $bln = 'Oktober';
    break;
    case 11:
    $bln = 'November';
    break;
    case 12:
    $bln = 'Desember';
    break;
  }
  ?>
  <tr>
    <td style='font-size:0.8em/1.5'>Mengetahui,<br />Kepala Sekolah</td>
    <td style='font-size:0.8em/1.5'>Kab. Bogor, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?><br />Guru Mata Pelajaran</td>
  </tr>
  <tr>
    <td style='height:100px;font-size:0.8em/1.5'><?php echo $kepsek->row()->nama_lengkap;?></td>
    <td style='font-size:0.8em/1.5'>
      <?php
      foreach($kkm->result() as $row)
      {
      echo $row->nama_lengkap;
      break;
      }
      ?>
  </td>
  </tr>
</table>
<!--------------------------------------------KD4-------------------------------------------------->
<!--------------------------------------------KD5-------------------------------------------------->
<table style="width:100%;page-break-before:always;">
  <tr>
    <td rowspan="4"><img style="width:50px;" src="D:\EDUSIS\App\Prestasi\WebPrestasiSmaKurtilas1617\edusis_asset\edusisimg\logo.jpg" /></td>
    <td colspan="2" style="text-align:center;font-size:0.8em/1.5;text-align:center;font-weight:bold;">LEMBAR HASIL BELAJAR SISWA TAHUN PELAJARAN <?php echo $th_ajar; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;font-size:0.8em/1.5;text-align:center;">Mata Pelajaran : <?php echo $mp->row()->nm_mp; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;width:70%;">KD : 5</td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Kelas : <?php echo $kelas; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Semester : <?php echo $p_nl; ?></td>
    <?php
    foreach ($kkm->result() as $value) { ?>
      <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">KKM : <?php echo $value->skbm ?></td>
      <?php break; } ?>
  </tr>
</table>
<table style="border-collapse:collapse;width:100%;text-align:center;">
  <thead>
    <tr>
      <td rowspan="3" style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NO</td>
      <td rowspan="3" style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;width:30%;">Nama Siswa</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="14" style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } else { ?>
        <td colspan="8" style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } ?>
    </tr>
    <tr>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">UH</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NH</td>
    </tr>
    <tr>
      <td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">UH1</td>
      <td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">UH2</td>
      <td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">UH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">UH4</td>
        <td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">UH5</td>
        <td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">UH6</td>
      <?php } ?>
      <td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">NH1</td>
      <td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">NH2</td>
      <td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">NH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">NH4</td>
        <td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">NH5</td>
        <td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border:1px solid black;">NH6</td>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $i  = 1;
    $brs = '';
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
      foreach($hasilbelajar as $row)
      {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        $brs .= '<tr '.$bg.'>';
        $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$i.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
        //==============================================Start UHT=========================================//
        $uht1kd5Uts = $row->kd5_uht1_uts;
        $uht2kd5Uts = $row->kd5_uht2_uts;
        $uht3kd5Uts = $row->kd5_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd5 = $row->kd5_uht1;
          $uht2kd5 = $row->kd5_uht2;
          $uht3kd5 = $row->kd5_uht3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd5Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd5Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd5Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd5.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd5.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd5.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $uhtMax = max($uht1kd5, $uht2kd5, $uht3kd5, $uht1kd5Uts, $uht2kd5Uts, $uht3kd5Uts);
        }
        else {
          $uhtMax = max($uht1kd5Uts, $uht2kd5Uts, $uht3kd5Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$uhtMax.'</td>';
        //==============================================Start UHT=========================================//
        //==============================================Start tgs=========================================//
        $tgs1kd5Uts = $row->kd5_tgs1_uts;
        $tgs2kd5Uts = $row->kd5_tgs2_uts;
        $tgs3kd5Uts = $row->kd5_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd5 = $row->kd5_tgs1;
          $tgs2kd5 = $row->kd5_tgs2;
          $tgs3kd5 = $row->kd5_tgs3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd5Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd5Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd5Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd5.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd5.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd5.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $tgsMax = max($tgs1kd5, $tgs2kd5, $tgs3kd5, $tgs1kd5Uts, $tgs2kd5Uts, $tgs3kd5Uts);
        }
        else {
          $tgsMax = max($tgs1kd5Uts, $tgs2kd5Uts, $tgs3kd5Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;font-size:0.8em/1.5;border: 1px solid black;">'.$tgsMax.'</td>';
        //==============================================End tgs=========================================//
        $brs .= '</tr>';
        $i++;
      }
    }
    echo $brs;
    ?>
  </tbody>
</table>
<?php if ($i<21) {?>
    <table style="width:100%;margin-left:300px;margin-top:10px;">
<?php } else { ?>
  <table style="width:100%;margin-left:300px;page-break-before:always;">
<?php } ?>
  <?php
  $dlmtStr = explode('-', $tgl_lhb);
  switch ($dlmtStr[1]) {
    case 1:
    $bln = 'Januari';
    break;
    case 2:
    $bln = 'Februari';
    break;
    case 3:
    $bln = 'Maret';
    break;
    case 4:
    $bln = 'April';
    break;
    case 5:
    $bln = 'Mei';
    break;
    case 6:
    $bln = 'Juni';
    break;
    case 7:
    $bln = 'Juli';
    break;
    case 8:
    $bln = 'Agustus';
    break;
    case 9:
    $bln = 'September';
    break;
    case 10:
    $bln = 'Oktober';
    break;
    case 11:
    $bln = 'November';
    break;
    case 12:
    $bln = 'Desember';
    break;
  }
  ?>
  <tr>
    <td style='font-size:0.8em/1.5'>Mengetahui,<br />Kepala Sekolah</td>
    <td style='font-size:0.8em/1.5'>Kab. Bogor, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?><br />Guru Mata Pelajaran</td>
  </tr>
  <tr>
    <td style='height:100px;font-size:0.8em/1.5'><?php echo $kepsek->row()->nama_lengkap;?></td>
    <td style='font-size:0.8em/1.5'>
      <?php
      foreach($kkm->result() as $row)
      {
      echo $row->nama_lengkap;
      break;
      }
      ?>
  </td>
  </tr>
</table>
<!--------------------------------------------KD5-------------------------------------------------->
<!--------------------------------------------KD6-------------------------------------------------->
<table style="width:100%;page-break-before:always;">
  <tr>
    <td rowspan="4"><img style="width:50px;" src="D:\EDUSIS\App\Prestasi\WebPrestasiSmaKurtilas1617\edusis_asset\edusisimg\logo.jpg" /></td>
    <td colspan="2" style="text-align:center;font-size:0.8em/1.5;text-align:center;font-weight:bold;">LEMBAR HASIL BELAJAR SISWA TAHUN PELAJARAN <?php echo $th_ajar; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;font-size:0.8em/1.5;text-align:center;">Mata Pelajaran : <?php echo $mp->row()->nm_mp; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;width:70%;">KD : 6</td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Kelas : <?php echo $kelas; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Semester : <?php echo $p_nl; ?></td>
    <?php
    foreach ($kkm->result() as $value) { ?>
      <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">KKM : <?php echo $value->skbm ?></td>
      <?php break; } ?>
  </tr>
</table>
<table style="border-collapse:collapse;width:100%;text-align:center;">
  <thead>
    <tr>
      <td rowspan="3" style="font-size:0.8em/1.5;;border:1px solid black;vertical-align:middle;">NO</td>
      <td rowspan="3" style="font-size:0.8em/1.5;;border:1px solid black;vertical-align:middle;width:30%;">Nama Siswa</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="14" style="font-size:0.8em/1.5;;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } else { ?>
        <td colspan="8" style="font-size:0.8em/1.5;;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } ?>
    </tr>
    <tr>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;;border:1px solid black;vertical-align:middle;">UH</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;;border:1px solid black;">NILAI HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;;border:1px solid black;">NILAI HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;;border:1px solid black;vertical-align:middle;">NH</td>
    </tr>
    <tr>
      <td style="font-size:0.8em/1.5;;border:1px solid black;">UH1</td>
      <td style="font-size:0.8em/1.5;;border:1px solid black;">UH2</td>
      <td style="font-size:0.8em/1.5;;border:1px solid black;">UH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;;border:1px solid black;">UH4</td>
        <td style="font-size:0.8em/1.5;;border:1px solid black;">UH5</td>
        <td style="font-size:0.8em/1.5;;border:1px solid black;">UH6</td>
      <?php } ?>
      <td style="font-size:0.8em/1.5;;border:1px solid black;">NH1</td>
      <td style="font-size:0.8em/1.5;;border:1px solid black;">NH2</td>
      <td style="font-size:0.8em/1.5;;border:1px solid black;">NH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;;border:1px solid black;">NH4</td>
        <td style="font-size:0.8em/1.5;;border:1px solid black;">NH5</td>
        <td style="font-size:0.8em/1.5;;border:1px solid black;">NH6</td>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $i  = 1;
    $brs = '';
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
      foreach($hasilbelajar as $row)
      {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        $brs .= '<tr '.$bg.'>';
        $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$i.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
        //==============================================Start UHT=========================================//
        $uht1kd6Uts = $row->kd6_uht1_uts;
        $uht2kd6Uts = $row->kd6_uht2_uts;
        $uht3kd6Uts = $row->kd6_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd6 = $row->kd6_uht1;
          $uht2kd6 = $row->kd6_uht2;
          $uht3kd6 = $row->kd6_uht3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$uht1kd6Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$uht2kd6Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$uht3kd6Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$uht1kd6.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$uht2kd6.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$uht3kd6.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $uhtMax = max($uht1kd6, $uht2kd6, $uht3kd6, $uht1kd6Uts, $uht2kd6Uts, $uht3kd6Uts);
        }
        else {
          $uhtMax = max($uht1kd6Uts, $uht2kd6Uts, $uht3kd6Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$uhtMax.'</td>';
        //==============================================Start UHT=========================================//
        //==============================================Start tgs=========================================//
        $tgs1kd6Uts = $row->kd6_tgs1_uts;
        $tgs2kd6Uts = $row->kd6_tgs2_uts;
        $tgs3kd6Uts = $row->kd6_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd6 = $row->kd6_tgs1;
          $tgs2kd6 = $row->kd6_tgs2;
          $tgs3kd6 = $row->kd6_tgs3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$tgs1kd6Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$tgs2kd6Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$tgs3kd6Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$tgs1kd6.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$tgs2kd6.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$tgs3kd6.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $tgsMax = max($tgs1kd6, $tgs2kd6, $tgs3kd6, $tgs1kd6Uts, $tgs2kd6Uts, $tgs3kd6Uts);
        }
        else {
          $tgsMax = max($tgs1kd6Uts, $tgs2kd6Uts, $tgs3kd6Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;;border: 1px solid black;">'.$tgsMax.'</td>';
        //==============================================End tgs=========================================//
        $brs .= '</tr>';
        $i++;
      }
    }
    echo $brs;
    ?>
  </tbody>
</table>
<?php if ($i<21) {?>
    <table style="width:100%;margin-left:300px;margin-top:10px;">
<?php } else { ?>
  <table style="width:100%;margin-left:300px;page-break-before:always;">
<?php } ?>
  <?php
  $dlmtStr = explode('-', $tgl_lhb);
  switch ($dlmtStr[1]) {
    case 1:
    $bln = 'Januari';
    break;
    case 2:
    $bln = 'Februari';
    break;
    case 3:
    $bln = 'Maret';
    break;
    case 4:
    $bln = 'April';
    break;
    case 5:
    $bln = 'Mei';
    break;
    case 6:
    $bln = 'Juni';
    break;
    case 7:
    $bln = 'Juli';
    break;
    case 8:
    $bln = 'Agustus';
    break;
    case 9:
    $bln = 'September';
    break;
    case 10:
    $bln = 'Oktober';
    break;
    case 11:
    $bln = 'November';
    break;
    case 12:
    $bln = 'Desember';
    break;
  }
  ?>
  <tr>
    <td style='font-size:0.8em/1.5'>Mengetahui,<br />Kepala Sekolah</td>
    <td style='font-size:0.8em/1.5'>Kab. Bogor, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?><br />Guru Mata Pelajaran</td>
  </tr>
  <tr>
    <td style='height:100px;font-size:0.8em/1.5'><?php echo $kepsek->row()->nama_lengkap;?></td>
    <td style='font-size:0.8em/1.5'>
      <?php
      foreach($kkm->result() as $row)
      {
      echo $row->nama_lengkap;
      break;
      }
      ?>
  </td>
  </tr>
</table>
<!--------------------------------------------KD6-------------------------------------------------->
<!--------------------------------------------KD7-------------------------------------------------->
<table style="width:100%;page-break-before:always;">
  <tr>
    <td rowspan="4"><img style="width:50px;" src="D:\EDUSIS\App\Prestasi\WebPrestasiSmaKurtilas1617\edusis_asset\edusisimg\logo.jpg" /></td>
    <td colspan="2" style="text-align:center;font-size:0.8em/1.5;text-align:center;font-weight:bold;">LEMBAR HASIL BELAJAR SISWA TAHUN PELAJARAN <?php echo $th_ajar; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;font-size:0.8em/1.5;text-align:center;">Mata Pelajaran : <?php echo $mp->row()->nm_mp; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;width:70%;">KD : 7</td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Kelas : <?php echo $kelas; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Semester : <?php echo $p_nl; ?></td>
    <?php
    foreach ($kkm->result() as $value) { ?>
      <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">KKM : <?php echo $value->skbm ?></td>
      <?php break; } ?>
  </tr>
</table>
<table style="border-collapse:collapse;width:100%;text-align:center;">
  <thead>
    <tr>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NO</td>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;width:30%;">Nama Siswa</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="14" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } else { ?>
        <td colspan="8" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } ?>
    </tr>
    <tr>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">UH</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NH</td>
    </tr>
    <tr>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH6</td>
      <?php } ?>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH6</td>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $i  = 1;
    $brs = '';
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
      foreach($hasilbelajar as $row)
      {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        $brs .= '<tr '.$bg.'>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$i.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
        //==============================================Start UHT=========================================//
        $uht1kd7Uts = $row->kd7_uht1_uts;
        $uht2kd7Uts = $row->kd7_uht2_uts;
        $uht3kd7Uts = $row->kd7_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd7 = $row->kd7_uht1;
          $uht2kd7 = $row->kd7_uht2;
          $uht3kd7 = $row->kd7_uht3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd7Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd7Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd7Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd7.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd7.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd7.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $uhtMax = max($uht1kd7, $uht2kd7, $uht3kd7, $uht1kd7Uts, $uht2kd7Uts, $uht3kd7Uts);
        }
        else {
          $uhtMax = max($uht1kd7Uts, $uht2kd7Uts, $uht3kd7Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uhtMax.'</td>';
        //==============================================Start UHT=========================================//
        //==============================================Start tgs=========================================//
        $tgs1kd7Uts = $row->kd7_tgs1_uts;
        $tgs2kd7Uts = $row->kd7_tgs2_uts;
        $tgs3kd7Uts = $row->kd7_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd7 = $row->kd7_tgs1;
          $tgs2kd7 = $row->kd7_tgs2;
          $tgs3kd7 = $row->kd7_tgs3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd7Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd7Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd7Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd7.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd7.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd7.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $tgsMax = max($tgs1kd7, $tgs2kd7, $tgs3kd7, $tgs1kd7Uts, $tgs2kd7Uts, $tgs3kd7Uts);
        }
        else {
          $tgsMax = max($tgs1kd7Uts, $tgs2kd7Uts, $tgs3kd7Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgsMax.'</td>';
        //==============================================End tgs=========================================//
        $brs .= '</tr>';
        $i++;
      }
    }
    echo $brs;
    ?>
  </tbody>
</table>
<?php if ($i<21) {?>
    <table style="width:100%;margin-left:300px;margin-top:10px;">
<?php } else { ?>
  <table style="width:100%;margin-left:300px;page-break-before:always;">
<?php } ?>
  <?php
  $dlmtStr = explode('-', $tgl_lhb);
  switch ($dlmtStr[1]) {
    case 1:
    $bln = 'Januari';
    break;
    case 2:
    $bln = 'Februari';
    break;
    case 3:
    $bln = 'Maret';
    break;
    case 4:
    $bln = 'April';
    break;
    case 5:
    $bln = 'Mei';
    break;
    case 6:
    $bln = 'Juni';
    break;
    case 7:
    $bln = 'Juli';
    break;
    case 8:
    $bln = 'Agustus';
    break;
    case 9:
    $bln = 'September';
    break;
    case 10:
    $bln = 'Oktober';
    break;
    case 11:
    $bln = 'November';
    break;
    case 12:
    $bln = 'Desember';
    break;
  }
  ?>
  <tr>
    <td style='font-size:0.8em/1.5'>Mengetahui,<br />Kepala Sekolah</td>
    <td style='font-size:0.8em/1.5'>Kab. Bogor, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?><br />Guru Mata Pelajaran</td>
  </tr>
  <tr>
    <td style='height:100px;font-size:0.8em/1.5'><?php echo $kepsek->row()->nama_lengkap;?></td>
    <td style='font-size:0.8em/1.5'>
      <?php
      foreach($kkm->result() as $row)
      {
      echo $row->nama_lengkap;
      break;
      }
      ?>
  </td>
  </tr>
</table>
<!--------------------------------------------KD7-------------------------------------------------->
<!--------------------------------------------KD8-------------------------------------------------->
<table style="width:100%;page-break-before:always;">
  <tr>
    <td rowspan="4"><img style="width:50px;" src="D:\EDUSIS\App\Prestasi\WebPrestasiSmaKurtilas1617\edusis_asset\edusisimg\logo.jpg" /></td>
    <td colspan="2" style="text-align:center;font-size:0.8em/1.5;text-align:center;font-weight:bold;">LEMBAR HASIL BELAJAR SISWA TAHUN PELAJARAN <?php echo $th_ajar; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;font-size:0.8em/1.5;text-align:center;">Mata Pelajaran : <?php echo $mp->row()->nm_mp; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;width:70%;">KD : 8</td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Kelas : <?php echo $kelas; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Semester : <?php echo $p_nl; ?></td>
    <?php
    foreach ($kkm->result() as $value) { ?>
      <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">KKM : <?php echo $value->skbm ?></td>
      <?php break; } ?>
  </tr>
</table>
<table style="border-collapse:collapse;width:100%;text-align:center;">
  <thead>
    <tr>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NO</td>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;width:30%;">Nama Siswa</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="14" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } else { ?>
        <td colspan="8" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } ?>
    </tr>
    <tr>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">UH</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NH</td>
    </tr>
    <tr>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH6</td>
      <?php } ?>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH6</td>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $i  = 1;
    $brs = '';
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
      foreach($hasilbelajar as $row)
      {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        $brs .= '<tr '.$bg.'>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$i.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
        //==============================================Start UHT=========================================//
        $uht1kd8Uts = $row->kd8_uht1_uts;
        $uht2kd8Uts = $row->kd8_uht2_uts;
        $uht3kd8Uts = $row->kd8_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd8 = $row->kd8_uht1;
          $uht2kd8 = $row->kd8_uht2;
          $uht3kd8 = $row->kd8_uht3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd8Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd8Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd8Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd8.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd8.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd8.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $uhtMax = max($uht1kd8, $uht2kd8, $uht3kd8, $uht1kd8Uts, $uht2kd8Uts, $uht3kd8Uts);
        }
        else {
          $uhtMax = max($uht1kd8Uts, $uht2kd8Uts, $uht3kd8Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uhtMax.'</td>';
        //==============================================Start UHT=========================================//
        //==============================================Start tgs=========================================//
        $tgs1kd8Uts = $row->kd8_tgs1_uts;
        $tgs2kd8Uts = $row->kd8_tgs2_uts;
        $tgs3kd8Uts = $row->kd8_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd8 = $row->kd8_tgs1;
          $tgs2kd8 = $row->kd8_tgs2;
          $tgs3kd8 = $row->kd8_tgs3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd8Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd8Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd8Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd8.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd8.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd8.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $tgsMax = max($tgs1kd8, $tgs2kd8, $tgs3kd8, $tgs1kd8Uts, $tgs2kd8Uts, $tgs3kd8Uts);
        }
        else {
          $tgsMax = max($tgs1kd8Uts, $tgs2kd8Uts, $tgs3kd8Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgsMax.'</td>';
        //==============================================End tgs=========================================//
        $brs .= '</tr>';
        $i++;
      }
    }
    echo $brs;
    ?>
  </tbody>
</table>
<?php if ($i<21) {?>
    <table style="width:100%;margin-left:300px;margin-top:10px;">
<?php } else { ?>
  <table style="width:100%;margin-left:300px;page-break-before:always;">
<?php } ?>
  <?php
  $dlmtStr = explode('-', $tgl_lhb);
  switch ($dlmtStr[1]) {
    case 1:
    $bln = 'Januari';
    break;
    case 2:
    $bln = 'Februari';
    break;
    case 3:
    $bln = 'Maret';
    break;
    case 4:
    $bln = 'April';
    break;
    case 5:
    $bln = 'Mei';
    break;
    case 6:
    $bln = 'Juni';
    break;
    case 7:
    $bln = 'Juli';
    break;
    case 8:
    $bln = 'Agustus';
    break;
    case 9:
    $bln = 'September';
    break;
    case 10:
    $bln = 'Oktober';
    break;
    case 11:
    $bln = 'November';
    break;
    case 12:
    $bln = 'Desember';
    break;
  }
  ?>
  <tr>
    <td style='font-size:0.8em/1.5'>Mengetahui,<br />Kepala Sekolah</td>
    <td style='font-size:0.8em/1.5'>Kab. Bogor, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?><br />Guru Mata Pelajaran</td>
  </tr>
  <tr>
    <td style='height:100px;font-size:0.8em/1.5'><?php echo $kepsek->row()->nama_lengkap;?></td>
    <td style='font-size:0.8em/1.5'>
      <?php
      foreach($kkm->result() as $row)
      {
      echo $row->nama_lengkap;
      break;
      }
      ?>
  </td>
  </tr>
</table>
<!--------------------------------------------KD8-------------------------------------------------->
<!--------------------------------------------KD9-------------------------------------------------->
<table style="width:100%;page-break-before:always;">
  <tr>
    <td rowspan="4"><img style="width:50px;" src="D:\EDUSIS\App\Prestasi\WebPrestasiSmaKurtilas1617\edusis_asset\edusisimg\logo.jpg" /></td>
    <td colspan="2" style="text-align:center;font-size:0.8em/1.5;text-align:center;font-weight:bold;">LEMBAR HASIL BELAJAR SISWA TAHUN PELAJARAN <?php echo $th_ajar; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;font-size:0.8em/1.5;text-align:center;">Mata Pelajaran : <?php echo $mp->row()->nm_mp; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;width:70%;">KD : 9</td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Kelas : <?php echo $kelas; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Semester : <?php echo $p_nl; ?></td>
    <?php
    foreach ($kkm->result() as $value) { ?>
      <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">KKM : <?php echo $value->skbm ?></td>
      <?php break; } ?>
  </tr>
</table>
<table style="border-collapse:collapse;width:100%;text-align:center;">
  <thead>
    <tr>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NO</td>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;width:30%;">Nama Siswa</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="14" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } else { ?>
        <td colspan="8" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } ?>
    </tr>
    <tr>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">UH</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NH</td>
    </tr>
    <tr>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH6</td>
      <?php } ?>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH6</td>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $i  = 1;
    $brs = '';
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
      foreach($hasilbelajar as $row)
      {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        $brs .= '<tr '.$bg.'>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$i.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
        //==============================================Start UHT=========================================//
        $uht1kd9Uts = $row->kd9_uht1_uts;
        $uht2kd9Uts = $row->kd9_uht2_uts;
        $uht3kd9Uts = $row->kd9_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd9 = $row->kd9_uht1;
          $uht2kd9 = $row->kd9_uht2;
          $uht3kd9 = $row->kd9_uht3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd9Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd9Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd9Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd9.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd9.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd9.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $uhtMax = max($uht1kd9, $uht2kd9, $uht3kd9, $uht1kd9Uts, $uht2kd9Uts, $uht3kd9Uts);
        }
        else {
          $uhtMax = max($uht1kd9Uts, $uht2kd9Uts, $uht3kd9Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uhtMax.'</td>';
        //==============================================Start UHT=========================================//
        //==============================================Start tgs=========================================//
        $tgs1kd9Uts = $row->kd9_tgs1_uts;
        $tgs2kd9Uts = $row->kd9_tgs2_uts;
        $tgs3kd9Uts = $row->kd9_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd9 = $row->kd9_tgs1;
          $tgs2kd9 = $row->kd9_tgs2;
          $tgs3kd9 = $row->kd9_tgs3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd9Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd9Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd9Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd9.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd9.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd9.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $tgsMax = max($tgs1kd9, $tgs2kd9, $tgs3kd9, $tgs1kd9Uts, $tgs2kd9Uts, $tgs3kd9Uts);
        }
        else {
          $tgsMax = max($tgs1kd9Uts, $tgs2kd9Uts, $tgs3kd9Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgsMax.'</td>';
        //==============================================End tgs=========================================//
        $brs .= '</tr>';
        $i++;
      }
    }
    echo $brs;
    ?>
  </tbody>
</table>
<?php if ($i<21) {?>
    <table style="width:100%;margin-left:300px;margin-top:10px;">
<?php } else { ?>
  <table style="width:100%;margin-left:300px;page-break-before:always;">
<?php } ?>
  <?php
  $dlmtStr = explode('-', $tgl_lhb);
  switch ($dlmtStr[1]) {
    case 1:
    $bln = 'Januari';
    break;
    case 2:
    $bln = 'Februari';
    break;
    case 3:
    $bln = 'Maret';
    break;
    case 4:
    $bln = 'April';
    break;
    case 5:
    $bln = 'Mei';
    break;
    case 6:
    $bln = 'Juni';
    break;
    case 7:
    $bln = 'Juli';
    break;
    case 8:
    $bln = 'Agustus';
    break;
    case 9:
    $bln = 'September';
    break;
    case 10:
    $bln = 'Oktober';
    break;
    case 11:
    $bln = 'November';
    break;
    case 12:
    $bln = 'Desember';
    break;
  }
  ?>
  <tr>
    <td style='font-size:0.8em/1.5'>Mengetahui,<br />Kepala Sekolah</td>
    <td style='font-size:0.8em/1.5'>Kab. Bogor, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?><br />Guru Mata Pelajaran</td>
  </tr>
  <tr>
    <td style='height:100px;font-size:0.8em/1.5'><?php echo $kepsek->row()->nama_lengkap;?></td>
    <td style='font-size:0.8em/1.5'>
      <?php
      foreach($kkm->result() as $row)
      {
      echo $row->nama_lengkap;
      break;
      }
      ?>
  </td>
  </tr>
</table>
<!--------------------------------------------KD9-------------------------------------------------->
<!--------------------------------------------KD10-------------------------------------------------->
<table style="width:100%;page-break-before:always;">
  <tr>
    <td rowspan="4"><img style="width:50px;" src="D:\EDUSIS\App\Prestasi\WebPrestasiSmaKurtilas1617\edusis_asset\edusisimg\logo.jpg" /></td>
    <td colspan="2" style="text-align:center;font-size:0.8em/1.5;text-align:center;font-weight:bold;">LEMBAR HASIL BELAJAR SISWA TAHUN PELAJARAN <?php echo $th_ajar; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;font-size:0.8em/1.5;text-align:center;">Mata Pelajaran : <?php echo $mp->row()->nm_mp; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;width:70%;">KD : 10</td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Kelas : <?php echo $kelas; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Semester : <?php echo $p_nl; ?></td>
    <?php
    foreach ($kkm->result() as $value) { ?>
      <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">KKM : <?php echo $value->skbm ?></td>
      <?php break; } ?>
  </tr>
</table>
<table style="border-collapse:collapse;width:100%;text-align:center;">
  <thead>
    <tr>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NO</td>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;width:30%;">Nama Siswa</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="14" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } else { ?>
        <td colspan="8" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } ?>
    </tr>
    <tr>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">UH</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NH</td>
    </tr>
    <tr>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH6</td>
      <?php } ?>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH6</td>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $i  = 1;
    $brs = '';
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
      foreach($hasilbelajar as $row)
      {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        $brs .= '<tr '.$bg.'>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$i.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
        //==============================================Start UHT=========================================//
        $uht1kd10Uts = $row->kd10_uht1_uts;
        $uht2kd10Uts = $row->kd10_uht2_uts;
        $uht3kd10Uts = $row->kd10_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd10 = $row->kd10_uht1;
          $uht2kd10 = $row->kd10_uht2;
          $uht3kd10 = $row->kd10_uht3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd10Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd10Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd10Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd10.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd10.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd10.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $uhtMax = max($uht1kd10, $uht2kd10, $uht3kd10, $uht1kd10Uts, $uht2kd10Uts, $uht3kd10Uts);
        }
        else {
          $uhtMax = max($uht1kd10Uts, $uht2kd10Uts, $uht3kd10Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uhtMax.'</td>';
        //==============================================Start UHT=========================================//
        //==============================================Start tgs=========================================//
        $tgs1kd10Uts = $row->kd10_tgs1_uts;
        $tgs2kd10Uts = $row->kd10_tgs2_uts;
        $tgs3kd10Uts = $row->kd10_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd10 = $row->kd10_tgs1;
          $tgs2kd10 = $row->kd10_tgs2;
          $tgs3kd10 = $row->kd10_tgs3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd10Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd10Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd10Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd10.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd10.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd10.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $tgsMax = max($tgs1kd10, $tgs2kd10, $tgs3kd10, $tgs1kd10Uts, $tgs2kd10Uts, $tgs3kd10Uts);
        }
        else {
          $tgsMax = max($tgs1kd10Uts, $tgs2kd10Uts, $tgs3kd10Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgsMax.'</td>';
        //==============================================End tgs=========================================//
        $brs .= '</tr>';
        $i++;
      }
    }
    echo $brs;
    ?>
  </tbody>
</table>
<?php if ($i<21) {?>
    <table style="width:100%;margin-left:300px;margin-top:10px;">
<?php } else { ?>
  <table style="width:100%;margin-left:300px;page-break-before:always;">
<?php } ?>
  <?php
  $dlmtStr = explode('-', $tgl_lhb);
  switch ($dlmtStr[1]) {
    case 1:
    $bln = 'Januari';
    break;
    case 2:
    $bln = 'Februari';
    break;
    case 3:
    $bln = 'Maret';
    break;
    case 4:
    $bln = 'April';
    break;
    case 5:
    $bln = 'Mei';
    break;
    case 6:
    $bln = 'Juni';
    break;
    case 7:
    $bln = 'Juli';
    break;
    case 8:
    $bln = 'Agustus';
    break;
    case 9:
    $bln = 'September';
    break;
    case 10:
    $bln = 'Oktober';
    break;
    case 11:
    $bln = 'November';
    break;
    case 12:
    $bln = 'Desember';
    break;
  }
  ?>
  <tr>
    <td style='font-size:0.8em/1.5'>Mengetahui,<br />Kepala Sekolah</td>
    <td style='font-size:0.8em/1.5'>Kab. Bogor, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?><br />Guru Mata Pelajaran</td>
  </tr>
  <tr>
    <td style='height:100px;font-size:0.8em/1.5'><?php echo $kepsek->row()->nama_lengkap;?></td>
    <td style='font-size:0.8em/1.5'>
      <?php
      foreach($kkm->result() as $row)
      {
      echo $row->nama_lengkap;
      break;
      }
      ?>
  </td>
  </tr>
</table>
<!--------------------------------------------KD10-------------------------------------------------->
<!--------------------------------------------KD11-------------------------------------------------->
<table style="width:100%;page-break-before:always;">
  <tr>
    <td rowspan="4"><img style="width:50px;" src="D:\EDUSIS\App\Prestasi\WebPrestasiSmaKurtilas1617\edusis_asset\edusisimg\logo.jpg" /></td>
    <td colspan="2" style="text-align:center;font-size:0.8em/1.5;text-align:center;font-weight:bold;">LEMBAR HASIL BELAJAR SISWA TAHUN PELAJARAN <?php echo $th_ajar; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;font-size:0.8em/1.5;text-align:center;">Mata Pelajaran : <?php echo $mp->row()->nm_mp; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;width:70%;">KD : 11</td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Kelas : <?php echo $kelas; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Semester : <?php echo $p_nl; ?></td>
    <?php
    foreach ($kkm->result() as $value) { ?>
      <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">KKM : <?php echo $value->skbm ?></td>
      <?php break; } ?>
  </tr>
</table>
<table style="border-collapse:collapse;width:100%;text-align:center;">
  <thead>
    <tr>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NO</td>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;width:30%;">Nama Siswa</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="14" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } else { ?>
        <td colspan="8" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } ?>
    </tr>
    <tr>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">UH</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NH</td>
    </tr>
    <tr>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH6</td>
      <?php } ?>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH6</td>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $i  = 1;
    $brs = '';
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
      foreach($hasilbelajar as $row)
      {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        $brs .= '<tr '.$bg.'>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$i.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
        //==============================================Start UHT=========================================//
        $uht1kd11Uts = $row->kd11_uht1_uts;
        $uht2kd11Uts = $row->kd11_uht2_uts;
        $uht3kd11Uts = $row->kd11_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd11 = $row->kd11_uht1;
          $uht2kd11 = $row->kd11_uht2;
          $uht3kd11 = $row->kd11_uht3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd11Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd11Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd11Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd11.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd11.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd11.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $uhtMax = max($uht1kd11, $uht2kd11, $uht3kd11, $uht1kd11Uts, $uht2kd11Uts, $uht3kd11Uts);
        }
        else {
          $uhtMax = max($uht1kd11Uts, $uht2kd11Uts, $uht3kd11Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uhtMax.'</td>';
        //==============================================Start UHT=========================================//
        //==============================================Start tgs=========================================//
        $tgs1kd11Uts = $row->kd11_tgs1_uts;
        $tgs2kd11Uts = $row->kd11_tgs2_uts;
        $tgs3kd11Uts = $row->kd11_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd11 = $row->kd11_tgs1;
          $tgs2kd11 = $row->kd11_tgs2;
          $tgs3kd11 = $row->kd11_tgs3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd11Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd11Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd11Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd11.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd11.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd11.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $tgsMax = max($tgs1kd11, $tgs2kd11, $tgs3kd11, $tgs1kd11Uts, $tgs2kd11Uts, $tgs3kd11Uts);
        }
        else {
          $tgsMax = max($tgs1kd11Uts, $tgs2kd11Uts, $tgs3kd11Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgsMax.'</td>';
        //==============================================End tgs=========================================//
        $brs .= '</tr>';
        $i++;
      }
    }
    echo $brs;
    ?>
  </tbody>
</table>
<?php if ($i<21) {?>
    <table style="width:100%;margin-left:300px;margin-top:10px;">
<?php } else { ?>
  <table style="width:100%;margin-left:300px;page-break-before:always;">
<?php } ?>
  <?php
  $dlmtStr = explode('-', $tgl_lhb);
  switch ($dlmtStr[1]) {
    case 1:
    $bln = 'Januari';
    break;
    case 2:
    $bln = 'Februari';
    break;
    case 3:
    $bln = 'Maret';
    break;
    case 4:
    $bln = 'April';
    break;
    case 5:
    $bln = 'Mei';
    break;
    case 6:
    $bln = 'Juni';
    break;
    case 7:
    $bln = 'Juli';
    break;
    case 8:
    $bln = 'Agustus';
    break;
    case 9:
    $bln = 'September';
    break;
    case 10:
    $bln = 'Oktober';
    break;
    case 11:
    $bln = 'November';
    break;
    case 12:
    $bln = 'Desember';
    break;
  }
  ?>
  <tr>
    <td style='font-size:0.8em/1.5'>Mengetahui,<br />Kepala Sekolah</td>
    <td style='font-size:0.8em/1.5'>Kab. Bogor, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?><br />Guru Mata Pelajaran</td>
  </tr>
  <tr>
    <td style='height:100px;font-size:0.8em/1.5'><?php echo $kepsek->row()->nama_lengkap;?></td>
    <td style='font-size:0.8em/1.5'>
      <?php
      foreach($kkm->result() as $row)
      {
      echo $row->nama_lengkap;
      break;
      }
      ?>
  </td>
  </tr>
</table>
<!--------------------------------------------KD11-------------------------------------------------->
<!--------------------------------------------KD12-------------------------------------------------->
<table style="width:100%;page-break-before:always;">
  <tr>
    <td rowspan="4"><img style="width:50px;" src="D:\EDUSIS\App\Prestasi\WebPrestasiSmaKurtilas1617\edusis_asset\edusisimg\logo.jpg" /></td>
    <td colspan="2" style="text-align:center;font-size:0.8em/1.5;text-align:center;font-weight:bold;">LEMBAR HASIL BELAJAR SISWA TAHUN PELAJARAN <?php echo $th_ajar; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;font-size:0.8em/1.5;text-align:center;">Mata Pelajaran : <?php echo $mp->row()->nm_mp; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;width:70%;">KD : 12</td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Kelas : <?php echo $kelas; ?></td>
  </tr>
  <tr>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Semester : <?php echo $p_nl; ?></td>
    <?php
    foreach ($kkm->result() as $value) { ?>
      <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">KKM : <?php echo $value->skbm ?></td>
      <?php break; } ?>
  </tr>
</table>
<table style="border-collapse:collapse;width:100%;text-align:center;">
  <thead>
    <tr>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NO</td>
      <td rowspan="3" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;width:30%;">Nama Siswa</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="14" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } else { ?>
        <td colspan="8" style="font-size:0.8em/1.5;border:1px solid black;">NILAI PENGETAHUAN</td>
      <?php } ?>
    </tr>
    <tr>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">ULANGAN HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">UH</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td colspan="6" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } else { ?>
        <td colspan="3" style="font-size:0.8em/1.5;border:1px solid black;">NILAI HARIAN</td>
      <?php } ?>
      <td rowspan="2" style="font-size:0.8em/1.5;border:1px solid black;vertical-align:middle;">NH</td>
    </tr>
    <tr>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">UH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">UH6</td>
      <?php } ?>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH1</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH2</td>
      <td style="font-size:0.8em/1.5;border:1px solid black;">NH3</td>
      <?php if ($sub_pnl == 'UAS') { ?>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH4</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH5</td>
        <td style="font-size:0.8em/1.5;border:1px solid black;">NH6</td>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php
    $i  = 1;
    $brs = '';
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
      foreach($hasilbelajar as $row)
      {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        $brs .= '<tr '.$bg.'>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$i.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
        //==============================================Start UHT=========================================//
        $uht1kd12Uts = $row->kd12_uht1_uts;
        $uht2kd12Uts = $row->kd12_uht2_uts;
        $uht3kd12Uts = $row->kd12_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd12 = $row->kd12_uht1;
          $uht2kd12 = $row->kd12_uht2;
          $uht3kd12 = $row->kd12_uht3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd12Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd12Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd12Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht1kd12.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht2kd12.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uht3kd12.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $uhtMax = max($uht1kd12, $uht2kd12, $uht3kd12, $uht1kd12Uts, $uht2kd12Uts, $uht3kd12Uts);
        }
        else {
          $uhtMax = max($uht1kd12Uts, $uht2kd12Uts, $uht3kd12Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$uhtMax.'</td>';
        //==============================================Start UHT=========================================//
        //==============================================Start tgs=========================================//
        $tgs1kd12Uts = $row->kd12_tgs1_uts;
        $tgs2kd12Uts = $row->kd12_tgs2_uts;
        $tgs3kd12Uts = $row->kd12_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd12 = $row->kd12_tgs1;
          $tgs2kd12 = $row->kd12_tgs2;
          $tgs3kd12 = $row->kd12_tgs3;
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd12Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd12Uts.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd12Uts.'</td>';
        if ($sub_pnl == 'UAS') {
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs1kd12.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs2kd12.'</td>';
          $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgs3kd12.'</td>';
        }
        if ($sub_pnl == 'UAS') {
          $tgsMax = max($tgs1kd12, $tgs2kd12, $tgs3kd12, $tgs1kd12Uts, $tgs2kd12Uts, $tgs3kd12Uts);
        }
        else {
          $tgsMax = max($tgs1kd12Uts, $tgs2kd12Uts, $tgs3kd12Uts);
        }
        $brs .= '<td style="font-size:0.8em/1.5;border: 1px solid black;">'.$tgsMax.'</td>';
        //==============================================End tgs=========================================//
        $brs .= '</tr>';
        $i++;
      }
    }
    echo $brs;
    ?>
  </tbody>
</table>
<?php if ($i<21) {?>
    <table style="width:100%;margin-left:300px;margin-top:10px;">
<?php } else { ?>
  <table style="width:100%;margin-left:300px;page-break-before:always;">
<?php } ?>
  <?php
  $dlmtStr = explode('-', $tgl_lhb);
  switch ($dlmtStr[1]) {
    case 1:
    $bln = 'Januari';
    break;
    case 2:
    $bln = 'Februari';
    break;
    case 3:
    $bln = 'Maret';
    break;
    case 4:
    $bln = 'April';
    break;
    case 5:
    $bln = 'Mei';
    break;
    case 6:
    $bln = 'Juni';
    break;
    case 7:
    $bln = 'Juli';
    break;
    case 8:
    $bln = 'Agustus';
    break;
    case 9:
    $bln = 'September';
    break;
    case 10:
    $bln = 'Oktober';
    break;
    case 11:
    $bln = 'November';
    break;
    case 12:
    $bln = 'Desember';
    break;
  }
  ?>
  <tr>
    <td style='font-size:0.8em/1.5'>Mengetahui,<br />Kepala Sekolah</td>
    <td style='font-size:0.8em/1.5'>Kab. Bogor, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?><br />Guru Mata Pelajaran</td>
  </tr>
  <tr>
    <td style='height:100px;font-size:0.8em/1.5'><?php echo $kepsek->row()->nama_lengkap;?></td>
    <td style='font-size:0.8em/1.5'>
      <?php
      foreach($kkm->result() as $row)
      {
      echo $row->nama_lengkap;
      break;
      }
      ?>
  </td>
  </tr>
</table>
<!--------------------------------------------KD12-------------------------------------------------->
<table style="width:100%;page-break-before:always;">
  <tr>
    <td rowspan="2"><img style="width:50px;" src="D:\EDUSIS\App\Prestasi\WebPrestasiSmaKurtilas1617\edusis_asset\edusisimg\logo.jpg" /></td>
    <td colspan="4" style="text-align:center;font-size:0.8em/1.5;text-align:center;font-weight:bold;">LEMBAR HASIL BELAJAR SISWA TAHUN PELAJARAN <?php echo $th_ajar; ?></td>
  </tr>
  <tr>
    <td colspan="2" style="font-weight:bold;font-size:0.8em/1.5;">Mata Pelajaran : <?php echo $mp->row()->nm_mp; ?></td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Kelas : <?php echo $kelas; ?></td>
    <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">Semester : <?php echo $p_nl; ?></td>
    <?php
    foreach ($kkm->result() as $value) { ?>
      <td style="font-weight:bold;font-size:0.8em/1.5;text-align:left;">KKM : <?php echo $value->skbm ?></td>
      <?php break; } ?>
  </tr>
</table>
<table style="width:100%;border-collapse:collapse;text-align:center">
  <thead style="text-align:center;">
    <tr>
      <td rowspan="2" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">NO</td>
      <td rowspan="2" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;width:30%;">NAMA SISWA</td>
      <td colspan="12" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">HASIL PENILAIAN HARIAN</td>
      <td rowspan="2" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">Rata2x HPH</td>
	  <?php if($sub_pnl == "UAS") { ?>
			<td rowspan="2" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">60% Rata2x HPH</td>
			<td rowspan="2" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">Penilaian Akhir Semester</td>
            <td rowspan="2" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">40% Penilaian Akhir Semester</td>
            <td rowspan="2" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">Nilai Rapor (HPH+PAS)</td>
	  <?php } ?>
      
    </tr>
    <tr>
      <td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">KD1</td>
      <td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">KD2</td>
      <td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">KD3</td>
      <td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">KD4</td>
      <td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">KD5</td>
      <td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">KD6</td>
      <td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">KD7</td>
      <td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">KD8</td>
      <td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">KD9</td>
      <td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">KD10</td>
      <td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">KD11</td>
      <td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">KD12</td>
    </tr>
  </thead>
  <tbody>
    <?php
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
      $a= 1;
      $brs = '';
      foreach ($hasilbelajar as $row)
      {
        $bg = ($a%2==0) ? ' class="bg" ' : '';
        $brs .= '<tr '.$bg.'>';
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.$a.'</td>';
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
        //============================KD1==============================================//
        $uht1Kd1Uts = $row->kd1_uht1_uts;
        $uht2Kd1Uts = $row->kd1_uht2_uts;
        $uht3Kd1Uts = $row->kd1_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1Kd1 = $row->kd1_uht1;
          $uht2Kd1 = $row->kd1_uht2;
          $uht3Kd1 = $row->kd1_uht3;
        }
        if ($sub_pnl == 'UAS') {
          $uhtMaxkd1 = max($uht1Kd1, $uht2Kd1, $uht3Kd1, $uht1Kd1Uts, $uht2Kd1Uts, $uht3Kd1Uts);
        }
        else {
          $uhtMaxkd1 = max($uht1Kd1Uts, $uht2Kd1Uts, $uht3Kd1Uts);
        }
        $tgs1Kd1Uts = $row->kd1_tgs1_uts;
        $tgs2Kd1Uts = $row->kd1_tgs2_uts;
        $tgs3Kd1Uts = $row->kd1_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1Kd1 = $row->kd1_tgs1;
          $tgs2Kd1 = $row->kd1_tgs2;
          $tgs3Kd1 = $row->kd1_tgs3;
        }
        if ($sub_pnl == 'UAS') {
          $tgsMaxkd1 = max($tgs1Kd1, $tgs2Kd1, $tgs3Kd1, $tgs1Kd1Uts, $tgs2Kd1Uts, $tgs3Kd1Uts);
        }
        else {
          $tgsMaxkd1 = max($tgs1Kd1Uts, $tgs2Kd1Uts, $tgs3Kd1Uts);
        }
        $kd1Jml = $uhtMaxkd1 + $tgsMaxkd1;
        $kd1Dvd1 = ($uhtMaxkd1 == 0 || $uhtMaxkd1 == '0' || $uhtMaxkd1 == '') ? 0 : 1;
        $kd1Dvd2 = ($tgsMaxkd1 == 0 || $tgsMaxkd1 == '0' || $tgsMaxkd1 == '') ? 0 : 1;
        $kd1Dvd = $kd1Dvd1 + $kd1Dvd2;
        $kd1Rt = ($kd1Dvd == 0 || $kd1Dvd == '0' || $kd1Dvd == '') ? 0 : $kd1Jml / $kd1Dvd;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($kd1Rt).'</td>';
        //============================End KD1==============================================//
        //============================kd2==============================================//
        $uht1kd2Uts = $row->kd2_uht1_uts;
        $uht2kd2Uts = $row->kd2_uht2_uts;
        $uht3kd2Uts = $row->kd2_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd2 = $row->kd2_uht1;
          $uht2kd2 = $row->kd2_uht2;
          $uht3kd2 = $row->kd2_uht3;
        }
        if ($sub_pnl == 'UAS') {
          $uhtMaxkd2 = max($uht1kd2, $uht2kd2, $uht3kd2, $uht1kd2Uts, $uht2kd2Uts, $uht3kd2Uts);
        }
        else {
          $uhtMaxkd2 = max($uht1kd2Uts, $uht2kd2Uts, $uht3kd2Uts);
        }
        $tgs1kd2Uts = $row->kd2_tgs1_uts;
        $tgs2kd2Uts = $row->kd2_tgs2_uts;
        $tgs3kd2Uts = $row->kd2_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd2 = $row->kd2_tgs1;
          $tgs2kd2 = $row->kd2_tgs2;
          $tgs3kd2 = $row->kd2_tgs3;
        }
        if ($sub_pnl == 'UAS') {
          $tgsMaxkd2 = max($tgs1kd2, $tgs2kd2, $tgs3kd2, $tgs1kd2Uts, $tgs2kd2Uts, $tgs3kd2Uts);
        }
        else {
          $tgsMaxkd2 = max($tgs1kd2Uts, $tgs2kd2Uts, $tgs3kd2Uts);
        }
        $kd2Jml = $uhtMaxkd2 + $tgsMaxkd2;
        $kd2Dvd1 = ($uhtMaxkd2 == 0 || $uhtMaxkd2 == '0' || $uhtMaxkd2 == '') ? 0 : 1;
        $kd2Dvd2 = ($tgsMaxkd2 == 0 || $tgsMaxkd2 == '0' || $tgsMaxkd2 == '') ? 0 : 1;
        $kd2Dvd = $kd2Dvd1 + $kd2Dvd2;
        $kd2Rt = ($kd2Dvd == 0 || $kd2Dvd == '0' || $kd2Dvd == '') ? 0 : $kd2Jml / $kd2Dvd;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($kd2Rt).'</td>';
        //============================End kd2==============================================//
        //============================kd3==============================================//
        $uht1kd3Uts = $row->kd3_uht1_uts;
        $uht2kd3Uts = $row->kd3_uht2_uts;
        $uht3kd3Uts = $row->kd3_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd3 = $row->kd3_uht1;
          $uht2kd3 = $row->kd3_uht2;
          $uht3kd3 = $row->kd3_uht3;
        }
        if ($sub_pnl == 'UAS') {
          $uhtMaxkd3 = max($uht1kd3, $uht2kd3, $uht3kd3, $uht1kd3Uts, $uht2kd3Uts, $uht3kd3Uts);
        }
        else {
          $uhtMaxkd3 = max($uht1kd3Uts, $uht2kd3Uts, $uht3kd3Uts);
        }
        $tgs1kd3Uts = $row->kd3_tgs1_uts;
        $tgs2kd3Uts = $row->kd3_tgs2_uts;
        $tgs3kd3Uts = $row->kd3_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd3 = $row->kd3_tgs1;
          $tgs2kd3 = $row->kd3_tgs2;
          $tgs3kd3 = $row->kd3_tgs3;
        }
        if ($sub_pnl == 'UAS') {
          $tgsMaxkd3 = max($tgs1kd3, $tgs2kd3, $tgs3kd3, $tgs1kd3Uts, $tgs2kd3Uts, $tgs3kd3Uts);
        }
        else {
          $tgsMaxkd3 = max($tgs1kd3Uts, $tgs2kd3Uts, $tgs3kd3Uts);
        }
        $kd3Jml = $uhtMaxkd3 + $tgsMaxkd3;
        $kd3Dvd1 = ($uhtMaxkd3 == 0 || $uhtMaxkd3 == '0' || $uhtMaxkd3 == '') ? 0 : 1;
        $kd3Dvd2 = ($tgsMaxkd3 == 0 || $tgsMaxkd3 == '0' || $tgsMaxkd3 == '') ? 0 : 1;
        $kd3Dvd = $kd3Dvd1 + $kd3Dvd2;
        $kd3Rt = ($kd3Dvd == 0 || $kd3Dvd == '0' || $kd3Dvd == '') ? 0 : $kd3Jml / $kd3Dvd;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($kd3Rt).'</td>';
        //============================End kd3==============================================//
        //============================kd4==============================================//
        $uht1kd4Uts = $row->kd4_uht1_uts;
        $uht2kd4Uts = $row->kd4_uht2_uts;
        $uht3kd4Uts = $row->kd4_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd4 = $row->kd4_uht1;
          $uht2kd4 = $row->kd4_uht2;
          $uht3kd4 = $row->kd4_uht3;
        }
        if ($sub_pnl == 'UAS') {
          $uhtMaxkd4 = max($uht1kd4, $uht2kd4, $uht3kd4, $uht1kd4Uts, $uht2kd4Uts, $uht3kd4Uts);
        }
        else {
          $uhtMaxkd4 = max($uht1kd4Uts, $uht2kd4Uts, $uht3kd4Uts);
        }
        $tgs1kd4Uts = $row->kd4_tgs1_uts;
        $tgs2kd4Uts = $row->kd4_tgs2_uts;
        $tgs3kd4Uts = $row->kd4_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd4 = $row->kd4_tgs1;
          $tgs2kd4 = $row->kd4_tgs2;
          $tgs3kd4 = $row->kd4_tgs3;
        }
        if ($sub_pnl == 'UAS') {
          $tgsMaxkd4 = max($tgs1kd4, $tgs2kd4, $tgs3kd4, $tgs1kd4Uts, $tgs2kd4Uts, $tgs3kd4Uts);
        }
        else {
          $tgsMaxkd4 = max($tgs1kd4Uts, $tgs2kd4Uts, $tgs3kd4Uts);
        }
        $kd4Jml = $uhtMaxkd4 + $tgsMaxkd4;
        $kd4Dvd1 = ($uhtMaxkd4 == 0 || $uhtMaxkd4 == '0' || $uhtMaxkd4 == '') ? 0 : 1;
        $kd4Dvd2 = ($tgsMaxkd4 == 0 || $tgsMaxkd4 == '0' || $tgsMaxkd4 == '') ? 0 : 1;
        $kd4Dvd = $kd4Dvd1 + $kd4Dvd2;
        $kd4Rt = ($kd4Dvd == 0 || $kd4Dvd == '0' || $kd4Dvd == '') ? 0 : $kd4Jml / $kd4Dvd;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($kd4Rt).'</td>';
        //============================End kd4==============================================//

        //============================kd5==============================================//
        $uht1kd5Uts = $row->kd5_uht1_uts;
        $uht2kd5Uts = $row->kd5_uht2_uts;
        $uht3kd5Uts = $row->kd5_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd5 = $row->kd5_uht1;
          $uht2kd5 = $row->kd5_uht2;
          $uht3kd5 = $row->kd5_uht3;
        }
        if ($sub_pnl == 'UAS') {
          $uhtMaxkd5 = max($uht1kd5, $uht2kd5, $uht3kd5, $uht1kd5Uts, $uht2kd5Uts, $uht3kd5Uts);
        }
        else {
          $uhtMaxkd5 = max($uht1kd5Uts, $uht2kd5Uts, $uht3kd5Uts);
        }
        $tgs1kd5Uts = $row->kd5_tgs1_uts;
        $tgs2kd5Uts = $row->kd5_tgs2_uts;
        $tgs3kd5Uts = $row->kd5_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd5 = $row->kd5_tgs1;
          $tgs2kd5 = $row->kd5_tgs2;
          $tgs3kd5 = $row->kd5_tgs3;
        }
        if ($sub_pnl == 'UAS') {
          $tgsMaxkd5 = max($tgs1kd5, $tgs2kd5, $tgs3kd5, $tgs1kd5Uts, $tgs2kd5Uts, $tgs3kd5Uts);
        }
        else {
          $tgsMaxkd5 = max($tgs1kd5Uts, $tgs2kd5Uts, $tgs3kd5Uts);
        }
        $kd5Jml = $uhtMaxkd5 + $tgsMaxkd5;
        $kd5Dvd1 = ($uhtMaxkd5 == 0 || $uhtMaxkd5 == '0' || $uhtMaxkd5 == '') ? 0 : 1;
        $kd5Dvd2 = ($tgsMaxkd5 == 0 || $tgsMaxkd5 == '0' || $tgsMaxkd5 == '') ? 0 : 1;
        $kd5Dvd = $kd5Dvd1 + $kd5Dvd2;
        $kd5Rt = ($kd5Dvd == 0 || $kd5Dvd == '0' || $kd5Dvd == '') ? 0 : $kd5Jml / $kd5Dvd;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($kd5Rt).'</td>';
        //============================End kd5==============================================//
        //============================kd6==============================================//
        $uht1kd6Uts = $row->kd6_uht1_uts;
        $uht2kd6Uts = $row->kd6_uht2_uts;
        $uht3kd6Uts = $row->kd6_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd6 = $row->kd6_uht1;
          $uht2kd6 = $row->kd6_uht2;
          $uht3kd6 = $row->kd6_uht3;
        }
        if ($sub_pnl == 'UAS') {
          $uhtMaxkd6 = max($uht1kd6, $uht2kd6, $uht3kd6, $uht1kd6Uts, $uht2kd6Uts, $uht3kd6Uts);
        }
        else {
          $uhtMaxkd6 = max($uht1kd6Uts, $uht2kd6Uts, $uht3kd6Uts);
        }
        $tgs1kd6Uts = $row->kd6_tgs1_uts;
        $tgs2kd6Uts = $row->kd6_tgs2_uts;
        $tgs3kd6Uts = $row->kd6_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd6 = $row->kd6_tgs1;
          $tgs2kd6 = $row->kd6_tgs2;
          $tgs3kd6 = $row->kd6_tgs3;
        }
        if ($sub_pnl == 'UAS') {
          $tgsMaxkd6 = max($tgs1kd6, $tgs2kd6, $tgs3kd6, $tgs1kd6Uts, $tgs2kd6Uts, $tgs3kd6Uts);
        }
        else {
          $tgsMaxkd6 = max($tgs1kd6Uts, $tgs2kd6Uts, $tgs3kd6Uts);
        }
        $kd6Jml = $uhtMaxkd6 + $tgsMaxkd6;
        $kd6Dvd1 = ($uhtMaxkd6 == 0 || $uhtMaxkd6 == '0' || $uhtMaxkd6 == '') ? 0 : 1;
        $kd6Dvd2 = ($tgsMaxkd6 == 0 || $tgsMaxkd6 == '0' || $tgsMaxkd6 == '') ? 0 : 1;
        $kd6Dvd = $kd6Dvd1 + $kd6Dvd2;
        $kd6Rt = ($kd6Dvd == 0 || $kd6Dvd == '0' || $kd6Dvd == '') ? 0 : $kd6Jml / $kd6Dvd;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($kd6Rt).'</td>';
        //============================End kd6==============================================//
        //============================kd7==============================================//
        $uht1kd7Uts = $row->kd7_uht1_uts;
        $uht2kd7Uts = $row->kd7_uht2_uts;
        $uht3kd7Uts = $row->kd7_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd7 = $row->kd7_uht1;
          $uht2kd7 = $row->kd7_uht2;
          $uht3kd7 = $row->kd7_uht3;
        }
        if ($sub_pnl == 'UAS') {
          $uhtMaxkd7 = max($uht1kd7, $uht2kd7, $uht3kd7, $uht1kd7Uts, $uht2kd7Uts, $uht3kd7Uts);
        }
        else {
          $uhtMaxkd7 = max($uht1kd7Uts, $uht2kd7Uts, $uht3kd7Uts);
        }
        $tgs1kd7Uts = $row->kd7_tgs1_uts;
        $tgs2kd7Uts = $row->kd7_tgs2_uts;
        $tgs3kd7Uts = $row->kd7_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd7 = $row->kd7_tgs1;
          $tgs2kd7 = $row->kd7_tgs2;
          $tgs3kd7 = $row->kd7_tgs3;
        }
        if ($sub_pnl == 'UAS') {
          $tgsMaxkd7 = max($tgs1kd7, $tgs2kd7, $tgs3kd7, $tgs1kd7Uts, $tgs2kd7Uts, $tgs3kd7Uts);
        }
        else {
          $tgsMaxkd7 = max($tgs1kd7Uts, $tgs2kd7Uts, $tgs3kd7Uts);
        }
        $kd7Jml = $uhtMaxkd7 + $tgsMaxkd7;
        $kd7Dvd1 = ($uhtMaxkd7 == 0 || $uhtMaxkd7 == '0' || $uhtMaxkd7 == '') ? 0 : 1;
        $kd7Dvd2 = ($tgsMaxkd7 == 0 || $tgsMaxkd7 == '0' || $tgsMaxkd7 == '') ? 0 : 1;
        $kd7Dvd = $kd7Dvd1 + $kd7Dvd2;
        $kd7Rt = ($kd7Dvd == 0 || $kd7Dvd == '0' || $kd7Dvd == '') ? 0 : $kd7Jml / $kd7Dvd;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($kd7Rt).'</td>';
        //============================End kd7==============================================//
        //============================kd8==============================================//
        $uht1kd8Uts = $row->kd8_uht1_uts;
        $uht2kd8Uts = $row->kd8_uht2_uts;
        $uht3kd8Uts = $row->kd8_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd8 = $row->kd8_uht1;
          $uht2kd8 = $row->kd8_uht2;
          $uht3kd8 = $row->kd8_uht3;
        }
        if ($sub_pnl == 'UAS') {
          $uhtMaxkd8 = max($uht1kd8, $uht2kd8, $uht3kd8, $uht1kd8Uts, $uht2kd8Uts, $uht3kd8Uts);
        }
        else {
          $uhtMaxkd8 = max($uht1kd8Uts, $uht2kd8Uts, $uht3kd8Uts);
        }
        $tgs1kd8Uts = $row->kd8_tgs1_uts;
        $tgs2kd8Uts = $row->kd8_tgs2_uts;
        $tgs3kd8Uts = $row->kd8_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd8 = $row->kd8_tgs1;
          $tgs2kd8 = $row->kd8_tgs2;
          $tgs3kd8 = $row->kd8_tgs3;
        }
        if ($sub_pnl == 'UAS') {
          $tgsMaxkd8 = max($tgs1kd8, $tgs2kd8, $tgs3kd8, $tgs1kd8Uts, $tgs2kd8Uts, $tgs3kd8Uts);
        }
        else {
          $tgsMaxkd8 = max($tgs1kd8Uts, $tgs2kd8Uts, $tgs3kd8Uts);
        }
        $kd8Jml = $uhtMaxkd8 + $tgsMaxkd8;
        $kd8Dvd1 = ($uhtMaxkd8 == 0 || $uhtMaxkd8 == '0' || $uhtMaxkd8 == '') ? 0 : 1;
        $kd8Dvd2 = ($tgsMaxkd8 == 0 || $tgsMaxkd8 == '0' || $tgsMaxkd8 == '') ? 0 : 1;
        $kd8Dvd = $kd8Dvd1 + $kd8Dvd2;
        $kd8Rt = ($kd8Dvd == 0 || $kd8Dvd == '0' || $kd8Dvd == '') ? 0 : $kd8Jml / $kd8Dvd;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($kd8Rt).'</td>';
        //============================End kd8==============================================//
        //============================kd9==============================================//
        $uht1kd9Uts = $row->kd9_uht1_uts;
        $uht2kd9Uts = $row->kd9_uht2_uts;
        $uht3kd9Uts = $row->kd9_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd9 = $row->kd9_uht1;
          $uht2kd9 = $row->kd9_uht2;
          $uht3kd9 = $row->kd9_uht3;
        }
        if ($sub_pnl == 'UAS') {
          $uhtMaxkd9 = max($uht1kd9, $uht2kd9, $uht3kd9, $uht1kd9Uts, $uht2kd9Uts, $uht3kd9Uts);
        }
        else {
          $uhtMaxkd9 = max($uht1kd9Uts, $uht2kd9Uts, $uht3kd9Uts);
        }
        $tgs1kd9Uts = $row->kd9_tgs1_uts;
        $tgs2kd9Uts = $row->kd9_tgs2_uts;
        $tgs3kd9Uts = $row->kd9_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd9 = $row->kd9_tgs1;
          $tgs2kd9 = $row->kd9_tgs2;
          $tgs3kd9 = $row->kd9_tgs3;
        }
        if ($sub_pnl == 'UAS') {
          $tgsMaxkd9 = max($tgs1kd9, $tgs2kd9, $tgs3kd9, $tgs1kd9Uts, $tgs2kd9Uts, $tgs3kd9Uts);
        }
        else {
          $tgsMaxkd9 = max($tgs1kd9Uts, $tgs2kd9Uts, $tgs3kd9Uts);
        }
        $kd9Jml = $uhtMaxkd9 + $tgsMaxkd9;
        $kd9Dvd1 = ($uhtMaxkd9 == 0 || $uhtMaxkd9 == '0' || $uhtMaxkd9 == '') ? 0 : 1;
        $kd9Dvd2 = ($tgsMaxkd9 == 0 || $tgsMaxkd9 == '0' || $tgsMaxkd9 == '') ? 0 : 1;
        $kd9Dvd = $kd9Dvd1 + $kd9Dvd2;
        $kd9Rt = ($kd9Dvd == 0 || $kd9Dvd == '0' || $kd9Dvd == '') ? 0 : $kd9Jml / $kd9Dvd;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($kd9Rt).'</td>';
        //============================End kd9==============================================//
        //============================kd10==============================================//
        $uht1kd10Uts = $row->kd10_uht1_uts;
        $uht2kd10Uts = $row->kd10_uht2_uts;
        $uht3kd10Uts = $row->kd10_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd10 = $row->kd10_uht1;
          $uht2kd10 = $row->kd10_uht2;
          $uht3kd10 = $row->kd10_uht3;
        }
        if ($sub_pnl == 'UAS') {
          $uhtMaxkd10 = max($uht1kd10, $uht2kd10, $uht3kd10, $uht1kd10Uts, $uht2kd10Uts, $uht3kd10Uts);
        }
        else {
          $uhtMaxkd10 = max($uht1kd10Uts, $uht2kd10Uts, $uht3kd10Uts);
        }
        $tgs1kd10Uts = $row->kd10_tgs1_uts;
        $tgs2kd10Uts = $row->kd10_tgs2_uts;
        $tgs3kd10Uts = $row->kd10_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd10 = $row->kd10_tgs1;
          $tgs2kd10 = $row->kd10_tgs2;
          $tgs3kd10 = $row->kd10_tgs3;
        }
        if ($sub_pnl == 'UAS') {
          $tgsMaxkd10 = max($tgs1kd10, $tgs2kd10, $tgs3kd10, $tgs1kd10Uts, $tgs2kd10Uts, $tgs3kd10Uts);
        }
        else {
          $tgsMaxkd10 = max($tgs1kd10Uts, $tgs2kd10Uts, $tgs3kd10Uts);
        }
        $kd10Jml = $uhtMaxkd10 + $tgsMaxkd10;
        $kd10Dvd1 = ($uhtMaxkd10 == 0 || $uhtMaxkd10 == '0' || $uhtMaxkd10 == '') ? 0 : 1;
        $kd10Dvd2 = ($tgsMaxkd10 == 0 || $tgsMaxkd10 == '0' || $tgsMaxkd10 == '') ? 0 : 1;
        $kd10Dvd = $kd10Dvd1 + $kd10Dvd2;
        $kd10Rt = ($kd10Dvd == 0 || $kd10Dvd == '0' || $kd10Dvd == '') ? 0 : $kd10Jml / $kd10Dvd;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($kd10Rt).'</td>';
        //============================End kd10==============================================//
        //============================kd11==============================================//
        $uht1kd11Uts = $row->kd11_uht1_uts;
        $uht2kd11Uts = $row->kd11_uht2_uts;
        $uht3kd11Uts = $row->kd11_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd11 = $row->kd11_uht1;
          $uht2kd11 = $row->kd11_uht2;
          $uht3kd11 = $row->kd11_uht3;
        }
        if ($sub_pnl == 'UAS') {
          $uhtMaxkd11 = max($uht1kd11, $uht2kd11, $uht3kd11, $uht1kd11Uts, $uht2kd11Uts, $uht3kd11Uts);
        }
        else {
          $uhtMaxkd11 = max($uht1kd11Uts, $uht2kd11Uts, $uht3kd11Uts);
        }
        $tgs1kd11Uts = $row->kd11_tgs1_uts;
        $tgs2kd11Uts = $row->kd11_tgs2_uts;
        $tgs3kd11Uts = $row->kd11_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd11 = $row->kd11_tgs1;
          $tgs2kd11 = $row->kd11_tgs2;
          $tgs3kd11 = $row->kd11_tgs3;
        }
        if ($sub_pnl == 'UAS') {
          $tgsMaxkd11 = max($tgs1kd11, $tgs2kd11, $tgs3kd11, $tgs1kd11Uts, $tgs2kd11Uts, $tgs3kd11Uts);
        }
        else {
          $tgsMaxkd11 = max($tgs1kd11Uts, $tgs2kd11Uts, $tgs3kd11Uts);
        }
        $kd11Jml = $uhtMaxkd11 + $tgsMaxkd11;
        $kd11Dvd1 = ($uhtMaxkd11 == 0 || $uhtMaxkd11 == '0' || $uhtMaxkd11 == '') ? 0 : 1;
        $kd11Dvd2 = ($tgsMaxkd11 == 0 || $tgsMaxkd11 == '0' || $tgsMaxkd11 == '') ? 0 : 1;
        $kd11Dvd = $kd11Dvd1 + $kd11Dvd2;
        $kd11Rt = ($kd11Dvd == 0 || $kd11Dvd == '0' || $kd11Dvd == '') ? 0 : $kd11Jml / $kd11Dvd;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($kd11Rt).'</td>';
        //============================End kd11==============================================//
        //============================kd12==============================================//
        $uht1kd12Uts = $row->kd12_uht1_uts;
        $uht2kd12Uts = $row->kd12_uht2_uts;
        $uht3kd12Uts = $row->kd12_uht3_uts;
        if ($sub_pnl == 'UAS') {
          $uht1kd12 = $row->kd12_uht1;
          $uht2kd12 = $row->kd12_uht2;
          $uht3kd12 = $row->kd12_uht3;
        }
        if ($sub_pnl == 'UAS') {
          $uhtMaxkd12 = max($uht1kd12, $uht2kd12, $uht3kd12, $uht1kd12Uts, $uht2kd12Uts, $uht3kd12Uts);
        }
        else {
          $uhtMaxkd12 = max($uht1kd12Uts, $uht2kd12Uts, $uht3kd12Uts);
        }
        $tgs1kd12Uts = $row->kd12_tgs1_uts;
        $tgs2kd12Uts = $row->kd12_tgs2_uts;
        $tgs3kd12Uts = $row->kd12_tgs3_uts;
        if ($sub_pnl == 'UAS') {
          $tgs1kd12 = $row->kd12_tgs1;
          $tgs2kd12 = $row->kd12_tgs2;
          $tgs3kd12 = $row->kd12_tgs3;
        }
        if ($sub_pnl == 'UAS') {
          $tgsMaxkd12 = max($tgs1kd12, $tgs2kd12, $tgs3kd12, $tgs1kd12Uts, $tgs2kd12Uts, $tgs3kd12Uts);
        }
        else {
          $tgsMaxkd12 = max($tgs1kd12Uts, $tgs2kd12Uts, $tgs3kd12Uts);
        }
        $kd12Jml = $uhtMaxkd12 + $tgsMaxkd12;
        $kd12Dvd1 = ($uhtMaxkd12 == 0 || $uhtMaxkd12 == '0' || $uhtMaxkd12 == '') ? 0 : 1;
        $kd12Dvd2 = ($tgsMaxkd12 == 0 || $tgsMaxkd12 == '0' || $tgsMaxkd12 == '') ? 0 : 1;
        $kd12Dvd = $kd12Dvd1 + $kd12Dvd2;
        $kd12Rt = ($kd12Dvd == 0 || $kd12Dvd == '0' || $kd12Dvd == '') ? 0 : $kd12Jml / $kd12Dvd;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($kd12Rt).'</td>';
        //============================End kd12==============================================//
        //=============================START Rata2x HPH======================================//
        $kdJml = $kd1Rt + $kd2Rt + $kd3Rt + $kd4Rt + $kd5Rt + $kd6Rt + $kd7Rt + $kd8Rt + $kd9Rt + $kd10Rt + $kd11Rt + $kd12Rt;
        $kdDVD1 = ($kd1Rt == 0 || $kd1Rt == '0' || $kd1Rt == '') ? 0 : 1;
        $kdDVD2 = ($kd2Rt == 0 || $kd2Rt == '0' || $kd2Rt == '') ? 0 : 1;
        $kdDVD3 = ($kd3Rt == 0 || $kd3Rt == '0' || $kd3Rt == '') ? 0 : 1;
        $kdDVD4 = ($kd4Rt == 0 || $kd4Rt == '0' || $kd4Rt == '') ? 0 : 1;
        $kdDVD5 = ($kd5Rt == 0 || $kd5Rt == '0' || $kd5Rt == '') ? 0 : 1;
        $kdDVD6 = ($kd6Rt == 0 || $kd6Rt == '0' || $kd6Rt == '') ? 0 : 1;
        $kdDVD7 = ($kd7Rt == 0 || $kd7Rt == '0' || $kd7Rt == '') ? 0 : 1;
        $kdDVD8 = ($kd8Rt == 0 || $kd8Rt == '0' || $kd8Rt == '') ? 0 : 1;
        $kdDVD9 = ($kd9Rt == 0 || $kd9Rt == '0' || $kd9Rt == '') ? 0 : 1;
        $kdDVD10 = ($kd10Rt == 0 || $kd10Rt == '0' || $kd10Rt == '') ? 0 : 1;
        $kdDVD11 = ($kd11Rt == 0 || $kd11Rt == '0' || $kd11Rt == '') ? 0 : 1;
        $kdDVD12 = ($kd12Rt == 0 || $kd12Rt == '0' || $kd12Rt == '') ? 0 : 1;
        $kdDvd = $kdDVD1 + $kdDVD2 + $kdDVD3 + $kdDVD4 + $kdDVD5 + $kdDVD6 + $kdDVD7 + $kdDVD8 + $kdDVD9 + $kdDVD10 + $kdDVD11 + $kdDVD12;
        $kdRt = ($kdDvd == 0 || $kdDvd == '0' || $kdDvd == '') ? 0 : $kdJml / $kdDvd;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($kdRt).'</td>';
        //=============================END Rata2x HPH======================================//
		if($sub_pnl == "UAS")
		{
			//================================Rata2x 60%=======================================//
        $kd60 = $kdRt * 0.6;
        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.$kd60.'</td>';
        //==============================End Rata2x 60%=====================================//
        //==============================START PAS=====================================//
        if ($sub_pnl == 'UAS') {
          $pas = $row->UAS;
          $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.$pas.'</td>';

          $pas40 = $pas * 0.4;
          $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.$pas40.'</td>';
        }
        //================================END PAS=====================================//
        //===============================Nilai Rapor==================================//
        if ($kd60 <= 0 || $pas40 <= 0) {
          $nlRapor = $pas;
        }
        else
        {
          $nlRapor = $kd60 + $pas40;
        }

        $rprDvd1 = ($kd60 == 0 || $kd60 == '0' || $kd60 == '') ? 0 : 1;
        $rprDvd2 = ($pas40 == 0 || $pas40 == '0' || $pas40 == '') ? 0 : 1;
        $rprDvd = $rprDvd1 + $rprDvd2;

        $rapor = ($rprDvd == 0 || $rprDvd == '' || $rprDvd == '0' ) ? 0 : $nlRapor / $rprDvd;

        $brs .= '<td style="font-size:0.8em/1.5;border:1px solid black;">'.round($nlRapor).'</td>';
        //=============================End Nilai Rapor================================//
		}
        $brs .= '</tr>';
        $a++;
      }
      echo $brs;
    }
    ?>
  </tbody>
</table>
<?php if ($i<21) {?>
    <table style="width:100%;margin-left:300px;margin-top:10px;">
<?php } else { ?>
  <table style="width:100%;margin-left:300px;page-break-before:always;">
<?php } ?>
  <?php
  $dlmtStr = explode('-', $tgl_lhb);
  switch ($dlmtStr[1]) {
    case 1:
    $bln = 'Januari';
    break;
    case 2:
    $bln = 'Februari';
    break;
    case 3:
    $bln = 'Maret';
    break;
    case 4:
    $bln = 'April';
    break;
    case 5:
    $bln = 'Mei';
    break;
    case 6:
    $bln = 'Juni';
    break;
    case 7:
    $bln = 'Juli';
    break;
    case 8:
    $bln = 'Agustus';
    break;
    case 9:
    $bln = 'September';
    break;
    case 10:
    $bln = 'Oktober';
    break;
    case 11:
    $bln = 'November';
    break;
    case 12:
    $bln = 'Desember';
    break;
  }
  ?>
  <tr>
    <td style='font-size:0.8em/1.5'>Mengetahui,<br />Kepala Sekolah</td>
    <td style='font-size:0.8em/1.5'>Kab. Bogor, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?><br />Guru Mata Pelajaran</td>
  </tr>
  <tr>
    <td style='height:100px;font-size:0.8em/1.5'><?php echo $kepsek->row()->nama_lengkap;?></td>
    <td style='font-size:0.8em/1.5'>
      <?php
      foreach($kkm->result() as $row)
      {
      echo $row->nama_lengkap;
      break;
      }
      ?>
  </td>
  </tr>
</table>
