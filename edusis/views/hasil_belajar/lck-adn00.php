<?php $this->load->view('page_head');?>
<?php

function konversi_sma_4skala($tmp)
{
    $predikat = "";
                if($tmp<=54){
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

function konversi_sma($tmp)
{
    $predikat = "";
                if($tmp<=54){
                    $predikat = 'D';
                }elseif ($tmp<=59){
                    $predikat = 'D+';
                }elseif ($tmp<=64){
                    $predikat = 'C-';
                }elseif ($tmp<=69){
                    $predikat = 'C';
                }elseif ($tmp<=74){
                    $predikat = 'C+';
                }elseif ($tmp<=79){
                    $predikat = 'B-';
                }elseif ($tmp<=84){
                    $predikat = 'B';
                }elseif ($tmp<=90){
                    $predikat = 'B+';
                }elseif ($tmp<=95){
                    $predikat = 'A-';
                }elseif ($tmp<=100){
                    $predikat = 'A';
                }
    return $predikat;
}

function konversi($tmp)
{
    $predikat = "";
    if($tmp<=1){
                    $predikat = 'D';
                }elseif ($tmp<=1.33){
                    $predikat = 'D+';
                }elseif ($tmp<=1.66){
                    $predikat = 'C-';
                }elseif ($tmp<=2){
                    $predikat = 'C';
                }elseif ($tmp<=2.33){
                    $predikat = 'C+';
                }elseif ($tmp<=2.66){
                    $predikat = 'B-';
                }elseif ($tmp<=3){
                    $predikat = 'B';
                }elseif ($tmp<=3.33){
                    $predikat = 'B+';
                }elseif ($tmp<=3.66){
                    $predikat = 'A-';
                }elseif ($tmp<=4){
                    $predikat = 'A';
                }
    return $predikat;
}

function konversi_sikap($tmp)
{
    $predikat = "";
                if($tmp==0){
                    $predikat = '';
                }
                elseif($tmp<=25){
                    $predikat = 'K';
                }elseif ($tmp<=50){
                    $predikat = 'C';
                }elseif ($tmp<=75){
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
                    $predikat = '';
                }
                elseif($tmp<=59){
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
?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>CAPAIAN KOMPETENSI</h1>
<div id="tab01">
    <form action="<?php echo base_url().'index.php/hasilbelajar/lck' ?>" method="POST" id="frmhasilbelajar">
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
        	<th rowspan="2" width="3%">No</th>
            <th rowspan="2" width="29%">Mata Pelajaran</th>
            <th colspan="2"" width="10%">Pengetahuan<br />(KI-3)</th>
            <th colspan="2" width="10%">Keterampilan<br />(KI-4)</th>
            <th colspan="2" width="24%">Sikap Spiritual dan Sosial<br/>(KI-1 dan KI-2)</th>
        </tr>
        <tr>
            <th width="9%">Angka</th>
        	<th width="15%">Predikat</th>
            
            <th width="9%">Angka</th>
        	<th width="15%">Predikat</th>
            
        	<th width="9%">Dalam Mapel</th>
        	<th width="15%">Antar Mapel</th>
        </tr>
        <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
        <?php
        $a  = 0;
        $i  = 1;
        $jmlkgn = 0;
        
        $jmh_mp = $hasilbelajar->num_rows();
        foreach($hasilbelajar->result() as $row)
        { 
            $bg = ($i%2==0) ? ' class="bg" ' : '';
            if($a==0)
            {
                echo '<tr'.$bg.'>';
                echo '<td width="3%" align="center">'.$i.'</td>';
                echo '<td width="22%">'.$row->nm_mp.'</td>';
                
                if($this->session->userdata('kd_sekolah') =="04")
				{
                    echo '<td width="4%" align="center"> '. konversi_sma_4skala($row->kgn) .'</td>';
                    $tmp   =$row->kgn;
                    $predikat = konversi_sma($tmp);
                    echo '<td width="4%" align="center">'.$predikat .'</td>';
                }
                else
                {
                    echo '<td width="4%" align="center"> '. $row->kgn*4/100 .'</td>';
                    
                    $tmp   =$row->kgn*4/100;
                    $predikat = konversi($tmp);
                    echo '<td width="4%" align="center">'.$predikat .'</td>';
                }
                $kgn    = ($row->kgn=='0') ? '0' : $row->kgn;
                
                
                $jmlkgn += $row->kgn;
                if($this->session->userdata('kd_sekolah') =="04")
				{
				    echo '<td width="4%" align="center">'. konversi_sma_4skala($row->psk) .'</td>';
                }
                else
                {    
    			     echo '<td width="4%" align="center">'. $row->psk*4/100 .'</td>';
                }
                
                
				if($this->session->userdata('kd_sekolah') =="04")
				{
				    $tmp   =$row->psk;
                    $predikat = konversi_sma($tmp);
                    echo '<td width="4%" align="center">'. $predikat .'</td>';
                    
					$predikat = konversi_sikap_sma($row->afk);
					echo '<td width="4%" align="center">'. $predikat .'</td>';
				}
				else
				{
				    $tmp   =$row->psk*4/100;
                    $predikat = konversi($tmp);
                    echo '<td width="4%" align="center">'. $predikat .'</td>';
					$predikat = konversi_sikap($row->afk);
					echo '<td width="4%" align="center">'. $predikat .'</td>';
				}
				
               
                echo '<td rowspan="' . $jmh_mp . '" width="4%">'. $row->antar_mp .'</td>';
                echo '</tr>';
			}
            else
            {
                echo '<tr'.$bg.'>';
                echo '<td width="3%" align="center">'.$i.'</td>';
                echo '<td width="22%">'.$row->nm_mp.'</td>';
                
                if($this->session->userdata('kd_sekolah') =="04")
				{
                    echo '<td width="4%" align="center"> '. konversi_sma_4skala($row->kgn) .'</td>';
                    $tmp   =$row->kgn;
                    $predikat = konversi_sma($tmp);
                    echo '<td width="4%" align="center">'. $predikat .'</td>';
                }
                else
                {
                    echo '<td width="4%" align="center"> '. $row->kgn*4/100 .'</td>';
                    $tmp   =$row->kgn*4/100;
                    $predikat = konversi($tmp);
                    echo '<td width="4%" align="center">'. $predikat .'</td>';
                }
                
                $kgn    = ($row->kgn=='0') ? '0' : $row->kgn;
                $jmlkgn += $row->kgn;
                
                
                if($this->session->userdata('kd_sekolah') =="04")
				{
				    echo '<td width="4%" align="center">'. konversi_sma_4skala($row->psk) .'</td>';
                }
                else
                {    
    			     echo '<td width="4%" align="center">'. $row->psk*4/100 .'</td>';
                }
                
                
                
                if($this->session->userdata('kd_sekolah') =="04")
				{
				    
                    $tmp   =$row->psk;
                    $predikat = konversi_sma($tmp);
                    echo '<td width="4%" align="center">'. $predikat .'</td>';
                    
					$predikat = konversi_sikap_sma($row->afk);
					echo '<td width="4%" align="center">'. $predikat .'</td>';
				}
				else
				{
				    $tmp   =$row->psk*4/100;
                    $predikat = konversi($tmp);
                    echo '<td width="4%" align="center">'. $predikat .'</td>';
                    
                    
					$predikat = konversi_sikap($row->afk);
					echo '<td width="4%" align="center">'. $predikat .'</td>';
				}
                echo '</tr>';
            }
            $i++;
            $a++;
           
        }
        ?>

        <?php }?>
    </table>
    
    <!--end table hasil study-->
    <br />
    <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
    <table border="1" width="100%">
    <tr>
        <td width="50%" style="vertical-align: top;">
            <table class="tables" width="100%" >
            <label><b>Ekstrakurikuler</b></label>
            <tr>
            	<th width="3%" >No</th>
                <th width="20%">Ekstrakurikuler</th>
                <th width="15%">Nilai</th>
            </tr>
            
            <?php   
                $i = 1;
                foreach($eskul->result() as $row)
                {
//                    $kd = (trim($row->kd_pribadi)=='KSP' || trim($row->kd_pribadi)=='KBSH' || trim($row->kd_pribadi)=='KDSP') ? 'a' : 'b';
//                    if($kd == 'a')
//                    {
                    $bg = ($i%2==0) ? ' class="bg" ' : '';
                    echo '<tr'.$bg.'>';
                    echo '<td align="center">'.$i.'</td>';
                    echo '<td>'.$row->nm_eskul.'</td>';
                    $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
                    echo '<td align="center">'.$nilai.'</td>';
                    echo '</tr>';
                    $i++;
                    //}
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
