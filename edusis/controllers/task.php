<?php
class Task extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('app_model');
        $this->load->model('kelas_model');
        $this->load->model('task_model');
        $this->load->model('kkm_model');
        $this->load->model('hasilbelajar_model');
        $this->load->model('siswa_model');
        $this->load->model('indikator_model');
        $this->load->model('sekuriti_model');
        $this->load->model('mp_model');
        $this->load->model('kompetensi_model');
        $this->global['kd_sekolah']  = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']     = $this->session->userdata('th_ajar');

        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
   }
   function index()
   {
        redirect('task/daftar');
   }
   function daftar()
   {
        $data                       = $this->app_model->general();
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Daftar Task';
        $data['menu']              = $this->app_model->tampil_menu('Evaluasi');

        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['p_nl']              = $this->session->userdata('kd_semester');
        $data['sub_pnl']           = $this->session->userdata('sub_pnl');

        $data['df_kelas']            = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['kdmp']              = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
        $data['kdjenis_nilai']     = $this->mp_model->jn();

        $data['nis']               = '';
        $data['kelas']             = '';
        $data['kd_mp']             = '';
        $data['kd_tagihan']        = '';
        $data['task']              = '';
        $data['kd_mp']             = '';
        $data['tk']                = '';
        $data['kd_kd']             = '';
        $data['kd_ki']             = '';
        $data['kd_kdKi3']          = '';
        $data['kd_kdKi4']          = '';
        $data['kd_ki_filter']      = '';

        if($this->input->post('submit'))
        {
            $data['kd_kd']         = $this->input->post('filter-kd');
            $data['kd_kdKi3']      = $this->input->post('filter-kdKi3');
            $data['kd_kdKi4']      = $this->input->post('filter-kdKi4');
            $data['kd_ki_filter']  = $this->input->post('filter-ki');
            $data['nis']           = $this->input->post('nis');
            $data['kelas']         = $this->input->post('kelas');
            $data['kd_mp']         = $this->input->post('kd_mp');
            $data['kd_tagihan']    = $this->input->post('kd_jenis_nilai');
            $data['tk']            = $this->kelas_model->get($data['kelas'])->row()->tingkat;
            if ($data['kd_tagihan'] == 'PAS') {
                if ($data['kd_ki_filter'] == 'ki3') {
                    //echo "test"; die();
                    $data['task']  = $this->task_model->getpilih($data['kd_sekolah'],$data['th_ajar'],$data['p_nl'],$data['kd_mp'],$data['nis'],$data['kelas'],$data['kd_tagihan'],$data['sub_pnl'],$data['kd_kdKi3']);
                } elseif ($data['kd_ki_filter'] == 'ki4') {
                    $data['task']  = $this->task_model->getpilih($data['kd_sekolah'],$data['th_ajar'],$data['p_nl'],$data['kd_mp'],$data['nis'],$data['kelas'],$data['kd_tagihan'],$data['sub_pnl'],$data['kd_kdKi4']);
                } else {
                    $data['task']      = $this->task_model->getpilih($data['kd_sekolah'],$data['th_ajar'],$data['p_nl'],$data['kd_mp'],$data['nis'],$data['kelas'],$data['kd_tagihan'],$data['sub_pnl'],$data['kd_kd']);
                }
            } else {
                $data['task']      = $this->task_model->getpilih($data['kd_sekolah'],$data['th_ajar'],$data['p_nl'],$data['kd_mp'],$data['nis'],$data['kelas'],$data['kd_tagihan'],$data['sub_pnl'],$data['kd_kd']);
            }
        }
        if ($data['kd_tagihan'] == 'PAS') {
            $data['lstKdKi3']         = $this->kompetensi_model->getKompetensiDasarForNl_pas('',$data['p_nl'],$data['tk'],$data['kd_tagihan'],$data['kd_mp'],$data['kd_sekolah'],$data['th_ajar'],'ki3');
            $data['lstKdKi4']         = $this->kompetensi_model->getKompetensiDasarForNl_pas('',$data['p_nl'],$data['tk'],$data['kd_tagihan'],$data['kd_mp'],$data['kd_sekolah'],$data['th_ajar'],'ki4');
        } else {
            $data['lstKd']         = $this->kompetensi_model->getKompetensiDasarForNl('',$data['p_nl'],$data['tk'],$data['kd_tagihan'],$data['kd_mp'],$data['kd_sekolah'],$data['th_ajar']);
        }
        //echo $this->db->last_query();
        $this->load->view('task/daftar',$data);
   }
   function simpan()
   {
        //print_r($this->input->post());
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['p_nl']           = $this->session->userdata('kd_semester');
        $data['sub_pnl']        = $this->session->userdata('sub_pnl');
        $data['kd_mp']          = $this->input->post('kd_mp');
        $data['kelas']          = $this->input->post('kelas');
        $data['kd_tagihan']     = $this->input->post('kd_jenis_nilai');
        $data['kd_kd']          = $this->input->post('kd_kd');
        //$data['nl']             = $this->input->post('nilai');

        $semuatask              = $this->input->post('task');
        for($i=0;$i<count($semuatask);$i++)
        {
           $data['nis']         = $semuatask[$i];
           $data['kgn']          = $this->input->post('kgn'.$i);
           $data['psk']          = $this->input->post('psk'.$i);
           $data['afk']          = $this->input->post('afk'.$i);
           $doto                = $this->task_model->get($data['kd_sekolah'],$data['th_ajar'],$data['p_nl'],$data['kd_mp'],$data['nis'],$data['kelas'],$data['kd_tagihan'],$data['kd_kd'],$data['sub_pnl']);
           //echo $this->db->last_query();
           if($doto->num_rows()>0)
           {
               // echo "update"; die();
               $this->task_model->update($data);
           }
           else
           {
               // echo "simpan"; die();
               $this->task_model->simpan($data);
           }
        }
        redirect('task/daftar/');
    }
    function daftar_afk($kelas=0,$mp=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Penilaian Afektif';
        $data['menu']               = $this->app_model->tampil_menu('Evaluasi');
        $base_url                   = base_url().'index.php/hasilbelajar/daftar/'.$kelas.'/'.$mp;
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihmp']            = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihmp']        = $this->uri->segment(4);
        }
        $data['mp_pilih']           = $mp;

        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');

        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['pilihmp']            = $this->input->post('kd_mp');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['kd_mp']              = $data['pilihmp'];
        $data['kkm']                = $this->kkm_model->getAll($this->uri->segment(3),$data['pilihmp']);
        //$data['kdmp']               = $this->mp_model->mp();
        $data['sikap']              = $this->indikator_model->get('');
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        //$data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['kdmp']               = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
        $this->load->view('task/daftar_afk',$data);
    }
    function simpan_afk()
    {
        $data['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $data['th_ajar']                = $this->session->userdata('th_ajar');
        $data['p_nl']                   = $this->session->userdata('kd_semester');
        $data['sub_pnl']                = $this->session->userdata('sub_pnl');
        $data['kd_mp']                  = $this->input->post('kd_mp');
        $data['kelas']                  = $this->input->post('skelas');
        $semuanis                       = $this->input->post('nis');
        for($i=0;$i<count($semuanis);$i++)
        {
            $kd_tagihan                 = $this->input->post('kd_tagihan'.$i);
            for($j=0;$j<count($kd_tagihan);$j++)
            {
                $data['nis']            = $semuanis[$i];
                $data['kd_tagihan']     = $kd_tagihan[$j];
                $data['afk']            = $this->input->post('afk'.$i.$j);
                $cek                    = $this->task_model->Get_Tampil_Nilai($data);
                if($cek->num_rows() > 0 )
                    {
                        $this->task_model->updaten1($data);
                    }
                else
                    {
                        $this->task_model->simpann1($data);
                    }
            }
        }
        redirect('task/daftar_afk/');
    }
    function kpa()
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Daftar Task';
        $data['menu']              = $this->app_model->tampil_menu('Evaluasi');
        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['p_nl']              = $this->session->userdata('kd_semester');
        $data['kelass']            = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kdmp']              = $this->mp_model->mp();
        $data['nis']               = '';
        $data['kelas']             = '';
        $data['kd_mp']             = '';
        $data['kgn']               = '';
        $data['psk']               = '';
        $data['afk']               = '';
        $data['kpa']               = '';
        if($this->input->post('submit'))
        {
            $data['nis']           = $this->input->post('nama_lengkap');
            $data['kelas']         = $this->input->post('kelas');
            $data['kd_mp']         = $this->input->post('kd_mp');
            $data['kgn']           = $this->input->post('kgn');
            $data['psk']           = $this->input->post('psk');
            $data['afk']           = $this->input->post('afk');
            $data['kpa']           = $this->task_model->getkpa($data['kd_sekolah'],$data['th_ajar'],$data['p_nl'],$data['kd_mp'],$data['nis'],$data['kelas']);
        }
        //echo $this->db->last_query();
        $this->load->view('task/daftarkpa',$data);
    }
    function save()
    {
        //print_r($this->input->post());
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['p_nl']           = $this->session->userdata('kd_semester');
        $data['kd_mp']          = $this->input->post('kd_mp');
        $data['kelas']          = $this->input->post('kelas');

        $semuatask              = $this->input->post('nilai');
        for($i=0;$i<count($semuatask);$i++)
        {
           $data['nis']         = $semuatask[$i];
           $data['kgn']         = ($this->input->post('kgn'.$i)=='') ? '0' : $this->input->post('kgn'.$i);
           $data['psk']         = $this->input->post('psk'.$i);
           $data['afk']         = $this->input->post('afk'.$i);
           $doto                = $this->task_model->getinput($data);
           //echo $this->db->last_query();
           if($doto->num_rows()>0)
           {
               $this->task_model->edit($data);
           }
           else
           {
               $this->task_model->save($data);
           }
        }
        redirect('task/kpa/');
    }
    function comment()
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Comment List';
        $data['menu']              = $this->app_model->tampil_menu('Evaluasi');

        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['p_nl']              = $this->session->userdata('kd_semester');
        $data['sub_pnl']           = $this->session->userdata('sub_pnl');
        //echo $data['sub_pnl'];
        $data['kelass']            = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);

        $data['kelas']             = '';
        if($this->input->post('submit'))
        {
            $data['kelas']             = $this->input->post('kelas');
        }
        $data['comment']       = $this->task_model->getByComment($data);
        $this->load->view('task/comment',$data);
    }
    function catatan_kepribadian()
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Catatan Kepribadian';
        $data['menu']              = $this->app_model->tampil_menu('Evaluasi');

        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['p_nl']              = $this->session->userdata('kd_semester');
        $data['sub_pnl']           = $this->session->userdata('sub_pnl');
        //echo $data['sub_pnl'];
        $data['kelass']            = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);

        $data['kelas']             = '';
        if($this->input->post('submit'))
        {
            $data['kelas']             = $this->input->post('kelas');
        }
        $data['comment']       = $this->task_model->getByCommentKepribadian($data);
        $this->load->view('task/catatan_kepribadian',$data);
    }
    function catatan_umum()
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Comment List';
        $data['menu']              = $this->app_model->tampil_menu('Evaluasi');

        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['p_nl']              = $this->session->userdata('kd_semester');
        $data['sub_pnl']           = $this->session->userdata('sub_pnl');
        //echo $data['sub_pnl'];
        $data['kelass']            = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);

        $data['kelas']             = '';
        if($this->input->post('submit'))
        {
            $data['kelas']             = $this->input->post('kelas');
        }
        $data['comment']       = $this->task_model->getByCommentCatatanUmum($data);
        $this->load->view('task/catatan_umum',$data);
    }
    function input()
    {
        //print_r($this->input->post());
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['p_nl']           = $this->session->userdata('kd_semester');
        $data['sub_pnl']        = $this->session->userdata('sub_pnl');
        $data['kelas']          = $this->input->post('kelas');

        $semuatask              = $this->input->post('nilai');
        for($i=0;$i<count($semuatask);$i++)
        {
           $data['nis']         = $semuatask[$i];
           $data['comment']     = $this->input->post('comment'.$i);
           $doto                = $this->task_model->getByCommentInput($data);

           if($doto->num_rows()>0)
           {
               $this->task_model->ubah($data);
           }
           else
           {
               $this->task_model->add($data);
           }
        }
        redirect('task/comment/');
     }
    function input_kepribadian()
    {
        //print_r($this->input->post());
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['p_nl']           = $this->session->userdata('kd_semester');
        $data['sub_pnl']        = $this->session->userdata('sub_pnl');
        $data['kelas']          = $this->input->post('kelas');

        $semuatask              = $this->input->post('nilai');
        for($i=0;$i<count($semuatask);$i++)
        {
           $data['nis']         = $semuatask[$i];
           $data['comment']     = $this->input->post('comment'.$i);
           $doto                = $this->task_model->getByCommentInputKepribadian($data);

           if($doto->num_rows()>0)
           {
               $this->task_model->ubahKepribadian($data);
           }
           else
           {
               $this->task_model->addKepribadian($data);
           }
        }
        redirect('task/catatan_kepribadian/');
     }
    function inputCatatanUmum()
    {
        //print_r($this->input->post());
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['p_nl']           = $this->session->userdata('kd_semester');
        $data['sub_pnl']        = $this->session->userdata('sub_pnl');
        $data['kelas']          = $this->input->post('kelas');

        $semuatask              = $this->input->post('nilai');
        for($i=0;$i<count($semuatask);$i++)
        {
           $data['nis']         = $semuatask[$i];
           $data['comment']     = $this->input->post('comment'.$i);
           $doto                = $this->task_model->getByCommentInputCatatanUmum($data);

           if($doto->num_rows()>0)
           {
               $this->task_model->ubahCatatanUmum($data);
           }
           else
           {
               $this->task_model->addCatatanUmum($data);
           }
        }
        redirect('task/catatan_umum/');
     }

    function inputCatatanPengetahuan()
    {
        //print_r($this->input->post());
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['p_nl']           = $this->session->userdata('kd_semester');
        $data['sub_pnl']        = $this->session->userdata('sub_pnl');
        $data['kelas']          = $this->input->post('kelas');
        $data['kd_mp']          = $this->input->post('mp');

        $semuatask              = $this->input->post('nilai');
        for($i=0;$i<count($semuatask);$i++)
        {
           $data['nis']         = $semuatask[$i];
           $data['comment']     = $this->input->post('comment'.$i);
           $doto                = $this->task_model->getByCommentInputCatatanPengetahuan($data);

           if($doto->num_rows()>0)
           {
               $this->task_model->ubahCatatanPengetahuan($data);
           }
           else
           {
               $this->task_model->addCatatanPengetahuan($data);
           }
        }
        redirect('task/deskripsi_pengetahuan/');
     }
     function inputCatatanKeterampilan()
    {
        //print_r($this->input->post());
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['p_nl']           = $this->session->userdata('kd_semester');
        $data['sub_pnl']        = $this->session->userdata('sub_pnl');
        $data['kelas']          = $this->input->post('kelas');
        $data['kd_mp']          = $this->input->post('mp');

        $semuatask              = $this->input->post('nilai');
        for($i=0;$i<count($semuatask);$i++)
        {
           $data['nis']         = $semuatask[$i];
           $data['comment']     = $this->input->post('comment'.$i);
           $doto                = $this->task_model->getByCommentInputCatatanKeterampilan($data);

           if($doto->num_rows()>0)
           {
               $this->task_model->ubahCatatanKeterampilan($data);
           }
           else
           {
               $this->task_model->addCatatanKeterampilan($data);
           }
        }
        redirect('task/deskripsi_keterampilan/');
     }

    function inputCatatanSikap()
    {
        //print_r($this->input->post());
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['p_nl']           = $this->session->userdata('kd_semester');
        $data['sub_pnl']        = $this->session->userdata('sub_pnl');
        $data['kelas']          = $this->input->post('kelas');
        $data['kd_mp']          = $this->input->post('mp');

        $semuatask              = $this->input->post('nilai');
        for($i=0;$i<count($semuatask);$i++)
        {
           $data['nis']         = $semuatask[$i];
           $data['comment']     = $this->input->post('comment'.$i);
           $doto                = $this->task_model->getByCommentInputCatatanSikap($data);

           if($doto->num_rows()>0)
           {
               $this->task_model->ubahCatatanSikap($data);
           }
           else
           {
               $this->task_model->addCatatanSikap($data);
           }
        }
        redirect('task/deskripsi_sikap/');
     }

    function inputCatatanAntarMapel()
    {
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['p_nl']           = $this->session->userdata('kd_semester');
        $data['sub_pnl']        = $this->session->userdata('sub_pnl');
        $data['kelas']          = $this->input->post('kelas');

        $semuatask              = $this->input->post('nilai');
        for($i=0;$i<count($semuatask);$i++)
        {
           $data['nis']					= $semuatask[$i];
           $data['comment']				= $this->input->post('comment'.$i);
		   $data['predikat_sosial']		= $this->input->post('predikat_sosial'.$i);
		   $data['comment_spiritual']	= $this->input->post('comment_spiritual'.$i);
		   $data['predikat_spiritual']	= $this->input->post('predikat_spiritual'.$i);
           $doto                		= $this->task_model->getByCommentInputCatatanAntarMapel($data);

           if($doto->num_rows()>0)
           {
               $this->task_model->ubahCatatanAntarMapel($data);
           }
           else
           {
               $this->task_model->addCatatanAntarMapel($data);
           }
        }
        redirect('task/deskripsi_antar_mapel/');
     }


     //Edited Project Al Madinah
    function deskripsi_pengetahuan()
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Comment List';
        $data['menu']              = $this->app_model->tampil_menu('Evaluasi');

        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['p_nl']              = $this->session->userdata('kd_semester');
        $data['sub_pnl']           = $this->session->userdata('sub_pnl');

        $data['df_kelas']            = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['df_mp']              = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);

        $data['kd_mp']             = '';
        $data['kelas']             = '';

        if($this->input->post('submit'))
        {
            $data['kelas']             = $this->input->post('kelas');
            $data['kd_mp']             = $this->input->post('kd_mp');
        }


        $data['comment']               = $this->task_model->getDeskripsiPengetahuan($data);
        $this->load->view('task/deskripsi_pengetahuan',$data);
    }

    function deskripsi_keterampilan()
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Comment List';
        $data['menu']              = $this->app_model->tampil_menu('Evaluasi');

        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['p_nl']              = $this->session->userdata('kd_semester');
        $data['sub_pnl']           = $this->session->userdata('sub_pnl');
        $data['kelass']            = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['df_mp']              = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);

        $data['kelas']             = '';
        $data['kd_mp']             = '';
        if($this->input->post('submit'))
        {
            $data['kelas']             = $this->input->post('kelas');
            $data['kd_mp']             = $this->input->post('kd_mp');
        }
        $data['comment']       = $this->task_model->getDeskripsiKeterampilan($data);
        $this->load->view('task/deskripsi_keterampilan',$data);
    }

    function deskripsi_sikap()
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Comment List';
        $data['menu']              = $this->app_model->tampil_menu('Evaluasi');

        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['p_nl']              = $this->session->userdata('kd_semester');
        $data['sub_pnl']           = $this->session->userdata('sub_pnl');
        //echo $data['sub_pnl'];
        $data['kelass']            = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['df_mp']              = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);

        $data['kelas']             = '';
        $data['kd_mp']             = '';
        if($this->input->post('submit'))
        {
            $data['kelas']          = $this->input->post('kelas');
            $data['kd_mp']          = $this->input->post('kd_mp');
        }
        $data['comment']       = $this->task_model->getDeskripsiSikap($data);
        $this->load->view('task/deskripsi_sikap',$data);
    }
    function deskripsi_antar_mapel()
    {
        $data['nama_sekolah']      = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']             = ' | Comment List';
        $data['menu']              = $this->app_model->tampil_menu('Evaluasi');

        $data['kd_sekolah']        = $this->session->userdata('kd_sekolah');
        $data['th_ajar']           = $this->session->userdata('th_ajar');
        $data['p_nl']              = $this->session->userdata('kd_semester');
        $data['sub_pnl']           = $this->session->userdata('sub_pnl');
        //echo $data['sub_pnl'];
        $data['df_kelas']            = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);


        $data['kelas']             = '';
        if($this->input->post('submit'))
        {
            $data['kelas']          = $this->input->post('kelas');
        }
        $data['comment']       			 = $this->task_model->getDeskripsiAntarMapel($data);
		$data['predikat_sosial']    	 = $this->task_model->getDeskripsiAntarMapel($data);
        $data['comment_spiritual']       = $this->task_model->getDeskripsiAntarMapel($data);
		$data['predikat_spiritual']       = $this->task_model->getDeskripsiAntarMapel($data);
		$this->load->view('task/deskripsi_antar_mapel',$data);
    }

    function simpan_batch_from_ajax()
    {
        $data           = file_get_contents('php://input');
        $data           = json_decode($data,true);
        
        $app['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $app['th_ajar']                = $this->session->userdata('th_ajar');
        $app['p_nl']                   = $this->session->userdata('kd_semester');
        $app['sub_pnl']                = $this->session->userdata('sub_pnl');
        $app['kd_mp']                  = $data['kd_mp'];
        $app['kelas']                  = $data['kelas'];
        $app['kd_tagihan']             = $data['kd_tagihan'];
        $app['kd_kd']                  = $data['kd_kd'];

        $semuatask              = $data['rows'];
        $result                     = "";
        for($i=0;$i<count($semuatask);$i++)
        {
           $app['nis']         = $semuatask[$i]['nis'];
           $app['kgn']         = $semuatask[$i]['kgn'];
           $app['psk']         = $semuatask[$i]['psk'];
           $app['afk']         = $semuatask[$i]['afk'];

           $doto                = $this->task_model->periksa_Nilai_Siswa_perKD($app);
         
           if($doto->num_rows()>0)
           {
                $result = $this->task_model->ubahTghSiswa($app);
           }
           else
           {
                $result = $this->task_model->addTghSiswa($app);
           }
        }

        $result                     = json_decode($result);
        echo $result;

    }

    function simpan_from_ajax()
    {
        print_r($this->input->post());
        $data['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $data['th_ajar']        = $this->session->userdata('th_ajar');
        $data['p_nl']           = $this->session->userdata('kd_semester');
        $data['sub_pnl']        = $this->session->userdata('sub_pnl');
        $data['kelas']          = $this->input->post('kelas');

        $semuatask              = $this->input->post('nilai');
        for($i=0;$i<count($semuatask);$i++)
        {
           $data['nis']         = $semuatask[$i];
           $data['comment']     = $this->input->post('comment'.$i);
           $doto                = $this->task_model->getByCommentInput($data);

           if($doto->num_rows()>0)
           {
               $this->task_model->ubah($data);
           }
           else
           {
               $this->task_model->add($data);
           }
        }
        redirect('task/comment/');
     }

    function aj_update_deskripsi_pengetahuan()
    {
        $this->load->model('app_model');
        $this->load->library('curl');
        $data                           = $_REQUEST['data'];
        $data                           = json_decode($data,true);

        $data['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $data['th_ajar']                = $this->session->userdata('th_ajar');
        $data['p_nl']                   = $this->session->userdata('kd_semester');
        $data['sub_pnl']                = $this->session->userdata('sub_pnl');
        $data                           = json_encode($data);

        $url                            = $this->app_model->system('prestasi_service_url'). "/SimpanDeskripsiPengetahuan";
        $this->curl->create($url);
        $this->curl->post($data);
        $result                         = "";
        $result                         = json_decode($this->curl->execute());

        echo $result;
    }
    function aj_update_deskripsi_keterampilan()
    {
        $this->load->model('app_model');
        $this->load->library('curl');
        $data                           = $_REQUEST['data'];
        $data                           = json_decode($data,true);

        $data['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $data['th_ajar']                = $this->session->userdata('th_ajar');
        $data['p_nl']                   = $this->session->userdata('kd_semester');
        $data['sub_pnl']                = $this->session->userdata('sub_pnl');
        $data                           = json_encode($data);

        $url                            = $this->app_model->system('prestasi_service_url'). "/SimpanDeskripsiKeterampilan";
        $this->curl->create($url);
        $this->curl->post($data);
        $result                         = "";
        $result                         = json_decode($this->curl->execute());

        echo $result;
    }
    function aj_update_deskripsi_sikap()
    {
        $this->load->model('app_model');
        $this->load->library('curl');
        $data                           = $_REQUEST['data'];
        $data                           = json_decode($data,true);

        $data['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $data['th_ajar']                = $this->session->userdata('th_ajar');
        $data['p_nl']                   = $this->session->userdata('kd_semester');
        $data['sub_pnl']                = $this->session->userdata('sub_pnl');
        $data                           = json_encode($data);

        $url                            = $this->app_model->system('prestasi_service_url'). "/SimpanDeskripsiSikap";
        $this->curl->create($url);
        $this->curl->post($data);
        $result                         = "";
        $result                         = json_decode($this->curl->execute());

        echo $result;
    }
    function aj_update_deskripsi_antar_mapel()
    {
        $this->load->model('app_model');
        $this->load->library('curl');
        $data                           = $_REQUEST['data'];
        $data                           = json_decode($data,true);

        $data['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $data['th_ajar']                = $this->session->userdata('th_ajar');
        $data['p_nl']                   = $this->session->userdata('kd_semester');
        $data['sub_pnl']                = $this->session->userdata('sub_pnl');
        $data                           = json_encode($data);

        $url                            = $this->app_model->system('prestasi_service_url_1617_sma'). "/SimpanDeskripsiAntarMapel";
        $this->curl->create($url);
        $this->curl->post($data);
        $result                         = "";
        $result                         = json_encode($this->curl->execute());

        echo $result;
    }

    function ajSetComboKd($jn='',$kdMp='',$kelas='')
    {
        $data['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $data['th_ajar']                = $this->session->userdata('th_ajar');
        $data['p_nl']                   = $this->session->userdata('kd_semester');
        $data['tk']                     = isset($this->kelas_model->get($kelas)->row()->tingkat) ? $this->kelas_model->get($kelas)->row()->tingkat : '';
        if ($jn == 'PAS') {
            $arrIsiKi3 = $this->kompetensi_model->getCombo_pas_ki3('',$data['p_nl'],$data['tk'],$jn,$kdMp,$data['kd_sekolah'],$data['th_ajar']);        
            $arrIsiKi4 = $this->kompetensi_model->getCombo_pas_ki4('',$data['p_nl'],$data['tk'],$jn,$kdMp,$data['kd_sekolah'],$data['th_ajar']);
            $pilih_ki3   = form_dropdown('filter-kdKi3', $arrIsiKi3, '', 'id="filter-kd"');
            $pilih_ki4   = form_dropdown('filter-kdKi4', $arrIsiKi4, '', 'id="filter-kd"');
            $pilihKi = '';
            echo "<select name='filter-ki' class='form-control' id='filter-ki' onchange='pilih()'>";
            $arrKi  = array(''=>'','ki3'=>'KI 3','ki4'=>'KI 4');
              foreach($arrKi as $keyKi=>$valueKi)
              {
                $selected       ='';
                if($pilihKi == trim($keyKi))
                {
                    $selected   = 'selected="selected"';
                }
                echo '<option value="'.trim($keyKi).'" '.$selected.'>'.$valueKi.'</option>';
              }
            echo "</select>";

            echo "<span name='row_ki3' id='row_ki3' display='none'>".$pilih_ki3."</span>";
            echo "<span name='row_ki4' id='row_ki4' display='none'>".$pilih_ki4."</span>";
            echo "<script type=\"text/javascript\">";
            
            if ($pilihKi == 'ki3') {
                echo "$('#row_ki3').show();";
                echo "$('#row_ki4').hide();";
            }elseif ($pilihKi == 'ki4') {
                echo "$('#row_ki3').hide();";
                echo "$('#row_ki4').show();";
            } else {
                echo "$('#row_ki3').hide();";
                echo "$('#row_ki4').hide();";
            }
            echo "</script>";
            echo "<script type=\"text/javascript\">
                $(function() {
                  $('#filter-ki').change(function(){
                      if($('#filter-ki').val() == 'ki3') {
                          $('#row_ki3').show();
                          $('#row_ki4').hide();
                          document.getElementById('row_ki4').style.display = 'none';
                      } else if($('#filter-ki').val() == 'ki4') {
                        $('#row_ki3').hide();
                        $('#row_ki4').show();
                        document.getElementById('row_ki3').style.display = 'none';
                      } else {
                        $('#row_ki3').hide();
                        $('#row_ki4').hide();
                        document.getElementById('row_ki3').style.display = 'none';
                        document.getElementById('row_ki4').style.display = 'none';
                      }
                  });
                });
            </script>";
        } else {
            $arrIsi = $this->kompetensi_model->getCombo('',$data['p_nl'],$data['tk'],$jn,$kdMp,$data['kd_sekolah'],$data['th_ajar']);
            echo form_dropdown('filter-kd', $arrIsi, '','id="filter-kd"');
        }
    }
}
