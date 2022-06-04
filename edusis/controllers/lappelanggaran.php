<?php
class Lappelanggaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('lappelanggaran_model');
        $this->load->model('siswa_model');
        $this->load->model('app_model');
        $this->global['kd_sekolah']     = $this->session->userdata('kd_sekolah');
        $this->global['th_ajar']        = $this->session->userdata('th_ajar');
        if (!$this->app_model->is_login("")) {redirect('login/loggedout');}
    }
    function index()
    {
        redirect('lappelanggaran/daftar');
    }
    function daftar($tgl_dari='',$tgl_sampai='')
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Laporan Pelanggaran Per Tanggal';
        $data['menu']               = $this->app_model->tampil_menu('Laporan BK');
        $data['tgldari']            = ($tgl_dari!='') ? $tgl_dari : '';
        $data['tglsampai']          = ($tgl_sampai!='') ? $tgl_sampai : '';
        $data['pelanggaran_siswa']  = $this->lappelanggaran_model->get($data['tgldari'],$data['tglsampai'],'');
        //echo $this->db->last_query();
        
        $this->load->view('pelanggaran/lappelanggaran_pertgl',$data);

    }
    function cetak_pelanggaran($tgl_dari='',$tgl_sampai='')
    {
        $data['nama_sekolah']       = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']              = ' | Laporan Pelanggaran Pertanggal';
        $data['menu']               = $this->app_model->tampil_menu('Bp');
        $data['tgldari']            = ($tgl_dari!='') ? $tgl_dari : '';
        $data['tglsampai']          = ($tgl_sampai!='') ? $tgl_sampai : '';
        $data['pelanggaran_siswa']  = $this->lappelanggaran_model->get($data['tgldari'],$data['tglsampai'],'');
          
        $this->load->view('pelanggaran/cetak_lappelanggaran',$data);
    }    
    function pelanggaranpersiswa($kelas=0,$nama=0)
    {
        $data['nama_sekolah']                               = $this->app_model->get_sekolah($this->session->userdata('kd_sekolah'))->nama_sekolah;
        $data['title']                                      = ' | Kepribadian Siswa';
        $data['menu']                                       = $this->app_model->tampil_menu('Laporan BK');
        $this->load->model('kelas_model');
        $data['kelas']                                      = $this->kelas_model->get();
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
        $data['nis']                = $this->uri->segment(4);
        $data['nama']               = $this->siswa_model->nama($data['pilihkelas']);
        $data['skelas']             = $this->kelas_model->getfilter($this->global['th_ajar'],$this->global['kd_sekolah'],'','');
        $data['kelas_siswa']        = $this->kelas_model->kelas_siswa($data['pilihkelas']);
        $data['pelanggaran']        = $this->lappelanggaran_model->getpelanggaranpersiswa($data);
        $this->load->view('pelanggaran/lappelanggaran_persiswa',$data);
    }
}