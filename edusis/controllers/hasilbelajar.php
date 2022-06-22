<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hasilbelajar extends CI_Controller
{
    private $_kd_sekolah;
    private $_th_ajar;
    private $_p_nl;
    private $_sub_pnl;
    private $_nm_sekolah;
    private $_dv;

    function __construct()
    {
        parent::__construct();
        $this->load->model('hasilbelajar_model');
        $this->load->model('app_model');
        $this->load->model('kkm_model');
        $this->load->model('kompetensi_model');
        $this->load->model('mp_model');
        $this->load->model('kelas_model');
        $this->load->model('siswa_model');
        $this->load->model('lck_model');
        $this->load->model('task_model');
		$this->load->model('kkm_model');
        $this->load->model('prestasi_model');
        $this->load->library('terbilang');

        $this->global['kd_sekolah'] = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']    = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}

        $this->_kd_sekolah  = $this->session->userdata('kd_sekolah');
        $this->_th_ajar     = $this->session->userdata('th_ajar');
        $this->_p_nl        = $this->session->userdata('kd_semester');
        $this->_sub_pnl     = $this->session->userdata('sub_pnl');

        $this->_dv['kd_sekolah']    = $this->_kd_sekolah;
        $this->_dv['th_ajar']       = $this->_th_ajar;
        $this->_dv['p_nl']          = $this->_p_nl;
        $this->_dv['menu']          = $this->app_model->tampil_menu('Laporan');
        $this->_dv['nama_sekolah']  = $this->app_model->get_sekolah($this->_kd_sekolah)->nama_sekolah;
    }
    function index()
    {
        redirect('hasilbelajar/daftar');
    }
    function alokasiwi_filter($kelas=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $res = $this->siswa_model->nama($kelas);
        $option = array(0=>'');
        foreach($res->result() as $row)
        {
            $option = $option + array($row->nis=>$row->nama_lengkap);
        }
        echo "" . form_dropdown('nama_lengkap',$option, '0','id="nis"'). "";
    }
    function daftar($kelas=0,$nama=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $base_url                   = base_url().'index.php/hasilbelajar/daftar/'.$kelas.'/'.$nama;
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = $this->uri->segment(4);
        }
        $data['nama_pilih']         = $nama;

        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');

        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];

        $data['kd_mp']              = ($this->hasilbelajar_model->tampil($data['pilihkelas'])->num_rows()>0) ? $this->hasilbelajar_model->tampil($data['pilihkelas'])->row()->kd_mp : '';
        $data['kd_mp']              = $this->input->post('kd_mp');
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->hasilbelajar_model->kelas();
        $data['hasilbelajar']       = $this->hasilbelajar_model->tampil($data);
        $this->load->view('hasil_belajar/daftar',$data);
    }
    function report_nilai1($kelas=0,$nama=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $base_url                   = base_url().'index.php/hasilbelajar/report_nilai1/'.$kelas.'/'.$nama;
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = str_replace('+',' ',$this->uri->segment(4));
        }
        $data['nama_pilih']         = $nama;
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');

        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];

        $data['kd_mp']              = ($this->hasilbelajar_model->tampil($data['pilihkelas'])->num_rows()>0) ? $this->hasilbelajar_model->tampil($data['pilihkelas'])->row()->kd_mp : '';
        $data['kd_mp']              = $this->input->post('kd_mp');
        $data['nama']               = $this->hasilbelajar_model->nama($data['pilihkelas']);
        //$data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['absena']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);
        $data['hasilbelajar']       = $this->hasilbelajar_model->getkpa($data);
        $data['tampil'] = ($this->input->post('skelas')=='' || $this->input->post('nis')=='') ? ' ' : 'a';
        $this->load->view('hasil_belajar/report_nilai1',$data);
    }

    function report_nilai1A($kelas=0,$nama=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = str_replace('+',' ',$this->uri->segment(4));
        }
        $data['nama_pilih']         = $nama;
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');

        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];

//        $data['kd_mp']              = ($this->hasilbelajar_model->tampil($data)->num_rows()>0) ? $this->hasilbelajar_model->tampil($data)->row()->kd_mp : '';

        $data['kd_mp']              = $this->input->post('kd_mp');
        $data['nama']               = $this->hasilbelajar_model->nama($data['pilihkelas']);
        //$data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['absena']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);

        $data['hasilbelajar']       = $this->hasilbelajar_model->getkpa($data);
        //echo $this->db->last_query();die();
        $data['tampil'] = ($this->input->post('skelas')=='' || $this->input->post('nis')=='') ? ' ' : 'a';
        $this->load->view('hasil_belajar/report_nilai1A',$data);
    }

    function progres_rapor_uts($kelas=0,$nama=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $base_url                   = base_url().'index.php/hasilbelajar/report_nilai1/'.$kelas.'/'.$nama;
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = str_replace('+',' ',$this->uri->segment(4));
        }
        $data['nama_pilih']         = $nama;
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');

        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];

        $data['kd_mp']              = ($this->hasilbelajar_model->tampil($data['pilihkelas'])->num_rows()>0) ? $this->hasilbelajar_model->tampil($data['pilihkelas'])->row()->kd_mp : '';
        $data['kd_mp']              = $this->input->post('kd_mp');
        $data['nama']               = $this->hasilbelajar_model->nama($data['pilihkelas']);
        //$data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['skelas']            = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['eskul']              = $this->hasilbelajar_model->geteskul($data);
        $data['absena']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);
        $data['hasilbelajar']       = $this->hasilbelajar_model->getkpa($data);
        $data['tampil'] = ($this->input->post('skelas')=='' || $this->input->post('nis')=='') ? ' ' : 'a';
        $this->load->view('hasil_belajar/progres_rapor_uts',$data);
    }

    function progres_rapor_uts2($kelas=0,$nama=0)
    {
        $this->_dv['title']              = ' | Hasil Belajar Semester';

        $this->_dv['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $this->_dv['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $this->_dv['skelas']             = $this->kelas_model->getfilterotorisasi($this->_th_ajar,$this->_kd_sekolah);
        $this->_dv['siswa']              = $this->siswa_model->get_per_kelas($this->_dv['pilihkelas'],  $this->_kd_sekolah, $this->_th_ajar);

        $this->_dv['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $this->_dv['pilihnis']       = str_replace('+',' ',$this->uri->segment(4));
        }

        $data['pilihnis']               = $this->_dv['pilihnis'];
        $data['kelas']                  = $this->_dv['pilihkelas'];
        $data['nis']                    = $data['pilihnis'];
        $data['pilihkelas']             = $this->_dv['pilihkelas'];

        $this->_dv['eskul']              = $this->hasilbelajar_model->geteskul($data);
        $this->_dv['absena']             = $this->hasilbelajar_model->getabsena($data);
        $this->_dv['absens']             = $this->hasilbelajar_model->getabsens($data);
        $this->_dv['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $this->_dv['pribadi']            = $this->hasilbelajar_model->getpribadi($data);

        $qry                             = $this->hasilbelajar_model->getComment($this->_th_ajar, $this->_kd_sekolah,  $this->_p_nl,  $data['nis'])  ;
        $this->_dv['comment']            = ($qry->num_rows()>0) ? $qry->row()->comment : '';
        $this->_dv['hasilbelajar']       = $this->hasilbelajar_model->getkpa($data);
        $this->_dv['tampil'] = ($this->input->post('skelas')=='' || $this->input->post('nis')=='') ? ' ' : 'a';

        $hasil = array();
        $seq    = 0;
        foreach($this->_dv['hasilbelajar']->result() as $row)
        {
            $hasil[$seq]              = array();
            $hasil[$seq]['kd_mp']   = $row->kd_mp;
            $hasil[$seq]['nm_mp']   = $row->nm_mp;
            $hasil[$seq]['kkm']     = $row->skbm;
            $hasil[$seq]['NTGS']     = 0;
            $hasil[$seq]['NUH']      = 0;
            $hasil[$seq]['NUTS']     = 0;
            $hasil[$seq]['NA']       = 0;


            $data['kd_mp']      = $row->kd_mp;
            $qry                = $this->hasilbelajar_model->raporAkhirPerNis($data);
            if($qry->num_rows()>0)
            {
                $ntgh                = $qry->row();

                $UHT1    = $ntgh->UHT1;
                $UHT2    = $ntgh->UHT2;
                $UHT3    = $ntgh->UHT3;

                $jmluht = $UHT1 + $UHT2 + $UHT3;
                $h = ($UHT1 == '0' || $UHT1 == '' ) ? '0' : 1;
                $l = ($UHT2 == '0' || $UHT2 == '' ) ? '0' : 1;
                $j = ($UHT3 == '0' || $UHT3 == '' ) ? '0' : 1;
                $k = $h + $l + $j;
                $UHT    = round(($k==0) ? 0 : $jmluht/$k);

                ///Nilai Praktek
                $UHP1    = $ntgh->UHP1;
                $UHP2    = $ntgh->UHP2;
                $UHP3    = $ntgh->UHP3;

                $jmluhp = $UHP1 + $UHP2 + $UHP3;
                $hi = ($UHP1 == '0' || $UHP1 == '' ) ? '0' : 1;
                $li = ($UHP2 == '0' || $UHP2 == '' ) ? '0' : 1;
                $ji = ($UHP3 == '0' || $UHP3 == '' ) ? '0' : 1;
                $ki = $hi + $li + $ji;
                $UHP    = round(($ki==0) ? 0 : $jmluhp/$ki);

                $his = ($UHT == '0' || $UHT == '' ) ? '0' : 1;
                $lis = ($UHP == '0' || $UHP == '' ) ? '0' : 1;
                $kis = $his + $lis;
                $UH   = ($kis==0) ? 0 : (round(($UHT + $UHP) / $kis));

                $hasil[$seq]['UH']  =  round($UH);

                //Nilai TUGAS
                $TGS1    = $ntgh->TGS1;
                $TGS2    = $ntgh->TGS2;
                $TGS3    = $ntgh->TGS3;
                $jmltgs = $TGS1 + $TGS2 + $TGS3;
                $ho = ($TGS1 == '0' || $TGS1 == '' ) ? '0' : 1;
                $lo = ($TGS2 == '0' || $TGS2 == '' ) ? '0' : 1;
                $jo = ($TGS3 == '0' || $TGS3 == '' ) ? '0' : 1;
                $ko = $ho + $lo + $jo;
                $TGS    = round(($ko==0) ? 0 : $jmltgs/$ko);

                $hasil[$seq]['TGS']  = round($TGS);

                //Nilai UTS
                $UTST    = $ntgh->UTST;
                $UTSP    = $ntgh->UTSP;
                $jmluts = $UTST + $UTSP;
                $ha = ($UTST == '0' || $UTST == '' ) ? '0' : 1;
                $la = ($UTSP == '0' || $UTSP == '' ) ? '0' : 1;
                $ka = $ha + $la;
                $UTS    = round(($ka==0) ? 0 : $jmluts/$ka);

                $hasil[$seq]['UTS'] = round($UTS);

                $RUTS = $UH*0.3 + $TGS*0.3 + $UTS*0.4;
                $hasil[$seq]['RUTS'] = round($RUTS);


                //----------------- NILAI SETELAH MID-------------------------------------
                $UHTA1    = $ntgh->UHTA1;
                $UHTA2    = $ntgh->UHTA2;
                $UHTA3    = $ntgh->UHTA3;

                $jmluht = $UHTA1 + $UHTA2 + $UHTA3;
                $h = ($UHTA1 == '0' || $UHTA1 == '' ) ? '0' : 1;
                $l = ($UHTA2 == '0' || $UHTA2 == '' ) ? '0' : 1;
                $j = ($UHTA3 == '0' || $UHTA3 == '' ) ? '0' : 1;
                $k = $h + $l + $j;
                $UHTA    = round(($k==0) ? 0 : $jmluht/$k);

                ///Nilai Praktek
                $UHPA1    = $ntgh->UHPA1;
                $UHPA2    = $ntgh->UHPA2;
                $UHPA3    = $ntgh->UHPA3;

                $jmluhp = $UHPA1 + $UHPA2 + $UHPA3;
                $hi = ($UHPA1 == '0' || $UHPA1 == '' ) ? '0' : 1;
                $li = ($UHPA2 == '0' || $UHPA2 == '' ) ? '0' : 1;
                $ji = ($UHPA3 == '0' || $UHPA3 == '' ) ? '0' : 1;
                $ki = $hi + $li + $ji;
                $UHPA    = round(($ki==0) ? 0 : $jmluhp/$ki);

                $his = ($UHTA == '0' || $UHTA == '' ) ? '0' : 1;
                $lis = ($UHPA == '0' || $UHPA == '' ) ? '0' : 1;
                $kis = $his + $lis;
                $UHA   = ($kis==0) ? 0 : (round(($UHTA + $UHPA) / $kis));

                $hasil[$seq]['UHA'] =  round($UHA);

                //Nilai TUGAS
                $TGSA1    = $ntgh->TGSA1;
                $TGSA2    = $ntgh->TGSA2;
                $TGSA3    = $ntgh->TGSA3;
                $jmltgs = $TGSA1 + $TGSA2 + $TGSA3;
                $ho = ($TGSA1 == '0' || $TGSA1 == '' ) ? '0' : 1;
                $lo = ($TGSA2 == '0' || $TGSA2 == '' ) ? '0' : 1;
                $jo = ($TGSA3 == '0' || $TGSA3 == '' ) ? '0' : 1;
                $ko = $ho + $lo + $jo;
                $TGSA    = round(($ko==0) ? 0 : $jmltgs/$ko);

                $hasil[$seq]['TGSA']  = round($TGSA);

                //Nilai UTS
                $UTSTA    = $ntgh->UTSTA;
                $UTSPA    = $ntgh->UTSPA;
                $jmluts = $UTSTA + $UTSPA;
                $ha = ($UTSTA == '0' || $UTSTA == '' ) ? '0' : 1;
                $la = ($UTSPA == '0' || $UTSPA == '' ) ? '0' : 1;
                $ka = $ha + $la;
                $UTSA    = round(($ka==0) ? 0 : $jmluts/$ka);

                $hasil[$seq]['UTSA'] = round($UTSA);

                $RUAS = $UHA*0.3 + $TGSA*0.3 + $UTSA*0.4;
                $hasil[$seq]['RUAS'] = round($RUAS);

                $hasil[$seq]['RFINAL'] = round(($RUTS+$RUAS)/2);
                //================= NILAI SETELAH MID =====================================

                if($this->_sub_pnl==='UTS')
                {
                    $hasil[$seq]['NTGS']     = $hasil[$seq]['TGS'];
                    $hasil[$seq]['NUH']      = $hasil[$seq]['UH'];
                    $hasil[$seq]['NUTS']     = $hasil[$seq]['UTS'];
                    $hasil[$seq]['NA']       = $hasil[$seq]['RUTS'];
                }
                elseif($this->_sub_pnl==='UAS')
                {
                    $hasil[$seq]['NTGS']     = round(($hasil[$seq]['TGS']+$hasil[$seq]['TGSA'])/2);
                    $hasil[$seq]['NUH']      = round(($hasil[$seq]['UH']+$hasil[$seq]['UHA'])/2);
                    $hasil[$seq]['NUTS']     = round(($hasil[$seq]['UTS']+$hasil[$seq]['UTSA'])/2);
                    $hasil[$seq]['NA']       = $hasil[$seq]['RFINAL'];
                }
            }
            $seq++;

        }

        $this->_dv['hasil'] = $hasil;
        $this->load->view('hasil_belajar/progres_rapor_uts2',$this->_dv);
    }
    function ledgera_pdf($kelas=0,$nis=0)
    {
        $this->load->library('to_pdf');//load engine dari folder library(dompdf & to_pdf.php)
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $base_url                   = base_url().'index.php/hasilbelajar/report_nilai1/'.$kelas.'/'.$nis;
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = str_replace('+',' ',$this->uri->segment(4));;
        }
        $data['nama_pilih']         = $nis;
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');
        $data['kelas']              = $this->uri->segment(3);
        $data['nis']                = $this->uri->segment(4);
        $data['kd_mp']              = ($this->hasilbelajar_model->tampil($data['pilihkelas'])->num_rows()>0) ? $this->hasilbelajar_model->tampil($data['pilihkelas'])->row()->kd_mp : '';
        $data['kd_mp']              = $this->input->post('kd_mp');
        $data['nama']               = $this->hasilbelajar_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->hasilbelajar_model->kelas();
        $data['absena']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);
        $data['ledger']             = $this->hasilbelajar_model->getkpa($data);
        $html = $this->load->view('cetak/report_nilai1',$data,true);
        $this->to_pdf->pdf_create($html, 'ledger_nilai1',true,'a4','potrait');


    }
    function report_nilai2($kelas=0,$nama=0)
    {
       $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $base_url                   = base_url().'index.php/hasilbelajar/report_nilai/'.$kelas.'/'.$nama;
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']      = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = $this->uri->segment(4);
        }
        $data['nama_pilih']         = $nama;
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');

        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];

        $data['kd_mp']              = ($this->hasilbelajar_model->tampil($data['pilihkelas'])->num_rows()>0) ? $this->hasilbelajar_model->tampil($data['pilihkelas'])->row()->kd_mp : '';
        $data['kd_mp']              = $this->input->post('kd_mp');
        $data['nama']               = $this->hasilbelajar_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->hasilbelajar_model->kelas();
        $data['eskul']              = $this->hasilbelajar_model->geteskul($data);
        $data['karyatulis']         = $this->hasilbelajar_model->getkaryatulis($data);
        $data['absena']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);
        //echo $this->db->last_query();
        $this->load->view('hasil_belajar/report_nilai2',$data);
    }
    function report_nilai3($kelas=0,$nama=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $base_url                   = base_url().'index.php/hasilbelajar/report_nilai/'.$kelas.'/'.$nama;
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']      = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = $this->uri->segment(4);
        }
        $data['nama_pilih']         = $nama;
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');

        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];

        $data['kd_mp']              = ($this->hasilbelajar_model->tampil($data['pilihkelas'])->num_rows()>0) ? $this->hasilbelajar_model->tampil($data['pilihkelas'])->row()->kd_mp : '';
        $data['kd_mp']              = $this->input->post('kd_mp');
        $data['nama']               = $this->hasilbelajar_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->hasilbelajar_model->kelas();
        $data['hasilbelajar']       = $this->hasilbelajar_model->getkks($data);
        //echo $this->db->last_query();
        $this->load->view('hasil_belajar/report_nilai3',$data);
    }

    function kks($kelas=0,$nama=0)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Daftar Task';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');

        $base_url                   = base_url().'index.php/hasilbelajar/report_nilai/'.$kelas.'/'.$nama;
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']      = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = $this->uri->segment(4);
        }
        $data['nama_pilih']         = $nama;
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');

        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $this->input->post('nis');

        $data['nama']               = $this->hasilbelajar_model->nama($data['pilihkelas']);
        $data['mkelas']             = $this->hasilbelajar_model->kelas();

        $data['nis']                = '';
        $data['kelas']              = '';
        $data['kks']                = '';
        $data['hasilbelajar']       = '';

        if($this->input->post('submit'))
        {
            $data['nis']            = $this->input->post('nama_lengkap');
            $data['kelas']          = $this->input->post('skelas');
            $data['kks']            = $this->input->post('kks');
            $data['hasilbelajar']   = $this->hasilbelajar_model->getKKS($data);
        }
        $this->load->view('kks/daftar',$data);
   }
   function simpan()
   {
        //print_r($this->input->post());
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');
        $data['nis']                = $this->input->post('nama_lengkap');
        $data['kelas']              = $this->input->post('skelas');

        $semuakks                   = $this->input->post('semua');
        for($i=0;$i<count($semuakks);$i++)
        {
           $data['kd_mp']           = $semuakks[$i];
           $data['kks']             = $this->input->post('kks'.$i);
           $doto                    = $this->hasilbelajar_model->getKKSInput($data);
           if($doto->num_rows()>0)
           {
               $this->hasilbelajar_model->update($data);
           }
           else
           {
               $this->hasilbelajar_model->simpan($data);
           }
        }
        redirect('hasilbelajar/kks/');
    }
    function ledger($kelas='0')
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Ledger';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');

        $this->load->library('pagination');
        $limit                      = 10;
        $datas['pilihkelas']        = $this->input->post('kelas');
        $base_url                   = base_url().'index.php/hasilbelajar/ledger/'.$datas['pilihkelas'];
        $jmhsiswa                   = $this->siswa_model->nama($this->input->post('kelas'));
        $total_row                  = $jmhsiswa->num_rows();
        $per_page                   = $limit;
        $uri_segment                = 3;

        $config                     = $this->app_model->config_pagination($base_url,$total_row,$per_page,$uri_segment);


        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');

        $data['kelas']              = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['pilihkelas']         = '';
        $data['pilihnis']           = '';
        if($this->input->post('filter'))
        {
            $data['pilihkelas']     = $this->input->post('kelas');
            $data['pilihnis']       = ($this->siswa_model->nama($data['pilihkelas'])->num_rows()>0) ? $this->siswa_model->nama($data['pilihkelas'])->row()->nis : '';
            $data['mp']             = $this->mp_model->getMpByKelas($data['pilihkelas']);
            $data['hasilbelajar']   = ($this->hasilbelajar_model->getkpa($data)!='' || $this->hasilbelajar_model->getkpa($data)!='0') ? $this->hasilbelajar_model->getkpa($data) : '' ;
        }
        $data['tampil']             = ($this->input->post('kelas') =='' || $this->input->post('kelas') =='0') ? '' : 'a';
        $this->pagination->initialize($config);
        $this->load->view('hasil_belajar/ledger',$data);
    }
    function rapor_uts($kelas=0,$mp=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
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
        $data['kelas']              = $data['pilihkelas'];
        $data['kd_mp']              = $data['pilihmp'];
        $data['kkm']                = $this->kkm_model->getAll($this->uri->segment(3),$data['pilihmp']);
        //$data['kdmp']               = $this->mp_model->mp();
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        //$data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kdmp']               = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['hasilbelajar']       = $this->hasilbelajar_model->nilai($data);
        $this->load->view('hasil_belajar/rapor_uts',$data);
    }
    function rapor_akhir($kelas=0,$mp=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
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

        $data['kelas']              = $data['pilihkelas'];

        $data['kd_mp']              = $data['pilihmp'];
        $data['kkm']                = $this->kkm_model->getAll($this->uri->segment(3),$data['pilihmp']);

        $data['kdmp']              = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);

        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        $data['skelas']              = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['hasilbelajar']       = $this->hasilbelajar_model->rapor_akhir($data);
        $this->load->view('hasil_belajar/rapor_akhir2',$data);
    }
    function rapor_akhir2($kelas=0,$mp=0)
    {
        $this->_dv['title']                  = ' | Hasil Belajar Semester';

        $this->_dv['pilihkelas']        = '';
        if($this->uri->segment(3)!='')
        {
            $this->_dv['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }

        $this->_dv['pilihmp']            = '';
        if($this->uri->segment(4)!='')
        {
            $this->_dv['pilihmp']        = $this->uri->segment(4);
        }

        $data['kd_mp']                   = $this->_dv['pilihmp'];
        $data['pilihkelas']              = $this->_dv['pilihkelas'];

        $this->_dv['kkm']                = $this->kkm_model->get_kkm($this->_kd_sekolah,$this->_th_ajar, $this->_p_nl, $this->_dv['pilihkelas'] , $this->_dv['pilihmp']);
        $this->_dv['df_mp']              = $this->mp_model->get_mpotorisasi($this->_kd_sekolah);
        $this->_dv['skelas']             = $this->kelas_model->getfilterotorisasi($this->_th_ajar,$this->_kd_sekolah);
        $nilai                           = $this->hasilbelajar_model->rapor_akhir($data);

        $data['nilai']                  = array();
        if($this->_dv['pilihkelas']!=='' && $this->_dv['pilihmp']!=='')
        {
            if ($nilai->num_rows()>0 )
            {
                $seq = 0;
                foreach($nilai->result() as $ntgh)
                {
                    $data['nilai'][$seq] = array();
                    $data['nilai'][$seq]['nis']   = $ntgh->nis;
                    $data['nilai'][$seq]['nm']    = $ntgh->nama_lengkap;
                    $data['nilai'][$seq]['tgh']   = array();

                    $UHT1    = $ntgh->UHT1;
                    $UHT2    = $ntgh->UHT2;
                    $UHT3    = $ntgh->UHT3;

                    $jmluht = $UHT1 + $UHT2 + $UHT3;
                    $h = ($UHT1 == '0' || $UHT1 == '' ) ? '0' : 1;
                    $l = ($UHT2 == '0' || $UHT2 == '' ) ? '0' : 1;
                    $j = ($UHT3 == '0' || $UHT3 == '' ) ? '0' : 1;
                    $k = $h + $l + $j;
                    //$UHT    = round(($k==0) ? 0 : $jmluht/$k);
					$UHT    = ($k==0) ? 0 : $jmluht/$k;

                    ///Nilai Praktek
                    $UHP1    = $ntgh->UHP1;
                    $UHP2    = $ntgh->UHP2;
                    $UHP3    = $ntgh->UHP3;

                    $jmluhp = $UHP1 + $UHP2 + $UHP3;
                    $hi = ($UHP1 == '0' || $UHP1 == '' ) ? '0' : 1;
                    $li = ($UHP2 == '0' || $UHP2 == '' ) ? '0' : 1;
                    $ji = ($UHP3 == '0' || $UHP3 == '' ) ? '0' : 1;
                    $ki = $hi + $li + $ji;
                    //$UHP    = round(($ki==0) ? 0 : $jmluhp/$ki);
					$UHP    = ($ki==0) ? 0 : $jmluhp/$ki;

                    $his = ($UHT == '0' || $UHT == '' ) ? '0' : 1;
                    $lis = ($UHP == '0' || $UHP == '' ) ? '0' : 1;
                    $kis = $his + $lis;
                    $UH   = ($kis==0) ? 0 : /*(round(($UHT + $UHP) / $kis))*/ (($UHT+$UHP)/$kis);

                    $data['nilai'][$seq]['tgh']['UH'] =  round($UH);//round($UH);

                    //Nilai TUGAS
                    $TGS1    = $ntgh->TGS1;
                    $TGS2    = $ntgh->TGS2;
                    $TGS3    = $ntgh->TGS3;
                    $jmltgs = $TGS1 + $TGS2 + $TGS3;
                    $ho = ($TGS1 == '0' || $TGS1 == '' ) ? '0' : 1;
                    $lo = ($TGS2 == '0' || $TGS2 == '' ) ? '0' : 1;
                    $jo = ($TGS3 == '0' || $TGS3 == '' ) ? '0' : 1;
                    $ko = $ho + $lo + $jo;
                    //$TGS    = round(($ko==0) ? 0 : $jmltgs/$ko);
					$TGS    = ($ko==0) ? 0 : $jmltgs/$ko;

                    $data['nilai'][$seq]['tgh']['TGS']  = round($TGS); //round($TGS);

                    //Nilai UTS
                    $UTST    = $ntgh->UTST;
                    $UTSP    = $ntgh->UTSP;
                    $jmluts = $UTST + $UTSP;
                    $ha = ($UTST == '0' || $UTST == '' ) ? '0' : 1;
                    $la = ($UTSP == '0' || $UTSP == '' ) ? '0' : 1;
                    $ka = $ha + $la;
                    //$UTS    = round(($ka==0) ? 0 : $jmluts/$ka);
					$UTS    = ($ka==0) ? 0 : $jmluts/$ka;

                    $data['nilai'][$seq]['tgh']['UTS'] = round($UTS);//round($UTS);

                    $RUTS = ($UH*0.3) + ($TGS*0.3) + ($UTS*0.4);
                    $data['nilai'][$seq]['tgh']['RUTS'] = round($RUTS);//round($RUTS);


                    //----------------- NILAI SETELAH MID-------------------------------------
                    $UHTA1    = $ntgh->UHTA1;
                    $UHTA2    = $ntgh->UHTA2;
                    $UHTA3    = $ntgh->UHTA3;

                    $jmluht = $UHTA1 + $UHTA2 + $UHTA3;
                    $h = ($UHTA1 == '0' || $UHTA1 == '' ) ? '0' : 1;
                    $l = ($UHTA2 == '0' || $UHTA2 == '' ) ? '0' : 1;
                    $j = ($UHTA3 == '0' || $UHTA3 == '' ) ? '0' : 1;
                    $k = $h + $l + $j;
                    //$UHTA    = round(($k==0) ? 0 : $jmluht/$k);
					$UHTA    = ($k==0) ? 0 : $jmluht/$k;

                    ///Nilai Praktek
                    $UHPA1    = $ntgh->UHPA1;
                    $UHPA2    = $ntgh->UHPA2;
                    $UHPA3    = $ntgh->UHPA3;

                    $jmluhp = $UHPA1 + $UHPA2 + $UHPA3;
                    $hi = ($UHPA1 == '0' || $UHPA1 == '' ) ? '0' : 1;
                    $li = ($UHPA2 == '0' || $UHPA2 == '' ) ? '0' : 1;
                    $ji = ($UHPA3 == '0' || $UHPA3 == '' ) ? '0' : 1;
                    $ki = $hi + $li + $ji;
                    //$UHPA    = round(($ki==0) ? 0 : $jmluhp/$ki);
					$UHPA    = ($ki==0) ? 0 : $jmluhp/$ki;

                    $his = ($UHTA == '0' || $UHTA == '' ) ? '0' : 1;
                    $lis = ($UHPA == '0' || $UHPA == '' ) ? '0' : 1;
                    $kis = $his + $lis;
                    $UHA   = ($kis==0) ? 0 : (round(($UHTA + $UHPA) / $kis));

                    $data['nilai'][$seq]['tgh']['UHA'] =  round($UHA);//round($UHA);

                    //Nilai TUGAS
                    $TGSA1    = $ntgh->TGSA1;
                    $TGSA2    = $ntgh->TGSA2;
                    $TGSA3    = $ntgh->TGSA3;
                    $jmltgs = $TGSA1 + $TGSA2 + $TGSA3;
                    $ho = ($TGSA1 == '0' || $TGSA1 == '' ) ? '0' : 1;
                    $lo = ($TGSA2 == '0' || $TGSA2 == '' ) ? '0' : 1;
                    $jo = ($TGSA3 == '0' || $TGSA3 == '' ) ? '0' : 1;
                    $ko = $ho + $lo + $jo;
                    //$TGSA    = round(($ko==0) ? 0 : $jmltgs/$ko);
                    $TGSA    = ($ko==0) ? 0 : $jmltgs/$ko;

                    $data['nilai'][$seq]['tgh']['TGSA']  = round($TGSA); //round($TGSA);

                    //Nilai UTS
                    $UTSTA    = $ntgh->UTSTA;
                    $UTSPA    = $ntgh->UTSPA;
                    $jmluts = $UTSTA + $UTSPA;
                    $ha = ($UTSTA == '0' || $UTSTA == '' ) ? '0' : 1;
                    $la = ($UTSPA == '0' || $UTSPA == '' ) ? '0' : 1;
                    $ka = $ha + $la;
                    $UTSA    = ($ka==0) ? 0 : $jmluts/$ka;

                    $data['nilai'][$seq]['tgh']['UTSA'] = round($UTSA); //round($UTSA);

                    $RUAS = ($UHA*0.3) + ($TGSA*0.3) + ($UTSA*0.4);
                    $data['nilai'][$seq]['tgh']['RUAS'] = round($RUAS);//round($RUAS);

                    $data['nilai'][$seq]['tgh']['RFINAL'] = round(($RUTS+$RUAS)/2);
                    //================= NILAI SETELAH MID =====================================

                    $seq++;
                }

            }
        }
		//print_r($data);die();
        $this->_dv['nilai'] =$data['nilai'];
        $this->load->view('hasil_belajar/rapor_akhir2',$this->_dv);
    }
    function rekap_nilai($kelas='0')
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Rekap Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $datas['pilihkelas']        = $this->input->post('kelas');
        $base_url                   = base_url().'index.php/hasilbelajar/rekap_nilai/'.$datas['pilihkelas'];
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');
        //$data['kelas']              = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kelas']              = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        //$data['kdmp']              = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
        $data['pilihkelas']         = '';
            if($this->input->post('filter'))
            {
                $data['pilihkelas']     = $this->input->post('kelas');
                $data['pilihnis']       = ($this->siswa_model->nama($data['pilihkelas'])->num_rows()>0) ? $this->siswa_model->nama($data['pilihkelas'])->row()->nis : '';
                $data['mp']             = $this->mp_model->getMpByKelas($data['pilihkelas']);
            }
        $data['tampil']             = ($this->input->post('kelas') =='' || $this->input->post('kelas') =='0') ? '' : 'a';
        $this->load->view('hasil_belajar/rekap_uts',$data);
    }
    function proses($kelas='0')
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Rekap Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $datas['pilihkelas']        = $this->input->post('kelas');
//        $base_url                   = base_url().'index.php/hasilbelajar/proses/'.$datas['pilihkelas'];
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');
        $data['kelas']              = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['pilihkelas']         = '';
            if($this->input->post('filter'))
            {
                $data['pilihkelas']     = $this->input->post('kelas');
                $data['pilihnis']       = ($this->siswa_model->nama($data['pilihkelas'])->num_rows()>0) ? $this->siswa_model->nama($data['pilihkelas'])->row()->nis : '';
                $data['mp']             = $this->mp_model->getMpByKelas($data['pilihkelas']);
            }
        $data['tampil']             = ($this->input->post('kelas') =='' || $this->input->post('kelas') =='0') ? '' : 'a';
        $this->load->view('hasil_belajar/proses',$data);
    }

    function proses2($kelas='0')
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Rekap Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');

        $data['kelas']              = $this->kelas_model->getfilterotorisasi($this->_th_ajar,$this->_kd_sekolah);
        $data['pilihkelas']         = $this->input->post('kelas');
        $data['siswa']              = $this->siswa_model->get_per_kelas($data['pilihkelas'],  $this->_kd_sekolah, $this->_th_ajar);

        if($this->input->post('filter'))
        {
            $data['mp']             = $this->mp_model->get_per_kelas($data['pilihkelas'],$this->_kd_sekolah, $this->_th_ajar, $this->_p_nl);

            if ($data['siswa']['hBaris']->num_rows()>0 )
            {
                $seq = 0;
                $dieksekusi = false;
                foreach ($data['siswa']['hBaris']->result() as $row)
                {
                    $data['nilai'][$seq] = array();
                    $data['nilai'][$seq]['nis']   = $row->nis;
                    $data['nilai'][$seq]['nm']    = $row->nama_lengkap;

                    $seq_mp = 0;

                    foreach($data['mp']->result() as $rmp)
                    {

                        $data['nilai'][$seq]['mp'][$seq_mp] = array();

                        $data['kd_mp']=$rmp->kd_mp;
                        $data['nilai'][$seq]['mp'][$seq_mp]['kd_mp'] =  $rmp->kd_mp;
                        $data['nilai'][$seq]['mp'][$seq_mp]['tgh']   = array();
                        $dieksekusi =false;
                        if(!$dieksekusi){
                            $nilai  = $this->hasilbelajar_model->rapor_akhir($data);

//                            if($seq_mp==1){
//                            echo $this->db->last_query();
//                            die();
//                            }
                        }
                        foreach($nilai->result() as $ntgh)
                        {
                            if (trim($ntgh->nis) === trim($row->nis))
                            {
                                $UHT1    = $ntgh->UHT1;
                                $UHT2    = $ntgh->UHT2;
                                $UHT3    = $ntgh->UHT3;

                                $jmluht = $UHT1 + $UHT2 + $UHT3;
                                $h = ($UHT1 == '0' || $UHT1 == '' ) ? '0' : 1;
                                $l = ($UHT2 == '0' || $UHT2 == '' ) ? '0' : 1;
                                $j = ($UHT3 == '0' || $UHT3 == '' ) ? '0' : 1;
                                $k = $h + $l + $j;
                                $UHT    = round(($k==0) ? 0 : $jmluht/$k);

                                ///Nilai Praktek
                                $UHP1    = $ntgh->UHP1;
                                $UHP2    = $ntgh->UHP2;
                                $UHP3    = $ntgh->UHP3;

                                $jmluhp = $UHP1 + $UHP2 + $UHP3;
                                $hi = ($UHP1 == '0' || $UHP1 == '' ) ? '0' : 1;
                                $li = ($UHP2 == '0' || $UHP2 == '' ) ? '0' : 1;
                                $ji = ($UHP3 == '0' || $UHP3 == '' ) ? '0' : 1;
                                $ki = $hi + $li + $ji;
                                $UHP    = round(($ki==0) ? 0 : $jmluhp/$ki);



                                $his = ($UHT == '0' || $UHT == '' ) ? '0' : 1;
                                $lis = ($UHP == '0' || $UHP == '' ) ? '0' : 1;
                                $kis = $his + $lis;
                                $UH   = ($kis==0) ? 0 : (round(($UHT + $UHP) / $kis));

                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['UH'] =  $UH;

                                //Nilai TUGAS
                                $TGS1    = $ntgh->TGS1;
                                $TGS2    = $ntgh->TGS2;
                                $TGS3    = $ntgh->TGS3;
                                $jmltgs = $TGS1 + $TGS2 + $TGS3;
                                $ho = ($TGS1 == '0' || $TGS1 == '' ) ? '0' : 1;
                                $lo = ($TGS2 == '0' || $TGS2 == '' ) ? '0' : 1;
                                $jo = ($TGS3 == '0' || $TGS3 == '' ) ? '0' : 1;
                                $ko = $ho + $lo + $jo;
                                $TGS    = round(($ko==0) ? 0 : $jmltgs/$ko);

                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['TGS']  = $TGS;

                                //Nilai UTS
                                $UTST    = $ntgh->UTST;
                                $UTSP    = $ntgh->UTSP;
                                $jmluts = $UTST + $UTSP;
                                $ha = ($UTST == '0' || $UTST == '' ) ? '0' : 1;
                                $la = ($UTSP == '0' || $UTSP == '' ) ? '0' : 1;
                                $ka = $ha + $la;
                                $UTS    = round(($ka==0) ? 0 : $jmluts/$ka);

                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['UTS'] = $UTS;

                                $RUTS = $UH*0.3 + $TGS*0.3 + $UTS*0.4;
                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['RUTS'] = $RUTS;

                                //----------------- NILAI SETELAH MID-------------------------------------
                                $UHTA1    = $ntgh->UHTA1;
                                $UHTA2    = $ntgh->UHTA2;
                                $UHTA3    = $ntgh->UHTA3;

                                $jmluht = $UHTA1 + $UHTA2 + $UHTA3;
                                $h = ($UHTA1 == '0' || $UHTA1 == '' ) ? '0' : 1;
                                $l = ($UHTA2 == '0' || $UHTA2 == '' ) ? '0' : 1;
                                $j = ($UHTA3 == '0' || $UHTA3 == '' ) ? '0' : 1;
                                $k = $h + $l + $j;
                                $UHTA    = round(($k==0) ? 0 : $jmluht/$k);

                                ///Nilai Praktek
                                $UHPA1    = $ntgh->UHPA1;
                                $UHPA2    = $ntgh->UHPA2;
                                $UHPA3    = $ntgh->UHPA3;

                                $jmluhp = $UHPA1 + $UHPA2 + $UHPA3;
                                $hi = ($UHPA1 == '0' || $UHPA1 == '' ) ? '0' : 1;
                                $li = ($UHPA2 == '0' || $UHPA2 == '' ) ? '0' : 1;
                                $ji = ($UHPA3 == '0' || $UHPA3 == '' ) ? '0' : 1;
                                $ki = $hi + $li + $ji;
                                $UHPA    = round(($ki==0) ? 0 : $jmluhp/$ki);

                                $his = ($UHTA == '0' || $UHTA == '' ) ? '0' : 1;
                                $lis = ($UHPA == '0' || $UHPA == '' ) ? '0' : 1;
                                $kis = $his + $lis;
                                $UHA   = ($kis==0) ? 0 : (round(($UHTA + $UHPA) / $kis));

                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['UHA'] =  round($UHA);

                                //Nilai TUGAS
                                $TGSA1    = $ntgh->TGSA1;
                                $TGSA2    = $ntgh->TGSA2;
                                $TGSA3    = $ntgh->TGSA3;
                                $jmltgs = $TGSA1 + $TGSA2 + $TGSA3;
                                $ho = ($TGSA1 == '0' || $TGSA1 == '' ) ? '0' : 1;
                                $lo = ($TGSA2 == '0' || $TGSA2 == '' ) ? '0' : 1;
                                $jo = ($TGSA3 == '0' || $TGSA3 == '' ) ? '0' : 1;
                                $ko = $ho + $lo + $jo;
                                $TGSA    = round(($ko==0) ? 0 : $jmltgs/$ko);

                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['TGSA']  = round($TGSA);

                                //Nilai UTS
                                $UTSTA    = $ntgh->UTSTA;
                                $UTSPA    = $ntgh->UTSPA;
                                $jmluts = $UTSTA + $UTSPA;
                                $ha = ($UTSTA == '0' || $UTSTA == '' ) ? '0' : 1;
                                $la = ($UTSPA == '0' || $UTSPA == '' ) ? '0' : 1;
                                $ka = $ha + $la;
                                $UTSA    = round(($ka==0) ? 0 : $jmluts/$ka);

                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['UTSA'] = round($UTSA);

                                $RUAS = $UHA*0.3 + $TGSA*0.3 + $UTSA*0.4;
                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['RUAS'] = round($RUAS);

                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['RFINAL'] = round(($RUTS+$RUAS)/2);
                                //================= NILAI SETELAH MID =====================================
                            }
                        }
                        $seq_mp++;
                    }
                    $seq++;
                }
            }
        }












//         print_r($data['nilai']);die();
        $data['tampil']             = ($this->input->post('kelas') =='' || $this->input->post('kelas') =='0') ? '' : 'a';
        $this->load->view('hasil_belajar/proses2',$data);
    }

    function proses3($kelas='0')
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Rekap Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');

        $data['kelas']              = $this->kelas_model->getfilterotorisasi($this->_th_ajar,$this->_kd_sekolah);
        $data['pilihkelas']         = $this->input->post('kelas');
        $data['siswa']              = $this->siswa_model->get_per_kelas($data['pilihkelas'],  $this->_kd_sekolah, $this->_th_ajar);

        if($this->input->post('filter'))
        {
            $data['mp']             = $this->mp_model->get_per_kelas($data['pilihkelas'],$this->_kd_sekolah, $this->_th_ajar, $this->_p_nl);
            $seq_mp = 0;
            foreach($data['mp']->result() as $rmp)
            {
                $data['kd_mp']=$rmp->kd_mp;
                $nilai  = $this->hasilbelajar_model->rapor_akhir($data);

                $seq = 0;
                foreach($nilai->result() as $ntgh)
                {

                    if ($seq_mp==0)
                    {
                        $data['nilai'][$seq] = array();
                        $data['nilai'][$seq]['nis']   = $ntgh->nis;
                        $data['nilai'][$seq]['nm']    = $ntgh->nama_lengkap;
                    }

                    $data['nilai'][$seq]['mp'][$seq_mp] = array();
                    $data['nilai'][$seq]['mp'][$seq_mp]['kd_mp'] =  $rmp->kd_mp;
                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']   = array();

                    $UHT1    = $ntgh->UHT1;
                    $UHT2    = $ntgh->UHT2;
                    $UHT3    = $ntgh->UHT3;

                    $jmluht = $UHT1 + $UHT2 + $UHT3;
                    $h = ($UHT1 == '0' || $UHT1 == '' ) ? '0' : 1;
                    $l = ($UHT2 == '0' || $UHT2 == '' ) ? '0' : 1;
                    $j = ($UHT3 == '0' || $UHT3 == '' ) ? '0' : 1;
                    $k = $h + $l + $j;
                    $UHT    = round(($k==0) ? 0 : $jmluht/$k);

                    ///Nilai Praktek
                    $UHP1    = $ntgh->UHP1;
                    $UHP2    = $ntgh->UHP2;
                    $UHP3    = $ntgh->UHP3;

                    $jmluhp = $UHP1 + $UHP2 + $UHP3;
                    $hi = ($UHP1 == '0' || $UHP1 == '' ) ? '0' : 1;
                    $li = ($UHP2 == '0' || $UHP2 == '' ) ? '0' : 1;
                    $ji = ($UHP3 == '0' || $UHP3 == '' ) ? '0' : 1;
                    $ki = $hi + $li + $ji;
                    $UHP    = round(($ki==0) ? 0 : $jmluhp/$ki);



                    $his = ($UHT == '0' || $UHT == '' ) ? '0' : 1;
                    $lis = ($UHP == '0' || $UHP == '' ) ? '0' : 1;
                    $kis = $his + $lis;
                    $UH   = ($kis==0) ? 0 : (round(($UHT + $UHP) / $kis));

                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['UH'] =  $UH;

                    //Nilai TUGAS
                    $TGS1    = $ntgh->TGS1;
                    $TGS2    = $ntgh->TGS2;
                    $TGS3    = $ntgh->TGS3;
                    $jmltgs = $TGS1 + $TGS2 + $TGS3;
                    $ho = ($TGS1 == '0' || $TGS1 == '' ) ? '0' : 1;
                    $lo = ($TGS2 == '0' || $TGS2 == '' ) ? '0' : 1;
                    $jo = ($TGS3 == '0' || $TGS3 == '' ) ? '0' : 1;
                    $ko = $ho + $lo + $jo;
                    $TGS    = round(($ko==0) ? 0 : $jmltgs/$ko);

                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['TGS']  = $TGS;

                    //Nilai UTS
                    $UTST    = $ntgh->UTST;
                    $UTSP    = $ntgh->UTSP;
                    $jmluts = $UTST + $UTSP;
                    $ha = ($UTST == '0' || $UTST == '' ) ? '0' : 1;
                    $la = ($UTSP == '0' || $UTSP == '' ) ? '0' : 1;
                    $ka = $ha + $la;
                    $UTS    = round(($ka==0) ? 0 : $jmluts/$ka);

                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['UTS'] = $UTS;

                    $RUTS = $UH*0.3 + $TGS*0.3 + $UTS*0.4;
                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['RUTS'] = $RUTS;

                    //----------------- NILAI SETELAH MID-------------------------------------
                    $UHTA1    = $ntgh->UHTA1;
                    $UHTA2    = $ntgh->UHTA2;
                    $UHTA3    = $ntgh->UHTA3;

                    $jmluht = $UHTA1 + $UHTA2 + $UHTA3;
                    $h = ($UHTA1 == '0' || $UHTA1 == '' ) ? '0' : 1;
                    $l = ($UHTA2 == '0' || $UHTA2 == '' ) ? '0' : 1;
                    $j = ($UHTA3 == '0' || $UHTA3 == '' ) ? '0' : 1;
                    $k = $h + $l + $j;
                    $UHTA    = round(($k==0) ? 0 : $jmluht/$k);

                    ///Nilai Praktek
                    $UHPA1    = $ntgh->UHPA1;
                    $UHPA2    = $ntgh->UHPA2;
                    $UHPA3    = $ntgh->UHPA3;

                    $jmluhp = $UHPA1 + $UHPA2 + $UHPA3;
                    $hi = ($UHPA1 == '0' || $UHPA1 == '' ) ? '0' : 1;
                    $li = ($UHPA2 == '0' || $UHPA2 == '' ) ? '0' : 1;
                    $ji = ($UHPA3 == '0' || $UHPA3 == '' ) ? '0' : 1;
                    $ki = $hi + $li + $ji;
                    $UHPA    = round(($ki==0) ? 0 : $jmluhp/$ki);

                    $his = ($UHTA == '0' || $UHTA == '' ) ? '0' : 1;
                    $lis = ($UHPA == '0' || $UHPA == '' ) ? '0' : 1;
                    $kis = $his + $lis;
                    $UHA   = ($kis==0) ? 0 : (round(($UHTA + $UHPA) / $kis));

                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['UHA'] =  round($UHA);

                    //Nilai TUGAS
                    $TGSA1    = $ntgh->TGSA1;
                    $TGSA2    = $ntgh->TGSA2;
                    $TGSA3    = $ntgh->TGSA3;
                    $jmltgs = $TGSA1 + $TGSA2 + $TGSA3;
                    $ho = ($TGSA1 == '0' || $TGSA1 == '' ) ? '0' : 1;
                    $lo = ($TGSA2 == '0' || $TGSA2 == '' ) ? '0' : 1;
                    $jo = ($TGSA3 == '0' || $TGSA3 == '' ) ? '0' : 1;
                    $ko = $ho + $lo + $jo;
                    $TGSA    = round(($ko==0) ? 0 : $jmltgs/$ko);

                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['TGSA']  = round($TGSA);

                    //Nilai UTS
                    $UTSTA    = $ntgh->UTSTA;
                    $UTSPA    = $ntgh->UTSPA;
                    $jmluts = $UTSTA + $UTSPA;
                    $ha = ($UTSTA == '0' || $UTSTA == '' ) ? '0' : 1;
                    $la = ($UTSPA == '0' || $UTSPA == '' ) ? '0' : 1;
                    $ka = $ha + $la;
                    $UTSA    = round(($ka==0) ? 0 : $jmluts/$ka);

                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['UTSA'] = round($UTSA);

                    $RUAS = $UHA*0.3 + $TGSA*0.3 + $UTSA*0.4;
                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['RUAS'] = round($RUAS);

                    if ($this->_sub_pnl=='UTS')
                    {
                        $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['RFINAL'] = round(($RUTS));
                    }
                    else
                    {
                        $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['RFINAL'] = round(($RUTS+$RUAS)/2);
                    }


                    //================= NILAI SETELAH MID =====================================

                    $seq++;
                }
                $seq_mp++;
            }
        }

//         print_r($data['nilai']);die();
        $data['tampil']             = ($this->input->post('kelas') =='' || $this->input->post('kelas') =='0') ? '' : 'a';
        $this->load->view('hasil_belajar/proses4',$data);
    }

    function simpan_proses()
    {
        //print_r($this->input->post());
        $data['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $data['th_ajar']                = $this->session->userdata('th_ajar');
        $data['p_nl']                   = $this->session->userdata('kd_semester');
        $data['kelas']                  = $this->input->post('kelas');
        $semuanis                       = $this->input->post('nis');
        for($i=0;$i<count($semuanis);$i++)
        {
            $kd_mp                      = $this->input->post('kd_mp'.$i);
            $kgn                        = $this->input->post('kgn');
            for($j=0;$j<count($kd_mp);$j++)
            {
                $data['nis']            = $semuanis[$i];
                $data['kd_mp']          = $kd_mp[$j];
                $data['kgn']            = $kgn[$j][$i];
                $cek                    = $this->hasilbelajar_model->proses_nilai($data);

                if($cek->num_rows() > 0 )
                    {
                        $this->hasilbelajar_model->updatenl($data);
                    }
                else
                    {
                        $this->hasilbelajar_model->simpannl($data);
                    }
            }
        }
        redirect('hasilbelajar/proses3');
    }
    function rekap_nilai2($kelas='0')
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->_kd_sekolah)->nama_sekolah;
        $data['title']              = ' | Rekap Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');

        $data['kelas']              = $this->kelas_model->getfilterotorisasi($this->_th_ajar,$this->_kd_sekolah);
        $data['pilihkelas']         = $this->input->post('kelas');
        $data['siswa']              = $this->siswa_model->get_per_kelas($data['pilihkelas'],  $this->_kd_sekolah, $this->_th_ajar);

        if($this->input->post('filter'))
        {
            $data['mp']             = $this->mp_model->get_per_kelas($data['pilihkelas'],$this->_kd_sekolah, $this->_th_ajar, $this->_p_nl);
            if ($data['siswa']['hBaris']->num_rows()>0 )
            {
                $seq = 0;
                $dieksekusi = false;
                foreach ($data['siswa']['hBaris']->result() as $row)
                {
                    $data['nilai'][$seq] = array();
                    $data['nilai'][$seq]['nis']   = $row->nis;
                    $data['nilai'][$seq]['nm']    = $row->nama_lengkap;

                    $seq_mp = 0;
                    foreach($data['mp']->result() as $rmp)
                    {

                        $data['nilai'][$seq]['mp'][$seq_mp] = array();

                        $data['kd_mp']=$rmp->kd_mp;
                        $data['nilai'][$seq]['mp'][$seq_mp]['kd_mp'] =  $rmp->kd_mp;
                        $data['nilai'][$seq]['mp'][$seq_mp]['tgh']   = array();

                        $dieksekusi = false;
                        if(!$dieksekusi){
                            $nilai  = $this->nilai_raport($rmp->kd_mp, $rmp->nm_mp, $rmp->urutan);
                            $dieksekusi =true;
                        }

                        foreach($nilai as $ntgh)
                        {
                            // if (trim($ntgh->nis) === trim($row->nis))
                            // {
                                $nilai_akhir        = $ntgh->KGN;
                                $nilai_akhir_psk    = $ntgh->PSK;
                                
                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['NA'] = $nilai_akhir;
                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['NA_PSK'] = $nilai_akhir_psk;

                            // }
                        }
                        $seq_mp++;
                    }
                    $seq++;
                }
            }
        }
        $this->load->view('hasil_belajar/rekap_uts2',$data);
    }
    function rekap_nilai3($kelas=0,$mp=0)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->_kd_sekolah)->nama_sekolah;
        $data['title']              = ' | Rekap Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');

        $data['kelas']              = $this->kelas_model->getfilterotorisasi($this->_th_ajar,$this->_kd_sekolah);
        $data['pilihkelas']         = $this->input->post('kelas');
        $data['siswa']              = $this->siswa_model->get_per_kelas($data['pilihkelas'],  $this->_kd_sekolah, $this->_th_ajar);
        if($this->input->post('filter'))
        {
            $data['mp']             = $this->mp_model->get_per_kelas($data['pilihkelas'],$this->_kd_sekolah, $this->_th_ajar, $this->_p_nl);
            if ($data['siswa']['hBaris']->num_rows()>0 )
            {
                $seq = 0;
                $dieksekusi = false;
                foreach ($data['siswa']['hBaris']->result() as $row)
                {
                    $data['nilai'][$seq] = array();
                    $data['nilai'][$seq]['nis']   = $row->nis;
                    $data['nilai'][$seq]['nm']    = $row->nama_lengkap;

                    $seq_mp = 0;
                    foreach($data['mp']->result() as $rmp)
                    {

                        $data['nilai'][$seq]['mp'][$seq_mp] = array();

                        $data['kd_mp']=$rmp->kd_mp;
                        $data['nilai'][$seq]['mp'][$seq_mp]['kd_mp'] =  $rmp->kd_mp;
                        $data['nilai'][$seq]['mp'][$seq_mp]['tgh']   = array();

                        $dieksekusi = false;
                        if(!$dieksekusi){
                            $nilai  = $this->hasilbelajar_model->nl_ips($data);
                            $dieksekusi =true;
                        }

                        foreach($nilai->result() as $ntgh)
                        {
                            if (trim($ntgh->nis) === trim($row->nis))
                            {
                                $nilai_akhir        = $ntgh->KGN;
                                $nilai_akhir_psk    = $ntgh->PSK;
                                
                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['NA']     = $nilai_akhir;
                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['NA_PSK'] = $nilai_akhir_psk;
                            }
                        }
                        $seq_mp++;
                    }
                    $seq++;
                }
            }
        }
        $this->load->view('hasil_belajar/rekap_uts3',$data);
    }
    function rekap_nilai4($kelas=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Rekap Hasil Belajar Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['siswa_kgn']              = $this->hasilbelajar_model->nama($data['pilihkelas']);
        $data['siswa_psk']              = $this->hasilbelajar_model->nama($data['pilihkelas']);
        $data['mp_kelas']           = $this->hasilbelajar_model->mp_kelas($data['pilihkelas']);
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');
        $data['tampil']             = ($data['pilihkelas'] =='' || $data['pilihkelas'] =='0') ? '' : 'a';
        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['hasilbelajar_kgn']       = $this->hasilbelajar_model->nilai_rapor_kgn_k13_2($data['pilihkelas']);
        $data['hasilbelajar_kgn_pts']   = $this->hasilbelajar_model->nilai_rapor_kgn_pts_k13_2($data['pilihkelas']);
        $data['hasilbelajar_kgn_pas']   = $this->hasilbelajar_model->nilai_rapor_kgn_pas_k13_2($data['pilihkelas']);

        $data['hasilbelajar_psk']       = $this->hasilbelajar_model->nilai_rapor_psk_k13_2($data['pilihkelas']);
        $data['hasilbelajar_psk_pts']   = $this->hasilbelajar_model->nilai_rapor_psk_pts_k13_2($data['pilihkelas']);
        $data['hasilbelajar_psk_pas']   = $this->hasilbelajar_model->nilai_rapor_psk_k13_2($data['pilihkelas']);

        // Group NIS
        // KGN =========================================================================
        $seq_nis                    = 0;
        $data['arrNis']             = array();
        $data['nilai_akhir']        = array();
        foreach ($data['siswa_kgn']->result() as $rows) {
            $like = $rows->nis;
            $filter_nis = array_filter($data['hasilbelajar_kgn'], function ($item) use ($like) {
                if (stripos($item['nis'], $like) !== false) {
                    return true;
                }
                return false;
            });
            $like_nis_pts = $rows->nis;
            $filter_nis_pts = array_filter($data['hasilbelajar_kgn_pts'], function ($item_pts) use ($like_nis_pts) {
                if (stripos($item_pts['nis'], $like_nis_pts) !== false) {
                    return true;
                }
                return false;
            });
            $like_nis_pas = $rows->nis;
            $filter_nis_pas = array_filter($data['hasilbelajar_kgn_pas'], function ($item_pas) use ($like_nis_pas) {
                if (stripos($item_pas['nis'], $like_nis_pas) !== false) {
                    return true;
                }
                return false;
            });
            $data['nilai_akhir']['NIS'] = $rows->nis;

            // Group Mata Pelajaran
            $seq_mp                             = 0;
            $data['nilai_akhir'][$seq_nis]      = array();
            foreach ($data['mp_kelas']->result() as $rows_mp) {
                    $like_mp = $rows_mp->kd_mp;
                    $filter_mp = array_filter($filter_nis, function ($item_mp) use ($like_mp) {
                        if (stripos($item_mp['kd_mp'], $like_mp) !== false) {
                            return true;
                        }
                        return false;
                    });
                    $like_mp_pts = $rows_mp->kd_mp;
                    $filter_mp_pts = array_filter($filter_nis_pts, function ($item_mp_pts) use ($like_mp_pts) {
                        if (stripos($item_mp_pts['kd_mp'], $like_mp_pts) !== false) {
                            return true;
                        }
                        return false;
                    });
                    $like_mp_pas = $rows_mp->kd_mp;
                    $filter_mp_pas = array_filter($filter_nis_pas, function ($item_mp_pas) use ($like_mp_pas) {
                        if (stripos($item_mp_pas['kd_mp'], $like_mp_pas) !== false) {
                            return true;
                        }
                        return false;
                    });
                    $data['nilai_akhir'][$seq_nis][$seq_mp] = $this->hitung_nilai($kelas,$filter_mp, $filter_mp_pts, $filter_mp_pas, $like_mp);
                $seq_mp++;
            }
            $data['arrNis'][$seq_nis]   = $filter_nis;
            $seq_nis++;
        }
        // END KGN =================================================================================

        // PSK =========================================================================
        $seq_nis                    = 0;
        $data['arrNis']             = array();
        $data['nilai_akhir_psk']        = array();
        foreach ($data['siswa_psk']->result() as $rows) {
            $like = $rows->nis;
            $filter_nis = array_filter($data['hasilbelajar_psk'], function ($item) use ($like) {
                if (stripos($item['nis'], $like) !== false) {
                    return true;
                }
                return false;
            });
            $like_nis_pts = $rows->nis;
            $filter_nis_pts = array_filter($data['hasilbelajar_psk_pts'], function ($item_pts) use ($like_nis_pts) {
                if (stripos($item_pts['nis'], $like_nis_pts) !== false) {
                    return true;
                }
                return false;
            });
            $like_nis_pas = $rows->nis;
            $filter_nis_pas = array_filter($data['hasilbelajar_psk_pas'], function ($item_pas) use ($like_nis_pas) {
                if (stripos($item_pas['nis'], $like_nis_pas) !== false) {
                    return true;
                }
                return false;
            });
            $data['nilai_akhir_psk']['NIS'] = $rows->nis;

            // Group Mata Pelajaran
            $seq_mp                             = 0;
            $data['nilai_akhir_psk'][$seq_nis]      = array();
            foreach ($data['mp_kelas']->result() as $rows_mp) {
                    $like_mp = $rows_mp->kd_mp;
                    $filter_mp = array_filter($filter_nis, function ($item_mp) use ($like_mp) {
                        if (stripos($item_mp['kd_mp'], $like_mp) !== false) {
                            return true;
                        }
                        return false;
                    });
                    $like_mp_pts = $rows_mp->kd_mp;
                    $filter_mp_pts = array_filter($filter_nis_pts, function ($item_mp_pts) use ($like_mp_pts) {
                        if (stripos($item_mp_pts['kd_mp'], $like_mp_pts) !== false) {
                            return true;
                        }
                        return false;
                    });
                    $like_mp_pas = $rows_mp->kd_mp;
                    $filter_mp_pas = array_filter($filter_nis_pas, function ($item_mp_pas) use ($like_mp_pas) {
                        if (stripos($item_mp_pas['kd_mp'], $like_mp_pas) !== false) {
                            return true;
                        }
                        return false;
                    });
                    $data['nilai_akhir_psk'][$seq_nis][$seq_mp] = $this->hitung_nilai_psk($kelas,$filter_mp, $filter_mp_pts, $filter_mp_pas, $like_mp);
                $seq_mp++;
            }
            $data['arrNis'][$seq_nis]   = $filter_nis;
            $seq_nis++;
        }
        // END PSK =================================================================================
        $this->load->view('hasil_belajar/rekap_raport',$data);
    }

    function rekap_nilai5($kelas=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Rekap Hasil Belajar Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['siswa_kgn']          = $this->hasilbelajar_model->nama($data['pilihkelas']);
        $data['siswa_psk']          = $this->hasilbelajar_model->nama($data['pilihkelas']);
        $data['mp_kelas']           = $this->hasilbelajar_model->mp_kelas($data['pilihkelas']);
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');
        $data['tampil']             = ($data['pilihkelas'] =='' || $data['pilihkelas'] =='0') ? '' : 'a';
        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        
        $data['getmapel']           = $this->hasilbelajar_model->getrekap($data['pilihkelas']);
        $data['getnilai']           = $this->hasilbelajar_model->getrekapnilai($data['pilihkelas'])->result();

        $this->load->view('hasil_belajar/rekap_raport',$data);
    }

    function hitung_nilai($kelas,$filter_mp, $filter_mp_pts, $filter_mp_pas, $kd_mp)
    {
        // $data['kelas']              = $kelas;
        // $data['p_nl']               = $this->session->userdata('kd_semester');
        // $data['tk']                 = $this->kelas_model->get($data['kelas'])->row()->tingkat;
        // $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        // $data['th_ajar']            = $this->session->userdata('th_ajar');
        
        // $data['kompetensi_kgn']     = $this->kompetensi_model->get_kompetensi_rpt($data['p_nl'],$data['tk'],$data['kd_sekolah'],$data['th_ajar'],'ki3',$kd_mp);
        // $k              = 0;
        // $arrNaKd        = array();
        // $arrKetKd       = array();
        // foreach($data['kompetensi_kgn']->result() as $rowKd) {
        //     $arrNaKd[$k]    = $naKd;
        //     $arrKetKd[$k]   = $rowKd->ket_kd;
        //     $k++;
        // }
        // Nilai Harian ------------------------------------------------------------
        $arrKdGroup = array();
        $RTKD       = 0;
        $seq        = 0;
        $like_nh    = 'NH';
        $filter_nh  = array_filter($filter_mp, function ($item_nh) use ($like_nh) {
            if (stripos($item_nh['kd_tagihan'], $like_nh) !== false) {
                return true;
            }
            return false;
        });

        $group_kd   = array();
        foreach ($filter_nh as $fmp) {
            $kd     = $fmp['kd_kd'];
            $nh     = $fmp['kd_tagihan'];
            $kgn    = $fmp['kgn'];
            
            $group_kd[$kd][$nh] = $kgn;

        }
        // print_r($group_kd);
        // $sum_nh = 0;
        $seq_nh = 0;
        $rtNhKd = array();
        $nhKd   = array();
        foreach ($group_kd as $keyNh => $valNh) {
            $kdJmh      = array_sum($valNh);
            $kdCount    = count($valNh);
            $rtNhKd[$seq_nh]= $kdJmh / $kdCount;
            $nhKd[$seq_nh]  = $keyNh;
            $seq_nh++;
            // $NAKD = ((2 * $RTKD) + $RTPAS) / 3;


            // $sum_nh+= $RTKD;
        }
        $RTNH = array_combine($nhKd, $rtNhKd);
        // print_r($RTNH);
        // $nhDvd  = ($seq_nh == 0) ? 1 : $seq_nh;
        // $RTNH   = $sum_nh / $nhDvd;
        // Nilai Nilai Harian ---------------------------------------------------

        // Nilai PTS ------------------------------------------------------------
        $like_pts    = 'PAS';
        $filter_pts  = array_filter($filter_mp_pts, function ($item_pas) use ($like_pts) {
            if (stripos($item_pas['kd_tagihan'], $like_pts) !== false) {
                return true;
            }
            return false;
        });
        $like_pas    = 'PAS';
        $filter_pas  = array_filter($filter_mp_pas, function ($item_pas) use ($like_pas) {
            if (stripos($item_pas['kd_tagihan'], $like_pas) !== false) {
                return true;
            }
            return false;
        });
        // print_r($filter_pas);
        // $sum_pas    = 0;
        $seq_pts = 0;
        $kd_pts  = array();
        $kgn_pts = array();
        foreach ($filter_pts as $row_pts) {
            $kd_pts[$seq_pts]  = $row_pts['kd_kd'];
            $kgn_pts[$seq_pts] = $row_pts['kgn'];
            $seq_pts++;
        }
        $PTS_KD = array_combine($kd_pts, $kgn_pts);
        // print_r($PTS_KD);
        
        $seq_pas = 0;
        $kd_pas  = array();
        $kgn_pas = array();
        foreach ($filter_pas as $row_pas) {
            $kd_pas[$seq_pas]  = $row_pas['kd_kd'];
            $kgn_pas[$seq_pas] = $row_pas['kgn'];
            $seq_pas++;
        }
        $PAS_KD = array_combine($kd_pas, $kgn_pas);
        // print_r($PAS_KD);

        // $c = array_map(function () {
        //     return array_sum(func_get_args());
        // }, $PTS_KD, $PAS_KD);

        // print_r($c);


        $result = array();
        $dibagi = array();
        $values = array($PTS_KD, $PAS_KD);
        
        foreach($RTNH as $index => $key) {
            $t    = array();
            $bagi = array();
            $i    = 0;
            foreach($values as $value) {
                $t[] = isset($value[$index]) ? $value[$index] : 0 ;
                if ($t[0] == 0) {
                    $bagi = 3;
                } elseif ($t[1] == 0) {
                    $bagi = 3;
                } else {
                    $bagi = 4;
                }
                $i++;
            }
            $result[$index]  = $t;
            $dibagi[$index]  = $bagi;
        }
      // print_r($result);
      // print_r($dibagi);
      $sum_pas_kd_kgn = array();
      $pas_kd = array();
      $seq_pas_kd = 0;
      foreach ($result as $key_pas_kd => $value_pas_kd) {
          $pas_kd[$seq_pas_kd] = $key_pas_kd;
          $sum_pas_kd_kgn[$seq_pas_kd] = array_sum($value_pas_kd);
          $seq_pas_kd++;
          // echo $sum_pas_kd.'<br>';
      }
      $jmh_pas_kd = array_combine($pas_kd, $sum_pas_kd_kgn);
      // print_r($jmh_pas_kd);

      $seq_nh_kd = 0;
      $nh_kd     = array();
      $na_nh_kd  = array();
      foreach ($RTNH as $key_nh_kd => $value_kd) {
          $na_nh_kd[$seq_nh_kd] = 2 * $value_kd;
          $nh_kd[$seq_nh_kd] = $key_nh_kd;
          $seq_nh_kd++;
          // echo $na_nh_kd.'<br>';
      }
      $jmh_nh_kd = array_combine($nh_kd, $na_nh_kd);
      // print_r($jmh_nh_kd);

        $result_na = array();
        $values_na = array($jmh_nh_kd, $jmh_pas_kd);
        
        foreach($RTNH as $index_na => $key_na) {
            $j = array();
            foreach($values_na as $value_na) {
                $j[] = isset($value_na[$index_na]) ? $value_na[$index_na] : 0;
            }
            $result_na[$index_na]  = $j;
        }
      // print_r($result_na);

      $sum_na_kd_kgn = array();
      $na_kd = array();
      $seq_na_kd = 0;
      foreach ($result_na as $key_na_kd => $value_na_kd) {
          $na_kd[$seq_na_kd] = $key_na_kd;
          $sum_na_kd_kgn[$seq_na_kd] = array_sum($value_na_kd);
          $seq_na_kd++;
          // echo $sum_pas_kd.'<br>';
      }
      $jmh_na_kd = array_combine($na_kd, $sum_na_kd_kgn);
      // print_r($jmh_na_kd);

      $result_na_kd = array();
        $values_na_kd = array($jmh_na_kd, $dibagi);
        
        foreach($RTNH as $index_na_kd => $key_na_kd) {
            $k = array();
            foreach($values_na_kd as $value_na_kd) {
                $k[] = isset($value_na_kd[$index_na_kd]) ? $value_na_kd[$index_na_kd] : 0;
            }
            $result_na_kd[$index_na_kd]  = $k;
        }
        // print_r($result_na_kd);

          $quot_hsl_kd_kgn = array();
          $hsl_kd = array();
          $seq_hsl_kd = 0;
          foreach ($result_na_kd as $key_hsl_kd => $value_hsl_kd) {
              $hsl_kd[$seq_hsl_kd] = $key_hsl_kd;
              if ($value_hsl_kd[1] == 0) {
                echo "";
              } else {
                $quot_hsl_kd_kgn[$seq_hsl_kd] = ($value_hsl_kd[0] / $value_hsl_kd[1]);                
              }
              $seq_hsl_kd++;
              // echo $sum_pas_kd.'<br>';
          }
          // $seq_hsl = ($seq_hsl_kd == 0 || $seq_hsl_kd == '0' || $seq_hsl_kd == '') ? 0 : $seq_hsl_kd;
          if ($seq_hsl_kd == 0) {
              $NA = 0;
          } else {
              $NA = array_sum($quot_hsl_kd_kgn) / $seq_hsl_kd;
          }
          // print_r($jmh_hsl_kd);

      // echo $sum_pas_kd;


        // $NAKD = 0;
        // $seq_kd = 0;
        // foreach ($RTNH as $key_kd => $value_kd) {
            
        // }
        // foreach ($PTS_KD as $key_pts => $value_pts) {
        //     foreach ($PAS_KD as $key_pas => $value_pas) {
        //         if ($key_kd == $key_pts || $key_kd == $key_pas) {
        //             // echo $value_kd.' '.$value_pts.' '.$value_pas.'<br>';
        //             $NAKD+= ((2 * $value_kd) + $value_pas) / 3;
        //             // echo $NAKD.'<br>';
        //             $seq_kd++;
        //         }    
        //     }
        // }


        // $NA = $NAKD/$seq_kd;
        // $pasDvdJmh = ($seq_pas == 0) ? 1 : $seq_pas;
        // $RTPAS = $sum_pas / $pasDvdJmh;
        // End NILAI PTS ------------------------------------------------------------

        // $filterNaMinKgn = (($arrCombKgn != 0) ? round(min(array_keys($arrCombKgn))) : 0);
        // if ($filterNaMinKgn <= 70) {
        //     $brs        = 'Ananda mampu '.$naMax.' perlu pembinaan dalam '.$desMin;
        // } else {
        //     $brs        = 'Ananda mampu '.$naMax;
        // }
        // $NA = ((2 * $RTNH) + $RTPAS) / 3;
        $data['nilai_akhir']['RFINALKGN'] = round($NA) ? round($NA) : 0;
        $data['nilai_akhir']['KDMP'] = $kd_mp;
        // $data['nilai_akhir']['NADESK'] = $brs;
        return $data['nilai_akhir'];
    }
    function hitung_nilai_psk($kelas,$filter_mp, $filter_mp_pts, $filter_mp_pas, $kd_mp)
    {
        $arrKdGroup = array();
        $RTKD       = 0;
        $seq        = 0;
        $like_nh    = 'NH';
        $filter_nh  = array_filter($filter_mp, function ($item_nh) use ($like_nh) {
            if (stripos($item_nh['kd_tagihan'], $like_nh) !== false) {
                return true;
            }
            return false;
        });

        $group_kd   = array();
        foreach ($filter_nh as $fmp) {
            $kd     = $fmp['kd_kd'];
            $nh     = $fmp['kd_tagihan'];
            $kgn    = $fmp['kgn'];
            
            $group_kd[$kd][$nh] = $kgn;

        }
        $seq_nh = 0;
        $rtNhKd = array();
        $nhKd   = array();
        foreach ($group_kd as $keyNh => $valNh) {
            $kdJmh      = array_sum($valNh);
            $kdCount    = count($valNh);
            $rtNhKd[$seq_nh]= $kdJmh / $kdCount;
            $nhKd[$seq_nh]  = $keyNh;
            $seq_nh++;
        }
        $RTNH = array_combine($nhKd, $rtNhKd);
        // Nilai Nilai Harian ---------------------------------------------------

        // Nilai PTS ------------------------------------------------------------
        $like_pts    = 'PAS';
        $filter_pts  = array_filter($filter_mp_pts, function ($item_pas) use ($like_pts) {
            if (stripos($item_pas['kd_tagihan'], $like_pts) !== false) {
                return true;
            }
            return false;
        });
        $like_pas    = 'PAS';
        $filter_pas  = array_filter($filter_mp_pas, function ($item_pas) use ($like_pas) {
            if (stripos($item_pas['kd_tagihan'], $like_pas) !== false) {
                return true;
            }
            return false;
        });
        $seq_pts = 0;
        $kd_pts  = array();
        $kgn_pts = array();
        foreach ($filter_pts as $row_pts) {
            $kd_pts[$seq_pts]  = $row_pts['kd_kd'];
            $kgn_pts[$seq_pts] = $row_pts['kgn'];
            $seq_pts++;
        }
        $PTS_KD = array_combine($kd_pts, $kgn_pts);
        
        $seq_pas = 0;
        $kd_pas  = array();
        $kgn_pas = array();
        foreach ($filter_pas as $row_pas) {
            $kd_pas[$seq_pas]  = $row_pas['kd_kd'];
            $kgn_pas[$seq_pas] = $row_pas['kgn'];
            $seq_pas++;
        }
        $PAS_KD = array_combine($kd_pas, $kgn_pas);
        $result = array();
        $dibagi = array();
        $values = array($PTS_KD, $PAS_KD);
        
        foreach($RTNH as $index => $key) {
            $t    = array();
            $bagi = array();
            $i    = 0;
            foreach($values as $value) {
                $t[] = isset($value[$index]) ? $value[$index] : 0 ;
                if ($t[0] == 0) {
                    $bagi = 3;
                } elseif ($t[1] == 0) {
                    $bagi = 3;
                } else {
                    $bagi = 4;
                }
                $i++;
            }
            $result[$index]  = $t;
            $dibagi[$index]  = $bagi;
        }
      $sum_pas_kd_kgn = array();
      $pas_kd = array();
      $seq_pas_kd = 0;
      foreach ($result as $key_pas_kd => $value_pas_kd) {
          $pas_kd[$seq_pas_kd] = $key_pas_kd;
          $sum_pas_kd_kgn[$seq_pas_kd] = array_sum($value_pas_kd);
          $seq_pas_kd++;
      }
      $jmh_pas_kd = array_combine($pas_kd, $sum_pas_kd_kgn);

      $seq_nh_kd = 0;
      $nh_kd     = array();
      $na_nh_kd  = array();
      foreach ($RTNH as $key_nh_kd => $value_kd) {
          $na_nh_kd[$seq_nh_kd] = 2 * $value_kd;
          $nh_kd[$seq_nh_kd] = $key_nh_kd;
          $seq_nh_kd++;
      }
      $jmh_nh_kd = array_combine($nh_kd, $na_nh_kd);

        $result_na = array();
        $values_na = array($jmh_nh_kd, $jmh_pas_kd);
        
        foreach($RTNH as $index_na => $key_na) {
            $j = array();
            foreach($values_na as $value_na) {
                $j[] = isset($value_na[$index_na]) ? $value_na[$index_na] : 0;
            }
            $result_na[$index_na]  = $j;
        }

      $sum_na_kd_kgn = array();
      $na_kd = array();
      $seq_na_kd = 0;
      foreach ($result_na as $key_na_kd => $value_na_kd) {
          $na_kd[$seq_na_kd] = $key_na_kd;
          $sum_na_kd_kgn[$seq_na_kd] = array_sum($value_na_kd);
          $seq_na_kd++;
      }
      $jmh_na_kd = array_combine($na_kd, $sum_na_kd_kgn);

      $result_na_kd = array();
        $values_na_kd = array($jmh_na_kd, $dibagi);
        
        foreach($RTNH as $index_na_kd => $key_na_kd) {
            $k = array();
            foreach($values_na_kd as $value_na_kd) {
                $k[] = isset($value_na_kd[$index_na_kd]) ? $value_na_kd[$index_na_kd] : 0;
            }
            $result_na_kd[$index_na_kd]  = $k;
        }

          $quot_hsl_kd_kgn = array();
          $hsl_kd = array();
          $seq_hsl_kd = 0;
          foreach ($result_na_kd as $key_hsl_kd => $value_hsl_kd) {
              $hsl_kd[$seq_hsl_kd] = $key_hsl_kd;
              if ($value_hsl_kd[1] == 0) {
                echo "";
              } else {
                $quot_hsl_kd_kgn[$seq_hsl_kd] = ($value_hsl_kd[0] / $value_hsl_kd[1]);                
              }
              $seq_hsl_kd++;
          }
          if ($seq_hsl_kd == 0) {
              $NA = 0;
          } else {
              $NA = array_sum($quot_hsl_kd_kgn) / $seq_hsl_kd;
          }
        $data['nilai_akhir']['RFINALKGN'] = round($NA) ? round($NA) : 0;
        $data['nilai_akhir']['KDMP'] = $kd_mp;
        return $data['nilai_akhir'];
    }
    function rekap_nilai_raport2($kd_mp, $nm_mp, $urutan,$nis)
    {
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        
        $data['pilihnis']           = $nis;
        $data['siswa']              = $this->hasilbelajar_model->nama($data['pilihkelas']);
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');
        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['kd_mp']              = $kd_mp;
        $data['nm_mp']              = $nm_mp;
        $data['urutan']             = $urutan;
        $data['tk']                 = $this->kelas_model->get($data['kelas'])->row()->tingkat;
        $data['naMin']              = '';
        $data['naMax']              = '';
        $data['kompetensi_kgn']     = $this->kompetensi_model->get_kompetensi_rpt($data['p_nl'],$data['tk'],$data['kd_sekolah'],$data['th_ajar'],'ki3',$data['kd_mp']);
        $data['kompetensi_psk']     = $this->kompetensi_model->get_kompetensi_rpt($data['p_nl'],$data['tk'],$data['kd_sekolah'],$data['th_ajar'],'ki4',$data['kd_mp']);
        $data['hasilbelajar_kgn']   = $this->hasilbelajar_model->nilai_rapor_kgn_k13_2($data['pilihkelas'],$data['kd_mp'],$data['pilihnis']);
        $data['hasilbelajar_psk']   = $this->hasilbelajar_model->nilai_rapor_psk_k13($data['pilihkelas'],$data['kd_mp'],$data['pilihnis']);

        foreach ($nis as $rowsNis) {
            //echo $rowsNis;
            foreach ($nm_mp as $rowsMp) {

            }
        }
            
        // foreach ($data['hasilbelajar_kgn'] as $rowKgn) {
        //     echo $rowKgn->kd_tagihan.' '.$rowKgn->kd_kd.' '.$rowKgn->kd_mp.' '.$rowKgn->kgn.'<br>';
        // }


        foreach($data['hasilbelajar_kgn'] as $rowKgn)
        {
          $naJmh          = 0;
          $naDvdJmh       = 0;
          $k              = 0;
          $getNaMax       = array();
          $getKetNaMax    = array();
          $arrNaKd        = array();
          $arrKetKd       = array();
          foreach($data['kompetensi_kgn']->result() as $rowKd) {
              $nhJmh_pts        = 0;
              $nhJmh_pas        = 0;
              $nhJmh            = 0;
              $kdDvdJmh_pts     = 0;
              $kdDvdJmh_pas     = 0;
              $kdDvdJmh         = 0;
              if ($this->session->userdata('sub_pnl')=='UTS') {
                for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) {
                  $nh_row     = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_nh'.$jmh_nh.'_uts';
                  $pts_row    = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas_uts';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pts  = eval('return '.$pts_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh+= $hasil_nh;
                  $kdDvdJmh+= $kdDvd;
                }
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
                $naKd         = ((2 * $kdRt) + $hasil_pts) / 3;
              } else {
                for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) {
                  $nh_row     = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_nh'.$jmh_nh.'_uts';
                  $pts_row    = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas_uts';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pts  = eval('return '.$pts_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh_pts+= $hasil_nh;
                  $kdDvdJmh_pts+= $kdDvd;
                }
                for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) {
                  $nh_row     = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_nh'.$jmh_nh;
                  $pas_row    = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pas  = eval('return '.$pas_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh_pas+= $hasil_nh;
                  $kdDvdJmh_pas+= $kdDvd;
                }
                $kdRt_pts = ($nhJmh_pts == 0 || $nhJmh_pts == '0' || $nhJmh_pts == '') ? 0 : $nhJmh_pts;
                $kdRt_pas = ($nhJmh_pas == 0 || $nhJmh_pas == '0' || $nhJmh_pas == '') ? 0 : $nhJmh_pas;
                $nhJmh    = $kdRt_pts + $kdRt_pas;
                $kdDvdJmh = $kdDvdJmh_pts + $kdDvdJmh_pas;
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
                $naKd         = ((2 * $kdRt) + $hasil_pts + $hasil_pas) / 4;
              }
              $kdDvd        = ($naKd == 0 || $naKd == '0' || $naKd == '') ? 0 : 1;
              $naJmh+= $naKd;
              $naDvdJmh+= $kdDvd;

              $arrNaKd[$k]    = $naKd;
              $arrKetKd[$k]   = $rowKd->ket_kd;
              $k++;
          }

          $naRt           = ($naJmh == 0 || $naJmh == '0' || $naJmh == '') ? 0 : $naJmh / $naDvdJmh;

          if ($k != 0) {
            $na = round($naRt);
            $data['nilai_akhir'] = array();
            $convNa = $na;
            $arrCombKgn = array_combine($arrNaKd, $arrKetKd);
            $naMin   = '';
            $desMin   = '';
            $naMax   = '';
            foreach ($arrCombKgn as $keyNaKd => $valKetKd) {
              $maxCombo = max(array_keys($arrCombKgn));
              $minCombo = min(array_keys($arrCombKgn));
              if($keyNaKd == $maxCombo) {
                $naMax = $valKetKd;
              } elseif($keyNaKd == $minCombo) {
                $naMin = $keyNaKd;
                $desMin = $valKetKd;
              }
            }
          } else {
            $na     = 0;
            $convNa = 0;
            $naMin  = '';
            $desMin  = '';
            $naMax  = '';
          }
        }
            




        //========== PSK =============================//
        foreach($data['hasilbelajar_psk'] as $rowPsk)
        {
          $naJmh          = 0;
          $naDvdJmh       = 0;
          $k              = 0;
          $getNaMax       = array();
          $getKetNaMax    = array();
          $arrNaKd        = array();
          $arrKetKd       = array();
          foreach($data['kompetensi_psk']->result() as $rowKdPsk) {
              $nlJmh_pts        = 0;
              $nlJmh_pas        = 0;
              $nlJmh            = 0;
              $kdDvdJmh_pts     = 0;
              $kdDvdJmh_pas     = 0;
              $kdDvdJmh         = 0;
              if ($this->session->userdata('sub_pnl')=='UTS') {
                for ($jmh_tgh_psk=1; $jmh_tgh_psk <= 2 ; $jmh_tgh_psk++) {
                  $kin_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_kin'.$jmh_tgh_psk.'_uts';
                  $prj_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_prj'.$jmh_tgh_psk.'_uts';
                  $por_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_por'.$jmh_tgh_psk.'_uts';
                  $pts_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_pas_uts';
                  $hasil_kin       = eval('return '.$kin_row_psk.';');
                  $hasil_prj       = eval('return '.$prj_row_psk.';');
                  $hasil_por       = eval('return '.$por_row_psk.';');
                  $hasil_pts       = eval('return '.$pts_row_psk.';');
                  $kdDvdKin        = ($hasil_kin == 0 || $hasil_kin == '0' || $hasil_kin == '') ? 0 : 1;
                  $kdDvdPrj        = ($hasil_prj == 0 || $hasil_prj == '0' || $hasil_prj == '') ? 0 : 1;
                  $kdDvdPor        = ($hasil_por == 0 || $hasil_por == '0' || $hasil_por == '') ? 0 : 1;
                  $kdDvd           = $kdDvdKin + $kdDvdPrj + $kdDvdPor;
                  $hasil_nl        = $hasil_kin + $hasil_prj + $hasil_por;
                  $nlJmh+= $hasil_nl;
                  $kdDvdJmh+= $kdDvd;
                }
                $kdRt = ($nlJmh == 0 || $nlJmh == '0' || $nlJmh == '') ? 0 : $nlJmh / $kdDvdJmh;
                $naKd         = ((2 * $kdRt) + $hasil_pts) / 3;
              } else {
                for ($jmh_tgh_psk=1; $jmh_tgh_psk <= 2 ; $jmh_tgh_psk++) {
                  $kin_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_kin'.$jmh_tgh_psk.'_uts';
                  $prj_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_prj'.$jmh_tgh_psk.'_uts';
                  $por_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_por'.$jmh_tgh_psk.'_uts';
                  $pts_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_pas_uts';
                  $hasil_kin       = eval('return '.$kin_row_psk.';');
                  $hasil_prj       = eval('return '.$prj_row_psk.';');
                  $hasil_por       = eval('return '.$por_row_psk.';');
                  $hasil_pts       = eval('return '.$pts_row_psk.';');
                  $kdDvdKin        = ($hasil_kin == 0 || $hasil_kin == '0' || $hasil_kin == '') ? 0 : 1;
                  $kdDvdPrj        = ($hasil_prj == 0 || $hasil_prj == '0' || $hasil_prj == '') ? 0 : 1;
                  $kdDvdPor        = ($hasil_por == 0 || $hasil_por == '0' || $hasil_por == '') ? 0 : 1;
                  $kdDvd           = $kdDvdKin + $kdDvdPrj + $kdDvdPor;
                  $hasil_nl        = $hasil_kin + $hasil_prj + $hasil_por;
                  $nlJmh_pts+= $hasil_nl;
                  $kdDvdJmh_pts+= $kdDvd;
                }
                for ($jmh_tgh_psk=1; $jmh_tgh_psk <= 2 ; $jmh_tgh_psk++) {
                  $kin_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_kin'.$jmh_tgh_psk;
                  $prj_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_prj'.$jmh_tgh_psk;
                  $por_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_por'.$jmh_tgh_psk;
                  $pas_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_pas';
                  $hasil_kin       = eval('return '.$kin_row_psk.';');
                  $hasil_prj       = eval('return '.$prj_row_psk.';');
                  $hasil_por       = eval('return '.$por_row_psk.';');
                  $hasil_pas       = eval('return '.$pas_row_psk.';');
                  $kdDvdKin        = ($hasil_kin == 0 || $hasil_kin == '0' || $hasil_kin == '') ? 0 : 1;
                  $kdDvdPrj        = ($hasil_prj == 0 || $hasil_prj == '0' || $hasil_prj == '') ? 0 : 1;
                  $kdDvdPor        = ($hasil_por == 0 || $hasil_por == '0' || $hasil_por == '') ? 0 : 1;
                  $kdDvd           = $kdDvdKin + $kdDvdPrj + $kdDvdPor;
                  $hasil_nl        = $hasil_kin + $hasil_prj + $hasil_por;
                  $nlJmh_pas+= $hasil_nl;
                  $kdDvdJmh_pas+= $kdDvd;
                }
                $kdRt_pts           = ($nlJmh_pts == 0 || $nlJmh_pts == '0' || $nlJmh_pts == '') ? 0 : $nlJmh_pts;
                $kdRt_pas           = ($nlJmh_pas == 0 || $nlJmh_pas == '0' || $nlJmh_pas == '') ? 0 : $nlJmh_pas;
                $nlJmh              = $kdRt_pts + $kdRt_pas;
                $kdDvdJmh           = $kdDvdJmh_pts + $kdDvdJmh_pas;
                $kdRt               = ($nlJmh == 0 || $nlJmh == '0' || $nlJmh == '') ? 0 : $nlJmh / $kdDvdJmh;
                $naKd               = ((2 * $kdRt) + $hasil_pts + $hasil_pas) / 4;
              }
              $kdDvd                = ($naKd == 0 || $naKd == '0' || $naKd == '') ? 0 : 1;
              $naJmh+= $naKd;
              $naDvdJmh+= $kdDvd;

              $arrNaKd[$k]    = $naKd;
              $arrKetKd[$k]   = $rowKdPsk->ket_kd;
              $k++;
          }

          $naRt           = ($naJmh == 0 || $naJmh == '0' || $naJmh == '') ? 0 : $naJmh / $naDvdJmh;

          if ($k != 0) {
            $naPsk      = round($naRt);
            $data['nilai_akhir'] = array();
            $convNa     = $naPsk;
            $arrCombPsk    = array_combine($arrNaKd, $arrKetKd);
            $naMinPsk   = 0;
            $desMinPsk  = '';
            $naMaxPsk   = '';
            foreach ($arrCombPsk as $keyNaKd => $valKetKd) {
              $maxCombo = max(array_keys($arrCombPsk));
              $minCombo = min(array_keys($arrCombPsk));
              if($keyNaKd == $maxCombo) {
                $naMaxPsk = $valKetKd;
              } elseif($keyNaKd == $minCombo) {
                $naMinPsk = $keyNaKd;
                $desMinPsk = $valKetKd;
              }
            }
          } else {
            $naPsk      = 0;
            $convNa     = 0;
            $naMinPsk   = 0;
            $desMinPsk  = '';
            $naMaxPsk   = '';
          }
        }
        //echo $naPsk; die();
        $filterNaMinPsk = (($arrCombPsk != 0) ? round(min(array_keys($arrCombPsk))) : 0);
        if ($filterNaMinPsk <= 70) {
            $brsPsk        = 'Ananda mampu '.$naMaxPsk.' perlu pembinaan dalam '.$desMinPsk;
        } else {
            $brsPsk        = 'Ananda mampu '.$naMaxPsk;
        }
        $data['nilai_akhir']['RFINALPSK'] = ($naPsk) ? $naPsk : 0;
        $data['nilai_akhir']['NADESKPSK'] = $brsPsk;
        //========== END PSK =============================//

        $filterNaMinKgn = (($arrCombKgn != 0) ? round(min(array_keys($arrCombKgn))) : 0);
        if ($filterNaMinKgn <= 70) {
            $brs        = 'Ananda mampu '.$naMax.' perlu pembinaan dalam '.$desMin;
        } else {
            $brs        = 'Ananda mampu '.$naMax;
        }
        $data['nilai_akhir']['RFINAL'] = ($na) ? $na : 0;
        $data['nilai_akhir']['NADESK'] = $brs;




        $data['nilai_akhir']['KDMP']   = $data['kd_mp'];
        $data['nilai_akhir']['NMMP']   = $data['nm_mp'];
        $data['nilai_akhir']['URUTAN'] = $data['urutan'];
        return $data['nilai_akhir'];
    }
    function rekap_nilai_raport($kd_mp, $nm_mp, $urutan,$nis)
    {
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        
        $data['pilihnis']           = $nis;
        $data['siswa']              = $this->hasilbelajar_model->nama($data['pilihkelas']);
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');
        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['kd_mp']              = $kd_mp;
        $data['nm_mp']              = $nm_mp;
        $data['urutan']             = $urutan;
        $data['tk']                 = $this->kelas_model->get($data['kelas'])->row()->tingkat;
        $data['naMin']              = '';
        $data['naMax']              = '';
        $data['kompetensi_kgn']     = $this->kompetensi_model->get_kompetensi_rpt($data['p_nl'],$data['tk'],$data['kd_sekolah'],$data['th_ajar'],'ki3',$data['kd_mp']);
        $data['kompetensi_psk']     = $this->kompetensi_model->get_kompetensi_rpt($data['p_nl'],$data['tk'],$data['kd_sekolah'],$data['th_ajar'],'ki4',$data['kd_mp']);
        $data['hasilbelajar_kgn']   = $this->hasilbelajar_model->nilai_rapor_kgn_k13($data['pilihkelas'],$data['kd_mp'],$data['pilihnis']);
        $data['hasilbelajar_psk']   = $this->hasilbelajar_model->nilai_rapor_psk_k13($data['pilihkelas'],$data['kd_mp'],$data['pilihnis']);
            

        foreach($data['hasilbelajar_kgn'] as $rowKgn)
        {
          $naJmh          = 0;
          $naDvdJmh       = 0;
          $k              = 0;
          $getNaMax       = array();
          $getKetNaMax    = array();
          $arrNaKd        = array();
          $arrKetKd       = array();
          foreach($data['kompetensi_kgn']->result() as $rowKd) {
              $nhJmh_pts        = 0;
              $nhJmh_pas        = 0;
              $nhJmh            = 0;
              $kdDvdJmh_pts     = 0;
              $kdDvdJmh_pas     = 0;
              $kdDvdJmh         = 0;
              if ($this->session->userdata('sub_pnl')=='UTS') {
                for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) {
                  $nh_row     = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_nh'.$jmh_nh.'_uts';
                  $pts_row    = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas_uts';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pts  = eval('return '.$pts_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh+= $hasil_nh;
                  $kdDvdJmh+= $kdDvd;
                }
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
                $naKd         = ((2 * $kdRt) + $hasil_pts) / 3;
              } else {
                for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) {
                  $nh_row     = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_nh'.$jmh_nh.'_uts';
                  $pts_row    = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas_uts';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pts  = eval('return '.$pts_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh_pts+= $hasil_nh;
                  $kdDvdJmh_pts+= $kdDvd;
                }
                for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) {
                  $nh_row     = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_nh'.$jmh_nh;
                  $pas_row    = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pas  = eval('return '.$pas_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh_pas+= $hasil_nh;
                  $kdDvdJmh_pas+= $kdDvd;
                }
                $kdRt_pts = ($nhJmh_pts == 0 || $nhJmh_pts == '0' || $nhJmh_pts == '') ? 0 : $nhJmh_pts;
                $kdRt_pas = ($nhJmh_pas == 0 || $nhJmh_pas == '0' || $nhJmh_pas == '') ? 0 : $nhJmh_pas;
                $nhJmh    = $kdRt_pts + $kdRt_pas;
                $kdDvdJmh = $kdDvdJmh_pts + $kdDvdJmh_pas;
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
                $naKd         = ((2 * $kdRt) + $hasil_pts + $hasil_pas) / 4;
              }
              $kdDvd        = ($naKd == 0 || $naKd == '0' || $naKd == '') ? 0 : 1;
              $naJmh+= $naKd;
              $naDvdJmh+= $kdDvd;

              $arrNaKd[$k]    = $naKd;
              $arrKetKd[$k]   = $rowKd->ket_kd;
              $k++;
          }

          $naRt           = ($naJmh == 0 || $naJmh == '0' || $naJmh == '') ? 0 : $naJmh / $naDvdJmh;

          if ($k != 0) {
            $na = round($naRt);
            $data['nilai_akhir'] = array();
            $convNa = $na;
            $arrCombKgn = array_combine($arrNaKd, $arrKetKd);
            $naMin   = '';
            $desMin   = '';
            $naMax   = '';
            foreach ($arrCombKgn as $keyNaKd => $valKetKd) {
              $maxCombo = max(array_keys($arrCombKgn));
              $minCombo = min(array_keys($arrCombKgn));
              if($keyNaKd == $maxCombo) {
                $naMax = $valKetKd;
              } elseif($keyNaKd == $minCombo) {
                $naMin = $keyNaKd;
                $desMin = $valKetKd;
              }
            }
          } else {
            $na     = 0;
            $convNa = 0;
            $naMin  = '';
            $desMin  = '';
            $naMax  = '';
          }
        }
            




        //========== PSK =============================//
        foreach($data['hasilbelajar_psk'] as $rowPsk)
        {
          $naJmh          = 0;
          $naDvdJmh       = 0;
          $k              = 0;
          $getNaMax       = array();
          $getKetNaMax    = array();
          $arrNaKd        = array();
          $arrKetKd       = array();
          foreach($data['kompetensi_psk']->result() as $rowKdPsk) {
              $nlJmh_pts        = 0;
              $nlJmh_pas        = 0;
              $nlJmh            = 0;
              $kdDvdJmh_pts     = 0;
              $kdDvdJmh_pas     = 0;
              $kdDvdJmh         = 0;
              if ($this->session->userdata('sub_pnl')=='UTS') {
                for ($jmh_tgh_psk=1; $jmh_tgh_psk <= 2 ; $jmh_tgh_psk++) {
                  $kin_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_kin'.$jmh_tgh_psk.'_uts';
                  $prj_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_prj'.$jmh_tgh_psk.'_uts';
                  $por_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_por'.$jmh_tgh_psk.'_uts';
                  $pts_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_pas_uts';
                  $hasil_kin       = eval('return '.$kin_row_psk.';');
                  $hasil_prj       = eval('return '.$prj_row_psk.';');
                  $hasil_por       = eval('return '.$por_row_psk.';');
                  $hasil_pts       = eval('return '.$pts_row_psk.';');
                  $kdDvdKin        = ($hasil_kin == 0 || $hasil_kin == '0' || $hasil_kin == '') ? 0 : 1;
                  $kdDvdPrj        = ($hasil_prj == 0 || $hasil_prj == '0' || $hasil_prj == '') ? 0 : 1;
                  $kdDvdPor        = ($hasil_por == 0 || $hasil_por == '0' || $hasil_por == '') ? 0 : 1;
                  $kdDvd           = $kdDvdKin + $kdDvdPrj + $kdDvdPor;
                  $hasil_nl        = $hasil_kin + $hasil_prj + $hasil_por;
                  $nlJmh+= $hasil_nl;
                  $kdDvdJmh+= $kdDvd;
                }
                $kdRt = ($nlJmh == 0 || $nlJmh == '0' || $nlJmh == '') ? 0 : $nlJmh / $kdDvdJmh;
                $naKd         = ((2 * $kdRt) + $hasil_pts) / 3;
              } else {
                for ($jmh_tgh_psk=1; $jmh_tgh_psk <= 2 ; $jmh_tgh_psk++) {
                  $kin_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_kin'.$jmh_tgh_psk.'_uts';
                  $prj_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_prj'.$jmh_tgh_psk.'_uts';
                  $por_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_por'.$jmh_tgh_psk.'_uts';
                  $pts_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_pas_uts';
                  $hasil_kin       = eval('return '.$kin_row_psk.';');
                  $hasil_prj       = eval('return '.$prj_row_psk.';');
                  $hasil_por       = eval('return '.$por_row_psk.';');
                  $hasil_pts       = eval('return '.$pts_row_psk.';');
                  $kdDvdKin        = ($hasil_kin == 0 || $hasil_kin == '0' || $hasil_kin == '') ? 0 : 1;
                  $kdDvdPrj        = ($hasil_prj == 0 || $hasil_prj == '0' || $hasil_prj == '') ? 0 : 1;
                  $kdDvdPor        = ($hasil_por == 0 || $hasil_por == '0' || $hasil_por == '') ? 0 : 1;
                  $kdDvd           = $kdDvdKin + $kdDvdPrj + $kdDvdPor;
                  $hasil_nl        = $hasil_kin + $hasil_prj + $hasil_por;
                  $nlJmh_pts+= $hasil_nl;
                  $kdDvdJmh_pts+= $kdDvd;
                }
                for ($jmh_tgh_psk=1; $jmh_tgh_psk <= 2 ; $jmh_tgh_psk++) {
                  $kin_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_kin'.$jmh_tgh_psk;
                  $prj_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_prj'.$jmh_tgh_psk;
                  $por_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_por'.$jmh_tgh_psk;
                  $pas_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_pas';
                  $hasil_kin       = eval('return '.$kin_row_psk.';');
                  $hasil_prj       = eval('return '.$prj_row_psk.';');
                  $hasil_por       = eval('return '.$por_row_psk.';');
                  $hasil_pas       = eval('return '.$pas_row_psk.';');
                  $kdDvdKin        = ($hasil_kin == 0 || $hasil_kin == '0' || $hasil_kin == '') ? 0 : 1;
                  $kdDvdPrj        = ($hasil_prj == 0 || $hasil_prj == '0' || $hasil_prj == '') ? 0 : 1;
                  $kdDvdPor        = ($hasil_por == 0 || $hasil_por == '0' || $hasil_por == '') ? 0 : 1;
                  $kdDvd           = $kdDvdKin + $kdDvdPrj + $kdDvdPor;
                  $hasil_nl        = $hasil_kin + $hasil_prj + $hasil_por;
                  $nlJmh_pas+= $hasil_nl;
                  $kdDvdJmh_pas+= $kdDvd;
                }
                $kdRt_pts           = ($nlJmh_pts == 0 || $nlJmh_pts == '0' || $nlJmh_pts == '') ? 0 : $nlJmh_pts;
                $kdRt_pas           = ($nlJmh_pas == 0 || $nlJmh_pas == '0' || $nlJmh_pas == '') ? 0 : $nlJmh_pas;
                $nlJmh              = $kdRt_pts + $kdRt_pas;
                $kdDvdJmh           = $kdDvdJmh_pts + $kdDvdJmh_pas;
                $kdRt               = ($nlJmh == 0 || $nlJmh == '0' || $nlJmh == '') ? 0 : $nlJmh / $kdDvdJmh;
                $naKd               = ((2 * $kdRt) + $hasil_pts + $hasil_pas) / 4;
              }
              $kdDvd                = ($naKd == 0 || $naKd == '0' || $naKd == '') ? 0 : 1;
              $naJmh+= $naKd;
              $naDvdJmh+= $kdDvd;

              $arrNaKd[$k]    = $naKd;
              $arrKetKd[$k]   = $rowKdPsk->ket_kd;
              $k++;
          }

          $naRt           = ($naJmh == 0 || $naJmh == '0' || $naJmh == '') ? 0 : $naJmh / $naDvdJmh;

          if ($k != 0) {
            $naPsk      = round($naRt);
            $data['nilai_akhir'] = array();
            $convNa     = $naPsk;
            $arrCombPsk    = array_combine($arrNaKd, $arrKetKd);
            $naMinPsk   = 0;
            $desMinPsk  = '';
            $naMaxPsk   = '';
            foreach ($arrCombPsk as $keyNaKd => $valKetKd) {
              $maxCombo = max(array_keys($arrCombPsk));
              $minCombo = min(array_keys($arrCombPsk));
              if($keyNaKd == $maxCombo) {
                $naMaxPsk = $valKetKd;
              } elseif($keyNaKd == $minCombo) {
                $naMinPsk = $keyNaKd;
                $desMinPsk = $valKetKd;
              }
            }
          } else {
            $naPsk      = 0;
            $convNa     = 0;
            $naMinPsk   = 0;
            $desMinPsk  = '';
            $naMaxPsk   = '';
          }
        }
        //echo $naPsk; die();
        $filterNaMinPsk = (($arrCombPsk != 0) ? round(min(array_keys($arrCombPsk))) : 0);
        if ($filterNaMinPsk <= 70) {
            $brsPsk        = 'Ananda mampu '.$naMaxPsk.' perlu pembinaan dalam '.$desMinPsk;
        } else {
            $brsPsk        = 'Ananda mampu '.$naMaxPsk;
        }
        $data['nilai_akhir']['RFINALPSK'] = ($naPsk) ? $naPsk : 0;
        $data['nilai_akhir']['NADESKPSK'] = $brsPsk;
        //========== END PSK =============================//

        $filterNaMinKgn = (($arrCombKgn != 0) ? round(min(array_keys($arrCombKgn))) : 0);
        if ($filterNaMinKgn <= 70) {
            $brs        = 'Ananda mampu '.$naMax.' perlu pembinaan dalam '.$desMin;
        } else {
            $brs        = 'Ananda mampu '.$naMax;
        }
        $data['nilai_akhir']['RFINAL'] = ($na) ? $na : 0;
        $data['nilai_akhir']['NADESK'] = $brs;




        $data['nilai_akhir']['KDMP']   = $data['kd_mp'];
        $data['nilai_akhir']['NMMP']   = $data['nm_mp'];
        $data['nilai_akhir']['URUTAN'] = $data['urutan'];
        return $data['nilai_akhir'];
    }
    function ledger_detail($kelas='0')
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Rekap Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');

        $data['kelas']              = $this->kelas_model->getfilterotorisasi($this->_th_ajar,$this->_kd_sekolah);
        $data['pilihkelas']         = $this->input->post('kelas');
        $data['siswa']              = $this->siswa_model->get_per_kelas($data['pilihkelas'],  $this->_kd_sekolah, $this->_th_ajar);

        if($this->input->post('filter'))
        {
            $data['mp']             = $this->mp_model->get_per_kelas($data['pilihkelas'],$this->_kd_sekolah, $this->_th_ajar, $this->_p_nl);
            $seq_mp = 0;
            $jmh_per_mp = 0;
            foreach($data['mp']->result() as $rmp)
            {
                $data['kd_mp']=$rmp->kd_mp;
                $nilai  = $this->hasilbelajar_model->rapor_akhir($data);

                $seq = 0;
                foreach($nilai->result() as $ntgh)
                {

                    if ($seq_mp==0)
                    {
                        $data['nilai'][$seq] = array();
                        $data['nilai'][$seq]['nis']   = $ntgh->nis;
                        $data['nilai'][$seq]['nm']    = $ntgh->nama_lengkap;
                    }

                    $data['nilai'][$seq]['mp'][$seq_mp] = array();
                    $data['nilai'][$seq]['mp'][$seq_mp]['kd_mp'] =  $rmp->kd_mp;
                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']   = array();

                    $UHT1    = $ntgh->UHT1;
                    $UHT2    = $ntgh->UHT2;
                    $UHT3    = $ntgh->UHT3;

                    $jmluht = $UHT1 + $UHT2 + $UHT3;
                    $h = ($UHT1 == '0' || $UHT1 == '' ) ? '0' : 1;
                    $l = ($UHT2 == '0' || $UHT2 == '' ) ? '0' : 1;
                    $j = ($UHT3 == '0' || $UHT3 == '' ) ? '0' : 1;
                    $k = $h + $l + $j;
                    $UHT    = round(($k==0) ? 0 : $jmluht/$k);

                    ///Nilai Praktek
                    $UHP1    = $ntgh->UHP1;
                    $UHP2    = $ntgh->UHP2;
                    $UHP3    = $ntgh->UHP3;

                    $jmluhp = $UHP1 + $UHP2 + $UHP3;
                    $hi = ($UHP1 == '0' || $UHP1 == '' ) ? '0' : 1;
                    $li = ($UHP2 == '0' || $UHP2 == '' ) ? '0' : 1;
                    $ji = ($UHP3 == '0' || $UHP3 == '' ) ? '0' : 1;
                    $ki = $hi + $li + $ji;
                    $UHP    = round(($ki==0) ? 0 : $jmluhp/$ki);

                    $his = ($UHT == '0' || $UHT == '' ) ? '0' : 1;
                    $lis = ($UHP == '0' || $UHP == '' ) ? '0' : 1;
                    $kis = $his + $lis;
                    $UH   = ($kis==0) ? 0 : (round(($UHT + $UHP) / $kis));

                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['UH'] =  $UH;

                    //Nilai TUGAS
                    $TGS1    = $ntgh->TGS1;
                    $TGS2    = $ntgh->TGS2;
                    $TGS3    = $ntgh->TGS3;
                    $jmltgs = $TGS1 + $TGS2 + $TGS3;
                    $ho = ($TGS1 == '0' || $TGS1 == '' ) ? '0' : 1;
                    $lo = ($TGS2 == '0' || $TGS2 == '' ) ? '0' : 1;
                    $jo = ($TGS3 == '0' || $TGS3 == '' ) ? '0' : 1;
                    $ko = $ho + $lo + $jo;
                    $TGS    = round(($ko==0) ? 0 : $jmltgs/$ko);

                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['TGS']  = $TGS;

                    //Nilai UTS
                    $UTST    = $ntgh->UTST;
                    $UTSP    = $ntgh->UTSP;
                    $jmluts = $UTST + $UTSP;
                    $ha = ($UTST == '0' || $UTST == '' ) ? '0' : 1;
                    $la = ($UTSP == '0' || $UTSP == '' ) ? '0' : 1;
                    $ka = $ha + $la;
                    $UTS    = round(($ka==0) ? 0 : $jmluts/$ka);

                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['UTS'] = $UTS;

                    $RUTS = $UH*0.3 + $TGS*0.3 + $UTS*0.4;
                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['RUTS'] = $RUTS;

                    //----------------- NILAI SETELAH MID-------------------------------------
                    $UHTA1    = $ntgh->UHTA1;
                    $UHTA2    = $ntgh->UHTA2;
                    $UHTA3    = $ntgh->UHTA3;

                    $jmluht = $UHTA1 + $UHTA2 + $UHTA3;
                    $h = ($UHTA1 == '0' || $UHTA1 == '' ) ? '0' : 1;
                    $l = ($UHTA2 == '0' || $UHTA2 == '' ) ? '0' : 1;
                    $j = ($UHTA3 == '0' || $UHTA3 == '' ) ? '0' : 1;
                    $k = $h + $l + $j;
                    $UHTA    = round(($k==0) ? 0 : $jmluht/$k);

                    ///Nilai Praktek
                    $UHPA1    = $ntgh->UHPA1;
                    $UHPA2    = $ntgh->UHPA2;
                    $UHPA3    = $ntgh->UHPA3;

                    $jmluhp = $UHPA1 + $UHPA2 + $UHPA3;
                    $hi = ($UHPA1 == '0' || $UHPA1 == '' ) ? '0' : 1;
                    $li = ($UHPA2 == '0' || $UHPA2 == '' ) ? '0' : 1;
                    $ji = ($UHPA3 == '0' || $UHPA3 == '' ) ? '0' : 1;
                    $ki = $hi + $li + $ji;
                    $UHPA    = round(($ki==0) ? 0 : $jmluhp/$ki);

                    $his = ($UHTA == '0' || $UHTA == '' ) ? '0' : 1;
                    $lis = ($UHPA == '0' || $UHPA == '' ) ? '0' : 1;
                    $kis = $his + $lis;
                    $UHA   = ($kis==0) ? 0 : (round(($UHTA + $UHPA) / $kis));

                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['UHA'] =  round($UHA);

                    //Nilai TUGAS
                    $TGSA1    = $ntgh->TGSA1;
                    $TGSA2    = $ntgh->TGSA2;
                    $TGSA3    = $ntgh->TGSA3;
                    $jmltgs = $TGSA1 + $TGSA2 + $TGSA3;
                    $ho = ($TGSA1 == '0' || $TGSA1 == '' ) ? '0' : 1;
                    $lo = ($TGSA2 == '0' || $TGSA2 == '' ) ? '0' : 1;
                    $jo = ($TGSA3 == '0' || $TGSA3 == '' ) ? '0' : 1;
                    $ko = $ho + $lo + $jo;
                    $TGSA    = round(($ko==0) ? 0 : $jmltgs/$ko);

                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['TGSA']  = round($TGSA);

                    //Nilai UTS
                    $UTSTA    = $ntgh->UTSTA;
                    $UTSPA    = $ntgh->UTSPA;
                    $jmluts = $UTSTA + $UTSPA;
                    $ha = ($UTSTA == '0' || $UTSTA == '' ) ? '0' : 1;
                    $la = ($UTSPA == '0' || $UTSPA == '' ) ? '0' : 1;
                    $ka = $ha + $la;
                    $UTSA    = round(($ka==0) ? 0 : $jmluts/$ka);

                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['UTSA'] = round($UTSA);

                    $RUAS = $UHA*0.3 + $TGSA*0.3 + $UTSA*0.4;
                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['RUAS'] = round($RUAS);

                    if ($this->_sub_pnl=='UTS')
                    {
                        $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['RFINAL'] = round(($RUTS));
                        $jmh_per_mp += $RUTS;
                    }
                    else
                    {
                        $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['RFINAL'] = round(($RUTS+$RUAS)/2);
                        $jmh_per_mp += ($RUTS+$RUAS)/2;
                    }


                    //================= NILAI SETELAH MID =====================================

                    $seq++;
                }
                if ($seq>0)
                {
                    $data['nilai'][$seq]['nis']   = '';
                    $data['nilai'][$seq]['nm']    = 'J U M L A H';
                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['RFINAL'] = round($jmh_per_mp);
                    $seq++;
                    $data['nilai'][$seq]['nis']   = '';
                    $data['nilai'][$seq]['nm']    = 'RATA - RATA';
                    $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['RFINAL'] = round($jmh_per_mp/$seq);

                    $jmh_per_mp = 0;
                }
                $seq_mp++;
            }
        }

//         print_r($data['nilai']);die();
        $data['tampil']             = ($this->input->post('kelas') =='' || $this->input->post('kelas') =='0') ? '' : 'a';
        $this->load->view('hasil_belajar/ledger_detail',$data);
    }

    //Diedit Project Al Madinah
    function ledger_pengetahuan($kelas=0,$mp=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $base_url                   = base_url().'index.php/hasilbelajar/daftar/'.$kelas.'/'.$mp;
        $data['pilihkelas']         = '';
        $data['sub_pnl']            = $this->session->userdata('sub_pnl');
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
        $data['kelas']              = $data['pilihkelas'];
        $data['kd_mp']              = $data['pilihmp'];
        $data['kd_ki']              = 'ki3';
        $data['naMin']              = '';
        $data['naMax']              = '';
        $data['kkm']                = $this->kkm_model->getAll($this->uri->segment(3),$data['pilihmp']);
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        $data['mp']                 = $this->mp_model->get_all($data['pilihmp']);
        $data['kdmp']               = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['tk']                 = isset($this->kelas_model->get($kelas)->row()->tingkat) ? $this->kelas_model->get($kelas)->row()->tingkat : '';
        $data['kompetensi']         = $this->kompetensi_model->get_kompetensi('',$data['p_nl'],$data['tk'],$data['kd_mp'],$data['kd_sekolah'],$data['th_ajar'],$data['kd_ki']);
        $data['hasilbelajar']       = $this->hasilbelajar_model->nilai_ledger_pengetahuan_k13_sma($data);
        $this->load->view('hasil_belajar/ledger_pengetahuan_sma_k13', $data);
    }

    function ledger_keterampilan($kelas=0,$mp=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $base_url                   = base_url().'index.php/hasilbelajar/daftar/'.$kelas.'/'.$mp;
        $data['pilihkelas']         = '';
        $data['sub_pnl']            = $this->session->userdata('sub_pnl');
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
        $data['kelas']              = $data['pilihkelas'];
        $data['kd_mp']              = $data['pilihmp'];
        $data['kd_ki']              = 'ki4';
        $data['kkm']                = $this->kkm_model->getAll($this->uri->segment(3),$data['pilihmp']);
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        $data['mp']                 = $this->mp_model->get_all($data['pilihmp']);
        $data['kdmp']               = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['tk']                     = isset($this->kelas_model->get($kelas)->row()->tingkat) ? $this->kelas_model->get($kelas)->row()->tingkat : '';
        $data['kompetensi']              = $this->kompetensi_model->get_kompetensi('',$data['p_nl'],$data['tk'],$data['kd_mp'],$data['kd_sekolah'],$data['th_ajar'],$data['kd_ki']);
          $data['hasilbelajar']       = $this->hasilbelajar_model->nilai_ledger_keterampilan_k13_sma($data);
          $this->load->view('hasil_belajar/ledger_keterampilan_sma_k13', $data);

	}

    function ledger_sikap($kelas=0,$mp=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | RAPORT';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $base_url                   = base_url().'index.php/hasilbelajar/daftar/'.$kelas.'/'.$mp;
        $data['pilihkelas']         = '';
        $data['sub_pnl']            = $this->session->userdata('sub_pnl');
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
        $data['kelas']              = $data['pilihkelas'];
        $data['kd_mp']              = $data['pilihmp'];
        $data['hasil_nh_row']       = '';
        $data['kkm']                = $this->kkm_model->getAll($this->uri->segment(3),$data['pilihmp']);
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        $data['mp']                 = $this->mp_model->get_all($data['pilihmp']);
        $data['kdmp']               = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['tk']                 = isset($this->kelas_model->get($data['kelas'])->row()->tingkat) ? $this->kelas_model->get($data['kelas'])->row()->tingkat : '';
        $data['kompetensi_spr']         = $this->kompetensi_model->get_kompetensi('',$data['p_nl'],$data['tk'],$data['kd_mp'],$data['kd_sekolah'],$data['th_ajar'],'ki1');
        $data['kompetensi_sos']         = $this->kompetensi_model->get_kompetensi('',$data['p_nl'],$data['tk'],$data['kd_mp'],$data['kd_sekolah'],$data['th_ajar'],'ki2');
        $data['hasilbelajar_spr']     = $this->hasilbelajar_model->nilai_ledger_sikap_k13_spr($data);
        $data['hasilbelajar_sos']     = $this->hasilbelajar_model->nilai_ledger_sikap_k13_sos($data);
          $this->load->view('hasil_belajar/ledger_sikap_sma_k13', $data);
    }

    function lckMSSQL($kelas=0,$nama=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = str_replace('+',' ',$this->uri->segment(4));
        }
        $data['nama_pilih']         = $nama;
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');

        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];
        $data['kd_mp']              = 'MTK';
        $data['tk']                 = $this->kelas_model->get($data['kelas'])->row()->tingkat;
        $data['nama']               = $this->hasilbelajar_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['absena']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);
        $data['abseina']            = $this->hasilbelajar_model->getabsena($data);
        $data['prestasi']           = $this->prestasi_model->get_prestasi($data['nis']);
        $data['sikap_sp_sprt']      = $this->hasilbelajar_model->get_nilai_siswa($data);
        $data['naMin']              = '';
        $data['naMax']              = '';
        $data['eskul']              = $this->hasilbelajar_model->geteskul($data);
        $tinggi_berat_badan         = $this->hasilbelajar_model->gettinggibadan($data);
        $data['kesehatan']          = $this->hasilbelajar_model->getkesehatan($data);
        $data['catatan_siswa']      = $this->task_model->siswa_comment($data);
        $data['tampil']             = ($this->input->post('skelas')=='' || $this->input->post('nis')=='') ? ' ' : 'a';
        // $data['kompetensi_spr']     = $this->kompetensi_model->get_kompetensi('',$data['p_nl'],$data['tk'],'PAI',$data['kd_sekolah'],$data['th_ajar'],'ki1');
        // $data['kompetensi_sos']     = $this->kompetensi_model->get_kompetensi('',$data['p_nl'],$data['tk'],'PKN',$data['kd_sekolah'],$data['th_ajar'],'ki2');
        // $data['hasilbelajar_spr']   = $this->hasilbelajar_model->nilai_rapor_sikap_k13_spr($data);
        // $data['hasilbelajar_sos']   = $this->hasilbelajar_model->nilai_rapor_sikap_k13_sos($data);
        // $data['hasilbelajar']       = $this->hasilbelajar_model->getkpa2($data);

        $like_bb     = 'Berat Badan';
        $filter_bb  = array_filter($tinggi_berat_badan, function ($item_bb) use ($like_bb) {
            if (stripos($item_bb['nm_kesehatan'], $like_bb) !== false) {
                return true;
            }
            return false;
        });
        $like_tb     = 'Tinggi Badan';
        $filter_tb  = array_filter($tinggi_berat_badan, function ($item_tb) use ($like_tb) {
            if (stripos($item_tb['nm_kesehatan'], $like_tb) !== false) {
                return true;
            }
            return false;
        });

        //$data['tinggibadan']    = (!empty($filter_tb)) ? array_column($filter_tb, 'hasil', 'p_nl') : '';
        //$data['beratbadan']     = (!empty($filter_bb)) ? array_column($filter_bb, 'hasil', 'p_nl') : '';



        // $data['nilai_akhir'] = array();
        // $seq                 = 0;
        // foreach ($data['hasilbelajar']->result() as $row) {
        //     $data['nilai_akhir'][$seq] = $this->nilai_raport($row->kd_mp, $row->nm_mp, $row->urutan);
        //     $seq++;
        //     // if ($seq == 1) {
        //     //   break;
        //     // }
        // }
        
        $this->load->view('hasil_belajar/lck_sd_02',$data);
    }

    function nilai_raport($kd_mp, $nm_mp, $urutan)
    {
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = str_replace('+',' ',$this->uri->segment(4));
        }
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');

        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['kd_mp']              = $kd_mp;
        $data['nm_mp']              = $nm_mp;
        $data['urutan']             = $urutan;
        $data['tk']                 = $this->kelas_model->get($data['kelas'])->row()->tingkat;
        $data['naMin']              = '';
        $data['naMax']              = '';
        $data['kompetensi_kgn']     = $this->kompetensi_model->get_kompetensi_rpt($data['p_nl'],$data['tk'],$data['kd_sekolah'],$data['th_ajar'],'ki3',$data['kd_mp']);
        $data['kompetensi_psk']     = $this->kompetensi_model->get_kompetensi_rpt($data['p_nl'],$data['tk'],$data['kd_sekolah'],$data['th_ajar'],'ki4',$data['kd_mp']);
        $data['hasilbelajar_kgn']   = $this->hasilbelajar_model->nilai_rapor_kgn_k13($data['pilihkelas'],$data['kd_mp'],$data['pilihnis']);
        $data['hasilbelajar_psk']   = $this->hasilbelajar_model->nilai_rapor_psk_k13($data['pilihkelas'],$data['kd_mp'],$data['pilihnis']);

        foreach($data['hasilbelajar_kgn'] as $rowKgn)
        {
          $naJmh          = 0;
          $naDvdJmh       = 0;
          $k              = 0;
          $getNaMax       = array();
          $getKetNaMax    = array();
          $arrNaKd        = array();
          $arrKetKd       = array();
          foreach($data['kompetensi_kgn']->result() as $rowKd) {
              $nhJmh_pts        = 0;
              $nhJmh_pas        = 0;
              $nhJmh            = 0;
              $kdDvdJmh_pts     = 0;
              $kdDvdJmh_pas     = 0;
              $kdDvdJmh         = 0;
              if ($this->session->userdata('sub_pnl')=='UTS') {
                for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) {
                  $nh_row     = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_nh'.$jmh_nh.'_uts';
                  $pts_row    = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas_uts';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pts  = eval('return '.$pts_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh+= $hasil_nh;
                  $kdDvdJmh+= $kdDvd;
                }
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
                $naKd         = ((2 * $kdRt) + $hasil_pts) / 3;
              } else {
                for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) {
                  $nh_row     = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_nh'.$jmh_nh.'_uts';
                  $pts_row    = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas_uts';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pts  = eval('return '.$pts_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh_pts+= $hasil_nh;
                  $kdDvdJmh_pts+= $kdDvd;
                }
                for ($jmh_nh=1; $jmh_nh <= 6 ; $jmh_nh++) {
                  $nh_row     = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_nh'.$jmh_nh;
                  $pas_row    = '$rowKgn->'.str_replace(' ','',strtolower($rowKd->kd_kd)).'_pas';
                  $hasil_nh   = eval('return '.$nh_row.';');
                  $hasil_pas  = eval('return '.$pas_row.';');
                  $kdDvd      = ($hasil_nh == 0 || $hasil_nh == '0' || $hasil_nh == '') ? 0 : 1;
                  $nhJmh_pas+= $hasil_nh;
                  $kdDvdJmh_pas+= $kdDvd;
                }
                $kdRt_pts = ($nhJmh_pts == 0 || $nhJmh_pts == '0' || $nhJmh_pts == '') ? 0 : $nhJmh_pts;
                $kdRt_pas = ($nhJmh_pas == 0 || $nhJmh_pas == '0' || $nhJmh_pas == '') ? 0 : $nhJmh_pas;
                $nhJmh    = $kdRt_pts + $kdRt_pas;
                $kdDvdJmh = $kdDvdJmh_pts + $kdDvdJmh_pas;
                $kdRt = ($nhJmh == 0 || $nhJmh == '0' || $nhJmh == '') ? 0 : $nhJmh / $kdDvdJmh;
                if ($hasil_pts == 0 || $hasil_pas == 0) {
                    $naKd         = ((2 * $kdRt) + $hasil_pts + $hasil_pas) / 3;
                } else {
                    $naKd         = ((2 * $kdRt) + $hasil_pts + $hasil_pas) / 4;
                }
              }
              $kdDvd        = ($naKd == 0 || $naKd == '0' || $naKd == '') ? 0 : 1;
              $naJmh+= $naKd;
              $naDvdJmh+= $kdDvd;

              $arrNaKd[$k]    = $naKd;
              $arrKetKd[$k]   = $rowKd->ket_kd;
              $k++;
          }

          $naRt           = ($naJmh == 0 || $naJmh == '0' || $naJmh == '') ? 0 : $naJmh / $naDvdJmh;

          if ($k != 0) {
            $na = round($naRt);
            $data['nilai_akhir'] = array();
            $convNa = $na;
            $arrCombKgn = array_combine($arrNaKd, $arrKetKd);
            $naMin   = '';
            $desMin   = '';
            $naMax   = '';
            foreach ($arrCombKgn as $keyNaKd => $valKetKd) {
              $maxCombo = max(array_keys($arrCombKgn));
              $minCombo = min(array_keys($arrCombKgn));
              if($keyNaKd == $maxCombo) {
                $naMax = $valKetKd;
              } elseif($keyNaKd == $minCombo) {
                $naMin = $keyNaKd;
                $desMin = $valKetKd;
              }
            }
          } else {
            $na     = 0;
            $convNa = 0;
            $arrCombKgn = 0;
            $naMin  = '';
            $desMin  = '';
            $naMax  = '';
          }
        }
        




        //========== PSK =============================//
        foreach($data['hasilbelajar_psk'] as $rowPsk)
        {
          $naJmh          = 0;
          $naDvdJmh       = 0;
          $k              = 0;
          $getNaMax       = array();
          $getKetNaMax    = array();
          $arrNaKd        = array();
          $arrKetKd       = array();
          foreach($data['kompetensi_psk']->result() as $rowKdPsk) {
              $nlJmh_pts        = 0;
              $nlJmh_pas        = 0;
              $nlJmh            = 0;
              $kdDvdJmh_pts     = 0;
              $kdDvdJmh_pas     = 0;
              $kdDvdJmh         = 0;
              if ($this->session->userdata('sub_pnl')=='UTS') {
                for ($jmh_tgh_psk=1; $jmh_tgh_psk <= 2 ; $jmh_tgh_psk++) {
                  $kin_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_kin'.$jmh_tgh_psk.'_uts';
                  $prj_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_prj'.$jmh_tgh_psk.'_uts';
                  $por_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_por'.$jmh_tgh_psk.'_uts';
                  $pts_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_pas_uts';
                  $hasil_kin       = eval('return '.$kin_row_psk.';');
                  $hasil_prj       = eval('return '.$prj_row_psk.';');
                  $hasil_por       = eval('return '.$por_row_psk.';');
                  $hasil_pts       = eval('return '.$pts_row_psk.';');
                  $kdDvdKin        = ($hasil_kin == 0 || $hasil_kin == '0' || $hasil_kin == '') ? 0 : 1;
                  $kdDvdPrj        = ($hasil_prj == 0 || $hasil_prj == '0' || $hasil_prj == '') ? 0 : 1;
                  $kdDvdPor        = ($hasil_por == 0 || $hasil_por == '0' || $hasil_por == '') ? 0 : 1;
                  $kdDvd           = $kdDvdKin + $kdDvdPrj + $kdDvdPor;
                  $hasil_nl        = $hasil_kin + $hasil_prj + $hasil_por;
                  $nlJmh+= $hasil_nl;
                  $kdDvdJmh+= $kdDvd;
                }
                $kdRt = ($nlJmh == 0 || $nlJmh == '0' || $nlJmh == '') ? 0 : $nlJmh / $kdDvdJmh;
                $naKd         = ((2 * $kdRt) + $hasil_pts) / 3;
              } else {
                for ($jmh_tgh_psk=1; $jmh_tgh_psk <= 2 ; $jmh_tgh_psk++) {
                  $kin_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_kin'.$jmh_tgh_psk.'_uts';
                  $prj_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_prj'.$jmh_tgh_psk.'_uts';
                  $por_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_por'.$jmh_tgh_psk.'_uts';
                  $pts_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_pas_uts';
                  $hasil_kin       = eval('return '.$kin_row_psk.';');
                  $hasil_prj       = eval('return '.$prj_row_psk.';');
                  $hasil_por       = eval('return '.$por_row_psk.';');
                  $hasil_pts       = eval('return '.$pts_row_psk.';');
                  $kdDvdKin        = ($hasil_kin == 0 || $hasil_kin == '0' || $hasil_kin == '') ? 0 : 1;
                  $kdDvdPrj        = ($hasil_prj == 0 || $hasil_prj == '0' || $hasil_prj == '') ? 0 : 1;
                  $kdDvdPor        = ($hasil_por == 0 || $hasil_por == '0' || $hasil_por == '') ? 0 : 1;
                  $kdDvd           = $kdDvdKin + $kdDvdPrj + $kdDvdPor;
                  $hasil_nl        = $hasil_kin + $hasil_prj + $hasil_por;
                  $nlJmh_pts+= $hasil_nl;
                  $kdDvdJmh_pts+= $kdDvd;
                }
                for ($jmh_tgh_psk=1; $jmh_tgh_psk <= 2 ; $jmh_tgh_psk++) {
                  $kin_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_kin'.$jmh_tgh_psk;
                  $prj_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_prj'.$jmh_tgh_psk;
                  $por_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_por'.$jmh_tgh_psk;
                  $pas_row_psk     = '$rowPsk->'.str_replace(' ','',strtolower($rowKdPsk->kd_kd)).'_pas';
                  $hasil_kin       = eval('return '.$kin_row_psk.';');
                  $hasil_prj       = eval('return '.$prj_row_psk.';');
                  $hasil_por       = eval('return '.$por_row_psk.';');
                  $hasil_pas       = eval('return '.$pas_row_psk.';');
                  $kdDvdKin        = ($hasil_kin == 0 || $hasil_kin == '0' || $hasil_kin == '') ? 0 : 1;
                  $kdDvdPrj        = ($hasil_prj == 0 || $hasil_prj == '0' || $hasil_prj == '') ? 0 : 1;
                  $kdDvdPor        = ($hasil_por == 0 || $hasil_por == '0' || $hasil_por == '') ? 0 : 1;
                  $kdDvd           = $kdDvdKin + $kdDvdPrj + $kdDvdPor;
                  $hasil_nl        = $hasil_kin + $hasil_prj + $hasil_por;
                  $nlJmh_pas+= $hasil_nl;
                  $kdDvdJmh_pas+= $kdDvd;
                }
                $kdRt_pts           = ($nlJmh_pts == 0 || $nlJmh_pts == '0' || $nlJmh_pts == '') ? 0 : $nlJmh_pts;
                $kdRt_pas           = ($nlJmh_pas == 0 || $nlJmh_pas == '0' || $nlJmh_pas == '') ? 0 : $nlJmh_pas;
                $nlJmh              = $kdRt_pts + $kdRt_pas;
                $kdDvdJmh           = $kdDvdJmh_pts + $kdDvdJmh_pas;
                $kdRt               = ($nlJmh == 0 || $nlJmh == '0' || $nlJmh == '') ? 0 : $nlJmh / $kdDvdJmh;
                if ($hasil_pts == 0 || $hasil_pas == 0) {
                    $naKd         = ((2 * $kdRt) + $hasil_pts + $hasil_pas) / 3;
                } else {
                    $naKd         = ((2 * $kdRt) + $hasil_pts + $hasil_pas) / 4;
                }
              }
              $kdDvd                = ($naKd == 0 || $naKd == '0' || $naKd == '') ? 0 : 1;
              $naJmh+= $naKd;
              $naDvdJmh+= $kdDvd;

              $arrNaKd[$k]    = $naKd;
              $arrKetKd[$k]   = $rowKdPsk->ket_kd;
              $k++;
          }

          $naRt           = ($naJmh == 0 || $naJmh == '0' || $naJmh == '') ? 0 : $naJmh / $naDvdJmh;

          if ($k != 0) {
            $naPsk      = round($naRt);
            $data['nilai_akhir'] = array();
            $convNa     = $naPsk;
            $arrCombPsk    = array_combine($arrNaKd, $arrKetKd);
            $naMinPsk   = 0;
            $desMinPsk  = '';
            $naMaxPsk   = '';
            foreach ($arrCombPsk as $keyNaKd => $valKetKd) {
              $maxCombo = max(array_keys($arrCombPsk));
              $minCombo = min(array_keys($arrCombPsk));
              if($keyNaKd == $maxCombo) {
                $naMaxPsk = $valKetKd;
              } elseif($keyNaKd == $minCombo) {
                $naMinPsk = $keyNaKd;
                $desMinPsk = $valKetKd;
              }
            }
          } else {
            $naPsk      = 0;
            $convNa     = 0;
            $arrCombPsk = 0;
            $naMinPsk   = 0;
            $desMinPsk  = '';
            $naMaxPsk   = '';
          }
        }
        //echo $naPsk; die();
        $filterNaMinPsk = (($arrCombPsk != 0) ? round(min(array_keys($arrCombPsk))) : 0);
        if ($filterNaMinPsk <= 70) {
            $brsPsk        = 'Ananda mampu '.$naMaxPsk.' perlu pembinaan dalam '.$desMinPsk;
        } else {
            $brsPsk        = 'Ananda mampu '.$naMaxPsk;
        }
        $data['nilai_akhir']['RFINALPSK'] = ($naPsk) ? $naPsk : 0;
        $data['nilai_akhir']['NADESKPSK'] = $brsPsk;
        //========== END PSK =============================//

        $filterNaMinKgn = (($arrCombKgn != 0) ? round(min(array_keys($arrCombKgn))) : 0);
        if ($filterNaMinKgn <= 70) {
            $brs        = 'Ananda mampu '.$naMax.' perlu pembinaan dalam '.$desMin;
        } else {
            $brs        = 'Ananda mampu '.$naMax;
        }
        $data['nilai_akhir']['RFINAL'] = ($na) ? $na : 0;
        $data['nilai_akhir']['NADESK'] = $brs;




        $data['nilai_akhir']['KDMP']   = $data['kd_mp'];
        $data['nilai_akhir']['NMMP']   = $data['nm_mp'];
        $data['nilai_akhir']['URUTAN'] = $data['urutan'];
        return $data['nilai_akhir'];
    }

    function lck($kelas=0,$nama=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = str_replace('+',' ',$this->uri->segment(4));
        }
        $data['nama_pilih']         = $nama;
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');

        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];
        $data['tk']                 = $this->kelas_model->get($data['kelas'])->row()->tingkat;
        $data['nama']               = $this->hasilbelajar_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['absena']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);
        $data['abseina']            = $this->hasilbelajar_model->getabsena($data);
        $data['prestasi']           = $this->prestasi_model->get_prestasi($data['nis']);
        $data['sikap_sp_sprt']      = $this->hasilbelajar_model->get_nilai_siswa($data);
        $data['naMin']              = '';
        $data['naMax']              = '';
        $data['eskul']              = $this->hasilbelajar_model->geteskul($data);
        $tinggi_berat_badan         = $this->hasilbelajar_model->gettinggibadan($data);
        $data['kesehatan']          = $this->hasilbelajar_model->getkesehatan($data);
        $data['catatan_siswa']      = $this->task_model->siswa_comment($data);
        $data['tampil']             = ($this->input->post('skelas')=='' || $this->input->post('nis')=='') ? ' ' : 'a';
        // $data['kompetensi_spr']     = $this->kompetensi_model->get_kompetensi('',$data['p_nl'],$data['tk'],'PAI',$data['kd_sekolah'],$data['th_ajar'],'ki1');
        // $data['kompetensi_sos']     = $this->kompetensi_model->get_kompetensi('',$data['p_nl'],$data['tk'],'PKN',$data['kd_sekolah'],$data['th_ajar'],'ki2');
        // $data['hasilbelajar_spr']   = $this->hasilbelajar_model->nilai_rapor_sikap_k13_spr($data);
        // $data['hasilbelajar_sos']   = $this->hasilbelajar_model->nilai_rapor_sikap_k13_sos($data);

        $like_bb     = 'Berat Badan';
        $filter_bb  = array_filter($tinggi_berat_badan, function ($item_bb) use ($like_bb) {
            if (stripos($item_bb['nm_kesehatan'], $like_bb) !== false) {
                return true;
            }
            return false;
        });
        $like_tb     = 'Tinggi Badan';
        $filter_tb  = array_filter($tinggi_berat_badan, function ($item_tb) use ($like_tb) {
            if (stripos($item_tb['nm_kesehatan'], $like_tb) !== false) {
                return true;
            }
            return false;
        });

        //$data['tinggibadan']    = (!empty($filter_tb)) ? array_column($filter_tb, 'hasil', 'p_nl') : '';
        //$data['beratbadan']     = (!empty($filter_bb)) ? array_column($filter_bb, 'hasil', 'p_nl') : '';


        //=========== nilai kgn =============================================================
        $kdperKI    = $this->kompetensi_model->getKompetensiDasarPerTingkat($data);
        $nilaiNH = array();
        $nilaiKin = array();
        foreach ((array) $kdperKI->result() as $kd) {
            $data['kd_mp'] = $kd->kd_mp;
            $data['kd_ki'] = $kd->kd_ki;
            $data['kd_kd'] = $kd->kd_kd;
            if($data['kd_ki'] == "ki3" || $data['kd_ki'] == "KI3") {
                $nhKDMP   = $this->hasilbelajar_model->getNHperKDMP($data)->result();
                if(count($nhKDMP) > 0) {
                    $nilai['kd_mp'] = $nhKDMP[0]->kd_mp;
                    $nilai['nh']   = $nhKDMP[0]->nh;

                    $nilaiNH[$nilai['kd_mp']][] = $nhKDMP[0];
                }
            } 
            elseif($data['kd_ki'] == "ki4" || $data['kd_ki'] == "KI4") {
                $kinKDMP   = $this->hasilbelajar_model->getKinperKDMP($data)->result();
                if(count($kinKDMP) > 0) {
                    $nilai['kd_mp'] = $kinKDMP[0]->kd_mp;
                    $nilai['kin']   = $kinKDMP[0]->kin;
                    
                    $nilaiKin[$nilai['kd_mp']][] = $kinKDMP[0];
                }
            }
        }
        
        //=========== nilai KGN =============================================================
        //End KI 3 --------------------------------
        //KI 3 --------------------------------
        $naKdPerMp = array();
        foreach ((array) $nilaiNH as $rows) {
            for ($i=0; $i < count($rows); $i++) {
                $data['kd_mp'] = $rows[$i]->kd_mp;
                $data['kd_kd'] = $rows[$i]->kd_kd;
                $data['nh'] = $rows[$i]->nh;

                //Get Nilai UAS per KD
                $pasKDMP   = $this->hasilbelajar_model->getPASperKDMP($data)->result();

                //Rumus Nilai Raport Pengetahuan
                $naPerKd = round(((2 * $data['nh']) + $pasKDMP[0]->pas_kgn) / 3);
                $naKdPerMp[$data['kd_mp']][$data['kd_kd']] = $naPerKd;
            }
        }
        //End KI 3 --------------------------------
        //KI 3 --------------------------------
        //Nilai NH Rata-rata
        $na = array();
        $nlKdArr = array();
        foreach ((array) $naKdPerMp as $mp=>$nlKd) {
            $na[$mp] = round(array_sum($nlKd) / count($naKdPerMp[$mp]));
            $nlKdArr[$mp] = $nlKd;
        }
        //End KI 3 --------------------------------
        //KI 3 --------------------------------
        $k = 0;
        foreach((array) $na as $keyMp=>$valNa) {
            //Deskripsi
            $ketKgn = '';
            for($l=0; $l < count($nlKdArr[$keyMp]); $l++) {
                //get kkm
                $data['kd_mp_rpt']  = $keyMp;
                $getKkmMp  = $this->hasilbelajar_model->getKkmMp($data)->row();
                $getKkm    = isset($getKkmMp->skbm) ? $getKkmMp->skbm : 0;

                //ambil nilai maksimal
                $nlValMax = max($nlKdArr[$keyMp]);
                $nlValMin = min($nlKdArr[$keyMp]);

                //bandingkan nilai maksimal dengan kkm
                $nlMax = 0;
                if($nlValMax >= $getKkm) {
                    //cari KD yang sesuai dengan nilai maksimal
                    $nlMax = array_keys($nlKdArr[$keyMp], max($nlKdArr[$keyMp]));

                    //cari deskripsi maksimal
                    $ketKdMaxArr = array();
                    for ($i=0; $i < count($nlMax); $i++) {
                        $data['kd_ki']      = 'ki3';
                        $data['kd_max_min'] = $nlMax[$i];

                        $getDeskripsi    = $this->hasilbelajar_model->getDeskripsiKD($data)->row();
                        $ketKdMaxArr[]   = $getDeskripsi->ket_kd;
                    }
                    $ketKdMax = implode(', ',$ketKdMaxArr);
                }

                //bandingkan nilai minimal dengan kkm
                $nlMin = 0;
                if($nlValMin < $getKkm && $getKkm!=0) {
                    //cari KD yang sesuai dengan nilai minimal
                    $nlMin = array_keys($nlKdArr[$keyMp], min($nlKdArr[$keyMp]));

                    //cari deskripsi minimal
                    $ketKdMinArr = array();
                    for ($s=0; $s < count($nlMin); $s++) {
                        $data['kd_ki'] = 'ki3';
                        $data['kd_max_min'] = $nlMin[$s];

                        $getDeskripsi   = $this->hasilbelajar_model->getDeskripsiKD($data)->row();
                        $ketKdMinArr[]  = $getDeskripsi->ket_kd;
                    }
                    $ketKdMin = implode(', ',$ketKdMinArr);
                }
                //Susun deskripsi
                if($nlMax!=0 && $nlMin!=0) {
                    $ketKgn = 'Ananda mampu '.$ketKdMax.' perlu pembinaan dalam '.$ketKdMin;
                } elseif($nlMax!=0 && $nlMin==0) {
                    $ketKgn = 'Ananda mampu '.$ketKdMax;
                } elseif($nlMax==0 && $nlMin!=0) {
                    $ketKgn = 'Ananda perlu pembinaan dalam '.$ketKdMin;
                } else {
                    $ketKgn = '';
                }
            }

            //simpan nilai raport
            $data['kd_mp'] = $keyMp;
            $data['kgn']   = $valNa;
            $data['deskripsi_kgn']   = $ketKgn;
            
            $sdata = $this->hasilbelajar_model->dapat($data);              
            if($sdata->num_rows() > 0)
            {
                    $this->hasilbelajar_model->updateNilaiRaport($data);
            }
            else
            {
                    $this->hasilbelajar_model->simpanNilaiRaport($data);
            }

            $k++;
        }
        //End KI 3 --------------------------------
        //=========== End nilai KGN =============================================================


        //=========== nilai PSK =============================================================
        //KI 4--------------------------
        $naKdPerMpPsk = array();
        foreach ((array) $nilaiKin as $rows) {
            for ($i=0; $i < count($rows); $i++) {
                $data['kd_mp'] = $rows[$i]->kd_mp;
                $data['kd_kd'] = $rows[$i]->kd_kd;
                $data['kin'] = $rows[$i]->kin;

                //Get Nilai UAS per KD
                $pasKDMP   = $this->hasilbelajar_model->getPASperKDMP($data)->result();

                //Rumus Nilai Raport Keterampilan
                $naPerKd = round(((2 * $data['kin']) + $pasKDMP[0]->pas_psk) / 3);
                $naKdPerMpPsk[$data['kd_mp']][$data['kd_kd']] = $naPerKd;
            }
        }
        //End KI 4--------------------------
        //KI 4--------------------------
        //Nilai NH Rata-rata
        $naPsk = array();
        $nlKdArrPsk = array();
        foreach ((array) $naKdPerMpPsk as $mp=>$nlKd) {
            $naPsk[$mp] = round(array_sum($nlKd) / count($naKdPerMpPsk[$mp]));
            $nlKdArrPsk[$mp] = $nlKd;
        }
        //End KI 4--------------------------
        //KI 4--------------------------
        foreach((array) $naPsk as $keyMp=>$valNa) {
            //Deskripsi
            $ketPsk = '';
            for($l=0; $l < count($nlKdArrPsk[$keyMp]); $l++) {
                //get kkm
                $data['kd_mp_rpt']  = $keyMp;
                $getKkmMp  = $this->hasilbelajar_model->getKkmMp($data)->row();
                $getKkm    = isset($getKkmMp->skbm) ? $getKkmMp->skbm : 0;

                //ambil nilai maksimal
                $nlValMax = max($nlKdArrPsk[$keyMp]);
                $nlValMin = min($nlKdArrPsk[$keyMp]);

                //bandingkan nilai maksimal dengan kkm
                $nlMax = 0;
                if($nlValMax >= $getKkm) {
                    //cari KD yang sesuai dengan nilai maksimal
                    $nlMax = array_keys($nlKdArrPsk[$keyMp], max($nlKdArrPsk[$keyMp]));

                    //cari deskripsi maksimal
                    $ketKdMaxArr = array();
                    for ($i=0; $i < count($nlMax); $i++) {
                        $data['kd_ki']      = 'ki4';
                        $data['kd_max_min'] = $nlMax[$i];

                        $getDeskripsi    = $this->hasilbelajar_model->getDeskripsiKD($data)->row();
                        $ketKdMaxArr[]   = $getDeskripsi->ket_kd;
                    }
                    $ketKdMax = implode(', ',$ketKdMaxArr);
                }

                //bandingkan nilai minimal dengan kkm
                $nlMin = 0;
                if($nlValMin < $getKkm && $getKkm!=0) {
                    //cari KD yang sesuai dengan nilai minimal
                    $nlMin = array_keys($nlKdArrPsk[$keyMp], min($nlKdArrPsk[$keyMp]));

                    //cari deskripsi minimal
                    $ketKdMinArr = array();
                    for ($s=0; $s < count($nlMin); $s++) {
                        $data['kd_ki'] = 'ki4';
                        $data['kd_max_min'] = $nlMin[$s];

                        $getDeskripsi   = $this->hasilbelajar_model->getDeskripsiKD($data)->row();
                        $ketKdMinArr[]  = $getDeskripsi->ket_kd;
                    }
                    $ketKdMin = implode(', ',$ketKdMinArr);
                }
                //Susun deskripsi
                if($nlMax!=0 && $nlMin!=0) {
                    $ketPsk = 'Ananda mampu '.$ketKdMax.' perlu pembinaan dalam '.$ketKdMin;
                } elseif($nlMax!=0 && $nlMin==0) {
                    $ketPsk = 'Ananda mampu '.$ketKdMax;
                } elseif($nlMax==0 && $nlMin!=0) {
                    $ketPsk = 'Ananda perlu pembinaan dalam '.$ketKdMin;
                } else {
                    $ketPsk = '';
                }
            }

            //simpan nilai raport
            $data['kd_mp'] = $keyMp;
            $data['psk']   = $valNa;
            
            $data['deskripsi_psk']   = $ketPsk;
            
            $sdata = $this->hasilbelajar_model->dapat($data);              
            if($sdata->num_rows() > 0)
            {
                    $this->hasilbelajar_model->updateNilaiRaportPsk($data);
            }
            else
            {
                    $this->hasilbelajar_model->simpanNilaiRaportPsk($data);
            }
        }
        //End KI 4 ----------------------------
        //=========== End nilai PSK =============================================================


        //=========== nilai AFK =============================================================
        //KI 1 & 2--------------------------
        $kdTghPsk = ['PAI'=>'SPR','PKN'=>'SOS'];
        foreach((array) $kdTghPsk as $keyTghPsk=>$valTghPsk) {
            $data['kdMpPsk']  = $keyTghPsk;
            $data['kdTghPsk'] = $valTghPsk;
            if($keyTghPsk == 'PAI') {
                $data['kdKiPsk'] = 'ki1';
            } elseif($keyTghPsk == 'PKN') {
                $data['kdKiPsk'] = 'ki2';
            }
            $getSpr   = $this->hasilbelajar_model->getSprperKDMP($data)->result();
            
            $n = 0;
            $ketMaxArr = array();
            $ketMinArr = array();
            $nlAfkArr  = 0;
            foreach((array) $getSpr as $rows) {
                $nlAfkArr += $rows->afk;
                if($rows->afk >= 4) {
                    $ketMaxArr[] = $rows->ket_kd;
                } elseif($rows->afk > 0) {
                    $ketMinArr[] = $rows->ket_kd;
                }
                $n++;
            }
            $data['afk'] = (!empty($nlAfkArr) && !empty($nlAfkArr)) ? $nlAfkArr / $n : '';

            $ketMax = !empty($ketMaxArr) ? implode(', ',$ketMaxArr) : '';
            $ketMin = !empty($ketMinArr) ? implode(', ',$ketMinArr) : '';

            if($ketMax!='' && $ketMin!='') {
                $data['deskripsi_afk'] = 'Ananda sudah terbiasa dalam '.$ketMax.' mulai terlihat dalam '.$ketMin;
            }elseif($ketMax!='' && $ketMin=='') {
                $data['deskripsi_afk'] = 'Ananda sudah terbiasa dalam '.$ketMax;
            }elseif($ketMax=='' && $ketMin!='') {
                $data['deskripsi_afk'] = 'Ananda mulai terlihat dalam '.$ketMin;
            }elseif($ketMax=='' && $ketMin=='') {
                $data['deskripsi_afk'] = '';
            }

            $sdata = $this->hasilbelajar_model->dapat($data);              
            if($sdata->num_rows() > 0)
            {
                    $this->hasilbelajar_model->updateNilaiRaportAfk($data);
            }
            else
            {
                    $this->hasilbelajar_model->simpanNilaiRaportAfk($data);
            }

        }

        //End KI 1 & 2 ----------------------------
        //=========== End nilai AFK =============================================================

        $data['nilai_akhir'] = $this->hasilbelajar_model->getNilaiRapot($data);

        $this->load->view('hasil_belajar/lck_sd_02',$data);
    }

    function lck_deskripsi($kelas=0,$nama=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar Semester';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $data['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = str_replace('+',' ',$this->uri->segment(4));
        }
        $data['nama_pilih']         = $nama;
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');

        $data['pilihkelas']         = $this->input->post('skelas');//memberi nilai pilihkelas sesuai inputan pd view dropdown kelas
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];

//        $data['kd_mp']              = ($this->hasilbelajar_model->tampil($data)->num_rows()>0) ? $this->hasilbelajar_model->tampil($data)->row()->kd_mp : '';

        $data['kd_mp']              = $this->input->post('kd_mp');
        $data['nama']               = $this->hasilbelajar_model->nama($data['pilihkelas']);
        //$data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['absena']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);

        $data['hasilbelajar']       = $this->hasilbelajar_model->getkpa($data);
        $data['tampil'] = ($this->input->post('skelas')=='' || $this->input->post('nis')=='') ? ' ' : 'a';
        $this->load->view('hasil_belajar/lck_deskripsi',$data);
    }

    function proses_hitung_lck($kelas)
    {
        $this->load->model('app_model');
        $this->load->library('curl');
        //$data                           = $_REQUEST['data'];
        //$data                           = json_decode($data,true);

        $data['kd_sekolah']             = $this->session->userdata('kd_sekolah');
        $data['th_ajar']                = $this->session->userdata('th_ajar');
        $data['p_nl']                   = $this->session->userdata('kd_semester');
        $data['sub_pnl']                = $this->session->userdata('sub_pnl');
        $data['kelas']                  = str_replace('+',' ',$this->uri->segment(3));


        $data                           = json_encode($data);
        $url                            = $this->app_model->system('prestasi_service_url'). "/KurtilasProsesHitungNilaiLCK02";
        //echo $url; die();
        $this->curl->create($url);
        $this->curl->post($data);
        $result                         = "";
        $result                         = json_decode($this->curl->execute());

        //$data['hasil']  = $result;

        echo '<script>alert("Proses Perhitungan LCK: "'. $result .');</script>';
        //$this->load->view('hasil_belajar/proses_lck',$data);
    }

}
