<html>
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
//print_r($tpl_deskripsi);die();
?>
<head>
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" /> 
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" /><!-- WRITE YOUR CSS CODE HERE -->
<title>Raport</title>
<style>

	@media all {*{
		
	}
	}
	@media print {*{
        margin-bottom : 50px;
		padding-bottom:  20px;
    }}
	
 .wrapperDiv {
    position: relative;
    margin-top: -3px;
	page-break-inside: auto;
  }
 .table {
    display: table;
    width: 100%;
    border: 1px outset;
    font-size: 0.9em;
	overflow: hidden !important;
	
  }
  .Tablerow {
    display: table-row;
	overflow: hidden !important;
	page-break-before:always;
	
  }
  .Tablecell {
    border: 1px solid;
    display: table-cell;
	overflow: hidden !important;
	page-break-before:always;
	
  }
  .Tablecell.empty
  {
    border: none;
	overflow: hidden !important;
	page-break-before:always;
    
  }
  .Tablecell.rowspanned {
    border: none;
    position: relative;
    column-span: all;
	overflow: hidden !important;
	page-break-before:always;
	
  }
</style>
<body>
<table align="center" border="0" width="95%" style=" font-size: 0.9em;">
    <tr>
    	<td width="25%">Nama Peserta Didik</td>
    	<td width="40%">: <?php echo $datasiswa->row()->nama_lengkap;?></td>
    	<td width="15%">Kelas</td>
    	<td width="20%">: <?php echo str_replace('+',' ',$this->uri->segment(3));?></td>
    </tr>
    <tr>
    	<td>Nomor Induk</td>
    	<td>: <?php echo $datasiswa->row()->nis;?></td>
    	<td>Semester</td>
    	<td>: <?php echo $this->session->userdata('kd_semester');?></td>
    </tr>
    <tr>
    	<td>Nama Sekolah</td>
    	<td>: <?php echo $sekolah->row()->nama_sekolah;?></td>
    	<td>Tahun Ajaran</td>
    	<td>: <?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
    	<td>Alamat Sekolah</td>
    	<td>: <?php echo $sekolah->row()->alamat_sekolah;?></td>
    </tr>
</table>
<br />

<table style=" border-collapse:collapse; padding-left: -1px; " align="center" border="1px" width="99.7%">
		<thead>
		<tr>
            <th height="32px;" width="20%">Aspek</th>
            <th width="64%">Deskripsi</th>
			<th width="5%">Nilai</th>
            <th width="10%">Predikat</th>
        </tr>
		</thead>
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
           
           echo "<div class='wrapperDiv'>
                          <div class='table'>
                            <div class='empty Tablerow' >
                              <div class='rowspanned Tablecell' style='float:left; padding:5px;width: 20%; '>
                                $name
                              </div>
                              ";
           
           //echo "<tr><td>$name</td>";
           $i= 0;
           foreach ($values as $val) {
              if($i>0)
              {
                  
                   // echo '<tr>';
              }
              $ket_nilai = DeskripsiNilai($tpl_deskripsi,'nilai',konversi($val['nilai']*4/100),$val['ki']);
             
           echo "
                      <div class='Tablecell' style='padding: 5px; width: 65%; '>
                        <b>$ket_nilai. </b>" . $val['kd'] ."
                      </div>
                      <div class='Tablecell' style='width: 5%; text-align: center; padding-top: 5px; '>
                        ". (round($val['nilai']))."
                      </div>
                      <div class='Tablecell' style='width: 10%; text-align: center; padding-top: 5px; '>
                        ". konversi($val['nilai']*4/100)."
                      </div>
                    </div>
                    <div class='Tablerow'>
                      <div class='empty Tablecell'></div>
                      
                    ";
			  //print_r($tpl_deskripsi);die();
			  //echo $val['ki'];die();
              //echo "<td><b>$ket_nilai. </b>" . $val['kd'] ."</td><td>". $val['nilai']."</td><td>". konversi($val['nilai']*4/100)."</td></tr>";
              //echo "";
              $i++;
           }
           echo "</div>
                  </div>
                </div>";
        }
       
        ?>

        <?php }?>
</table>
<br /><br/>
<table style="border-collapse:collapse; font-size: 0.9em; " align="center" border="1" width="100%" cellpadding="0">
        <tr>
        	<th align: center; height: 28px; width="4%">No</th>
    		<th width="38%" style="height: 20px;">Ekstra Kurikuler</th>
            <th width="58%">Keikutsertaan dalam kegiatan</th>
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
                        echo '<td width: 28px; align="center">'.$i.'</td>';
                        echo '<td style="padding-left: 5px;">'.$row->nm_eskul.'</td>';
                        $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
                        echo '<td align="center">'.$nilai.'</td>';
                        echo '</tr>';
                        $i++;
                        //}
                    }
                ?>
    </table>
<br />
<div >
<table style=" border-collapse:collapse; border: 1px solid;" align="left" frame="box" width="100%">
    <tr frame="box">
        <th colspan="3" width="35%" style="height: 32px;">Ketidakhadiran</th>
    </tr>
    <tr>
        <td width="77%" style="height: 28px;">&nbsp;&nbsp;&nbsp;Sakit</td>
        <td width="3%">:</td>
        <td width="30%" align="center"><?php $a=($absens->row()->alfa == '0') ? '-' : $absens->row()->alfa; echo $a; ?>&nbsp;&nbsp;Hari</td>
    </tr>
    <tr>
        <td style="height: 28px;">&nbsp;&nbsp;&nbsp;Ijin</td>
        <td>:</td>
        <td align="center"><?php $a=($abseni->row()->alfa == '0') ? '-' : $abseni->row()->alfa; echo $a; ?>&nbsp;&nbsp;Hari</td>
    </tr>
    <tr>
        <td style="height: 28px;">&nbsp;&nbsp;&nbsp;Tanpa Keterangan</td>
        <td>:</td>
        <td align="center"><?php $a=($abseina->row()->alfa == '0') ? '-' : $abseina->row()->alfa; echo $a; ?>&nbsp;&nbsp;Hari</td>
    </tr>
</table>
</div>
<br /><br /><br /><br /><br /><br /><br />
<table style="font-size: 0.9em;"align="center" border="0" width="100%" >
<tr>
    <td>
    <table>
        <tr>
            <td align="center">Mengetahui</td>
        </tr>
        <tr>
        	<td align="Center">Orang Tua / Wali <br /><br /><br /><br /><br /><br /></td>
        </tr>
        <tr>
        	<td align="center" style="border-bottom: 1px; text-decoration: underline;"><?php echo $datasiswa->row()->ayah_nama; ?></td>
        </tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
    </table>
    </td>
    <td  width="30%">
    <table width="100%";>
        <tr>
            <td align="center"><?php echo $sekolah->row()->kabupaten;?>, 20 Desember 2014<?php // echo $pilihtgl = date('d'); $pilihbln = date('m'); $pilihth = date('y'); echo ' - '; echo $pilihbln; echo ' - '; echo '20'; echo $pilihth; ?></td>
        </tr>
        <tr>
        	<td align="center">Wali Kelas, <br /><br /><br /><br /><br /><br /></td>
        </tr>
        <tr>
            <td align="center"><u><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></u></td>
        </tr>
        <tr>
            <td align="center">NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?></td>
        </tr>
    </table>
    </td>
</tr>
</table>
</body>
</html>