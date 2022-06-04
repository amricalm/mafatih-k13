<!DOCTYPE html>
<html>
    <head>
        <title>Laporan Konseling</title>
        <style type="text/css">
            body {font-size:12 "Tahoma", sans-serif;}
            th {height:25px;background:orange;}
            td {height:25px;}
            td .bg{background:yellow;}
        </style>
    </head>
    <body>
        <h3 align="center"><u>Laporan Konseling</u></h3>
        <table style="width: 100%;border:1px solid #000" border="1" cellpadding="0" cellspacing="0">
            <tr  style="background: #E1E1E1;" >
                <th>No.</th>
				<th>No.Induk</th>
                <th>Nama</th>
                <th>Kelas</th>
				<th>Tanggal</th>
				<th>Konseling Siswa</th>
				<th>Solusi Guru B.K</th>
				<th>Petugas</th>
            </tr>
            <?php
                $seq        = 1;
                foreach($konseling->result() as $row)
                {
            ?>
            <tr>
                <td><?php echo $seq; ?></td>
                <td><?php echo $row->nis; ?></td>
                <td><?php echo $row->nama_lengkap; ?></td>
                <td><?php echo $row->kelas; ?></td>
				<td><?php echo $row->tgl; ?></td>
				<td><?php echo $row->masalah; ?></td>
				<td><?php echo $row->solusi; ?></td>
				<td><?php //echo $row->user_name; ?></td>
            </tr>
            <?php $seq++; } ?>
		</table>
        <br/>
		<br/>
		<table style="width: 100%; solid #000" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="95%" align="right">Petugas</td>
			<td width="5%"></td>
		</tr>
		</table>
    </body>
</html>