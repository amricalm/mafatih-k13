<html>
<head>
<?php
function konversi_sikap_spiritual($pai, $pkn)
{
  $nilai = ($pai + $pkn) / 2;
  if ($nilai <= 55) {
    $nilai_sikap = "Kurang";
  } elseif ($nilai <= 70) {
    $nilai_sikap = "Cukup";
  } elseif ($nilai <= 85) {
    $nilai_sikap = "Baik";
  } elseif ($nilai <= 100) {
    $nilai_sikap = "Sangat Baik";
  }

  return $nilai_sikap;
}
function konversi_sikap_sosial($a)
{
  if ($a <= 55) {
    $nilai_sikap = "Kurang baik";
  } elseif ($a <= 70) {
    $nilai_sikap = "Baik";
  } elseif ($a <= 85) {
    $nilai_sikap = "Baik Sekali";
  } elseif ($a <= 100) {
    $nilai_sikap = "Sangat Baik";
  }

  return $nilai_sikap;
}
function konversi_sikap_mapel($nilai)
{
  if ($nilai <= 70) {
    $nilai_sikap = "Kurang baik";
  } elseif ($nilai <= 80) {
    $nilai_sikap = "Baik";
  } elseif ($nilai <= 90) {
    $nilai_sikap = "Baik Sekali";
  } elseif ($nilai <= 100) {
    $nilai_sikap = "Sangat Baik";
  }

  return $nilai_sikap;
}

function konversi_sma_4skala($tmp)
{
    $predikat = "";
                if($tmp==0) {
					$predikat = '-';
				}elseif($tmp<=54){
                    $predikat = '1.00';
                }elseif ($tmp<=59){
                    $predikat = '1.33';
                }elseif ($tmp<=64){
                    $predikat = '1.66';
                }elseif ($tmp<=69){
                    $predikat = '2.00';
                }elseif ($tmp<=74){
                    $predikat = '2.33';
                }elseif ($tmp<=79){
                    $predikat = '2.66';
                }elseif ($tmp<=84){
                    $predikat = '3.00';
                }elseif ($tmp<=90){
                    $predikat = '3.33';
                }elseif ($tmp<=95){
                    $predikat = '3.66';
                }elseif ($tmp<=100){
                    $predikat = '4.00';
                }
    return $predikat;
}

function konversi_sma($tmp, $arr)
{
    $predikat = "";
                if($tmp==0) {
					$predikat = array('-', '-');
				}elseif($tmp<=1.00){
                    $predikat = array('D', 'Kurang Baik');
                }elseif ($tmp<=1.33){
                    $predikat = array('D+', 'Kurang Baik');
                }elseif ($tmp<=1.66){
                    $predikat = array('C-', 'Cukup Baik');
                }elseif ($tmp<=2.00){
                    $predikat = array('C', 'Cukup Baik');
                }elseif ($tmp<=2.33){
                    $predikat = array('C+', 'Cukup Baik');
                }elseif ($tmp<=2.66){
                    $predikat = array('B-', 'Baik');
                }elseif ($tmp<=3.00){
                    $predikat = array('B', 'Baik');
                }elseif ($tmp<=3.33){
                    $predikat = array('B+', 'Baik');
                }elseif ($tmp<=3.66){
                    $predikat = array('A-', 'Sangat Baik');
                }elseif ($tmp<=4.00){
                    $predikat = array('A', 'Sangat Baik');
                }
                if ($arr == 0) {
                  return $predikat[0];
                }else {
                  return $predikat[1];
                }
}
function konversi_predikat_smp_k13($tmp, $arr)
{
  $predikat;
  if ($tmp <= 55) {
    $predikat = array('D', 'kurang baik.');
  }
  elseif ($tmp <= 70) {
    $predikat = array('C', 'cukup baik.');
  }
  elseif ($tmp <= 85) {
    $predikat = array('B', 'baik.');
  }
  elseif ($tmp <= 100) {
    $predikat = array('A', 'sangat baik.');
  }
  if ($arr == 0) {
    return $predikat[0];
  } else {
    return $predikat[1];
  }
}
function konversi($tmp, $arr)
{
    $predikat;
    if ($tmp<=0.01) {
      $predikat = array('-', '-');
    }elseif($tmp<=1.17){
      $predikat = array('D', 'Kurang');
    }elseif ($tmp<=1.50){
        $predikat = array('D+', 'Kurang');
    }elseif ($tmp<=1.84){
        $predikat = array('C-', 'Cukup');
    }elseif ($tmp<=2.17){
        $predikat = array('C', 'Cukup');
    }elseif ($tmp<=2.50){
        $predikat = array('C+', 'Cukup');
    }elseif ($tmp<=2.84){
        $predikat = array('B-', 'Baik');
    }elseif ($tmp<=3.17){
        $predikat = array('B', 'Baik');
    }elseif ($tmp<=3.50){
        $predikat = array('B+', 'Baik');
    }elseif ($tmp<=3.84){
        $predikat = array('A-', 'Sangat Baik');
    }elseif ($tmp<=4){
        $predikat = array('A', 'Sangat Baik');
    }
    if ($arr == 0) {
      return $predikat[0];
    }else {
      return $predikat[1];
    }
}

function konversi_sikap($tmp)
{
    $predikat = "";
                if($tmp==0){
                    $predikat = '-';
                }elseif($tmp<=37.5){
                    $predikat = 'K';
                }elseif ($tmp<=62.5){
                    $predikat = 'C';
                }elseif ($tmp<=87.5){
                    $predikat = 'B';
                }elseif ($tmp<=100){
                    $predikat = 'SB';
                }
    return $predikat;
}
function konversi_sikap_sma($tmp)
{
    $predikat = "";
                if($tmp==0){
                    $predikat = '-';
                }elseif($tmp<=59){
                    $predikat = 'K';
                }elseif ($tmp<=74){
                    $predikat = 'C';
                }elseif ($tmp<=90){
                    $predikat = 'B';
                }elseif ($tmp<=100){
                    $predikat = 'SB';
                }
    return $predikat;
}
?>
<title>Raport</title>
<style>
@font-face {
  font-family: Arial;
  src: url(<?php echo base_url() ?>/edusis_asset/fonts/arial.ttf);
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
<body>
  <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
        <?php
        $a  = 0;
        $i  = 1;
        $jmlkgn = 0;

		$jmh_mp = $hasilbelajar->num_rows();

        $kolom1 = "";
        $kolom2 = "";
		foreach($hasilbelajar->result() as $row)
        {
          $kgn    		= ($row->kgn=='0') ? '0' : $row->kgn;
          $tmp_kgn   		= $row->kgn*4/100;
          $empatskala_kgn	= konversi_sma_4skala($kgn);
          //$predikat = konversi($tmp);
            $bg = ($i%2==0) ? ' class="bg" ' : '';
//            if($a==0)
//            {
				$kolom1 .= '<tr'.$bg.'>';
        $kolom1 .= '<td></td>';
				$kolom1 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid black;">'.$i.'</td>';
				$kolom1 .= '<td style="border:1px solid black;font-size: 0.8em/1.5;line-height:13px;padding:5px;">'.$row->nm_mp.'</td>';

				if ($kd_sekolah=='04')
                {
					$kolom1 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">  '. $empatskala_kgn .'</td>';
					$kolom1 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konversi_sma($empatskala_kgn, 0).'</td>';
          $kolom1 .= "<td style='border:1px solid black;text-align: center;font-size: 0.8em/1.5'>".konversi_sma($empatskala_kgn, 1)."</td>";
				} else {
					$kolom1 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">  '. $row->kgn*4/100 .'</td>';
					$kolom1 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konversi_predikat_smp_k13($kgn, 0).'</td>';
          $kolom1 .= "<td style='padding:5px;border:1px solid black;text-align: left;font-size: 0.8em/1.5'>Menguasai semua kompetensi dasar dengan ".konversi_predikat_smp_k13($kgn, 1)."</td>";
				}
                    $jmlkgn += $row->kgn;
					$psk 		   	= ($row->psk=='0') ? '0' : $row->psk;
                    $tmp_psk	   	= $row->psk*4/100;
					$empatskala_psk	= konversi_sma_4skala($psk);
                    //$predikat = konversi($tmp);
                if ($kd_sekolah=='04')
                {
					$kolom1 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'. $empatskala_psk .'</td>';
					$kolom1 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konversi_sma($empatskala_psk, 0).'</td>';
                } else {
                  $nliKtrpl = $row->psk*4/100;
                  if ($nliKtrpl <= 0) {
                    $nliKtrpl = '-';
                  }
                  else {
                    $nliKtrpl = $nliKtrpl;
                  }
					$kolom1 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'. $nliKtrpl .'</td>';
					$kolom1 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konversi($tmp_psk, 0).'</td>';
				}
					$predikat = konversi_sikap($row->afk);
				if ($kd_sekolah=='04')
                {
					$kolom1 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konversi_sma($empatskala_psk, 1).'</td>';
				} else {
          if ($row->comment == '') {
            $kolom1 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5;padding:5px;">-</td>';
          } else {
            $kolom1 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5;text-align:left;padding:5px;">'.$row->comment.'</td>';
          }
				}
                $kolom1 .= '</tr>';
//            }
//			else
//            {
//                echo '<tr'.$bg.'>';
//                echo '<td width="3%" align="center">'.$i.'</td>';
//                echo '<td width="22%">'.$row->nm_mp.'</td>';
//                echo '<td width="4%" align="center"> '. $row->kgn*4/100 .'</td>';
//
//                $kgn    = ($row->kgn=='0') ? '0' : $row->kgn;
//                $tmp   =$row->kgn*4/100;
//                $predikat = konversi($tmp);
//
//                echo '<td width="4%" align="center">'. $predikat .'</td>';
//                $jmlkgn += $row->kgn;
//    			echo '<td width="4%" align="center">'. $row->psk*4/100 .'</td>';
//                $tmp   =$row->psk*4/100;
//                $predikat = konversi($tmp);
//                echo '<td width="4%" align="center">'. $predikat .'</td>';
//
//                $predikat = konversi_sikap($row->afk);
//                echo '<td width="4%" align="justify">'. $predikat .'</td>';
//                echo '</tr>';
//            }
            $i++;
            $a++;
        } }
        ?>
<div class="wrapper">
  <table align="center" border="0" style="width: 95%; font-size: 0.8em/1.5;font-family:'Arial', sans-serif;">
     <tr>
       <td width="25%" style="font-size: 0.8em/1.5">Nama Sekolah</td>
       <td width="35%" style="font-size: 0.8em/1.5">: <?php echo $nama_sekolah; ?></td>
       <td width="25%" style="font-size: 0.8em/1.5">Kelas</td>
       <td width="20%" style="font-size: 0.8em/1.5">: <?php echo str_replace('+',' ',$this->uri->segment(3));?></td>
     </tr>
     <tr>
       <td style="font-size: 0.8em/1.5">Alamat</td>
       <td style="font-size: 0.8em/1.5">: <?php echo $alamat_sekolah; //$sekolah->row()->alamat_sekolah; ?></td>
       <td style="font-size: 0.8em/1.5">Semester</td>
       <td style="font-size: 0.8em/1.5">: <?php echo $this->session->userdata('kd_semester');?></td>
     </tr>
     <tr>
       <td style="font-size: 0.8em/1.5">Nama Peserta Didik</td>
       <td style="font-size: 0.8em/1.5">: <?php echo $datasiswa->row()->nama_lengkap;?></td>
       <td style="font-size: 0.8em/1.5">Tahun Pelajaran</td>
       <td style="font-size: 0.8em/1.5">: <?php echo $this->session->userdata('th_ajar');?></td>
     </tr>
     <tr>
         <td  style="font-size: 0.8em/1.5">Nomor Induk/NISN</td>
       <td  style="font-size: 0.8em/1.5">: <?php echo $datasiswa->row()->nis; ?></td>
     </tr>
  </table>
  <table align="center" style="width: 95%; font: 0.8em/1.5 'Arial', sans-serif;">
    <tr><td colspan="3" style="padding-top: 10px;padding-bottom: 10px;font-weight: bold;font-size: 0.8em/1.5">A. Sikap</td></tr>
    <tr>
      <td style="width: 2%;"></td>
      <td colspan="2" style="padding-bottom: 5px;font-weight: bold;font-size: 0.8em/1.5">&nbsp;1. Sikap Spiritual</td>
    </tr>
    <tr>
      <td style="width: 1%;"></td>
      <td style="width: 1%;"></td>
      <td style="width: 98%;"><div class="capital" style="padding: 10px;border: 1px solid black; width: 100%;font-size: 0.8em/1.5">
      Deskripsi:<br />
      <p>

      <?php
      foreach ($sikap as $key => $value) {
        echo $value->comment_spiritual;
        break;
      };
      ?>
    </p>
    </div></td>
    </tr>
    <tr>
      <td style="width: 2%;"></td>
      <td colspan="2" style="font-weight: bold;padding: 5px 0;font-size: 0.8em/1.5">&nbsp;2. Sikap Sosial</td>
    </tr>
    <tr>
      <td style="width: 1%;"></td>
      <td style="width: 1%;"></td>
      <td style="width: 98%;">
        <?php foreach ($sikap as $key => $value) {
          # code...
        } ?>
        <div class="capital" style="padding: 10px;border: 1px solid black; width: 100%;font-size: 0.8em/1.5">
        Deskripsi:<br />
        <p>
        </p>
        </div>
      </td>
    </tr>
  </table>
  <table id="tabel_nilai" align="center" style="width: 95%; font-family: 'Arial', sans-serif;border-collapse: collapse">
    <tr>
      <td colspan="9" style="font-size: 0.8em/1.5;font-weight:bold; padding: 10px 0px 10px;">B. Pengetahuan dan Keterampilan</td>
    </tr>
    <tr>
      <td></td>
      <td colspan="8" style="font-size: 0.8em/1.5;font-weight:bold; padding: 0px 0 10px;">Ketuntasan Belajar Minimal</td>
    </tr>
    <thead>
      <tr style="text-align:center; font-weight:bold;">
        <td style="width:0.7%;"></td>
        <td rowspan="2" style="border:1px solid black;font-size: 0.8em/1.5;width:1.4%; height:52.913385827px;">No.</td>
        <td rowspan="2" style="border:1px solid black;width:5.5%; font-size: 0.8em/1.5;">Mata<br />Pelajaran</td>
        <td colspan="3" style="border:1px solid black;font-size: 0.8em/1.5;">Pengetahuan</td>
        <td colspan="3" style="font-size: 0.8em/1.5;border:1px solid black;">Keterampilan</td>
      </tr>
      <tr style="text-align:center;font-weight:bold;">
        <td> &nbsp;</td>
        <td style="width:2.5%; font-size: 0.8em/1.5;border:1px solid black;padding: -15px 0;">Angka</td>
        <td style="width:2.5%; font-size: 0.8em/1.5;border:1px solid black;">Predi<br />kat</td>
        <td style="width:6%; font-size: 0.8em/1.5;border:1px solid black;">Deskripsi</td>
        <td style="width:2.5%; font-size: 0.8em/1.5;border:1px solid black;">Angka</td>
        <td style="width:2.5%; font-size: 0.8em/1.5;border:1px solid black;">Predi<br />kat</td>
        <td style="width:6%; font-size: 0.8em/1.5;border:1px solid black;">Deskripsi</td>
      </tr>
    </thead>
    <tbody>
      <?php echo trim($kolom1); ?>
    </tbody>
  </table>
  <?php
  if ($i <= 14) {
    echo '<table style="page-break-before:always;width: 95%; font-family: Arial, sans-serif;border-collapse: collapse;" align="center">';
  }
  else
  {
    echo '<table style="width: 95%; font-family: Arial, sans-serif;border-collapse: collapse;" align="center">';
  }
  ?>
    <tr>
      <td style="font-weight: bold;font-size: 0.8em/1.5;padding: 10px 4px 10px 0;">C.</td>
      <td style="font-weight: bold;font-size: 0.8em/1.5;padding: 10px 0px;" colspan="3">Ekstrakurikuler</td>
    </tr>
    <tr>
      <th></th>
      <th style="height:37.795275591px;text-align:center;font-size:0.8em/1.5;border:1px solid black;">No.</th>
      <th style="padding:10px 0;border:1px solid black;font-size:0.8em/1.5;">Kegiatan Ekstrakurikuler</th>
      <th style="border:1px solid black;font-size:0.8em/1.5;">Keterangan</th>
    </tr>
      <?php
                  $ii = 1;
                  foreach($eskul->result() as $row)
                  {
  //                    $kd = (trim($row->kd_pribadi)=='KSP' || trim($row->kd_pribadi)=='KBSH' || trim($row->kd_pribadi)=='KDSP') ? 'a' : 'b';
  //                    if($kd == 'a')
  //                    {
                      $bg = ($ii%2==0) ? ' class="bg" ' : '';
                      echo '<tr'.$bg.'>';
                      echo '<td style="width:0.7%;"></td>';
                      echo '<td align="center" style="height:28.346456693px;border:1px solid black;width: 0.5%;font-size:0.8em/1.5;">'.$ii.'</td>';
                      echo '<td style="border:1px solid black;width:40%;padding-left: 5px;font-size:0.8em/1.5;">'.$row->nm_eskul.'</td>';
                      $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
                      echo '<td style="text-align:center;border:1px solid black;font-size:0.8em/1.5;">'.$nilai.'</td>';
                      echo '</tr>';
                      $ii++;
                      //}
                  }
                  if ($ii == 2) {
                    echo '<tr style="text-align:center;">';
                    echo "<td></td>";
                    echo '<td style="border:1px solid black;width: 0.5%;font-size:0.8em/1.5;">'.$ii.'</td>';
                    echo '<td style="border:1px solid black;"> - </td>';
                    echo '<td style="border:1px solid black;"> - </td>';
                    echo '</tr>';
                  }
                  if ($ii == 1) {
                    echo '<tr style="text-align:center;">';
                    echo "<td></td>";
                    echo '<td style="border:1px solid black;width: 0.5%;">1</td>';
                    echo '<td style="border:1px solid black;"> - </td>';
                    echo '<td style="border:1px solid black;"> - </td>';
                    echo '</tr>';
                    echo '<tr style="text-align:center;">';
                    echo "<td></td>";
                    echo '<td style="border:1px solid black;">2</td>';
                    echo '<td style="border:1px solid black;"> - </td>';
                    echo '<td style="border:1px solid black;"> - </td>';
                    echo '</tr>';
                  }
              ?>
  </table>
  <table style="width: 95%; font-family: 'Arial', sans-serif;margin-top:10px;" align="center">
    <tr>
      <?php if ($p_nl != '1') {
        echo '<td style="width: 46.35%;"><table style="width:98%;border-collapse:collapse;">';
      }
      else {
        echo '<td style="width: 100%;"><table style="width:100%;border-collapse:collapse;">';
      }
      ?>
        <tr>
          <?php if ($p_nl != '1') {
            echo '<td style="font-size: 0.8em/1.5;font-weight:bold;" height="43px">D.</td>';
            echo '<td colspan="3" style="font-size: 0.8em/1.5;font-weight:bold;" height="43px">Ketidakhadiran</td>';
          }
          else {
            echo '<td style="font-size: 0.8em/1.5;font-weight:bold;padding-bottom:10px;">D.</td>';
            echo '<td colspan="3" style="font-size: 0.8em/1.5;font-weight:bold;padding-bottom:10px;">Ketidakhadiran</td>';
          }
          ?>
        </tr>
        <tr>
            <?php if ($p_nl != '1') {
              echo '<td style="width:5%;"></td>';
            }
            else {
              echo '<td style="width:1%;"></td>';
            } ?>
            <td style="font-size: 0.8em/1.5;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;padding:5px 5px 5px 10px;">Sakit</td>
            <td style="font-size: 0.8em/1.5;border-top: 1px solid black;border-bottom: 1px solid black;text-align:center;">:</td>
            <td style="font-size: 0.8em/1.5;text-align:center;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><?php $a=($absens->row()->alfa == '0') ? '-' : $absens->row()->alfa; echo $a; ?> Hari</td>
        </tr>
        <tr>
            <td></td>
            <td style="padding:5px 5px 5px 10px;font-size: 0.8em/1.5;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;">Ijin</td>
            <td style="font-size: 0.8em/1.5;border-top: 1px solid black;border-bottom: 1px solid black;text-align:center;">:</td>
            <td style="font-size: 0.8em/1.5;text-align:center;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;text-align:center;"><?php $a=($abseni->row()->alfa == '0') ? '-' : $abseni->row()->alfa; echo $a; ?> Hari</td>
        </tr>
        <tr>
            <td></td>
            <td style="padding:5px 5px 5px 10px;font-size: 0.8em/1.5;border-left: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;text-align:left;">Tanpa Keterangan</td>
            <td style="font-size: 0.8em/1.5;border-top: 1px solid black;border-bottom: 1px solid black;text-align:center;">:</td>
            <td style="font-size: 0.8em/1.5;text-align:center;border-right: 1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;text-align:center;"><?php $a=($abseina->row()->alfa == '0') ? '-' : $abseina->row()->alfa; echo $a; ?> Hari</td>
        </tr>
      </table></td>
      <?php
      if ($p_nl != '1') {
      ?>
      <td><table style="border:1px solid black;padding:5px;">
        <tr>
          <td colspan="3" style="font-weight:bold;font-size: 0.8em/1.5">Keputusan:</td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 0.8em/1.5">Berdasarkan pencapaian kompetensi pada semester ke-1 dan ke-2, siswa ditetapkan*)</td>
        </tr>
        <tr>
          <?php
            echo '<td style="font-size: 0.8em/1.5:height:100px;">naik ke kelas</td>';
            echo "<td style='font-size: 0.8em/1.5;text-align:center;'>...........</td>";
            echo '<td style="font-size: 0.8em/1.5">(..................................)</td>';
           ?>
        </tr>
        <tr>
          <td style="font-size: 0.8em/1.5">tinggal di kelas</td>
          <td style="font-size: 0.8em/1.5;text-align:center;">...........</td>
          <td style="font-size: 0.8em/1.5">(..................................)</td>
        </tr>
        <tr>
          <td colspan="3" style="font-size: 0.8em/1.5">*) Coret yang tidak perlu.</td>
        </tr>
      </table></td>
      <?php
      }
      ?>
    </tr>
  </table>
<!----------------------------------------------------------------------------------------------------------
  <table style="margin-top:10px;border-collapse:collapse;width: 95%; font-family: 'Arial', sans-serif;" align="center">
    <tr>
      <td colspan="4" style="font-weight: bold;font-size: 0.8em/1.5;padding-bottom:15px;">E. Prestasi</td>
    </tr>
    <tr style="text-align:center;">
      <td style="width:4.9%;"></td>
      <td style="font-weight: bold;font-size: 0.8em/1.5;height:34.015748031px;width:4.5%;border:1px solid black;">No.</td>
      <td style="border:1px solid black;width:40%;font-weight: bold;font-size: 0.8em/1.5;">Jenis Prestasi</td>
      <td style="border:1px solid black;font-weight: bold;font-size: 0.8em/1.5;">Keterangan</td>
    </tr>
    <?php
    $seq = 1;
    foreach($prestasi->result() as $row)
    {
        $bg = ($seq%2==0) ? ' class="bg" ' : '';
        echo '<tr'.$bg.'>';
        echo "<td></td>";
        echo '<td style="text-align:center;border:1px solid black;font-size: 0.8em/1.5;">'.$row->kd_prestasi.'</td>';
        echo '<td style="border:1px solid black;font-size: 0.8em/1.5;padding: 0 0 3px 5px;">'.$row->nm_prestasi.'</td>';
        echo '<td style="border:1px solid black;font-size: 0.8em/1.5;padding: 0 0 3px 5px;">'.$row->ket.'</td>';
        echo '</tr>';
        $seq++;
    }
    if ($seq == 2)
    {
      echo '<tr style="text-align:center;">';
      echo "<td></td>";
      echo "<td style='text-align:center;border:1px solid black;font-size: 0.8em/1.5;'>$seq</td>";
      echo "<td style='border:1px solid black;font-size: 0.8em/1.5;padding: 0 0 3px 5px;'> - </td>";
      echo "<td style='border:1px solid black;font-size: 0.8em/1.5;padding: 0 0 3px 5px;'> - </td>";
      echo "</tr>";
    }
    if ($seq == 1) {
      echo '<tr style="text-align:center;">';
      echo "<td></td>";
      echo "<td style='text-align:center;border:1px solid black;font-size: 0.8em/1.5;'>1</td>";
      echo "<td style='border:1px solid black;font-size: 0.8em/1.5;padding: 0 0 3px 5px;'> - </td>";
      echo "<td style='border:1px solid black;font-size: 0.8em/1.5;padding: 0 0 3px 5px;'> - </td>";
      echo "</tr>";
      echo "<tr style='text-align:center;'>";
      echo "<td></td>";
      echo "<td style='border:1px solid black;font-size: 0.8em/1.5;'>2</td>";
      echo "<td style='border:1px solid black;font-size: 0.8em/1.5;padding: 0 0 3px 5px;'> - </td>";
      echo "<td style='border:1px solid black;font-size: 0.8em/1.5;padding: 0 0 3px 5px;'> - </td>";
      echo "</tr>";
    }
    ?>
  </table>
  <table style="border-collapse:collapse;width: 95%; font-family: 'Arial', sans-serif;margin-top:10px;" align="center">
    <tr>
      <td style="font-weight: bold;font-size: 0.8em/1.5; padding: 0 0px 10px;" colspan="2">F. Catatan Wali Kelas</td>
    </tr>
    <tr>
      <td style="width:4.7%;"></td>
      <?php
      $vall = 1;
      $valll;
      foreach ($catatan_siswa as $key => $value) {
        if ($value->comment != '') {
          echo '<td><div style="border:1px solid black;padding:10px;width:100%;font-size: 0.8em/1.5;">'.$value->comment.'</div></td>';
          $vall++;
        }
        break;
      }
      if ($vall == 1) {
        echo '<td style="height:100px;width:100%;border:1px solid black;text-align:center;"></td>';
      }
      ?>
    </tr>
  </table>
------------------------------->
  <table style="border-collapse:collapse;width: 95%; font-family: 'Arial', sans-serif;" align="center">
    <tr>
      <td style="width:1%;font-weight: bold;font-size: 0.8em/1.5; padding: 10px 3px 15px 2px;">E.</td>
      <td colspan="2" style="font-weight: bold;font-size: 0.8em/1.5; padding: 10px 0px 15px;">Tanggapan Orang Tua</td>
    </tr>
  </table>
  <div style="border:1px solid black;width:93%;height:100px;margin-left:36px;"></div>
  <table style="border-collapse:collapse;width: 90%; font-family:0.8em/1.5 "Arial", sans-serif;padding-top:20px;" align="center">
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
      <td colspan="5" style="text-align:right;font-size: 0.8em/1.5;padding-top:20px;padding-right:26px;"></td>
    </tr>
    <tr>
      <td colspan="2" style="font-size: 0.8em/1.5">Mengetahui</td>
      <td colspan="2" style="font-size: 0.8em/1.5">Mengetahui</td>
      <td style="font-size: 0.8em/1.5"><?php echo $sekolah->row()->kabupaten;?>, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?></td>
    </tr>
    <tr>
      <td style="font-size: 0.8em/1.5">Orang Tua/Wali,</td>
      <td></td>
      <td style="font-size: 0.8em/1.5">Kepala Sekolah,</td>
      <td></td>
      <td style="width:25%;font-size: 0.8em/1.5">Wali Kelas,</td>
    </tr>
    <tr>
      <td style="height:50px;"></td>
      <td colspan="2"></td>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="2" style="font-size: 0.8em/1.5"><?php echo $datasiswa->row()->ayah_nama; ?></td>
      <td colspan="2" style="font-size: 0.8em/1.5"><?php echo $kepsek->row()->nama_lengkap;?></td>
      <td style="font-size: 0.8em/1.5"><?php foreach ($walikelas as $key => $value) {
        echo $value->nama_lengkap;
      } ?></td>
    </tr>
    <tr>
      <td colspan="2" style="font-size: 0.8em/1.5"></td>
      <td colspan="2" style="font-size: 0.8em/1.5">NIP. <?php foreach ($walikelas as $key => $value) {
        echo $value->wali_kelas;
      } ?></td>
      <td style="font-size: 0.8em/1.5">NIP. <?php echo $kepsek->row()->nip; ?></td>
    </tr>
  </table>
</div>
</body>
</html>
