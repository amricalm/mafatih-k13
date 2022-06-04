<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>LEDGER NILAI</h1>
<div id="tab01">
<table border="1" width="100%">
<tr>
    <td valign="top">
    <form action="<?php echo base_url().'index.php/hasilbelajar/report_nilai2' ?>" method="POST" id="frmhasilbelajar">
    <!--atur pd (edusis_system/helpers/form_helper.php)function form_hidden, dg menambahkan (id="'.$name.'")-->
    <?php echo form_hidden('myurl',site_url('hasilbelajar')) ?>
    <!--table filter-->                            
    <table border="1" width="100%">
        <tr>
            <td width="100px">Class</td>
            <td> 
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
            <td align="right" width="63%">
            <?php if($this->uri->segment(3) !='' && $this->uri->segment(4) !=''){ ?>
            <a href="javascript:ledger('<?php echo base_url(); ?>index.php/export/report_nilai2/');" id="" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//print.png" /></a>
            <?php } ?>
            </td>  
        </tr>
        <tr>
            <td>Student Name</td><td>:</td>   
            <td style="border:none">
                <div id="resultnama">
                <?php
                    $seq =0;
                    $option = array(0=>"");
                    foreach ($nama->result() as $row)
                    {   
                        $option = $option + array(trim($row->nis)=>$row->nama_lengkap);
                        $seq++;
                    }
                    //echo $nis;
                    echo form_dropdown('nama_lengkap',$option, $nis,' class="input-text" id="nis"');
                ?>
                </div>
            </td>
            <td style="border:none;vertical-align: top;text-align: left;width:25%; padding: 10px;" rowspan="2">
                <a href="javascript:filter()" class="small button blue">Filter</a>
            </td>              
        </tr>
    </table>
    <!--end table filter-->
    <!--table daftar hasil study-->
    <br />
<table class="tables" width="100%" >
<label><b>Kepribadian</b></label>
<tr>
	<th width="3%" >No</th>
    <th width="25%">Kepribadian</th>
    <th width="10%">Nilai</th>
    <th width="62%">Keterangan</th>
</tr>
<?php   
    $i = 1;
    foreach($pribadi->result() as $row)
    {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        echo '<tr'.$bg.'>';
        echo '<td align="center">'.$i.'</td>';
        echo '<td>'.$row->ket_pribadi.'</td>';
        $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
        echo '<td align="center">'.$nilai.'</td>';
        echo '<td></td>';
        echo '</tr>';
        $i++;
    }
?>
</table>
<br />
<br />
<table  width="100%" class="tables">
<label><b>Ekstrakurikuler</b></label>
<tr>
	<th width="3%">No</th>
    <th width="25%">Jenis Ekstrakurikuler</th>
    <th width="10%">Nilai</th>
    <th width="62%">Keterangan</th>
</tr>
<?php   
    $i = 1;
    foreach($eskul->result() as $row)
    {
        $bg = ($i%2==0) ? ' class="bg" ' : '';
        echo '<tr'.$bg.'>';
        echo '<td align="center">'.$i.'</td>';
        echo '<td>'.$row->nm_eskul.'</td>';
        $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
        echo '<td align="center">'.$nilai.'</td>';
        echo '<td></td>';
        echo '</tr>';
        $i++;
    }
?>
</table>
<br />
<br />
<table style=" border-collapse:collapse; border-color:#cfcfcf; " align="center" border="1" align="center" width="100%" cellpadding="0">
<label><b>Karya Tulis</b></label>
<tr style="border-color:#cfcfcf; ">
	<th width="3%" style="border-color:#cfcfcf; ">No</th>
    <th width="87%" style="border-color:#cfcfcf; ">Jenis</th>
    <th width="10%" style="border-color:#cfcfcf; ">Nilai</th>
</tr>
<?php 
    $i =1;
    foreach($karyatulis->result() as $row)
    {
        $bg = ($i%2 == 0) ? ' class="bg"' : '';
        echo '<tr'.$bg.'>';
        echo '<td>'.$i.'</td>';
        echo '<td>'.$row->karyatulis.'</td>';
        echo '<td align="center">'.$row->hasil.'</td>';
        $i++;
        echo '</tr>';
    }
?>
</table>
<br />
<br />
<table class="tables" width="100%">
<label><b>Ketidakhadiran</b></label>
<tr>
	<th width="3%">No</th>
    <th width="87%">Alasan</th>
    <th width="10%">Jumlah</th>
</tr>
<tr>
    <td align="center">1</td>
    <td>Sakit</td>
    <td align="center"><?php $a=($absens->row()->alfa == '0') ? '-' : $absens->row()->alfa; echo $a; ?></td>
</tr>
<tr style="background-color:#e8f6ff;">
    <td align="center">2</td>
    <td>Ijin</td>
    <td align="center"><?php $a=($abseni->row()->alfa == '0') ? '-' : $abseni->row()->alfa; echo $a; ?></td>
</tr>
<tr>
    <td align="center">3</td>
    <td>Tanpa Keterangan</td>
    <td align="center"><?php $a=($absena->row()->alfa == '0') ? '-' : $absena->row()->alfa; echo $a; ?></td>
</tr>
</table>
<br />
<br />
    <!--end table hasil study-->
    </form> 
    </td>
</tr>
</table>
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
