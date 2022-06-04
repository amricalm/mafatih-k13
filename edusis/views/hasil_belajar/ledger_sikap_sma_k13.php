<?php $this->load->view('page_head');?>
<?php
function konversi($tmp)
{
    $predikat = "";
    if($tmp < 70){
        $predikat = 'D';
    } elseif ($tmp >= 70){
        $predikat = 'C';
    } elseif ($tmp >= 80){
        $predikat = 'B';
    } elseif ($tmp >= 90){
        $predikat = 'A';
    }
    return $predikat;
}
?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>LEDGER SIKAP<?php //$q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?></h1>

    <form action="<?php echo base_url().'index.php/hasilbelajar/ledger_sikap' ?>" method="POST" id="frmhasilbelajar">
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
                <a href="<?php echo base_url().'index.php/export/export_sikap_k13_to_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
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
<!-- ================================== FORMAT BARU ======================================== -->
      <table style="border-collapse:collapse;width:100%;text-align:center;">
        <thead style="background:#0088ff;color:white;font-weight:bold;">
          <tr>
            <td rowspan="2" style="border:1px solid black; vertical-align:middle; width:1%;">NO</td>
            <td rowspan="2" style="border:1px solid black; vertical-align:middle; width:8%">NIS</td>
            <td rowspan="2" style="border:1px solid black; vertical-align:middle; width:20%">NAMA SISWA</td>
            <?php
                $i = 0;
                foreach($kompetensi_spr->result() as $rowKd) {
                  $i++;
                }
                echo '<td colspan="'.$i.'" style="border:1px solid black;">KOMPETENSI SPIRITUAL</td>';
              ?>
              <td rowspan="2" style="border:1pxq solid black; vertical-align:middle;">DESKRIPSI</td>
          </tr>
          <tr>
            <?php
              foreach($kompetensi_spr->result() as $rowKd) {
                echo '<td style="border:1px solid black; width:5%;">'.$rowKd->kd_kd.'</td>';
              }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $i  = 1;
          $brs = '';
          if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
            foreach($hasilbelajar_spr as $row)
            {
              $bg = ($i%2==0) ? ' class="bg" ' : '';
              $brs .= '<tr '.$bg.'>';
              $brs .= '<td style="border: 1px solid black;">'.$i.'</td>';
              $brs .= '<td style="border: 1px solid black;text-align:left;">'.$row->nis.'</td>';
              $brs .= '<td style="border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
              if ($this->session->userdata('sub_pnl')=='UTS') {
                $k = 0;
                foreach($kompetensi_spr->result() as $rowKd) {
                  $arrAfk = array('spr');
                  foreach ($arrAfk as $rowAfk) {
                    $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk.'_uts';
                    $hasil_nh_row = eval('return '.$nh_row.';');
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                  $k++;
                }
                if ($k != 0) {
                  $brs .= '<td style="border: 1px solid black; text-align:left;">';
                  $arrNlAfk = array();
                  $arrDesAfk = array();
                  foreach($kompetensi_spr->result() as $keyKd => $rowKd) {
                    $arrAfk = array('spr');
                    foreach ($arrAfk as $rowAfk) {
                      $nl_kd_afk = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk.'_uts';
                      $hasil_nl_kd_afk = eval('return '.$nl_kd_afk.';');
                      $des_kd_afk = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk.'_des';
                      $hasil_des_kd_afk = eval('return '.$des_kd_afk.';');
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
                  $brs .= '</td>';
                }
              } else {
                $k = 0;
                foreach($kompetensi_spr->result() as $rowKd) {
                  $arrAfk = array('spr');
                  foreach ($arrAfk as $rowAfk) {
                    $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk;
                    $hasil_nh_row = eval('return '.$nh_row.';');
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                  $k++;
                }
                if ($k != 0) {
                  $brs .= '<td style="border: 1px solid black; text-align:left;">';
                  $arrNlAfk = array();
                  $arrDesAfk = array();
                  foreach($kompetensi_spr->result() as $keyKd => $rowKd) {
                    $arrAfk = array('spr');
                    foreach ($arrAfk as $rowAfk) {
                      $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk;
                      $hasil_nl_kd_afk = eval('return '.$nh_row.';');
                        $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk.'_des';
                        $hasil_des_kd_afk = eval('return '.$nh_row.';');
                        $b = 'Ananda sudah terbiasa dalam '.print_r($hasil_nh_row,1).'. ';
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
                  $brs .= '</td>';
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
<!-- ==================================END FORMAT BARU ======================================== -->
<br>
<br>
<!-- ================================== FORMAT BARU ======================================== -->
      <table style="border-collapse:collapse;width:100%;text-align:center;">
        <thead style="background:#0088ff;color:white;font-weight:bold;">
          <tr>
            <td rowspan="2" style="border:1px solid black; vertical-align:middle;width:1%;">NO</td>
            <td rowspan="2" style="border:1px solid black; vertical-align:middle;width:8%;">NIS</td>
            <td rowspan="2" style="border:1px solid black; vertical-align:middle;width:20%;">NAMA SISWA</td>
            <?php
                $i = 0;
                foreach($kompetensi_sos->result() as $rowKd) {
                  $i++;
                }
                echo '<td colspan="'.$i.'" style="border:1px solid black;">KOMPETENSI SOSIAL</td>';
              ?>
              <td rowspan="2" style="border:1px solid black; vertical-align:middle;">DESKRIPSI</td>
          </tr>
          <tr>
            <?php
              foreach($kompetensi_sos->result() as $rowKd) {
                echo '<td style="border:1px solid black;width:5%;">'.$rowKd->kd_kd.'</td>';
              }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $i  = 1;
          $brs = '';
          if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
            foreach($hasilbelajar_sos as $row)
            {
              $bg = ($i%2==0) ? ' class="bg" ' : '';
              $brs .= '<tr '.$bg.'>';
              $brs .= '<td style="border: 1px solid black;">'.$i.'</td>';
              $brs .= '<td style="border: 1px solid black;text-align:left;">'.$row->nis.'</td>';
              $brs .= '<td style="border: 1px solid black;text-align:left;">'.$row->nama_lengkap.'</td>';
              if ($this->session->userdata('sub_pnl')=='UTS') {
                $k = 0;
                foreach($kompetensi_sos->result() as $rowKd) {
                  $arrAfk = array('sos');
                  foreach ($arrAfk as $rowAfk) {
                    $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk.'_uts';
                    $hasil_nh_row = eval('return '.$nh_row.';');
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                  $k++;
                }
                if ($k != 0) {
                $brs .= '<td style="border: 1px solid black; text-align:left;">';
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
                $brs .= '</td>';
              }
              } else {
                $k = 0;
                foreach($kompetensi_sos->result() as $rowKd) {
                  $arrAfk = array('sos');
                  foreach ($arrAfk as $rowAfk) {
                    $nh_row = '$row->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_'.$rowAfk;
                    $hasil_nh_row = eval('return '.$nh_row.';');
                    $brs .= '<td style="border: 1px solid black;">'.print_r($hasil_nh_row,1).'</td>';
                  }
                  $k++;
                }
                if ($k != 0) {
                $brs .= '<td style="border: 1px solid black; text-align:left;">';
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
                $brs .= '</td>';
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
<!-- ==================================END FORMAT BARU ======================================== -->
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
