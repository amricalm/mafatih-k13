<html>
<head>
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" /><!-- WRITE YOUR CSS CODE HERE -->
<title style="text-transform: uppercase;">LEDGER KETERAMPILAN <?php echo $kelas ?></title>
<style>
  @media all {*{
    font-family: Calibri, sans-serif;
    font-size: 9pt;
  }
  }
</style>
</head>
<?php
  function konversi($tmp)
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
<body>
  <table style="width: 100%;font-size: 11px;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" rowspan="4" ><img src="edusis_asset/edusisimg/mafatih.jpg"/></td>
        <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $nama_sekolah ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>PENILAIAN KETERAMPILAN SEMESTER <?php echo $p_nl ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
    </tr>
    
    <tr>
        <td align="left" colspan="2" >&nbsp;</td>
    </tr>
    <tr>
        <td style="width:14%;font-size: 11px;">Mata Pelajaran<br /></td>
        <td style="width:1%;font-size: 11px;">:<br /></td>
        <td style="width:89%;font-size: 11px;"><?php echo $mp->row()->nm_mp; ?><br /></td>
    </tr>
    <tr>
        <td style="font-size: 11px;">Kelas</td>
        <td style="font-size: 11px;">:</td>
        <td style="font-size: 11px;"><?php echo str_replace('+',' ',$this->uri->segment(3)); ?></td>
    </tr>
  </table>
  <table style="border-collapse:collapse;width:100%;text-align:center;">
    <thead style="background: #E1E1E1; font-weight:bold;">
      <tr>
        <td rowspan="3" style="border:1px solid black; vertical-align:middle;width: 5px;">NO</td>
        <td rowspan="3" style="border:1px solid black; vertical-align:middle;width: 80px;">NIS</td>
        <td rowspan="3" style="border:1px solid black; vertical-align:middle;width: 200px;">NAMA SISWA</td>
        <?php
          foreach($hasilbelajar as $row) {
          $sum = 0;
          foreach($kompetensi->result() as $rowKd) {
            if ($this->session->userdata('sub_pnl')=='UTS') {
              $s = 0;
              $arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
              foreach ($arrPsk as $rowPsk) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk.'_uts';
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              $sum+= $s;
            } else {
              $s = 0;
              $arrKin = array('kin1','kin2');
              $arrPrj = array('prj1','prj2');
              $arrPor = array('por1','por2');
              foreach ($arrKin as $rowKin) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowKin.'_uts';
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              foreach ($arrKin as $rowKin) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowKin;
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              foreach ($arrPrj as $rowPrj) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPrj.'_uts';
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              foreach ($arrPrj as $rowPrj) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPrj;
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              foreach ($arrPor as $rowPor) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPor.'_uts';
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              foreach ($arrPor as $rowPor) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPor;
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              $sum+= $s;

            }
          }
          if ($sum != 0) {
            echo '<td colspan="'.$sum.'" style="border:1px solid black; width: 720px;">PENILAIAN HARIAN '.strtoupper($mp->row()->nm_mp).'</td>';                  
          } else {
            echo '<td colspan="'.$sum.'" style="border:1px solid black; height: 78px; vertical-align: middle;">PENILAIAN HARIAN '.strtoupper($mp->row()->nm_mp).'</td>';
          }
          break;
        }
        ?>
      </tr>
      <tr>
        <?php
          foreach($hasilbelajar as $row) {
          foreach($kompetensi->result() as $rowKd) {
            if ($this->session->userdata('sub_pnl')=='UTS') {
              $s = 0;
              $arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
              foreach ($arrPsk as $rowPsk) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk.'_uts';
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              echo '<td colspan="'.$s.'" style="border:1px solid black;">'.$rowKd->kd_kd.'</td>';
            } else {
              $s      = 0;
              $colKd  = 0;
              $arrKin = array('kin1','kin2');
              $arrPrj = array('prj1','prj2');
              $arrPor = array('por1','por2');
              foreach ($arrKin as $rowKin) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowKin.'_uts';
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              foreach ($arrKin as $rowKin) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowKin;
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              foreach ($arrPrj as $rowPrj) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPrj.'_uts';
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              foreach ($arrPrj as $rowPrj) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPrj;
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              foreach ($arrPor as $rowPor) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPor.'_uts';
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              foreach ($arrPor as $rowPor) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPor;
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  $s++;
                }
              }
              $colKd+= $s;
              echo '<td colspan="'.$colKd.'" style="border:1px solid black;">'.$rowKd->kd_kd.'</td>';
            }
          }
          break;
        }
        ?>
      </tr>
      <tr>
        <?php
          foreach($hasilbelajar as $row) {
          foreach($kompetensi->result() as $rowKd) {
            if ($this->session->userdata('sub_pnl')=='UTS') {
              $arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
              foreach ($arrPsk as $rowPsk) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk.'_uts';
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  echo '<td style="border:1px solid black;width:1%;text-transform: uppercase;">'.$rowKin.'</td>';
                }
              }
            } else {
              $arrKin = array('kin1','kin2');
              $arrPrj = array('prj1','prj2');
              $arrPor = array('por1','por2');
              foreach ($arrKin as $rowKin) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowKin.'_uts';
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  echo '<td style="border:1px solid black;width:1%;text-transform: uppercase;">'.$rowKin.'</td>';
                }
              }
              foreach ($arrKin as $rowKin) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowKin;
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  echo '<td style="border:1px solid black;width:1%;text-transform: uppercase;">'.$rowKin.'</td>';
                }
              }
              foreach ($arrPrj as $rowPrj) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPrj.'_uts';
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  echo '<td style="border:1px solid black;width:1%;text-transform: uppercase;">'.$rowKin.'</td>';
                }
              }
              foreach ($arrPrj as $rowPrj) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPrj;
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  echo '<td style="border:1px solid black;width:1%;text-transform: uppercase;">'.$rowKin.'</td>';
                }
              }
              foreach ($arrPor as $rowPor) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPor.'_uts';
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  echo '<td style="border:1px solid black;width:1%;text-transform: uppercase;">'.$rowKin.'</td>';
                }
              }
              foreach ($arrPor as $rowPor) {
                $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPor;
                $hasil_nh_row = eval('return '.$nh_row.';');
                if (print_r($hasil_nh_row,1) != 0) {
                  echo '<td style="border:1px solid black;width:1%;text-transform: uppercase;">'.$rowKin.'</td>';
                }
              }
            }
          }
          break;
        }
        ?>
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
            $brs .= '<td style="border: 1px solid black;">'.$i.'</td>';
            $brs .= '<td style="border: 1px solid black;text-align:left;">'.$row->nis.'</td>';
            $brs .= '<td style="border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
            if ($this->session->userdata('sub_pnl')=='UTS') {
              foreach($kompetensi->result() as $rowKd) {
                $arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
                foreach ($arrPsk as $rowPsk) {
                    $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk.'_uts';
                  $hasil_nh_row = eval('return '.$nh_row.';');
                  if (print_r($hasil_nh_row,1) != 0) {
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                }
              }
            } else {
              foreach($kompetensi->result() as $rowKd) {
                //$arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
                $arrKin = array('kin1','kin2');
                $arrPrj = array('prj1','prj2');
                $arrPor = array('por1','por2');
                foreach ($arrKin as $rowKin) {
                  $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowKin.'_uts';
                  $hasil_nh_row = eval('return '.$nh_row.';');
                  if (print_r($hasil_nh_row,1) != 0) {
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                }
                foreach ($arrKin as $rowKin) {
                  $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowKin;
                  $hasil_nh_row = eval('return '.$nh_row.';');
                  if (print_r($hasil_nh_row,1) != 0) {
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                }
                foreach ($arrPrj as $rowPrj) {
                  $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPrj.'_uts';
                  $hasil_nh_row = eval('return '.$nh_row.';');
                  if (print_r($hasil_nh_row,1) != 0) {
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                }
                foreach ($arrPrj as $rowPrj) {
                  $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPrj;
                  $hasil_nh_row = eval('return '.$nh_row.';');
                  if (print_r($hasil_nh_row,1) != 0) {
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                }
                foreach ($arrPor as $rowPor) {
                  $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPor.'_uts';
                  $hasil_nh_row = eval('return '.$nh_row.';');
                  if (print_r($hasil_nh_row,1) != 0) {
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                }
                foreach ($arrPor as $rowPor) {
                  $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPor;
                  $hasil_nh_row = eval('return '.$nh_row.';');
                  if (print_r($hasil_nh_row,1) != 0) {
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                }
              }
            }
            
            $brs .= '</tr>';
            $i++;
          }
        }
        echo $brs;
      ?>
    </tbody>
  </table>
  <div style="page-break-before: always;">&nbsp;</div>
  <table style="width: 100%;font-size: 11px;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" rowspan="4" ><img src="edusis_asset/edusisimg/mafatih.jpg"/></td>
        <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $nama_sekolah ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>PENILAIAN KETERAMPILAN SEMESTER <?php echo $p_nl ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
    </tr>
    
    <tr>
        <td align="left" colspan="2" >&nbsp;</td>
    </tr>
    <tr>
        <td style="width:14%;font-size: 11px;">Mata Pelajaran<br /></td>
        <td style="width:1%;font-size: 11px;">:<br /></td>
        <td style="width:89%;font-size: 11px;"><?php echo $mp->row()->nm_mp; ?><br /></td>
    </tr>
    <tr>
        <td style="font-size: 11px;">Kelas</td>
        <td style="font-size: 11px;">:</td>
        <td style="font-size: 11px;"><?php echo str_replace('+',' ',$this->uri->segment(3)); ?></td>
    </tr>
  </table>
  <table style="border-collapse:collapse;width:100%;text-align:center;">
    <thead style="background: #E1E1E1; font-weight:bold;">
      <tr>
        <td rowspan="3" style="border:1px solid black; vertical-align:middle;width: 5px;">NO</td>
        <td rowspan="3" style="border:1px solid black; vertical-align:middle;width: 80px;">NIS</td>
        <td rowspan="3" style="border:1px solid black; vertical-align:middle;width: 200px;">NAMA SISWA</td>
            <?php
                $i = 0;
                foreach($kompetensi->result() as $rowKd) {
                  $i++;
                }
                $j = ($this->session->userdata('sub_pnl')=='UTS') ? $i * 3 : $i * 4;
                if ($j != 0) {
                  if ($this->session->userdata('sub_pnl')=='UTS') {
                    echo '<td colspan="'.$j.'" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">NILAI AKHIR = (2 x NH + PTS) / 3</td>';
                  } else {
                    echo '<td colspan="'.$j.'" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">NILAI AKHIR = (2 x NH + PTS + PAS) / 4</td>';
                  }
                } else {
                  if ($this->session->userdata('sub_pnl')=='UTS') {
                    echo '<td colspan="4" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">NILAI AKHIR = (2 x NH + PTS) / 3</td>';
                  } else {
                    echo '<td colspan="4" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">NILAI AKHIR = (2 x NH + PTS + PAS) / 4</td>';
                  }
                }
                
                
            ?>
            <td rowspan="3" colspan="2" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">NILAI RAPORT</td>
            <!-- <td rowspan="3" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold; text-align: left; padding-left: 30px;">DESKRIPSI</td> -->
          </tr>
          <tr>
            <?php
                $i = 0;
                foreach($kompetensi->result() as $rowKd) { 
                  $i++;
                }
                echo '<td colspan="'.$i.'" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">PENILAIAN HARIAN</td>';
                echo '<td colspan="'.$i.'" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">PTS</td>';
                if ($this->session->userdata('sub_pnl')=='UAS') {
                  echo '<td colspan="'.$i.'" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">PAS</td>';
                }
                echo '<td colspan="'.$i.'" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">NILAI AKHIR</td>';
              ?>
          </tr>
          <tr>
            <?php
              foreach($kompetensi->result() as $rowKd) {
                echo '<td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">'.$rowKd->kd_kd.'</td>';
              }
              foreach($kompetensi->result() as $rowKd) {
                echo '<td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">'.$rowKd->kd_kd.'</td>';
              }
              foreach($kompetensi->result() as $rowKd) {
                echo '<td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">'.$rowKd->kd_kd.'</td>';
              }
              if ($this->session->userdata('sub_pnl')=='UAS') {
                foreach($kompetensi->result() as $rowKd) {
                  echo '<td style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">'.$rowKd->kd_kd.'</td>';
                }
              }
            ?>

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
            $brs .= '<td style="border: 1px solid black;">'.$i.'</td>';
            $brs .= '<td style="border: 1px solid black;text-align:left;">'.$row->nis.'</td>';
            $brs .= '<td style="border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
            //==============================================Start UHT=========================================//
            //============================================== Peniliaan Harian ================================//
            foreach($kompetensi->result() as $rowKd) {
              $nhJmh_pts        = 0;
              $nhJmh_pas        = 0;
              $nhJmh            = 0;
              $kdDvdJmh_pts     = 0;
              $kdDvdJmh_pas     = 0;
              $kdDvdJmh         = 0;
              if ($this->session->userdata('sub_pnl')=='UTS') {
                $arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
                foreach ($arrPsk as $rowPsk) {
                  $nh_row           = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk.'_uts';
                  $hasil_nh     = eval('return '.$nh_row.';');
                  $nhJmh+= $hasil_nh;
                  $kdDvd = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $kdDvdJmh+= $kdDvd;
                }
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
              } else {
                $arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
                foreach ($arrPsk as $rowPsk) {
                  $nh_row           = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk.'_uts';
                  $hasil_nh     = eval('return '.$nh_row.';');
                  $nhJmh_pts+= $hasil_nh;
                  $kdDvd = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $kdDvdJmh_pts+= $kdDvd;
                }
                foreach ($arrPsk as $rowPsk) {
                  $nh_row           = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk;
                  $hasil_nh     = eval('return '.$nh_row.';');
                  $nhJmh_pas+= $hasil_nh;
                  $kdDvd = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $kdDvdJmh_pas+= $kdDvd;
                }
                $kdRt_pts = ($nhJmh_pts == 0 || $nhJmh_pts == '0' || $nhJmh_pts == '') ? 0 : $nhJmh_pts;
                $kdRt_pas = ($nhJmh_pas == 0 || $nhJmh_pas == '0' || $nhJmh_pas == '') ? 0 : $nhJmh_pas;
                $nhJmh    = $kdRt_pts + $kdRt_pas;
                $kdDvdJmh = $kdDvdJmh_pts + $kdDvdJmh_pas;
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
              }
              $brs .= '<td style="border:1px solid black;">'.round($kdRt).'</td>';
            }
            //======================================= End Peniliaan Harian ===================================//
            //===================================== Peniliaan Tengah Semester ================================//
            foreach($kompetensi->result() as $rowKd) {
              for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) {
                $pts_row       = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas_uts';
                $hasil_pts = eval('return '.$pts_row.';');
              }
              $brs .= '<td style="border:1px solid black;">'.$hasil_pts.'</td>';
            }
            //=================================== End Peniliaan Tengah Semester ================================//
            if ($this->session->userdata('sub_pnl')=='UAS') {
            //===================================== Penilaian Akhir Semester ===================================//
            foreach($kompetensi->result() as $rowKd) {
              for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) {
                $pas_row       = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas';
                $hasil_pas = eval('return '.$pas_row.';');
              }
              $brs .= '<td style="border:1px solid black;">'.$hasil_pas.'</td>';
            }
            //===================================== End Penilaian Akhir Semester ==============================//
            }
            //===================================== Nilai Akhir ===================================//
            $naJmh          = 0;
            $naDvdJmh       = 0;
            $getNaMax       = array();
            $getKetNaMax    = array();
            $k              = 0;
            $arrNaKd        = array();
            $arrKetKd       = array();
            foreach($kompetensi->result() as $rowKd) {
              $nhJmh_pts        = 0;
              $nhJmh_pas        = 0;
              $nhJmh            = 0;
              $kdDvdJmh_pts     = 0;
              $kdDvdJmh_pas     = 0;
              $kdDvdJmh         = 0;
              if ($this->session->userdata('sub_pnl')=='UTS') {
                $arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
                foreach ($arrPsk as $rowPsk) {
                  $nh_row     = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk.'_uts';
                  $pts_row    = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas_uts';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pts  = eval('return '.$pts_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh+= $hasil_nh;
                  $kdDvdJmh+= $kdDvd;
                }
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
                $naKd         = ((2 * $kdRt) + $hasil_pts) / 3;
              } else {
                $arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
                foreach ($arrPsk as $rowPsk) {
                  $nh_row     = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk.'_uts';
                  $pts_row    = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas_uts';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pts  = eval('return '.$pts_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh_pts+= $hasil_nh;
                  $kdDvdJmh_pts+= $kdDvd;
                }
                foreach ($arrPsk as $rowPsk) {
                  $nh_row     = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk;
                  $pas_row    = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pas  = eval('return '.$pas_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh_pas+= $hasil_nh;
                  $kdDvdJmh_pas+= $kdDvd;
                }
                $kdRt_pts = ($nhJmh_pts == 0 || $nhJmh_pts == '0' || $nhJmh_pts == '') ? 0 : $nhJmh_pts;
                $kdRt_pas = ($nhJmh_pas == 0 || $nhJmh_pas == '0' || $nhJmh_pas == '') ? 0 : $nhJmh_pas;
                $nhJmh    = $kdRt_pts + $kdRt_pas;
                $kdDvdJmh = $kdDvdJmh_pts + $kdDvdJmh_pas;
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
                $naKd         = ((2 * $kdRt) + $hasil_pts + $hasil_pas) / 4;
              }
              $kdDvd        = ($naKd == 0 || $naKd == '0' || $naKd == '') ? 0 : 1;
              $naJmh+= $naKd;
              $naDvdJmh+= $kdDvd;
              $brs .= '<td style="border:1px solid black;">'.round($naKd).'</td>';

              $arrNaKd[$k]    = $naKd;
              $arrKetKd[$k]   = $rowKd->ket_kd;
              $k++;
            }

            $naRt           = ($naJmh == 0 || $naJmh == '0' || $naJmh == '') ? 0 : $naJmh / $naDvdJmh;
            if ($k != 0) {
              $brs .= '<td style="border:1px solid black;">'.round($naRt).'</td>';
              $brs .= '<td style="border:1px solid black;">'.konversi(round($naRt)).'</td>';
              $arrComb = array_combine($arrNaKd, $arrKetKd);
              $naMax   = 0;
              foreach ($arrComb as $keyNaKd => $valKetKd) {
                if($keyNaKd == max(array_keys($arrComb))) {
                  $naMax = $valKetKd;
                } elseif($keyNaKd == min(array_keys($arrComb))) {
                  $naMin = $valKetKd;
                }
              }
              $filterNaMin = round(min(array_keys($arrComb)));
              if ($filterNaMin <= 70) {
                //$brs .= '<td style="border:1px solid black; text-align: left;">Ananda mampu '.$naMax.' perlu pembinaan dalam '.$naMin.'</td>';
              } else {
                //$brs .= '<td style="border:1px solid black; text-align: left;">Ananda mampu '.$naMax.'</td>';
              }
            }
            //===================================== End Nilai Akhir ==============================//
            $brs .= '</tr>';
            $i++;
          }
        }
        echo $brs;
      ?>
    </tbody>
  </table>
  <div style="page-break-before: always;">&nbsp;</div>
  <table style="width: 100%;font-size: 11px;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" rowspan="4" ><img src="edusis_asset/edusisimg/mafatih.jpg"/></td>
        <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $nama_sekolah ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>PENILAIAN KETERAMPILAN SEMESTER <?php echo $p_nl ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
    </tr>
    
    <tr>
        <td align="left" colspan="2" >&nbsp;</td>
    </tr>
    <tr>
        <td style="width:14%;font-size: 11px;">Mata Pelajaran<br /></td>
        <td style="width:1%;font-size: 11px;">:<br /></td>
        <td style="width:89%;font-size: 11px;"><?php echo $mp->row()->nm_mp; ?><br /></td>
    </tr>
    <tr>
        <td style="font-size: 11px;">Kelas</td>
        <td style="font-size: 11px;">:</td>
        <td style="font-size: 11px;"><?php echo str_replace('+',' ',$this->uri->segment(3)); ?></td>
    </tr>
  </table>
  <table style="border-collapse:collapse;width:100%;text-align:center;">
    <thead style="background: #E1E1E1; font-weight:bold;">
      <tr>
        <td style="border:1px solid black; vertical-align:middle;width: 5px;">NO</td>
        <td style="border:1px solid black; vertical-align:middle;width: 80px;">NIS</td>
        <td style="border:1px solid black; vertical-align:middle;width: 200px;">NAMA SISWA</td>
        <td style="border:1px solid black; vertical-align:middle;">DESKRIPSI</td>
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
            $brs .= '<td style="border: 1px solid black;">'.$i.'</td>';
            $brs .= '<td style="border: 1px solid black;text-align:left;">'.$row->nis.'</td>';
            $brs .= '<td style="border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
            //==============================================Start UHT=========================================//
            //============================================== Peniliaan Harian ================================//
            foreach($kompetensi->result() as $rowKd) {
              $nhJmh_pts        = 0;
              $nhJmh_pas        = 0;
              $nhJmh            = 0;
              $kdDvdJmh_pts     = 0;
              $kdDvdJmh_pas     = 0;
              $kdDvdJmh         = 0;
              if ($this->session->userdata('sub_pnl')=='UTS') {
                $arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
                foreach ($arrPsk as $rowPsk) {
                  $nh_row           = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk.'_uts';
                  $hasil_nh     = eval('return '.$nh_row.';');
                  $nhJmh+= $hasil_nh;
                  $kdDvd = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $kdDvdJmh+= $kdDvd;
                }
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
              } else {
                $arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
                foreach ($arrPsk as $rowPsk) {
                  $nh_row           = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk.'_uts';
                  $hasil_nh     = eval('return '.$nh_row.';');
                  $nhJmh_pts+= $hasil_nh;
                  $kdDvd = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $kdDvdJmh_pts+= $kdDvd;
                }
                foreach ($arrPsk as $rowPsk) {
                  $nh_row           = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk;
                  $hasil_nh     = eval('return '.$nh_row.';');
                  $nhJmh_pas+= $hasil_nh;
                  $kdDvd = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $kdDvdJmh_pas+= $kdDvd;
                }
                $kdRt_pts = ($nhJmh_pts == 0 || $nhJmh_pts == '0' || $nhJmh_pts == '') ? 0 : $nhJmh_pts;
                $kdRt_pas = ($nhJmh_pas == 0 || $nhJmh_pas == '0' || $nhJmh_pas == '') ? 0 : $nhJmh_pas;
                $nhJmh    = $kdRt_pts + $kdRt_pas;
                $kdDvdJmh = $kdDvdJmh_pts + $kdDvdJmh_pas;
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
              }
              //$brs .= '<td style="border:1px solid black;">'.round($kdRt).'</td>';
            }
            //======================================= End Peniliaan Harian ===================================//
            //===================================== Peniliaan Tengah Semester ================================//
            foreach($kompetensi->result() as $rowKd) {
              for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) {
                $pts_row       = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas_uts';
                $hasil_pts = eval('return '.$pts_row.';');
              }
             // $brs .= '<td style="border:1px solid black;">'.$hasil_pts.'</td>';
            }
            //=================================== End Peniliaan Tengah Semester ================================//
            if ($this->session->userdata('sub_pnl')=='UAS') {
            //===================================== Penilaian Akhir Semester ===================================//
            foreach($kompetensi->result() as $rowKd) {
              for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) {
                $pas_row       = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas';
                $hasil_pas = eval('return '.$pas_row.';');
              }
              //$brs .= '<td style="border:1px solid black;">'.$hasil_pas.'</td>';
            }
            //===================================== End Penilaian Akhir Semester ==============================//
            }
            //===================================== Nilai Akhir ===================================//
            $naJmh          = 0;
            $naDvdJmh       = 0;
            $getNaMax       = array();
            $getKetNaMax    = array();
            $k              = 0;
            $arrNaKd        = array();
            $arrKetKd       = array();
            foreach($kompetensi->result() as $rowKd) {
              $nhJmh_pts        = 0;
              $nhJmh_pas        = 0;
              $nhJmh            = 0;
              $kdDvdJmh_pts     = 0;
              $kdDvdJmh_pas     = 0;
              $kdDvdJmh         = 0;
              if ($this->session->userdata('sub_pnl')=='UTS') {
                $arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
                foreach ($arrPsk as $rowPsk) {
                  $nh_row     = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk.'_uts';
                  $pts_row    = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas_uts';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pts  = eval('return '.$pts_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh+= $hasil_nh;
                  $kdDvdJmh+= $kdDvd;
                }
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
                $naKd         = ((2 * $kdRt) + $hasil_pts) / 3;
              } else {
                $arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
                foreach ($arrPsk as $rowPsk) {
                  $nh_row     = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk.'_uts';
                  $pts_row    = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas_uts';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pts  = eval('return '.$pts_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh_pts+= $hasil_nh;
                  $kdDvdJmh_pts+= $kdDvd;
                }
                foreach ($arrPsk as $rowPsk) {
                  $nh_row     = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk;
                  $pas_row    = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pas  = eval('return '.$pas_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh_pas+= $hasil_nh;
                  $kdDvdJmh_pas+= $kdDvd;
                }
                $kdRt_pts = ($nhJmh_pts == 0 || $nhJmh_pts == '0' || $nhJmh_pts == '') ? 0 : $nhJmh_pts;
                $kdRt_pas = ($nhJmh_pas == 0 || $nhJmh_pas == '0' || $nhJmh_pas == '') ? 0 : $nhJmh_pas;
                $nhJmh    = $kdRt_pts + $kdRt_pas;
                $kdDvdJmh = $kdDvdJmh_pts + $kdDvdJmh_pas;
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
                if ($hasil_pts == 0 || $hasil_pas == 0) {
                  $naKd         = ((2 * $kdRt) + $hasil_pts + $hasil_pas) / 3;
                } else {
                  $naKd         = ((2 * $kdRt) + $hasil_pts + $hasil_pas) / 4;
                }
              }
              $kdDvd        = ($naKd == 0 || $naKd == '0' || $naKd == '') ? 0 : 1;
              $naJmh+= $naKd;
              $naDvdJmh+= $kdDvd;
              //$brs .= '<td style="border:1px solid black;">'.round($naKd).'</td>';

              $arrNaKd[$k]    = $naKd;
              $arrKetKd[$k]   = $rowKd->ket_kd;
              $k++;
            }

            $naRt           = ($naJmh == 0 || $naJmh == '0' || $naJmh == '') ? 0 : $naJmh / $naDvdJmh;
            if ($k != 0) {
              //$brs .= '<td style="border:1px solid black;">'.round($naRt).'</td>';
              //$brs .= '<td style="border:1px solid black;">'.konversi(round($naRt)).'</td>';
              $arrComb = array_combine($arrNaKd, $arrKetKd);
              $naMax   = 0;
              foreach ($arrComb as $keyNaKd => $valKetKd) {
                if($keyNaKd == max(array_keys($arrComb))) {
                  $naMax = $valKetKd;
                } elseif($keyNaKd == min(array_keys($arrComb))) {
                  $naMin = $valKetKd;
                }
              }
              $filterNaMin = round(min(array_keys($arrComb)));
              if ($filterNaMin <= 70) {
                $brs .= '<td style="border:1px solid black; text-align: left;">Ananda mampu '.$naMax.' perlu pembinaan dalam '.$naMin.'</td>';
              } else {
                $brs .= '<td style="border:1px solid black; text-align: left;">Ananda mampu '.$naMax.'</td>';
              }
            }
            //===================================== End Nilai Akhir ==============================//
            $brs .= '</tr>';
            $i++;
          }
        }
        echo $brs;
      ?>
    </tbody>
  </table>
  <table style="font-size: 11px;" align="center" border="0" width="100%" >
    <tr>
        <td width="2%">&nbsp;</td>
        <td width="78%">
        <table style="font-size: 11px;">
            <tr>
                <td align="left">Mengetahui,</td>
            </tr>
            <tr>
              <td align="left"><b>Kepala <?php echo $nama_sekolah ?></b><br /><br /></td>
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
              <td align="left"><b>Wali Kelas</b><br /><br /></td>
            </tr>
            <tr>
              <td align="left"><u><?php foreach ($walikelas as $key => $value) { echo $value->nama_lengkap; } ?></u></td>
            </tr>
            <tr>
              <td align="left">NIP.<?php foreach ($walikelas as $key => $value) { echo $value->nip; } ?></td>
            </tr>
        </table>
        </td>
    </tr>
</table>
</body>
</html>