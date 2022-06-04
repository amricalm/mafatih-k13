<?php $this->load->view('page_head');?>
<?php
function konversi_sikap($tmp)
{
    $predikat = "";
                if($tmp==0){
                    $predikat = '';
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
  <h1>INI SMA</h1>
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
                  <a href="<?php echo base_url().'index.php/export/ekspor_ledger_sikap_k13/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
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

      <table class="tables" style="width:100%;font-weight:bold;text-align:center;">
        <thead style="background:#0088ff;color:white;">
          <tr>
            <td rowspan="2" style="vertical-align:middle;">NO.</td>
            <td rowspan="2" style="vertical-align:middle;">NAMA SISWA</td>
            <td colspan="7">SIKAP</td>
            <td rowspan="2" style="vertical-align:middle;">NILAI</td>
            <td rowspan="2" style="vertical-align:middle;">DESKRIPSI SIKAP SOSIAL</td>
          </tr>
          <tr>
            <td>Jujur</td>
            <td>Disiplin</td>
            <td>Tanggung Jawab</td>
            <td>Toleransi</td>
            <td>Gotong Royong</td>
            <td>Santun</td>
            <td>Percaya Diri</td>
          </tr>
        </thead>
        <?php
        $i = 1;
        $row = '';
        foreach ($hasilbelajar as $baris) {
          $arr = array();
          $row .= "<tr>";
          $row .= "<td>$i</td>";
          $row .= "<td style='text-align:left;'>$baris->nama_lengkap</td>";
          if ($sub_pnl == 'UAS')
          {
            if ($baris->JJR_UAS != 0)
            {
              array_push($arr, $baris->JJR_UAS);
              $row .= "<td>$baris->JJR_UAS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          else
          {
            if ($baris->JJR_UTS != 0)
            {
              array_push($arr, $baris->JJR_UTS);
              $row .= "<td>$baris->JJR_UTS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          if ($sub_pnl == 'UAS')
          {
            if ($baris->DSP_UAS != 0)
            {
              array_push($arr, $baris->DSP_UAS);
              $row .= "<td>$baris->DSP_UAS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          else
          {
            if ($baris->DSP_UTS != 0)
            {
              array_push($arr, $baris->DSP_UTS);
              $row .= "<td>$baris->DSP_UTS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          if ($sub_pnl == 'UAS')
          {
            if ($baris->TGJB_UAS != 0)
            {
              array_push($arr, $baris->TGJB_UAS);
              $row .= "<td>$baris->TGJB_UAS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          else
          {
            if ($baris->TGJB_UTS != 0)
            {
              array_push($arr, $baris->TGJB_UTS);
              $row .= "<td>$baris->TGJB_UTS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          if ($sub_pnl == 'UAS')
          {
            if ($baris->TLRS_UAS != 0)
            {
              array_push($arr, $baris->TLRS_UAS);
              $row .= "<td>$baris->TLRS_UAS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          else
          {
            if ($baris->TLRS_UTS != 0)
            {
              array_push($arr, $baris->TLRS_UTS);
              $row .= "<td>$baris->TLRS_UTS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          if ($sub_pnl == 'UAS')
          {
            if ($baris->GTRY_UAS!= 0)
            {
              array_push($arr, $baris->GTRY_UAS);
              $row .= "<td>$baris->GTRY_UAS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          else
          {
            if ($baris->GTRY_UTS != 0)
            {
              array_push($arr, $baris->GTRY_UTS);
              $row .= "<td>$baris->GTRY_UTS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          if ($sub_pnl == 'UAS')
          {
            if ($baris->SNTN_UAS != 0)
            {
              array_push($arr, $baris->SNTN_UAS);
              $row .= "<td>$baris->SNTN_UAS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          else
          {
            if ($baris->SNTN_UTS != 0)
            {
              array_push($arr, $baris->SNTN_UTS);
              $row .= "<td>$baris->SNTN_UTS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          if ($sub_pnl == 'UAS')
          {
            if ($baris->PCDR_UAS != 0)
            {
              array_push($arr, $baris->PCDR_UAS);
              $row .= "<td>$baris->PCDR_UAS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          else
          {
            if ($baris->PCDR_UTS != 0)
            {
              array_push($arr, $baris->PCDR_UTS);
              $row .= "<td>$baris->PCDR_UTS</td>";
            }
            else
            {
              $row .= "<td>-</td>";
            }
          }
          $jmlNilai = 0 ;
          $ttlElem = count($arr);

          for ($a=0;$a<$ttlElem;$a++) {
            if ($a == $ttlElem) {
              $jmlNilai = 0;
            }
            else
            {
              $jmlNilai += $arr[$a];
            }
          }

          if ($ttlElem == 0) {
            $row .= "<td>-</td>";
          }
          else {
            $nA = round($jmlNilai / $ttlElem);
            $row .= "<td>".konversi_sikap($nA)."</td>";
          }
          $row .= '<td>'.$baris->comment.'</td>';

          $row .= "</tr>";
          $i += 1;
        }
        ?>
        <?php echo trim($row); ?>
      </table>


      <table class="tables" style="width:100%;font-weight:bold;text-align:center;">
        <thead style="background:#0088ff;color:white;">
          <tr>
            <td rowspan="2" style="vertical-align:middle;">NO.</td>
            <td rowspan="2" style="vertical-align:middle;">NAMA SISWA</td>
            <td colspan="5">SIKAP</td>
            <td rowspan="2" style="vertical-align:middle;">NILAI</td>
            <td rowspan="2" style="vertical-align:middle;">DESKRIPSI SIKAP SPIRITUAL</td>
          </tr>
          <tr>
            <td>Berdo'a dan Beribadah</td>
            <td>Memberi Salam</td>
            <td>Bersyukur dan Tawakal</td>
            <td>Menjaga Lingkungan</td>
            <td>Menghormati Orang Lain</td>
          </tr>
        </thead>
        <?php
        $i = 1;
        $row1 = '';
        foreach ($hasilbelajar as $baris) {
          $arr = array();
          $row1 .= "<tr>";
          $row1 .= "<td>$i</td>";
          $row1 .= "<td style='text-align:left;'>$baris->nama_lengkap</td>";
          if ($sub_pnl == 'UAS')
          {
            if ($baris->IBDH_UAS != 0) {
              array_push($arr, $baris->IBDH_UAS);
              $row1 .= '<td>'.$baris->IBDH_UAS.'</td>';
            }
            else
            {
              $row1 .= '<td>-</td>';
            }
          }
          else
          {
            if ($baris->IBDH_UTS != 0) {
              array_push($arr, $baris->IBDH_UTS);
              $row1 .= '<td>'.$baris->IBDH_UTS.'</td>';
            }
            else
            {
              $row1 .= '<td>-</td>';
            }
          }
          if ($sub_pnl == 'UAS')
          {
            if ($baris->MBRSLM_UAS != 0) {
              array_push($arr, $baris->MBRSLM_UAS);
              $row1 .= '<td>'.$baris->MBRSLM_UAS.'</td>';
            }
            else
            {
              $row1 .= '<td>-</td>';
            }
          }
          else
          {
            if ($baris->MBRSLM_UTS != 0) {
              array_push($arr, $baris->MBRSLM_UTS);
              $row1 .= '<td>'.$baris->MBRSLM_UTS.'</td>';
            }
            else
            {
              $row1 .= '<td>-</td>';
            }
          }
          if ($sub_pnl == 'UAS')
          {
            if ($baris->TWKL_UAS != 0) {
              array_push($arr, $baris->TWKL_UAS);
              $row1 .= '<td>'.$baris->TWKL_UAS.'</td>';
            }
            else
            {
              $row1 .= '<td>-</td>';
            }
          }
          else
          {
            if ($baris->TWKL_UTS != 0) {
              array_push($arr, $baris->TWKL_UTS);
              $row1 .= '<td>'.$baris->TWKL_UTS.'</td>';
            }
            else
            {
              $row1 .= '<td>-</td>';
            }
          }
          if ($sub_pnl == 'UAS')
          {
            if ($baris->MJGLKGN_UAS != 0) {
              array_push($arr, $baris->MJGLKGN_UAS);
              $row1 .= '<td>'.$baris->MJGLKGN_UAS.'</td>';
            }
            else
            {
              $row1 .= '<td>-</td>';
            }
          }
          else
          {
            if ($baris->MJGLKGN_UTS != 0) {
              array_push($arr, $baris->MJGLKGN_UTS);
              $row1 .= '<td>'.$baris->MJGLKGN_UTS.'</td>';
            }
            else
            {
              $row1 .= '<td>-</td>';
            }
          }
          if ($sub_pnl == 'UAS')
          {
            if ($baris->HRTOL_UAS != 0) {
              array_push($arr, $baris->HRTOL_UAS);
              $row1 .= '<td>'.$baris->HRTOL_UAS.'</td>';
            }
            else
            {
              $row1 .= '<td>-</td>';
            }
          }
          else
          {
            if ($baris->HRTOL_UTS != 0) {
              array_push($arr, $baris->HRTOL_UTS);
              $row1 .= '<td>'.$baris->HRTOL_UTS.'</td>';
            }
            else
            {
              $row1 .= '<td>-</td>';
            }
          }

          $ttlElem = count($arr);
          $jmlNilai = 0;
          for ($c=0; $c <$ttlElem ; $c++) {
            if ($c == $ttlElem) {
              $jmlNilai = 0;
            }
            $jmlNilai += $arr[$c];
          }
          if ($ttlElem == 0) {
            $row1 .= '<td>-</td>';
          }
          else
          {
            $nA = round($jmlNilai / $ttlElem);
            $row1 .= '<td>'.konversi_sikap($nA).'</td>';
          }

          $row1 .= '<td>'.$baris->comment_spiritual.'</td>';

          $row1 .= "</tr>";
          $i += 1;
        }
        ?>
        <?php echo trim($row1); ?>
      </table>
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
