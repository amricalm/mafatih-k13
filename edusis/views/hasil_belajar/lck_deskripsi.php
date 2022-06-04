<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>CAPAIAN KOMPETENSI</h1>
<div id="tab01">
    <form action="<?php echo base_url().'index.php/hasilbelajar/lck_deskripsi' ?>" method="POST" id="frmhasilbelajar">
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
            <a href="<?php echo base_url().'index.php/export/export_lck_deskripsi_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Rapor 2" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Raport.2</a>
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
        	<th width="3%">No</th>
            <th width="20%">Mata Pelajaran</th>
            <th width="10%">Kompetensi</th>
            <th width="20%">Catatan</th>
            
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
            echo '<td rowspan="3" width="3%" align="center">'.$i.'</td>';
            echo '<td rowspan="3" width="10%">'.$row->nm_mp.'</td>';
            echo '<td width="10%" align="center">Pengetahuan</td>';
            echo '<td width="20%" align="center">'.$row->comment_pengetahuan.'</td>';
            echo '</tr>';
            
            echo '<tr>';
            echo '<td width="10%" align="center">Keterampilan</td>';
            echo '<td width="20%" align="center">'.$row->comment_keterampilan.'</td>';
            echo '</tr>';
            
            echo '<tr>';
            echo '<td width="10%" align="center">Sikap Spiritual dan Sosial</td>';
            echo '<td width="20%" align="center">'.$row->comment_sikap.'</td>';
            echo '</tr>';
            

            
            
			$i++;
            $a++;
        }
        ?>

        <?php }?>
    </table>
    
    <!--end table hasil study-->
    <br />

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
