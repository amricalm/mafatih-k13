<?php $this->load->view('page_head');?>
<body>
<div id="main">
<?php $this->load->view('page_menu');?>
<div id="content" class="box">
    <h1>PROGRES RAPOR <?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?></h1>
<div id="tab01">
    <form action="<?php echo base_url().'index.php/hasilbelajar/progres_rapor_uts' ?>" method="POST" id="frmhasilbelajar">
    <!--atur pd (edusis_system/helpers/form_helper.php)function form_hidden, dg menambahkan (id="'.$name.'")-->
    <?php echo form_hidden('myurl',site_url('hasilbelajar')) ?>
    <!--table filter-->                            
<table border="1" width="100%">
    <tr>
        <td width="100px">Kelas</td>
        <td width="300px"> 
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
        <td align="right" width="">
        <?php if($this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
        <!--</a><a href="javascript:ledger_depan('<?php //echo base_url(); ?>index.php/export/ledger_sampul_depan/');" id="" title="Print Sampul Ledger" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/print.png" /></a>
        <a href="javascript:ledger('<?php //echo base_url(); ?>index.php/export/ledgera/');" id="" title="Print Ledger" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/print.png" /></a>
        <a href="javascript:ledger('<?php //echo base_url(); ?>index.php/export/comment/');" id="" title="Print Ledger Catatan" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/print.png" /></a>
        -->
        
        <a href="<?php echo base_url().'index.php/export/export_depan_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Sampul Ledger" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Sampul </a>
        <a href="<?php echo base_url().'index.php/siswa/profile_pdf/'.$this->uri->segment(4); ?>"id="tombol_pdf" title="Print Profil Siswa" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Profil&nbsp&nbsp&nbsp  </a>
        <a href="<?php echo base_url().'index.php/export/export_progres_rapor_uts/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Progres" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Progres</a>
        <!--
        <a href="<?php //echo base_url().'index.php/export/export_catatan_pdf/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Ledger Catatan" class="small button blue"><img src="<?php //echo base_url(); ?>edusis_asset/edusisimg/pdf.png" />Catatan</a>
        -->
        <?php } ?>
        </td>  
    </tr>
    <tr>
        <td>Nama Siswa</td>   
        <td>
            <div id="resultnama" >
            <?php
                $option = array(0=>"&nbsp;");
                foreach ($nama->result() as $row)
                {   
                    $option = $option + array(trim($row->nis)=>$row->nama_lengkap) ;
                }
                //echo $nis;
                echo form_dropdown('nis',$option,$nis,'id="nis"');
            ?>
            
            </div>
        </td>
        <td>
            <a href="javascript:filter()" class="small button blue">Filter</a>
        </td>              
    </tr>
</table>
    <!--end table filter-->
    <!--table daftar hasil study-->
    <?php if($tampil==''){} else { ?>
    <table class="tables" align="center%" width="100%" cellpadding="0">
        <tr>
        	<th width="3%">No.</th>
            <th width="37%">Mata Pelajaran</th>
            <th width="12%">KKM</th>
            <th width="12%">Tugas</th>
        	<th width="12%">UH</th>
        	<th width="12%"><?php $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS'; echo $q; ?></th>
        	<th width="12%">NR</th>
        </tr>
        <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
        <?php
        $a  = 0;
        $i  = 1;
        $jmlkgn = 0;
        foreach($hasilbelajar->result() as $row)
        { 
            $bg = ($i%2==0) ? ' class="bg" ' : '';
            echo '<tr'.$bg.'>';
            echo '<td width="3%" align="center">'.$i.'</td>';
            echo '<td width="22%">&nbsp;&nbsp;&nbsp;'.$row->nm_mp.'</td>';
            echo '<td width="4%" align="center">'.$row->skbm.'</td>';
            
            $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
            $data['th_ajar']        = $this->session->userdata('th_ajar');
            $data['p_nl']           = $this->session->userdata('kd_semester');
            $data['sub_pnl']        = $this->session->userdata('sub_pnl');
            $data['kd_mp']          = $row->kd_mp;
            
            $data['kelas']          = str_replace('+',' ',$this->uri->segment(3));
            $data['nis']            = $this->uri->segment(4);
            $var_array              = $this->hasilbelajar_model->Get_Nilai($data);
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
            if($var_array->num_rows()>0)
            {
                foreach($var_array->result() as $rowvar_array)
                {
                    if(strstr($rowvar_array->kd_tagihan,'TGS')!='')
                    {
                        $TGS = $jumlahTGS += $rowvar_array->kgn / 3;
                        $NR1 = $TGS * 0.3;
                    }
                    elseif(strstr($rowvar_array->kd_tagihan,'UHT')!='')
                    {
                        $Na   = $jumlahNa += $rowvar_array->kgn;
                        $UH   = $jumlahUH += $rowvar_array->psk;
                        $NaUH = ($Na + $UH) / 6;
                        $NR2 = $NaUH * 0.3;
                        
                    }
                    elseif(strstr($rowvar_array->kd_tagihan,'UTS')!='')
                    {
                        $UTST = $jumlahUTST += $rowvar_array->kgn;
                        $UTSP = $jumlahUTSP += $rowvar_array->psk;
                        $ab   = ($UTST == '0' || $UTST == '' ) ? '0' : 1;
                        $ba   = ($UTSP == '0' || $UTSP == '' ) ? '0' : 1;
                        $abc  = $ab + $ba;
                        $UTS  = ($abc == 0) ? 0 : ($UTST + $UTSP) / $abc;
                        $NR3  = $UTS * 0.4;
                    }
                    else{}
                    $NR   = $NR1 + $NR2 + $NR3;
                }
            }
            echo '<td align="center">
                      <input name="" value="'.round($TGS).'" style=" border:none; width:28px; text-align: center; background:transparent;" />
                  </td>
                  <td align="center">
                      <input name="" value="'.round($NaUH).'" style=" border:none; width:28px; text-align: center; background:transparent;" />
                  </td>
                  <td align="center">
                      <input name="" value="'.round($UTS).'" style=" border:none; width:28px; text-align: center; background:transparent;" />
                  </td>
                  <td align="center">
                      <input name="" value="'.round($NR).'" style=" font-weight: bold; border:none; width:28px; text-align: center; background:transparent;" />
                  </td>';
            $i++;
        }
        }
        ?>
    </table>
    
    <!--end table hasil study-->
    <br />
    <?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
    <table border="1" width="100%">
    <tr>
        <td width="50%" style="vertical-align: top;">
            <table class="tables" width="100%" >
            <label><b>Pengembangan Diri</b></label>
            <tr>
            	<th width="1%" >No.</th>
                <th width="25%">Pengembangan Diri</th>
                <th width="10%">Nilai</th>
            </tr>
            
            <?php   
                $i = 1;
                foreach($pribadi->result() as $row)
                {
                    $bg = ($i%2==0) ? ' class="bg" ' : '';
                    echo '<tr'.$bg.'>';
                    echo '<td align="center">'.$i.'</td>';
                    echo '<td>&nbsp;&nbsp;&nbsp;'.$row->ket_pribadi.'</td>';
                    $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
                    echo '<td align="center">'.$nilai.'</td>';
                    echo '</tr>';
                    $i++;
                }
            ?>
            </table>
        </td>
        <td width="50%" style="vertical-align: top;">
            <table class="tables" width="100%">
            <label><b>Ketidakhadiran</b></label>
            <tr>
            	<th width="25%">Ketidakhadiran</th>
                <th width="10%">Hari</th>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;Sakit</td>
                <td align="center"><?php $a=($absens->row()->alfa == '0') ? '-' : $absens->row()->alfa; echo $a; ?></td>
            </tr>
            <tr style="background-color:#e8f6ff;">
                <td>&nbsp;&nbsp;&nbsp;Ijin</td>
                <td align="center"><?php $a=($abseni->row()->alfa == '0') ? '-' : $abseni->row()->alfa; echo $a; ?></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;Tanpa Keterangan</td>
                <td align="center"><?php $a=($absena->row()->alfa == '0') ? '-' : $absena->row()->alfa; echo $a; ?></td>
            </tr>
            <tr>
                <td style="border-right: none; border-left: none;border-bottom: none;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border-right: none; border-left: none; border-top: none;"><b>Ekstrakurikuler</b></td>
            </tr>
            <tr>
                <th width="25%">Ekstrakurikuler</th>
                <th width="10%">Nilai</th>
            </tr>
            <?php   
                $i = 1;
                foreach($eskul->result() as $row)
                {   
                    $nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
                    if($nilai!='-')
                    {
                    $bg = ($i%2==0) ? ' class="bg" ' : '';
                    echo '<tr'.$bg.'>';
                    echo '<td>&nbsp;&nbsp;&nbsp;'.$row->nm_eskul.'</td>';
                    //$nilai = ($row->hasil == ' ') ? '-' : $row->hasil;
                    echo '<td align="center">'.$nilai.'</td>';
                    echo '</tr>';
                    $i++;
                    }
                }
            ?>
            </table>
        </td>
    </tr>
    </table>
    <br />
    <table class="tables" boeder="3">
        <label><b>Catatan :</b></label>
        <tr>
            <td style=" font-weight: bold; width:100% ; height: 70px; font-family:bradley hand ITC; font-size:16px ; padding: 10px 10px; color: black; "><?php echo ($hasilbelajar->row()->comment != '') ? $hasilbelajar->row()->comment : ''; ?></td>
        </tr>
    </table>
    <?php } ?>
    <?php } ?>
    </form>
</div> 
</div>
<hr class="noscreen" />
<?php $this->load->view('page_footer'); ?>
</div>
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
