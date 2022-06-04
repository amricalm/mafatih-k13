<?php $this->load->view('page_head');?>
<body>

<div id="main">

    <?php $this->load->view('page_menu');?>

		<!-- Content (Right Column) -->
		<div id="content" class="box">
		<h1>LAP ABSENSI SISWA</h1>
		
        
        <?php echo form_open('absen/lapabsen/',array('name'=>'frmdaftar','id'=>'frmdaftar','onsubmit'=>'return submitbaru()')) ?>
        <table align="center" style="border: none; width: 100%;" class="daftar">
        <tr>
            <td width="100px">Kelas</td>
            <td width="300px">
            <?php
            $arraykelas = array('');
            foreach($kelas->result() as $row)
            {
                $arraykelas[$row->kelas]  = $row->kelas;
            }
            echo form_dropdown('kelas',$arraykelas,$pilihkelas,'id="kelas"');
            ?> 
            </td>
            <td align="right">
            <?php if($this->uri->segment(3)!='' && $this->uri->segment(3)!='0'){?>
                <a href="<?php echo base_url().'index.php/export/export_absen/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>" id="tombol_pdf" title="Print Laporan Absensi Siswa" class="small button blue"><img src="<?php echo base_url(); ?>edusis_asset/edusisimg/pdf.png" /></a>
            <?php }?>
            </td>
        </tr>
        <tr>
            <td>Bulan</td>
            <td>
            <select name="bulan" id="bulan">
            <?php
                $arraybulan = $this->app_model->bulan();
                //$pilihbulan = date('m');
                for($i=0;$i < count($arraybulan);$i++)
                {
                    $selected = '';
                    if($i == $pilihbulan)
                    {
                        $selected = ' selected="selected" ';
                    }
                    echo '<option value="'.$i.'"'.$selected.'>'.$arraybulan[$i].'</option>';
                }
            ?>                   
            </select>
            </td>
            <td align="left">
                <input class="input button blue" type="submit" name="filter" value="Filter"/>
            </td>
        </tr>
        </form>
    </table>
	<div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
    <table width="100%" class="tables"> 
        <tr>
            <th width="1%" rowspan="2">NO</th>
            <th width="7%" rowspan="2">NIS</th>
            <th width="26%" rowspan="2">NAMA SISWA</th>
            <th width="60%" colspan="31">TANGGAL</th>
            <th width="1%" colspan="3">JUMLAH</th>
        </tr>
        <tr>
            <?php
            $x = 31;
            for($tgl=1;$tgl<=$x;$tgl++)
            {
                echo '<th width="2%">'.$tgl.'</th>';
            }
            ?>
            <th width="1%">&nbsp;a</th>
            <th width="1%">&nbsp;i&nbsp;</th>
            <th width="1%">&nbsp;s</th>
        </tr>
            <?php 
            $i = 1;
            if($this->input->post('filter'))
            {
                foreach($siswa->result() as $row)
                {
                $bg = ($i%2==0) ? ' class="bg" ' : '';
                echo '<tr'.$bg.'>';
                echo '<td align="center"'.$bg.' >'.$i.'</td>';
                echo '<td align="center">'.trim($row->nis).'</td>';
                echo '<td >'.$row->nama_lengkap.'</td>';
                $a = '';
                $b = '';
                $s = '';
                for($absen=1;$absen<=$x;$absen++)
                {
                    $abs='';
                    $data['kd_sekolah']              = $this->session->userdata('kd_sekolah');
                    $data['p_nl']                    = $this->session->userdata('kd_semester');
                    $data['pilihtahun']              = $this->session->userdata('th_ajar');
                    $data['pilihkelas']              = $this->input->post('kelas');
                    $data['pilihbulan']              = $this->input->post('bulan');
                    $data['nis']                     = $row->nis;
                    $data['pilihtgl']                = $absen;
                    $var_array                       = $this->absen_model->getabsen($data['pilihbulan'],$data['pilihtahun'],$data['kd_sekolah'],$data['pilihkelas'],$data['pilihtgl'],$data['p_nl'],$data['nis']);
                    //echo $this->db->last_query();
                    foreach($var_array->result() as $rowvar_array)
                    {
                        $abs = $rowvar_array->absen;
                    }
                    $a   += ($abs == 'a');
                    $b   += ($abs == 'i');
                    $s   += ($abs == 's');
                    echo '<td align="center">'.$abs.'</td>';
                }
                echo '<td align="center">'.(($a==0) ? '' : $a).'</td>';
                echo '<td align="center">'.(($b==0) ? '' : $b).'</td>';
                echo '<td align="center">'.(($s==0) ? '' : $s).'</td>'; 
                echo '</tr>';
                $i++;
                }
            ?>
        <?php }?>
        </table>
        </div>
            </div>
	<!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
<script type="text/javascript">
function submitbaru()
{
    var aksi = $('#frmdaftar').attr('action');
    var kelaspilih = urlencode($('#kelas').val());
    var bulanpilih = urlencode($('#bulan').val());
    //var tglpilih   = urlencode($('#tgl').val());
    var actionbaru = aksi + "/" + kelaspilih + "/" + bulanpilih;// + "/" + tglpilih;
    $('#frmdaftar').attr('action',actionbaru);
    return true;
}
</script>
</body>
</html>