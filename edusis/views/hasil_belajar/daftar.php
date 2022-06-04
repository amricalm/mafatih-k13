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
    <form action="<?php echo base_url().'index.php/hasilbelajar/daftar' ?>" method="POST" id="frmhasilbelajar">
    <!--atur pd (edusis_system/helpers/form_helper.php)function form_hidden, dg menambahkan (id="'.$name.'")-->
    <?php echo form_hidden('myurl',site_url('hasilbelajar')) ?>
    <!--table filter-->                            
        <table border="0" width="100%">
            <tr>
                <td>Class</td><td>:</td>
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
                <?php if($this->uri->segment(3)!='' && $this->uri->segment(4) != '') { ?>
                <a href="javascript:ledger_depan('<?php echo base_url(); ?>index.php/export/ledger_sampul_depan/');" id="" title="Print Cover" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//print.png" /></a>
                <a href="javascript:ledger('<?php echo base_url(); ?>index.php/export/ledger/');" id="" title="Print Ledger" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg//print.png" /></a>
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
                        echo form_dropdown('nama_lengkap',$option, $nis,' class="input-text" id="nis"');
                    ?>
                    <a href="javascript:filter()" class="small button blue">Filter</a>
                    </div>
                </td>
                <td style="border:none;verical-align: topt;text-align: left;width:25%; padding-top: 10px;" rowspan="2">
                    
                </td>              
            </tr>
        </table>
    <!--end table filter-->
    <!--table daftar hasil study-->
    <br />
        <table class="tables" align="center" width="100%" cellpadding="0">
            <tr>
            	<th width="3%">#</th> 
            	<th width="22%">Subject</th>
            	<th colspan="4" width="16%">Unit Test</th>
            	<th colspan="4" width="16%">School Work</th>
            	<th colspan="4" width="16%">Home Work</th>
            	<th colspan="4" width="16%">Project</th>
            	<th width="5%">Mid Test</th>
            	<th width="5%">Average</th>
            </tr>
            <?php 
            $i  = 1;
            foreach($hasilbelajar->result() as $row)
            {
                $jumlah = 0;
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td width="3%" align="center">'.$i.'</td>';
                echo '<td width="22%">'.$row->nm_mp.'</td>';
                $UT1    = ($row->UT1=='0') ? ' ' : $row->UT1;
                echo '<td width="4%" align="center">'.$UT1.'</td>';
                $jumlah += $row->UT1;
                $UT2    = ($row->UT2=='0') ? ' ' : $row->UT2;
                echo '<td width="4%" align="center">'.$UT2.'</td>';
                $jumlah += $row->UT2;
                $UT3    = ($row->UT3=='0') ? ' ' : $row->UT3;
                echo '<td width="4%" align="center">'.$UT3.'</td>';
                $jumlah += $row->UT3;
                $UT4    = ($row->UT4=='0') ? ' ' : $row->UT4;
                echo '<td width="4%" align="center">'.$UT4.'</td>';
                $jumlah += $row->UT4;
                $SW1    = ($row->SW1=='0') ? ' ' : $row->SW1;
                echo '<td width="4%" align="center">'.$SW1.'</td>';
                $jumlah += $row->SW1;
                $SW2    = ($row->SW2=='0') ? ' ' : $row->SW2;
                echo '<td width="4%" align="center">'.$SW2.'</td>';
                $jumlah += $row->SW2;
                $SW3    = ($row->SW3=='0') ? ' ' : $row->SW3;
                echo '<td width="4%" align="center">'.$SW3.'</td>';
                $jumlah += $row->SW3;
                $SW4    = ($row->SW4=='0') ? ' ' : $row->SW4;
                echo '<td width="4%" align="center">'.$SW4.'</td>';
                $jumlah += $row->SW4;
                $HW1    = ($row->HW1=='0') ? ' ' : $row->HW1;
                echo '<td width="4%" align="center">'.$HW1.'</td>';
                $jumlah += $row->HW1;
                $HW2    = ($row->HW2=='0') ? ' ' : $row->HW2;
                echo '<td width="4%" align="center">'.$HW2.'</td>';
                $jumlah += $row->HW2;
                $HW3    = ($row->HW3=='0') ? ' ' : $row->HW3;
                echo '<td width="4%" align="center">'.$HW3.'</td>';
                $jumlah += $row->HW3;
                $HW4    = ($row->HW4=='0') ? ' ' : $row->HW4;
                echo '<td width="4%" align="center">'.$HW4.'</td>';
                $jumlah += $row->HW4;
                $P1    = ($row->P1=='0') ? ' ' : $row->P1;
                echo '<td width="4%" align="center">'.$P1.'</td>';
                $jumlah += $row->P1;
                $P2    = ($row->P2=='0') ? ' ' : $row->P2;
                echo '<td width="4%" align="center">'.$P2.'</td>';
                $jumlah += $row->P2;
                $P3    = ($row->P3=='0') ? ' ' : $row->P3;
                echo '<td width="4%" align="center">'.$P3.'</td>';
                $jumlah += $row->P3;
                $P4    = ($row->P4=='0') ? ' ' : $row->P4;
                echo '<td width="4%" align="center">'.$P4.'</td>';
                $jumlah += $row->P4;
                $MT    = ($row->MT=='0') ? ' ' : $row->MT;
                echo '<td width="5%" align="center">'.$MT.'</td>';
                $jumlah += $row->MT;
                $ratarata = $jumlah/17;
                
                $ratarata = (round($ratarata,2)=='0') ? ' ' : round($ratarata,2);//round berfungsi untuk pembulatan desimal, ceil desimal keatas, floor desimal kebawah 
                echo '<td width="5%" align="center">'.$ratarata.'</td>';//
                $i++;
                echo '</tr>';
            }
            ?>
        </table>
        <!-- end table hsil study -->
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
