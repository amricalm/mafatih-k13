<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>KEPRIBADIAN SISWA</h1>
<div id="tab01">
<table border="1" width="100%">
<tr>
    <td valign="top">
    <form action="<?php echo base_url().'index.php/kepribadian_siswa/daftar1' ?>" method="POST" id="frmhasilbelajar">
    <!--atur pd (edusis_system/helpers/form_helper.php)function form_hidden, dg menambahkan (id="'.$name.'")-->
    <?php echo form_hidden('myurl',site_url('hasilbelajar')) ?>
    <!--table filter-->                            
    <table border="1" width="100%">
        <tr>
            <td width="100px">Kelas</td>
            <td width="200px"> 
            <select name="skelas" id="skelas" onchange="pilih()">
    		<?php
    			echo '<option value="0" class="input-text"></option>';
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
            <td align="right" width="63%">
            <?php if($this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
                <a href="<?php echo base_url().'index.php/export/export_depan_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Sampul Ledger" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Sampul </a>
                <a href="<?php echo base_url().'index.php/siswa/profile_pdf/'.$this->uri->segment(4); ?>"id="tombol_pdf" title="Print Profil Siswa" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Profil&nbsp&nbsp&nbsp  </a>
                <a href="<?php echo base_url().'index.php/export/export_nilai1/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Raport  </a>
                <a href="<?php echo base_url().'index.php/export/export_catatan_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger Catatan" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Catatan</a>
            <?php } ?>
            </td>  
        </tr>
        <tr>
            <td>Nama Siswa</td>   
            <td style="border:none" class="input-text">
                <div id="resultnama" class="input-text">
                <?php
                    $option = array(0=>"");
                    foreach ($nama->result() as $row)
                    {   
                        $option = $option + array(trim($row->nis)=>$row->nama_lengkap) ;
                    }
                    //echo $nis;
                    echo form_dropdown('nis',$option,$nis,' class="input-text" id="nis"');
                ?>
                </div>
            </td>
            <td style="border:none;vertical-align: top;text-align: left;width:25%; padding: 10px;">
                <a href="javascript:filter()" class="small button blue">Filter</a>
            </td>              
        </tr>
    </table>
    <!--end table filter-->
    <!--table daftar hasil study-->
    </form>
    <br />
    <form action="" method="post">
    <table class="tables" align="center%" width="100%" cellpadding="0">
        <tr>
        	<th width="3%">No</th>
            <th width="37%">Kepribadian</th>
            <th width="12%">KKM</th>
        </tr>
                <?php
        $seq = 1;
        if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0' && $this->uri->segment(4) != '' && $this->uri->segment(4) != '0')
        {
            $nilai      = array();
            foreach($kepribadian->result() as $row)
            {
                $bg = ($seq%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center">'.$seq.'</td>';
                echo '<td align="center">'.$row->ket_pribadi.'</td>';
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
                echo '</tr>';
                $seq++;
           }             
        }
        ?>
    </table>  
    </form>
</tr>
</table>
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
        var nis           = $('#nis').val();
        var myurl         = $('#myurl').val();
        var form_wi       = $('#frmhasilbelajar').attr('action');
        $('#frmhasilbelajar').attr('action',form_wi+'/'+kelas+'/'+nis);
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
