<?php $this->load->view('page_head');?>
<?php
function konversi($tmp)
{
    $predikat = "";
    if($tmp<=1.17){
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

?>

<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>LEDGER 	KETERAMPILAN<?php //$q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?></h1>

    <form action="<?php echo base_url().'index.php/hasilbelajar/ledger_keterampilan' ?>" method="POST" id="frmhasilbelajar">
    <!--atur pd (edusis_system/helpers/form_helper.php)function form_hidden, dg menambahkan (id="'.$name.'")-->
    <?php echo form_hidden('myurl',site_url('hasilbelajar')) ?>
    <!--table filter-->
        <table border="0" width="100%">
            <tr>
                <td width="100px">Pilih Kelas</td>
                <td width="300px">
                <select name="skelas" id="skelas" onchange="pilih()">
        		<?php
        			echo '<option value="" class="input-text"></option>';
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
                <?php if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') { ?>
                  <a href="<?php echo base_url().'index.php/export/ekspor_ledger_keterampilan_k13/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
                <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Mata pelajaran</td>
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
      <table class="tables" style="width:100%;">
        <tr>
          <th rowspan="2">No.</th>
          <th rowspan="2">Nama Siswa</th>
          <?php
          if ($this->session->userdata('sub_pnl')=='UAS') {
            echo '<th colspan="4">KINERJA PROSES</th>';
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
          <th>KPS1</th>
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

            $naTtl  = round($RT1) + round($cntRtKpd) + round($RT3) + round($RT2);

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

        <!-- end table hsil study -->
    </form>
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
