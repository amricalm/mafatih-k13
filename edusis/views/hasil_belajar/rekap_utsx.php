<?php $this->load->view('page_head');?>
<body>
<style type="text/css">
    @import url("<?php echo base_url().'edusis_asset/css/adn.css'; ?>");
</style>
<script type="text/javascript">
$(document).ready(function(){
        $("a.namalengkap").easyTooltip();
    });
</script>
<div id="main">
    <?php $this->load->view('page_menu'); $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS';?>
		<!-- Content (Right Column) -->
		<div id="content" class="box">
	<h1>REKAP NILAI <?php echo $q ?></a></h1>
    <?php echo form_open('hasilbelajar/rekap_nilai/',array('name'=>'frmdaftar','id'=>'frmdaftar','onsubmit'=>'return submitbaru()')) ?>
	<table align="center" style="width: 100%;" class="daftar">
        <tr>
        <td width="100px">Pilih Kelas</td>
        <td width="300px">
            <select name="kelas" id="skelas" >
    		<?php
    			echo '<option value="0" class="input-text"></option>';
    			$arraykelas = array();
    			if($kelas->num_rows() !=0)
    			{
    				foreach($kelas->result () as $rowkelas )
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
        <td>
            <input class="input button blue" type="submit" name="filter" value="Filter"/>
        </td>
        <td align="right" width="">
            <?php if($this->uri->segment(3)=='' || $this->uri->segment(3)=='0'){} else { ?>
                <a href="<?php echo base_url().'index.php/export/export_rekap_rapor_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
            <?php } ?>
        </td>  
        </tr>
    </table>
    </form>
<?php if($tampil =='' || $tampil =='0'){} else { ?>
<?php $nama = $this->siswa_model->nama($pilihkelas); if($nama->num_rows()>0){ ?>                          
    <div style="border:2px solid #999999; width:100%;height:350px; overflow-x:scroll;">
    <form action="<?php echo base_url().'index.php/hasilbelajar/simpan_proses'; ?>" method="post">
    <input type="hidden" name="kelas" id="kelas" class="input-short" style=" width: 60px;" value="<?php echo $pilihkelas; ?>"/>
    
    <table style="width:200%;" class="tables" > 
        <tr>
            <th rowspan="2" style="width:1%">NO</th>
            <th rowspan="2" style="width:3%">NO.INDUK</th>
            <th rowspan="2" style="width:15%">NAMA SISWA</th>   
        
            <?php 
                $this->load->helper('adn_text_helper');
                $seq = 1;
                if($this->input->post('filter'))
                {
                    foreach($mp->result() as $row)
                    {
                        echo '<th colspan="4" width="8%"><a href="#" class="namalengkap" title="'.$row->nm_mp.'" style="color:white; text-decoration: none;text-transform:upercase;">'.persingkat($row->kd_mp,10).'</a></th>';
                        $seq++;
                    }
                }
                echo '<th rowspan="2">RATA-RATA</th>';
            ?>
        </tr>
        <tr>
            <?php 
                $this->load->helper('adn_text_helper');
                $seq = 1;
                if($this->input->post('filter'))
                {
                    foreach($mp->result() as $row)
                    {
                        echo '<th width="2%"><a href="#" style="color:white; text-decoration: none;">TGS</a></th>';
                        echo '<th width="2%"><a href="#" style="color:white; text-decoration: none;">UH</a></th>';
                        echo '<th width="2%"><a href="#" style="color:white; text-decoration: none;">'.$q.'</a></th>';
                        echo '<th width="2%"><a href="#" style="color:white; text-decoration: none;">NR</a></th>';
                        $seq++;
                    }
                }
            ?>
        </tr>
            <?php
            $seq = 1;
            if($this->input->post('filter'))
            {
                $nilai      = array();      
                foreach($nama->result() as $row)
                {
                    $bg = ($seq%2==0) ? ' class="bg" ' : '';
                    echo '<tr'.$bg.'>';
                    echo '<td align="center">'.$seq.'</td>';
                    echo '<td align="center">'.$row->nis.'</td>';
                    echo '<td>&nbsp;&nbsp;'.$row->nama_lengkap.'</td>';
                    $j = 0;
                    $jmlnr[$seq]                  = 0;
                    foreach($mp->result() as $rowmp)
                    {
                        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
                        $data['th_ajar']        = $this->session->userdata('th_ajar');
                        $data['p_nl']           = $this->session->userdata('kd_semester');
                        $data['sub_pnl']        = $this->session->userdata('sub_pnl');
                        $data['kelas']          = $this->input->post('kelas');
                        $data['pilihkelas']     = $this->input->post('kelas');
                        $data['kd_mp']          = $rowmp->kd_mp;
                        $data['nis']            = $row->nis;
                        //$var_array              = $this->hasilbelajar_model->Get_Nilai($data);
                        $hasilbelajar           = $this->hasilbelajar_model->nilai($data);
                        echo $this->db->last_query();
                        //die();
                        $TGS                    = 0;
                        $jumlahNaUH             = 0;
                        $jumlahNa               = 0;
                        $jumlahUH               = 0;
                        $NaUH                   = 0;
                        $UTS                    = 0;
                        $NR                     = 0;
                        $jumlahTGS              = 0;
                        $jumlahUTST             = 0;
                        $jumlahUTSP             = 0;
                        $NR1                    = 0;
                        $NR2                    = 0;
                        $NR3                    = 0;
                        //echo strstr($var_array->row()->kd_tagihan,'TGS');
//                        if($var_array->num_rows()>0)
//                        {
//                            foreach($var_array->result() as $rowvar_array)
//                            {
//                                if(strstr($rowvar_array->kd_tagihan,'TGS')!='')
//                                {
//                                    //echo $rowvar_array->kgn.'<br/>';
//                                    $TGS = $jumlahTGS += $rowvar_array->kgn / 3;
//                                    $NR1 = $TGS * 0.3;
//                                }
//                                elseif(strstr($rowvar_array->kd_tagihan,'UHT')!='')
//                                {
//                                    $Na   = $jumlahNa += $rowvar_array->kgn;
//                                    $UH   = $jumlahUH += $rowvar_array->psk;
//                                    $NaUH = ($Na + $UH) / 6;
//                                    $NR2  = $NaUH * 0.3;
//                                }
//                                elseif(strstr($rowvar_array->kd_tagihan,'UTS')!='')
//                                {
//                                    $UTST = $jumlahUTST += $rowvar_array->kgn;
//                                    $UTSP = $jumlahUTSP += $rowvar_array->psk;
//                                    $ab   = ($UTST == '0' || $UTST == '' ) ? '0' : 1;
//                                    $ba   = ($UTSP == '0' || $UTSP == '' ) ? '0' : 1;
//                                    $abc  = $ab + $ba;
//                                    $UTS  = ($abc == 0) ? 0 : ($UTST + $UTSP) / $abc;
//                                    $NR3  = $UTS * 0.4;
//                                }
//                                else{}
//                                $NR   = $NR1 + $NR2 + $NR3;
//                            }
//                        }
                        $i  = 1;
                        foreach($hasilbelajar->result() as $rowhb)
                        {
                            $UHT1    = $rowhb->UHT1;  
                            $UHT2    = $rowhb->UHT2;
                            $UHT3    = $rowhb->UHT3;
                            $jmluht = $UHT1 + $UHT2 + $UHT3;
                            $h = ($UHT1 == '0' || $UHT1 == '' ) ? '0' : 1;
                            $l = ($UHT2 == '0' || $UHT2 == '' ) ? '0' : 1;
                            $j = ($UHT3 == '0' || $UHT3 == '' ) ? '0' : 1;
                            $k = $h + $l + $j;
                            $RT1    = ($k==0) ? 0 : $jmluht/$k;
                            //echo '<td align="center"><font color="blue">'.$RT1.'</font></td>';
                            $UHP1    = $rowhb->UHP1;
                            $UHP2    = $rowhb->UHP2;
                            $UHP3    = $rowhb->UHP3;
                            $jmluhp = $UHP1 + $UHP2 + $UHP3;
                            $hi = ($UHP1 == '0' || $UHP1 == '' ) ? '0' : 1;
                            $li = ($UHP2 == '0' || $UHP2 == '' ) ? '0' : 1;
                            $ji = ($UHP3 == '0' || $UHP3 == '' ) ? '0' : 1;
                            $ki = $hi + $li + $ji;
                            $RT2    = ($ki==0) ? 0 : $jmluhp/$ki;              
                            //echo '<td align="center"><font color="blue">'.$RT2.'</font></td>';
                            $NaUH   = round(($RT1 + $RT2) / 2);
                            //echo '<td align="center"><b><font color="blue">'.$NaUH.'</font></b></td>';
                            //$BBT1   = round($NaUH * 0.30);
                            //echo '<td align="center"><b><font color="blue">'.$BBT1.'</font></b></td>';
            
                            $TGS1    = $rowhb->TGS1;
                            $TGS2    = $rowhb->TGS2;
                            $TGS3    = $rowhb->TGS3;
                            
                            $jmltgs = $TGS1 + $TGS2 + $TGS3;
                            $ho = ($TGS1 == '0' || $TGS1 == '' ) ? '0' : 1;
                            $lo = ($TGS2 == '0' || $TGS2 == '' ) ? '0' : 1;
                            $jo = ($TGS3 == '0' || $TGS3 == '' ) ? '0' : 1;
                            $ko = $ho + $lo + $jo;
                            $RT3    = round(($ko==0) ? 0 : $jmltgs/$ko);
                            $TGS    = $RT3;
                            
                            //echo '<td align="center"><b><font color="blue">'.$RT3.'</font></b></td>';
                            //$BBT2   = round($RT3 * 0.30);
                            //echo '<td align="center"><b><font color="blue">'.$BBT2.'</font></b></td>';
                            
                            $UTST    = $rowhb->UTST;
                            $UTSP    = $rowhb->UTSP;
                            
                            $jmluts = $UTST + $UTSP;
                            $ha = ($UTST == '0' || $UTST == '' ) ? '0' : 1;
                            $la = ($UTSP == '0' || $UTSP == '' ) ? '0' : 1;
                            $ka = $ha + $la;
                            $RT4    = round(($ka==0) ? 0 : $jmluts/$ka);
                            $UTS    = $RT4;
                            //echo '<td align="center"><b><font color="blue">'.$RT4.'</font></b></td>';
                            //$BBT3   = round($RT4 * 0.40);
                            //echo '<td align="center"><b><font color="blue">'.$BBT3.'</font></b></td>';
                            //$HSL    = $BBT1 + $BBT2 + $BBT3;
                            //echo '<td align="center"><b>';
                            //echo ($HSL < $a) ? '<font color="red">' : '<font color="black">';
                            //echo $HSL.'</font></b></td>';
                            
                            //$sum[$i] = $HSL;
                            $i++;
                        }
                        echo '<td align="center">'.round($TGS).'</td>
                              <td align="center">'.round($NaUH).'</td>
                              <td align="center">'.round($UTS).'</td>
                              <td align="center">'.round($NR).'</td>';
                              $jmlnr[$seq] += $NR;
                        $j++;
                    }
                    $m = ($j!=0) ? $jmlnr[$seq]/$j : '';
                    echo '<td align="center">'.round($m,2).'</td>';
                    echo '</tr>';
                    $seq++;
               }        
            }
            ?>
        
    </table>
    </div>
    <!--<table style="border: none; width: 100%;">
        <tr>
            <td align="right"><input type="submit" name="simpan" class="input button blue" value="Process"/></td>
        </tr>
    </table>-->
<?php }  ?>
    </form>
<?php }  ?>
<?php //echo $this->pagination->create_links(); ?>&nbsp;&nbsp;&nbsp;
    </div> <!-- /content -->

   </div> <!-- /cols -->

   <hr class="noscreen" />

	<!-- Footer -->
<?php $this->load->view('page_footer'); ?>

</div> <!-- /main -->
<script type="text/javascript"> 
    function submitbaru()
    {
        var aksi = $('#frmdaftar').attr('action');
        var kelaspilih = urlencode($('#skelas').val());
        var actionbaru = aksi + "/" + kelaspilih;
        $('#frmdaftar').attr('action',actionbaru);
        return true;
    }
</script>
</body>
</html>