<?php $this->load->view('page_head'); ?>

<body>

    <div id="main">

        <?php $this->load->view('page_menu'); ?>

        <!-- Content (Right Column) -->
        <div id="content" class="box">
            <h1>ABSENSI SISWA</h1>


            <?php echo form_open('absen/daftar/', array('name' => 'frmdaftar', 'id' => 'frmdaftar', 'onsubmit' => 'return submitbaru()')) ?>
            <table align="center" style="border: none;" class="daftar">
                <tr>
                    <td width="100px">Kelas</td>
                    <td colspan="3">
                        <?php
                        $arraykelas = array('');
                        foreach ($kelas->result() as $row) {
                            $arraykelas[$row->kelas]  = $row->kelas;
                        }
                        echo form_dropdown('kelas', $arraykelas, $pilihkelas, 'id="kelas"');
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Bulan</td>
                    <td>
                        <select name="bulan" id="bulan" style="width: 118px;">
                            <?php
                            $arraybulan = $this->app_model->bulan();
                            //$pilihbulan = date('m');
                            for ($i = 0; $i < count($arraybulan); $i++) {
                                $selected = '';
                                if ($i == $pilihbulan) {
                                    $selected = ' selected="selected" ';
                                }
                                echo '<option value="' . $i . '"' . $selected . '>' . $arraybulan[$i] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td width="10%">/&nbsp;&nbsp;&nbsp;&nbsp;Tgl</td>
                    <td>&nbsp;
                        <select name="tgl" id="tgl" style="width: 118px;">
                            <?php
                            $arraytgl = $this->app_model->tgl();
                            //$pilihtgl = ($this->uri->segment(5)!='' || $this->uri->segment(5)!='0') ? $this->uri->segment(5) : date('d');
                            for ($i = 0; $i < count($arraytgl); $i++) {
                                $selected = '';
                                if ($i == $pilihtgl) {
                                    $selected = ' selected="selected" ';
                                }
                                echo '<option value="' . $i . '"' . $selected . '>' . $arraytgl[$i] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input class="input button blue" type="submit" name="filter" value="Filter" />
                    </td>
                </tr>
                </form>
            </table>
            <form action="<?php echo base_url() . 'index.php/absen/simpan'; ?>" method="post">
                <input type="hidden" name="bulan" class="input-short" style=" width: 60px;" value="<?php echo $pilihbulan; ?>" />
                <input type="hidden" name="kelas" class="input-short" style=" width: 60px;" value="<?php echo $pilihkelas; ?>" />
                <input type="hidden" name="tgl" class="input-short" style=" width: 60px;" value="<?php echo $pilihtgl; ?>" />

                <div class="scroll-pane-arrows horizontal-only" style="border:1px solid #999999" border="1">
                    <table width="100%" class="tables">
                        <tr>
                            <th width="2%">#</th>
                            <th width="10%">Nis</th>
                            <th width="80%">Nama Siswa</th>
                            <th width="8%">Absensi</th>
                        </tr>
                        <tr>
                        </tr>
                        <?php
                        if ($this->uri->segment(3) != '' && $this->uri->segment(3) != '0') {
                            if ($siswa->num_rows() > 0) {
                                $i = 1;
                                if ($this->input->post('filter')) {
                                    foreach ($siswa->result() as $row) {
                                        $bg = ($i % 2 == 0) ? ' class="bg" ' : '';
                                        echo '<tr' . $bg . '>';
                                        echo '<td align="center"' . $bg . ' >' . $i . '</td>';
                                        echo '<td align="center">' . trim($row->nis) . '</td>';
                                        echo '<td style="text-transform: uppercase">' . $row->nama_lengkap . '</td>';
                                        echo '<input type="hidden" name="semua[]" id="semua" class="input-short" style=" width: 60px;" value="' . trim($row->nis) . '"/>';
                                        //echo '<td  align="center"><input type="text"  name="absen'.($i-1).'" id="absen" class="input-short" style=" width: 100px; background:transparent; border:none; text-align:center;" value="'.trim($row->absen).'"</td>';
                                        echo '<td align="center"><select name="absen' . ($i - 1) . '" id="absen" style="width:100%;  background: transparent; text-align:center; border:none;">';
                                        $absen     = array(1 => '', 2 => 'i', 3 => 's', 4 => 'a');
                                        foreach ($absen as $key => $value) {
                                            $selected = '';
                                            if ($value == trim($row->absen)) {
                                                $selected = ' selected="selected" ';
                                            }
                                            echo '<option value="' . $value . '"' . $selected . '>' . $value . '</option>';
                                        }
                                        echo '</select></td>';
                                        echo '</tr>';
                                        $i++;
                                    }
                        ?>
                                    <tr>
                                        <td colspan="4" style="border-bottom: none; border-right: none; border-left: none;" align="right">
                                            <input type="submit" name="simpan" class="input-submit" value="Simpan" />
                                            <input type="reset" name="reset" class="input-submit" value="Batal" onclick="javascript:window.location='<?php echo base_url() . 'index.php/absen/daftar'; ?>'" />
                                        </td>
                                    </tr>
                        <?php
                                }
                            } else {
                                echo '<td colspan="4" align="center">Data tidak ada, Silahkan Input Rombongan Belajar Terlebih Dahulu..!!</td>';
                            }
                        }
                        ?>
                    </table>
            </form>
        </div>
        <?php //echo $this->pagination->create_links(); 
        ?> &nbsp;&nbsp;&nbsp;
    </div> <!-- /content -->

    </div> <!-- /cols -->

    <hr class="noscreen" />

    <!-- Footer -->
    <?php $this->load->view('page_footer'); ?>
    <script type="text/javascript">
        function submitbaru() {
            var aksi = $('#frmdaftar').attr('action');
            var kelaspilih = urlencode($('#kelas').val());
            var bulanpilih = urlencode($('#bulan').val());
            var tglpilih = urlencode($('#tgl').val());
            var actionbaru = aksi + "/" + kelaspilih + "/" + bulanpilih + "/" + tglpilih;
            $('#frmdaftar').attr('action', actionbaru);
            return true;
        }
    </script>
</body>

</html>