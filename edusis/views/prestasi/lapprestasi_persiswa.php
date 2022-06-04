<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>PRESTASI SISWA</h1>
<div id="tab01">
<table border="1" width="100%">
    <tr>
    <td valign="top">
    <form action="<?php echo base_url().'index.php/lapprestasi/prestasipersiswa' ?>" method="POST" id="frmhasilbelajar">
    <!--atur pd (edusis_system/helpers/form_helper.php)function form_hidden, dg menambahkan (id="'.$name.'")-->
    <?php echo form_hidden('myurl',site_url('hasilbelajar')) ?>
    <!--table filter-->                            
        <table border="0" width="100%">
            <tr>
                <td>Kelas</td><td>:</td>
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
                <td align="right" width="63%">
                <?php if($this->uri->segment(3)!='0' && $this->uri->segment(4) != '0') { ?>
                    <a href="<?php echo base_url().'index.php/export/lapprestasi_persiswa/'.$this->uri->segment(3).'/'.$this->uri->segment(4);?>" title="Print Ledger" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
                <?php } ?>
                </td>  
            </tr>
            <tr>
                <td>Nama Siswa</td><td>:</td>   
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
                    </div>
                </td>
                <td style="border:none;vertical-align: top;text-align: left;width:25%" rowspan="2">
                    <a href="javascript:filter()" class="small button blue">Filter</a>
                </td>              
            </tr>
        </table>
    <!--end table filter-->
    <!--table daftar hasil study-->
    <br />
        <table class="tables" align="center" width="100%" cellpadding="0">
            <tr>
            	<th width="2%">No.</th> 
                <th width="10%">Tanggal</th>
                <?php if($this->uri->segment(3)=='' && $this->uri->segment(4) == '' || $this->uri->segment(3)=='0' && $this->uri->segment(4) == '0') { ?>
            	<th width="5%">No Induk</th>
                <th width="23%">Nama Siswa</th>
            	<?php }?>
                <th width="60%">Prestasi</th>
            	<th width="10%">Poin</th>
            </tr>
        <?php 
        $jumlah = 0;
        $i = 1;
            foreach($prestasisiswa->result() as $row)
            {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$i.'</td>';
                $tgl = ($row->tgl == '' || $row->tgl == '0'|| $row->tgl == 'NULL') ? explode(' ','0 0 0') : explode(' ',$row->tgl);
                $a=($tgl[0] == '0') ? ' ' : $tgl[0];
                $b=($tgl[1] == '0') ? ' ' : $tgl[1];
                $c=($tgl[2] == '0') ? ' ' : $tgl[2];
            	echo '<td align="center">'.$a.' '.$b.' '.$c.'</td>';
                if($this->uri->segment(3)=='' && $this->uri->segment(4) == '' || $this->uri->segment(3)=='0' && $this->uri->segment(4) == '0') 
                {
                    echo '<td align="center">'.$row->nis.'</td>';
                    echo '<td>'.$row->nama_lengkap.'</td>';
                }
                echo '<td>'.$row->nm_prestasi.'</td>';
                echo '<td align="center">'.$row->point.'</td>';
                $jumlah += $row->point;
                $i++;
                echo '</tr>';
            }
            if($jumlah>=300)
            {
                $ket='Dikembalikan pada orang tua';
            }
            elseif($jumlah>=250)
            {
                $ket='Skorsing';
            }
            elseif($jumlah>=200)
            {
                $ket='Panggilan Orang Tua / Wali Murid Untuk yang Kedua Kali';
            }
            elseif($jumlah>=150)
            {
                $ket='Panggilan Orang Tua / Wali Murid Untuk yang Pertama Kali';
            }
            else{$ket='';}
        ?>
        <?php if($this->uri->segment(3)!='' && $this->uri->segment(4) != '' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '0'){ ?> 
        <tr>
            <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jumlah poin</td>
            <td align="center"><?php echo ($jumlah==0) ? '' : $jumlah; ?></td>
        </tr>
        <?php } ?>
        <!--<tr>
            <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Keterangan</td>
            <td colspan="2" style="color:red; text-decoration: blink;">&nbsp;&nbsp;&nbsp;<?php //echo $ket; ?></td>
        </tr>-->
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
        var kelas         = urlencode($('#skelas').val()); 
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
    function doBlink() 
    { 
      var blink = document.all.tags("BLINK") 
      for (var i=0; i < blink.length; i++) 
        blink[i].style.visibility = blink[i].style.visibility == "" ? "hidden" : "" 
    } 
    
    function startBlink() 
    { 
      if (document.all) 
        setInterval("doBlink()",1000) 
    } 
    window.onload = startBlink;
</script>

</body>
</html>
