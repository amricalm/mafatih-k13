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
        <td align="right" width="" >
            <?php if($this->uri->segment(3)=='' || $this->uri->segment(3)=='0'){} else { ?>
                <a href="<?php echo base_url().'index.php/export/export_rekap_rapor_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
            <?php } ?>
        </td>  
        </tr>
    </table>
    </form>
<?php if($pilihkelas =='' || $pilihkelas =='0'){} else { ?>
<?php if($siswa['jmhBaris']>0){ ?>                          
    <div>
    <form action="<?php echo base_url().'index.php/hasilbelajar/simpan_proses'; ?>" method="post">
    <input type="hidden" name="kelas" id="kelas" class="input-short" style=" width: 60px;" value="<?php // echo $pilihkelas; ?>"/>
    
    <table style="width:auto;" class="tables" > 
        <tr>
            <th style="width:1%">NO</th>
            <th style="width:3%">NO.INDUK</th>
            <th style="min-width: 200px;">NAMA SISWA</th>
            <?php 
                $this->load->helper('adn_text_helper');
                $seq = 1;
                if($this->input->post('filter'))
                {   //Header Tabel -> Daftar Nama Pelajaran (Baris 2)
                    foreach($mp->result() as $row)
                    {
                        echo '<th width="4%"><a href="#" class="namalengkap" title="'.$row->nm_mp.'" style="color:white; text-decoration: none;text-transform:upercase;">'.persingkat($row->kd_mp,10).'</a></th>';
                        $seq++;
                    }
                }
                echo '<th>JUMLAH</th>';
                echo '<th>RATA-RATA</th>';
            ?>
        </tr>
            <?php
            $seq = 1;
            if($this->input->post('filter'))
            {     
                foreach($nilai as $isi)
                {  
                    $bg = ($seq%2==0) ? ' class="bg" ' : '';
                    echo '<tr'.$bg.'>';
                    echo '<td align="center">'.$seq.'</td>';
                    echo '<td align="center">'. $isi['nis'] .'</td>';
                    echo '<td>&nbsp;&nbsp;'.$isi['nm'].'</td>';
                    $j = 0;
                    $nilai_rataan   = 0;
                    foreach($mp->result() as $rowmp)
                    {
                        $NA = round($isi['mp'][$j]['tgh']['RPTSMP']);
                        $a = $isi['mp'][$j]['kkm'];
                        echo '<td align="center">';
                        if ($NA < $a)
                        {
                            echo '<font color="red">'.$NA.'</font></td>';
                        } else {
                            echo '<font color="black">'.$NA.'</font></td>';
                        }
                        $nilai_rataan = $nilai_rataan + $isi['mp'][$j]['tgh']['RPTSMP'];
                        $j++;
                    }
                    echo '<td align="center">'.round($nilai_rataan).'</td>';
                    
                    $m      = round(($j!=0) ? $nilai_rataan/$j : '');
                    echo '<td align="center">'.$m.'</td>';
                    echo '</tr>';
                    $sum[$seq] = $m;
                    $seq++;
               }
               $ratakelas = (($seq-1)==0) ? 0 : array_sum($sum)/($seq-1);
               echo '<tr>
                        <td>&nbsp;</td>
                        <td colspan="2"><b>&nbsp;&nbsp;Rata-rata Kelas</b></td>
                        <td colspan='.($j+1).'>&nbsp;</td>
                        <td align="center"><b>'.round($ratakelas,1).'</b></td>
                    </tr>';        
            }
            ?>
        
    </table>
    </div>
<?php }  ?>
    </form>
<?php }  ?>
&nbsp;&nbsp;&nbsp;
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