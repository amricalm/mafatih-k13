<?php $this->load->view('page_head');?>
<?php
function konversi($tmp)
{
    $predikat = "";
    if($tmp<=1){
                    $predikat = 'D';
                }elseif ($tmp<=1.33){
                    $predikat = 'D+';
                }elseif ($tmp<=1.67){
                    $predikat = 'C-';
                }elseif ($tmp<=2){
                    $predikat = 'C';
                }elseif ($tmp<=2.33){
                    $predikat = 'C+';
                }elseif ($tmp<=2.67){
                    $predikat = 'B-';
                }elseif ($tmp<=3){
                    $predikat = 'B';
                }elseif ($tmp<=3.33){
                    $predikat = 'B+';
                }elseif ($tmp<=3.67){
                    $predikat = 'A-';
                }elseif ($tmp<=4){
                    $predikat = 'A';
                }
    return $predikat;
}

function DeskripsiNilai($arrNilai, $field, $value,$ki)
{
   $hasil ="";
   $aspek ="";
   if( strtoupper($ki)=='KI1'||strtoupper($ki)=='KI2')
   {
        $aspek = "SIKAP";
   }
   elseif(strtoupper($ki)=='KI3')
   {
        $aspek = "PENGETAHUAN";
   }
   elseif(strtoupper($ki)=='KI4')
   {
        $aspek = "KETERAMPILAN";
   }
   foreach($arrNilai as $key => $item)
   {
      if ( trim($item[$field]) === trim($value) && strtoupper($item['aspek'])=== $aspek )
         
         $hasil = $arrNilai[$key]['deskripsi'];
   }
   return $hasil;
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
            <a href="<?php echo base_url().'index.php/export/export_nilai_mulok/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Rapor 2" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Raport.2  </a>
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
        	<!--
<th width="3%">No</th>
-->
            <th width="29%">Aspek</th>
            <th width="73%">Deskripsi</th>
            <th width="5%">Nilai</th>
            <th width="5%">Predikat</th>
        </tr>
        <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
        <?php
        $a  = 0;
        $i  = 1;
        $jmlkgn = 0;
        
        $jmh_mp = $hasilbelajar->num_rows();
        
        $ki1 = "Menerima, menghargai,
                dan menjalankan ajaran
                agama yang dianutnya";
                
        $ki2 = "Memiliki perilaku jujur,
                disiplin, tanggung
                jawab, santun, peduli,
                percaya diri, dan cinta
                tanah air dalam
                berinteraksi dengan
                keluarga, teman,
                tetangga, dan guru";
        $ki3 = "Memahami pengetahuan
                faktual dan konseptual
                dengan cara mengamati
                dan mencoba
                [mendengar, melihat,
                membaca] serta
                menanya berdasarkan
                rasa ingin tahu secara
                kritis tentang dirinya,
                makhluk ciptaan Tuhan
                dan kegiatannya, dan
                benda-benda yang
                dijumpainya di rumah,
                sekolah, dan tempat
                bermain";
                
        $ki4 = "Menyajikan
                pengetahuan faktual dan
                konseptual dalam bahasa
                yang jelas dan logis dan
                sistematis, dalam karya
                yang estetis dalam
                gerakan yang
                mencerminkan anak
                sehat, dan dalam
                tindakan yang
                mencerminkan perilaku
                anak beriman dan
                berakhlak mulia";
        
        $grouped=array();
        //print_r($hasilbelajar->result());die();
        foreach($hasilbelajar->result() as $row)
        { 
            
            //foreach($rows as $r)
  //$grouped[ $r[0] ][ $r[1] ][]=$r[2];
                $h = (is_null($row->kgn) || $row->kgn == 0 ) ? '0' : 1;
                $l = (is_null($row->psk) || $row->psk == 0 ) ? '0' : 1;
                $j = (is_null($row->afk) || $row->afk == 0 ) ? '0' : 1;
                
                $akum = $row->kgn+$row->psk+$row->afk;
                $m = $h + $l + $j;
                
                $a = (is_null($row->uas) || $row->uas == 0 ) ? '0' : 1;
                $b = (is_null($row->uaspsk) || $row->uaspsk == 0 ) ? '0' : 1;
                
                $akum_uas = $row->uas+$row->uaspsk;
                $c = $a + $b ;
                 
                $e = (is_null($row->uts) || $row->uts == 0 ) ? '0' : 1;
                $f = (is_null($row->utspsk) || $row->utspsk == 0 ) ? '0' : 1;
                
                $akum_uts = $row->uts+$row->utspsk;
                $g = $e + $f ;
                 
                $RT    = round(($m==0) ? 0 : $akum/$m);
                $RT_UAS = round(($c==0) ? 0 : $akum_uas/$c);
                $RT_UTS = round(($g==0) ? 0 : $akum_uts/$g);
                
                 
                $NA    = ($RT * 60/100)+($RT_UTS*20/100)+($RT_UAS*20/100);
                $nilai = array("kd"=>$row->ket_kd,"nilai"=>$NA, "ki"=>$row->kd_ki);
                $grouped[$row->deskripsi][]   =$nilai; //$row->ket_kd;
                
                
            //$bg = ($i%2==0) ? ' class="bg" ' : '';
//            if($a==0)
//            {
                //echo '<tr'.$bg.'>';
                //echo '<td width="3%" align="center">'.$i.'</td>';
                //echo '<td width="22%">'.$row->kd_ki.'</td>';
                //echo '<td width="4%" style="text-align:justify"> '. $row->ket_kd .'</td>';
        
                //echo '</tr>';
//			}else
//            {
                //$i++;
//                $bg = ($i%2==0) ? ' class="bg" ' : '';
//                echo '<tr'.$bg.'>';
//                echo '<td width="3%" align="center">'.$i.'</td>';
//                echo '<td width="22%">'.$ki2.'</td>';
//                //echo '<td width="4%" align="center"> '. $row->comment_sikap .'</td>';
//        
//                echo '</tr>';
//                
//                $i++;
//                $bg = ($i%2==0) ? ' class="bg" ' : '';
//                echo '<tr'.$bg.'>';
//                echo '<td width="3%" align="center">'.$i.'</td>';
//                echo '<td width="22%">'.$ki3.'</td>';
//                echo '<td width="4%" style="text-align:justify"> '. $row->comment_pengetahuan .'</td>';
//        
//                echo '</tr>';
//                
//                $i++;
//                $bg = ($i%2==0) ? ' class="bg" ' : '';
//                echo '<tr'.$bg.'>';
//                echo '<td width="3%" align="center">'.$i.'</td>';
//                echo '<td width="22%">'.$ki4.'</td>';
//                echo '<td width="4%" style="text-align:justify"> '. $row->comment_keterampilan .'</td>';
//        
//                echo '</tr>';
            //}
            
            $i++;
            $a++;
           
        }
         //print_r($grouped);die;
        
        foreach ($grouped as $name => $values) {
           echo "<tr><td rowspan=" . count($values) . ">$name</td>";
           $i= 0;
           foreach ($values as $val) {
              if($i>0)
              {
                    echo '<tr>';
              }
              $ket_nilai = DeskripsiNilai($tpl_deskripsi,'nilai',konversi($val['nilai']*4/100),$val['ki']);
              echo "<td><b>$ket_nilai. </b>" . $val['kd'] ."</td><td>". (round($val['nilai']))."</td><td>". konversi($val['nilai']*4/100)."</td></tr>";
              $i++;
           }
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
                <th width="15%">Predikat</th>
                
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
