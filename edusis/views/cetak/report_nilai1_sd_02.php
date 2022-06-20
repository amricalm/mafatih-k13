<html>
<head>
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" />
<title>Raport</title>
<!-- WRITE YOUR CSS CODE HERE -->
<?php
function konversi_predikat($tmp)
{
  $predikat = "";
  if($tmp==0){
      $predikat = '';
  } elseif($tmp < 70) {
      $predikat = 'D';
  } elseif ($tmp < 80) {
      $predikat = 'C';
  } elseif ($tmp < 90) {
      $predikat = 'B';
  } elseif ($tmp <= 100) {
      $predikat = 'A';
  }
  return $predikat;
}
?>
<style>
@font-face {
  font-family: Arial;
  font-family: Bradley Hand ITC;
  font-family: Bodoni MT Black;
  src: url(<?php echo base_url() ?>/edusis_asset/fonts/arial.ttf);
  src: url(<?php echo base_url() ?>/edusis_asset/fonts/BRADHITC.TTF);
  src: url(<?php echo base_url() ?>/edusis_asset/fonts/BodoniMTBlack.ttf);
}
  table, div, tr, td, th, thead {
    padding: 0;
    margin: 0;
    font-size: 16px;
  }
  div.capital{
  }
  .capital p {
    margin: 0;
    display: inline-block;
    text-transform: initial;
  }
  thead {
    text-transform: uppercase;
  }
  .wrapper {
    width: 750px;
  }
  * {
    font-family: Arial, sans-serif;
  }
	@media all {*{


	}
	}
  @page { margin: 15px 10px; } body { margin: 15px 10px; }
</style>
</head>
<body>
<div class="wrapper">
  <div style="text-align: center; font-weight: bold;">
    <?php
        echo "<h3>RAPOR DAN PROFIL PESERTA DIDIK</h3>";
      ?>
  </div>
  <br><br>
 <table align="center" border="0" width="95%" style=" font-size: 11pt 'Arial', sans-serif;">
    <tr>
      <td width="22%" style=" font-size: 11pt 'Arial', sans-serif;">Nama Peserta Didik</td>
      <td width="41%" style=" font-size: 11pt 'Arial', sans-serif;">: <?php echo $datasiswa->row()->nama_lengkap;?></td>
      <td width="17%" style=" font-size: 11pt 'Arial', sans-serif;">Kelas</td>
      <td width="20%" style=" font-size: 11pt 'Arial', sans-serif;">: 
      <?php echo str_replace('+',' ',$this->uri->segment(3)); ?></td>
    </tr>
    <tr>
      <td style=" font-size: 11pt 'Arial', sans-serif;">NIS</td>
      <td style=" font-size: 11pt 'Arial', sans-serif;">: <?php echo $datasiswa->row()->nis;?></td>
      <td style=" font-size: 11pt 'Arial', sans-serif;">Semester</td>
      <td style=" font-size: 11pt 'Arial', sans-serif;">: <?php 
      $kd_semester = $this->session->userdata('kd_semester');
      if ($kd_semester == 1) {
        $nama_semester = '(Satu)';
      } else {
        $nama_semester = '(Dua)';
      }
      echo $kd_semester.' '.$nama_semester ?></td>
    </tr>
    <tr>
      <td style=" font-size: 11pt 'Arial', sans-serif;">Nama Sekolah</td>
      <td style=" font-size: 11pt 'Arial', sans-serif; text-transform: uppercase;">: <?php echo $sekolah->row()->nama_sekolah;?></td>
      <td style=" font-size: 11pt 'Arial', sans-serif;">Tahun Pelajaran</td>
      <td style=" font-size: 11pt 'Arial', sans-serif;">: <?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
      <td style=" font-size: 11pt 'Arial', sans-serif;">Alamat Sekolah</td>
      <td style=" font-size: 11pt 'Arial', sans-serif;">: <?php echo $sekolah->row()->alamat_sekolah;?></td>
    </tr>
</table>
  <br>
  <table align="center" width="95%" style=" font-size: 11pt 'Arial', sans-serif; border-collapse: collapse;">
    <tr>
      <td colspan="3" style="padding-top: 10px;padding-bottom: 10px;font-weight: bold;font-size: 11pt;">A. Kompetensi Sikap</td>
    </tr>
    <tr>
      <td style="width: 5%;border:1px solid black;text-align:center;font-size: 11pt; background-color: #d3d3d3;">No</td>
      <td style="width: 20%;border:1px solid black;text-align:center;font-size: 11pt; background-color: #d3d3d3;">Aspek</td>
      <td style="width: 75%;border:1px solid black;text-align:center;font-size: 11pt; background-color: #d3d3d3;">Deskripsi</td>
    </tr>
    <tr>
      <td style="border:1px solid black;font-size: 11pt;text-align:center; height: 100px;">1</td>
      <td style="border:1px solid black;padding-left:10px;font-size: 11pt;">Sikap Spiritual</td>
      <td style="border:1px solid black;padding-left:10px;font-size: 11pt; text-align: middle;">
        <p style="text-align:justify;">
        <?php
          if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
            foreach($nilai_akhir->result() as $row) {
              echo $row->deskripsi_afk_spiritual;
            }
          }
          ?>
        </p>
      </td>
    </tr>
    <tr>
      <td style="border:1px solid black;font-size: 11pt;text-align:center; height: 100px;">2</td>
      <td style="border:1px solid black;padding-left:10px;font-size: 11pt;">Sikap Sosial</td>
      <td style="border:1px solid black;font-size: 11pt; text-align: middle;">
        <p style="text-align:justify; padding: 10px;">
          <?php
            if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
              foreach($nilai_akhir->result() as $row) {
                echo $row->deskripsi_afk;
              }
            }
          ?>
        </p>
      </td>
    </tr>
  </table>
  <table id="tabel_nilai" align="center" style="width: 95%; font-family: 'Arial', sans-serif;border-collapse: collapse">
    <tr>
      <td colspan="3" style="font-size: 11pt;font-weight:bold; padding: 20px 0px 10px;">B. Kompetensi Pengetahuan dan Keterampilan</td>
    </tr>
  </table>
  <table align="center" width="95%" style="font-family: 'Arial', sans-serif;border-collapse: collapse">
    <thead style="text-transform: none;">
      <tr style="text-align:center; background-color: #d3d3d3;">
        <td rowspan="2" style="border:1px solid black;font-size: 11pt; height:52.913385827px; width: 6%; background-color: #d3d3d3;">No</td>
        <td rowspan="2" style="border:1px solid black; font-size: 11pt; width: 20%; background-color: #d3d3d3;">Muatan<br>Pelajaran</td>
        <td colspan="3" style="border:1px solid black;font-size: 11pt; background-color: #d3d3d3; width: 25%;">Pengetahuan</td>
        <td colspan="3" style="border:1px solid black;font-size: 11pt; background-color: #d3d3d3; width: 25%;">Keterampilan</td>
      </tr>
      <tr style="text-align:center; background-color: #d3d3d3;">
        <td style="border:1px solid black;font-size: 11pt; width: 4%; background-color: #d3d3d3;">Nilai</td>
        <td style="border:1px solid black;font-size: 11pt; width: 8%; background-color: #d3d3d3;">Predikat</td>
        <td style="border:1px solid black;font-size: 11pt; width: 40%; background-color: #d3d3d3;">Deskripsi</td>
        <td style="border:1px solid black;font-size: 11pt; width: 4%; background-color: #d3d3d3;">Nilai</td>
        <td style="border:1px solid black;font-size: 11pt; width: 8%; background-color: #d3d3d3;">Predikat</td>
        <td style="border:1px solid black;font-size: 11pt; width: 40%; background-color: #d3d3d3;">Deskripsi</td>
      </tr>
    </thead>
    <tbody>
       <?php 
          if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0') { 
            $i  = 1;
            foreach($nilai_akhir->result() as $row)
            {
              $kel = $row->urutan;
              if($kel <= 8) 
              { 
                echo '<tr>';
                echo '<td align="center" style="font-size: 11pt;border:1px solid black; height: 250px;">'.$i.'</td>';
                if($row->nm_mp == "Pendidikan Agama Islam") {
                  $nm_mp = "Pendidikan Agama dan Budi Pekerti";
                } elseif($row->nm_mp == "Pendidikan Kewarganegaraan") {
                  $nm_mp = "Pendidikan Pancasila dan Kewarganegaraan";
                } elseif($row->nm_mp == "Pendidikan Jasmani dan Kesehatan") {
                  $nm_mp = "Pendidikan Jasmani, Olah Raga dan Kesehatan";
                } else {
                  $nm_mp = $row->nm_mp;
                }
                echo '<td align="center" style="border:1px solid black;font-size: 11pt;line-height:13px;">'.$nm_mp.'</td>';
                echo '<td align="center" style="border:1px solid black;font-size: 11pt">'.$row->kgn.'</td>';
                echo '<td align="center" style="border:1px solid black;font-size: 11pt">'.konversi_predikat($row->kgn).'</td>';
                echo '<td align="left" style="font-size: 11pt;border:1px solid black; padding-left: 5px; text-align: justify;">'.$row->deskripsi_kgn.'</td>';
    
                echo '<td align="center" style="border:1px solid black;font-size: 11pt">'.$row->psk.'</td>';
                echo '<td align="center" style="border:1px solid black;font-size: 11pt">'.konversi_predikat($row->psk).'</td>';
                echo '<td align="left" style="font-size: 11pt;border:1px solid black; padding-left: 5px; text-align: justify;">'.$row->deskripsi_psk.'</td>';
                echo '</tr>';
                $i++;
              }
            }
    
            echo "<tr>
                    <td colspan='8' style='font-size: 11pt; font-weight: bold; padding: 5px;'>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan='8' style='font-size: 11pt; font-weight: bold; padding: 5px;'>Muatan Lokal</td>
                  </tr>";
            
            $j  = $i+1;
            foreach($nilai_akhir->result() as $row)
            {
              $kel = $row->urutan;
              if($kel >= 9) {
                echo '<tr>';
                echo '<td align="center" style="font-size: 11pt;border:1px solid black; height: 250px;">'.$j.'</td>';
                echo '<td align="center" style="border:1px solid black;font-size: 11pt;line-height:13px;">'.$nm_mp.'</td>';
                echo '<td align="center" style="border:1px solid black;font-size: 11pt">'.$row->kgn.'</td>';
                echo '<td align="center" style="border:1px solid black;font-size: 11pt">'.konversi_predikat($row->kgn).'</td>';
                echo '<td align="left" style="font-size: 11pt;border:1px solid black; padding-left: 5px; text-align: justify;">'.$row->deskripsi_kgn.'</td>';
    
                echo '<td align="center" style="border:1px solid black;font-size: 11pt">'.$row->psk.'</td>';
                echo '<td align="center" style="border:1px solid black;font-size: 11pt">'.konversi_predikat($row->psk).'</td>';
                echo '<td align="left" style="font-size: 11pt;border:1px solid black; padding-left: 5px; text-align: justify;">'.$row->deskripsi_psk.'</td>';
                echo '</tr>';
              }
              $j++;
            } 
          } 
       ?>
    </tbody>
  </table>
  <div style="page-break-before: always;"></div>
<?php if ($sub_pnl == 'UTS') { ?>
<table style="border-collapse:collapse;width: 95%; font-family: 'Arial', sans-serif;margin-top:10px;" align="center">
    <tr>
      <td style="font-weight: bold;font-size: 11pt; padding: 10px 0px 10px; padding-right:1px;">C. Saran-saran</td>
    </tr>
    <tr>
      <?php
      $vall = 1;
      $valll;
      foreach ($catatan_siswa as $key => $value)
      {
        if ($value->comment != '')
        {
          echo '<td colspan="2"><div style="padding:10px;width:97%;font-size: 11pt;text-align:justify; border:1px solid black; font-family: "Arial", sans-serif;">'.$value->comment.'</div></td>';
          $vall++;
        }
        break;
      }
      if ($vall == 1)
      {
        echo '<td style="height:100px;width:100%;border:1px solid black;text-align:center;"></td>';
      }
      ?>
    </tr>
  </table>
  <table style="width: 95%; font-family: 'Arial', sans-serif;margin-top:10px;" align="center">
    <tr>
      <td style="width: 50%;">
        <table style="width:100%;border-collapse:collapse;">
          <tr>
              <td colspan="4" style="font-size: 11pt;font-weight:bold;padding-bottom:10px;">D. Ketidakhadiran</td>
          </tr>
          <tr>
              <td style="text-align: center; width: 4%; border: 1px solid black;">1</td>
              <td style="font-size: 11pt;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;padding:5px 5px 5px 10px; width: 30%;">Sakit</td>
              <td style="font-size: 11pt;border-top: 1px solid black;border-bottom: 1px solid black;text-align:center; width: 1%;">:</td>
              <td style="font-size: 11pt;text-align:left;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black; width: 65%;"><?php $a=($absens->row()->alfa == '0') ? '-' : $absens->row()->alfa; echo $a; ?> Hari</td>
          </tr>
          <tr>
              <td style="text-align: center; border: 1px solid black;">2</td>
              <td style="padding:5px 5px 5px 10px;font-size: 11pt;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">Ijin</td>
              <td style="font-size: 11pt;border-top: 1px solid black;border-bottom: 1px solid black;text-align:center;">:</td>
              <td style="font-size: 11pt;text-align:left;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><?php $a=($abseni->row()->alfa == '0') ? '-' : $abseni->row()->alfa; echo $a; ?> Hari</td>
          </tr>
          <tr>
              <td style="text-align: center; border: 1px solid black;">3</td>
              <td style="padding:5px 5px 5px 10px;font-size: 11pt;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;text-align:left;">Tanpa Keterangan</td>
              <td style="font-size: 11pt;border-top: 1px solid black;border-bottom: 1px solid black;text-align:center;">:</td>
              <td style="font-size: 11pt;text-align:left;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><?php $a=($abseina->row()->alfa == '0') ? '-' : $abseina->row()->alfa; echo $a; ?> Hari</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <?php } else { ?>
  <!-- <div style="page-break-before: always;"></div> -->
   <table style="margin-top:10px;border-collapse:collapse;width: 95%; font-family: 'Arial', sans-serif;" align="center">
    <thead style="text-transform: none;">
      <tr>
        <td style="font-weight: bold;font-size: 11pt;padding: 10px 2px 10px 0;width:0.8%;">C.</td>
        <td style="font-weight: bold;font-size: 11pt;padding: 10px 0px;" colspan="2">Ekstra Kurikuler</td>
      </tr>
      <tr>
        <th style="text-align:center;font-size:1em/1.5;border:1px solid black;width:4.5%; background-color: #d3d3d3;">No</th>
        <th style="padding:10px 0;border:1px solid black;font-size:1em/1.5;width:40.3%; background-color: #d3d3d3;">Kegiatan Ekstra Kurikuler</th>
        <th style="border:1px solid black;font-size:1em/1.5; background-color: #d3d3d3;">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $ii = 1;
        foreach($eskul->result() as $row)
        {
            echo '<tr>';
            echo '<td align="center" style="height:28.346456693px;border:1px solid black;width: 0.5%;font-size:1em/1.5;">'.$ii.'</td>';
            echo '<td style="border:1px solid black;padding-left: 10px;font-size:1em/1.5;">'.$row->nm_eskul.'</td>';
            $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
            echo '<td style="text-align:center;border:1px solid black;font-size:1em/1.5;">'.$nilai.'</td>';
            echo '</tr>';
            $ii++;
            //}
        }
        // if ($ii == 2) {
        //   echo '<tr style="text-align:center;">';
        //   echo '<td style="border:1px solid black;width: 0.5%;font-size:1em/1.5;">'.$ii.'</td>';
        //   echo '<td style="border:1px solid black;"> - </td>';
        //   echo '<td style="border:1px solid black;"> - </td>';
        //   echo '</tr>';
        // }
        // if ($ii == 1) {
        //   echo '<tr style="text-align:center;">';
        //   echo '<td style="border:1px solid black;width: 0.5%; font-size: 11pt;">1</td>';
        //   echo '<td style="border:1px solid black;"> - </td>';
        //   echo '<td style="border:1px solid black;"> - </td>';
        //   echo '</tr>';
        //   echo '<tr style="text-align:center;">';
        //   echo '<td style="border:1px solid black; font-size: 11pt;">2</td>';
        //   echo '<td style="border:1px solid black;"> - </td>';
        //   echo '<td style="border:1px solid black;"> - </td>';
        //   echo '</tr>';
        // }
      ?>
    </tbody>
  </table>
  <table style="border-collapse:collapse;width: 95%; font-family: 'Arial', sans-serif;margin-top:10px;" align="center">
    <tr>
      <td style="font-weight: bold;font-size: 11pt; padding-bottom: 10px;">D. &nbsp;&nbsp;&nbsp;&nbsp;Saran-saran</td>
    </tr>
    <tr>
      <?php
      $vall = 1;
      $valll;
      foreach ($catatan_siswa as $key => $value)
      {
        if ($value->comment != '')
        {
          echo '<td style="font-family: "Arial", sans-serif;"><div style="padding:10px;width:97%;font-size: 11pt;text-align:justify; border:1px solid black; ">'.$value->comment.'</div></td>';
          $vall++;
        }
        break;
      }
      if ($vall == 1)
      {
        echo '<td style="height:70px;width:100%;border:1px solid black;text-align:center;"></td>';
      }
      ?>
    </tr>
  </table>

  <!-- <table style="border-collapse:collapse;width: 95%; font-family: 'Arial', sans-serif;" align="center">
    <thead style="text-transform: none;">
      <tr>
        <td style="font-weight: bold;font-size: 11pt;padding: 10px 2px 10px 0;width:0.8%;">E.</td>
        <td style="font-weight: bold;font-size: 11pt;padding: 10px 0px;" colspan="3">Tinggi dan Berat Badan</td>
      </tr>
      <tr>
        <th rowspan="2" style="text-align:center;font-size:1em/1.5;border:1px solid black;width:4.5%; background-color: #d3d3d3;">No</th>
        <th rowspan="2" style="padding:10px 0;border:1px solid black;font-size:1em/1.5;width:40.3%; background-color: #d3d3d3; ">Aspek yang dinilai</th>
        <th colspan="2" style="border:1px solid black;font-size:1em/1.5; background-color: #d3d3d3;">Semester</th>
      </tr>
      <tr>
        <th style="height:18px; border:1px solid black;font-size:1em/1.5;background-color: #d3d3d3;">1</th>
        <th style="border:1px solid black;font-size:1em/1.5;background-color: #d3d3d3;">2</th>
      </tr>
    </thead>
    <tbody>
      <?php /* if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0') {
            echo '<tr style= width:50%;>';
            
            if (!empty($beratbadan)) {
            echo '<td style="border:1px solid #000000;text-align:center;">1</td>';
            echo '<td style="border:1px solid #000000;">&nbsp;&nbsp;Berat Badan</td>';
              $pnl = 0;
              foreach($beratbadan as $key => $value)
              {
                $berat_badan = ($value == ' ' || $value == 0) ? '-' : $value;
                $pnl+= $key; 
              }
              if ($key == 3) {
                foreach($beratbadan as $key => $value)
                {
                  $berat_badan = ($value == ' ' || $value == 0) ? '-' : $value;
                  echo '<td style="border:1px solid #000000; text-align: center;">'.$berat_badan.'</td>';
                }
              } elseif ($key == 2) {
                echo '<td style="border:1px solid #000000; text-align: center;">-</td>';
                echo '<td style="border:1px solid #000000; text-align: center;">'.$berat_badan.'</td>';
              } elseif ($key == 1) {
                echo '<td style="border:1px solid #000000; text-align: center;">'.$berat_badan.'</td>';
                echo '<td style="border:1px solid #000000; text-align: center;">-</td>';
              }
            } else {
              echo '<td>&nbsp;</td>';
              echo '<td>&nbsp;</td>';
              echo '<td>&nbsp;</td>';
              echo '<td>&nbsp;</td>';
            }
            echo '</tr>';

            echo '<tr class="bg" style= width:50%;>';
            if (!empty($tinggibadan)) {
            echo '<td style="border:1px solid #000000;text-align:center;">2</td>';
            echo '<td style="border:1px solid #000000;">&nbsp;&nbsp;Tinggi Badan</td>';
            $pnl = 0;
            foreach($tinggibadan as $key => $value)
            {
              $tinggi_badan = ($value == ' ' || $value == 0) ? '-' : $value;
              $pnl+= $key; 
            }
            if ($key == 3) {
              foreach($tinggibadan as $key => $value)
              {
                $tinggi_badan = ($value == ' ' || $value == 0) ? '-' : $value;
                echo '<td style="border:1px solid #000000; text-align: center;">'.$tinggi_badan.'</td>';
              }
            } elseif ($key == 2) {
              echo '<td style="border:1px solid #000000; text-align: center;">-</td>';
              echo '<td style="border:1px solid #000000; text-align: center;">'.$tinggi_badan.'</td>';
            } elseif ($key == 1) {
              echo '<td style="border:1px solid #000000; text-align: center;">'.$tinggi_badan.'</td>';
              echo '<td style="border:1px solid #000000; text-align: center;">-</td>';
            }
          }
            echo '</tr>';
        } */
      ?>
    </tbody>
  </table> -->

  <table style="border-collapse:collapse;width: 95%; font-family: 'Arial', sans-serif;" align="center">
    <thead style="text-transform: none;">
      <tr>
        <td style="font-weight: bold;font-size: 11pt;padding: 10px 2px 10px 0;width:0.8%;">E.</td>
        <td style="font-weight: bold;font-size: 11pt;padding: 10px 0px;" colspan="2">Kondisi Kesehatan</td>
      </tr>
      <tr>
        <th style="text-align:center;font-size:1em/1.5;border:1px solid black;width:4.5%;background-color: #d3d3d3;">No</th>
        <th style="padding:10px 0;border:1px solid black;font-size:1em/1.5;width:40.3%;background-color: #d3d3d3;">Aspek fisik</th>
        <th style="border:1px solid black;font-size:1em/1.5;background-color: #d3d3d3;">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0') {
          $i = 1;
          foreach($kesehatan->result() as $row)
          {
            $bg = ($i%2==0) ? ' class="bg" ' : '';
            echo '<tr'.$bg.'>';
            echo '<td style="border:1px solid #000000;text-align:center;">'.$i.'</td>';
            echo '<td style="border:1px solid #000000;">&nbsp;&nbsp;'.$row->nm_kesehatan.'</td>';
            $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
            echo '<td style="border:1px solid #000000; text-align: center;">'.$nilai.'</td>';
            echo '</tr>';
            $i++;
          }
        }
      ?>
    </tbody>
  </table>

 <!--  <table style="margin-top:10px;border-collapse:collapse;width: 95%; font-family: 'Arial', sans-serif;" align="center">
    <thead style="text-transform: none;">
      <tr>
        <td colspan="3" style="font-weight: bold;font-size: 11pt;padding-bottom:15px;">G. Prestasi</td>
      </tr>
      <tr style="text-align:center;">
        <td style="font-weight: bold;font-size: 11pt;height:34.015748031px;width:4.5%;border:1px solid black;">No</td>
        <td style="border:1px solid black;width:40%;font-weight: bold;font-size: 11pt;">Jenis Prestasi</td>
        <td style="border:1px solid black;font-weight: bold;font-size: 11pt;">Keterangan</td>
      </tr>
    </thead>
    <tbody>
      <?php
        $seq = 1;
        foreach($prestasi->result() as $row)
        {
            $bg = ($seq%2==0) ? ' class="bg" ' : '';
            echo '<tr'.$bg.'>';
            echo '<td style="text-align:center;border:1px solid black;font-size: 11pt;">'.$row->kd_prestasi.'</td>';
            echo '<td style="border:1px solid black;font-size: 11pt;padding: 0 0 3px 5px; text-align: left; padding-left: 3px;">'.$row->nm_prestasi.'</td>';
            echo '<td style="border:1px solid black;font-size: 11pt;padding: 0 0 3px 5px; text-align: left; padding-left: 3px;">'.$row->ket.'</td>';
            echo '</tr>';
            $seq++;
        }
        if ($seq == 2)
        {
          echo '<tr style="text-align:center;">';
          echo "<td style='text-align:center;border:1px solid black;font-size: 11pt;'>$seq</td>";
          echo "<td style='border:1px solid black;font-size: 11pt;padding: 0 0 3px 5px; text-align: left; padding-left: 3px;'> - </td>";
          echo "<td style='border:1px solid black;font-size: 11pt;padding: 0 0 3px 5px; text-align: left; padding-left: 3px;'> - </td>";
          echo "</tr>";
        }
        if ($seq == 1) {
          echo '<tr style="text-align:center;">';
          echo "<td style='text-align:center;border:1px solid black;font-size: 11pt;'>1</td>";
          echo "<td style='border:1px solid black;font-size: 11pt;padding: 0 0 3px 5px; text-align: left; padding-left: 3px;'> - </td>";
          echo "<td style='border:1px solid black;font-size: 11pt;padding: 0 0 3px 5px; text-align: left; padding-left: 3px;'> - </td>";
          echo "</tr>";
          echo "<tr style='text-align:center;'>";
          echo "<td style='border:1px solid black;font-size: 11pt;'>2</td>";
          echo "<td style='border:1px solid black;font-size: 11pt;padding: 0 0 3px 5px; text-align: left; padding-left: 3px;'> - </td>";
          echo "<td style='border:1px solid black;font-size: 11pt;padding: 0 0 3px 5px; text-align: left; padding-left: 3px;'> - </td>";
          echo "</tr>";
        }
      ?>
    </tbody>
  </table> -->
  <table style="width: 95%; font-family: 'Arial', sans-serif;margin-top:10px; border-collapse: collapse;" align="center">
    <tr>
        <td style="font-size: 11pt;font-weight:bold;padding-bottom:10px;">F.</td>
        <td colspan="3" style="font-size: 11pt;font-weight:bold;padding-bottom:10px;">Ketidakhadiran</td>
    </tr>
    <tr>
        <td style="border: 1px solid black; text-align: center; width:4.5%;">1</td>
        <td style="font-size: 11pt;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;padding:5px 5px 5px 10px; width: 37%;">Sakit</td>
        <td style="font-size: 11pt;border-top: 1px solid black;border-bottom: 1px solid black;text-align:center; width: 0.3%">:</td>
        <td style="font-size: 11pt;text-align:left;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><?php $a=($absens->row()->alfa == '0') ? '-' : $absens->row()->alfa; echo $a; ?> Hari</td>
    </tr>
    <tr>
        <td style="border: 1px solid black; text-align: center;">2</td>
        <td style="padding:5px 5px 5px 10px;font-size: 11pt;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">Ijin</td>
        <td style="font-size: 11pt;border-top: 1px solid black;border-bottom: 1px solid black;text-align:center;">:</td>
        <td style="font-size: 11pt;text-align:left;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><?php $a=($abseni->row()->alfa == '0') ? '-' : $abseni->row()->alfa; echo $a; ?> Hari</td>
    </tr>
    <tr>
        <td style="border: 1px solid black;text-align: center;">3</td>
        <td style="padding:5px 5px 5px 10px;font-size: 11pt;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;text-align:left;">Tanpa Keterangan</td>
        <td style="font-size: 11pt;border-top: 1px solid black;border-bottom: 1px solid black;text-align:center;">:</td>
        <td style="font-size: 11pt;text-align:left;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><?php $a=($abseina->row()->alfa == '0') ? '-' : $abseina->row()->alfa; echo $a; ?> Hari</td>
    </tr>
    <?php if ($this->session->userdata('kd_semester')=='2') { ?>
    <tr>
      <td colspan="4" height="30px">
        <?php
        $kelas_lama = str_replace('+',' ',$this->uri->segment(3));
        $naik_kelas = array('I'=>'II ( DUA )','II'=>'III ( TIGA )','III'=>'IV ( EMPAT )','IV'=>'V ( LIMA )','V'=>'VI ( ENAM )','VI'=>'LULUS');
          foreach($naik_kelas as $keynaik_kelas=>$valuenaik_kelas)
          {
            if(trim($kelas_lama) == $keynaik_kelas) {
              echo "<b>Naik ke Kelas : ".$valuenaik_kelas."</b>";
            }
          }
      ?>
      </td>
    </tr>
    <?php } else { ?>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
    <?php } ?> 
  </table>
  <?php } ?>

  <!-- <table style="border-collapse:collapse;width: 96%; font-family: 'Arial', sans-serif;" align="center">
    <tr>
      <td style="width:1%;font-weight: bold;font-size: 11pt; padding: 10px 3px 15px 0;">H.</td>
      <td colspan="1" style="font-weight: bold;font-size: 11pt; padding: 10px 0px 15px;">Tanggapan Orang Tua / Wali</td>
    </tr>
  </table> 
  <div style="border:1px solid black;width:93%;height:100px;margin-left:31px;"></div> -->

  <table style="border-collapse:collapse;width: 90%; font-family:1em/1.5 "Arial", sans-serif;" align="center">
    <tr>
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
      <td colspan="5" style="text-align:right;font-size: 11pt;padding-top:5px;padding-right:26px;"></td>
    </tr>
    <tr>
      <td colspan="2" style="font-size: 11pt">Mengetahui</td>
      <td colspan="2" style="font-size: 11pt"></td>
      <td style="font-size: 11pt"><?php echo $sekolah->row()->kabupaten;?>, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?></td>
    </tr>
    <tr>
      <td style="font-size: 11pt">Orang Tua/Wali,</td>
      <td></td>
      <td style="font-size: 11pt"></td>
      <td></td>
      <td style="width:30%;font-size: 11pt">Wali Kelas, <?php // echo str_replace('+',' ',$this->uri->segment(3)); ?></td>
    </tr>
    <tr>
      <td style="height:70px;"></td>
      <td colspan="2"></td>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="2" style="font-size: 11pt"><?php echo $datasiswa->row()->ayah_nama; ?></td>
      <td colspan="2" style="font-size: 11pt"></td>
      <td style="font-size: 11pt"><u><?php foreach ($walikelas as $key => $value) {
        echo $value->nama_lengkap;
      } ?></u></td>
    </tr>
    <tr>
      <td colspan="2" style="font-size: 11pt"></td>
      <td colspan="2" style="font-size: 11pt"></td>
      <td style="font-size: 11pt">NIP. <?php foreach ($walikelas as $key => $value) {
        echo $value->wali_kelas;
      } ?></td>
    </tr>
	<tr>
		<td colspan="5" style="font-size: 11pt; text-align: center;">Mengetahui</td>
	</tr>
	<tr>
		<td colspan="5" style="font-size: 11pt;text-align: center; text-transform: uppercase;">KEPALA <?php echo $sekolah->row()->nama_sekolah;?></td>
	</tr>
	<tr>
		<td style="height:70px;"></td>
	</tr>
	<tr>
		<td colspan="5" style="font-size: 11pt;text-align: center;"><span style="text-decoration: underline;"><?php echo $kepsek->row()->nama_lengkap;?></span><br />NIP. <?php echo $kepsek->row()->nip; ?></td>
	</tr>
  </table>
</div>
</body>
</html>
