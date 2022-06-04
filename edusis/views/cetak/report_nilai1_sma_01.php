<html>
<head>
<?php
function konv_pb_sb($tmp)
{
	if($tmp <=76)
	{
		$pred = "PERLU PERBAIKAN";
	}
	else
	{
		$pred = "SANGAT BAIK";
	}
	echo $pred;
}
function konv_nol($tmp)
{
	if($tmp <= 0)
	{
		$val = '-';
	}
	else
	{
		$val = $tmp;
	}
	return $val;
}
function konversi_predikat_sikap_sma($nilai)
{
  if ($nilai <= "65")
  {
    $nilai_sikap = "D";
  }
  elseif ($nilai <= "76")
  {
    $nilai_sikap = "C";
  }
  elseif ($nilai <= "85")
  {
    $nilai_sikap = "B";
  }
  elseif ($nilai <= "100")
  {
    $nilai_sikap = "A";
  }

  echo $nilai_sikap;
}
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
  if ($tmp <= 0) {
    $predikat = array(' - ', ' - ');
  }
  elseif($tmp <= 65) {
	  $predikat = array('D', 'Kurang baik dalam menguasai semua kompetensi dasar.');
  }
  elseif ($tmp <= 76) {
    $predikat = array('C', 'Cukup baik dalam menguasai semua kompetensi dasar.');
  }
  elseif ($tmp <= 88) {
    $predikat = array('B', 'Menguasai semua kompetensi dasar dengan baik.');
  }
  elseif ($tmp <= 100) {
    $predikat = array('A', 'Menguasai semua kompetensi dasar dengan sangat baik.');
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
  <?php
    //======== Nilai Pengetahuan ===============================// 
    if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0') 
      { 
        $a      = 0;
        $jmlkgn = 0;
		    $jmh_mp = $hasilbelajar->num_rows();

        $kolom1 = "";
        $kolom2 = "";
        $kolom3 = "";
		    $kolom4 = "";
        
        $i  = 1;
		    foreach($hasilbelajar->result() as $row)
        {
          $kel = $row->urutan;
          if($kel <= 6) 
          {
            $kgn    		= ($row->kgn=='0' || $row->kgn==0) ? '0' : $row->kgn;
            $tmp_kgn   		= $row->kgn*4/100;
            $empatskala_kgn	= konversi_sma_4skala($kgn);
            $bg = ($i%2==0) ? ' class="bg" ' : '';
    				$kolom1 .= '<tr'.$bg.'>';
    				$kolom1 .= '<td></td>';
    				$kolom1 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid black;">'.$i.'</td>';
    				$kolom1 .= '<td style="border:1px solid black;font-size: 0.8em/1.5;line-height:13px;padding:5px;">'.$row->nm_mp.'</td>';
    				$kolom1 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">  '.konv_nol($row->kgn).'</td>';
    				$kolom1 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konversi_predikat_smp_k13($kgn, 0).'</td>';
            $jmlkgn += $row->kgn;
            if ($row->comment_tbl_pengetahuan != '') {
              $com_kgn = $row->comment_tbl_pengetahuan;
            } else { 
              $com_kgn = '-'; 
            }
            $kolom1 .= '<td align="left" style="font-size: 0.8em/1.5;border:1px solid black; padding-left: 5px; text-align: justify;">'.$com_kgn.'</td>';
            $kolom1 .= '</tr>';
              $i++;
              $a++;
          }
        }
        
        $j = 1;
        foreach($hasilbelajar->result() as $row)
        {
          $kel = $row->urutan;
          if(($kel > 6)&&($kel < 11)) 
          {
            $kgn    		= ($row->kgn=='0' || $row->kgn==0) ? '0' : $row->kgn;
            $tmp_kgn   		= $row->kgn*4/100;
            $empatskala_kgn	= konversi_sma_4skala($kgn);
            $bg = ($j%2==0) ? ' class="bg" ' : '';
    				$kolom2 .= '<tr'.$bg.'>';
    				$kolom2 .= '<td></td>';
    				$kolom2 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid black;">'.$j.'</td>';
    				$kolom2 .= '<td style="border:1px solid black;font-size: 0.8em/1.5;line-height:13px;padding:5px;">'.$row->nm_mp.'</td>';
      			$kolom2 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">  '.konv_nol($row->kgn).'</td>';
      			$kolom2 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konversi_predikat_smp_k13($kgn, 0).'</td>';
            $jmlkgn += $row->kgn;
            if ($row->comment_tbl_pengetahuan != '') {
              $com_kgn = $row->comment_tbl_pengetahuan;
            } else { 
              $com_kgn = '-'; 
            }
            $kolom2 .= '<td align="left" style="font-size: 0.8em/1.5;border:1px solid black; padding-left: 5px; text-align: justify;">'.$com_kgn.'</td>';
            $kolom2 .= '</tr>';
            $j++;
            $a++;
          }
        }
		
		    $k = 1;
        foreach($hasilbelajar->result() as $row)
        {
          $kel = $row->urutan;
          if(($kel > 11)&&($kel < 20)) 
          {
            $kgn    		= ($row->kgn=='0' || $row->kgn==0) ? '0' : $row->kgn;
            $tmp_kgn   		= $row->kgn*4/100;
            $empatskala_kgn	= konversi_sma_4skala($kgn);
            $bg = ($k%2==0) ? ' class="bg" ' : '';
    				$kolom3 .= '<tr'.$bg.'>';
    				$kolom3 .= '<td></td>';
    				$kolom3 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid black;">'.$k.'</td>';
    				$kolom3 .= '<td style="border:1px solid black;font-size: 0.8em/1.5;line-height:13px;padding:5px;">'.$row->nm_mp.'</td>';
    				$kolom3 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">  '.konv_nol($row->kgn).'</td>';
    				$kolom3 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konversi_predikat_smp_k13($kgn, 0).'</td>';
            $jmlkgn += $row->kgn;
	          if ($row->comment_tbl_pengetahuan != '') {
              $com_kgn = $row->comment_tbl_pengetahuan;
            } else { 
              $com_kgn = '-'; 
            }
            $kolom3 .= '<td align="left" style="font-size: 0.8em/1.5;border:1px solid black; padding-left: 5px; text-align: justify;">'.$com_kgn.'</td>';
            $kolom3 .= '</tr>';
            $k++;
            $a++;
          }
        }

		    $l = 1;
        foreach($hasilbelajar->result() as $row)
        {
          $kel = $row->urutan;
          if(($kel > 19)&&($kel < 40)) 
          {
            $kgn    		= ($row->kgn=='0' || $row->kgn==0) ? '0' : $row->kgn;
            $tmp_kgn   		= $row->kgn*4/100;
            $empatskala_kgn	= konversi_sma_4skala($kgn);
            $bg = ($l%2==0) ? ' class="bg" ' : '';
    				$kolom4 .= '<tr'.$bg.'>';
    				$kolom4 .= '<td></td>';
    				$kolom4 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid black;">'.$l.'</td>';
    				$kolom4 .= '<td style="border:1px solid black;font-size: 0.8em/1.5;line-height:13px;padding:5px;">'.$row->nm_mp.'</td>';
    				$kolom4 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">  '.konv_nol($row->kgn).'</td>';
    				$kolom4 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konversi_predikat_smp_k13($kgn, 0).'</td>';
                $jmlkgn += $row->kgn;
			      if ($row->comment_tbl_pengetahuan != '') {
              $com_kgn = $row->comment_tbl_pengetahuan;
            } else { 
              $com_kgn = '-'; 
            }
            $kolom4 .= '<td align="left" style="font-size: 0.8em/1.5;border:1px solid black; padding-left: 5px; text-align: justify;">'.$com_kgn.'</td>';
            $kolom4 .= '</tr>';
            $l++;
            $a++;
          }
        }
      } 
    //======= End Nilai Pengetahuan ==========================//
  
    //======== Nilai Keterampilan ===============================// 
    if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0') 
      { 
        $a      = 0;
        $jmlkgn = 0;
        $jmh_mp = $hasilbelajar->num_rows();

        $kolom6 = "";
        $kolom7 = "";
        $kolom8 = "";
        $kolom9 = "";
        
        $m  = 1;
        foreach($hasilbelajar->result() as $row)
        {
          $kel = $row->urutan;
          if($kel <= 6) 
          {
            $kgn        = ($row->kgn=='0' || $row->kgn==0) ? '0' : $row->kgn;
            $tmp_kgn      = $row->kgn*4/100;
            $empatskala_kgn = konversi_sma_4skala($kgn);
            $bg = ($i%2==0) ? ' class="bg" ' : '';
            $kolom6 .= '<tr'.$bg.'>';
            $kolom6 .= '<td></td>';
            $kolom6 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid black;">'.$m.'</td>';
            $kolom6 .= '<td style="border:1px solid black;font-size: 0.8em/1.5;line-height:13px;padding:5px;">'.$row->nm_mp.'</td>';
            $psk            = ($row->psk=='0') ? '0' : $row->psk;
            $tmp_psk        = $row->psk*4/100;
            $empatskala_psk = konversi_sma_4skala($psk);
            $kolom6 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konv_nol($row->psk).'</td>';
            $kolom6 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konversi_predikat_smp_k13($row->psk, 0).'</td>';
            if ($row->comment_tbl_keterampilan != '') {
              $com_psk = $row->comment_tbl_keterampilan;
            } else { 
              $com_psk = '-'; 
            }
            $kolom6 .= '<td align="left" style="font-size: 0.8em/1.5;border:1px solid black; padding-left: 5px; text-align: justify;">'.$com_psk.'</td>';
            $kolom6 .= '</tr>';
              $m++;
              $a++;
          }
        }
        
        $n = 1;
        foreach($hasilbelajar->result() as $row)
        {
          $kel = $row->urutan;
          if(($kel > 6)&&($kel < 11)) 
          {
            $kgn        = ($row->kgn=='0' || $row->kgn==0) ? '0' : $row->kgn;
            $tmp_kgn      = $row->kgn*4/100;
            $empatskala_kgn = konversi_sma_4skala($kgn);
            $bg = ($j%2==0) ? ' class="bg" ' : '';
            $kolom7 .= '<tr'.$bg.'>';
            $kolom7 .= '<td></td>';
            $kolom7 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid black;">'.$n.'</td>';
            $kolom7 .= '<td style="border:1px solid black;font-size: 0.8em/1.5;line-height:13px;padding:5px;">'.$row->nm_mp.'</td>';
            $psk            = ($row->psk=='0') ? '0' : $row->psk;
            $tmp_psk        = $row->psk*4/100;
            $empatskala_psk = konversi_sma_4skala($psk);
            $kolom7 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konv_nol($row->psk).'</td>';
            $kolom7 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konversi_predikat_smp_k13($row->psk, 0).'</td>';
            if ($row->comment_tbl_keterampilan != '') {
              $com_psk = $row->comment_tbl_keterampilan;
            } else { 
              $com_psk = '-'; 
            }
            $kolom7 .= '<td align="left" style="font-size: 0.8em/1.5;border:1px solid black; padding-left: 5px; text-align: justify;">'.$com_psk.'</td>';
            $kolom7 .= '</tr>';
            $n++;
            $a++;
          }
        }
    
        $o = 1;
        foreach($hasilbelajar->result() as $row)
        {
          $kel = $row->urutan;
          if(($kel > 11)&&($kel < 20)) 
          {
            $kgn        = ($row->kgn=='0' || $row->kgn==0) ? '0' : $row->kgn;
            $tmp_kgn      = $row->kgn*4/100;
            $empatskala_kgn = konversi_sma_4skala($kgn);
            $bg = ($k%2==0) ? ' class="bg" ' : '';
            $kolom8 .= '<tr'.$bg.'>';
            $kolom8 .= '<td></td>';
            $kolom8 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid black;">'.$o.'</td>';
            $kolom8 .= '<td style="border:1px solid black;font-size: 0.8em/1.5;line-height:13px;padding:5px;">'.$row->nm_mp.'</td>';
            $psk             = ($row->psk=='0') ? '0' : $row->psk;
            $tmp_psk         = $row->psk*4/100;
            $empatskala_psk  = konversi_sma_4skala($psk);
            $kolom8 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konv_nol($row->psk).'</td>';
            $kolom8 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konversi_predikat_smp_k13($row->psk, 0).'</td>';
            if ($row->comment_tbl_keterampilan != '') {
              $com_psk = $row->comment_tbl_keterampilan;
            } else { 
              $com_psk = '-'; 
            }
            $kolom8 .= '<td align="left" style="font-size: 0.8em/1.5;border:1px solid black; padding-left: 5px; text-align: justify;">'.$com_psk.'</td>';
            $kolom8 .= '</tr>';
            $o++;
            $a++;
          }
        }

        $p = 1;
        foreach($hasilbelajar->result() as $row)
        {
          $kel = $row->urutan;
          if(($kel > 19)&&($kel < 40)) 
          {
            $kgn        = ($row->kgn=='0' || $row->kgn==0) ? '0' : $row->kgn;
            $tmp_kgn      = $row->kgn*4/100;
            $empatskala_kgn = konversi_sma_4skala($kgn);
            $bg = ($l%2==0) ? ' class="bg" ' : '';
            $kolom9 .= '<tr'.$bg.'>';
            $kolom9 .= '<td></td>';
            $kolom9 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid black;">'.$p.'</td>';
            $kolom9 .= '<td style="border:1px solid black;font-size: 0.8em/1.5;line-height:13px;padding:5px;">'.$row->nm_mp.'</td>';
            $psk            = ($row->psk=='0') ? '0' : $row->psk;
            $tmp_psk        = $row->psk*4/100;
            $empatskala_psk = konversi_sma_4skala($psk);
            $kolom9 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konv_nol($row->psk).'</td>';
            $kolom9 .= '<td align="center" style="border:1px solid black;font-size: 0.8em/1.5">'.konversi_predikat_smp_k13($row->psk, 0).'</td>';
            if ($row->comment_tbl_keterampilan != '') {
              $com_psk = $row->comment_tbl_keterampilan;
            } else { 
              $com_psk = '-'; 
            }
            $kolom9 .= '<td align="left" style="font-size: 0.8em/1.5;border:1px solid black; padding-left: 5px; text-align: justify;">'.$com_psk.'</td>';
            $kolom9 .= '</tr>';
            $p++;
            $a++;
          }
        }
      } 
    //======= End Nilai Keterampilan ==========================//
  ?>


<div class="wrapper">
  <table align="center" border="0" width="95%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">
    <tr>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Nama Sekolah</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $sekolah->row()->nama_sekolah;?></td>
    	<td width="15%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Kelas</td>
    	<td width="20%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: 
		 <?php if(str_replace('+',' ',$this->uri->segment(3)) == "X MIA") 
        { 
            echo "X 1";
        } elseif (str_replace('+',' ',$this->uri->segment(3)) == "X IIS")
        {
            echo "X 2";
        } else {
            echo str_replace('+',' ',$this->uri->segment(3));
        }?></td>
    </tr>
    <tr>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Alamat</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $sekolah->row()->alamat_sekolah;?></td>
    	<td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Semester</td>
    	<td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php 
      $kd_semester = $this->session->userdata('kd_semester');
      if ($kd_semester = 1) {
        $nama_semester = 'Ganjil';
      } else {
        $nama_semester = 'Genap';
      }
      echo $kd_semester.'/'.$nama_semester ?></td>
    </tr>
    <tr>
    	<td width="25%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Nama</td>
      <td width="40%px" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $datasiswa->row()->nama_lengkap;?></td>
    	<td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Tahun Pelajaran</td>
    	<td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Nomor Induk</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $datasiswa->row()->nis;?></td>
    </tr>
</table>
<hr align="center" style="display: block; height: 1px; border: 0; border-top: 2px solid #000000; margin: 1em 0; padding: 0; width: 95%;">
  <table align="center" style="width: 95%; font: 0.8em/1.5 'Arial', sans-serif;border-collapse:collapse;">
    <tr>
      <td colspan="4" align="center" style="text-align: center; column-span: 4; padding: 10 0 5 0; font-weight: bold;"><h3>CAPAIAN HASIL BELAJAR</h3></td>
    </tr>
    <tr><td colspan="4" style="padding-top: 10px;padding-bottom: 10px;font-weight: bold;font-size: 0.8em/1.5">A. Sikap</td></tr>
    <tr>
      <td style="width: 2%;"></td>
      <td colspan="3" style="padding-bottom: 10px;font-weight: bold;font-size: 0.8em/1.5">&nbsp;1. Sikap Spiritual</td>
    </tr>
    <tr>
      <td colspan="2" style="height: 20px;">&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td style="width: 1%;"></td>
      <td style="width: 20%;border:1px solid black;text-align:center;padding-left:5px;font-size: 0.8em/1.5;font-weight:bold;height:34.015748031px;">Predikat</td>
      <td style="border:1px solid black;padding-left:10px;padding-left:5px;font-size: 0.8em/1.5;font-weight:bold;">Deskripsi</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td style="border:1px solid black;padding-left:10px;font-size: 0.8em/1.5;text-align:center;">
      <?php
      foreach ($sikap as $key => $value)
      {
        if ($value->predikat_spiritual != '')
        {
          konv_pb_sb($value->predikat_spiritual);
          break;
        }
        else
        {
          echo '-';
        }
      }
      ?>
    </td>
      <td style="border:1px solid black;">
        <div class="capital" style="border-bottom:1px solid black;padding: 5px;margin-bottom:-1px; width: 100%;font-size: 0.8em/1.5">
          <p style="text-align:justify; padding: 15px;">
            <?php
            foreach ($sikap as $key => $value)
            {
              if ($value->comment_spiritual != '')
              {
                echo $value->comment_spiritual;
                break;
              }
              else
              {
                echo '<span style="color:white;">Tidak ada deskripsi untuk ditampilkan</span>';
              }
            }
            ?>
          </p>
        </div>
      </td>
    </tr>
    <tr>
      <td style="width: 2%;"></td>
      <td colspan="2" style="font-weight: bold;padding: 10px 0;font-size: 0.8em/1.5; padding: 30 0 20 0;">&nbsp;2. Sikap Sosial</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td style="border:1px solid black;text-align:center;padding-left:5px;font-size: 0.8em/1.5;font-weight:bold;height:34.015748031px;">Predikat</td>
      <td style="border:1px solid black;padding-left:10px;padding-left:5px;font-size: 0.8em/1.5;font-weight:bold;">Deskripsi</td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td style="border:1px solid black;padding-left:10px;font-size: 0.8em/1.5;text-align:center;">
      <?php
      foreach ($sikap as $key => $value) {
        if ($value->predikat_sosial != '')
        {
          $bool = $value->predikat_sosial;
          konv_pb_sb($bool);
          break;
        }
        else
        {
          echo '-';
        }
      }
      ?></td>
      <td style="border:1px solid black;">
        <div class="capital" style="padding: 5px; width: 100%;font-size: 0.8em/1.5">
          <p style="text-align:justify; padding: 15px;">
            <?php
            foreach ($sikap as $key => $value) {
              if ($value->comment != '')
              {
                echo $value->comment;
                break;
              }
              else
              {
                echo '<span style="color:white;">Tidak ada deskripsi untuk ditampilkan</span>';
              }
            }
            ?>
          </p>
        </div>
      </td>
    </tr>
  </table>
  <div style="page-break-after: always;"></div>
  <table align="center" border="0" width="95%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">
    <tr>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Nama Sekolah</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $sekolah->row()->nama_sekolah;?></td>
      <td width="15%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Kelas</td>
      <td width="20%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: 
     <?php if(str_replace('+',' ',$this->uri->segment(3)) == "X MIA") 
        { 
            echo "X 1";
        } elseif (str_replace('+',' ',$this->uri->segment(3)) == "X IIS")
        {
            echo "X 2";
        } else {
            echo str_replace('+',' ',$this->uri->segment(3));
        }?></td>
    </tr>
    <tr>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Alamat</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $sekolah->row()->alamat_sekolah;?></td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Semester</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php 
      $kd_semester = $this->session->userdata('kd_semester');
      if ($kd_semester = 1) {
        $nama_semester = 'Ganjil';
      } else {
        $nama_semester = 'Genap';
      }
      echo $kd_semester.'/'.$nama_semester ?></td>
    </tr>
    <tr>
      <td width="25%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Nama</td>
      <td width="40%px" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $datasiswa->row()->nama_lengkap;?></td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Tahun Pelajaran</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Nomor Induk</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $datasiswa->row()->nis;?></td>
    </tr>
</table>
<hr align="center" style="display: block; height: 1px; border: 0; border-top: 2px solid #000000; margin: 1em 0; padding: 0; width: 95%;">
  <table id="tabel_nilai" align="center" style="width: 95%; font-family: 'Arial', sans-serif;border-collapse: collapse">
    <tr>
      <td colspan="4" style="font-size: 0.8em/1.5;font-weight:bold; padding: 20px 0px 10px;">B. Pengetahuan</td>
    </tr>
    <tr>
      <td style="width:2.37%;"></td>
      <td colspan="4" style="border:none;font-size: 0.8em/1.5; padding-bottom: 10px;">Kriteria Ketuntasan Minimal = 65</td>
    </tr>
    <thead>
      <tr style="text-align:center; font-weight:bold;">
        <td style="width:2.37%;"></td>
        <td style="border:1px solid black;font-size: 0.8em/1.5;width:4.24%; height:52.913385827px; width: 5%;">No.</td>
        <td style="border:1px solid black;width:30.5%; font-size: 0.8em/1.5; width: 40%;">Mata Pelajaran</td>
        <td style="border:1px solid black;font-size: 0.8em/1.5; width: 10%;">Nilai</td>
        <td style="border:1px solid black;font-size: 0.8em/1.5; width: 10%;">Predikat</td>
        <td style="border:1px solid black;font-size: 0.8em/1.5; width: 35%;">Deskripsi</td>
      </tr>
    </thead>
    <tbody>
      <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ 
                echo "<tr>
                        <td>&nbsp;</td>
                        <td colspan='5' style='font-size: 0.8em/1.5;border:1px solid black; font-weight: bold; padding: 5px;'>Kelompok A (Umum)</td>
                      </tr>";
                echo trim($kolom1);
                echo "<tr>
                        <td>&nbsp;</td>
                        <td colspan='5' style='font-size: 0.8em/1.5;border:1px solid black; font-weight: bold; padding: 5px;'>Kelompok B (Umum)</td>
                      </tr>";
                echo trim($kolom2);
                echo "<tr>
                        <td>&nbsp;</td>
                        <td colspan='5' style='font-size: 0.8em/1.5;border:1px solid black; font-weight: bold; padding: 5px;'>Kelompok C (Peminatan)</td>
                    </tr>";
                echo trim($kolom3);
				echo "<tr>
                        <td>&nbsp;</td>
                        <td colspan='5' style='font-size: 0.8em/1.5;border:1px solid black; font-weight: bold; padding: 5px;'>Lintas Minat</td>
                    </tr>";
                echo trim($kolom4);
              ?>
              <?php } ?>
    </tbody>
  </table>
  <div style="page-break-before:always;""></div>
  <table align="center" border="0" width="95%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">
    <tr>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Nama Sekolah</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $sekolah->row()->nama_sekolah;?></td>
      <td width="15%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Kelas</td>
      <td width="20%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: 
     <?php if(str_replace('+',' ',$this->uri->segment(3)) == "X MIA") 
        { 
            echo "X 1";
        } elseif (str_replace('+',' ',$this->uri->segment(3)) == "X IIS")
        {
            echo "X 2";
        } else {
            echo str_replace('+',' ',$this->uri->segment(3));
        }?></td>
    </tr>
    <tr>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Alamat</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $sekolah->row()->alamat_sekolah;?></td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Semester</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php 
      $kd_semester = $this->session->userdata('kd_semester');
      if ($kd_semester = 1) {
        $nama_semester = 'Ganjil';
      } else {
        $nama_semester = 'Genap';
      }
      echo $kd_semester.'/'.$nama_semester ?></td>
    </tr>
    <tr>
      <td width="25%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Nama</td>
      <td width="40%px" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $datasiswa->row()->nama_lengkap;?></td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Tahun Pelajaran</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Nomor Induk</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $datasiswa->row()->nis;?></td>
    </tr>
</table>
<hr align="center" style="display: block; height: 1px; border: 0; border-top: 2px solid #000000; margin: 1em 0; padding: 0; width: 95%;">
  <table id="tabel_nilai" align="center" style="width: 95%; font-family: 'Arial', sans-serif;border-collapse: collapse">
    <tr>
      <td colspan="4" style="font-size: 0.8em/1.5;font-weight:bold; padding: 5px 0px 10px;">C. Keterampilan</td>
    </tr>
    <tr>
      <td style="width:2.37%;"></td>
      <td colspan="4" style="border:none;font-size: 0.8em/1.5; padding-bottom: 10px;">Kriteria Ketuntasan Minimal = 65</td>
    </tr>
    <thead>
      <tr style="text-align:center; font-weight:bold;">
        <td style="width:2.37%;"></td>
        <td style="border:1px solid black;font-size: 0.8em/1.5;width:4.24%; height:52.913385827px; width: 5%;">No</td>
        <td style="border:1px solid black;width:30.5%; font-size: 0.8em/1.5; width: 40%;">Mata Pelajaran</td>
        <td style="border:1px solid black;font-size: 0.8em/1.5; width: 10%;">Nilai</td>
        <td style="border:1px solid black;font-size: 0.8em/1.5; width: 10%;">Predikat</td>
        <td style="border:1px solid black;font-size: 0.8em/1.5; width: 35%;">Deskripsi</td>
      </tr>
    </thead>
    <tbody>
      <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ 
                echo "<tr>
                        <td>&nbsp;</td>
                        <td colspan='5' style='font-size: 0.8em/1.5;border:1px solid black; font-weight: bold; padding: 5px;'>Kelompok A (Umum)</td>
                      </tr>";
                echo trim($kolom6);
                echo "<tr>
                        <td>&nbsp;</td>
                        <td colspan='5' style='font-size: 0.8em/1.5;border:1px solid black; font-weight: bold; padding: 5px;'>Kelompok B (Umum)</td>
                      </tr>";
                echo trim($kolom7);
                echo "<tr>
                        <td>&nbsp;</td>
                        <td colspan='5' style='font-size: 0.8em/1.5;border:1px solid black; font-weight: bold; padding: 5px;'>Kelompok C (Peminatan)</td>
                    </tr>";
                echo trim($kolom8);
        echo "<tr>
                        <td>&nbsp;</td>
                        <td colspan='5' style='font-size: 0.8em/1.5;border:1px solid black; font-weight: bold; padding: 5px;'>Lintas Minat</td>
                    </tr>";
                echo trim($kolom9);
              ?>
              <?php } ?>
    </tbody>
  </table>
<table style="width: 80%; font-family: Arial, sans-serif;border-collapse: collapse; padding-top: 20px" align="center">
	<tr>
		<td style="font-weight: bold;font-size: 0.8em/1.5;padding: 10px 2px 10px 0;width:0.8%;"></td>
		<td style="font-weight: bold;font-size: 0.8em/1.5;padding: 10px 0px;" colspan="3">Tabel interval predikat berdasarkan KKM</td>
    </tr>
	<tr style="text-align:center;">
		<td>&nbsp;</td>
		<td style="height:37.795275591px; font-size: 0.8em/1.5; border:1px solid black;">KKM</td>
		<td style="font-size: 0.8em/1.5; border:1px solid black;">D</td>
		<td style="font-size: 0.8em/1.5; border:1px solid black;">C</td>
		<td style="font-size: 0.8em/1.5; border:1px solid black;">B</td>
		<td style="font-size: 0.8em/1.5; border:1px solid black;">A</td>
	</tr>
	<tr style="text-align:center;">
		<td></td>
		<td style="height:28.346456693px; font-size: 0.8em/1.5; border:1px solid black;">65</td>
		<td style="font-size: 0.8em/1.5; border:1px solid black;">Nilai &lt; 65</td>
		<td style="font-size: 0.8em/1.5; border:1px solid black;">65 <img src="edusis_asset/edusisimg/besar_sama.jpg" style="width: 8px; padding-top:1px;"/> nilai &lt; 77</td>
		<td style="font-size: 0.8em/1.5; border:1px solid black;">77 <img src="edusis_asset/edusisimg/besar_sama.jpg" style="width: 8px; padding-top:1px;"/> nilai &lt; 88</td>
		<td style="font-size: 0.8em/1.5; border:1px solid black;">88 <img src="edusis_asset/edusisimg/besar_sama.jpg" style="width: 8px; padding-top:1px;"/> nilai <img src="edusis_asset/edusisimg/kecil_sama.jpg" style="width: 8px; padding-top:1px;"/> 100</td>
	</tr>
  </table>
  <div style="page-break-after: always;"></div>
   <table align="center" border="0" width="95%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">
    <tr>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Nama Sekolah</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $sekolah->row()->nama_sekolah;?></td>
      <td width="15%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Kelas</td>
      <td width="20%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: 
     <?php if(str_replace('+',' ',$this->uri->segment(3)) == "X MIA") 
        { 
            echo "X 1";
        } elseif (str_replace('+',' ',$this->uri->segment(3)) == "X IIS")
        {
            echo "X 2";
        } else {
            echo str_replace('+',' ',$this->uri->segment(3));
        }?></td>
    </tr>
    <tr>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Alamat</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $sekolah->row()->alamat_sekolah;?></td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Semester</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php 
      $kd_semester = $this->session->userdata('kd_semester');
      if ($kd_semester = 1) {
        $nama_semester = 'Ganjil';
      } else {
        $nama_semester = 'Genap';
      }
      echo $kd_semester.'/'.$nama_semester ?></td>
    </tr>
    <tr>
      <td width="25%" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Nama</td>
      <td width="40%px" style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $datasiswa->row()->nama_lengkap;?></td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Tahun Pelajaran</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">Nomor Induk</td>
      <td style=" font-size: 0.8em/1.5 'Arial', sans-serif;">: <?php echo $datasiswa->row()->nis;?></td>
    </tr>
  </table>
  <hr align="center" style="display: block; height: 1px; border: 0; border-top: 2px solid #000000; margin: 1em 0; padding: 0; width: 95%;">
  <table style="margin-top:10px;border-collapse:collapse;width: 95%; font-family: 'Arial', sans-serif; padding-top: 5px;" align="center">
	<tr>
      <td style="font-weight: bold;font-size: 0.8em/1.5;padding: 10px 2px 10px 0;width:0.8%;">D.</td>
      <td style="font-weight: bold;font-size: 0.8em/1.5;padding: 10px 0px;" colspan="3">Ekstrakurikuler</td>
    </tr>
    <tr>
      <th></th>
      <th style="height:37.795275591px;text-align:center;font-size:0.8em/1.5;border:1px solid black;width:1%;">No</th>
      <th style="padding:10px 0;border:1px solid black;font-size:0.8em/1.5;width:40.3%;">Kegiatan Ekstrakurikuler</th>
      <th style="border:1px solid black;font-size:0.8em/1.5;">Keterangan</th>
    </tr>
      <?php
                  $ii = 1;
                  foreach($eskul->result() as $row)
                  {
                      $bg = ($ii%2==0) ? ' class="bg" ' : '';
                      echo '<tr'.$bg.'>';
                      echo '<td style="width:0.7%;"></td>';
                      echo '<td align="center" style="height:28.346456693px;border:1px solid black;width: 0.5%;font-size:0.8em/1.5;">'.$ii.'</td>';
                      echo '<td style="border:1px solid black;padding-left: 5px;font-size:0.8em/1.5;">'.$row->nm_eskul.'</td>';
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
  <table style="margin-top:10px;border-collapse:collapse;width: 95%; font-family: 'Arial', sans-serif;" align="center">
    <tr>
      <td colspan="4" style="font-weight: bold;font-size: 0.8em/1.5;padding-bottom:15px;">E. Prestasi</td>
    </tr>
    <tr style="text-align:center;">
      <td style="width:2.15%;"></td>
      <td style="font-weight: bold;font-size: 0.8em/1.5;height:34.015748031px;width:4.5%;border:1px solid black;">No.</td>
      <td style="border:1px solid black;width:40%;font-weight: bold;font-size: 0.8em/1.5;">Jenis Kegiatan</td>
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
  <table style="width: 95%; font-family: 'Arial', sans-serif;margin-top:10px;" align="center">
    <tr>
        <td style="width: 100%;"><table style="width:100%;border-collapse:collapse;">
        <tr>
            <td style="font-size: 0.8em/1.5;font-weight:bold;padding-bottom:10px;">F.</td>
            <td colspan="3" style="font-size: 0.8em/1.5;font-weight:bold;padding-bottom:10px;">Ketidakhadiran</td>
        </tr>
        <tr>
            <td style="width:1%;"></td>
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
    </tr>
  </table>

  <table style="border-collapse:collapse;width: 95%; font-family: 'Arial', sans-serif;margin-top:10px;" align="center">
    <tr>
      <td style="font-weight: bold;font-size: 0.8em/1.5; padding: 0 0px 10px;padding-right:1px;">G.</td>
      <td style="font-weight: bold;font-size: 0.8em/1.5; padding: 0 0px 10px;">Catatan Wali Kelas</td>
    </tr>
    <tr>
      <td style="width:0.1%;"></td>
      <?php
      $vall = 1;
      $valll;
      foreach ($catatan_siswa as $key => $value)
      {
        if ($value->comment != '')
        {
          echo '<td><div style="border:1px solid black;padding:10px;width:100%;font-size: 0.8em/1.5;text-align:justify;">'.$value->comment.'</div></td>';
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
  <table style="border-collapse:collapse;width: 96%; font-family: 'Arial', sans-serif;" align="center">
    <tr>
      <td style="width:1%;font-weight: bold;font-size: 0.8em/1.5; padding: 10px 3px 15px 0;">H.</td>
      <td colspan="1" style="font-weight: bold;font-size: 0.8em/1.5; padding: 10px 0px 15px;">Tanggapan Orang Tua / Wali</td>
    </tr>
  </table>
  <div style="border:1px solid black;width:93%;height:100px;margin-left:31px;"></div>
  <?php
  if ($p_nl != '1') {
  ?>
  <div style="border:1px solid black;width:93%;margin-left:30px;margin-top:20px;padding:10px -10px 10px 10px;font-size: 0.8em/1.5;"><span style="font-weight:bold;"> Keterangan Kenaikan Kelas: </span> Naik/Tidak Naik*) ke kelas XI/XII *)</div>
  <span style="margin-left:30px;font-size: 0.7em/1.3;">*) Coret yang tidak perlu</span>
  <?php } ?>
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
      <td colspan="2" style="font-size: 0.8em/1.5"></td>
      <td style="font-size: 0.8em/1.5"><?php echo $sekolah->row()->kabupaten;?>, <?php echo $dlmtStr[2].' ';echo $bln.' ';echo $dlmtStr[0].' '; ?></td>
    </tr>
    <tr>
      <td style="font-size: 0.8em/1.5">Orang Tua/Wali,</td>
      <td></td>
      <td style="font-size: 0.8em/1.5"></td>
      <td></td>
      <td style="width:25%;font-size: 0.8em/1.5">Wali Kelas,</td>
    </tr>
    <tr>
      <td style="height:70px;"></td>
      <td colspan="2"></td>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="2" style="font-size: 0.8em/1.5"><?php echo $datasiswa->row()->ayah_nama; ?></td>
      <td colspan="2" style="font-size: 0.8em/1.5"></td>
      <td style="font-size: 0.8em/1.5"><u><?php foreach ($walikelas as $key => $value) {
        echo $value->nama_lengkap;
      } ?></u></td>
    </tr>
    <tr>
      <td colspan="2" style="font-size: 0.8em/1.5"></td>
      <td colspan="2" style="font-size: 0.8em/1.5"></td>
      <td style="font-size: 0.8em/1.5">NIP. <?php foreach ($walikelas as $key => $value) {
        echo $value->wali_kelas;
      } ?></td>
    </tr>
	<tr>
		<td style="font-size: 0.8em/1.5;padding-left:280px;">Mengetahui</td>
	</tr>
	<tr>
		<td style="font-size: 0.8em/1.5;padding-left:280px;">Kepala Sekolah,</td>
	</tr>
	<tr>
		<td style="height:70px;"></td>
	</tr>
	<tr>
		<td colspan="5" style="font-size: 0.8em/1.5;padding-left:280px;"><span style="text-decoration: underline;"><?php echo $kepsek->row()->nama_lengkap;?></span><br />NIP. <?php echo $kepsek->row()->nip; ?></td>
	</tr>
  </table>
</div>
</body>
</html>
<!--  -->
