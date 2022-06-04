<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>RAPOR</h1>
<div id="tab01">
    <form action="<?php echo base_url().'index.php/hasilbelajar/report_nilai1A' ?>" method="POST" id="frmhasilbelajar">
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
            <td align="right" width="">
            <?php if($this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
            <a href="<?php echo base_url().'index.php/export/export_depan_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Sampul Ledger" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Sampul </a>
            <a href="<?php echo base_url().'index.php/siswa/profile_pdf/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Profil Siswa" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Profil&nbsp&nbsp&nbsp  </a>
            <a href="<?php echo base_url().'index.php/export/export_nilai1/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Rapor 1" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Raport.1  </a>
            <a href="<?php echo base_url().'index.php/export/export_catatan_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Rapor 2" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Raport.2</a>
            <a href="<?php echo base_url().'index.php/export/export_ledger2_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Rapor 3" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Raport.3  </a>
            <?php } ?>
            </td>  
        </tr>
        <tr>
            <td>Nama Siswa</td>   
            <td>
                <div id="resultnama">
                <?php
                    $option = array(0=>"&nbsp;");
                    foreach ($nama->result() as $row)
                    {   
                        $option = $option + array(trim($row->nis)=>$row->nama_lengkap) ;
                    }
                    //echo $nis;
                    echo form_dropdown('nis',$option,$nis,'id="nis"');
                ?>
                </div>
            </td>
            <td>
                <a href="javascript:filter()" class="small button blue">Filter</a>
            </td>           
        </tr>
    </table>
    <!--end table filter-->
    <!--table daftar hasil study-->
    <?php if($tampil==''){} else { ?>
    <form action="" method="post">
    <table class="tables" align="center%" width="100%" cellpadding="0">
        <tr>
        	<th rowspan="2" width="3%">No</th>
            <th rowspan="2" width="29%">Mata Pelajaran</th>
            <th rowspan="2" width="10%">Kriteria Ketuntasan<br/>Minimal</th>
            <th colspan="2" width="24%">Nilai</th>
        </tr>
        <tr>
        	<th width="9%">Angka</th>
        	<th width="15%">Huruf</th>
        </tr>
        <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
        <?php
        $a  = 0;
        $i  = 1;
        $jmlkgn = 0;
        foreach($hasilbelajar->result() as $row)
        { 
            $bg = ($i%2==0) ? ' class="bg" ' : '';
            echo '<tr'.$bg.'>';
            echo '<td width="3%" align="center">'.$i.'</td>';
            echo '<td width="22%">'.$row->nm_mp.'</td>';
            echo '<td width="4%" align="center">'.$row->skbm.'</td>';
            
            $kgn    = ($row->kgn=='0') ? '0' : $row->kgn;
            echo '<td width="4%" align="center">'.$kgn.'</td>';
            $jmlkgn += $row->kgn;
			if ($kgn=='') 
			{
				echo '<td width="4%">&nbsp;</td>';
			}
			else
			{
				echo '<td width="4%">'.$this->terbilang->rp_terbilang($kgn,0).'</td>';
            }
			$i++;
            $a++;
            echo '</tr>';
        }
        ?>
        <tr>
            <td colspan="3" align="center" style="height: 28px;">Jumlah</td>
            <td align="center"><?php $x=($jmlkgn==0) ? '' : $jmlkgn; echo $x; ?></td>
            <td><?php if($x!='0' && $x!='' && $x!='-'){ echo $this->terbilang->rp_terbilang($x,0);} ?></td>
        </tr>
        <tr>
            <td colspan="3" align="center" style="height: 28px;">Rata - Rata</td>
            <td align="center"><?php $y = ($jmlkgn==0) ? '' : round($jmlkgn/($a)); echo $y ?></td>
            <td><?php if($y!='0' && $y!=''){ echo $this->terbilang->rp_terbilang($y,0);} ?></td>
        </tr>
        <?php }?>
    </table>
    
    <!--end table hasil study-->
    <br />
    <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
    <table border="1" width="100%">
    <tr>
        <td width="50%" style="vertical-align: top;">
            <table class="tables" width="100%" >
            <label><b>Kepribadian</b></label>
            <tr>
            	<th width="3%" >No</th>
                <th width="25%">Kepribadian</th>
                <th width="10%">Nilai</th>
            </tr>
            
            <?php   
                $i = 1;
                foreach($pribadi->result() as $row)
                {
                    $kd = (trim($row->kd_pribadi)=='KSP' || trim($row->kd_pribadi)=='KBSH' || trim($row->kd_pribadi)=='KDSP') ? 'a' : 'b';
                    if($kd == 'a')
                    {
                    $bg = ($i%2==0) ? ' class="bg" ' : '';
                    echo '<tr'.$bg.'>';
                    echo '<td align="center">'.$i.'</td>';
                    echo '<td>'.$row->ket_pribadi.'</td>';
                    $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
                    echo '<td align="center">'.$nilai.'</td>';
                    echo '</tr>';
                    $i++;
                    }
                }
            ?>
            </table>
        </td>
        <td width="50%" style="vertical-align: top;">
            <table class="tables" width="100%">
            <label><b>Ketidakhadiran</b></label>
            <tr>
            	<th width="25%">Ketidakhadiran</th>
                <th width="10%">Hari</th>
            </tr>
            <tr>
                <td>Sakit</td>
                <td align="center"><?php $a=($absens->row()->alfa == '0') ? '-' : $absens->row()->alfa; echo $a; ?></td>
            </tr>
            <tr style="background-color:#e8f6ff;">
                <td>Ijin</td>
                <td align="center"><?php $a=($abseni->row()->alfa == '0') ? '-' : $abseni->row()->alfa; echo $a; ?></td>
            </tr>
            <tr>
                <td>Tanpa Keterangan</td>
                <td align="center"><?php $a=($absena->row()->alfa == '0') ? '-' : $absena->row()->alfa; echo $a; ?></td>
            </tr>
            </table>
        </td>
    </tr>
    </table>
    <?php } ?>
    <br />
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
