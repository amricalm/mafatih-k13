<!DOCTYPE html>
<html>
<title>Ledger Sikap SMP Kurikulum 2013</title>
<body>
  <style media="screen">
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
  @page {
    margin: 10px;
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
  <table class="tables" align="center" style="width:100%;">
    <tr>
      <th rowspan="3" style="width:3%;">No.</th>
      <th rowspan="3" style="width:40%;">NAMA SISWA</th>
      <?php
      if ($this->session->userdata('sub_pnl')=='UAS') {
        echo '<th colspan="4">PENILAIAN SIKAP</th>';
      } else {
        echo '<th colspan="2">PENILAIAN SIKAP</th>';
      }
      ?>
      <th rowspan="3">Nilai Akhir</th>
    </tr>
    <tr>
      <?php
      if ($this->session->userdata('sub_pnl')=='UAS') {
        echo '<th colspan="2">DIRI SENDIRI</th>';
      }
      else {
        echo '<th>DIRI SENDIRI</th>';
      }
      if ($this->session->userdata('sub_pnl')=='UAS') {
        echo '<th colspan="2">ANTAR</th>';
      }
      else {
        echo '<th>ANTAR</th>';
      }
      ?>
    </tr>
    <tr>
      <?php
      if ($this->session->userdata('sub_pnl')=='UAS') {
        echo '<th>1</th>';
        echo '<th>2</th>';
      }
      else {
        echo '<th>1</th>';
      }
      if ($this->session->userdata('sub_pnl')=='UAS') {
        echo '<th>1</th>';
        echo '<th>2</th>';
      }
      else {
        echo '<th>1</th>';
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
          echo '<td align="center" style="font-size:11px ;">'.$row->DIR_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->DIR.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->TMN_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->TMN.'</td>';

          $ttlSkp = $row->DIR_UTS + $row->DIR;

          $skpDvr1 = ($row->DIR_UTS == 0 || $row->DIR_UTS =='0' || $row->DIR_UTS == '') ? '0' : 1;
          $skpDvr2 = ($row->DIR == 0 || $row->DIR =='0' || $row->DIR == '') ? '0' : 1;

          $skpDvr = $skpDvr1 + $skpDvr2;

          $skpRt = ($skpDvr == 0 || $skpDvr == '0' || $skpDvr == '') ? 0 : $ttlSkp / $skpDvr;

          $bbtDir = ($skpRt * 50) / 100;


          $ttlAtr = $row->TMN_UTS + $row->TMN;

          $skpATR1 = ($row->TMN_UTS == 0 || $row->TMN_UTS =='0' || $row->TMN_UTS == '') ? '0' : 1;
          $skpATR2 = ($row->TMN == 0 || $row->TMN =='0' || $row->TMN == '') ? '0' : 1;

          $skpATR = $skpATR1 + $skpATR2;

          $skpArt = ($skpATR == 0 || $skpATR == '0' || $skpATR == '') ? 0 : $ttlAtr / $skpATR;

          $bbtAtr = ($skpArt * 50) / 100;
        }
        else
        {
          echo '<td align="center" style="font-size:11px ;">'.$row->DIR_UTS.'</td>';
          echo '<td align="center" style="font-size:11px ;">'.$row->TMN_UTS.'</td>';

          $skpRt = $row->DIR_UTS;
          $skpATR = $row->TMN_UTS;
        }

        $ttlRt = $skpRt + $skpATR;

        $rtDvr1 = ($skpRt == 0 || $skpRt == '0' || $skpRt == '') ? '0': 1;
        $rtDvr2 = ($skpATR == 0 || $skpATR == '0' || $skpATR == '') ? '0': 1;

        $rtDvr = $rtDvr1 + $rtDvr2;

        $naRt = ($rtDvr == '0' || $rtDvr == 0 || $rtDvr == '') ? 0 : $ttlRt / $rtDvr;

        $RPT    = $skpRt;
        if ($this->session->userdata('sub_pnl')=='UAS') {
          $ttlBbt = $bbtAtr + $bbtDir;
          echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.round($ttlBbt).'</font></b></td>';
        } else {
          echo '<td align="center" style="font-size:11px ;"><b><font color="blue">'.round($naRt).'</font></b></td>';
        }
        $sum[$i] = $RPT;
        $i++;
        echo '</tr>';
      }
        $ratakelas= (($i-1)==0) ? 0 : array_sum($sum)/($i-1);
    ?>
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
