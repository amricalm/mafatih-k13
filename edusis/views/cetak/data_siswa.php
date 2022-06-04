<!DOCTYPE html>
<html>
    <head>
        <title>Data Siswa</title>
        <style type="text/css">
            body {font:0.5em/1.0 "Tahoma", sans-serif;}
            th {height:40px;background:orange;}
            td {height:40px;}
            td .bg{background:yellow;}
        </style>
    </head>
    <body>
        <h3>Daftar Siswa</h3>
        <table style="width: 100%;" cellpadding="0" cellspacing="0">
            <tr>
                <td style="width: 20%;">Kelas</td>
                <td style="width: 5px;">:</td>
                <td style="width: 80%;"><?php echo $data->row()->kelas; ?></td>
            </tr>
            </tr>
        </table>
        <table style="width: 100%;border:1px solid #000" border="1" cellpadding="0" cellspacing="0">
            <tr>
                <th>NO</th>
                <th>NIS</th>
                <th>Nama Lengkap</th>
                <th>Nama Panggilan</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Agama</th>
                <th>Kebangsaan</th>
                <th>Anak Ke.</th>
                <th>Jmh. Sdr. Kandung</th>
                <th>Jmh. Sdr. Tiri</th>
                <th>Jmh. Sdr. Angkat</th>
                <th>Alamat Rumah</th>
                <th>Bahasa Sehari-hari</th>
                <th>Status diri</th>
                <th>Telp</th>
                <th>Tinggal dengan</th>
                <th>Jarak</th>
                <th>Gol. Darah</th>
                <th>Penyakit yang pernah diderita</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
                <th>Asal Sekolah</th>
                <th>Mulai jadi murid</th>
                <th>Nama Ayah Kandung</th>
                <th>Pend. Terakhir Ayah</th>
                <th>Nama Ibu Kandung</th>
                <th>Pend. Terakhir Ibu</th>
                <th>Nama Wali</th>
                <th>Pend. Terakhir Wali</th>
            </tr>
            <?php
                $seq        = 1;
                $jmhdatapeserta = 0;
                foreach($data->result() as $row)
                {
                    $class = ($seq%2==0) ? ' class="bg" ' : '';
            ?>
            <tr<?php echo $class; ?>>
                <td><?php echo $seq; ?></td>
                <td><?php echo $row->nis; ?></td>
                <td><?php echo $row->nama_lengkap; ?></td>
                <td><?php echo $row->nama_panggilan; ?></td>
                <td><?php echo $row->tp_lahir; ?></td>
                <td><?php echo adn_ctgl($row->tgl_lahir); ?></td>
                <td><?php echo $row->agama ?></td>
                <td><?php echo $row->wn; ?></td>
                <td><?php echo $row->anak_ke; ?></td>
                <td><?php echo $row->jmh_sdr_kandung; ?></td>
                <td><?php echo $row->jmh_sdr_tiri; ?></td>
                <td><?php echo $row->jmh_sdr_angkat; ?></td>
                <td><?php echo $row->alamat.' '.$row->kelurahan.' '.$row->kecamatan.' '.$row->kota.' '.$row->kode_pos; ?></td>
                <td><?php echo $row->bahasa; ?></td>
                <td><?php echo $row->status_diri; ?></td>
                <td><?php echo $row->telp; ?></td>
                <td><?php echo $row->tinggal_dg; ?></td>
                <td><?php echo $row->jarak; ?></td>
                <td><?php echo $row->gol_darah; ?></td>
                <td><?php echo $row->penyakit; ?></td>
                <td><?php echo $row->tinggi_badan; ?></td>
                <td><?php echo $row->berat_badan; ?></td>
                <td><?php echo $row->asal_sekolah; ?></td>
                <td><?php echo $row->diterima_tgl; ?></td>
                <td><?php echo $row->ayah_nama; ?></td>
                <td><?php echo $row->ayah_pdd; ?></td>
                <td><?php echo $row->ibu_nama; ?></td>
                <td><?php echo $row->ibu_pdd; ?></td>
                <td><?php echo $row->wali_nama; ?></td>
                <td><?php echo $row->wali_pdd; ?></td>
            </tr>
            <?php $seq++; } ?>
        </table>
    </body>
</html>