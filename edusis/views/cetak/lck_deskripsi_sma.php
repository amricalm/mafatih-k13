<?php
function konversi_predikat_smp_k13($tmp, $arr)
{
  $predikat;
  if ($tmp <= 0)
	{
    $predikat = array(' - ', ' - ');
  }
  elseif ($tmp <= 55)
	{
    $predikat = array('D', 'Kurang baik dalam menguasai semua kompetensi dasar.');
  }
  elseif ($tmp <= 70)
	{
    $predikat = array('C', 'Cukup baik dalam menguasai semua kompetensi dasar.');
  }
  elseif ($tmp <= 85)
	{
    $predikat = array('B', 'Menguasai semua kompetensi dasar dengan baik.');
  }
  elseif ($tmp <= 100)
	{
    $predikat = array('A', 'Menguasai semua kompetensi dasar dengan sangat baik.');
  }
  if ($arr == 0)
	{
    return $predikat[0];
  }
	else
	{
    return $predikat[1];
  }
}
?>
<html>
<head>
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/cetak.css" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="<?php echo base_url() ?>edusis_asset/css/print.css" /><!-- WRITE YOUR CSS CODE HERE -->
<title>Raport</title>
<style>
	@media all
	{
		*
		{
		margin-bottom : 0;
		padding: 0;
		font-family: Arial, sans-serif;
		}
	}
</style>
<body>
<!----------------------
<table align="center" border="0" width="95%" style="font-size:0.8em/1.5;">
    <tr>
    	<td style="font-size:0.8em/1.5;" width="25%">Nama Sekolah</td>
    	<td style="font-size:0.8em/1.5;" width="35%">: <?php echo $sekolah->row()->nama_sekolah;?></td>
    	<td style="font-size:0.8em/1.5;" width="25%">Kelas</td>
    	<td style="font-size:0.8em/1.5;" width="20%">: <?php echo str_replace('+',' ',$this->uri->segment(3));?></td>
    </tr>
    <tr>
    	<td style="font-size:0.8em/1.5;">Alamat</td>
    	<td style="font-size:0.8em/1.5;">: <?php echo $sekolah->row()->alamat_sekolah;?></td>
    	<td style="font-size:0.8em/1.5;">Semester</td>
    	<td style="font-size:0.8em/1.5;">: <?php echo $this->session->userdata('kd_semester');?></td>
    </tr>
    <tr>
    	<td style="font-size:0.8em/1.5;">Nama Peserta Didik</td>
    	<td style="font-size:0.8em/1.5;">: <?php echo $datasiswa->row()->nama_lengkap;?></td>
    	<td style="font-size:0.8em/1.5;">Tahun Pelajaran</td>
    	<td style="font-size:0.8em/1.5;">: <?php echo $this->session->userdata('th_ajar');?></td>
    </tr>
    <tr>
        <td style="font-size:0.8em/1.5;">Nomor Induk/NISN</td>
    		<td style="font-size:0.8em/1.5;">: <?php echo $datasiswa->row()->nis;?></td>
    </tr>
</table>
-------->
<table style="border-collapse:collapse;font-size: 0.8em/1.5;width:98.65%;margin-top:20px;" align="center">
		<thead>
		<tr>
			<th style="width:2.37%;height:50px;"></th>
			<th style="border: 1px solid black;width:4.24%;height:32px;font-size: 0.8em/1.5;">No.</th>
			<th style="border: 1px solid black;width:18.59%;height:32px;font-size: 0.8em/1.5;padding:5px 10px;">Mata Pelajaran</th>
			<th style="height:32px;margin:0;padding:0; border: 1px solid black;font-size: 0.8em/1.5;width:15.1%;">Aspek</th>
			<th style="margin:0;padding:0;text-align:center;border: 1px solid black;font-size: 0.8em/1.5;">Catatan</th>
		</tr>
		</thead>
		<?php if($this->uri->segment(3) != '' && $this->uri->segment(3) != '0' && $this->uri->segment(4) !='' && $this->uri->segment(4) !='0'){ ?>
				<?php
				$a  = 0;
				$i  = 1;
				$jmlkgn = 0;
				$table1 = '';
		//print_r($hasilbelajar->result());die();
				foreach($hasilbelajar->result() as $row)
				{
					$table1 .= '<tr>';
					$table1 .= '<th></th>';
					$table1 .= '<td style="width:4%;text-align:center;border:1px solid black;padding:5px;font-size: 0.8em/1.5;">'.$i.'</td>';
					$table1 .= '<td style="width:10%;padding:5px;border:1px solid black;font-size: 0.8em/1.5;">'.$row->nm_mp.'</td>';
					$table1 .= '<td colspan="2">';
						$table1 .= '<table style="border-collapse:collapse;width:100%;">';
							$table1 .= '<tr>';
								$table1 .= '<td style="text-align:center;border-bottom:1px solid black;border-right:1px solid black;font-size: 0.8em/1.5;padding-left:5px;width:20.2%;">Pengetahuan</td>';
								if($sub_pnl == 'UTS')
								{
									if ($row->comment_pengetahuan_sma_uts != '') {
									$table1 .= '<td style="border-right:1px solid black;font-size: 0.8em/1.5;padding:5px;text-align:justify;">'.$row->comment_pengetahuan_sma_uts.'</td>';
									}
									else {
										$table1 .= '<td style="border-right:1px solid black;font-size: 0.8em/1.5;padding:5px;">-</td>';
									}
								}
								else
								{
									if ($row->comment_pengetahuan_sma_uas != '') {
									$table1 .= '<td style="border-right:1px solid black;font-size: 0.8em/1.5;padding:5px;text-align:justify;">'.$row->comment_pengetahuan_sma_uas.'</td>';
									}
									else {
										$table1 .= '<td style="border-right:1px solid black;font-size: 0.8em/1.5;padding:5px;">-</td>';
									}
								}
							$table1 .='</tr>';
							$table1 .= '<tr style="height:100%;">';
								$table1 .= '<td style="text-align:center;border-bottom:1px solid black;font-size: 0.8em/1.5;padding-left:5px;">Keterampilan</td>';
								if($sub_pnl == 'UTS')
								{
									if ($row->comment_keterampilan_sma_uts != '') {
									$table1 .= '<td style="border:1px solid black;font-size: 0.8em/1.5;padding:5px;text-align:justify;">'.$row->comment_keterampilan_sma_uts.'</td>';
								}
								else 
								{
									$table1 .= '<td style="border:1px solid black;font-size: 0.8em/1.5;padding:5px;">-</td>';
								}
								}
								else
								{
									if ($row->comment_keterampilan_sma_uas != '') {
									$table1 .= '<td style="border:1px solid black;font-size: 0.8em/1.5;padding:5px;text-align:justify;">'.$row->comment_keterampilan_sma_uas.'</td>';
								}
								else {
									$table1 .= '<td style="border:1px solid black;font-size: 0.8em/1.5;padding:5px;">-</td>';
								}
								}
							$table1 .='</tr>';
						$table1 .= '</table>';
					$table1 .= '</td>';
					$i++;
					$a++;
				}
				?>
				<tbody>
				<?php }?>
				<?php echo trim($table1); ?>
				</tbody>
			</table>
</body>
</html>
