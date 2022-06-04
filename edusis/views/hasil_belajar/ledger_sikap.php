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
      <table class="tables" align="center" style="width:100%;">
        <tr>
          <th rowspan="3">No.</th>
          <th rowspan="3">NAMA SISWA</th>
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
