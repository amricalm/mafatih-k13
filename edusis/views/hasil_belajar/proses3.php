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
    <?php echo form_open('hasilbelajar/proses3/',array('name'=>'frmdaftar','id'=>'frmdaftar','onsubmit'=>'return submitbaru()')) ?>
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
                foreach($nilai as $isi)
                {
                    $bg = ($seq%2==0) ? ' class="bg" ' : '';
                    echo '<tr'.$bg.'>';
                    echo '<td align="center">'.$seq.'</td>';
                    echo '<td>'.$isi['nis'].'</td>';
                    echo '<td>&nbsp;&nbsp;'.$isi['nm'].'</td>';
                    echo form_hidden('nis[]',trim($isi['nis']));
                    $j = 0;
                    $jmlnr[$seq]                  = 0;
                    foreach($mp->result() as $rowmp)
                    {
                        echo '<td align="center">
                                  <input name="kgn['.$j.']['.($seq-1).']" value="'.round($isi['mp'][$j]['tgh']['RFINAL']).'" style=" border:none; width:100%; text-align: center; background:transparent;" />
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