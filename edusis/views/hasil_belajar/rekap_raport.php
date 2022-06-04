<?php 
$this->load->view('page_head');?>
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
    <h1>REKAP RAPORT</h1>
<div id="tab01">
    <form action="<?php echo base_url().'index.php/hasilbelajar/rekap_nilai4' ?>" method="POST" id="frmhasilbelajar">
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
            <td>
                <a href="javascript:filter()" class="small button blue">Filter</a>
            </td>
            <td align="right" width="">
            <?php if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0') { ?>
            <a href="<?php echo base_url().'index.php/export/export_pengetahuan_k13_to_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
            <?php } ?>
            </td>
        </tr>
    </table>
    <!--end table filter-->
    <!--table daftar hasil study-->
    <?php if($tampil==''){} else { ?>
    <form action="" method="post">
      <h1>KI 3 (PENGETAHUAN)</h1>
      <table style="width:auto;" class="tables" > 
        <tr>
          <th style="width:1%">NO</th>
          <th style="width:3%">NO.INDUK</th>
          <th style="width: 25%;">NAMA SISWA</th>   
      
          <?php
            $seq_mp       = 0;
            foreach($nilai_akhir[$seq_mp] as $row)
            {
              echo '<th width="8%" colspan="2"><a href="#" class="namalengkap" title="" style="color:white; text-decoration: none;text-transform:upercase;">'.$row['KDMP'].'</a></th>';
              $seq_mp++;
            }
            echo '<th>JUMLAH</th>';
            echo '<th>RATA-RATA</th>';
          ?>
        </tr>
        <?php
          $i        = 1;
          $keys     = array_keys($nilai_akhir);
          foreach ($siswa_kgn->result() as $siswa) {
            $bg = ($i%2==0) ? ' class="bg" ' : '';
            echo '<tr'.$bg.'>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$siswa->nis.'</td>';
            echo '<td>'.$siswa->nama_lengkap.'</td>';
            $jmh    = 0;
            foreach ($nilai_akhir[$keys[$i]] as $key => $value) {
                echo '<td align="center">'.$value['RFINALKGN'].'</td>';
                echo '<td align="center">'.konversi_predikat($value['RFINALKGN']).'</td>';
                // echo '<td align="center">'.$value['NADESK'].'</td>';
                $jmh+= $value['RFINALKGN'];
            }
            $rataNl = ($seq_mp!=0) ? $jmh / $seq_mp : '';
            echo '<td align="center">'.$jmh.'</td>';
            echo '<td align="center">'.round($rataNl).'</td>';
            echo '</tr>';
            $i++;
          }
        ?>
      </table>
      <div>&nbsp;</div>
      <h1>KI 4 (KETERAMPILAN)</h1>
      <table style="width:auto;" class="tables" > 
        <tr>
          <th style="width:1%">NO</th>
          <th style="width:3%">NO.INDUK</th>
          <th style="width: 25%;">NAMA SISWA</th>   
      
          <?php
            $seq_mp       = 0;
            foreach($nilai_akhir_psk[$seq_mp] as $row)
            {
              echo '<th width="8%" colspan="2"><a href="#" class="namalengkap" title="" style="color:white; text-decoration: none;text-transform:upercase;">'.$row['KDMP'].'</a></th>';
              $seq_mp++;
            }
            echo '<th>JUMLAH</th>';
            echo '<th>RATA-RATA</th>';
          ?>
        </tr>
        <?php
          $j        = 1;
          $keys     = array_keys($nilai_akhir_psk);
          foreach ($siswa_psk->result() as $siswa) {
            $bg = ($j%2==0) ? ' class="bg" ' : '';
            echo '<tr'.$bg.'>';
            echo '<td>'.$j.'</td>';
            echo '<td>'.$siswa->nis.'</td>';
            echo '<td>'.$siswa->nama_lengkap.'</td>';
            $jmh    = 0;
            foreach ($nilai_akhir_psk[$keys[$j]] as $key => $value) {
                echo '<td align="center">'.$value['RFINALKGN'].'</td>';
                echo '<td align="center">'.konversi_predikat($value['RFINALKGN']).'</td>';
                // echo '<td align="center">'.$value['NADESK'].'</td>';
                $jmh+= $value['RFINALKGN'];
            }
            $rataNl = ($seq_mp!=0) ? $jmh / $seq_mp : '';
            echo '<td align="center">'.$jmh.'</td>';
            echo '<td align="center">'.round($rataNl).'</td>';
            echo '</tr>';
            $j++;
          }
        ?>
      </table>
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
        var myurl         = $('#myurl').val();
        var form_wi       = $('#frmhasilbelajar').attr('action');
        $('#frmhasilbelajar').attr('action',form_wi+'/'+kelas);
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