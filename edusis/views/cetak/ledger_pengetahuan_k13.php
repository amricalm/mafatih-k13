<!DOCTYPE html>
<html>
<body>
  <style>
  @page {
    margin: 10px;
    font-family: sans-serif;
  }
  </style>
  <div style="width:100vw; size: landscape;font-size:11px;">
    <div style="font-size:11px;text-align:center;">
      <h2 style="font-size:11px;margin:3px;">LEMBAR PENILAIAN HASIL BELAJAR SISWA</h2>
      <h2 style="font-size:11px;margin:3px;">PENILAIAN PENGETAHUAN SEMESTER <?php echo $p_nl ?></h2>
      <h2 style="font-size:11px;margin:3px;">TAHUN PELAJARAN <?php echo $th_ajar ?></h2>
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
    <table class="tables" align="center" style="width:100%; text-align:center;border-collapse:collapse;">
      <thead>
        <tr>
          <th rowspan="2" style="border:1px solid black;vertical-align:middle;">NO.</th>
          <th rowspan="2" style="border:1px solid black;width: 25%;vertical-align:middle;">NAMA SISWA</th>
          <?php
          if ($this->session->userdata('sub_pnl')=='UAS') {
            echo '<th style="height:25px;border:1px solid black;" colspan="6">ULANGAN HARIAN</th>';
          }
          else {
            echo '<th style="height:25px;border:1px solid black;" colspan="3">ULANGAN HARIAN</th>';
          }
          ?>
          <th rowspan="2" style="border:1px solid black;vertical-align:middle;">Rata Rata</th>
          <?php
          if ($this->session->userdata('sub_pnl')=='UAS') {
            echo '<th colspan="2" style="border:1px solid black;">TES LISAN</th>';
          }
          else {
            echo '<th style="border:1px solid black;">TES LISAN</th>';
          }
          ?>
          <th rowspan="2" style="border:1px solid black;vertical-align:middle;">Rata Rata</th>
          <?php
          if ($this->session->userdata('sub_pnl')=='UAS') {
            echo '<th colspan="2" style="border:1px solid black;">PORTOFOLIO</th>';
          }
          else {
            echo '<th style="border:1px solid black;">PORTOFOLIO</th>';
          }
          ?>
          <th rowspan="2" style="border:1px solid black;vertical-align:middle;">Rata Rata</th>
          <?php
          if ($this->session->userdata('sub_pnl')=='UAS') {
            echo '<th colspan="6" style="border:1px solid black;">PENUGASAN</th>';
          }
          else {
            echo '<th colspan="3" style="border:1px solid black;">PENUGASAN</th>';
          }
          ?>
          <th rowspan="2" style="border:1px solid black;vertical-align:middle;">Rata Rata</th>
          <th rowspan="2" style="border:1px solid black;vertical-align:middle;">PTS</th>
          <?php
          if ($this->session->userdata('sub_pnl')=='UAS') {
            echo '<th rowspan="2" style="border:1px solid black;vertical-align:middle;">PAS</th>';
          }
          ?>
          <th rowspan="2" style="border:1px solid black;">Nilai Akhir</th>
        </tr>
        <tr>
          <?php
          if ($this->session->userdata('sub_pnl')=='UAS') {
            echo '<th style="border:1px solid black;height:5px;">UH 1</th>';
            echo '<th style="border:1px solid black;">UH 2</th>';
            echo '<th style="border:1px solid black;">UH 3</th>';
            echo '<th style="border:1px solid black;">UH 4</th>';
            echo '<th style="border:1px solid black;">UH 5</th>';
            echo '<th style="border:1px solid black;">UH 6</th>';
          }else {
            echo '<th style="border:1px solid black;">UH 1</th>';
            echo '<th style="border:1px solid black;">UH 2</th>';
            echo '<th style="border:1px solid black;">UH 3</th>';
          }
          ?>
          <?php
          if ($this->session->userdata('sub_pnl')=='UAS') {
            echo '<th style="border:1px solid black;">1</th>';
            echo '<th style="border:1px solid black;">2</th>';
          }else {
            echo '<th style="border:1px solid black;">1</th>';
          }
          ?>
          <?php
          if ($this->session->userdata('sub_pnl')=='UAS') {
            echo '<th style="border:1px solid black;">1</th>';
            echo '<th style="border:1px solid black;">2</th>';
          }else {
            echo '<th style="border:1px solid black;">1</th>';
          }
          ?>
          <?php
          if ($this->session->userdata('sub_pnl')=='UAS') {
            echo '<th style="border:1px solid black;">1</th>';
            echo '<th style="border:1px solid black;">2</th>';
            echo '<th style="border:1px solid black;">3</th>';
            echo '<th style="border:1px solid black;">4</th>';
            echo '<th style="border:1px solid black;">5</th>';
            echo '<th style="border:1px solid black;">6</th>';
          }else {
            echo '<th style="border:1px solid black;">1</th>';
            echo '<th style="border:1px solid black;">2</th>';
            echo '<th style="border:1px solid black;">3</th>';
          }
          ?>
        </tr>
        <tr>
          <td colspan="25" style="border:1px solid black;height:0.1px;"></td>
        </tr>
      </thead>
      <?php
      $i  = 1;
      if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
        foreach($hasilbelajar->result() as $row)
        {
          $bg = ($i%2==0) ? ' class="bg" ' : '';
          echo '<tr'.$bg.'>';
          echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$i.'</td>';
          echo '<td style="border:1px solid black;text-align: left;font-size:11px;">'.$row->nama_lengkap.'</td>';

          if ($this->session->userdata('sub_pnl')=='UTS') {
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->UHT1_UTS.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->UHT2_UTS.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->UHT3_UTS.'</td>';

            $totalUH = $row->UHT1_UTS + $row->UHT2_UTS + $row->UHT3_UTS;

            $uh1 = ($row->UHT1_UTS == '0' || $row->UHT1_UTS == '') ? '0' : 1;
            $uh2 = ($row->UHT2_UTS == '0' || $row->UHT2_UTS == '') ? '0' : 1;
            $uh5 = ($row->UHT3_UTS == '0' || $row->UHT3_UTS == '') ? '0' : 1;
            $rtUh = $uh1 + $uh2 + $uh5;

            $totalRtUh = ($rtUh == 0) ? 0 : $totalUH/$rtUh;

            $bobotUH = ($totalRtUh * 40) / 100;

            echo '<td align="center" style="border:1px solid black;font-size:11px; color: blue;">'.round($totalRtUh).'</td>';
          }
          else {
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->UHT1_UTS.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->UHT2_UTS.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->UHT3_UTS.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->UHT1.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->UHT2.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->UHT3.'</td>';

            $totalUH = $row->UHT1_UTS + $row->UHT2_UTS + $row->UHT3_UTS + $row->UHT1 + $row->UHT2 + $row->UHT3;

            $uh1 = ($row->UHT1_UTS == '0' || $row->UHT1_UTS == '') ? '0' : 1;
            $uh2 = ($row->UHT2_UTS == '0' || $row->UHT2_UTS == '') ? '0' : 1;
            $uh5 = ($row->UHT3_UTS == '0' || $row->UHT3_UTS == '') ? '0' : 1;
            $uh3 = ($row->UHT1 == '0' || $row->UHT1 == '') ? '0' : 1;
            $uh4 = ($row->UHT2 == '0' || $row->UHT2 == '') ? '0' : 1;
            $uh6 = ($row->UHT3 == '0' || $row->UHT3 == '') ? '0' : 1;
            $rtUh = $uh1 + $uh2 + $uh3 + $uh4 + $uh6 + $uh5;

            $totalRtUh = ($rtUh == 0) ? 0 : $totalUH/$rtUh;

            $bobotUH = ($totalRtUh * 40) / 100;

            echo '<td align="center" style="border:1px solid black;font-size:11px; color: blue;">'.round($totalRtUh).'</td>';
          }

          if ($this->session->userdata('sub_pnl')=='UTS') {
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->Lisan1_uts.'</td>';

            $ttlLsn = $row->Lisan1_uts;

            $nlLsn1 = ($row->Lisan1_uts == '0' || $row->Lisan1_uts == '') ? '0' : 1;
            $nlLsn = $nlLsn1;

            $ttlNlLsn = ($nlLsn==0 || $nlLsn=='0' || $nlLsn=='') ? 0 : $ttlLsn/$nlLsn;

            $bobotLsn = ($ttlNlLsn * 20) / 100;
          }
          else {
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->Lisan1_uts.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->Lisan1.'</td>';

            $ttlLsn = $row->Lisan1 + $row->Lisan1_uts;

            $nlLsn1 = ($row->Lisan1 == '0' || $row->Lisan1 == '') ? '0' : 1;
            $nlLsn2 = ($row->Lisan1_uts == '0' || $row->Lisan1_uts == '') ? '0' : 1;
            $nlLsn = $nlLsn1 + $nlLsn2;

            $ttlNlLsn = ($nlLsn==0 || $nlLsn=='0' || $nlLsn=='') ? 0 : $ttlLsn/$nlLsn;

            $bobotLsn = ($ttlNlLsn * 20) / 100;
          }

          echo '<td align="center" style="border:1px solid black;font-size:11px;color:blue;">'.round($ttlNlLsn).'</td>';

          if ($this->session->userdata('sub_pnl')=='UTS') {
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->Port1_uts.'</td>';
            $ttlPrt = $row->Port1_uts;

            $nlPrt1 = ($row->Port1_uts == '0' || $row->Port1_uts == '') ? '0' : 1;
            $nlPrt = $nlPrt1;

            $ttlNlPrt = ($nlPrt==0 || $nlPrt=='0' || $nlPrt=='') ? 0 : $ttlPrt/$nlPrt;

            $bobotPrt = ($ttlNlPrt * 20) / 100;
            echo '<td align="center" style="border:1px solid black;font-size:11px;color:blue;">'.$ttlNlPrt.'</td>';
          }
          else {
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->Port1_uts.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->Port1.'</td>';

            $ttlPrt = $row->Port1 + $row->Port1_uts;

            $nlPrt1 = ($row->Port1 == '0' || $row->Port1 == '') ? '0' : 1;
            $nlPrt2 = ($row->Port1_uts == '0' || $row->Port1_uts == '') ? '0' : 1;
            $nlPrt = $nlPrt1 + $nlPrt2;

            $ttlNlPrt = ($nlPrt==0 || $nlPrt=='0' || $nlPrt=='') ? 0 : $ttlPrt/$nlPrt;

            $bobotPrt = ($ttlNlPrt * 20) / 100;
            echo '<td align="center" style="border:1px solid black;font-size:11px;color:blue;">'.$ttlNlPrt.'</td>';
          }

          if ($this->session->userdata('sub_pnl')=='UTS') {
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->TGS1_UTS.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->TGS2_UTS.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->TGS3_UTS.'</td>';

            $TGS = $row->TGS1_UTS + $row->TGS2_UTS + $row->TGS3_UTS;

            $e = ($row->TGS1_UTS == '0' || $row->TGS1_UTS == '' ) ? '0' : 1;
            $f = ($row->TGS2_UTS == '0' || $row->TGS2_UTS == '' ) ? '0' : 1;
            $g = ($row->TGS3_UTS == '0' || $row->TGS3_UTS == '' ) ? '0' : 1;
            $k = $e + $f + $g;

            $RT1    = ($k==0) ? 0 : $TGS/$k;

            $bobotTgs = $RT1 * 20 / 100;
          }
          else {
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->TGS1_UTS.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->TGS2_UTS.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->TGS3_UTS.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->TGS1.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->TGS2.'</td>';
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->TGS3.'</td>';

            $TGS = $row->TGS1_UTS + $row->TGS2_UTS + $row->TGS3_UTS + $row->TGS1 + $row->TGS2 + $row->TGS3;

            $e = ($row->TGS1_UTS == '0' || $row->TGS1_UTS == '' ) ? '0' : 1;
            $f = ($row->TGS2_UTS == '0' || $row->TGS2_UTS == '' ) ? '0' : 1;
            $g = ($row->TGS3_UTS == '0' || $row->TGS3_UTS == '' ) ? '0' : 1;
            $h = ($row->TGS1 == '0' || $row->TGS1 == '' ) ? '0' : 1;
            $l = ($row->TGS2 == '0' || $row->TGS2 == '' ) ? '0' : 1;
            $j = ($row->TGS3 == '0' || $row->TGS3 == '' ) ? '0' : 1;
            $k = $e + $f + $g + $h + $l + $j;

            $RT1    = ($k==0) ? 0 : $TGS/$k;

            $bobotTgs = $RT1 * 20 / 100;
          }

          echo '<td align="center" style="border:1px solid black;font-size:11px ;"><font color="blue">'.round($RT1).'</font></td>';

          echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->UTS.'</td>';

          if ($this->session->userdata('sub_pnl')=='UAS') {
            echo '<td align="center" style="border:1px solid black;font-size:11px ;">'.$row->UAS.'</td>';
          }

          if ($this->session->userdata('sub_pnl')=='UAS') {
            $nlA = (($bobotUH + $bobotLsn + $bobotPrt + $bobotTgs) * 40) / 100 + (((($row->UTS * 50) / 100) + (($row->UAS * 50) / 100)) * 60) / 100;

            echo '<td align="center" style="border:1px solid black;font-size:11px;font-weight: bold; color:blue;">'.round($nlA).'</td>';
          }
          else {
            $nlA = (($bobotUH + $bobotLsn + $bobotPrt + $bobotTgs) * 40) / 100 + ($row->UTS * 60) / 100;
            echo '<td align="center" style="border:1px solid black;font-size:11px;font-weight: bold; color:blue;">'.round($nlA).'</td>';
          }

          echo "</tr>";
          $sum[$i] = $nlA;
          $i++;
        }
        $ratakelas= (($i-1)==0) ? 0 : array_sum($sum)/($i-1);
        ?>
        <!-- <tr>
        <td>&nbsp;</td>
        <td colspan="2"><b>&nbsp;&nbsp;Rata-rata Kelas</b></td>
        <td colspan="19"></td>
        <td align="center" style="border:1px solid black;font-size:11px ;"><b style="border:1px solid black;color: blue;"><?php //echo round($ratakelas,1); ?></b></td>
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
            } ?>
          </div>
        </div>
        <div style="position:absolute;left:250px;bottom:0;width:200px;">
          <p style="padding:0 0 -10px;">Mengetahui</p>
          <p style="height:50px;">Kepala Sekolah,</p>
          <div><?php echo $kepsek->row()->nama_lengkap;?></div>
        </div>
      </div>
    </div>
</body>
</html>
