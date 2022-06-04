<?php $this->load->view('page_head');?>
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

function konversi_sma($tmp)
{
    $predikat = "";
                if($tmp==0) {
					$predikat = '-';
				}elseif($tmp<=1.00){
                    $predikat = 'D';
                }elseif ($tmp<=1.33){
                    $predikat = 'D+';
                }elseif ($tmp<=1.66){
                    $predikat = 'C-';
                }elseif ($tmp<=2.00){
                    $predikat = 'C';
                }elseif ($tmp<=2.33){
                    $predikat = 'C+';
                }elseif ($tmp<=2.66){
                    $predikat = 'B-';
                }elseif ($tmp<=3.00){
                    $predikat = 'B';
                }elseif ($tmp<=3.33){
                    $predikat = 'B+';
                }elseif ($tmp<=3.66){
                    $predikat = 'A-';
                }elseif ($tmp<=4.00){
                    $predikat = 'A';
                }
    return $predikat;
}

function konversi($tmp)
{
    $predikat = "";
    if ($tmp<=0) {
      $predikat = '-';
    }elseif($tmp<=1.17){
      $predikat = 'D';
    }elseif ($tmp<=1.50){
        $predikat = 'D+';
    }elseif ($tmp<=1.84){
        $predikat = 'C-';
    }elseif ($tmp<=2.17){
        $predikat = 'C';
    }elseif ($tmp<=2.50){
        $predikat = 'C+';
    }elseif ($tmp<=2.84){
        $predikat = 'B-';
    }elseif ($tmp<=3.17){
        $predikat = 'B';
    }elseif ($tmp<=3.50){
        $predikat = 'B+';
    }elseif ($tmp<=3.84){
        $predikat = 'A-';
    }elseif ($tmp<=4){
        $predikat = 'A';
    }
    return $predikat;
}

function konversi_sikap($tmp)
{
    $predikat = "";
                if($tmp==0){
                    $predikat = '';
                }
                elseif($tmp<=37.5){
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
function konversi_predikat_smp_k13($tmp, $arr)
{
  $predikat;
  if ($tmp <= 0) {
    $predikat = array(' - ', ' - ');
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
?>
<body>
<style>
.clrBth {
  clear: both;
}
.clsSkp {
  width: 100%;
  margin-bottom: 20px;
}
.clsSkp h3 {
  background: #0088ff;
  margin-bottom: 0;
  padding: 10px 10px 10px 5px;
  color: white;
  border: 1px solid #ececec;
}
.sikap {
  width: 49.5%;
}
.sikap .deskripsi {
  padding: 10px;
  border: 1px solid #a9a9a9;
  height: 100px;
  background-color: #e8f6ff;
  width: 78%;
  float: left;
}
.sikap .predikat {
  padding: 10px;
  border: 1px solid #a9a9a9;
  height: 100px;
  background-color: #e8f6ff;
  width: 15%;
  float: left;
}
.kiri {
  float: left;
}
.kanan {
  float: right;
}
.eksKhdrn {
  width: 100%;
  height: 180px;
  margin-bottom: 20px;
}
.eskul {
  width: 49.5%;
  height: 100%;
}
#eksId {
  width: 100%;
  border: 1px solid black;
  vertical-align: middle;
}
#eksId tr:nth-child(odd) {
  background-color: #e8f6ff;
}
.khdrn {
  width: 49.5%;
  height: 100%;
}
.khdrn table {
  width: 100%;
  height: 100%;
  vertical-align: middle;
}
.khdrn table tr:nth-child(odd) {
  background-color: #e8f6ff;
}
.prstKptsn {
  width: 100%;
  height: 100%;
}
.kptsn {
  width: 49.5%;
}
.kptsn table {
  width: 100%;
}
.prsts {
  width: 49.5%;
}
.prsts table {
  width: 100%;
}
.prsts table tr:first-child {
  background-color: #0088ff;
}
</style>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>CAPAIAN KOMPETENSI</h1>
<div id="tab01">
    <form action="<?php echo base_url().'index.php/hasilbelajar/lck' ?>" method="POST" id="frmhasilbelajar">
    <!--atur pd (edusis_system/helpers/form_helper.php)function form_hidden, dg menambahkan (id="'.$name.'")-->
    <?php echo form_hidden('myurl',site_url('hasilbelajar')) ?>
    <!--table filter-->
    <table border="1" width="100%">
        <tr>
            <td width="100px">Kelas</td>
            <td width="300px">
            <select name="skelas" id="skelas" onchange="pilih()">
    		<?php
    			echo '<option value="0" class="input-text"></option>';
                $arraykelas = array();
    			if($skelas->num_rows() !=0)
    			{
    				foreach($skelas->result () as $rowkelas )
    				{
    					$selected		='';
    					if($pilihkelas == trim($rowkelas->kelas))
    					{
    						$selected	= 'selected="selected"';
    					}
    				echo '<option value="'.trim($rowkelas->kelas).'" '.$selected.'>'.$rowkelas->kelas.'</option>';
    				}
    			}
    		?>
    		</select>
            </td>
            <td align="right" width="">
            <?php if($this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
            <a href="<?php echo base_url().'index.php/export/export_depan_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Sampul Ledger" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Sampul </a>
            <a href="<?php echo base_url().'index.php/export/profile_sekolah_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print " class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Profil Sekolah</a>
            <a href="<?php echo base_url().'index.php/siswa/profile_pdf/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Profil Siswa" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Profil&nbsp&nbsp&nbsp  </a>
            <?php 
              if ($this->session->userdata('th_ajar') == '2017/2018 ') { ?>
                <a href="<?php echo base_url().'index.php/export/export_nilai1/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Rapor 1" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Raport.1  </a>
              <?php } else { ?>
                <a href="<?php echo base_url().'index.php/export/export_nilai1/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Rapor 1" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Raport.1  </a>
                <a href="<?php echo base_url().'index.php/export/export_lck_deskripsi_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Rapor 2" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Raport.2</a>
              <?php } 
                } ?>
            </td>
        </tr>
        <tr>
            <td>Nama Siswa</td>
            <td>
                <div id="resultnama">
                <?php
                    $option = array(0=>"&nbsp;");
                    foreach ($nama->result() as $row)
                    {
                        $option = $option + array(trim($row->nis)=>$row->nama_lengkap) ;
                    }
                    //echo $nis;
                    echo form_dropdown('nis',$option,$nis,'id="nis"');
                ?>
                </div>
            </td>
            <td>
                <a href="javascript:filter()" class="small button blue">Filter</a>
            </td>
        </tr>
    </table>
    <!--end table filter-->
    <!--table daftar hasil study-->
    <?php if($tampil==''){} else { ?>
    <form action="" method="post">
      <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
      <div class="clsSkp">
        <div class="sikap kiri">
          <h3>Sikap Spiritual</h3>
          <div class="predikat">
            <span>Predikat:</span>
            <p>
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
          </p>
          </div>
          <div class="deskripsi">
            <span>Deskripsi:</span>
            <p>
              <?php
              foreach ($sikap as $key => $value) {
                echo $value->comment_spiritual;
                break;
              };
              ?>
          </p>
          </div>
        </div>
        <div class="sikap kanan">
          <h3>Sikap Sosial</h3>
          <div class="predikat">
            <span>Predikat:</span>
            <p>
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
              ?>
          </p>
          </div>
          <div class="deskripsi">
            <span>Deskripsi</span><br />
            <p>
              <?php
              foreach ($sikap as $key => $value) {
                echo $value->comment;
                break;
              };
              ?>
            </p>
          </div>
        </div>
        <div class="clrBth"></div>
      </div>
      <?php } ?>
      <?php 
      if ($this->session->userdata('th_ajar') == '2017/2018 ') {
        //======== Nilai Pengetahuan ===============================// 
    if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0') 
      { 
        $a      = 0;
        $jmlkgn = 0;
        $jmh_mp = $hasilbelajar->num_rows();

        $kolom1 = "";
        $kolom2 = "";
        
        $i  = 1;
        foreach($hasilbelajar->result() as $row)
        {
          $kel = $row->urutan;
          if($kel <= 6) 
          {
            $bg = ($i%2==0) ? ' class="bg" ' : '';
            $kolom1 .= '<tr'.$bg.'>';
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
        
        $j = 9;
        foreach($hasilbelajar->result() as $row)
        {
          $kel = $row->urutan;
          if(($kel > 6)&&($kel < 11)) 
          {
            $bg = ($j%2==0) ? ' class="bg" ' : '';
            $kolom2 .= '<tr'.$bg.'>';
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
            $kgn        = ($row->kgn=='0' || $row->kgn==0) ? '0' : $row->kgn;
            $tmp_kgn      = $row->kgn*4/100;
            $empatskala_kgn = konversi_sma_4skala($kgn);
            $bg = ($k%2==0) ? ' class="bg" ' : '';
            $kolom3 .= '<tr'.$bg.'>';
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
            $kgn        = ($row->kgn=='0' || $row->kgn==0) ? '0' : $row->kgn;
            $tmp_kgn      = $row->kgn*4/100;
            $empatskala_kgn = konversi_sma_4skala($kgn);
            $bg = ($l%2==0) ? ' class="bg" ' : '';
            $kolom4 .= '<tr'.$bg.'>';
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
      } else {
        if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
            <?php
            $a  = 0;
            $i  = 1;
            $jmlkgn = 0;

        $jmh_mp = $hasilbelajar->num_rows();

            $kolom1 = "";
            $kolom2 = "";
            $kolom3 = "";
      $kolom4 = "";

        foreach($hasilbelajar->result() as $row)
            {
                $kel = $row->urutan;
                if($kel <= 6)
                {
                    $kgn        = ($row->kgn=='0') ? '0' : $row->kgn;
                    $tmp_kgn      = $row->kgn*4/100;
                    $empatskala_kgn = konversi_sma_4skala($kgn);
                    $bg = ($i%2==0) ? ' class="bg" ' : '';
            $kolom1 .= '<tr'.$bg.'>';
            $kolom1 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #a9a9a9;">'.$i.'</td>';
            $kolom1 .= '<td style="border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;">'.$row->nm_mp.'</td>';
          $kolom1 .= '<td style="border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5; text-align: center;">'.$row->skbm.'</td>';

              $kolom1 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #a9a9a9;">  '.konv_nol($row->kgn).'</td>';
              $kolom1 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #a9a9a9;">'.konversi_predikat_smp_k13($row->kgn, 0).'</td>';
          
                        $jmlkgn += $row->kgn;


              $psk        = ($row->psk=='0') ? '0' : $row->psk;
                        $tmp_psk      = $row->psk*4/100;
              $empatskala_psk = konversi_sma_4skala($psk);
              
              $kolom1 .= '<td align="center" style="border:1px solid #a9a9a9;font-size: 0.8em/1.5;">'.konv_nol($row->psk).'</td>';
              $kolom1 .= '<td align="center" style="border:1px solid #a9a9a9;font-size: 0.8em/1.5;">'.konversi_predikat_smp_k13($row->psk, 0).'</td>';
                   
              $predikat = konversi_sikap($row->afk);

          $kolom1 .= '</tr>';
                $i++;
                $a++;
                $kolom2 = $row->antar_mp;
                }
            }

            $j = 1;
            foreach($hasilbelajar->result() as $row)
            {
                $kel = $row->urutan;
                if(($kel > 6)&&($kel < 11))
                {
                    $kgn        = ($row->kgn=='0') ? '0' : $row->kgn;
                    $tmp_kgn      = $row->kgn*4/100;
                    $empatskala_kgn = konversi_sma_4skala($kgn);
                    $bg = ($j%2==0) ? ' class="bg" ' : '';
            $kolom2 .= '<tr'.$bg.'>';
            $kolom2 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #a9a9a9;">'.$j.'</td>';
            $kolom2 .= '<td style="border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;">'.$row->nm_mp.'</td>';
          $kolom2 .= '<td style="border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5; text-align: center;">'.$row->skbm.'</td>';
              $kolom2 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #a9a9a9;">  '.konv_nol($row->kgn).'</td>';
              $kolom2 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #a9a9a9;">'.konversi_predikat_smp_k13($row->kgn, 0).'</td>';
          
                        $jmlkgn += $row->kgn;


              $psk        = ($row->psk=='0') ? '0' : $row->psk;
                        $tmp_psk      = $row->psk*4/100;
              $empatskala_psk = konversi_sma_4skala($psk);
                    if ($kd_sekolah=='04')
                    {
              $kolom2 .= '<td align="center" style="border:1px solid #a9a9a9;font-size: 0.8em/1.5;">'.konv_nol($row->psk).'</td>';
              $kolom2 .= '<td align="center" style="border:1px solid #a9a9a9;font-size: 0.8em/1.5;">'.konversi_predikat_smp_k13($row->psk, 0).'</td>';
                    }
          else
          {
                      $nliKtrpl = $row->psk*4/100;
                      if ($nliKtrpl <= 0)
            {
                        $nliKtrpl = '-';
                      }
                      else
            {
                        $nliKtrpl = $nliKtrpl;
                      }
              $kolom2 .= '<td align="center" style="border:1px solid #a9a9a9;font-size: 0.8em/1.5;">'. $nliKtrpl .'</td>';
              $kolom2 .= '<td align="center" style="border:1px solid #a9a9a9;font-size: 0.8em/1.5;">'.konversi($tmp_psk, 0).'</td>';
            }
              $predikat = konversi_sikap($row->afk);
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
                    $kgn        = ($row->kgn=='0') ? '0' : $row->kgn;
                    $tmp_kgn      = $row->kgn*4/100;
                    $empatskala_kgn = konversi_sma_4skala($kgn);
                    $bg = ($k%2==0) ? ' class="bg" ' : '';
            $kolom3 .= '<tr'.$bg.'>';
            $kolom3 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #a9a9a9;">'.$k.'</td>';
            $kolom3 .= '<td style="border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;">'.$row->nm_mp.'</td>';
          $kolom3 .= '<td style="border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5; text-align: center;">'.$row->skbm.'</td>';
              $kolom3 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #a9a9a9;">  '.konv_nol($row->kgn).'</td>';
              $kolom3 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #a9a9a9;">'.konversi_predikat_smp_k13($row->kgn, 0).'</td>';
          
                        $jmlkgn += $row->kgn;


              $psk        = ($row->psk=='0') ? '0' : $row->psk;
                        $tmp_psk      = $row->psk*4/100;
              $empatskala_psk = konversi_sma_4skala($psk);
                 
              $kolom3 .= '<td align="center" style="border:1px solid #a9a9a9;font-size: 0.8em/1.5;">'.konv_nol($row->psk).'</td>';
              $kolom3 .= '<td align="center" style="border:1px solid #a9a9a9;font-size: 0.8em/1.5;">'.konversi_predikat_smp_k13($row->psk, 0).'</td>';
                   
              $predikat = konversi_sikap($row->afk);
            
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
                    $kgn        = ($row->kgn=='0') ? '0' : $row->kgn;
                    $tmp_kgn      = $row->kgn*4/100;
                    $empatskala_kgn = konversi_sma_4skala($kgn);
                    $bg = ($l%2==0) ? ' class="bg" ' : '';
            $kolom4 .= '<tr'.$bg.'>';
            $kolom4 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #a9a9a9;">'.$l.'</td>';
            $kolom4 .= '<td style="border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;">'.$row->nm_mp.'</td>';
          $kolom4 .= '<td style="border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5; text-align: center;">'.$row->skbm.'</td>';

              $kolom4 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #a9a9a9;">  '.konv_nol($row->kgn).'</td>';
              $kolom4 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #a9a9a9;">'.konversi_predikat_smp_k13($row->kgn, 0).'</td>';
          
                        $jmlkgn += $row->kgn;


              $psk        = ($row->psk=='0') ? '0' : $row->psk;
                        $tmp_psk      = $row->psk*4/100;
              $empatskala_psk = konversi_sma_4skala($psk);
                
              $kolom4 .= '<td align="center" style="border:1px solid #a9a9a9;font-size: 0.8em/1.5;">'.konv_nol($row->psk).'</td>';
              $kolom4 .= '<td align="center" style="border:1px solid #a9a9a9;font-size: 0.8em/1.5;">'.konversi_predikat_smp_k13($row->psk, 0).'</td>';
            
              $predikat = konversi_sikap($row->afk);
            
          $kolom4 .= '</tr>';
                $l++;
                $a++;
                }
            }
        }
      }
            ?>

      <?php  
        if ($this->session->userdata('th_ajar') == '2017/2018 ') { ?>
        <h3>Pengetahuan</h3>
            <table align="center" style="width: 100%; font-family: 'Arial';border-collapse: collapse">
              <thead style="background: #0088ff;color:white;">
                <tr style="text-align:center; font-weight:bold;">
                  <td style="width:2%; vertical-align:middle;border:1px solid #a9a9a9;font-size: 18px; height:52.913385827px;">No.</td>
                  <td style="width:38%; vertical-align:middle;border:1px solid #a9a9a9;width:15%; font-size: 18px;">Mata Pelajaran</td>
                  <td style="width:5%; vertical-align:middle; border:1px solid #a9a9a9;font-size: 18px;">Nilai</td>
                  <td style="width:5%; vertical-align:middle; font-size: 18px;border:1px solid #a9a9a9;">Predikat</td>
                  <td style="width:35%; vertical-align:middle; font-size: 18px;border:1px solid #a9a9a9;">Deskripsi</td>
                </tr>
              </thead>
              <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){
                echo "<tr>
                        <td colspan='5' style='border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;'>Kelompok A (Umum)</td>
                      </tr>";
                echo trim($kolom1);
                echo "<tr>
                        <td colspan='5' style='border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;'>Kelompok B (Umum)</td>
                      </tr>";
                echo trim($kolom2);
                echo "<tr>
                        <td colspan='5' style='border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;'>Kelompok C (Peminatan)</td>
                    </tr>";
                echo trim($kolom3);
        echo "<tr>
                        <td colspan='5' style='border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;'>Lintas Minat</td>
                    </tr>";
                echo trim($kolom4);
              ?>
              <?php } ?>
            </table>
          <h3>Keterampilan</h3>
            <table align="center" style="width: 100%; font-family: 'Arial';border-collapse: collapse">
              <thead style="background: #0088ff;color:white;">
                <tr style="text-align:center; font-weight:bold;">
                  <td style="width:2%; vertical-align:middle;border:1px solid #a9a9a9;font-size: 18px; height:52.913385827px;">No.</td>
                  <td style="width:38%; vertical-align:middle;border:1px solid #a9a9a9;width:15%; font-size: 18px;">Mata Pelajaran</td>
                  <td style="width:5%; vertical-align:middle; border:1px solid #a9a9a9;font-size: 18px;">Nilai</td>
                  <td style="width:5%; vertical-align:middle; font-size: 18px;border:1px solid #a9a9a9;">Predikat</td>
                  <td style="width:35%; vertical-align:middle; font-size: 18px;border:1px solid #a9a9a9;">Deskripsi</td>
                </tr>
              </thead>
              <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){
                echo "<tr>
                        <td colspan='5' style='border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;'>Kelompok A (Umum)</td>
                      </tr>";
                echo trim($kolom1);
                echo "<tr>
                        <td colspan='5' style='border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;'>Kelompok B (Umum)</td>
                      </tr>";
                echo trim($kolom2);
                echo "<tr>
                        <td colspan='5' style='border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;'>Kelompok C (Peminatan)</td>
                    </tr>";
                echo trim($kolom3);
        echo "<tr>
                        <td colspan='5' style='border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;'>Lintas Minat</td>
                    </tr>";
                echo trim($kolom4);
               } ?>
            </table>
        <?php } else { ?>
           <table align="center" style="width: 100%; font-family: 'Arial';border-collapse: collapse">
              <thead style="background: #0088ff;color:white;">
                <tr style="text-align:center; font-weight:bold;">
                  <td rowspan="2" style="width:2%; vertical-align:middle;border:1px solid #a9a9a9;font-size: 18px; height:52.913385827px;">No.</td>
                  <td rowspan="2" style="width:30%; vertical-align:middle;border:1px solid #a9a9a9;width:15%; font-size: 18px;">Mata Pelajaran</td>
          <td rowspan="2" style="width:5%; vertical-align:middle;border:1px solid #a9a9a9;width:15%; font-size: 18px;">KKM</td>
                  <td colspan="2" style="width:30%; border:1px solid #a9a9a9;font-size: 18px;">Pengetahuan</td>
                  <td colspan="2" style="width:30%; font-size: 18px;border:1px solid #a9a9a9;">Keterampilan</td>
                </tr>
                <tr style="text-align:center;font-weight:bold;">
                  <td style="width:5%; font-size: 14px;border:1px solid #a9a9a9;">Angka</td>
                  <td style="width:5%; font-size: 14px;border:1px solid #a9a9a9;">Predikat</td>
                  <!---<td style="width:15%; font-size: 14px;border:1px solid #a9a9a9;">Deskripsi</td>-->
                  <td style="width:5%; font-size: 14px;border:1px solid #a9a9a9;">Angka</td>
                  <td style="width:5%; font-size: 14px;border:1px solid #a9a9a9;">Predikat</td>
                  <!---<td style="width:15%; font-size: 14px;border:1px solid #a9a9a9;">Deskripsi</td>-->
                </tr>
              </thead>
              <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){
                echo "<tr>
                        <td colspan='8' style='border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;'>Kelompok A (Umum)</td>
                      </tr>";
                echo trim($kolom1);
                echo "<tr>
                        <td colspan='8' style='border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;'>Kelompok B (Umum)</td>
                      </tr>";
                echo trim($kolom2);
                echo "<tr>
                        <td colspan='8' style='border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;'>Kelompok C (Peminatan)</td>
                    </tr>";
                echo trim($kolom3);
        echo "<tr>
                        <td colspan='8' style='border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5;'>Lintas Minat</td>
                    </tr>";
                echo trim($kolom4);
              ?>
              <?php } ?>
            </table>
        <?php } ?>
            <br />
			Tabel Interval Predikat Berdasarkan KKM<br/>
			<table align="center" style="width: 100%; font-family: 'Arial';border-collapse: collapse">
                <tr style="height:40px;background: #0088ff;color: white;text-align: center;font-weight: bold;">
                    <td style="vertical-align:middle;border:1px solid #cfcfcf;width:2%;text-align:center;">KKM</td>
                    <td style="vertical-align:middle;border:1px solid #cfcfcf;">D = Kurang</td>
                    <td style="vertical-align:middle;border:1px solid #cfcfcf;">C = Cukup</td>
                    <td style="vertical-align:middle;border:1px solid #cfcfcf;">B = Baik</td></td>
                    <td style="vertical-align:middle;border:1px solid #cfcfcf;">A = Sangat Baik</td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;border:1px solid #cfcfcf;text-align:center;">65</td>
                    <td style="vertical-align:middle;border:1px solid #cfcfcf; text-align:center;">Nilai &lt; 65</td>
                    <td style="vertical-align:middle;border:1px solid #cfcfcf; text-align:center;">65 &ge; nilai &lt; 77</td>
                    <td style="vertical-align:middle;border:1px solid #cfcfcf; text-align:center;">77 &ge; nilai &lt; 88</td>
                    <td style="vertical-align:middle;border:1px solid #cfcfcf; text-align:center;">88 &ge; nilai &le; 100</td>
                </tr>
            </table>
            <br />
            <div class="eksKhdrn">
              <div class="kiri eskul" border="1">
                <table id="eksId" style="height:100%;">
                  <tr style="height:40px;background: #0088ff;color: white;text-align: center;font-weight: bold;">
                    <td style="vertical-align:middle;border:1px solid #cfcfcf;width:2%;text-align:center;">No.</td>
                    <td style="vertical-align:middle;border:1px solid #cfcfcf;">Kegiatan Ekstrakurikuler</td>
                    <td style="vertical-align:middle;border:1px solid #cfcfcf;">Keterangan</td>
                  </tr>
                  <?php
                  $i = 1;
                  foreach($eskul->result() as $row)
                  {
                      $bg = ($i%2==0) ? ' class="bg" ' : '';
                      echo '<tr>';
                      echo '<td style="border:1px solid #cfcfcf;text-align:center;">'.$i.'</td>';
                      echo '<td style="border:1px solid #cfcfcf;">'.$row->nm_eskul.'</td>';
                      $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
                      echo '<td style="border:1px solid #cfcfcf;">'.$nilai.'</td>';
                      echo '</tr>';
                      $i++;
                    }
                  ?>
                </table>
              </div>
              <div  class="kanan khdrn">
                <table>
                  <tr>
                      <td style="border:1px solid #a9a9a9;border-right:1px solid rgba(0, 0, 0, 0);">Sakit</td>
                      <td style="border:1px solid #a9a9a9;border-right:1px solid rgba(0, 0, 0, 0);">:</td>
                      <td style="border:1px solid #a9a9a9;"><?php $a=($absens->row()->alfa == '0') ? '-' : $absens->row()->alfa; echo $a; ?> Hari</td>
                  </tr>
                  <tr>
                      <td style="border:1px solid #a9a9a9;border-right:1px solid rgba(0, 0, 0, 0);">Ijin</td>
                      <td style="border:1px solid #a9a9a9;border-right:1px solid rgba(0, 0, 0, 0);">:</td>
                      <td style="border:1px solid #a9a9a9;"><?php $a=($abseni->row()->alfa == '0') ? '-' : $abseni->row()->alfa; echo $a; ?> Hari</td>
                  </tr>
                  <tr>
                      <td style="border:1px solid #a9a9a9;border-right:1px solid rgba(0, 0, 0, 0);">Tanpa Keterangan</td>
                      <td style="border:1px solid #a9a9a9;border-right:1px solid rgba(0, 0, 0, 0);">:</td>
                      <td style="border:1px solid #a9a9a9;"><?php $a=($abseina->row()->alfa == '0') ? '-' : $abseina->row()->alfa; echo $a; ?> Hari</td>
                  </tr>
                </table>
              </div>
              <div class="clrBth"></div>
            </div>
            <div id="prstKptsn">
              <div class="kanan prsts">
                <table>
                  <tr style="font-weight:bold;color:white;height:40px;">
                    <td style="border:1px solid #cfcfcf;width:2%;text-align:center;vertical-align:middle;">No.</td>
                    <td style="border:1px solid #cfcfcf;vertical-align:middle;">Jenis Prestasi</td>
                    <td style="border:1px solid #cfcfcf;vertical-align:middle;">Keterangan</td>
                  </tr>
                  <?php
                  $seq = 1;
                  foreach($prestasi->result() as $row)
                  {
                      $bg = ($seq%2==0) ? ' class="bg" ' : '';
                      echo '<tr>';
                      echo '<td style="border:1px solid #a9a9a9;text-align:center;">'.$row->kd_prestasi.'</td>';
                      echo '<td style="border:1px solid #a9a9a9;">'.$row->nm_prestasi.'</td>';
                      //echo '<td align="center">'.$row->point.'</td>';
                      echo '<td style="border:1px solid #a9a9a9;">'.$row->ket.'</td>';
                      echo '</tr>';
                      $seq++;
                  }
                  ?>
                </table>
              </div>
              <div class="kiri kptsn">
                <table style="border:1px solid #a9a9a9;background-color:#e8f6ff;">
                  <tr>
                    <td colspan="3">Keterangan kenaikian kelas:</td>
                  </tr>
                  <tr>
                    <td colspan="3">
                      <?php
                        $kelas_lama = str_replace('+',' ',$this->uri->segment(3));
                        $naik_kelas = array('X IPA'=>'XI IPA (Sebelas IPA)','X IPS 1'=>'XI IPS (Sebelas IPS)','X IPS 2'=>'XI IPS (Sebelas IPS)','XI IPA'=>'XII IPA (Duabelas IPA)','XI IPS'=>'XII IPS (Duabelas IPS)','XI IPS 2'=>'XII IPS (Duabelas IPS)');
                          foreach($naik_kelas as $keynaik_kelas=>$valuenaik_kelas)
                          {
                            if(trim($kelas_lama) == $keynaik_kelas) {
                              echo "Naik ke kelas <u>$valuenaik_kelas</u>";
                            }
                          }
                      ?>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="clrBth"></div>
            </div>
    <!--end table hasil study-->
    <br />
    </form>
    </div>
    <?php } ?>
</div>
</div> <!-- /content -->
</div> <!-- /cols -->
<hr class="noscreen" />
<!-- Footer -->
<?php $this->load->view('page_footer'); ?>
<script type="text/javascript">

    function filter()
    {
        var kelas         = urlencode($('#skelas').val());//utlencode pd javascript digunakan untuk merubah caracter sepasi, spt str_replece pd php
        var nis           = $('#nis').val();
        var myurl         = $('#myurl').val();
        var form_wi       = $('#frmhasilbelajar').attr('action');
        $('#frmhasilbelajar').attr('action',form_wi+'/'+kelas+'/'+nis);
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
