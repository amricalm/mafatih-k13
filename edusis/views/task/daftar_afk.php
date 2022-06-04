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
<div id="content" class="box">
    <h1>EVALUASI AFK <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?></h1>
<form action="<?php echo base_url().'index.php/task/daftar_afk' ?>" method="POST" id="frmhasilbelajar">
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
            <a href="<?php echo base_url().'index.php/export/export_sikap_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger Sikap <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?>" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
            <?php } ?>
            </td>  
        </tr>
        <tr>
            <td>Muatan pelajaran</td>  
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
    </form>
    <!--end table filter-->
    <!--table daftar hasil study (afektif)-->
<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    <form action="<?php echo base_url().'index.php/task/simpan_afk'; ?>" method="post">
    <input type="hidden" name="skelas" id="skelas" class="input-short" style=" width: 60px;" value="<?php echo $pilihkelas; ?>"/>
    <input type="hidden" name="kd_mp" id="kd_mp" class="input-short" style=" width: 60px;" value="<?php echo $pilihmp; ?>"/>
    <table class="tables" align="center" width="100%" cellpadding="0">
    <?php $nama = $this->siswa_model->nama($pilihkelas);?>                       
    	<tr>
    		<th width="2%">NO</th>
    		<th width="5%">NO.INDUK</th>
    		<th width="18%">NAMA SISWA</th>
            <?php
                $this->load->helper('adn_text_helper');
                $seq = 1;
                foreach($sikap->result() as $row)
                {
                    echo '<th width="4%px"><a href="#" class="namalengkap" title="'.$row->nm_sikap.'" style="color:white; text-decoration: none;">'.$row->nm_sikap.'</a></th>';
                    $seq++;
                }
            ?>
    		<th width="5%">Jumlah Skor</th>
    		<th width="5%">Predikat Nilai</th>
   		</tr>
        <?php
        $seq = 1;
        if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0')
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
                $nilai[$seq]                = 0;
                foreach($sikap->result() as $rowsikap)
                {
                    $jumlah = 0;
                    $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
                    $data['th_ajar']        = $this->session->userdata('th_ajar');
                    $data['p_nl']           = $this->session->userdata('kd_semester');
                    $data['sub_pnl']        = $this->session->userdata('sub_pnl');
                    $data['kelas']          = $this->input->post('skelas');
                    $data['kd_mp']          = $this->input->post('kd_mp');
                    $data['kd_tagihan']     = $rowsikap->kd_sikap;
                    $data['nis']            = $row->nis;
                    
                    $nilaiafk               = ($this->task_model->Get_Tampil_Nilai($data)->num_rows()>0) ? $this->task_model->Get_Tampil_Nilai($data)->row()->afk : '';
                    $nilai[$seq]            += $nilaiafk;
                    echo '<td align="center">
                              <input name="afk'.($seq-1).$j.'" value="'.$nilaiafk.'" style=" border:none; width:60px; text-align: center; background:transparent;" />
                              <input type="hidden" name="kd_tagihan'.($seq-1).'[]" value="'.trim($rowsikap->kd_sikap).'"/>
                          </td>';
                    $j++;
                    
                }
                echo '<td align="center"><b>'.$nilai[$seq].'</b></td>';
                $penilaian = '';
                if($nilai[$seq] >= (3.25 * $j) )
                {
                    $penilaian= 'A';
                }
                elseif($nilai[$seq] >= (1.375 * $j))
                {
                    $penilaian= 'B';
                }
                elseif($nilai[$seq] >= 1)
                {
                    $penilaian= 'C';
                }
                else{$penilaian= '';}
                echo '<td align="center"><b>'.$penilaian.'</b></td>';
                
                echo '</tr>';
                $seq++;
           }             
        }
        ?>
    </table>
</div> <!-- /content -->
<?php if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0') { ?>
    <table style="border: none; width: 100%;">
        <tr>
            <td align="right"><input type="submit" name="simpan" class="input-submit" value="Simpan"/></td>
        </tr>
    </table>
<?php } ?>
        <!-- end table hsil study -->
    </form>
<?php ?>
	<!-- Footer -->
</div> <!-- /cols -->
</div> <!-- /cols -->
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