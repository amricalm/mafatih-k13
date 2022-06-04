<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>LEDGER <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?></h1>

    <form action="<?php echo base_url().'index.php/hasilbelajar/ledger' ?>" method="POST" id="frmhasilbelajar">
    <!--atur pd (edusis_system/helpers/form_helper.php)function form_hidden, dg menambahkan (id="'.$name.'")-->
    <?php echo form_hidden('myurl',site_url('hasilbelajar')) ?>
    <!--table filter-->
        <table border="0" width="100%">
            <tr>
                <td width="100px">Pilih Kelas</td>
                <td width="300px">
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
                <td align="right" width="">
                <?php if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') { ?>
                <a href="<?php echo base_url().'index.php/export/export_to_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
                <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Mata pelajaran</td>
                <td>
                    <?php
                        $arraymp = array('');
                        foreach($kdmp->result () as $rowmp )
                        {
                            $arraymp[$rowmp->kd_mp]=$rowmp->nm_mp;
                        }
                        echo form_dropdown('kd_mp',$arraymp,$pilihmp,' id="mp" ');
                    ?>
                </td>
                <td rowspan="2">
                    <a href="javascript:filter()" class="small button blue">Filter</a>
                </td>
            </tr>
        </table>
    <!--end table filter-->
    <!--table daftar hasil study-->
    <div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
        <table class="tables" align="center" width="100%" cellpadding="0">
        	<?php if($this->session->userdata('sub_pnl')=='UTS') { ?>
            <tr>
                <th rowspan="3" width="2%">NO</th>
        		<th rowspan="3" width="3%">NO.INDUK</th>
        		<th rowspan="3" width="12%">NAMA SISWA</th>
                <th colspan="17">PENILAIAN</th>
            </tr>
            <tr>
                <th colspan="2" width="2%">PENGAMATAN</th>
                <th rowspan="2" width="2%">Rata<br />Rata</th>
                <th rowspan="2" width="2%">20%</th>
                <th colspan="2" width="2%">TUGAS HARIAN</th>
                <th rowspan="2" width="2%">Rata<br />Rata</th>
                <th rowspan="2" width="2%">20%</th>
                <th colspan="2" width="2%">ULANGAN HARIAN</th>
                <th rowspan="2" width="2%">Rata<br />Rata</th>
                <th rowspan="2" width="2%">60%</th>
                <th rowspan="2" width="2%">Rata-Rata<br />(PMT,TGS,UH)</th>
                <th rowspan="2" width="2%">60%</th>
                <th rowspan="2" width="2%">UTS</th>
                <th rowspan="2" width="2%">40%</th>
                <th>Nilai Akhir</th>
            </tr>
            <tr>
                <th width="2%">1</th>
                <th width="2%">2</th>
                <th width="2%">1</th>
                <th width="2%">2</th>
                <th width="2%">1</th>
                <th width="2%">2</th>
                <th width="2%">KKM=<?php $a=''; if($kkm->num_rows()>0){ $a = ($kkm->row()->skbm == '' || $kkm->row()->skbm == '0') ? '' : $kkm->row()->skbm; echo $a;}?></th>
            </tr>
            <?php }else{ ?>
            <tr>
                <th rowspan="3" width="2%">NO</th>
        		<th rowspan="3" width="3%">NO.INDUK</th>
        		<th rowspan="3" width="15%">NAMA SISWA</th>
                <th colspan="31">PENILAIAN</th>
            </tr>
            <tr>
                <th colspan="4" width="2%">PENGAMATAN</th>
                <th rowspan="2" width="2%">Rata<br />Rata</th>
                <th rowspan="2" width="2%">20%</th>
                <th colspan="4" width="2%">TUGAS HARIAN</th>
                <th rowspan="2" width="2%">Rata<br />Rata</th>
                <th rowspan="2" width="2%">20%</th>
                <th colspan="4" width="2%">ULANGAN HARIAN</th>
                <th rowspan="2" width="2%">Rata<br />Rata</th>
                <th rowspan="2" width="2%">60%</th>
                <th rowspan="2" width="2%">Rata-Rata<br />(PMT,TGS,UH)</th>
                <th rowspan="2" width="2%">60%</th>
                <th rowspan="2" width="2%">UTS</th>
                <th rowspan="2" width="2%">20%</th>
                <th rowspan="2" width="2%">UAS</th>
                <th rowspan="2" width="2%">20%</th>
                <th>Nilai Akhir</th>
            </tr>
            <tr>
                <th width="2%">1</th>
                <th width="2%">2</th>
                <th width="2%">3</th>
                <th width="2%">4</th>
                <th width="2%">1</th>
                <th width="2%">2</th>
                <th width="2%">3</th>
                <th width="2%">4</th>
                <th width="2%">1</th>
                <th width="2%">2</th>
                <th width="2%">3</th>
                <th width="2%">4</th>
                <th width="2%">KKM=<?php $a=''; if($kkm->num_rows()>0){ $a = ($kkm->row()->skbm == '' || $kkm->row()->skbm == '0') ? '' : $kkm->row()->skbm; echo $a;}?></th>
            </tr>
            <?php } ?>
            <?php
            $a  ='';
                if($kkm->num_rows()>0)
                {
                    $a = ($kkm->row()->skbm == '' || $kkm->row()->skbm == '0') ? '' : $kkm->row()->skbm;
                }
            ?>
            <?php
            $i  = 1;

            if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') {
            foreach($hasilbelajar->result() as $row)
            {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$i.'</td>';
                echo '<td align="left">'.$row->nis.'</td>';
                echo '<td>'.$row->nama_lengkap.'</td>';

             if($this->session->userdata('sub_pnl')=='UTS')
                {
                    //======================= PENGAMATAN ===============================
                    $PMTT1    = $row->PMTT1;
                    $PMTP1    = $row->PMTP1;
                    $PMT1     = $PMTT1 + $PMTP1;
                    $lt1 = ($PMTT1 == '0' || $PMTT1 == '' ) ? '0' : 1;
                    $lt2 = ($PMTP1 == '0' || $PMTP1 == '' ) ? '0' : 1;
                    $lt3 = $lt1 + $lt2;
                    $RTPMT1    = round(($lt3==0) ? 0 : $PMT1/$lt3);
                    echo '<td align="center" style="font-size:11px ;">'.$RTPMT1.'</td>';

                    $PMTT2    = $row->PMTT2;
                    $PMTP2    = $row->PMTP2;
                    $PMT2     = $PMTT2 + $PMTP2;
                    $lt4 = ($PMTT2 == '0' || $PMTT2 == '' ) ? '0' : 1;
                    $lt5 = ($PMTP2 == '0' || $PMTP2 == '' ) ? '0' : 1;
                    $lt6 = $lt4 + $lt5;
                    $RTPMT2    = round(($lt6==0) ? 0 : $PMT2/$lt6);
                    echo '<td align="center" style="font-size:11px ;">'.$RTPMT2.'</td>';

                    //Rata-rata Pengamatan
                    $jmlpmt = $RTPMT1 + $RTPMT2;
                    $pm1 = ($RTPMT1 == '0' || $RTPMT1 == '' ) ? '0' : 1;
                    $pm2 = ($RTPMT2 == '0' || $RTPMT2 == '' ) ? '0' : 1;
                    $pm3 = $pm1 + $pm2;
                    $RTPMT    = round(($pm3==0) ? 0 : $jmlpmt/$pm3);
                    echo '<td align="center" style="font-size:11px ;"><b>'.$RTPMT.'</b></td>';
                    $BBT1   = $RTPMT * 0.20;
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$BBT1.'</font></td>';
                    //================= END PENGAMATAN ===================================

                    //===================== TUGAS HARIAN ==========================
                    $TGST1    = $row->TGS1;
                    $TGSP1    = $row->TGSP1;
                    $TGS1     = $TGST1 + $TGSP1;
                    $e = ($TGST1 == '0' || $TGST1 == '' ) ? '0' : 1;
                    $f = ($TGSP1 == '0' || $TGSP1 == '' ) ? '0' : 1;
                    $g = $e + $f;
                    $RTTGS1    = round(($g==0) ? 0 : $TGS1/$g);
                    echo '<td align="center" style="font-size:11px ;">'.$RTTGS1.'</td>';

                    $TGST2    = $row->TGS2;
                    $TGSP2    = $row->TGSP2;
                    $TGS2     = $TGST2 + $TGSP2;
                    $h = ($TGST2 == '0' || $TGST2 == '' ) ? '0' : 1;
                    $is = ($TGSP2 == '0' || $TGSP2 == '' ) ? '0' : 1;
                    $j = $h + $is;
                    $RTTGS2    = round(($j==0) ? 0 : $TGS2/$j);
                    echo '<td align="center" style="font-size:11px ;">'.$RTTGS2.'</td>';

                    //Rata-rata Tugas Harian
                    $jmltgs = $RTTGS1 + $RTTGS2;
                    $tg1 = ($RTTGS1 == '0' || $RTTGS1 == '' ) ? '0' : 1;
                    $tg2 = ($RTTGS2 == '0' || $RTTGS2 == '' ) ? '0' : 1;
                    $tg3 = $tg1 + $tg2;
                    $RTTGS    = round(($tg3==0) ? 0 : $jmltgs/$tg3);
                    echo '<td align="center" style="font-size:11px ;"><b>'.$RTTGS.'</b></td>';
                    $BBT2   = $RTTGS * 0.20;
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$BBT2.'</font></td>';
                    //======================= END TUGAS HARIAN =============================

                    //======================= ULANGAN HARIAN ===============================
                    $UHT1    = $row->UHT1;
                    $UHP1    = $row->UHP1;
                    $UH1     = $UHT1 + $UHP1;
                    $eh = ($UHT1 == '0' || $UHT1 == '' ) ? '0' : 1;
                    $fh = ($UHP1 == '0' || $UHP1 == '' ) ? '0' : 1;
                    $gh = $eh + $fh;
                    $RTUH1    = round(($gh==0) ? 0 : $UH1/$gh);
                    echo '<td align="center" style="font-size:11px ;">'.$RTUH1.'</td>';

                    $UHT2    = $row->UHT2;
                    $UHP2    = $row->UHP2;
                    $UH2     = $UHT2 + $UHP2;
                    $hh = ($UHT2 == '0' || $UHT2 == '' ) ? '0' : 1;
                    $ih = ($UHP2 == '0' || $UHP2 == '' ) ? '0' : 1;
                    $jh = $hh + $ih;
                    $RTUH2    = round(($jh==0) ? 0 : $UH2/$jh);
                    echo '<td align="center" style="font-size:11px ;">'.$RTUH2.'</td>';

                    //Rata-rata Ulangan Harian
                    $jmluh = $RTUH1 + $RTUH2;
                    $uhh1 = ($RTUH1 == '0' || $RTUH1 == '' ) ? '0' : 1;
                    $uhh2 = ($RTUH2 == '0' || $RTUH2 == '' ) ? '0' : 1;
                    $uhh3 = $uhh1 + $uhh2;
                    $RTUH    = round(($uhh3==0) ? 0 : $jmluh/$uhh3);
                    echo '<td align="center" style="font-size:11px ;"><b>'.$RTUH.'</b></td>';
                    $BBT3   = $RTUH * 0.60;
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$BBT3.'</font></td>';
                    //================= END ULANGAN HARIAN ===================================

                    //================= BOBOT PEGAMATAN, TUGAS DAN ULANGAN ===================
                    $jmlbbt4 = $BBT1 + $BBT2 + $BBT3;
                    echo '<td align="center" style="font-size:11px ;"><b>'.$jmlbbt4.'</b></td>';
                    $BBT4   = $jmlbbt4 * 0.60;
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$BBT4.'</font></td>';
                    //================= END BOBOT PENGAMATAN, TUGAS DAN ULANGAN ==============

                    //================= NILAI UTS ============================================
                    $UTST   = $row->UTST;
                    $UTSP   = $row->UTSP;
                    $jmluts = $UTST + $UTSP;

                    $hl = ($UTST == '0' || $UTST == '' ) ? '0' : 1;
                    $il = ($UTSP == '0' || $UTSP == '' ) ? '0' : 1;
                    $jl = $hl + $il;
                    $RT2    = round(($jl==0) ? 0 : $jmluts/$jl);
                    echo '<td align="center" style="font-size:11px ;"><b>'.$RT2.'</b></td>';
                    $BBT5   = $RT2 * 0.40;
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$BBT5.'</font></td>';
                    //================= END NILAI UTS ============================================

                    //================= NILAI RAPORT UTS ========================================
                    $RPT = round($BBT4 + $BBT5);
                    echo '<td align="center" style="font-size:11px ;"><b>';
                    echo ($RPT < $a) ? '<font color="red">' : '<font color="black">';
                    echo $RPT.'</font></b></td>';
                    //================= END NILAI RAPORT UTS ====================================
                } else {
                    //======================= PENGAMATAN ===============================
                    $PMTT1    = $row->PMTT1;
                    $PMTP1    = $row->PMTP1;
                    $PMT1     = $PMTT1 + $PMTP1;
                    $lt1 = ($PMTT1 == '0' || $PMTT1 == '' ) ? '0' : 1;
                    $lt2 = ($PMTP1 == '0' || $PMTP1 == '' ) ? '0' : 1;
                    $lt3 = $lt1 + $lt2;
                    $RTPMT1    = round(($lt3==0) ? 0 : $PMT1/$lt3);
                    echo '<td align="center" style="font-size:11px ;">'.$RTPMT1.'</td>';

                    $PMTT2    = $row->PMTT2;
                    $PMTP2    = $row->PMTP2;
                    $PMT2     = $PMTT2 + $PMTP2;
                    $lt4 = ($PMTT2 == '0' || $PMTT2 == '' ) ? '0' : 1;
                    $lt5 = ($PMTP2 == '0' || $PMTP2 == '' ) ? '0' : 1;
                    $lt6 = $lt4 + $lt5;
                    $RTPMT2    = round(($lt6==0) ? 0 : $PMT2/$lt6);
                    echo '<td align="center" style="font-size:11px ;">'.$RTPMT2.'</td>';

                    $PMTTUAS1    = $row->PMTTUAS1;
                    $PMTPUAS1    = $row->PMTPUAS1;
                    $PMTUAS1     = $PMTTUAS1 + $PMTPUAS1;
                    $ltuas1 = ($PMTTUAS1 == '0' || $PMTTUAS1 == '' ) ? '0' : 1;
                    $ltuas2 = ($PMTPUAS1 == '0' || $PMTPUAS1 == '' ) ? '0' : 1;
                    $ltuas3 = $ltuas1 + $ltuas2;
                    $RTPMTUAS1    = round(($ltuas3==0) ? 0 : $PMTUAS1/$ltuas3);
                    echo '<td align="center" style="font-size:11px ;">'.$RTPMTUAS1.'</td>';

                    $PMTTUAS2    = $row->PMTTUAS2;
                    $PMTPUAS2    = $row->PMTPUAS2;
                    $PMTUAAS2     = $PMTTUAS2 + $PMTPUAS2;
                    $ltuas4 = ($PMTTUAS2 == '0' || $PMTTUAS2 == '' ) ? '0' : 1;
                    $ltuas5 = ($PMTPUAS2 == '0' || $PMTPUAS2 == '' ) ? '0' : 1;
                    $ltuas6 = $ltuas4 + $ltuas5;
                    $RTPMTUAS2    = round(($ltuas6==0) ? 0 : $PMTUAAS2/$ltuas6);
                    echo '<td align="center" style="font-size:11px ;">'.$RTPMTUAS2.'</td>';

                    //Rata-rata Pengamatan UAS
                    $jmlpmt = $RTPMT1 + $RTPMT2 + $RTPMTUAS1 + $RTPMTUAS2;
                    $pm1 = ($RTPMT1 == '0' || $RTPMT1 == '' ) ? '0' : 1;
                    $pm2 = ($RTPMT2 == '0' || $RTPMT2 == '' ) ? '0' : 1;
                    $pm3 = ($RTPMTUAS1 == '0' || $RTPMTUAS1 == '' ) ? '0' : 1;
                    $pm4 = ($RTPMTUAS2 == '0' || $RTPMTUAS2 == '' ) ? '0' : 1;
                    $pm5 = $pm1 + $pm2 + $pm3 + $pm4;
                    $RTPMT    = round(($pm5==0) ? 0 : $jmlpmt/$pm5);
                    echo '<td align="center" style="font-size:11px ;"><b>'.$RTPMT.'</b></td>';
                    $BBT1   = $RTPMT * 0.20;
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$BBT1.'</font></td>';
                    //================= END PENGAMATAN ===================================

                    //===================== TUGAS HARIAN ==========================
                    $TGST1    = $row->TGS1;
                    $TGSP1    = $row->TGSP1;
                    $TGS1     = $TGST1 + $TGSP1;
                    $e = ($TGST1 == '0' || $TGST1 == '' ) ? '0' : 1;
                    $f = ($TGSP1 == '0' || $TGSP1 == '' ) ? '0' : 1;
                    $g = $e + $f;
                    $RTTGS1    = round(($g==0) ? 0 : $TGS1/$g);
                    echo '<td align="center" style="font-size:11px ;">'.$RTTGS1.'</td>';

                    $TGST2    = $row->TGS2;
                    $TGSP2    = $row->TGSP2;
                    $TGS2     = $TGST2 + $TGSP2;
                    $h = ($TGST2 == '0' || $TGST2 == '' ) ? '0' : 1;
                    $is = ($TGSP2 == '0' || $TGSP2 == '' ) ? '0' : 1;
                    $j = $h + $is;
                    $RTTGS2    = round(($j==0) ? 0 : $TGS2/$j);
                    echo '<td align="center" style="font-size:11px ;">'.$RTTGS2.'</td>';

                    $TGSTUAS1    = $row->TGSUAS1;
                    $TGSPUAS1    = $row->TGSPUAS1;
                    $TGSUAS1     = $TGSTUAS1 + $TGSPUAS1;
                    $ei = ($TGSTUAS1 == '0' || $TGSTUAS1 == '' ) ? '0' : 1;
                    $fi = ($TGSPUAS1 == '0' || $TGSPUAS1 == '' ) ? '0' : 1;
                    $gi = $ei + $fi;
                    $RTTGSUAS1    = round(($gi==0) ? 0 : $TGSUAS1/$gi);
                    echo '<td align="center" style="font-size:11px ;">'.$RTTGSUAS1.'</td>';

                    $TGSTUAS2    = $row->TGSUAS2;
                    $TGSPUAS2    = $row->TGSPUAS2;
                    $TGSUAS2     = $TGSTUAS2 + $TGSPUAS2;
                    $hi = ($TGSTUAS2 == '0' || $TGSTUAS2 == '' ) ? '0' : 1;
                    $ii = ($TGSPUAS2 == '0' || $TGSPUAS2 == '' ) ? '0' : 1;
                    $ji = $hi + $ii;
                    $RTTGSUAS2    = round(($ji==0) ? 0 : $TGSUAS2/$ji);
                    echo '<td align="center" style="font-size:11px ;">'.$RTTGSUAS2.'</td>';

                    //Rata-rata Tugas Harian UAS
                    $jmltgs = $RTTGS1 + $RTTGS2 + $RTTGSUAS1 + $RTTGSUAS2;
                    $tg1 = ($RTTGS1 == '0' || $RTTGS1 == '' ) ? '0' : 1;
                    $tg2 = ($RTTGS2 == '0' || $RTTGS2 == '' ) ? '0' : 1;
                    $tg3 = ($RTTGSUAS1 == '0' || $RTTGSUAS1 == '' ) ? '0' : 1;
                    $tg4 = ($RTTGSUAS2 == '0' || $RTTGSUAS2 == '' ) ? '0' : 1;
                    $tg5 = $tg1 + $tg2 + $tg3 + $tg4;
                    $RTTGS    = round(($tg5==0) ? 0 : $jmltgs/$tg5);
                    echo '<td align="center" style="font-size:11px ;"><b>'.$RTTGS.'</b></td>';
                    $BBT2   = $RTTGS * 0.20;
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$BBT2.'</font></td>';
                    //======================= END TUGAS HARIAN =============================

                    //======================= ULANGAN HARIAN ===============================
                    $UHT1    = $row->UHT1;
                    $UHP1    = $row->UHP1;
                    $UH1     = $UHT1 + $UHP1;
                    $eh = ($UHT1 == '0' || $UHT1 == '' ) ? '0' : 1;
                    $fh = ($UHP1 == '0' || $UHP1 == '' ) ? '0' : 1;
                    $gh = $eh + $fh;
                    $RTUH1    = round(($gh==0) ? 0 : $UH1/$gh);
                    echo '<td align="center" style="font-size:11px ;">'.$RTUH1.'</td>';

                    $UHT2    = $row->UHT2;
                    $UHP2    = $row->UHP2;
                    $UH2     = $UHT2 + $UHP2;
                    $hh = ($UHT2 == '0' || $UHT2 == '' ) ? '0' : 1;
                    $ih = ($UHP2 == '0' || $UHP2 == '' ) ? '0' : 1;
                    $jh = $hh + $ih;
                    $RTUH2    = round(($jh==0) ? 0 : $UH2/$jh);
                    echo '<td align="center" style="font-size:11px ;">'.$RTUH2.'</td>';

                    $UHTUAS1    = $row->UHTUAS1;
                    $UHPUAS1    = $row->UHPUAS1;
                    $UHUAS1     = $UHTUAS1 + $UHPUAS1;
                    $ej = ($UHTUAS1 == '0' || $UHTUAS1 == '' ) ? '0' : 1;
                    $fj = ($UHPUAS1 == '0' || $UHPUAS1 == '' ) ? '0' : 1;
                    $gj = $ej + $fj;
                    $RTUHUAS1    = round(($gj==0) ? 0 : $UHUAS1/$gj);
                    echo '<td align="center" style="font-size:11px ;">'.$RTUHUAS1.'</td>';

                    $UHTUAS2    = $row->UHTUAS2;
                    $UHPUAS2    = $row->UHPUAS2;
                    $UHUAS2     = $UHTUAS2 + $UHPUAS2;
                    $hj = ($UHTUAS2 == '0' || $UHTUAS2 == '' ) ? '0' : 1;
                    $ij = ($UHPUAS2 == '0' || $UHPUAS2 == '' ) ? '0' : 1;
                    $jj = $hj + $ij;
                    $RTUHUAS2    = round(($jj==0) ? 0 : $UHUAS2/$jj);
                    echo '<td align="center" style="font-size:11px ;">'.$RTUHUAS2.'</td>';

                    //Rata-rata Ulangan Harian UAS
                    $jmluh = $RTUH1 + $RTUH2 + $RTUHUAS1 + $RTUHUAS2;
                    $uhh1 = ($RTUH1 == '0' || $RTUH1 == '' ) ? '0' : 1;
                    $uhh2 = ($RTUH2 == '0' || $RTUH2 == '' ) ? '0' : 1;
                    $uhh3 = ($RTUHUAS1 == '0' || $RTUHUAS1 == '' ) ? '0' : 1;
                    $uhh4 = ($RTUHUAS2 == '0' || $RTUHUAS2 == '' ) ? '0' : 1;
                    $uhh5 = $uhh1 + $uhh2 + $uhh3 + $uhh4;
                    $RTUH    = round(($uhh5==0) ? 0 : $jmluh/$uhh5);
                    echo '<td align="center" style="font-size:11px ;"><b>'.$RTUH.'</b></td>';
                    $BBT3   = $RTUH * 0.60;
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$BBT3.'</font></td>';
                    //================= END ULANGAN HARIAN ===================================

                    //================= BOBOT PEGAMATAN, TUGAS DAN ULANGAN ===================
                    $jmlbbt4 = $BBT1 + $BBT2 + $BBT3;
                    echo '<td align="center" style="font-size:11px ;"><b>'.$jmlbbt4.'</b></td>';
                    $BBT4   = $jmlbbt4 * 0.60;
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$BBT4.'</font></td>';
                    //================= END BOBOT PENGAMATAN, TUGAS DAN ULANGAN ==============

                    //================= NILAI UTS ============================================
                    $UTST   = $row->UTST;
                    $UTSP   = $row->UTSP;
                    $jmluts = $UTST + $UTSP;

                    $hl = ($UTST == '0' || $UTST == '' ) ? '0' : 1;
                    $il = ($UTSP == '0' || $UTSP == '' ) ? '0' : 1;
                    $jl = $hl + $il;
                    $RT2    = round(($jl==0) ? 0 : $jmluts/$jl);
                    echo '<td align="center" style="font-size:11px ;"><b>'.$RT2.'</b></td>';
                    $BBT5   = $RT2 * 0.20;
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$BBT5.'</font></td>';
                    //================= END NILAI UTS ============================================

                    //================= NILAI UAS ============================================
                    $UAST   = $row->UAST;
                    $UASP   = $row->UASP;
                    $jmluas = $UAST + $UASP;

                    $kl = ($UAST == '0' || $UAST == '' ) ? '0' : 1;
                    $ll = ($UASP == '0' || $UASP == '' ) ? '0' : 1;
                    $ml = $kl + $ll;
                    $RT3    = round(($ml==0) ? 0 : $jmluas/$ml);
                    echo '<td align="center" style="font-size:11px ;"><b>'.$RT3.'</b></td>';
                    $BBT6   = $RT3 * 0.20;
                    echo '<td align="center" style="font-size:11px ;"><font color="blue">'.$BBT6.'</font></td>';
                    //================= END NILAI UAS ============================================

                    //================= NILAI RAPORT UAS ========================================
                    $RPT = round($BBT4 + $BBT5 + $BBT6);
                    echo '<td align="center" style="font-size:11px ;"><b>';
                    echo ($RPT < $a) ? '<font color="red">' : '<font color="black">';
                    echo $RPT.'</font></b></td>';
                    //================= END NILAI RAPORT UAS ====================================

                }
                    $sum[$i] = $RPT;
                    $i++;
                    echo '</tr>';
            }
                    $ratakelas= (($i-1)==0) ? 0 : array_sum($sum)/($i-1);
            ?>
            <tr>
                 <td>&nbsp;</td>
                <td colspan="2"><b>&nbsp;&nbsp;Rata-rata Kelas</b></td>
                <?php if($this->session->userdata('sub_pnl')=='UTS') { ?>
                    <td colspan="16"></td>
                <?php } else { ?>
                    <td colspan="24"></td>
                <?php } ?>
                <td align="center" style="font-size:11px ;"><b style="color: blue;"><?php echo round($ratakelas,1); ?></b></td>
           </tr>
            <?php } ?>
        </table>
        <!-- end table hsil study -->
    </form>
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
        var mp            = $('#mp').val();
        var myurl         = $('#myurl').val();
        var form_wi       = $('#frmhasilbelajar').attr('action');
        $('#frmhasilbelajar').attr('action',form_wi+'/'+kelas+'/'+mp);
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
