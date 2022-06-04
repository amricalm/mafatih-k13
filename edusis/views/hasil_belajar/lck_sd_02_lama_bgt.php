<?php $this->load->view('page_head');?>
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
  margin-bottom: 20px;
}
.eskul {
  width: 49.5%;
}
#eksId {
  width: 100%;
  border: 1px solid #cfcfcf;
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
    <h1>Rapor</h1>
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
            <!-- <a href="<?php echo base_url().'index.php/export/profile_sekolah_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print " class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Profil Sekolah</a> -->
            <a href="<?php echo base_url().'index.php/siswa/profile_pdf/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Profil Siswa" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Profil&nbsp&nbsp&nbsp  </a>
            <?php 
              if ($this->session->userdata('th_ajar') == '2017/2018 ') { ?>
                <a href="<?php echo base_url().'index.php/export/export_nilai1/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Rapor 1" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Raport.1  </a>
              <?php } else { ?>
                <a href="<?php echo base_url().'index.php/export/export_nilai1/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Rapor 1" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Raport  </a>
                <!-- <a href="<?php echo base_url().'index.php/export/export_lck_deskripsi_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Rapor 2" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Raport.2</a> -->
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
        <br/>
        <h3>A. Kompetensi Sikap</h3>
        <table align="center" style="width: 100%; font-family: 'Arial';border-collapse: collapse">
          <thead style="background: #0088ff;color:white;">
            <tr style="text-align:center; font-weight:bold;">
              <td style="width:2%; vertical-align:middle;border:1px solid #a9a9a9;font-size: 18px; height:45px;">No.</td>
              <td style="width:15%; vertical-align:middle;border:1px solid #a9a9a9;width:15%; font-size: 18px;">Aspek</td>
              <td style="width:80%; vertical-align:middle; border:1px solid #a9a9a9;font-size: 18px;">Deskripsi</td>
          </thead>
          <tbody>
            <tr>
              <td style="border:1px solid #cfcfcf;">1</td>
              <td style="border:1px solid #cfcfcf;">Sikap Spiritual</td>
              <td style="border:1px solid #cfcfcf;">
                <?php
                  $i  = 1;
                  $brs = '';
                  if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
                    foreach($hasilbelajar_spr as $row) {
                      if ($this->session->userdata('sub_pnl')=='UTS') {
                        $arrNlAfk = array();
                        $arrDesAfk = array();
                        foreach($kompetensi_spr->result() as $keyKd => $rowKd) {
                          $arrAfk = array('spr');
                          foreach ($arrAfk as $rowAfk) {
                            $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk.'_uts';
                            $hasil_nl_kd_afk = eval('return '.$nh_row.';');
                            $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk.'_des';
                            $hasil_des_kd_afk = eval('return '.$nh_row.';');
                          }
                          $arrNlAfk[] = $hasil_nl_kd_afk;
                          $arrDesAfk[] = $hasil_des_kd_afk;
                        }
                        $brs .= 'Ananda sudah terbiasa dalam ';
                        $arrNlMax = array();
                        foreach ($arrNlAfk as $keyNaAfk => $rowNaAfk) {
                          foreach ($arrDesAfk as $keyDesAfk => $rowDesAfk) {
                            if ($rowNaAfk == '4') {
                              if ($keyNaAfk == $keyDesAfk) {
                                $brs .= $rowDesAfk.', ';                          
                              }
                            }
                          }
                        }
                        $brs .= 'mulai terlihat dalam ';
                        $arrNlMin = array();
                        foreach ($arrNlAfk as $keyNaAfk => $rowNaAfk) {
                          foreach ($arrDesAfk as $keyDesAfk => $rowDesAfk) {
                            if ($rowNaAfk == '1') {
                              if ($keyNaAfk == $keyDesAfk) {
                                $brs .= $rowDesAfk.', ';                          
                              }
                            }
                          }
                        }
                      } else {
                        $arrNlAfk = array();
                        $arrDesAfk = array();
                        foreach($kompetensi_spr->result() as $keyKd => $rowKd) {
                          $arrAfk = array('spr');
                          foreach ($arrAfk as $rowAfk) {
                            $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk;
                            $hasil_nl_kd_afk = eval('return '.$nh_row.';');
                            $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk.'_des';
                            $hasil_des_kd_afk = eval('return '.$nh_row.';');
                          }
                          $arrNlAfk[] = $hasil_nl_kd_afk;
                          $arrDesAfk[] = $hasil_des_kd_afk;
                        }
                        $brs .= 'Ananda sudah terbiasa dalam ';
                        $arrNlMax = array();
                        foreach ($arrNlAfk as $keyNaAfk => $rowNaAfk) {
                          foreach ($arrDesAfk as $keyDesAfk => $rowDesAfk) {
                            if ($rowNaAfk == '4') {
                              if ($keyNaAfk == $keyDesAfk) {
                                $brs .= $rowDesAfk.', ';                          
                              }
                            }
                          }
                        }
                        $brs .= 'mulai terlihat dalam ';
                        $arrNlMin = array();
                        foreach ($arrNlAfk as $keyNaAfk => $rowNaAfk) {
                          foreach ($arrDesAfk as $keyDesAfk => $rowDesAfk) {
                            if ($rowNaAfk == '1') {
                              if ($keyNaAfk == $keyDesAfk) {
                                $brs .= $rowDesAfk.', ';                          
                              }
                            }
                          }
                        }
                      }
                      $i++;
                    }
                  }
                  echo $brs;
                  ?>
              </td>
            </tr>
            <tr class="bg">
              <td style="border:1px solid #cfcfcf;">2</td>
              <td style="border:1px solid #cfcfcf;">Sikap Sosial</td>
              <td style="border:1px solid #cfcfcf;">
                <?php
                  $i  = 1;
                  $brs = '';
                  if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
                    foreach($hasilbelajar_sos as $row)
                    {
                      if ($this->session->userdata('sub_pnl')=='UTS') {
                        $arrNlAfk = array();
                        $arrDesAfk = array();
                        foreach($kompetensi_sos->result() as $keyKd => $rowKd) {
                          $arrAfk = array('sos');
                          foreach ($arrAfk as $rowAfk) {
                            $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk.'_uts';
                            $hasil_nl_kd_afk = eval('return '.$nh_row.';');
                            $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk.'_des';
                            $hasil_des_kd_afk = eval('return '.$nh_row.';');
                          }
                          $arrNlAfk[] = $hasil_nl_kd_afk;
                          $arrDesAfk[] = $hasil_des_kd_afk;
                        }
                        $brs .= 'Ananda sudah terbiasa dalam ';
                        $arrNlMax = array();
                        foreach ($arrNlAfk as $keyNaAfk => $rowNaAfk) {
                          foreach ($arrDesAfk as $keyDesAfk => $rowDesAfk) {
                            if ($rowNaAfk == '4') {
                              if ($keyNaAfk == $keyDesAfk) {
                                $brs .= $rowDesAfk.', ';                          
                              }
                            }
                          }
                        }
                        $brs .= 'mulai terlihat dalam ';
                        $arrNlMin = array();
                        foreach ($arrNlAfk as $keyNaAfk => $rowNaAfk) {
                          foreach ($arrDesAfk as $keyDesAfk => $rowDesAfk) {
                            if ($rowNaAfk == '1') {
                              if ($keyNaAfk == $keyDesAfk) {
                                $brs .= $rowDesAfk.', ';                          
                              }
                            }
                          }
                        }
                      } else {
                        $arrNlAfk = array();
                        $arrDesAfk = array();
                        foreach($kompetensi_sos->result() as $keyKd => $rowKd) {
                          $arrAfk = array('sos');
                          foreach ($arrAfk as $rowAfk) {
                            $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk;
                            $hasil_nl_kd_afk = eval('return '.$nh_row.';');
                            $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk.'_des';
                            $hasil_des_kd_afk = eval('return '.$nh_row.';');
                          }
                          $arrNlAfk[] = $hasil_nl_kd_afk;
                          $arrDesAfk[] = $hasil_des_kd_afk;
                        }
                        $brs .= 'Ananda sudah terbiasa dalam ';
                        $arrNlMax = array();
                        foreach ($arrNlAfk as $keyNaAfk => $rowNaAfk) {
                          foreach ($arrDesAfk as $keyDesAfk => $rowDesAfk) {
                            if ($rowNaAfk == '4') {
                              if ($keyNaAfk == $keyDesAfk) {
                                $brs .= $rowDesAfk.', ';                          
                              }
                            }
                          }
                        }
                        $brs .= 'mulai terlihat dalam ';
                        $arrNlMin = array();
                        foreach ($arrNlAfk as $keyNaAfk => $rowNaAfk) {
                          foreach ($arrDesAfk as $keyDesAfk => $rowDesAfk) {
                            if ($rowNaAfk == '1') {
                              if ($keyNaAfk == $keyDesAfk) {
                                $brs .= $rowDesAfk.', ';                          
                              }
                            }
                          }
                        }
                      }
                      $i++;
                    }
                  }
                  echo $brs;
                  ?>
              </td>
            </tr>
          </tbody>
        </table>
        <br/>
      <?php 
    //======== Nilai ===============================// 
    if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0') 
      { 
        $jmh_mp = $hasilbelajar->num_rows();

        $kolom1 = "";
        $kolom2 = "";
        
        $i  = 1;
        foreach($nilai_akhir as $row)
        {
          $kel = $row['URUTAN'];
          if($kel <= 8) 
          {
            $nlNa       = ($row['RFINAL']) ? $row['RFINAL'] : '0';
            $nlNaPsk    = ($row['RFINALPSK']) ? $row['RFINALPSK'] : '0';
            $bg = ($i%2==0) ? ' class="bg" ' : '';
            $kolom1 .= '<tr'.$bg.'>';
            $kolom1 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #cfcfcf;">'.$i.'</td>';
            if($row['NMMP'] == "Pendidikan Agama Islam") {
              $nm_mp = "Pendidikan Agama dan Budi Pekerti";
            } elseif($row['NMMP'] == "Pendidikan Kewarganegaraan") {
              $nm_mp = "Pendidikan Pancasila dan Kewarganegaraan";
            } elseif($row['NMMP'] == "Pendidikan Jasmani dan Kesehatan") {
              $nm_mp = "Pendidikan Jasmani, Olah Raga dan Kesehatan";
            } else {
              $nm_mp = $row['NMMP'];
            }
            $kolom1 .= '<td style="border:1px solid #cfcfcf;font-size: 0.8em/1.5;line-height:13px;padding:5px;">'.$nm_mp.'</td>';
            $kolom1 .= '<td align="center" style="border:1px solid #cfcfcf;font-size: 0.8em/1.5">'.$nlNa.'</td>';
            $kolom1 .= '<td align="center" style="border:1px solid #cfcfcf;font-size: 0.8em/1.5">'.konversi_predikat($nlNa).'</td>';
            $kolom1 .= '<td align="left" style="font-size: 0.8em/1.5;border:1px solid #cfcfcf; padding-left: 5px; text-align: justify;">'.$row['NADESK'].'</td>';

            $kolom1 .= '<td align="center" style="border:1px solid #cfcfcf;font-size: 0.8em/1.5">'.$nlNaPsk.'</td>';
            $kolom1 .= '<td align="center" style="border:1px solid #cfcfcf;font-size: 0.8em/1.5">'.konversi_predikat($nlNaPsk).'</td>';
            $kolom1 .= '<td align="left" style="font-size: 0.8em/1.5;border:1px solid #cfcfcf; padding-left: 5px; text-align: justify;">'.$row['NADESKPSK'].'</td>';
            $kolom1 .= '</tr>';
              $i++;
          }
        }
        
        $j = $i;
        foreach($nilai_akhir as $row)
        {
          $kel = $row['URUTAN'];
          if($kel >= 9) 
          {
            $nlNa       = ($row['RFINAL']) ? $row['RFINAL'] : '0';
            $nlNaPsk    = ($row['RFINALPSK']) ? $row['RFINALPSK'] : '0';
            $bg = ($j%2==0) ? ' class="bg" ' : '';
            $kolom2 .= '<tr'.$bg.'>';
            $kolom2 .= '<td align="center" style="font-size: 0.8em/1.5;border:1px solid #cfcfcf;">'.$j.'</td>';
            $kolom2 .= '<td style="border:1px solid #cfcfcf;font-size: 0.8em/1.5;line-height:13px;padding:5px;">'.$row['NMMP'].'</td>';
            $kolom2 .= '<td align="center" style="border:1px solid #cfcfcf;font-size: 0.8em/1.5">  '.$nlNa.'</td>';
            $kolom2 .= '<td align="center" style="border:1px solid #cfcfcf;font-size: 0.8em/1.5">'.konversi_predikat($nlNa).'</td>';
            $kolom2 .= '<td align="left" style="font-size: 0.8em/1.5;border:1px solid #cfcfcf; padding-left: 5px; text-align: justify;">'.$row['NADESK'].'</td>';
            $kolom2 .= '<td align="center" style="border:1px solid #cfcfcf;font-size: 0.8em/1.5">'.$nlNaPsk.'</td>';
            $kolom2 .= '<td align="center" style="border:1px solid #cfcfcf;font-size: 0.8em/1.5">'.konversi_predikat($nlNaPsk).'</td>';
            $kolom2 .= '<td align="left" style="font-size: 0.8em/1.5;border:1px solid #cfcfcf; padding-left: 5px; text-align: justify;">'.$row['NADESKPSK'].'</td>';
            $kolom2 .= '</tr>';
            $j++;
          }
        }
      } 
    //======= End Nilan ==========================//
    ?>
            <h3>B. Kompetensi Pengetahuan dan Keterampilan</h3>
            <table align="center" style="width: 100%; font-family: 'Arial';border-collapse: collapse">
              <thead style="background: #0088ff;color:white;">
                <tr style="text-align:center; font-weight:bold;">
                  <td rowspan="2" style="width:2%; vertical-align:middle;border:1px solid #a9a9a9;font-size: 18px; height:52.913385827px;">No.</td>
                  <td rowspan="2" style="width:38%; vertical-align:middle;border:1px solid #a9a9a9;width:15%; font-size: 18px;">Mata Pelajaran</td>
                  <td colspan="3" style="width:5%; vertical-align:middle; border:1px solid #a9a9a9;font-size: 18px;">PENGETAHUAN</td>
                  <td colspan="3" style="width:5%; vertical-align:middle; border:1px solid #a9a9a9;font-size: 18px;">KETERAMPILAN</td>
                </tr>
                <tr style="text-align:center; font-weight:bold;">
                  <td colspan="2" style="width:5%; vertical-align:middle;border:1px solid #a9a9a9;font-size: 18px;">Nilai</td>
                  <td style="width:20%; vertical-align:middle;border:1px solid #a9a9a9;font-size: 18px;">Deskripsi</td>
                  <td colspan="2" style="width:5%; vertical-align:middle;border:1px solid #a9a9a9;font-size: 18px;">Nilai</td>
                  <td style="width:20%; vertical-align:middle;border:1px solid #a9a9a9;font-size: 18px;">Deskripsi</td>
                </tr>
              </thead>
              <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){
                echo trim($kolom1);
                echo "<tr>
                        <td colspan='8' style='border:1px solid #a9a9a9; padding:10px; font-size: 0.8em/1.5; background-color: #0088ff; font-weight: bold; color: white;'>Muatan Lokal</td>
                      </tr>";
                echo trim($kolom2);
              ?>
              <?php } ?>
            </table>
            <br />
            <?php if ($this->session->userdata('sub_pnl')=='UAS') { ?>
              <h3>C. Ekstra Kurikuler</h3>
              <table align="center" style="width: 100%; font-family: 'Arial';border-collapse: collapse">
                <tr style="background: #0088ff;color: white;text-align: center;font-weight: bold;">
                  <td style="vertical-align:middle;border:1px solid #cfcfcf;width:2%;text-align:center;">No.</td>
                  <td style="vertical-align:middle;border:1px solid #cfcfcf;">Kegiatan Ekstrakurikuler</td>
                  <td style="vertical-align:middle;border:1px solid #cfcfcf;">Keterangan</td>
                </tr>
                <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0') {
                    $i = 1;
                    foreach($eskul->result() as $row)
                    {
                      $bg = ($i%2==0) ? ' class="bg" ' : '';
                      echo '<tr'.$bg.'>';
                      echo '<td style="border:1px solid #cfcfcf;text-align:center;">'.$i.'</td>';
                      echo '<td style="border:1px solid #cfcfcf;">'.$row->nm_eskul.'</td>';
                      $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
                      echo '<td style="border:1px solid #cfcfcf;">'.$nilai.'</td>';
                      echo '</tr>';
                      $i++;
                    }
                  }
                ?>
              </table>
            <?php } ?>
            <br/>
            <?php if ($this->session->userdata('sub_pnl')=='UTS') { 
              echo "<h3>C. Saran-saran</h3>";
            } else {
              echo "<h3>D. Saran-saran</h3>";
            } ?>
            <table align="center" style="width: 100%; font-family: 'Arial';border-collapse: collapse">
              <tr>
                <?php
                  $vall = 1;
                  foreach ($catatan_siswa as $key => $value)
                  {
                    if ($value->comment != '')
                    {
                      echo '<td style="border:1px solid #cfcfcf;vertical-align:middle; width: 100%; padding: 20px;">'.$value->comment.'</td>';
                      $vall++;
                    }
                    break;
                  }
                  if ($vall == 1)
                  {
                    echo '<td style="border:1px solid #cfcfcf;vertical-align:middle; width: 100%; padding: 20px;"></td>';
                  }
                ?>
              </tr>
            </table>
            <br/>
            <?php if ($this->session->userdata('sub_pnl')=='UAS') { ?>
            <h3>E. Tinggi dan Barat Badan</h3>
            <table align="center" style="width: 100%; font-family: 'Arial';border-collapse: collapse">
              <tr style="background: #0088ff;color: white;text-align: center;font-weight: bold;">
                <td rowspan="2" style="border:1px solid #cfcfcf;width:2%;text-align:center;vertical-align:middle;">No.</td>
                <td rowspan="2" style="border:1px solid #cfcfcf;vertical-align:middle;">Aspek yang dinilai</td>
                <td colspan="2" style="border:1px solid #cfcfcf;vertical-align:middle;">Semester</td>
              </tr>
              <tr style="background: #0088ff;color: white;text-align: center;font-weight: bold;">
                <td style="border:1px solid #cfcfcf;vertical-align:middle;">1</td>
                <td style="border:1px solid #cfcfcf;vertical-align:middle;">2</td>
              </tr>
              <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0') {
                  if($this->session->userdata('kd_semester') == 1) {
                    $i = 1;
                    foreach($tinggibadan->result() as $row)
                    {
                      $bg = ($i%2==0) ? ' class="bg" ' : '';
                      echo '<tr'.$bg.'>';
                      echo '<td style="border:1px solid #cfcfcf;text-align:center;">'.$i.'</td>';
                      echo '<td style="border:1px solid #cfcfcf;">'.$row->nm_kesehatan.'</td>';
                      $nilai = ($row->hasil == ' ' || $row->hasil == '' || $row->hasil == '0' || $row->hasil == 0) ? '-' : $row->hasil;
                      echo '<td style="border:1px solid #cfcfcf; text-align: center;">'.$nilai.'</td>';
                      echo '<td style="border:1px solid #cfcfcf; text-align: center;">-</td>';
                      echo '</tr>';
                      $i++;
                    }
                  } else {
                    echo '<tr style= width:50%;>';
                    echo '<td style="border:1px solid #cfcfcf;text-align:center;">1</td>';
                    echo '<td style="border:1px solid #cfcfcf;">Berat Badan</td>';
                    
                    if (!empty($beratbadan)) {
                      $pnl = 0;
                      foreach($beratbadan as $key => $value)
                      {
                        $berat_badan = ($value == ' ' || $value == 0) ? '-' : $value;
                        $pnl+= $key; 
                      }
                      echo $key;
                      if ($key == 3) {
                        foreach($beratbadan as $key => $value)
                        {
                          $berat_badan = ($value == ' ' || $value == 0) ? '-' : $value;
                          echo '<td style="border:1px solid #cfcfcf; text-align: center;">'.$berat_badan.'</td>';
                          echo '<td style="border:1px solid #cfcfcf; text-align: center;">'.$berat_badan.'</td>';
                        }
                      } elseif ($key == 2) {
                        echo '<td style="border:1px solid #cfcfcf; text-align: center;">-</td>';
                        echo '<td style="border:1px solid #cfcfcf; text-align: center;">'.$berat_badan.'</td>';
                      } elseif ($key == 1) {
                        echo '<td style="border:1px solid #cfcfcf; text-align: center;">'.$berat_badan.'</td>';
                        echo '<td style="border:1px solid #cfcfcf; text-align: center;">-</td>';
                      }
                    } else {
                      echo '<td style="border:1px solid #cfcfcf; text-align: center;">-</td>';
                      echo '<td style="border:1px solid #cfcfcf; text-align: center;">-</td>';
                    }
                    
                    echo '</tr>';

                    echo '<tr class="bg" style= width:50%;>';
                    echo '<td style="border:1px solid #cfcfcf;text-align:center;">2</td>';
                    echo '<td style="border:1px solid #cfcfcf;">Tinggi Badan</td>';


                    if (!empty($tinggibadan)) {
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
                          echo '<td style="border:1px solid #cfcfcf; text-align: center;">'.$tinggi_badan.'</td>';
                        }
                      } elseif ($key == 2) {
                        echo '<td style="border:1px solid #cfcfcf; text-align: center;">-</td>';
                        echo '<td style="border:1px solid #cfcfcf; text-align: center;">'.$tinggi_badan.'</td>';
                      } elseif ($key == 1) {
                        echo '<td style="border:1px solid #cfcfcf; text-align: center;">'.$tinggi_badan.'</td>';
                        echo '<td style="border:1px solid #cfcfcf; text-align: center;">-</td>';
                      }
                    } else {
                      echo '<td style="border:1px solid #cfcfcf; text-align: center;">-</td>';
                      echo '<td style="border:1px solid #cfcfcf; text-align: center;">-</td>';
                    }
                    echo '</tr>';
                  }
                }
              ?>
            </table>
            <br/>
            <h3>F. Kondisi Kesehatan</h3>
            <table align="center" style="width: 100%; font-family: 'Arial';border-collapse: collapse">
              <tr style="background: #0088ff;color: white;text-align: center;font-weight: bold;">
                <td style="border:1px solid #cfcfcf;width:2%;text-align:center;vertical-align:middle;">No.</td>
                <td style="border:1px solid #cfcfcf;vertical-align:middle;">Aspek Fisik</td>
                <td style="border:1px solid #cfcfcf;vertical-align:middle;">Keterangan</td>
              </tr>
              <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0') {
                  $i = 1;
                  foreach($kesehatan->result() as $row)
                  {
                    $bg = ($i%2==0) ? ' class="bg" ' : '';
                    echo '<tr'.$bg.'>';
                    echo '<td style="border:1px solid #cfcfcf;text-align:center;">'.$i.'</td>';
                    echo '<td style="border:1px solid #cfcfcf;">'.$row->nm_kesehatan.'</td>';
                    $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
                    echo '<td style="border:1px solid #cfcfcf; text-align: center;">'.$nilai.'</td>';
                    echo '</tr>';
                    $i++;
                  }
                }
              ?>
            </table>
            <!-- <br/>
            <h3>G. Prestasi</h3>
            <table align="center" style="width: 100%; font-family: 'Arial';border-collapse: collapse">
              <tr style="background: #0088ff;color: white;text-align: center;font-weight: bold;">
                <td style="border:1px solid #cfcfcf;width:2%;text-align:center;vertical-align:middle;">No.</td>
                <td style="border:1px solid #cfcfcf;vertical-align:middle;">Jenis Prestasi</td>
                <td style="border:1px solid #cfcfcf;vertical-align:middle;">Keterangan</td>
              </tr>
              <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0') {
                  $seq = 1;
                  foreach($prestasi->result() as $row)
                  {
                      $bg = ($seq%2==0) ? ' class="bg" ' : '';
                      echo '<tr'.$bg.'>';
                      echo '<td style="border:1px solid #a9a9a9;text-align:center;">'.$row->kd_prestasi.'</td>';
                      echo '<td style="border:1px solid #a9a9a9;">'.$row->nm_prestasi.'</td>';
                      echo '<td style="border:1px solid #a9a9a9;">'.$row->ket.'</td>';
                      echo '</tr>';
                      $seq++;
                  }
                }
              ?>
            </table> -->
            <br/>
            <?php } ?>
            <?php if ($this->session->userdata('sub_pnl')=='UTS') {
              echo "<h3>D. Ketidakhadiran</h3>";
            } else {
              echo "<h3>G. Ketidakhadiran</h3>";
            } ?>
            <table align="center" style="width: 100%; font-family: 'Arial';border-collapse: collapse">
              <tr>
                  <td style="border:1px solid #a9a9a9;border-right:1px solid rgba(0, 0, 0, 0);">Sakit</td>
                  <td style="border:1px solid #a9a9a9;border-right:1px solid rgba(0, 0, 0, 0);">:</td>
                  <td style="border:1px solid #a9a9a9;"><?php $a=($absens->row()->alfa == '0') ? '-' : $absens->row()->alfa; echo $a; ?> Hari</td>
              </tr>
              <tr style="background: #e8f6ff;">
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
            <table align="left" style="width: 100%; font-family: 'Arial';border: none;">
              <tr>
                <td>
                  <?php
                      $kelas_lama = str_replace('+',' ',$this->uri->segment(3));
                      $naik_kelas = array('1 Al-Khawarizmi'=>'II ( dua )','1 Ibnu Khaldun'=>'II ( dua )','1 Ibnu Rusyd'=>'II ( dua )','2 Al Farabi'=>'III ( tiga )','2 Ibnu Sina'=>'III ( tiga )','2 Ibnu Taimiyyah'=>'III ( tiga )','3 Al Kindi'=>'IV ( empat )','3 Ibnu Katsir'=>'IV ( empat )','3 Ibnu Masud'=>'IV ( empat )','4 Abu Bakar'=>'V ( lima )','4 Umar bin Khattab'=>'V ( lima )','4 Utsman Bin Affan'=>'V ( lima )','5 Ali bin Abi Thalib'=>'V ( lima )','5 Ali bin Abi Thalib'=>'VI ( enam )','5 Mushab Bin Umair'=>'VI ( enam )','6 Khalid bin Walid'=>'LULUS','6 Zaid bin Tsabit'=>'LULUS');
                        foreach($naik_kelas as $keynaik_kelas=>$valuenaik_kelas)
                        {
                          if(trim($kelas_lama) == $keynaik_kelas) {
                            echo "<b>Naik ke Kelas : ".$valuenaik_kelas."</b>";
                          }
                        }
                    ?>
                </td>
              </tr>
            </table>
    <!--end table hasil study-->
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
