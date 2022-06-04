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
    <h1>LEDGER PENGETAHUAN<?php //$q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?></h1>

    <form action="<?php echo base_url().'index.php/hasilbelajar/ledger_pengetahuan' ?>" method="POST" id="frmhasilbelajar">
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
                <a href="<?php echo base_url().'index.php/export/export_pengetahuan_k13_to_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
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
    <table class="tables" align="center" style="width:100%; text-align:center;">
      <tr>
        <th rowspan="2" style="vertical-align:center;">NO.</th>
        <th rowspan="2" style="width: 25%;">NAMA SISWA</th>
        <?php
        if ($this->session->userdata('sub_pnl')=='UAS') {
          echo '<th colspan="6">ULANGAN HARIAN</th>';
        }
        else {
          echo '<th colspan="3">ULANGAN HARIAN</th>';
        }
        ?>
        <th rowspan="2" style="width: 40px;">Rata Rata</th>
        <?php
        if ($this->session->userdata('sub_pnl')=='UAS') {
          echo '<th colspan="2">TES LISAN</th>';
        }
        else {
          echo '<th>TES LISAN</th>';
        }
        ?>
        <th rowspan="2" style="width: 40px;">Rata Rata</th>
        <?php
        if ($this->session->userdata('sub_pnl')=='UAS') {
          echo '<th colspan="2">PORTOFOLIO</th>';
        }
        else {
          echo '<th>PORTOFOLIO</th>';
        }
        ?>
        <th rowspan="2" style="width: 40px;">Rata Rata</th>
        <?php
        if ($this->session->userdata('sub_pnl')=='UAS') {
          echo '<th colspan="6">PENUGASAN</th>';
        }
        else {
          echo '<th colspan="3">PENUGASAN</th>';
        }
        ?>
        <th rowspan="2" style="width: 40px;">Rata Rata</th>
        <th rowspan="2">PTS</th>
        <?php
        if ($this->session->userdata('sub_pnl')=='UAS') {
          echo '<th rowspan="2">PAS</th>';
        }
        ?>
        <th rowspan="2">Nilai Akhir</th>
      </tr>
      <tr>
        <th style="width:40px;">UH 1</th>
        <th style="width:40px;">UH 2</th>
        <th style="width:40px;">UH 3</th>
        <?php
        if ($this->session->userdata('sub_pnl')=='UAS') {
          echo '<th style="width:40px;">UH 4</th>';
          echo '<th style="width:40px;">UH 5</th>';
          echo '<th style="width:40px;">UH 6</th>';
        }
        ?>
        <th style="width:40px;">1</th>
        <?php
        if ($this->session->userdata('sub_pnl')=='UAS') {
          echo '<th style="width:40px;">2</th>';
        }
        ?>
        <th style="width:40px;">1</th>
        <?php
        if ($this->session->userdata('sub_pnl')=='UAS') {
          echo '<th style="width:40px;">2</th>';
        }
        ?>
        <th style="width:40px;">1</th>
        <th style="width:40px;">2</th>
        <th style="width:40px;">3</th>
        <?php
        if ($this->session->userdata('sub_pnl')=='UAS') {
          echo '<th style="width:40px;">4</th>';
          echo '<th style="width:40px;">5</th>';
          echo '<th style="width:40px;">6</th>';
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
          echo '<td style="text-align: left;">'.$row->nama_lengkap.'</td>';

          if ($this->session->userdata('sub_pnl')=='UTS') {
            echo '<td align="center" style="font-size:11px ;">'.$row->UHT1_UTS.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->UHT2_UTS.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->UHT3_UTS.'</td>';

            $totalUH = $row->UHT1_UTS + $row->UHT2_UTS + $row->UHT3_UTS;

            $uh1 = ($row->UHT1_UTS == '0' || $row->UHT1_UTS == '') ? '0' : 1;
            $uh2 = ($row->UHT2_UTS == '0' || $row->UHT2_UTS == '') ? '0' : 1;
            $uh5 = ($row->UHT3_UTS == '0' || $row->UHT3_UTS == '') ? '0' : 1;
            $rtUh = $uh1 + $uh2 + $uh5;

            $totalRtUh = ($rtUh == 0) ? 0 : $totalUH/$rtUh;

            $bobotUH = ($totalRtUh * 40) / 100;

            echo '<td align="center" style="font-size:11px; color: blue;">'.round($totalRtUh).'</td>';
          }
          else {
            echo '<td align="center" style="font-size:11px ;">'.$row->UHT1_UTS.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->UHT2_UTS.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->UHT3_UTS.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->UHT1.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->UHT2.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->UHT3.'</td>';

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

            echo '<td align="center" style="font-size:11px; color: blue;">'.round($totalRtUh).'</td>';
          }

          if ($this->session->userdata('sub_pnl')=='UTS') {
            echo '<td align="center" style="font-size:11px ;">'.$row->Lisan1_uts.'</td>';

            $ttlLsn = $row->Lisan1_uts;

            $nlLsn1 = ($row->Lisan1_uts == '0' || $row->Lisan1_uts == '') ? '0' : 1;
            $nlLsn = $nlLsn1;

            $ttlNlLsn = ($nlLsn==0 || $nlLsn=='0' || $nlLsn=='') ? 0 : $ttlLsn/$nlLsn;

            $bobotLsn = ($ttlNlLsn * 20) / 100;
          }
          else {
            echo '<td align="center" style="font-size:11px ;">'.$row->Lisan1_uts.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->Lisan1.'</td>';

            $ttlLsn = $row->Lisan1 + $row->Lisan1_uts;

            $nlLsn1 = ($row->Lisan1 == '0' || $row->Lisan1 == '') ? '0' : 1;
            $nlLsn2 = ($row->Lisan1_uts == '0' || $row->Lisan1_uts == '') ? '0' : 1;
            $nlLsn = $nlLsn1 + $nlLsn2;

            $ttlNlLsn = ($nlLsn==0 || $nlLsn=='0' || $nlLsn=='') ? 0 : $ttlLsn/$nlLsn;

            $bobotLsn = ($ttlNlLsn * 20) / 100;
          }

          echo '<td align="center" style="font-size:11px;color:blue;">'.round($ttlNlLsn).'</td>';

          if ($this->session->userdata('sub_pnl')=='UTS') {
            echo '<td align="center" style="font-size:11px ;">'.$row->Port1_uts.'</td>';
            $ttlPrt = $row->Port1_uts;

            $nlPrt1 = ($row->Port1_uts == '0' || $row->Port1_uts == '') ? '0' : 1;
            $nlPrt = $nlPrt1;

            $ttlNlPrt = ($nlPrt==0 || $nlPrt=='0' || $nlPrt=='') ? 0 : $ttlPrt/$nlPrt;

            $bobotPrt = ($ttlNlPrt * 20) / 100;
            echo '<td align="center" style="font-size:11px;color:blue;">'.$ttlNlPrt.'</td>';
          }
          else {
            echo '<td align="center" style="font-size:11px ;">'.$row->Port1_uts.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->Port1.'</td>';

            $ttlPrt = $row->Port1 + $row->Port1_uts;

            $nlPrt1 = ($row->Port1 == '0' || $row->Port1 == '') ? '0' : 1;
            $nlPrt2 = ($row->Port1_uts == '0' || $row->Port1_uts == '') ? '0' : 1;
            $nlPrt = $nlPrt1 + $nlPrt2;

            $ttlNlPrt = ($nlPrt==0 || $nlPrt=='0' || $nlPrt=='') ? 0 : $ttlPrt/$nlPrt;

            $bobotPrt = ($ttlNlPrt * 20) / 100;
            echo '<td align="center" style="font-size:11px;color:blue;">'.$ttlNlPrt.'</td>';
          }

          if ($this->session->userdata('sub_pnl')=='UTS') {
            echo '<td align="center" style="font-size:11px ;">'.$row->TGS1_UTS.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->TGS2_UTS.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->TGS3_UTS.'</td>';

            $TGS = $row->TGS1_UTS + $row->TGS2_UTS + $row->TGS3_UTS;

            $e = ($row->TGS1_UTS == '0' || $row->TGS1_UTS == '' ) ? '0' : 1;
            $f = ($row->TGS2_UTS == '0' || $row->TGS2_UTS == '' ) ? '0' : 1;
            $g = ($row->TGS3_UTS == '0' || $row->TGS3_UTS == '' ) ? '0' : 1;
            $k = $e + $f + $g;

            $RT1    = ($k==0) ? 0 : $TGS/$k;

            $bobotTgs = $RT1 * 20 / 100;
          }
          else {
            echo '<td align="center" style="font-size:11px ;">'.$row->TGS1_UTS.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->TGS2_UTS.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->TGS3_UTS.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->TGS1.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->TGS2.'</td>';
            echo '<td align="center" style="font-size:11px ;">'.$row->TGS3.'</td>';

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

          echo '<td align="center" style="font-size:11px ;"><font color="blue">'.round($RT1).'</font></td>';

          echo '<td align="center" style="font-size:11px ;">'.$row->UTS.'</td>';

          if ($this->session->userdata('sub_pnl')=='UAS') {
            echo '<td align="center" style="font-size:11px ;">'.$row->UAS.'</td>';
          }

          if ($this->session->userdata('sub_pnl')=='UAS') {
            $nlA = (($bobotUH + $bobotLsn + $bobotPrt + $bobotTgs) * 40) / 100 + (((($row->UTS * 50) / 100) + (($row->UAS * 50) / 100)) * 60) / 100;

            echo '<td align="center" style="font-size:11px;font-weight: bold; color:blue;">'.round($nlA).'</td>';
          }
          else {
            $nlA = (($bobotUH + $bobotLsn + $bobotPrt + $bobotTgs) * 40) / 100 + ($row->UTS * 60) / 100;
            echo '<td align="center" style="font-size:11px;font-weight: bold; color:blue;">'.round($nlA).'</td>';
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
          <td align="center" style="font-size:11px ;"><b style="color: blue;"><?php //echo round($ratakelas,1); ?></b></td>
      </tr>-->
      <?php } ?>
    </table>
    <div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
        
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
