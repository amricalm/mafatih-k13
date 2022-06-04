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
	<h1>PROSES</a></h1>
    <?php echo form_open('hasilbelajar/proses/',array('name'=>'frmdaftar','id'=>'frmdaftar','onsubmit'=>'return submitbaru()')) ?>
	<table align="center" style="border: none;" class="daftar">
        <tr>
        <td width="100px" style="padding: 10px;">Pilih Kelas</td>
        <td class="va-top"width="300px">
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
        <!--<td align="right" width="63%">
            <?php //if($this->uri->segment(3)=='' || $this->uri->segment(3)=='0'){} else { ?>
                <a href="<?php //echo base_url().'index.php/export/export_rekap_rapor_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger <?php //$q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
            <?php //} ?>
        </td>-->
        </tr>
    </table>
    </form>
<?php if($tampil =='' || $tampil =='0'){} else { ?>
<?php $nama = $this->siswa_model->nama($pilihkelas); if($nama->num_rows()>0){ ?>                          
    <div style="border:2px solid #999999; width:100%;height:350px; overflow-x:scroll;">
    <form action="<?php echo base_url().'index.php/hasilbelajar/simpan_proses'; ?>" method="post">
    <input type="hidden" name="kelas" id="kelas" class="input-short" style=" width: 60px;" value="<?php echo $pilihkelas; ?>"/>
    
    <table style="width:100%;" class="tables" > 
        <tr>
            <th style="width:5px; height: 25px;">NO</th>
            <th style="width:10px">NO.INDUK</th>
            <th style="width:250px">NAMA SISWA</th>   
        
            <?php 
                $this->load->helper('adn_text_helper');
                $seq = 1;
                if($this->input->post('filter'))
                {
                    foreach($mp->result() as $row)
                    {
                        echo '<th  width="5%"><a href="#" class="namalengkap" title="'.$row->nm_mp.'" style="color:white; text-decoration: none;text-transform:uppercase;">'.persingkat($row->kd_mp,20).'</a></th>';
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
                    echo '<td>'.$row->nis.'</td>';
                    echo '<td>&nbsp;&nbsp;'.$row->nama_lengkap.'</td>';
                    echo form_hidden('nis[]',trim($row->nis));
                    $j = 0;
                    $jmlnr[$seq]                  = 0;
                    foreach($mp->result() as $rowmp)
                    {
                        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
                        $data['th_ajar']        = $this->session->userdata('th_ajar');
                        $data['p_nl']           = $this->session->userdata('kd_semester');
                        $data['sub_pnl']        = $this->session->userdata('sub_pnl');
                        $data['kelas']          = $this->input->post('kelas');
                        $data['kd_mp']          = $rowmp->kd_mp;
                        $data['nis']            = $row->nis;
                        $var_array              = $this->hasilbelajar_model->Get_Nilai1($data);
                        //echo $this->db->last_query();
                        //die();
                        $TGS                    = 0;
                        $Na                     = 0;
                        $UH                     = 0;
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
                        
                        $TGS1                    = 0;
                        $Na1                     = 0;
                        $UH1                     = 0;
                        $jumlahNaUH1            = 0;
                        $jumlahNa1               = 0;
                        $jumlahUH1               = 0;
                        $NaUH1                   = 0;
                        $UTS1                    = 0;
                        $NR                     = 0;
                        $jumlahTGS1              = 0;
                        $jumlahUTST1             = 0;
                        $jumlahUTSP1             = 0;
                        $NR11                    = 0;
                        $NR21                    = 0;
                        $NR31                    = 0;
//                        if($var_array->num_rows()>0)
//                        {
//                            foreach($var_array->result() as $rowvar_array)
//                            {
//                                if(strstr($rowvar_array->kd_tagihan,'TGS')!='')
//                                {
//                                    $TGS = $jumlahTGS += $rowvar_array->kgn / 6;
//                                    $NR1 = $TGS * 0.3;
//                                }
//                                elseif(strstr($rowvar_array->kd_tagihan,'UHT')!='')
//                                {
//                                    $Na   = $jumlahNa += $rowvar_array->kgn;
//                                    $UH   = $jumlahUH += $rowvar_array->psk;
//                                    $NaUH = ($Na + $UH) / 12;
//                                    $NR2 = $NaUH * 0.3;
//                                    
//                                }
//                                elseif(strstr($rowvar_array->kd_tagihan,'UTS')!='')
//                                {
//                                    $UTST = $jumlahUTST += $rowvar_array->kgn;
//                                    $UTSP = $jumlahUTSP += $rowvar_array->psk;
//                                    $UTS  = ($UTST + $UTSP) / 4;
//                                    $NR3  = $UTS * 0.4;
//                                }
//                                else{}
//                                $NR   = $NR1 + $NR2 + $NR3;
//                            }
//                        }
                        if($var_array->num_rows()>0)
                        {
                            //print_r($var_array->result_array());
                            $arrayvar = $var_array->result_array();
                            for($g=0;$g<count($arrayvar);$g++)
                            {
                                if(strpos($arrayvar[$g]['kd_tagihan'],'UHT')!==false && strpos($arrayvar[$g]['sub_pnl'],'UTS')!==false)
                                {
                                    $Na         += $arrayvar[$g]['kgn'];
                                    $jumlahNa   = ($arrayvar[$g]['kgn']!='0'&&$arrayvar[$g]['kgn']!='') ? $jumlahNa+1 : $jumlahNa;
                                    $UH         += $arrayvar[$g]['psk'];
                                    $jumlahUH   = ($arrayvar[$g]['psk']!='0'&&$arrayvar[$g]['psk']!='') ? $jumlahUH+1 : $jumlahUH;
                                }
                                elseif(strpos($arrayvar[$g]['kd_tagihan'],'TGS')!==false && strpos($arrayvar[$g]['sub_pnl'],'UTS')!==false)
                                {
                                    $TGS        += $arrayvar[$g]['kgn'];
                                    $jumlahTGS  = ($arrayvar[$g]['kgn']!='0'&&$arrayvar[$g]['kgn']!='') ? $jumlahTGS+1 : $jumlahTGS;
                                }
                                elseif(strpos($arrayvar[$g]['kd_tagihan'],'UTST')!==false && strpos($arrayvar[$g]['sub_pnl'],'UTS')!==false)
                                {
                                    $UTST       = $arrayvar[$g]['kgn'];
                                    $UTSP       = $arrayvar[$g]['psk'];
                                    $jumlahUTST = ($arrayvar[$g]['kgn']!='0'&&$arrayvar[$g]['kgn']!='') ? 1 : 0;
                                    $jumlahUTSP = ($arrayvar[$g]['psk']!='0'&&$arrayvar[$g]['psk']!='') ? 1 : 0;
                                }
                                
                                
                                if(strpos($arrayvar[$g]['kd_tagihan'],'UHT')!==false && strpos($arrayvar[$g]['sub_pnl'],'UAS')!==false)
                                {
                                    $Na1         += $arrayvar[$g]['kgn'];
                                    $jumlahNa1   = ($arrayvar[$g]['kgn']!='0'&&$arrayvar[$g]['kgn']!='') ? $jumlahNa1+1 : $jumlahNa1;
                                    $UH1         += $arrayvar[$g]['psk'];
                                    $jumlahUH1   = ($arrayvar[$g]['psk']!='0'&&$arrayvar[$g]['psk']!='') ? $jumlahUH1+1 : $jumlahUH1;
                                }
                                elseif(strpos($arrayvar[$g]['kd_tagihan'],'TGS')!==false && strpos($arrayvar[$g]['sub_pnl'],'UAS')!==false)
                                {
                                    $TGS1        += $arrayvar[$g]['kgn'];
                                    $jumlahTGS1  = ($arrayvar[$g]['kgn']!='0'&&$arrayvar[$g]['kgn']!='') ? $jumlahTGS1+1 : $jumlahTGS1;
                                }
                                elseif(strpos($arrayvar[$g]['kd_tagihan'],'UTST')!==false && strpos($arrayvar[$g]['sub_pnl'],'UAS')!==false)
                                {
                                    $UTST1       = $arrayvar[$g]['kgn'];
                                    $UTSP1       = $arrayvar[$g]['psk'];
                                    $jumlahUTST1 = ($arrayvar[$g]['kgn']!='0'&&$arrayvar[$g]['kgn']!='') ? 1 : 0;
                                    $jumlahUTSP1 = ($arrayvar[$g]['psk']!='0'&&$arrayvar[$g]['psk']!='') ? 1 : 0;
                                }
                            }
                            $jNa                = ($jumlahNa!=0) ? round($Na/$jumlahNa) : 0;
                            $jUH                = ($jumlahUH!=0) ? round($UH/$jumlahUH) : 0;
                            $NaUH               = round((round(($jNa+$jUH)/2))*0.3);
                            $TGS                = ($jumlahTGS!=0) ? round(round(($TGS/$jumlahTGS))*0.3) : 0;
                            //echo $TGS.'/';
                            $UTS                = (($jumlahUTST+$jumlahUTSP)!=0) ? round(round(($UTST+$UTSP)/($jumlahUTST+$jumlahUTSP))*0.4) : 0;
                            $NR1                = ($NaUH + $TGS + $UTS);
                            
                            $jNa1               = ($jumlahNa1!=0) ? round($Na1/$jumlahNa1) : 0;
                            $jUH1               = ($jumlahUH1!=0) ? round($UH1/$jumlahUH1) : 0;
                            $NaUH1              = round(round(($jNa1+$jUH1)/2)*0.3);
                            $TGS1               = ($jumlahTGS1!=0) ? round(round($TGS1/$jumlahTGS1)*0.3) : 0;
                            $UTS1               = (($jumlahUTST1+$jumlahUTSP1)!=0) ? round(round(($UTST1+$UTSP1)/($jumlahUTST1+$jumlahUTSP1))*0.4) : 0;
                            $NR2                = ($NaUH1 + $TGS1 + $UTS1);
                            $NR                 = ($NR1 + $NR2)/2;
                        }
                        echo '<td align="center">
                                  <input name="kgn['.$j.']['.($seq-1).']" value="'.round($NR).'" style=" border:none; width:100%; text-align: center; background:transparent;" />
                                  <input type="hidden" name="kd_mp'.($seq-1).'[]" value="'.trim($rowmp->kd_mp).'"/>
                              </td>';
                        $j++;
                    }
                    echo '</tr>';
                    $seq++;
               }        
            }
            ?>
        
    </table>
    </div>
    <table style="border: none; width: 100%;">
        <tr>
            <td align="right"><input type="submit" name="simpan" class="input button blue" value="Process"/></td>
        </tr>
    </table>
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