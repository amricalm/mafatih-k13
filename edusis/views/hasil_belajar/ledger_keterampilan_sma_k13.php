<?php $this->load->view('page_head');?>
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
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>LEDGER KETERAMPILAN<?php //$q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?></h1>

    <form action="<?php echo base_url().'index.php/hasilbelajar/ledger_keterampilan' ?>" method="POST" id="frmhasilbelajar">
    <!--atur pd (edusis_system/helpers/form_helper.php)function form_hidden, dg menambahkan (id="'.$name.'")-->
    <?php echo form_hidden('myurl',site_url('hasilbelajar')) ?>
    <!--table filter-->
        <table border="0" width="100%">
            <tr>
                <td width="120px">Pilih Kelas</td>
                <td width="300px">
                <select name="skelas" id="skelas" onchange="pilih()">
            <?php
              echo '<option value="" class="input-text"></option>';
              $arraykelas = array();
              if($skelas->num_rows() !=0)
              {
                foreach($skelas->result () as $rowkelas )
                {
                  $selected   ='';
                  if($pilihkelas == trim($rowkelas->kelas))
                  {
                    $selected = 'selected="selected"';
                  }
                echo '<option value="'.trim($rowkelas->kelas).'" '.$selected.'>'.$rowkelas->kelas.'</option>';
                }
              }
            ?>
            </select>
                </td>
                <td align="right" width="">
                <?php if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') { ?>
                <a href="<?php echo base_url().'index.php/export/export_keterampilan_k13_to_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
                <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Muatan pelajaran</td>
                <td>
                    <?php
                        $arraymp = array('');
                        foreach($kdmp->result () as $rowmp )
                        {
                            $arraymp[$rowmp->kd_mp]=$rowmp->nm_mp;
                        }
                        echo form_dropdown('kd_mp',$arraymp,$pilihmp,' id="mp" ');
                    ?>
                </td>
                <td rowspan="2">
                    <a href="javascript:filter()" class="small button blue">Filter</a>
                </td>
            </tr>
        </table>
    <!--end table filter-->
    <!--table daftar hasil study-->
    <div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
<!-- ================================== FORMAT BARU ======================================== -->
      <div style="width: 35%; float: left;">
      <table style="border-collapse:collapse;width:100%;text-align:center;">
        <thead style="background:#0088ff;color:white;font-weight:bold;">
          <tr>
            <td style="border:1px solid black; height: 78px; vertical-align:middle;width:1%;">NO</td>
            <td style="border:1px solid black; vertical-align:middle;">NIS</td>
            <td style="border:1px solid black; vertical-align:middle;">NAMA SISWA</td>
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
              
              $brs .= '</tr>';
              $i++;
            }
          }
          echo $brs;
          ?>
        </tbody>
      </table>
      </div>
      <div style="width: 65%; overflow-x: auto;">
      <table style="border-collapse:collapse;width:100%;text-align:center;">
        <thead style="background:#0088ff;color:white;font-weight:bold;">
          <tr>
              <?php
                $i = 0;
                foreach($kompetensi->result() as $rowKd) {
                  if ($this->session->userdata('sub_pnl')=='UTS') {
                    for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) { 
                      $i++;
                    }
                  } else {
                    for ($jmh_nh=1; $jmh_nh <= 12 ; $jmh_nh++) { 
                      $i++;
                    }
                  }
                }
                if ($i != 0) {
                  echo '<td colspan="'.$i.'" style="border:1px solid black;">PENILAIAN HARIAN '.strtoupper($mp->row()->nm_mp).'</td>';
                } else {
                  echo '<td colspan="'.$i.'" style="border:1px solid black; height: 78px; vertical-align:middle;">PENILAIAN HARIAN '.strtoupper($mp->row()->nm_mp).'</td>';
                } 
              ?>
          </tr>
          <tr>
            <?php
              foreach($kompetensi->result() as $rowKd) {
                if ($this->session->userdata('sub_pnl')=='UTS') {
                  echo '<td colspan="6" style="border:1px solid black;">'.$rowKd->kd_kd.'</td>';
                } else {
                  echo '<td colspan="12" style="border:1px solid black;">'.$rowKd->kd_kd.'</td>';
                }
              }
            ?>
          </tr>
          <tr>
            <?php
              foreach($kompetensi->result() as $rowKd) {
                if ($this->session->userdata('sub_pnl')=='UTS') {
                  $arrPsk = array('KIN1','KIN2','PRJ1','PRJ2','POR1','POR2');
                  foreach ($arrPsk as $rowPsk) { 
                    echo '<td style="border:1px solid black;width:1%;">'.$rowPsk.'</td>';
                  }
                } else {
                  $arrPsk = array('KIN1','KIN2','KIN3','KIN4','PRJ1','PPRJ2','PRJ3','PRJ4','POR1','POR2','POR3','POR4');
                  foreach ($arrPsk as $rowPsk) {
                    echo '<td style="border:1px solid black;width:1%;">'.$rowPsk.'</td>';
                  }
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
              if ($this->session->userdata('sub_pnl')=='UTS') {
                foreach($kompetensi->result() as $rowKd) {
                  $arrPsk = array('kin1','kin2','prj1','prj2','por1','por2');
                  foreach ($arrPsk as $rowPsk) {
                      $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPsk.'_uts';
                    $hasil_nh_row = eval('return '.$nh_row.';');
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
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
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                  foreach ($arrKin as $rowKin) {
                    $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowKin;
                    $hasil_nh_row = eval('return '.$nh_row.';');
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                  foreach ($arrPrj as $rowPrj) {
                    $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPrj.'_uts';
                    $hasil_nh_row = eval('return '.$nh_row.';');
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                  foreach ($arrPrj as $rowPrj) {
                    $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPrj;
                    $hasil_nh_row = eval('return '.$nh_row.';');
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                  foreach ($arrPor as $rowPor) {
                    $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPor.'_uts';
                    $hasil_nh_row = eval('return '.$nh_row.';');
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                  foreach ($arrPor as $rowPor) {
                    $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowPor;
                    $hasil_nh_row = eval('return '.$nh_row.';');
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
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
      </div>
    </div>
<!-- ==================================END FORMAT BARU ======================================== -->
    <div style="clear: both;"><br></div>
    <div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
      <div style="width: 35%; float: left;">
      <table style="border-collapse:collapse;width:100%;text-align:center;">
        <thead style="background:#0088ff;color:white;font-weight:bold;">
          <tr>
            <td style="border:1px solid black; height: 78px; vertical-align:middle;width:1%;">NO</td>
            <td style="border:1px solid black; vertical-align:middle;">NIS</td>
            <td style="border:1px solid black; vertical-align:middle;">NAMA SISWA</td>
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
              
              $brs .= '</tr>';
              $i++;
            }
          }
          echo $brs;
          ?>
        </tbody>
      </table>
      </div>
      <div style="width: 65%; overflow-x: auto;">
      <table style="width:6000px;border-collapse:collapse;text-align:center">
        <thead style="background:#0088ff;color:white;font-weight:bold;text-align:center;">
          <tr>
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
            <td rowspan="3" colspan="2" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold; height: 78px;">NILAI RAPORT</td>
            <td rowspan="3" style="width: 4500px; border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold; text-align: left; padding-left: 30px;">DESKRIPSI</td>
          </tr>
          <tr>
            <?php
                $i = 0;
                foreach($kompetensi->result() as $rowKd) { 
                  $i++;
                }
                echo '<td colspan="'.$i.'" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">PENILAIAN HARIAN</td>';
                echo '<td colspan="'.$i.'" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">PENILAIAN TENGAH SEMESTER</td>';
                if ($this->session->userdata('sub_pnl')=='UAS') {
                  echo '<td colspan="'.$i.'" style="border:1px solid black;vertical-align:middle;font-size: 0.8em/1.5;font-weight:bold;">PENILAIAN AKHIR SEMESTER</td>';
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
                  if ($hasil_pts == 0 || $hasil_pas == 0) {
                    $naKd         = ((2 * $kdRt) + $hasil_pts + $hasil_pas) / 3;
                  } else {
                    $naKd         = ((2 * $kdRt) + $hasil_pts + $hasil_pas) / 4;
                  }
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
				$naMin   = 0;
                foreach ($arrComb as $keyNaKd => $valKetKd) {
                  if($keyNaKd == max(array_keys($arrComb))) {
                    $naMax = $valKetKd;
                  } elseif($keyNaKd == min(array_keys($arrComb))) {
                    $naMin = $valKetKd;
                  }
                }
                $filterNaMin = (($arrComb != 0) ? round(min(array_keys($arrComb))) : 0);
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
    </div>
        <!-- end table hsil study -->
      </div>
    </form>
</div> <!-- /content -->
</div> <!-- /cols -->
<hr class="noscreen" />
<!-- Footer -->
<?php $this->load->view('page_footer'); ?>

<script type="text/javascript">

    function filter()
    {
        var kelas         = urlencode($('#skelas').val());//utlencode pd javascript digunakan untuk merubah caracter sepasi, spt str_replece pd php
        var mp            = $('#mp').val();
        var myurl         = $('#myurl').val();
        var form_wi       = $('#frmhasilbelajar').attr('action');
        $('#frmhasilbelajar').attr('action',form_wi+'/'+kelas+'/'+mp);
        $('#frmhasilbelajar').submit();
    }
    function pilih()
    {
        var kelas         = urlencode($('#skelas').val());
        var myurl         = $('#myurl').val();
        var tujuan        = myurl+"/alokasiwi_filter/"+kelas;
        $.ajax({
           type: "POST",
           async: false,
           url: tujuan,
           success: function (msg){
               if (msg!="") {
                   $("#resultnama").html(msg);
               }
           }
        });
    }
</script>

</body>
</html>
