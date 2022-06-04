<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>KETERCAPAIAN KOMPETENSI SISWA</h1>
		<div id="tab01">
<table border="1" width="100%">
<tr>
<td valign="top">
<form action="<?php echo base_url().'index.php/hasilbelajar/report_nilai3' ?>" method="POST" id="frmhasilbelajar">
<!--atur pd (edusis_system/helpers/form_helper.php)function form_hidden, dg menambahkan (id="'.$name.'")-->
<?php echo form_hidden('myurl',site_url('hasilbelajar')) ?>
<!--table filter-->                            
<table border="1" width="100%">
    <tr>
        <td>Class</td>
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
            <a href="javascript:ledger('<?php echo base_url(); ?>index.php/export/ledger_nilai3/');" id="" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//print.png" /></a>
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
</td>
</tr>
</table>
<!--end table filter-->
<!--table daftar hasil study-->
<table class="tables" width="100%" cellpadding="0">
<tr>
	<th width="5%">No</th>
    <th width="20%">Mata Pelajaran</th>
    <th width="75%">Ketercapaian Kompetensi</th>
</tr>
<?php 
$i  = 1;
foreach($hasilbelajar->result() as $row)
{
    $bg = ($i%2==0) ? ' class="bg" ' : '';
    echo '<tr'.$bg.'>';
    echo '<td width="1%" align="center">'.$i.'</td>';
    echo '<td width="20%">'.$row->nm_mp.'</td>';
    echo '<td width="79%">'.$row->kks.'</td>';
    $i++;
    echo '</tr>';
}

?>
</table>
<!--end table hasil study-->
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
