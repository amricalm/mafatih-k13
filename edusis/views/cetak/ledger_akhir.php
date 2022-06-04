<html>
<head>
    <title>Ledger UTS</title>
</head>
<body>
<table style="width: 95%;font-size: 11px;" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" rowspan="4" ><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/mafatih.jpg"/></td>
        <td align="left" colspan="2"style="text-transform:uppercase"><b><?php echo $sekolah->row()->nama_sekolah ?></b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>DAFTAR NILAI HASIL BELAJAR</b></td>
    </tr>
    <tr>
        <td align="left" colspan="2"><b>TAHUN PELAJARAN <?php echo $this->session->userdata('th_ajar') ?></b></td>
    </tr>
    
    <tr>
        <td align="left" colspan="2" >&nbsp;</td>
    </tr>
    <tr>
        <td style="width:14%;font-size: 11px;">Mata Pelajaran<br /></td>
        <td style="width:1%;font-size: 11px;">:<br /></td>
        <td style="width:89%;font-size: 11px;"><?php echo $mp->row()->nm_mp; ?><br /></td>
    </tr>
    <tr>
        <td style="font-size: 11px;">Kelas<br /><br /></td>
        <td style="font-size: 11px;">:<br /><br /></td>
        <td style="font-size: 11px;"><?php echo str_replace('+',' ',$this->uri->segment(3)); ?><br /><br /></td>
    </tr>
</table>
<table style=" border-collapse:collapse; size: landscape; font-size: 11px; " align="center" border="1" align="center%" width="100%" cellpadding="0">
    <tr  style="background: #E1E1E1;" >
		<th rowspan="2" width="2%">NO</th>
		<th rowspan="2" width="8%">NO.INDUK</th>
		<th rowspan="2" width="18%">NAMA </th>
		<th rowspan="2" width="8%">NA UH<BR/>30%</th>
		<th rowspan="2" width="8%">NA TUGAS<BR/>30%</th>
		<th rowspan="2" width="8%">NA UTS<BR/>40%</th>
		<th>NA R1</th>
		<th rowspan="2" width="8%">NA UH<BR/>30%</th>
		<th rowspan="2" width="8%">NA TUGAS<BR/>30%</th>
		<th rowspan="2" width="8%">NA UAS<BR/>40%</th>
		<th>NA R2</th>
		<th rowspan="2" width="8%">NR FINAL<BR/>R1 + R2 / 2</th>
	</tr>
	<tr  style="background: #E1E1E1;" >
		<th width="8%" style="font-size:12px ;">KKM=<?php $a=''; if($kkm->num_rows()>0){ $a = ($kkm->row()->skbm == '' || $kkm->row()->skbm == '0') ? '' : $kkm->row()->skbm; echo $a;}?></th>
	    <th width="8%" style="font-size:12px ;">KKM=<?php $a=''; if($kkm->num_rows()>0){ $a = ($kkm->row()->skbm == '' || $kkm->row()->skbm == '0') ? '' : $kkm->row()->skbm; echo $a;}?></th>
	</tr> 
    <?php 
            $i  = 1;
            if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') { 
            foreach($nilai->result() as $ntgh)
                {
                    $data['nilai'][$seq] = array();
                    $data['nilai'][$seq]['nis']   = $ntgh->nis;
                    $data['nilai'][$seq]['nm']    = $ntgh->nama_lengkap;   
                    $data['nilai'][$seq]['tgh']   = array();
                    
                    $UHT1    = $ntgh->UHT1;  
                    $UHT2    = $ntgh->UHT2;
                    $UHT3    = $ntgh->UHT3;

                    $jmluht = $UHT1 + $UHT2 + $UHT3;
                    $h = ($UHT1 == '0' || $UHT1 == '' ) ? '0' : 1;
                    $l = ($UHT2 == '0' || $UHT2 == '' ) ? '0' : 1;
                    $j = ($UHT3 == '0' || $UHT3 == '' ) ? '0' : 1;
                    $k = $h + $l + $j;
                    //$UHT    = round(($k==0) ? 0 : $jmluht/$k);
			  $UHT    = ($k==0) ? 0 : $jmluht/$k;

                    ///Nilai Praktek
                    $UHP1    = $ntgh->UHP1;
                    $UHP2    = $ntgh->UHP2;
                    $UHP3    = $ntgh->UHP3;

                    $jmluhp = $UHP1 + $UHP2 + $UHP3;
                    $hi = ($UHP1 == '0' || $UHP1 == '' ) ? '0' : 1;
                    $li = ($UHP2 == '0' || $UHP2 == '' ) ? '0' : 1;
                    $ji = ($UHP3 == '0' || $UHP3 == '' ) ? '0' : 1;
                    $ki = $hi + $li + $ji;
                    //$UHP    = round(($ki==0) ? 0 : $jmluhp/$ki);
			  $UHP    = ($ki==0) ? 0 : $jmluhp/$ki;

                    $his = ($UHT == '0' || $UHT == '' ) ? '0' : 1;
                    $lis = ($UHP == '0' || $UHP == '' ) ? '0' : 1;
                    $kis = $his + $lis;
                    $UH   = ($kis==0) ? 0 : (round(($UHT + $UHP) / $kis));   

                    $data['nilai'][$seq]['tgh']['UH'] =  round($UH);//round($UH);
                                
                    //Nilai TUGAS
                    $TGS1    = $ntgh->TGS1;
                    $TGS2    = $ntgh->TGS2;
                    $TGS3    = $ntgh->TGS3;
                    $jmltgs = $TGS1 + $TGS2 + $TGS3;
                    $ho = ($TGS1 == '0' || $TGS1 == '' ) ? '0' : 1;
                    $lo = ($TGS2 == '0' || $TGS2 == '' ) ? '0' : 1;
                    $jo = ($TGS3 == '0' || $TGS3 == '' ) ? '0' : 1;
                    $ko = $ho + $lo + $jo;
                    //$TGS    = round(($ko==0) ? 0 : $jmltgs/$ko);
			  $TGS    = ($ko==0) ? 0 : $jmltgs/$ko;

                    $data['nilai'][$seq]['tgh']['TGS']  = round($TGS); //round($TGS); 
                                
                    //Nilai UTS
                    $UTST    = $ntgh->UTST;
                    $UTSP    = $ntgh->UTSP;       
                    $jmluts = $UTST + $UTSP;
                    $ha = ($UTST == '0' || $UTST == '' ) ? '0' : 1;
                    $la = ($UTSP == '0' || $UTSP == '' ) ? '0' : 1;
                    $ka = $ha + $la;
                    //$UTS    = round(($ka==0) ? 0 : $jmluts/$ka);  
			  $UTS    = ($ka==0) ? 0 : $jmluts/$ka;  

                    $data['nilai'][$seq]['tgh']['UTS'] = round($UTS);//round($UTS);

                    $RUTS = ($UH*0.3) + ($TGS*0.3) + ($UTS*0.4);
                    $data['nilai'][$seq]['tgh']['RUTS'] = round($RUTS);//round($RUTS);
                    
                    
                    //----------------- NILAI SETELAH MID-------------------------------------
                    $UHTA1    = $ntgh->UHTA1;  
                    $UHTA2    = $ntgh->UHTA2;
                    $UHTA3    = $ntgh->UHTA3;

                    $jmluht = $UHTA1 + $UHTA2 + $UHTA3;
                    $h = ($UHTA1 == '0' || $UHTA1 == '' ) ? '0' : 1;
                    $l = ($UHTA2 == '0' || $UHTA2 == '' ) ? '0' : 1;
                    $j = ($UHTA3 == '0' || $UHTA3 == '' ) ? '0' : 1;
                    $k = $h + $l + $j;
                    //$UHTA    = round(($k==0) ? 0 : $jmluht/$k);
			  $UHTA    = ($k==0) ? 0 : $jmluht/$k;

                    ///Nilai Praktek
                    $UHPA1    = $ntgh->UHPA1;
                    $UHPA2    = $ntgh->UHPA2;
                    $UHPA3    = $ntgh->UHPA3;

                    $jmluhp = $UHPA1 + $UHPA2 + $UHPA3;
                    $hi = ($UHPA1 == '0' || $UHPA1 == '' ) ? '0' : 1;
                    $li = ($UHPA2 == '0' || $UHPA2 == '' ) ? '0' : 1;
                    $ji = ($UHPA3 == '0' || $UHPA3 == '' ) ? '0' : 1;
                    $ki = $hi + $li + $ji;
                    //$UHPA    = round(($ki==0) ? 0 : $jmluhp/$ki);
			  $UHPA    = ($ki==0) ? 0 : $jmluhp/$ki;

                    $his = ($UHTA == '0' || $UHTA == '' ) ? '0' : 1;
                    $lis = ($UHPA == '0' || $UHPA == '' ) ? '0' : 1;
                    $kis = $his + $lis;
                    $UHA   = ($kis==0) ? 0 : (round(($UHTA + $UHPA) / $kis));   

                    $data['nilai'][$seq]['tgh']['UHA'] =  round($UHA);//round($UHA);
                                
                    //Nilai TUGAS
                    $TGSA1    = $ntgh->TGSA1;
                    $TGSA2    = $ntgh->TGSA2;
                    $TGSA3    = $ntgh->TGSA3;
                    $jmltgs = $TGSA1 + $TGSA2 + $TGSA3;
                    $ho = ($TGSA1 == '0' || $TGSA1 == '' ) ? '0' : 1;
                    $lo = ($TGSA2 == '0' || $TGSA2 == '' ) ? '0' : 1;
                    $jo = ($TGSA3 == '0' || $TGSA3 == '' ) ? '0' : 1;
                    $ko = $ho + $lo + $jo;
                    //$TGSA    = round(($ko==0) ? 0 : $jmltgs/$ko);
                    $TGSA    = ($ko==0) ? 0 : $jmltgs/$ko;

                    $data['nilai'][$seq]['tgh']['TGSA']  = round($TGSA); //round($TGSA); 
                                
                    //Nilai UTS
                    $UTSTA    = $ntgh->UTSTA;
                    $UTSPA    = $ntgh->UTSPA;              
                    $jmluts = $UTSTA + $UTSPA;
                    $ha = ($UTSTA == '0' || $UTSTA == '' ) ? '0' : 1;
                    $la = ($UTSPA == '0' || $UTSPA == '' ) ? '0' : 1;
                    $ka = $ha + $la;
                    $UTSA    = ($ka==0) ? 0 : $jmluts/$ka;

                    $data['nilai'][$seq]['tgh']['UTSA'] = round($UTSA); //round($UTSA); 

                    $RUAS = ($UHA*0.3) + ($TGSA*0.3) + ($UTSA*0.4);
                    $data['nilai'][$seq]['tgh']['RUAS'] = round($RUAS);//round($RUAS);
                    
                    $data['nilai'][$seq]['tgh']['RFINAL'] = round(($RUTS+$RUAS)/2);
                    //================= NILAI SETELAH MID =====================================
                    
                    $seq++;       
                }
			
                $ratakelas= (($i-1)==0) ? 0 : array_sum($sum)/($i-1);
            
    ?>
    <tr>
        <td>&nbsp;</td>
        <td colspan="2"><b>&nbsp;&nbsp;Rata-rata Kelas</b></td>
        <td colspan="8"></td>
        <td align="center"><b style="color: blue;"><?php echo round($ratakelas); ?></b></td>
    </tr>
            <?php } ?>
</table>
<br />
<table style="font-size: 11px;" align="center" border="0" width="100%" >
<tr>
    <td width="2%">&nbsp;</td>
    <td width="78%">
    <table style="font-size: 11px;">
        <tr>
            <td align="left">Mengetahui,</td>
        </tr>
        <tr>
        	<td align="left"><b>Kelapa Sekolah</b><br /><br /></td>
        </tr>
        <tr>
        	<td align="left"><u><?php echo $kepsek->row()->nama_lengkap;?></u></td>
        </tr>
        <tr>
        	<td align="left">NIP. <?php echo $kepsek->row()->nip; ?></td>
        </tr>
    </table>
    </td>
    <td width="20%">
    <table style="font-size: 11px;">
        <tr>
            <td align="left"><?php echo $sekolah->row()->kabupaten;?>, <?php $arraytgl = $this->app_model->tgl(); $pilihtgl = date('d'); $pilihbln = date('m');;$pilihth = date('y'); echo $pilihtgl ;echo ' - '; echo $pilihbln; echo ' - ';echo '20'; echo $pilihth;?></td>
        </tr>
        <tr>
        	<td align="left"><b>Wali Kelas</b><br /><br /></td>
        </tr>
        <tr>
        	<td align="left"><u><?php $h= ($walikelas->num_rows()>0) ? $walikelas->row()->nama_lengkap : ''; echo $h ?></u></td>
        </tr>
        <tr>
        	<td align="left">NIP.<?php $nip= ($walikelas->num_rows()>0) ? $walikelas->row()->nip : ''; echo $nip ?></td>
        </tr>
    </table>
    </td>
</tr>
</table>
<!--<div class="sembunyi">
    <a href="<?php //echo base_url().'index.php/export/export_to_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>">Inport Pdf</a> |
</div>-->
</body>
</html>