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

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
	<h1>LEDGER</h1>
	<form action="<?php echo base_url().'index.php/hasilbelajar/ledger/'.$this->uri->segment(3); ?>" method="POST" >
    <table align="center" style="border: none;" class="daftar">
        <tr>
        <td width="100px">Select Class</td>
        <td width="320px">&nbsp;
            <?php
            $arraykelas = array('');
            foreach($kelas->result() as $row)
            {
                $arraykelas[trim($row->kelas)]  = $row->kelas;
            }
            echo form_dropdown('kelas',$arraykelas,trim($pilihkelas), 'id="kelas" ');
            ?> 
        </td>
        <td style="border:none;verical-align: topt;text-align: left;width:25%; padding-top: 10px;">
            <input class="input button blue" type="submit" name="filter" value="Filter"/>
        </td>
        <!--<td style="border:none;text-align:left">
            <a href="javascript:formfilter()" class="small button blue">Filter</a>
            <input type="hidden" id="filter" name="filter" value="Filter" />
        </td>-->
                    
        </tr>
    </table>
    </form>
<?php if($tampil =='' || $tampil =='0'){} else { ?>
<?php $nama = $this->siswa_model->nama($pilihkelas); if($nama->num_rows()>0){ ?>                       
    <div style="border:2px solid #999999; width:100%;height:350px; overflow-x:scroll;">
    <form action="<?php echo base_url().'index.php/hasilbelajar/simpan_proses'; ?>" method="post">
    <input type="hidden" name="kelas" id="kelas" class="input-short" style=" width: 60px;" value="<?php echo $pilihkelas; ?>"/>
    <table style="width:120%;" class="tables" > 
        <tr>
            <th style="width:5px">NO</th>
            <th style="width:20px">Nis</th>
            <th style="width:210px">Nama Siswa</th>   
        
            <?php 
                $this->load->helper('adn_text_helper');
                $seq = 1;
                if($this->input->post('filter'))
                {
                    $a = 0;
                    $jmlkgn = 0;
                    foreach($mp->result() as $row)
                    {
                        echo '<th width="30px"><a href="#" class="namalengkap" title="'.$row->nm_mp.'" style="color:white; text-decoration: none;">'.persingkat($row->nm_mp,8).'</a></th>';
                        $seq++;
                    }
                }
            ?>
            <th style="width:210px">Rata-Rata</th> 
        </tr>
            <?php
            $seq = 1;
            $data['kelas']          = $this->input->post('kelas');
            if($this->input->post('filter'))
            {
                $nilai      = array();      
                foreach($nama->result() as $row)
                {
                    $bg = ($seq%2==0) ? ' class="bg" ' : '';
                    echo '<tr'.$bg.'>';
                    echo '<td align="center">'.$seq.'</td>';
                    echo '<td align="center">'.trim($row->nis).'</td>';
                    echo '<td>'.$row->nama_lengkap.'</td>';
                    echo form_hidden('nis[]',trim($row->nis));
                    $j = 0;
                    foreach($mp->result() as $rowmp)
                    {
                        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
                        $data['th_ajar']        = $this->session->userdata('th_ajar');
                        $data['p_nl']           = $this->session->userdata('kd_semester');
                        $data['kd_mp']          = $rowmp->kd_mp;
                        $data['nis']            = $row->nis;
                        
                        $nilaikgn    = ($this->hasilbelajar_model->nilaikgn($data)->num_rows()>0) ? $this->hasilbelajar_model->nilaikgn($data)->row()->kgn : '0';
                        $nlkgn = (round($nilaikgn)=='0') ? ' ' : round($nilaikgn);
                        
                        //echo $x;
                        //echo $this->db->last_query();
                        echo '<td align="center">
                                  <input name="kgn'.($seq-1).$j.'" value="'.$nlkgn.'" style=" border:none; width:40px; text-align: center; background:transparent;" />
                                  <input type="hidden" name="kd_mp'.($seq-1).'[]" value="'.trim($rowmp->kd_mp).'"/>
                              </td>';
                              
                        
                        $j++;
                    }
                    //$jmlkgn += ($this->hasilbelajar_model->avge($data)->row()->kgn == '0') ? '-' : $this->hasilbelajar_model->avge($data)->row()->kgn;
                    //echo $this->db->last_query();        
                    //    $x = ($jmlkgn==0) ? '-' : $jmlkgn;
                    //    $y = ($jmlkgn==0) ? '-' : round($jmlkgn/($seq-1));
                    echo '<td align="center">
                              <input name="" value="" style=" border:none; width:40px; text-align: center; background:transparent;" />
                          </td>';
                    echo '</tr>';
                    $seq++;
               }             
            }
            ?>
        <tr>
            
              
        </tr>
    </table>
    </div>
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
    function formfilter()
    {
        var kelass = $('#kelas').val();
        var aksi = $('#form_filter').attr('action');
        var aksi_lagi = aksi+'/'+kelass;
        $('#form_filter').attr('action',aksi_lagi);
        $('#form_filter').submit();
    }
</script>
</body>
</html>