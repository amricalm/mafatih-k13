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
    <?php echo form_open('hasilbelajar/rekap_nilai2/',array('name'=>'frmdaftar','id'=>'frmdaftar','onsubmit'=>'return submitbaru()')) ?>
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
    				foreach($kelas->result() as $rowkelas )
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
<?php if($pilihkelas =='' || $pilihkelas =='0'){} else { ?>
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
                        $data['kd_mp']          = $rowmp->kd_mp;
                        $data['nis']            = $row->nis;
                        $var_array              = $this->hasilbelajar_model->Get_Nilai($data);
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
                        if($var_array->num_rows()>0)
                        {
                            //print_r($var_array->result_array());
                            $arrayvar = $var_array->result_array();
                            for($g=0;$g<count($arrayvar);$g++)
                            {
                                if(strpos($arrayvar[$g]['kd_tagihan'],'UHT')!==false)
                                {
                                    $Na         += $arrayvar[$g]['kgn'];
                                    $jumlahNa   = ($arrayvar[$g]['kgn']!='0'&&$arrayvar[$g]['kgn']!='') ? $jumlahNa+1 : $jumlahNa;
                                    $UH         += $arrayvar[$g]['psk'];
                                    $jumlahUH   = ($arrayvar[$g]['psk']!='0'&&$arrayvar[$g]['psk']!='') ? $jumlahUH+1 : $jumlahUH;
                                }
                                elseif(strpos($arrayvar[$g]['kd_tagihan'],'TGS')!==false)
                                {
                                    $TGS        += $arrayvar[$g]['kgn'];
                                    $jumlahTGS  = ($arrayvar[$g]['kgn']!='0'&&$arrayvar[$g]['kgn']!='') ? $jumlahTGS+1 : $jumlahTGS;
                                }
                                elseif(strpos($arrayvar[$g]['kd_tagihan'],'UTS')!==false)
                                {
                                    $UTST       = $arrayvar[$g]['kgn'];
                                    $UTSP       = $arrayvar[$g]['psk'];
                                    $jumlahUTST = ($arrayvar[$g]['kgn']!='0'&&$arrayvar[$g]['kgn']!='') ? 1 : 0;
                                    $jumlahUTSP = ($arrayvar[$g]['psk']!='0'&&$arrayvar[$g]['psk']!='') ? 1 : 0;
                                }
                            }
                            $jNa                = ($jumlahNa!=0) ? ($Na/$jumlahNa) : 0;
                            $jUH                = ($jumlahUH!=0) ? ($UH/$jumlahUH) : 0;
                            $NaUH               = ($jNa+$jUH)/2;
                            $NR1                = $NaUH*0.3;
                            $TGS                = ($jumlahTGS!=0) ? $TGS/$jumlahTGS : 0;
                            $NR2                = ($TGS)*0.3;
                            $UTS                = (($jumlahUTST+$jumlahUTSP)!=0) ? ($UTST+$UTSP)/($jumlahUTST+$jumlahUTSP) : 0;
                            $NR3                = ($UTS)*0.4;              
                            $NR                 = $NR1+$NR2+$NR3;
                        }
                        //echo strstr($rowvar_array->kd_tagihan,'TGS');
                        echo '<td align="center">'.round($TGS).'</td>';
                        echo '<td align="center">'.round($NaUH).'</td>';
                        echo '<td align="center">'.round($UTS).'</td>';
                        echo '<td align="center">'.round($NR).'</td>';
                        $jmlnr[$seq] += $NR;
                        $j++;
                    }
                    $m = ($j!=0) ? $jmlnr[$seq]/$j : '';
                    echo '<td align="center">'.round($m,1).'</td>';
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