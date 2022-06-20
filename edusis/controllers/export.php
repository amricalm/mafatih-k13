<?php
class Export extends CI_Controller
{
    var $global;
    private $_dv;

    function __construct()
    {
        parent::__construct();
        $this->load->model('app_model');
        $this->load->model('hasilbelajar_model');
        $this->load->model('indikator_model');
        $this->load->model('lapkonseling_model');
        $this->load->model('task_model');
        $this->load->model('guru_model');
        $this->load->model('kkm_model');
        $this->load->model('sekolah_model');
        $this->load->model('mp_model');
        $this->load->model('kelas_model');
        $this->load->model('nilai_model');
        $this->load->model('siswa_model');
		    $this->load->model('lck_model');
        $this->load->model('th_ajar_model');
        $this->load->model('kompetensi_model');
        $this->load->model('lappelanggaran_model');
        $this->load->model('absen_model');
        $this->load->model('prestasi_model');
        $this->load->model('task_model');
        $this->load->library('to_pdf');
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
		    $this->_dv['alamat_sekolah']  = $this->app_model->get_sekolah($this->_kd_sekolah)->alamat_sekolah;
    }
    function export_pengetahuan_k13_to_pdf($kelas=0,$mp=0)//membuat file pdf ledger
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
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
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['pilihkelas']);
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['tk']                 = isset($this->kelas_model->get($kelas)->row()->tingkat) ? $this->kelas_model->get($kelas)->row()->tingkat : '';
        $data['kompetensi']         = $this->kompetensi_model->get_kompetensi('',$data['p_nl'],$data['tk'],$data['kd_mp'],$data['kd_sekolah'],$data['th_ajar'],$data['kd_ki']);
        $data['hasilbelajar']       = $this->hasilbelajar_model->nilai_ledger_pengetahuan_k13_sma($data);
        $html = $this->load->view('cetak/ledger_pengetahuan_k13_sma',$data,true);
        //echo $html;
	      $this->to_pdf->pdf_create($html, 'Ledger Pengetahuan '.$data['kelas'],true,'a4','landscape');
    }
    function export_keterampilan_k13_to_pdf($kelas=0,$mp=0)//membuat file pdf ledger
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
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
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['pilihkelas']);
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['tk']                 = isset($this->kelas_model->get($kelas)->row()->tingkat) ? $this->kelas_model->get($kelas)->row()->tingkat : '';
        $data['kompetensi']         = $this->kompetensi_model->get_kompetensi('',$data['p_nl'],$data['tk'],$data['kd_mp'],$data['kd_sekolah'],$data['th_ajar'],$data['kd_ki']);
        $data['hasilbelajar']       = $this->hasilbelajar_model->nilai_ledger_keterampilan_k13_sma($data);
        $html = $this->load->view('cetak/ledger_keterampilan_k13_sma', $data,true);
        //echo $html;
        $this->to_pdf->pdf_create($html, 'Ledger Keterampilan '.$data['kelas'],true,'a4','landscape');
    }
    function ekspor_ledger_sikap_k13($kelas=0,$mp=0)
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
      $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
      $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
      $data['th_ajar']            = $this->session->userdata('th_ajar');
      $data['p_nl']               = $this->session->userdata('kd_semester');
      $data['kelas']              = $data['pilihkelas'];
      $data['kd_mp']              = $data['pilihmp'];
      $data['mp']                      = $this->mp_model->get_all(str_replace('+',' ',$this->uri->segment(4)));
      $data['kkm']                = $this->kkm_model->getAll($this->uri->segment(3),$data['pilihmp']);
      //$data['kdmp']               = $this->mp_model->mp();
      $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
      //$data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
      $data['kdmp']               = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
      $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
      $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
      $data['tgl_lhb']            = $this->app_model->get_tgl_lhb();
      $data['hasilbelajar']       = $this->hasilbelajar_model->nilai_sikap($data);
      $data_pdf = $this->load->view('cetak/ledger_sikap_smp_k13', $data, true);
      $this->to_pdf->pdf_create($data_pdf, 'k13 ledger sikap',true,'a4','landscape');
    }
    function ekspor_ledger_keterampilan_k13($kelas=0,$mp=0)
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
      $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
      $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
      $data['th_ajar']            = $this->session->userdata('th_ajar');
      $data['p_nl']               = $this->session->userdata('kd_semester');
      $data['kelas']              = $data['pilihkelas'];
      $data['kd_mp']              = $data['pilihmp'];
      $data['mp']                      = $this->mp_model->get_all(str_replace('+',' ',$this->uri->segment(4)));
      $data['kkm']                = $this->kkm_model->getAll($this->uri->segment(3),$data['pilihmp']);
      //$data['kdmp']               = $this->mp_model->mp();
      $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
      //$data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
      $data['kdmp']               = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
      $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
      $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
      $data['tgl_lhb']            = $this->app_model->get_tgl_lhb();
      $data['hasilbelajar']       = $this->hasilbelajar_model->nilai_keterampilan($data);
      $data_pdf = $this->load->view('cetak/ledger_keterampilan_smp_2013', $data, true);
      $this->to_pdf->pdf_create($data_pdf, 'k13 ledger',true,'a4','landscape');
    }
    function ledger($kelas=0,$mp=0)
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('');
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

        $data['pilihkelas']         = $data['pilihkelas'];
        $data['kd_mp']              = $data['pilihmp'];
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['kkm']                = $this->kkm_model->getAll($this->uri->segment(3),$data['pilihmp']);
        $data['kdmp']               = $this->mp_model->mp();
        $data['mp']                 = $this->mp_model->get_all($data['pilihmp']);
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['pilihkelas']);
        //echo $this->db->last_query();
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['hasilbelajar']       = $this->hasilbelajar_model->nilai($data);
        //echo $this->db->last_query();
        $this->load->view('cetak/ledger1',$data);
    }
    function export_to_pdf($kelas=0,$mp=0)//membuat file pdf ledger
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('');
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
        $data['sub_pnl']            = $this->session->userdata('sub_pnl');
        $data['pilihkelas']         = $data['pilihkelas'];
        $data['kd_mp']              = $data['pilihmp'];
        $data['kkm']                = $this->kkm_model->getAll($this->uri->segment(3),$data['pilihmp']);
        $data['kdmp']               = $this->mp_model->mp();
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['pilihkelas']);
        $data['mp']                 = $this->mp_model->get_all($data['pilihmp']);
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['hasilbelajar']       = $this->hasilbelajar_model->nilai($data);
        //echo $this->db->last_query();
        //$this->load->view('cetak/ledger_uts',$data);
        $datapdf = $this->load->view('cetak/ledger_uts',$data,true);
        $this->to_pdf->pdf_create($datapdf, 'ledger',true,'a4','landscape');
    }
	function export_sikap_to_pdf($kelas=0,$mp=0)//membuat file pdf ledger
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
		$data['sub_pnl']            = $this->session->userdata('sub_pnl');
		$data['pilihkelas']         = $data['pilihkelas'];
        $data['kelas']              = $data['pilihkelas'];
        $data['kd_mp']              = $data['pilihmp'];
        $data['kkm']                = $this->kkm_model->getAll($this->uri->segment(3),$data['pilihmp']);
        //$data['kdmp']               = $this->mp_model->mp();
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        //$data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kdmp']               = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['pilihkelas']);
        $data['mp']                 = $this->mp_model->get_all($data['pilihmp']);
		$data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['hasilbelajar']       = $this->hasilbelajar_model->nilai_sikap($data);

        $datapdf = $this->load->view('cetak/ledger_sikap',$data,true);
        $this->to_pdf->pdf_create($datapdf, 'ledger',true,'a4','landscape');
    }
	function export_keterampilan_to_pdf($kelas=0,$mp=0)//membuat file pdf ledger
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
		$data['sub_pnl']            = $this->session->userdata('sub_pnl');
        $data['pilihkelas']         = $data['pilihkelas'];
        $data['kelas']              = $data['pilihkelas'];
        $data['kd_mp']              = $data['pilihmp'];
        $data['kkm']                = $this->kkm_model->getAll($this->uri->segment(3),$data['pilihmp']);
        //$data['kdmp']               = $this->mp_model->mp();
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        //$data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kdmp']               = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
        $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['pilihkelas']);
        $data['mp']                 = $this->mp_model->get_all($data['pilihmp']);
		$data['hasilbelajar']       = $this->hasilbelajar_model->nilai_keterampilan($data);

        $datapdf = $this->load->view('cetak/ledger_keterampilan_k13_sma',$data,true);
        $this->to_pdf->pdf_create($datapdf, 'ledger',true,'a4','landscape');
    }
    function export_pengetahuan_to_pdf($kelas=0,$mp=0)//membuat file pdf ledger
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Hasil Belajar MID Semester';
        $data['menu']               = $this->app_model->tampil_menu('');
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

        $data['kelas']              = $data['pilihkelas'];
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');
        $data['sub_pnl']            = $this->session->userdata('sub_pnl');
        $data['pilihkelas']         = $data['pilihkelas'];
        $data['kd_mp']              = $data['pilihmp'];
        $data['kkm']                = $this->kkm_model->getAll($this->uri->segment(3),$data['pilihmp']);
        $data['kdmp']               = $this->mp_model->mp();
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['pilihkelas']);
        $data['mp']                 = $this->mp_model->get_all($data['pilihmp']);
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$data['kd_sekolah'],$data['kelas']);

        //echo $this->db->last_query();
        //$this->load->view('cetak/ledger_uts',$data);
	if($data['kd_sekolah'] =="02")
        {
            //$data['tk']                 = $this->kelas_model->get($data['kelas'])->row()->tingkat;
            $tgh            = array("TEMA1_1","TEMA1_2","TEMA1_3","TEMA1_4",
                                "TEMA2_1","TEMA2_2","TEMA2_3","TEMA2_4",
                                "TEMA3_1","TEMA3_2","TEMA3_3","TEMA3_4",
                                "TEMA4_1","TEMA4_2","TEMA4_3","TEMA4_4");
            $tgh_select = array();
            $tgh_select_sum = array();

            for($i=0;$i<count($tgh);$i++)
            {
                $data['kd_tagihan']         = $tgh[$i];//Per Sub Tema
                $hasil                      = $this->hasilbelajar_model->getKompetensiDasar($data);

                $seq                        = 1;
                $sql                        = '';
                $sql_sum                    = '';
                $kol_top                    = '';

                foreach($hasil->result() as $baris)
                {
                    if ($sql!='')$sql.=',';
                    $sql .= "K$seq = case kd_kd when '$baris->kd_kd' then kgn end";

                    if ($sql_sum!='')$sql_sum.=',';
                    $sql_sum .= "sum(K$seq)$tgh[$i]K$seq ";

                    if ($kol_top!='')$kol_top.=',';
                    $kol_top .= "$tgh[$i]K$seq ";

                    $seq++;
                    if ($seq>4)break;
                }

                $seq_lanjutan = $seq;
                for($x=0;$x<5-$seq;$x++)
                {
                    if ($sql!='')$sql.=',';
                    $sql .= "K$seq_lanjutan = 0";

                    if ($sql_sum!='')$sql_sum.=',';
                    $sql_sum .= "sum(K$seq_lanjutan)$tgh[$i]K$seq_lanjutan ";

                    if ($kol_top!='')$kol_top.=',';
                    $kol_top .= "$tgh[$i]K$seq_lanjutan ";

                    $seq_lanjutan++;
                }
                $data['tgh_select'][$i]     = $sql;
                $data['tgh_select_sum'][$i] =$sql_sum;
                $data['tgh_select_top'][$i] =$kol_top;

             }
            $data['hasilbelajar']       = $this->hasilbelajar_model->nilai_sd($data);
			$datapdf = $this->load->view('cetak/ledger_pengetahuan_sd',$data,true);
        }
        else
        {
            $data['hasilbelajar']       = $this->hasilbelajar_model->nilai($data);
			      //$datapdf = $this->load->view('cetak/ledger_pengetahuan',$data,true);
            $html = $this->load->view('cetak/ledger_pengetahuan',$data,true);
            echo $html;
        }
	$this->to_pdf->pdf_create($datapdf, 'ledger',true,'a4','landscape');
    }
    function export_sikap_pdf($kelas=0,$mp=0)//membuat file pdf ledger
    {
        $kelas=str_replace('+',' ',$kelas);
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Penilaian Afektif';
        $data['menu']               = $this->app_model->tampil_menu('');
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
        $data['kdmp']               = $this->mp_model->mp();
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['pilihkelas']);
        $data['sikap']              = $this->indikator_model->get('');
        $data['mp']                 = $this->mp_model->get_all(str_replace('+',' ',$this->uri->segment(4)));
        $data['nama']               = $this->siswa_model->nama(str_replace('+',' ',$this->uri->segment(3)));
        $data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        //$this->load->view('cetak/daftar_afk',$data);
        $datapdf = $this->load->view('cetak/daftar_afk',$data,true);
        $this->to_pdf->pdf_create($datapdf, 'LEDGER_SIKAP',true,'a4','portrait');
    }
    function export_rapor_pdf($kelas=0,$mp=0)//membuat file pdf ledger
    {
		$this->load->model('hasilbelajar_model');
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
        $data['kkm']                     = $this->kkm_model->get_kkm($this->_kd_sekolah,$this->_th_ajar, $this->_p_nl, $this->_dv['pilihkelas'] , $this->_dv['pilihmp']);
        $data['sekolah']                 = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']                  = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['datasiswa']               = $this->siswa_model->getall($this->uri->segment(3));
        $data['walikelas']               = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['pilihkelas']);
        $data['mp']                      = $this->mp_model->get_all(str_replace('+',' ',$this->uri->segment(4)));

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
        //$this->_dv['nilai'] =$data['nilai'];
        //$this->load->view('hasil_belajar/rapor_akhir2',$this->_dv);
        //$kelas=str_replace('+',' ',$kelas);
        //echo $this->db->last_query();
        //$this->load->view('cetak/ledger_akhir',$data);
        $datapdf = $this->load->view('cetak/rapor_akhir2',$data,true);
        $this->to_pdf->pdf_create($datapdf, 'Ledger_Akhir',true,'a4','landscape');
    }
    function export_rekap_rapor_pdf($kelas=0,$mp=0)//membuat file pdf ledger
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Rekap Hasil Belajar';
        $data['menu']               = $this->app_model->tampil_menu('');
        $datas['pilihkelas']        = str_replace('+',' ',$this->uri->segment(3));
        $base_url                   = base_url().'index.php/hasilbelajar/rekap_nilai/'.$datas['pilihkelas'];
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');
        $data['kelas']              = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$datas['pilihkelas']);
        $data['pilihkelas']         = $datas['pilihkelas'];
        $data['pilihnis']           = ($this->siswa_model->nama($datas['pilihkelas'])->num_rows()>0) ? $this->siswa_model->nama($datas['pilihkelas'])->row()->nis : '';
//        $data['mp']                 = $this->mp_model->getMpByKelas($datas['pilihkelas']);

        $data['siswa']              = $this->siswa_model->get_per_kelas($datas['pilihkelas'],  $this->_kd_sekolah, $this->_th_ajar);
        $data['mp']             = $this->mp_model->get_per_kelas($datas['pilihkelas'] ,$this->_kd_sekolah, $this->_th_ajar, $this->_p_nl);
//        print_r($data['pilihkelas']);die();
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
                                
                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['NA'] = $nilai_akhir;
                                $data['nilai'][$seq]['mp'][$seq_mp]['tgh']['NA_PSK'] = $nilai_akhir_psk;

                        }
                    }
                    $seq_mp++;
                }
                $seq++;
            }
        }

//        var_dump($data);die();

        $datapdf = $this->load->view('cetak/rekap_uts2',$data,true);
        $this->to_pdf->pdf_create($datapdf, 'REKAP_NILAI',true,'a4','landscape');
    }
    function ledgera()
    {
        $data['title']              = ' | Hasil Belajar Semester';
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

        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwalikelas($this->session->userdata('th_ajar'));
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];
        $data['absena']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);
        $data['ledger']             = $this->hasilbelajar_model->getkpa($data);
        $this->load->view('cetak/report_nilai1',$data);
    }
    function export_progres_rapor_uts()
    {
        $data['title']              = ' | Hasil Belajar Semester';
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
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwalikelas($this->session->userdata('th_ajar'));
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];
        $data['absena']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['eskul']              = $this->hasilbelajar_model->geteskul($data);
        $data['nama']               = $this->siswa_model->getall($this->uri->segment(4));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['kelas']);
        $data['hasilbelajar']       = $this->hasilbelajar_model->getkpa($data);

        $qry                             = $this->hasilbelajar_model->getComment($this->_th_ajar, $this->_kd_sekolah,  $this->_p_nl,  $data['nis'])  ;
        $data['comment']            = ($qry->num_rows()>0) ? $qry->row()->comment : '';
//        echo $data['comment'];die();
        $data['tgl_lhb']            = $this->app_model->tgl_lhb_format_ddmmyy();

        $html = $this->load->view('cetak/progres_rapor_uts',$data,true);
        $this->to_pdf->pdf_create($html,'PROGRES_RAPOR',true,'a4','potrait');
    }

    function adn_export_progres_rapor_uts()
    {
        $this->_dv['title']              = ' | Hasil Belajar Semester';

        $this->_dv['pilihkelas']         = '';
        if($this->uri->segment(3)!='')
        {
            $this->_dv['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $this->_dv['skelas']             = $this->kelas_model->getfilterotorisasi($this->_th_ajar,$this->_kd_sekolah);

        $this->_dv['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $this->_dv['pilihnis']       = str_replace('+',' ',$this->uri->segment(4));
        }

        $data['pilihnis']               = $this->_dv['pilihnis'];
        $data['kelas']                  = $this->_dv['pilihkelas'];
        $data['nis']                    = $data['pilihnis'];
        $data['pilihkelas']             = $this->_dv['pilihkelas'];

        $this->_dv['kelas']             = $data['kelas'];
        $this->_dv['nis']               = $data['nis'];
        $this->_dv['siswa']             = $this->siswa_model->getprofile($data);

        $this->_dv['eskul']              = $this->hasilbelajar_model->geteskul($data);
        $this->_dv['absena']             = $this->hasilbelajar_model->getabsena($data);
        $this->_dv['absens']             = $this->hasilbelajar_model->getabsens($data);
        $this->_dv['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $this->_dv['pribadi']            = $this->hasilbelajar_model->getpribadi($data);
        $this->_dv['kepsek']              = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $this->_dv['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $this->_dv['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$this->_dv['kelas']);
//        echo $this->db->last_query();
//        die();
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

        $this->_dv['hasil']              = $hasil;
        $this->_dv['tgl_lhb']            = $this->app_model->tgl_lhb_format_ddmmyy();

        $html = $this->load->view('cetak/adn_progres_rapor_uts',$this->_dv,true);
        $this->to_pdf->pdf_create($html,'PROGRES_RAPOR',true,'a4','potrait');
    }

    function ledger_sampul_depan()
    {
        $data['pilihnis']           = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihnis']       = str_replace('+',' ',$this->uri->segment(3));;
        }
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['nis']                = $data['pilihnis'];
        $data['ledger']             = $this->siswa_model->getBySiswaKelas($data['nis']);
        $this->load->view('cetak/report_depan',$data);
    }
    function export_depan_pdf()
    {
        $data['pilihnis']           = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']     = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = str_replace('+',' ',$this->uri->segment(4));
        }
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kd_semester']        = ($this->session->userdata('kd_semester')==1) ? 'Ganjil' : 'Genap';
        $data['nis']                = $data['pilihnis'];
        $data['ledger']             = $this->siswa_model->getBySiswaKelas($data['nis']);
		    $data['datasiswa']          = $this->siswa_model->getall($this->uri->segment(4));
        foreach($data['datasiswa']->result() as $row)
        {
         $data['nm_lngkp'] = $row->nama_lengkap;
        }
        
  		$html = $this->load->view('cetak/report_depan',$data,true);
      // echo $html;
      $this->to_pdf->pdf_create($html, 'SAMPUL RAPORT '.$data['nm_lngkp'],true,'a4','potrait');
    }
    function export_nilai1($kelas=0,$nama=0)
    {
        $kelas=str_replace('+',' ',$kelas);
		    $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
		    $data['alamat_sekolah']     = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->alamat_sekolah;
        $data['title']              = ' | RAPORT';
        $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $base_url                   = base_url().'index.php/hasilbelajafr/report_nilai1/'.$kelas.'/'.$nama;
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
        $data['sub_pnl']            = $this->session->userdata('sub_pnl');
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];
		    $data['datasiswa']          = $this->siswa_model->getall($this->uri->segment(4));
        $data['nama']               = $this->hasilbelajar_model->nama($data['pilihkelas']);
		    $data['skelas']             = $this->kelas_model->getfilterotorisasi($this->global['th_ajar'],$this->global['kd_sekolah']);
		    $data['tk']                 = $this->kelas_model->get($data['kelas'])->row()->tingkat;
		    $data['kd_mp']              = $this->input->post('kd_mp');
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
		    $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$data['kd_sekolah'],$data['kelas']);
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
        $data['naMin']              = '';
        $data['naMax']              = '';
		    $data['abseina']            = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);
		    $data['eskul']              = $this->hasilbelajar_model->geteskul($data);
        $tinggi_berat_badan         = $this->hasilbelajar_model->gettinggibadan($data);
        $data['kesehatan']          = $this->hasilbelajar_model->getkesehatan($data);
        $data['catatan_siswa']      = $this->task_model->siswa_comment($data);
        $data['tgl_rapor']          = $this->app_model->tgl_lhb_format_ddmmyy();
        $data['tgl_lhb']            = $this->app_model->get_tgl_lhb();
        $data['prestasi']           = $this->prestasi_model->get_prestasi($data['nis']);
        $data['df_mp']              = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
        $data['kompetensi_spr']     = $this->kompetensi_model->get_kompetensi('',$data['p_nl'],$data['tk'],'PAI',$data['kd_sekolah'],$data['th_ajar'],'ki1');
        $data['kompetensi_sos']     = $this->kompetensi_model->get_kompetensi('',$data['p_nl'],$data['tk'],'PKN',$data['kd_sekolah'],$data['th_ajar'],'ki2');
        $data['hasilbelajar_spr']   = $this->hasilbelajar_model->nilai_rapor_sikap_k13_spr($data);
        $data['hasilbelajar_sos']   = $this->hasilbelajar_model->nilai_rapor_sikap_k13_sos($data);
        $data['hasilbelajar']       = $this->hasilbelajar_model->getkpa2($data);

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

        $data['nilai_akhir'] = $this->hasilbelajar_model->getNilaiRapot($data);

        $profile = $this->siswa_model->getprofile($data)->row();
        $data['nm_lngkp'] = $profile->nama_lengkap;


      $html = $this->load->view('cetak/report_nilai1_sd_02',$data,true);
      $this->to_pdf->pdf_create($html, 'RAPORT '.$data['nm_lngkp'],true,'a4','potrait');
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
            $na         = 0;
            $convNa     = 0;
            $arrCombKgn = 0;
            $naMin      = '';
            $desMin     = '';
            $naMax      = '';
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
            $naMinPsk   = 0;
            $arrCombPsk = [0];
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




        $data['nilai_akhir']['NMMP']   = $data['nm_mp'];
        $data['nilai_akhir']['URUTAN'] = $data['urutan'];
        return $data['nilai_akhir'];
    }

    function report_nilai2()
    {
        $data['title']              = ' | Hasil Belajar Semester';
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

        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];
        $data['eskul']              = $this->hasilbelajar_model->geteskul($data);
        $data['karyatulis']         = $this->hasilbelajar_model->getkaryatulis($data);
        $data['absena']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);
        $data['hasilbelajar']       = $this->hasilbelajar_model->getkpa($data);
        //echo $this->db->last_query();
        $this->load->view('cetak/report_nilai2',$data);
    }
    function export_ledger2_pdf()
    {

    $data['title']              = ' | Hasil Belajar Semester';
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

        $data['kelas']              = $data['pilihkelas'];

        $data['nis']                = $data['pilihnis'];
        $data['eskul']              = $this->hasilbelajar_model->geteskul($data);
        $data['datasiswa']          = $this->siswa_model->getall($this->uri->segment(4));
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['kelas']);
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
        $data['karyatulis']         = $this->hasilbelajar_model->getkaryatulis($data);
        $data['absena']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['coment']             = $this->hasilbelajar_model->getcoment($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);
        $data['hasilbelajar']       = $this->hasilbelajar_model->getkpa($data);
        $data['eskul']              = $this->hasilbelajar_model->geteskul($data);
        $data['tgl_lhb']            = $this->app_model->get_tgl_lhb();
        $data['tgl_rapor']          = $this->app_model->tgl_lhb_format_ddmmyy();

        $html = $this->load->view('cetak/report_nilai2',$data,true);
        $this->to_pdf->pdf_create($html, 'Ledger_2',true,'a4','potrait');
    }
    function ledger_nilai3()
    {
        $data['title']              = ' | Hasil Belajar Semester';
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

        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];
        $data['hasilbelajar']       = $this->hasilbelajar_model->getkks($data);
        //echo $this->db->last_query();
        $this->load->view('cetak/report_nilai3',$data);
    }
    function export_ledger3_pdf()
    {
        $data['title']              = ' | Hasil Belajar Semester';
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

        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];
        $data['hasilbelajar']       = $this->hasilbelajar_model->getkks($data);
        //echo $this->db->last_query();
        $html = $this->load->view('cetak/report_nilai3',$data,true);
        $this->to_pdf->pdf_create($html, 'Ledger_kks',true,'a4','potrait');
    }
    function data_siswa($kelas,$cari)
    {
        $data['data']               = $this->siswa_model->get('',$this->session->userdata('kd_sekolah'),$kelas,'','',$cari);
        $this->load->view('cetak/data_siswa',$data);
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=data_siswa.xls");
    }
    function comment()
    {
        $data['title']              = ' | Hasil Belajar Semester';

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
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];

        $data['hasilbelajar']       = $this->hasilbelajar_model->getkpa($data);
        $this->load->view('cetak/catatan',$data);
    }
    function export_catatan_pdf()
    {
        $data['title']              = ' | Hasil Belajar Semester';

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
        $data['kelas']              = $data['pilihkelas'];
        $data['datasiswa']          = $this->siswa_model->getall($this->uri->segment(4));
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['kelas']);
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];

        $data['hasilbelajar']       = $this->hasilbelajar_model->getkpa($data);
        $data['catatan_pengembangan_diri']= $this->hasilbelajar_model->getcomentPengembanganDiri($data);
        $data['catatan_umum']       = $this->hasilbelajar_model->getcomentCatatanUmum($data);
        $data['tgl_rapor']          = $this->app_model->tgl_lhb_format_ddmmyy();

        $html = $this->load->view('cetak/catatan',$data,true);
        $this->to_pdf->pdf_create($html, 'Catatan',true,'a4','potrait');
    }
    function konseling_pertanggal($tgl_dari='',$tgl_sampai='')
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Laporan konseling';
        $data['menu']               = $this->app_model->tampil_menu('Laporan Konseling Per Tanggal');
        $data['tgldari']            = ($tgl_dari!='') ? $tgl_dari : '';
        $data['tglsampai']          = ($tgl_sampai!='') ? $tgl_sampai : '';
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['konseling']          = $this->lapkonseling_model->get($data['tgldari'],$data['tglsampai'],'');
        $html = $this->load->view('cetak/konseling_pertanggal',$data,true);
        $this->to_pdf->pdf_create($html, 'Lap Konseling Siswa',true,'a4','landscape');
    }
    function konseling_persiswa()
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Laporan konseling';
        $data['menu']               = $this->app_model->tampil_menu('');
        $data['nis']                = $this->uri->segment(4);
        $data['pilihkelas']         = str_replace('+',' ',$this->uri->segment(4));
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['datasiswa']          = $this->siswa_model->getall($this->uri->segment(4));
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['konseling']          = $this->lapkonseling_model->get_persiswa($data['nis']);
        //echo $this->db->last_query();
        //$this->load->view('cetak/konseling_persiswa',$data);
        $html = $this->load->view('cetak/konseling_persiswa',$data,true);
        $this->to_pdf->pdf_create($html, 'Lap Konseling Siswa',true,'a4','landscape');
    }
    function lappelanggaran_persiswa($kelas=0,$nis=0)
    {
        $data['title']                                      = ' | Pelanggaran Siswa';
        $data['pilihkelas']                                 = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']                             = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihnis']           = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihnis']       = $this->uri->segment(4);
        }
        $data['kelas']              = str_replace('+',' ',$this->uri->segment(3));
        $data['datasiswa']          = $this->siswa_model->getall($this->uri->segment(4));
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['kelas']);
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['nis']                = $this->uri->segment(4);
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kelas_siswa']        = $this->kelas_model->kelas_siswa($data['pilihkelas']);
        $data['pelanggaran']        = $this->lappelanggaran_model->getpelanggaranpersiswa($data);
        //$this->load->view('cetak/lappelanggaran_persiswa',$data);
        $html = $this->load->view('cetak/lappelanggaran_persiswa',$data,true);
        $this->to_pdf->pdf_create($html,'Pelanggaran per siswa',true,'a4','portrait');
    }
    function lappelanggaran_pertgl($tgl_dari='',$tgl_sampai='')
    {
        $data['title']              = ' | Laporan Pelanggaran Per Tanggal';
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['menu']               = $this->app_model->tampil_menu('');
        $data['tgldari']            = ($this->uri->segment(3)!='' && $this->uri->segment(3)!='0') ? $this->uri->segment(3) : '';
        $data['tglsampai']          = ($this->uri->segment(4)!='' && $this->uri->segment(4)!='0') ? $this->uri->segment(4) : '';
        $data['pelanggaran_siswa']  = $this->lappelanggaran_model->get($data['tgldari'],$data['tglsampai'],'');
        //echo $this->db->last_query();
        //$this->load->view('cetak/lappelanggaran_pertgl',$data);
        $html = $this->load->view('cetak/lappelanggaran_pertgl',$data,true);
        $this->to_pdf->pdf_create($html,'Pelanggaran per tanggal',true,'a4','landscape');
    }
    function export_kompetensi_daftar()
    {
        $data['nama_sekolah']            = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']                   = ' | Daftar Rencana Pembelajaran & Penilaian';
        $data['menu']                    = $this->app_model->tampil_menu('');

        $data['pilihkelas']              = '';
        if($this->uri->segment(3)!='')
        {
            $data['pilihkelas']          = str_replace('+',' ',$this->uri->segment(3));
        }
        $data['pilihmp']                 = '';
        if($this->uri->segment(4)!='')
        {
            $data['pilihmp']             = str_replace('+',' ',$this->uri->segment(4));
        }
        $datas['kelas']                  = $data['pilihkelas'];
        $datas['kd_mp']                  = $data['pilihmp'];
        $datas['tk']                     = $this->uri->segment(3);
        $data['tk']                      = $this->uri->segment(3);
        $data['mp']                      = $this->mp_model->get_all($this->uri->segment(4));
        $data['sekolah']                 = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kelas']                   = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        //$data['kompetensi']              = $this->kompetensi_model->get_skkd_bykdmppdf($datas);
        if($this->uri->segment(4)!='0' || $this->uri->segment(4)!='')
        {
            $data['kompetensi']              = $this->kompetensi_model->get_skkd_bykdmp($datas);
        }
        else
        {
            $data['kompetensi']              = $this->kompetensi_model->get_skkd_bykdmppdf($datas);
        }
        $html = $this->load->view('cetak/daftar_kompetensi',$data,true);
        $this->to_pdf->pdf_create($html,'KOMPETENSI',true,'a4','landscape');
    }
    function export_absen($kelas=0,$bulan='0')
    {
        $data['nama_sekolah']                = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']                       = '| Absen Siswa';
        $data['menu']                        = $this->app_model->tampil_menu('Evaluasi');
        //$data['kelas']                       = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        //$data['pilihbulan']                  = ($bulan!='' && $bulan!='0') ? $bulan : date('m');
        $data['sekolah']                     = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kelas']                       = str_replace('+',' ',$this->uri->segment(3));
        $data['walikelas']                   = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['kelas']);
        $data['kd_sekolah']                  = $this->session->userdata('kd_sekolah');
        $data['th_ajar']                     = $this->session->userdata('th_ajar');
        $data['p_nl']                        = $this->session->userdata('kd_semester');
        $data['pilihkelas']                  = str_replace('+',' ',$kelas);
        $data['siswa']                       = $this->absen_model->getlap($data['kd_sekolah'],$data['th_ajar'],$data['pilihkelas'],$data['p_nl']);

        //$this->load->view('cetak/absen',$data);
        $html = $this->load->view('cetak/absen',$data,true);
        $this->to_pdf->pdf_create($html,'Lap Absensi Siswa',true,'a4','landscape');
    }
    function daftar_kelas($off=0)
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Wali Kelas';
	    $data['menu']               = $this->app_model->tampil_menu('File');
        $data['kd_sekolah']         = $this->global['kd_sekolah'];
        $data['th_ajar']            = $this->global['th_ajar'];
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['kelas']              = $this->kelas_model->getwaliall($data);
        //$this->load->view('cetak/daftarkelas',$data);
        $html = $this->load->view('cetak/daftarkelas',$data,true);
        $this->to_pdf->pdf_create($html,'Daftar Kelas',true,'a4','landscape');
    }

    function export_ledger_detail_pdf($kelas=0,$mp=0)//membuat file pdf ledger
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Rekap Hasil Belajar';
        $data['menu']               = $this->app_model->tampil_menu('');
        $datas['pilihkelas']        = str_replace('+',' ',$this->uri->segment(3));
        $base_url                   = base_url().'index.php/hasilbelajar/rekap_nilai/'.$datas['pilihkelas'];
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['th_ajar']            = $this->session->userdata('th_ajar');
        $data['p_nl']               = $this->session->userdata('kd_semester');
        $data['kelas']              = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$datas['pilihkelas']);
        $data['pilihkelas']         = $datas['pilihkelas'];
        $data['pilihnis']           = ($this->siswa_model->nama($datas['pilihkelas'])->num_rows()>0) ? $this->siswa_model->nama($datas['pilihkelas'])->row()->nis : '';
//        $data['mp']                 = $this->mp_model->getMpByKelas($datas['pilihkelas']);

        $data['siswa']              = $this->siswa_model->get_per_kelas($datas['pilihkelas'],  $this->_kd_sekolah, $this->_th_ajar);
        $data['mp']             = $this->mp_model->get_per_kelas($datas['pilihkelas'] ,$this->_kd_sekolah, $this->_th_ajar, $this->_p_nl);
//        print_r($data['pilihkelas']);die();

        if ($data['siswa']['hBaris']->num_rows()>0 )
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


        $datapdf = $this->load->view('cetak/ledger_detail',$data,true);
        $this->to_pdf->pdf_create($datapdf, 'Ledger Detail',true,'a4','landscape');
    }

	function export_lck_deskripsi_pdf()
    {
        $data['title']              = ' | Hasil Belajar Semester';
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

        $data['kelas']              = $data['pilihkelas'];
        $data['kd_sekolah']         = $this->session->userdata('kd_sekolah');
        $data['nis']                = $data['pilihnis'];
        $data['eskul']              = $this->hasilbelajar_model->geteskul($data);
        $data['datasiswa']          = $this->siswa_model->getall($this->uri->segment(4));
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['kelas']);
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
        $data['karyatulis']         = $this->hasilbelajar_model->getkaryatulis($data);
        $data['absena']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['coment']             = $this->hasilbelajar_model->getcoment($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);
        $data['hasilbelajar']       = $this->hasilbelajar_model->getkpa($data);

        $data['tgl_lhb']            = $this->app_model->get_tgl_lhb();
        $data['tgl_rapor']          = $this->app_model->tgl_lhb_format_ddmmyy();
		    $data['sub_pnl']            = $this->session->userdata('sub_pnl');

      $html = $this->load->view('cetak/lck_deskripsi',$data,true);
      $this->to_pdf->pdf_create($html, 'raport',true,'A4','potrait');
    }
	function export_nilai_mulok($kelas=0,$nama=0)
    {
		$kelas=str_replace('+',' ',$kelas);
		$data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
		$data['alamat_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->alamat_sekolah;
        $data['title']              = ' | Hasil Belajar Semester';
         $data['menu']               = $this->app_model->tampil_menu('Laporan');
        $base_url                   = base_url().'index.php/hasilbelajafr/report_nilai1/'.$kelas.'/'.$nama;
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

		$data['kdmp']              = $this->mp_model->get_mpotorisasi($this->global['kd_sekolah']);
        $data['kelas']              = $data['pilihkelas'];
        $data['nis']                = $data['pilihnis'];

		$data['datasiswa']          = $this->siswa_model->getall($this->uri->segment(4));

/*        $data['kd_mp']              = ($this->hasilbelajar_model->tampil($data)->num_rows()>0) ? $this->hasilbelajar_model->tampil($data)->row()->kd_mp : '';
        $data['kd_mp']              = $this->input->post('kd_mp');
        $data['datasiswa']          = $this->siswa_model->getall(trim($this->uri->segment(4)));
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'),$data['kelas']);
        $data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'));
*/
		$data['kepsek']             = $this->th_ajar_model->getkepsek($this->session->userdata('th_ajar'),$this->session->userdata('kd_sekolah'));
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
		$data['data']               = $this->sekolah_model->get($data['kd_sekolah']);
        $data['walikelas']          = $this->kelas_model->getwali($this->session->userdata('th_ajar'),$data['kd_sekolah'],$data['kelas']);
		$data['abseina']             = $this->hasilbelajar_model->getabsena($data);
        $data['absens']             = $this->hasilbelajar_model->getabsens($data);
        $data['abseni']             = $this->hasilbelajar_model->getabseni($data);
        $data['pribadi']            = $this->hasilbelajar_model->getpribadi($data);

		$data['eskul']              = $this->hasilbelajar_model->geteskul($data);

        $data['tgl_rapor']          = $this->app_model->tgl_lhb_format_ddmmyy();
        if($data['kd_sekolah'] =="02")
        {
			$data['hasilbelajar']       = $this->hasilbelajar_model->getnilai_mulok($data);
            $html = $this->load->view('cetak/report_nilai_mulok',$data,true);
        }

        $this->to_pdf->pdf_create($html, 'RAPOR',true,'A4','potrait');
	}

    function profile_sekolah_pdf()
    {
        $data['sekolah']            = $this->sekolah_model->get($this->session->userdata('kd_sekolah'));
        $html = $this->load->view('cetak/profile_sekolah',$data,true);
        echo $html;
        //$this->to_pdf->pdf_create($html,'profile_sekolah',true,'a4','potrait');
    }

}

?>
