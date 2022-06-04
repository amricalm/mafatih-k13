<?php
class app_model extends CI_Model
{
    var $global;
    function __construct()
    {
        parent::__construct();
    }
    function general()
    {
        $this->global['base_css']           = $this->config->item('base_url').'edusis_asset/css';
        $this->global['base_img']           = $this->config->item('base_url').'/edusis_asset/edusisimg';
//        $this->global['base_js']            = $this->config->item('base_url').'inovagl_asset/js';
//        $this->global['base_upload']        = 'inovagl_data/';
//        $this->global['url_costing']        = $this->config->item('adn_rest_api');
//        $this->global['url_ka_api']         = $this->config->item('adn_rest_api');
//        $this->global['versi']              = $this->config->item('versi');

        return $this->global;
    }


    function menu()
    {
        $sys_admin = $this->session->userdata('sys_admin');
        $q=($this->session->userdata('sub_pnl')=='UTS') ? 'UTS' : 'UAS';

        if ($sys_admin == 1)
        {
            $isimenu    = array(
                1           => array('nama'=>'Home','link'=>base_url().'index.php/home','nilai'=>array()),
                2           => array('nama'=>'File','link'=>base_url().'index.php/home','nilai'=>array(
                                1   => array('nama'=>'Siswa','link'=>base_url().'index.php/siswa/daftar'),
                                2   => array('nama'=>'Kelas','link'=>base_url().'index.php/kelas/daftar'),
                                3   => array('nama'=>'Wali Kelas','link'=>base_url().'index.php/walikelas/daftar'),
                                4   => array('nama'=>'Rombongan Belajar','link'=>base_url().'index.php/kelas/rombongan_belajar'),
                                5   => array('nama'=>'Guru','link'=>base_url().'index.php/guru/daftar'),
                                6   => array('nama'=>'Tahun Ajaran','link'=>base_url().'index.php/th_ajar/daftar'),
                                //7   => array('nama'=>'Kepribadian','link'=>base_url().'index.php/kepribadian/daftar'),
                                7   => array('nama'=>'Ekstrakurikuler','link'=>base_url().'index.php/ekstrakurikuler/daftar'),
                                8   => array('nama'=>'Kesehatan','link'=>base_url().'index.php/kesehatan/daftar'),
                                //9   => array('nama'=>'Indikator Sikap','link'=>base_url().'index.php/indikator/daftar'),
                                9  => array('nama'=>'Pelanggaran','link'=>base_url().'index.php/pelanggaran/daftar_tpelanggaran'),
                                10  => array('nama'=>'Detail Pelanggaran','link'=>base_url().'index.php/pelanggaran/daftar'),
                                11  => array('nama'=>'Prestasi','link'=>base_url().'index.php/prestasi/daftar_prestasi'),
                                12  => array('nama'=>'Konfigurasi','link'=>base_url().'index.php/home/konfigurasi'),
                            )),
                3           => array('nama'=>'Kurikulum','link'=>base_url().'index.php/home','nilai'=>array(
                                1   => array('nama'=>'Muatan Pelajaran','link'=>base_url().'index.php/mp/daftar'),
                                2   => array('nama'=>'Pemetaan Muatan Pelajaran Per Kelas','link'=>base_url().'index.php/kkm/daftar'),
                                3   => array('nama'=>'Kompetensi Dasar','link'=>base_url().'index.php/kompetensi/daftar'),
                                //4   => array('nama'=>'Template LCK','link'=>base_url().'index.php/lck/daftar'),
                            )),
                4           => array('nama'=>'BK','link'=>base_url().'index.php/home','nilai'=>array(
                                1   => array('nama'=>'Bimbingan & Konseling Siswa','link'=>base_url().'index.php/konseling/daftar'),
                                2   => array('nama'=>'Kepribadian Siswa','link'=>base_url().'index.php/kepribadian_siswa/daftar'),
                                3   => array('nama'=>'Pelanggaran Siswa','link'=>base_url().'index.php/pelanggaran_siswa/form_pelanggaran'),
                                4   => array('nama'=>'Prestasi Siswa','link'=>base_url().'index.php/prestasi/daftar_prestasisiswa'),
                                
                            )), 
                5           => array('nama'=>'Evaluasi','link'=>base_url().'index.php/home','nilai'=>array(
                                1   => array('nama'=>'Absensi Siswa','link'=>base_url().'index.php/absen/daftar'),
                                2   => array('nama'=>'Input Nilai  '.$q.'','link'=>base_url().'index.php/task/daftar'),
                                //3   => array('nama'=>'Deskripsi Pengetahuan','link'=>base_url().'index.php/task/deskripsi_pengetahuan'),
                                //4   => array('nama'=>'Deskripsi Keterampilan','link'=>base_url().'index.php/task/deskripsi_keterampilan'),
                                //5   => array('nama'=>'Deskripsi Sikap Permapel','link'=>base_url().'index.php/task/deskripsi_sikap'),
                                //5   => array('nama'=>'Deskripsi Sikap','link'=>base_url().'index.php/task/deskripsi_antar_mapel'),
                                3   => array('nama'=>'Ekstrakurikuler Siswa','link'=>base_url().'index.php/eskulsiswa/daftar'),
                                4   => array('nama'=>'Kesehatan Siswa','link'=>base_url().'index.php/kesehatan_siswa/daftar'),
								5   => array('nama'=>'Catatan Wali Kelas','link'=>base_url().'index.php/task/comment'),
                                6   => array('nama'=>'Prestasi Siswa','link'=>base_url().'index.php/prestasi/daftar_prestasisiswa'),
                                7   => array('nama'=>'Pelanggaran Siswa','link'=>base_url().'index.php/pelanggaran_siswa/form_pelanggaran'),

                            )),
                6           => array('nama'=>'Laporan','link'=>base_url().'index.php/home','nilai'=>array(
                                1   => array('nama'=>'Ledger Pengetahuan','link'=>base_url().'index.php/hasilbelajar/ledger_pengetahuan'),
                                2   => array('nama'=>'Ledger Keterampilan','link'=>base_url().'index.php/hasilbelajar/ledger_keterampilan'),
                                3   => array('nama'=>'Ledger Sikap','link'=>base_url().'index.php/hasilbelajar/ledger_sikap'),
								4   => array('nama'=>'Rekap Nilai '.$q.'','link'=>base_url().'index.php/hasilbelajar/rekap_nilai4'),
                                5   => array('nama'=>'Rapor','link'=>base_url().'index.php/hasilbelajar/lck'),
                                //6   => array('nama'=>'Deskripsi Kompetensi','link'=>base_url().'index.php/hasilbelajar/lck_deskripsi'),
                                // 6   => array('nama'=>'Proses','link'=>base_url().'index.php/hasilbelajar/proses3'),
                            )),
//                6           => array('nama'=>'Import','link'=>base_url().'index.php/exel/coba_baca_excel','nilai'=>array
//                            (
//                                1   => array('nama'=>'Unduh Format Import Nilai','link'=>base_url().'Format Impor Nilai.xls','nilai'),
//                                2   => array('nama'=>'Import dari File','link'=>base_url().'index.php/exel/coba_baca_excel','nilai')
//                            )),
                7           => array('nama'=>'Laporan BK','link'=>'#','nilai'=>array
                            (
                                1   => array('nama'=>'Absensi Siswa','link'=>base_url().'index.php/absen/lapabsen'),
                                2   => array('nama'=>'BK Pertanggal','link'=>base_url().'index.php/lapkonseling/daftar'),
                                3   => array('nama'=>'BK Persiswa','link'=>base_url().'index.php/lapkonseling/daftar_persiswa'),
                                4   => array('nama'=>'Pelanggaran Pertanggal','link'=>base_url().'index.php/lappelanggaran/daftar'),
                                5   => array('nama'=>'pelanggaran persiswa ','link'=>base_url().'index.php/lappelanggaran/pelanggaranpersiswa'),
                            )),
                8           => array('nama'=>'Sekuriti','link'=>base_url().'index.php/home','nilai'=>array
                            (
                                1   => array('nama'=>'User','link'=>base_url().'index.php/sekuriti/user'),
                                2   => array('nama'=>'Group User','link'=>base_url().'index.php/sekuriti/group'),
                                3   => array('nama'=>'Otorisasi','link'=>base_url().'index.php/sekuriti/otorisasi'),
                            )),
                //7           => array('nama'=>'Tabungan','link'=>base_url().'index.php/tabungan/ipt_tabungan','nilai'=>array())
                            );
         }
         else
         {
            $isimenu    = array(
                1           => array('nama'=>'Home','link'=>base_url().'index.php/home','nilai'=>array()),
                2           => array('nama'=>'File','link'=>base_url().'index.php/home','nilai'=>array(
                                1   => array('nama'=>'Siswa','link'=>base_url().'index.php/siswa/daftar'),
                                2   => array('nama'=>'Kelas','link'=>base_url().'index.php/kelas/daftar'),
                                3   => array('nama'=>'Wali Kelas','link'=>base_url().'index.php/walikelas/daftar'),
                                4   => array('nama'=>'Rombongan Belajar','link'=>base_url().'index.php/kelas/rombongan_belajar'),
                                5   => array('nama'=>'Guru','link'=>base_url().'index.php/guru/daftar'),
                                6   => array('nama'=>'Tahun Ajaran','link'=>base_url().'index.php/th_ajar/daftar'),
                                //7   => array('nama'=>'Kepribadian','link'=>base_url().'index.php/kepribadian/daftar'),
                                7   => array('nama'=>'Ekstrakurikuler','link'=>base_url().'index.php/ekstrakurikuler/daftar'),
                                8   => array('nama'=>'Kesehatan','link'=>base_url().'index.php/kesehatan/daftar'),
                                //9   => array('nama'=>'Indikator Sikap','link'=>base_url().'index.php/indikator/daftar'),
//                                10  => array('nama'=>'Pelanggaran','link'=>base_url().'index.php/pelanggaran/daftar_tpelanggaran'),
//                                11  => array('nama'=>'Detail Pelanggaran','link'=>base_url().'index.php/pelanggaran/daftar'),
                                9  => array('nama'=>'Prestasi','link'=>base_url().'index.php/prestasi/daftar_prestasi'),
                            )),
                3           => array('nama'=>'Kurikulum','link'=>base_url().'index.php/home','nilai'=>array(
                                1   => array('nama'=>'Muatan Pelajaran','link'=>base_url().'index.php/mp/daftar'),
                                2   => array('nama'=>'Pemetaan Muatan Pelajaran Per Kelas','link'=>base_url().'index.php/kkm/daftar'),
                                3   => array('nama'=>'Kompetensi','link'=>base_url().'index.php/kompetensi/daftar'),
								//4   => array('nama'=>'Template LCK','link'=>base_url().'index.php/lck/daftar'),
                                //4   => array('nama'=>'Rencana Pembelajaran & Penilaian','link'=>base_url().'index.php/rencana_pembelajaran/daftar'),
                            )),
//                4           => array('nama'=>'BK','link'=>base_url().'index.php/home','nilai'=>array(
//                                1   => array('nama'=>'Bimbingan & Konseling Siswa','link'=>base_url().'index.php/konseling/daftar'),
//                                2   => array('nama'=>'Kepribadian Siswa','link'=>base_url().'index.php/kepribadian_siswa/daftar'),
//                                3   => array('nama'=>'Pelanggaran Siswa','link'=>base_url().'index.php/pelanggaran_siswa/form_pelanggaran'),
//                                4   => array('nama'=>'Prestasi Siswa','link'=>base_url().'index.php/prestasi/daftar_prestasisiswa'),
//
//                            )),
                4           => array('nama'=>'Evaluasi','link'=>base_url().'index.php/home','nilai'=>array(
                                1   => array('nama'=>'Absensi Siswa','link'=>base_url().'index.php/absen/daftar'),
                                2   => array('nama'=>'Input Nilai  '.$q.'','link'=>base_url().'index.php/task/daftar'),
                                //3   => array('nama'=>'Deskripsi Pengetahuan','link'=>base_url().'index.php/task/deskripsi_pengetahuan'),
                                //4   => array('nama'=>'Deskripsi Keterampilan','link'=>base_url().'index.php/task/deskripsi_keterampilan'),
//                                5   => array('nama'=>'Deskripsi Sikap','link'=>base_url().'index.php/task/deskripsi_sikap'),
                                //5   => array('nama'=>'Deskripsi Sikap','link'=>base_url().'index.php/task/deskripsi_antar_mapel'),
                                3   => array('nama'=>'Ekstrakurikuler Siswa','link'=>base_url().'index.php/eskulsiswa/daftar'),
                                4   => array('nama'=>'Kesehatan Siswa','link'=>base_url().'index.php/kesehatan_siswa/daftar'),
								5   => array('nama'=>'Catatan Wali Kelas','link'=>base_url().'index.php/task/comment'),
                                6   => array('nama'=>'Prestasi Siswa','link'=>base_url().'index.php/prestasi/daftar_prestasisiswa'),
                            )),
                5           => array('nama'=>'Laporan','link'=>base_url().'index.php/home','nilai'=>array(
                                1   => array('nama'=>'Ledger Pengetahuan','link'=>base_url().'index.php/hasilbelajar/ledger_pengetahuan'),
                                2   => array('nama'=>'Ledger Keterampilan','link'=>base_url().'index.php/hasilbelajar/ledger_keterampilan'),
                                3   => array('nama'=>'Ledger Sikap','link'=>base_url().'index.php/hasilbelajar/ledger_sikap'),
								4   => array('nama'=>'Rekap Nilai '.$q.'','link'=>base_url().'index.php/hasilbelajar/rekap_nilai4'),
                                5   => array('nama'=>'Rapor','link'=>base_url().'index.php/hasilbelajar/lck'),
                                //6   => array('nama'=>'Deskripsi Kompetensi','link'=>base_url().'index.php/hasilbelajar/lck_deskripsi'),
                                // 6   => array('nama'=>'Proses','link'=>base_url().'index.php/hasilbelajar/proses3'),
                            )),
//                6           => array('nama'=>'Import','link'=>base_url().'index.php/exel/coba_baca_excel','nilai'=>array
//                            (
//                                1   => array('nama'=>'Unduh Format Import Nilai','link'=>base_url().'Format Impor Nilai.xls','nilai'),
//                                2   => array('nama'=>'Import dari File','link'=>base_url().'index.php/exel/coba_baca_excel','nilai')
//                            )),
                   //6          => array('nama'=>'Tabungan','link'=>base_url().'index.php/tabungan/ipt_tabungan','nilai'=>array())
                            );
         }
        return $isimenu;
    }
    function tampil_menu($pilihmenu='')
    {
        $menu           = $this->menu();
        $nampil         =  '<ul id="nav">';
        for($i=1;$i<=count($menu);$i++)
        {
            $kelas  = '';
            if($pilihmenu == $menu[$i]['nama'])
            {
                $kelas  = 'class="current"';
            }
            $nampil     .= '<li '.$kelas.'><a href="'.$menu[$i]['link'].'">'.$menu[$i]['nama'].'</a>';
            if(count($menu[$i]['nilai'])!=0)
            {
                $nampil .= '<ul>';
                for($j=1;$j<=count($menu[$i]['nilai']);$j++)
                {
                    $nampil .= '<li>';
                    $nampil .= '<a href="'.$menu[$i]['nilai'][$j]['link'].'">'.$menu[$i]['nilai'][$j]['nama'].'</a>';
                    $nampil .= '</li>';
                }
                $nampil .= '</ul>';
            }
            $nampil .= '</li>';
        }
        $nampil .= '</ul>';

        return $nampil;
    }
    function config_pagination($base_url,$total_rows,$per_page,$uri_segment)
    {
        $config['base_url']         = $base_url;
        $config['total_rows']       = $total_rows;
        $config['per_page']         = $per_page;
        $config['uri_segment']      = $uri_segment;
        $config['first_link']       = 'Pertama';
        $config['last_link']        = 'Terakhir';
        $config['full_tag_open']    = '<div style="padding:5px;"><ul id="mypagination">';
        $config['full_tag_close']   = '</ul></div>';
        $config['prev_tag_open']    = '<li>';
        $config['prev_tag_close']   = '</li>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="active">';
        $config['cur_tag_close']    = '</li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['num_links']        = 5;

        return $config;
    }
    function is_login($role)
    {
        $username       = $this->session->userdata('user_name');
        if ($this->session->userdata('logged_in') && $role!="")
        {
            $sql = "select sco.sc_role, scr.role_nm from scobject sco ";
            $sql .= "inner join scuser scu on sco.sc_group = scu.usr_group ";
            $sql .= "inner join scusergrouprole scr on sco.sc_role = role_kd where scu.usr_kd = ? ";
            $query = $this->db->query($sql,array($username));

            $roles = "";
            if ($query->num_rows() > 0)
            {
                foreach($query->result() as $row)
                {
                    $roles .= $row->role_nm . "#";
                }
                $roles = substr($roles,0,strlen($roles)-1);
            }

            if ($roles)
            {
                $rolesx = explode("#",$roles);
                for($i=0;$i<count($rolesx);$i++)
                {
                    if ($rolesx[$i]==$role) { return true; break;}
                }
            }
            else
            {
                return false;
            }
        }
        elseif ($this->session->userdata('logged_in'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function get_sekolah($kd)
    {
        $this->db->select('*');
        $this->db->from('ms_sekolah');
        if($kd!='')
        {
            $this->db->where('kd_sekolah',$kd);
        }
        return $this->db->get()->row();
    }
/* 	function get_sekolah()
    {
        $hasil      = '';
        $sekolah    = $this->db->get('ms_sekolah');
        foreach($sekolah->result() as $rowsekolah)
        {
            $hasil[$rowsekolah->kode_sekolah] = $rowsekolah->nama_sekolah;
        }
        return $hasil;
    } */
    function get_status_pegawai()
    {
        $data       = array('CPNS','PNS','Yayasan','Honor','Kontrak/PTT','Bantu');
        return $data;
    }
    function get_golongan_pegawai()
    {
        $data       = array('Gol I','Gol II','Gol III','Gol IV');
        return $data;
    }
    function get_ruang_pegawai()
    {
        $data       = array('a','b','c','d','e');
        return $data;
    }
    function get_jabatan_pegawai()
    {
        $data       = array(
                        'Kepala Sekolah',
                        'Wakil Kepala Sekolah',
                        'Guru Bidang Studi',
                        'Guru BP',
                        'Guru Agama Islam',
                        'Guru Agama Kristen Protestan',
                        'Guru Agama Kristen Katolik',
                        'Guru Agama Budha',
                        'Guru Agama Hindu',
                        'Guru Penjaskes',
                        'Guru Kelas'
                    );
        return $data;
    }
    function get_status_kawin_pegawai()
    {
        $data       = array(
                        'Kawin',
                        'Belum Kawin',
                        'Duda/Janda'
                    );
        return $data;
    }
    function get_ijazah_pegawai()
    {
        $data       = array(' ','SLTA','D1','D2','D3','S1','S2','S3');
        return $data;
    }
    function get_bidang_pend_pegawai()
    {
        $data       = array('Keguruan','Non Keguruan');
        return $data;
    }
    function get_sekolahh()
    {
        $hasil      = '';
        $sekolah    = $this->db->get('ms_sekolah');
        foreach($sekolah->result() as $rowsekolah)
        {
            $hasil[$rowsekolah->kd_sekolah] = $rowsekolah->nama_sekolah;
        }
        return $hasil;
    }
    function get_th_ajar()
    {
        $hasil      = '';
        $th_ajar    = $this->db->get('th_ajar');
        foreach($th_ajar->result() as $rowth)
        {
            $hasil[$rowth->th_ajar] = $rowth->th_ajar;
        }
        return $hasil;
    }
    function get_semester()
    {
        $hasil      = '';
        $semester   = $this->db->get('rf_semester');
        foreach($semester->result() as $rowsm)
        {
            $hasil[$rowsm->kd_semester] = $rowsm->nm_semester;
        }
        return $hasil;
    }
    function get_sub()
    {
        $hasil      = '';
        $sub   = $this->db->get('rf_subpnl');
        foreach($sub->result() as $rowsub)
        {
            $hasil[$rowsub->sub_pnl] = $rowsub->nm_sub;
        }
        return $hasil;
    }
    function max_lima_karakter($text)
    {
        $jmlkarakter    = strlen($text);
        if($jmlkarakter==1)
        {
            $text = '0000'.$text;
        }
        elseif ($jmlkarakter==2)
        {
            $text = '000'.$text;
        }
        elseif ($jmlkarakter==3)
        {
            $text = '00'.$text;
        }
        elseif ($jmlkarakter==4)
        {
            $text = '0'.$text;
        }
        return $text;
    }
    function bulan()
    {
        $arraybulan  = array(
        0       => '',
        1       => 'January',
        2       => 'February',
        3       => 'March',
        4       => 'April',
        5       => 'May',
        6       => 'June',
        7       => 'July',
        8       => 'August',
        9       => 'September',
        10      => 'October',
        11      => 'November',
        12      => 'December');

        return $arraybulan;
    }
    function bulanind($pilih='')
    {
        $arraybulan  = array(
        0       => '',
        1       => 'Januari',
        2       => 'Februari',
        3       => 'Maret',
        4       => 'April',
        5       => 'Mei',
        6       => 'Juni',
        7       => 'Juli',
        8       => 'Agustus',
        9       => 'September',
        10      => 'Oktober',
        11      => 'November',
        12      => 'Desember');
		if($pilih!='')
		{
			return $arraybulan[$pilih];
		}
		else
		{
			return $arraybulan;
		}
    }
    function tgl()
    {
        $arraytgl  = array(
        0       => '',
        1       => '1',
        2       => '2',
        3       => '3',
        4       => '4',
        5       => '5',
        6       => '6',
        7       => '7',
        8       => '8',
        9       => '9',
        10      => '10',
        11      => '11',
        12      => '12',
        13      => '13',
        14      => '14',
        15      => '15',
        16      => '16',
        17      => '17',
        18      => '18',
        19      => '19',
        20      => '20',
        21      => '21',
        22      => '22',
        23      => '23',
        24      => '24',
        25      => '25',
        26      => '26',
        27      => '27',
        28      => '28',
        29      => '29',
        30      => '30',
        31      => '31');

        return $arraytgl;
    }


    function get_tgl_lhb()
    {
        $hasil = '';
        $where  = $this->db->where('sys_col', 'tgl_lhb');
        $qry    = $this->db->get('sys_var');

        foreach($qry->result() as $row)
        {
            $hasil = $row->sys_val;
        }
        return $hasil;
    }

    function tgl_lhb_format_ddmmyy()
    {
        $tgl = $this->get_tgl_lhb();
        return substr($tgl,8,2) . '-' . substr($tgl,5,2) . '-' . substr($tgl,0,4);
    }

    function simpan_tgl_lhb($data)
    {
        $this->db->where('sys_col','tgl_lhb');

        $this->db->set('sys_val',$data['sys_val']);
        return $this->db->update('sys_var',$data);
    }

    function list_provinsi($pilih)
    {
        $list   = '';
        $data   = array(
        '',
        'Aceh',
        'Sumatera Utara',
        'Sumatera Barat',
        'Riau',
        'Jambi',
        'Sumatera Selatan',
        'Bengkulu',
        'Lampung',
        'Kepulauan Bangka Belitung',
        'Kepulauan Riau',
        'DKI Jakarta',
        'Jawa Barat',
        'DIY',
        'Jawa Tengah',
        'Jawa Timur',
        'Banten',
        'Bali',
        'NTB',
        'NTT',
        'Kalimantan Barat',
        'Kalimantan Tengah',
        'Kalimantan Selatan',
        'Kalimantan Timur',
        'Sulawesi Utara',
        'Sulawesi Tengah',
        'Sulawesi Selatan',
        'Sulawesi Tenggara',
        'Gorontalo',
        'Sulawesi Barat',
        'Maluku',
        'Maluku Utara',
        'Papua Barat',
        'Papua'
    );
        for($i=0;$i<count($data);$i++)
        {
            $selected                   = ($pilih==$data[$i]) ? 'selected="selected"' : '';
            $list                       .= '<option value="'.$data[$i].'" '.$selected.'>'.$data[$i].'</option>';
        }
        return $list;
    }

    function system($where)
    {
        $this->db->where('sys_col',$where);
        $return         = $this->db->get('sys_var');
        return ($return->num_rows()>0) ? $return->row()->sys_val : '';
    }

}
?>
