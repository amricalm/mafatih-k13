<!DOCTYPE html>
<html>
<title>Ledger Kurikulum 2013</title>
<body>
  <style>
  * {
    font: 11px sans-serif;
  }
  .tables, .tables td, .tables th {
    border-collapse: collapse;
    border: 1px solid black;
  }
  .title, .titles {
    text-align: center;
    font-weight: bold;
  }
  </style>
  <div class="title">
    <span class="titles">LEMBAR PENILAIAN HASIL BELAJAR SISWA</span><br />
    <span class="titles">PENILAIAN PENGETAHUAN SEMESETER <?php echo $p_nl ?></span><br />
    <span class="titles">TAHUN PELAJARAN <?php echo $th_ajar ?></span><br />
  </div>
  <table style="width:100vw; font-weight:bold;">
    <tr>
      <td style="width:7%;">Kelas</td>
      <td style="width:1%;">:</td>
      <td style="width:15%;"><?php echo $kelas ?></td>
      <td style="width:60%;"></td>
      <td style="width:9%;">Mata Pelajaran</td>
      <td style="width:1%;">:</td>
      <td style="width:21%;"><?php echo $mp->row()->nm_mp; ?></td>
    </tr>
    <tr>
      <td style="width:3%;">Guru Mapel</td>
      <td style="width:1%;">:</td>
      <td><?php foreach($kkm->result() as $row)
      {
        echo $row->nama_lengkap;
        break;
      } ?></td>
      <td></td>
      <td>KKM</td>
      <td>:</td>
      <td><?php foreach($kkm->result() as $row)
      {
        echo $row->skbm;
      } ?></td>
    </tr>
  </table>
  <table class="tables" style="width:100%;">
    <tr>
      <th rowspan="2">No.</th>
      <th rowspan="2" style="width:25%;">Nama Siswa</th>
      <?php
      if ($this->session->userdata('sub_pnl')=='UAS') {
        echo '<th colspan="4" style="height:40px;">KINERJA PROSES</th>';
      } else {
        echo '<th colspan="2">KINERJA PROSES</th>';
      }
      ?>
      <th rowspan="2">Rata Rata</th>
      <?php
      if ($this->session->userdata('sub_pnl')=='UAS') {
        echo '<th colspan="4">KINERJA PRODUK</th>';
      } else {
        echo '<th colspan="2">KINERJA PRODUK</th>';
      }

      echo '<th rowspan="2">Rata Rata</th>';

      if ($this->session->userdata('sub_pnl')=='UAS') {
        echo '<th colspan="4">PENILAIAN PROYEK</th>';
      } else {
        echo '<th colspan="2">PENILAIAN PROYEK</th>';
      }

      echo '<th rowspan="2">Rata Rata</th>';

      if ($this->session->userdata('sub_pnl')=='UAS') {
        echo '<th colspan="4">PORTOFOLIO</th>';
      } else {
        echo '<th colspan="2">PORTOFOLIO</th>';
      }

      echo '<th rowspan="2">Rata Rata</th>';
      echo '<th rowspan="2">Nilai Akhir</th>';
      ?>
    </tr>
    <tr>
      <th style="height:15px;">KPS1</th>
      <th>KPS2</th>
      <?php
      if ($this->session->userdata('sub_pnl')=='UAS') {
        echo '<th>KPS3</th>';
        echo '<th>KPS4</th>';
      }
      echo '<th>KPD1</th>' ;
      echo '<th>KPD2</th>';
      if ($this->session->userdata('sub_pnl')=='UAS') {
        echo '<th>KPD3</th>';
        echo '<th>KPD4</th>';
      }
      echo '<th>1</th>';
      echo '<th>2</th>';
      if ($this->session->userdata('sub_pnl')=='UAS') {
        echo '<th>3</th>';
        echo '<th>4</th>';
      }
      echo '<th>1</th>';
      echo '<th>2</th>';
      if ($this->session->userdata('sub_pnl')=='UAS') {
        echo '<th>3</th>';
        echo '<th>4</th>';
      }
      ?>
    </tr>
    <?php
    $i  = 1;
    if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
    foreach($hasilbelajar->result() as $row)
    {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        echo '<tr'.$bg.'>';
        echo '<td align="center">'.$i.'</td>';
        echo '<td>'.$row->nama_lengkap.'</td>';

        if ($this->session->userdata('sub_pnl')=='UAS') {
          echo '<td align="center" style="font-size:11px ; ">'.$row->PRK1_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->PRK2_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->PRK1.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->PRK2.'</td>';

          $PRK = $row->PRK1_UTS + $row->PRK2_UTS + $row->PRK1 + $row->PRK2;

          $e = ($row->PRK1_UTS == '0' || $row->PRK1_UTS == '' ) ? '0' : 1;
          $f = ($row->PRK2_UTS == '0' || $row->PRK2_UTS == '' ) ? '0' : 1;
          $h = ($row->PRK1 == '0' || $row->PRK1 == '' ) ? '0' : 1;
          $l = ($row->PRK2 == '0' || $row->PRK2 == '' ) ? '0' : 1;
          $k = $e + $f + $h + $l;

          $RT1    = round(($k==0) ? 0 : $PRK/$k);
        } else {
          echo '<td align="center" style="font-size:11px ;">'.$row->PRK1_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->PRK2_UTS.'</td>';

          $PRK = $row->PRK1_UTS + $row->PRK2_UTS + $row->PRK1 + $row->PRK2;

          $e = ($row->PRK1_UTS == '0' || $row->PRK1_UTS == '' ) ? '0' : 1;
          $f = ($row->PRK2_UTS == '0' || $row->PRK2_UTS == '' ) ? '0' : 1;
          $h = ($row->PRK1 == '0' || $row->PRK1 == '' ) ? '0' : 1;
          $l = ($row->PRK2 == '0' || $row->PRK2 == '' ) ? '0' : 1;
          $k = $e + $f + $h + $l;

          $RT1    = round(($k==0) ? 0 : $PRK/$k);
        }
        echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$RT1.'</font></td>';

        if ($this->session->userdata('sub_pnl')=='UAS') {
          echo '<td align="center" style="font-size:11px ;">'.$row->KPD1_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->KPD2_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->KPD1_UAS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->KPD2_UAS.'</td>';
          $kpd = $row->KPD1_UTS + $row->KPD2_UTS + $row->KPD1_UAS + $row->KPD2_UAS;
          $aa = ($row->KPD1_UTS == '0' || $row->KPD1_UTS == '') ? '0' : 1;
          $bb = ($row->KPD2_UTS == '0' || $row->KPD2_UTS == '') ? '0' : 1;
          $cc = ($row->KPD1_UAS == '0' || $row->KPD1_UAS == '') ? '0' : 1;
          $dd = ($row->KPD2_UAS == '0' || $row->KPD2_UAS == '') ? '0' : 1;
          $dvdKpd = $aa + $bb + $cc + $dd;
          $cntRtKpd = ($dvdKpd == 0) ? 0 : $kpd / $dvdKpd;
        } else {
          echo '<td align="center" style="font-size:11px ;">'.$row->KPD1_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->KPD2_UTS.'</td>';
          $kpd = $row->KPD1_UTS + $row->KPD2_UTS;
          $aa = ($row->KPD1_UTS == '0' || $row->KPD1_UTS == '') ? '0' : 1;
          $bb = ($row->KPD2_UTS == '0' || $row->KPD2_UTS == '') ? '0' : 1;
          $dvdKpd = $aa + $bb;
          $cntRtKpd = ($dvdKpd == 0) ? 0 : $kpd / $dvdKpd;
        }
        echo '<td align="center" style="font-size:11px;color: blue;">'.$cntRtKpd.'</td>';

        if ($this->session->userdata('sub_pnl')=='UAS') {
          echo '<td align="center" style="font-size:11px ;">'.$row->PRJ1_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->PRJ2_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->PRJ1.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->PRJ2.'</td>';
          $PRJ = $row->PRJ1_UTS + $row->PRJ2_UTS + $row->PRJ1 + $row->PRJ2;

          $ei = ($row->PRJ1_UTS == '0' || $row->PRJ1_UTS == '' ) ? '0' : 1;
          $fi = ($row->PRJ2_UTS == '0' || $row->PRJ2_UTS == '' ) ? '0' : 1;
          $hi = ($row->PRJ1 == '0' || $row->PRJ1 == '' ) ? '0' : 1;
          $li = ($row->PRJ2 == '0' || $row->PRJ2 == '' ) ? '0' : 1;
          $ki = $ei + $fi + $hi + $li;

          $RT3    = round(($ki==0) ? 0 : $PRJ/$ki);
        } else {
          echo '<td align="center" style="font-size:11px ;">'.$row->PRJ1_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->PRJ2_UTS.'</td>';
          $PRJ = $row->PRJ1_UTS + $row->PRJ2_UTS;

          $ei = ($row->PRJ1_UTS == '0' || $row->PRJ1_UTS == '' ) ? '0' : 1;
          $fi = ($row->PRJ2_UTS == '0' || $row->PRJ2_UTS == '' ) ? '0' : 1;
          $ki = $ei + $fi;

          $RT3    = round(($ki==0) ? 0 : $PRJ/$ki);
        }
        echo '<td align="center" style="font-size:11px;color: blue;">'.$RT3.'</td>';

        if ($this->session->userdata('sub_pnl')=='UAS') {
          echo '<td align="center" style="font-size:11px ;">'.$row->POR1_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->POR2_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->POR1.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->POR2.'</td>';

          $POR = $row->POR1_UTS + $row->POR2_UTS + $row->POR1 + $row->POR2;

          $ei = ($row->POR1_UTS == '0' || $row->POR1_UTS == '' ) ? '0' : 1;
          $fi = ($row->POR2_UTS == '0' || $row->POR2_UTS == '' ) ? '0' : 1;
          $hi = ($row->POR1 == '0' || $row->POR1 == '' ) ? '0' : 1;
          $li = ($row->POR2 == '0' || $row->POR2 == '' ) ? '0' : 1;
          $ki = $ei + $fi + $hi + $li;

          $RT2    = round(($ki==0) ? 0 : $POR/$ki);
        }else {
          echo '<td align="center" style="font-size:11px ;">'.$row->POR1_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->POR2_UTS.'</td>';
          $POR = $row->POR1_UTS + $row->POR2_UTS;

          $ei  = ($row->POR1_UTS == '0' || $row->POR1_UTS == '' ) ? '0' : 1;
          $fi  = ($row->POR2_UTS == '0' || $row->POR2_UTS == '' ) ? '0' : 1;
          $ki  = $ei + $fi;

          $RT2 = round(($ki==0) ? 0 : $POR/$ki);
        }
        echo '<td align="center" style="font-size:11px;color: blue;">'.$RT2.'</td>';

        $naTtl  = $RT1 + $cntRtKpd + $RT3 + $RT2;

        $naDvr1 = ($RT1 == 0 || $RT1 == '0' || $RT1 == '') ? '0' : 1;
        $naDvr2 = ($cntRtKpd == 0 || $cntRtKpd == '0' || $cntRtKpd == '') ? '0' : 1;
        $naDvr3 = ($RT3 == 0 || $RT3 == '0' || $RT3 == '') ? '0' : 1;
        $naDvr4 = ($RT2 == 0 || $RT2 == '0' || $RT2 == '') ? '0' : 1;

        $naDvr  = $naDvr1 + $naDvr2 + $naDvr3 + $naDvr4;

        $naRt   = round(($naDvr == 0 || $naDvr == '0' || $naDvr == '') ? 0 : $naTtl / $naDvr);

        echo '<td align="center" style="font-size:11px;color: blue;font-weight:bold;">'.$naRt.'</td>';

        $sum[$i] = $RT2;
        $i++;
        echo '</tr>';
    }
        $ratakelas= (($i-1)==0) ? 0 : array_sum($sum)/($i-1);
    ?>
    <!--<tr>
        <td>&nbsp;</td>
        <td colspan="2"><b>&nbsp;&nbsp;Rata-rata Kelas</b></td>
        <td colspan="15"></td>
        <td align="center" style="font-size:11px ;"><b style="color: blue;"><?php //echo round($ratakelas,1); ?></b></td>
    </tr>-->
    <?php } ?>
  </table>
  <div style="width:100vw;position:relative;">
    <div style="position:absolute;right:0;bottom:0;width:200px;">
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
        <div>Cibinong, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?></div>
        <div style="margin:0;display:inline-block;height:50px;">Guru Bidang Studi</div>
        <div>
          <?php foreach($kkm->result() as $row)
          {
            echo $row->nama_lengkap;
            break;
          } ?>
        </div>
      </div>
      <div style="position:absolute;left:250px;bottom:0;width:200px;">
        <p style="padding:0 0 -10px;">Mengetahui</p>
        <p style="height:50px;">Kepala Sekolah,</p>
        <div><?php echo $kepsek->row()->nama_lengkap;?></div>
      </div>
    </div>
</body>
</html>
